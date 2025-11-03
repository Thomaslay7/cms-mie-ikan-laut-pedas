<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class ClearAllCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-all-cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all caches, sessions, and temporary files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Clearing all caches and sessions...');

        // Clear Laravel caches
        Artisan::call('cache:clear');
        $this->info('✓ Application cache cleared');

        Artisan::call('config:clear');
        $this->info('✓ Configuration cache cleared');

        Artisan::call('route:clear');
        $this->info('✓ Route cache cleared');

        Artisan::call('view:clear');
        $this->info('✓ View cache cleared');

        // Clear compiled services
        Artisan::call('clear-compiled');
        $this->info('✓ Compiled services cleared');

        // Clear session files
        $sessionPath = storage_path('framework/sessions');
        if (File::exists($sessionPath)) {
            File::cleanDirectory($sessionPath);
            $this->info('✓ Session files cleared');
        }

        // Clear cache files
        $cachePath = storage_path('framework/cache/data');
        if (File::exists($cachePath)) {
            File::cleanDirectory($cachePath);
            $this->info('✓ Cache files cleared');
        }

        // Clear logs
        $logPath = storage_path('logs');
        if (File::exists($logPath)) {
            File::cleanDirectory($logPath);
            $this->info('✓ Log files cleared');
        }

        $this->info('🎉 All caches and sessions cleared successfully!');
        $this->info('💡 Please restart the Laravel server for changes to take effect.');

        return 0;
    }
}
