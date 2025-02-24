<x-self.base>
    <h3 class="text-center txt-xl">Listado de Tipos</h3>
    <div class="flex flex-row-reverse">
        @livewire('crear-type')
    </div>
    <table class="mt-2 w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Nombre
                </th>
                <th scope="col" class="px-6 py-3">
                    Color
                </th>
                <th scope="col" class="px-6 py-3">
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($types as $item)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$item->nombre}}
                </th>
                <td class="px-6 py-4">
                    <div class="text-center p-2 rounded-xl w-32 font-bold text-white" style="background-color:{{$item->color}}">
                        {{$item->color}}
                    </div>
                </td>
                <td class="px-6 py-4" >
                    <button class="mr-2" wire:click="edit({{$item->id}})">
                        <i class="fas fa-edit text-lg hover:text-2xl"></i>
                    </button>
                    <button wire:click="confirmarBorrado({{$item->id}})">
                        <i class="fas fa-trash text-lg hover:text-2xl"></i>
                    </button>
                </td>

            </tr>
            @endforeach

        </tbody>
    </table>
    <!-- Modal para actualizar un tipo -->
     @if($uform->type!=null)
    <x-dialog-modal wire:model="openEditar" maxWidth='2xl'>
        <x-slot name="title" >
            Editar Tipo
        </x-slot>
        <x-slot name="content">
            <x-label value="Nombre" class="mb-1" />
            <x-input type='text' class="w-full" wire:model="uform.nombre" />
            <x-input-error for="uform.nombre" />
            <x-label value="Color" class="mt-4 mb-1" />
            <x-input type='color' class="w-full" wire:model="uform.color" />
            <x-input-error for="uform.color" />
        </x-slot>
        <x-slot name="footer">
            <div class="flex flex-row-reverse">
                <x-button wire:click="update"><i class="fas fa-edit mr-2"></i>Editar</x-button>
                <x-button class="mr-4" wire:click="salir"><i class="fas fa-xmark mr-2"></i>Cancelar</x-button>
            </div>
        </x-slot>
    </x-dialog-modal>
    @endif
</x-self.base>