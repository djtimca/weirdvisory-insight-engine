<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Helpers\EnvHelper;

class LogTestController extends Controller
{
    public function testLog()
    {
        // Force reload environment variables
        $loadedVars = EnvHelper::reloadEnvironment();
        
        // Test Gemini API connectivity
        $geminiApiUrl = env('GEMINI_API_URL');
        $geminiApiKey = env('GEMINI_API_KEY');
        
        // Log environment status
        Log::info('Environment variables status', [
            'loaded_count' => count($loadedVars),
            'gemini_api_url' => $geminiApiUrl,
            'gemini_api_key_length' => strlen($geminiApiKey),
            'app_env' => env('APP_ENV'),
            'app_debug' => env('APP_DEBUG')
        ]);
        
        $apiConnectivityResults = $this->testApiConnectivity($geminiApiUrl, $geminiApiKey);
        Log::info('Gemini API connectivity test', $apiConnectivityResults);
        
        // Test basic logging
        Log::emergency('Test emergency log');
        Log::alert('Test alert log');
        Log::critical('Test critical log');
        Log::error('Test error log');
        Log::warning('Test warning log');
        Log::notice('Test notice log');
        Log::info('Test info log');
        Log::debug('Test debug log');
        
        // Test file permissions
        $logPath = storage_path('logs/laravel.log');
        $isWritable = is_writable($logPath);
        $exists = file_exists($logPath);
        $permissions = file_exists($logPath) ? substr(sprintf('%o', fileperms($logPath)), -4) : 'N/A';
        $directoryPermissions = substr(sprintf('%o', fileperms(dirname($logPath))), -4);
        
        // Test log configuration
        $logChannel = config('logging.default');
        $logChannelConfig = config('logging.channels.' . $logChannel);
        
        return response()->json([
            'message' => 'Log test executed',
            'log_file' => [
                'path' => $logPath,
                'exists' => $exists,
                'writable' => $isWritable,
                'permissions' => $permissions,
                'directory_permissions' => $directoryPermissions
            ],
            'log_config' => [
                'default_channel' => $logChannel,
                'channel_config' => $logChannelConfig
            ],
            'php_info' => [
                'version' => phpversion(),
                'sapi' => php_sapi_name(),
                'user' => get_current_user(),
                'open_basedir' => ini_get('open_basedir')
            ]
        ]);
    }
    
    /**
     * Test connectivity to the Gemini API
     *
     * @param string $apiUrl
     * @param string $apiKey
     * @return array
     */
    private function testApiConnectivity($apiUrl, $apiKey)
    {
        $results = [
            'url' => $apiUrl,
            'api_key_length' => strlen($apiKey),
            'tests' => []
        ];
        
        // Parse URL components
        $urlParts = parse_url($apiUrl);
        $results['url_parts'] = $urlParts;
        
        // Test 1: DNS resolution
        $host = $urlParts['host'] ?? '';
        if ($host) {
            $dnsResult = @gethostbyname($host);
            $dnsResolved = ($dnsResult !== $host);
            $results['tests']['dns'] = [
                'host' => $host,
                'resolved_ip' => $dnsResult,
                'success' => $dnsResolved
            ];
        }
        
        // Test 2: Socket connection
        if ($host) {
            $port = $urlParts['port'] ?? ($urlParts['scheme'] === 'https' ? 443 : 80);
            $socketTest = @fsockopen($host, $port, $errno, $errstr, 5);
            $socketSuccess = is_resource($socketTest);
            if ($socketSuccess) {
                fclose($socketTest);
            }
            $results['tests']['socket'] = [
                'host' => $host,
                'port' => $port,
                'success' => $socketSuccess,
                'error_number' => $errno ?? 0,
                'error_message' => $errstr ?? ''
            ];
        }
        
        // Test 3: Simple HTTP request without API key
        try {
            $client = new \GuzzleHttp\Client([
                'timeout' => 10,
                'connect_timeout' => 5,
                'verify' => false
            ]);
            
            // Make a simple HEAD request to the API domain (not the full API URL)
            $domainUrl = $urlParts['scheme'] . '://' . $host;
            $response = $client->head($domainUrl);
            
            $results['tests']['http'] = [
                'url' => $domainUrl,
                'status_code' => $response->getStatusCode(),
                'success' => true
            ];
        } catch (\Exception $e) {
            $results['tests']['http'] = [
                'url' => $domainUrl ?? $host,
                'success' => false,
                'error' => $e->getMessage(),
                'error_type' => get_class($e)
            ];
        }
        
        return $results;
    }
}
