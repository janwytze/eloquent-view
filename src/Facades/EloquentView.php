<?php

namespace Jwz104\EloquentView\Facades;

use Illuminate\Support\Facades\Facade;
use Jwz104\EloquentView\ViewBuilder;

class EloquentView extends Facade {
    /**
     * Get the eloquent view builder.
     *
     * @return \Jwz104\EloquentView\ViewBuilder
     */
    protected static function getFacadeAccessor()
    {
        return new ViewBuilder();
    }
}