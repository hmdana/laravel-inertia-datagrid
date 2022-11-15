<?php

namespace Hmdana\LaravelInertiaDataGrid;

use Illuminate\Support\ServiceProvider;
use Inertia\Response as InertiaResponse;

class InertiaDataGridServiceProvider extends ServiceProvider
{
    public function boot()
    {
        InertiaResponse::macro('getQueryBuilderProps', function () {
            return $this->props['queryBuilderProps'] ?? [];
        });

        InertiaResponse::macro('datagrid', function (callable $withDataGridBuilder = null) {
            $dataGridBuilder = new InertiaDataGrid(request());

            if ($withDataGridBuilder) {
                $withDataGridBuilder($dataGridBuilder);
            }

            return $dataGridBuilder->applyTo($this);
        });
    }
}
