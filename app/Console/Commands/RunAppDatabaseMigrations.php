<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;

final class RunAppDatabaseMigrations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the application database migrations';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->comment('Running application migrations...');
        $this->call('migrate');

        $this->comment('Running domain module migrations...');
        $this->call('migrate', ['--path' => '/modules/domain/database/migrations']);

        $this->comment('Running appointment module migrations...');
        $this->call('migrate', ['--path' => '/modules/appointment/database/migrations']);

        $this->comment('Running auth module migrations...');
        $this->call('migrate', ['--path' => '/modules/auth/database/migrations']);

        $this->comment('Running common module migrations...');
        $this->call('migrate', ['--path' => '/modules/common/database/migrations']);

        $this->comment('Running telemetry module migrations...');
        $this->call('migrate', ['--path' => '/modules/telemetry/database/migrations']);

        $this->comment('Running administration module migrations...');
        $this->call('migrate', ['--path' => '/modules/administration/database/migrations']);
    }
}
