<div wire:init='loadMarca'>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="px-6 py-4 flex item-center" > 
        <div class="flex items-center">
            <span>Mostrar</span>
            <select wire:model='cant' class="mx-4 form-control w-full" >
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <span>entradas</span>
        </div>
        <x-jet-input type="text" class="flex-1 mx-4" placeholder=" Busqueda" wire:model="search"/>
        @livewire('sc.sc-create')
    </div>

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

        @if(is_countable($scs))
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="th-24 cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" wire:click="order('id')" >
                            ID
                            @if($sort=='id')
                            @if ($direction=='desc')
                            <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                        @else
                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                        @endif
                         
                             @else
                             <i class="fas fa-sort float-right mt-1"></i>
                                 @endif

                        </th>
                        <th scope="col"
                            class="cursor-pointer w-full px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" wire:click="order('numero')">
                            Numero
                            @if($sort=='numero')
                                @if ($direction=='desc')
                                    <i class="fas fa-sort-alpha-up-alt float-right mt-1"/>
                                @else
                                    <i class="fas fa-sort-alpha-down-alt float-right mt-1"/>
                                @endif
                            @else
                                <i class="fas fa-sort float-right mt-1"></i>
                            @endif

                        </th>
                        <th scope="col" class="relative px-2 py-1">
                            <span class="sr-only"></span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($scs as $sc)
                    <tr>
                        <td class="px-6 py-4 ">
                            <div class="text-sm  text-gray-900"> {{  $sc->id  }} </div>
                        </td>
                        <td class="px-6 py-4 ">
                                {{ $sc->numero }}
                            
                        </td>
                        <td class="px-6 py-4  ext-sm text-sm font-medium flex">
                            <a class="btn btn-success btn-sm ml-2" wire:click="edit({{$sc}})"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm ml-2" wire:click="$emit('deleteMarca',{{$sc->id}})"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
                    @if($scs->hasPages())
        <div class="px-6 py-3">
            {{$scs->links()}}
        </div>
            @endif
        @else
                    No existen registros
        @endif
            
     </div>
            </div>
        </div>
    </div> 
    <x-jet-dialog-modal wire:model="openedit">
        <x-slot name='title'> Editar sc </x-slot>
        <x-slot name='content'>
          
            <x-jet-label value="Nombre de la sc"/>
            <x-jet-input type="text" class="w-full"  wire:model="sc.sc"/>
          
        </x-slot>
        <x-slot name='footer'>
            <x-jet-secondary-button wire:click="$set('openedit',false)"> Cancelar</x-jet-secondary-button>
            <x-jet-danger-button wire:click='update' wire:loading.attr='disabled' wire:target='save'  class="disabled:opacity-25">Actualizar</x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>  
    </div>
    @push('js')
    <!-- Sweetalert 2-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
         Livewire.on('deleteMarca',scId =>{
            Swal.fire({
        title: '¿Estas Seguro que deseas eliminar el Registro?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Si, eliminar',
        denyButtonText: 'No, conservar',
        customClass: {
            actions: 'my-actions',
            cancelButton: 'order-1 right-gap',
            confirmButton: 'order-2',
            denyButton: 'order-3',
        }
        }).then((result) => {
        if (result.isConfirmed) {
            
            Livewire.emitTo('sc.sc-index','delete',scId);

            Swal.fire('Eliminado', '', 'success')
        } else if (result.isDenied) {
            Swal.fire('Nada se ha Eliminado', '', 'info')
        }
        })
         });
    </script>
        
    @endpush
</div>
