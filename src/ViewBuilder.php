<?php

namespace Jwz104\EloquentView;

use Illuminate\Support\Facades\DB;

class ViewBuilder {
    /**
     * Build the view by executing the query.
     *
     * @param string $view The view name.
     * @param mixed $builder The query builder.
     * @return void
     */
    public function create($view, $builder)
    {
        $viewQuery = $this->bindQuery($builder);

        $query = sprintf('CREATE VIEW "%s" AS %s', $view, $viewQuery);

        DB::statement($query);
    }

    /**
     * Add the bindings to the query.
     *
     * @param mixed $builder The query builder.
     * @return string
     */
    private function bindQuery($builder)
    {
        $query = $builder->toSql();
        $bindings = $builder->getBindings();

        foreach($bindings as $binding) {
            // Quote if the value is not numeric.
            $value = is_numeric($binding) ? $binding : sprintf('\'%s\'', $binding);
            // Replace the ? with the binding.
            $query = preg_replace('/\?/', $value, $query, 1);
        }

        return $query;
    }

    /**
     * Drop a view.
     *
     * @param string $view The view to drop.
     * @return void
     */
    public function drop($view)
    {
        DB::statement(sprintf('DROP VIEW %s', $view));
    }

    /**
     * Drop a view if the view exists.
     *
     * @param string $view The view to drop.
     * @return void
     */
    public function dropIfExists($view)
    {
        DB::statement(sprintf('DROP VIEW IF EXISTS %s', $view));
    }
}