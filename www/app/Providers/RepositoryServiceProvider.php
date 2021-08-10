<?php

namespace App\Providers;

use App\Repositories\AppointmentRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\ExpenseRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ServiceRepository;
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
        $this->app->singleton('customer-repo', CustomerRepository::class);
        $this->app->singleton('appointment-repo', AppointmentRepository::class);
        $this->app->singleton('employee-repo', EmployeeRepository::class);
        $this->app->singleton('expense-repo', ExpenseRepository::class);
        $this->app->singleton('product-repo', ProductRepository::class);
        $this->app->singleton('service-repo', ServiceRepository::class);
    }
}
