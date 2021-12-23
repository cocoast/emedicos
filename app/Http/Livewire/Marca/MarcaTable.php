<?php

namespace App\Http\Livewire\Marca;

use Livewire\Component;
use App\Models\Marca;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class MarcaTable extends DataTableComponent
{
    public function columns(): array
    {
        return [
            Column::make('marca')
                ->sortable()
                ->searchable(),
            Column::make('Created At', 'created_at')
                ->sortable()
                ->searchable(),
            Column::make('Updated At', 'updated_at')
                ->sortable()
                ->searchable(),
        ];
    }

    public function query(): Builder
    {
        return Marca::query();
    }

}
