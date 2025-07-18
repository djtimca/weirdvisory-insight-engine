<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogTestController extends Controller
{
    public function testLog()
    {
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
}
