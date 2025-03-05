<?php

declare(strict_types=1);

namespace AppointmentService\Domain;

use AppointmentService\Domain\Contracts\Repositories\AccountDomain;
use AppointmentService\Domain\Contracts\Services\BrowserFingerprint;
use AppointmentService\Domain\Contracts\Services\Domain;
use AppointmentService\Domain\Repositories\AccountDomainRepository;
use AppointmentService\Domain\Services\BrowserFingerprintService;
use AppointmentService\Domain\Services\DomainService;
use Illuminate\Support\ServiceProvider;

final class DomainServiceProvider extends ServiceProvider
{
    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        AccountDomain::class => AccountDomainRepository::class,
        Domain::class => DomainService::class,
        BrowserFingerprint::class => BrowserFingerprintService::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/domain.php',
            'domain'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/domain.php' => config_path('domain.php'),
        ], 'domain-config');

        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        $this->publishesMigrations([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'domain-migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array<int, string>
     */
    public function provides(): array
    {
        return [
            AccountDomain::class,
            Domain::class,
            BrowserFingerprint::class,
        ];
    }
}
