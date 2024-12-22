<?php

namespace App\Providers;

use AaronFrancis\Solo\Commands\EnhancedTailCommand;
use AaronFrancis\Solo\Facades\Solo;
use Illuminate\Support\ServiceProvider;

class SoloServiceProvider extends ServiceProvider
{
    public function register()
    {
        if (class_exists('\AaronFrancis\Solo\Manager')) {
            $this->configure();
        }
    }

    public function configure()
    {
        Solo::useTheme('dark')
            // Commands that auto start.
            ->addCommands([
                EnhancedTailCommand::make('Logs', 'tail -f -n 100 ' . storage_path('logs/laravel.log')),
                'Vite' => './vendor/bin/sail npm run dev',
                // 'HTTP' => 'php artisan serve',
                // 'About' => 'php artisan solo:about'
            ])
            // Not auto-started
            ->addLazyCommands([
                // 'Queue' => 'php artisan queue:listen --tries=1',
                // 'Reverb' => 'php artisan reverb:start',
                // 'Pint' => 'pint --ansi',
                'Test' => './vendor/bin/sail artisan test',
            ])
            // FQCNs of trusted classes that can add commands.
            ->allowCommandsAddedFrom([
                //
            ]);
    }

    public function boot()
    {
        //
    }
}
