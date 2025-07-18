<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Dotenv\Dotenv;

class EnvServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Force reload environment variables in production
        if (file_exists(base_path('.env'))) {
            try {
                $dotenv = Dotenv::createImmutable(base_path());
                $dotenv->load();
                
                // Log that we've loaded the environment variables
                \Illuminate\Support\Facades\Log::info('Environment variables reloaded by EnvServiceProvider');
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Failed to load environment variables', [
                    'error' => $e->getMessage()
                ]);
            }
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
