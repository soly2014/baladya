<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\ServiceRepository::class, \App\Repositories\ServiceRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\ServiceRepository::class, \App\Repositories\ServiceRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\ServiceRepository::class, \App\Repositories\ServiceRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\ResQuarRepository::class, \App\Repositories\ResQuarRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\StreetRepository::class, \App\Repositories\StreetRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\ContractorRepository::class, \App\Repositories\ContractorRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\ViolationTypeRepository::class, \App\Repositories\ViolationTypeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\ViolationRepository::class, \App\Repositories\ViolationRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\ViolationStatusRepository::class, \App\Repositories\ViolationStatusRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\HealthEnvTypeRepository::class, \App\Repositories\HealthEnvTypeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\PenaltyRepository::class, \App\Repositories\PenaltyRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\GardenRepository::class, \App\Repositories\GardenRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\ActivityRepository::class, \App\Repositories\ActivityRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\FacilityStatusRepository::class, \App\Repositories\FacilityStatusRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\UserVisitRepository::class, \App\Repositories\UserVisitRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\CompanyRepository::class, \App\Repositories\CompanyRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\FacilityRepository::class, \App\Repositories\FacilityRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\UserRepositoryRepository::class, \App\Repositories\UserRepositoryRepositoryEloquent::class);
        //:end-bindings:
    }
}
