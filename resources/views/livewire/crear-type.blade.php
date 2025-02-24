<div>
    <x-button wire:click="$set('openCrear', true)">
        <i class="fas fa-add mr-2"></i> NUEVO
    </x-button>
    <x-dialog-modal wire:model="openCrear" maxWidth='2xl'>
        <x-slot name="title" >
            Nuevo Tipo
        </x-slot>
        <x-slot name="content">
            <x-label value="Nombre" class="mb-1" />
            <x-input type='text' class="w-full" wire:model="cform.nombre" />
            <x-input-error for="cform.nombre" />
            <x-label value="Color" class="mt-4 mb-1" />
            <x-input type='color' class="w-full" wire:model="cform.color" />
            <x-input-error for="cform.color" />
        </x-slot>
        <x-slot name="footer">
            <div class="flex flex-row-reverse">
                <x-button wire:click="insertar"><i class="fas fa-save mr-2"></i>Enviar</x-button>
                <x-button class="mr-4" wire:click="salir"><i class="fas fa-xmark mr-2"></i>Cancelar</x-button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>