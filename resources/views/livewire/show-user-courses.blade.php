<x-self.base>
    <div class="flex justify-between w-full mb-2 items-center">
        <div class="w-full">
            <x-input type="search" placeholder="Buscar..." class="w-1/3" wire:model.live="texto" />
        </div>
        <div>
            @livewire('crear-curso')
        </div>
    </div>
    @if(count($cursos))
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Detalle
                </th>
                <th scope="col" class="px-16 py-3">
                    <span class="sr-only">Image</span>
                </th>
                <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('nombre')">
                    Nombre<i class="fas fa-sort  ml-1"></i>
                </th>
                <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('descripcion')">
                    Descripcion<i class="fas fa-sort  ml-1"></i>
                </th>
                <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('tipo')">
                    Tipo<i class="fas fa-sort  ml-1"></i>
                </th>
                <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('fecha_inicio')">
                    Inicio<i class="fas fa-sort  ml-1"></i>
                </th>
                <th scope="col" class="px-6 py-3 cursor-pointer text-nowrap" wire:click="ordenar('duracion')">
                    Duración<i class="fas fa-sort  ml-1"></i>
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($cursos as $item)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                    <button>
                        <i class="fas fa-info text-lg text-blue-500 hover:text-2xl"></i>
                    </button>
                </td>
                <td class="p-4">
                    <img src="{{Storage::url($item->imagen)}}" class="w-16 md:w-32 max-w-full max-h-full" alt="">
                </td>
                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                    {{$item->nombre}}
                </td>
                <td class="px-6 py-4">
                    {{$item->descripcion}}
                </td>
                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                    {{$item->tipo}}
                </td>
                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                    {{\Carbon\Carbon::parse($item->fecha_inicio)->format('d/m/Y')}}
                </td>
                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                    {{$item->duracion}}
                </td>
                <td class="px-6 py-4">
                    <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline">Remove</a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>

    <div class="mt-2">
        {{$cursos->links()}}
    </div>
    @else
    <!-- Alerta -->
    <div class="flex items-center p-4 space-x-3 bg-yellow-100 border border-yellow-300 rounded-md shadow-sm">
        <!-- Ícono de advertencia -->
        <i class="fa-solid fa-triangle-exclamation text-yellow-600 text-xl"></i>
        <!-- Texto de la alerta -->
        <p class="text-yellow-800 text-sm font-medium">
            No se encontró ningún curso o aún no creó ninguno.
        </p>
    </div>
    @endif
</x-self.base>