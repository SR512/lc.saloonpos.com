<?php

namespace App\Providers;

use App\Repositories\AppointmentRepository;
use App\Repositories\AttributeRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\ExpenseRepository;
use App\Repositories\InvoiceRepository;
use App\Repositories\MembershipRepository;
use App\Repositories\PackageRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SellerInvoiceRepository;
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
        $this->app->singleton('attribute-repo', AttributeRepository::class);
        $this->app->singleton('invoice-repo', InvoiceRepository::class);
        $this->app->singleton('seller-invoice-repo', SellerInvoiceRepository::class);
        $this->app->singleton('membership-repo', MembershipRepository::class);
        $this->app->singleton('package-repo', PackageRepository::class);

    }
}
