<?php

namespace App\Providers;

use App\Repository\ApartmentTypeRepositoryInterface;
use App\Repository\ApartmentRepositoryInterface;
use App\Repository\ComplexRepositoryInterface;
use App\Repository\DeveloperRepositoryInterface;
use App\Repository\Eloquent\ApartmentTypeRepository;
use App\Repository\Eloquent\ApartmentRepository;
use App\Repository\Eloquent\ComplexRepository;
use App\Repository\Eloquent\DeveloperRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ComplexRepositoryInterface::class, ComplexRepository::class);
        $this->app->bind(DeveloperRepositoryInterface::class, DeveloperRepository::class);
        $this->app->bind(ApartmentTypeRepositoryInterface::class, ApartmentTypeRepository::class);
        $this->app->bind(ApartmentRepositoryInterface::class, ApartmentRepository::class);
    }
}
