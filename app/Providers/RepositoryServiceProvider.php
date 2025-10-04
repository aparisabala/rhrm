<?php

namespace App\Providers;

use App\Repositories\Admin\Company\Crud\CompanyCrudRepository;
use App\Repositories\Admin\Company\Crud\ICompanyCrudRepository;
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
            $this->app->bind(abstract: ICompanyCrudRepository::class, concrete: CompanyCrudRepository::class);

        }
}
