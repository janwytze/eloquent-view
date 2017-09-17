<?php

namespace Jwz104\EloquentView;

use Illuminate\Support\ServiceProvider;
use Jwz104\EloquentView\Facades\EloquentView;

class EloquentViewServiceProvider extends ServiceProvider {
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Register the facade.
        $this->app->bind('EloquentView', EloquentView::class);
    }
}