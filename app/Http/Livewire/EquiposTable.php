<?php

namespace App\Http\Livewire;

use App\Models\Equipo;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;

class EquiposTable extends LivewireDatatable
{
    public $model = Equipo::class;

    public function columns()
    {
       return [
            NumberColumn::name('id')
                ->label('ID')
            ];
    }
    public function builder()
    {
        return Equipo::query();
    }
}