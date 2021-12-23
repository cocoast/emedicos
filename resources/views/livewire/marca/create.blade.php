<div>
   <x-jet-button wire:click="$set('open',true)">
        Crear Nueva Marca
    </x-jet-button>

   <x-jet-dialog-modal wire:model="open">
    <x-slot name="title"> Crear nueva Marca</x-slot>
    <x-slot name="content">
        <div class="mb-4">
            <x-jet-label value="Marca"/>
            <x-jet-input type="text" class="w-full" wire:model='marca'/>
            <x-jet-input-error for="marca"></x-jet-input-error>
        </div>
    </x-slot>
    <x-slot name="footer">
    <x-jet-secondary-button wire:click="$set('open',false)"> Cancelar</x-jet-secondary-button>
    <x-jet-danger-button wire:click='save' wire:loading.attr='disabled' wire:target='save' class="disabled:opacity-25">Crear</x-jet-danger-button>

    </x-slot>

   </x-jet-dialog-modal>
</div>
