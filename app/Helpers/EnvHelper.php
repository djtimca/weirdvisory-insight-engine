<?php

namespace App\Helpers;

use Dotenv\Dotenv;
use Illuminate\Support\Facades\Log;

class EnvHelper
{
    /**
     * Force reload environment variables
     * 
     * @return array Array of loaded environment variables
     */
    public static function reloadEnvironment()
    {
        $loaded = [];
        
        if (file_exists(base_path('.env'))) {
            try {
                // Create a new Dotenv instance and load it
                $dotenv = Dotenv::createImmutable(base_path());
                $loaded = $dotenv->load();
                
                // Log success
                Log::info('Environment variables reloaded by EnvHelper', [
                    'count' => count($loaded),
                    'gemini_api_url_exists' => !empty(env('GEMINI_API_URL')),
                    'gemini_api_key_length' => strlen(env('GEMINI_API_KEY'))
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to reload environment variables', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }
        }
        
        return $loaded;
    }
}
