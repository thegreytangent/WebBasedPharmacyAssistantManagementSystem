<?php

	namespace App\Providers;

	use Illuminate\Support\ServiceProvider;

    class RepositoryServiceProvider extends ServiceProvider
	{
        public function boot(): void
        {
            $this->app->bind(
                'Domain\Modules\Supplier\Repositories\ISupplierRepository',
                'App\Repositories\SupplierRepository'
            );



        }

	}