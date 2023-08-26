<?php

	namespace App\Providers;

	use Illuminate\Support\ServiceProvider;

    class RepositoryServiceProvider extends ServiceProvider
	{
        public function boot(): void
        {
            $this->app->bind(
                'Domain\Modules\User\Repositories\IUserRepository',
                'App\Repositories\UserRepository'
            );

            $this->app->bind(
                'Domain\Modules\Supplier\Repositories\ISupplierRepository',
                'App\Repositories\SupplierRepository'
            );

            $this->app->bind(
                'Domain\Modules\Category\Repositories\ICategoryRepository',
                'App\Repositories\CategoryRepository'
            );

            $this->app->bind(
                'Domain\Modules\Medicine\Repositories\IMedicineRepository',
                'App\Repositories\MedicineRepository'
            );

            $this->app->bind(
                'Domain\Modules\Customer\Repositories\ICustomerRepository',
                'App\Repositories\CustomerRepository'
            );

            $this->app->bind(
                'Domain\Modules\Order\Repositories\IOrderRepository',
                'App\Repositories\OrderRepository'
            );




        }

	}
