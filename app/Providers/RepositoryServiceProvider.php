<?php

namespace App\Providers;

use App\Repositories\Admin\Company\Crud\CompanyRepository;
use App\Repositories\Admin\Company\Crud\ICompanyRepository;
use App\Repositories\BaseRepository;
use App\Repositories\IBaseRepository;
use Illuminate\Support\ServiceProvider;
//vpx_imports
class RepositoryServiceProvider extends ServiceProvider
{
        /**
         * Register any application services.
         */
        public function register(): void
        {
            $this->app->bind(abstract: IBaseRepository::class, concrete: BaseRepository::class);
            //vpx_attach
            $this->app->bind(abstract: ICompanyRepository::class, concrete: CompanyRepository::class);

        }
}
