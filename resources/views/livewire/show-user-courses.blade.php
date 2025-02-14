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
                    <button wire:click="detalleCurso({{$item->id}})">
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
    <!-- Modal Para detalle curso -->
    @if($course!=null)
    <x-dialog-modal wire:model="openDetalle">
        <x-slot name="title">
            Detalle Curso
        </x-slot>
        <x-slot name="content">
            <!-- Imagen del Curso -->
            <img src="{{Storage::url($course->imagen)}}" alt="Imagen del Curso"
                class="w-full h-52 object-cover rounded-md mb-4">

            <!-- Nombre del Curso -->
            <h2 class="text-xl font-bold text-gray-800 mb-2">{{$course->nombre}}</h2>

            <!-- Descripción del Curso -->
            <p class="text-gray-600 mb-4">
                {{$course->descripcion}}
            </p>

            <!-- Fechas -->
            <div class="flex items-center space-x-4 mb-4">
                <div class="flex items-center text-gray-700">
                    <i class="fa-solid fa-calendar-days mr-2 text-indigo-500"></i>
                    <span>Inicio: <strong>{{$course->fecha_inicio->format('d/m/Y')}}</strong></span>
                </div>
                <div class="flex items-center text-gray-700">
                    <i class="fa-solid fa-calendar-days mr-2 text-indigo-500"></i>
                    <span>Fin: <strong>{{$course->fecha_fin->format('d/m/Y')}}</strong></span>
                </div>
            </div>

            <!-- Precio -->
            <div class="flex items-center text-gray-700 mb-4">
                <i class="fa-solid fa-dollar-sign mr-2 text-indigo-500"></i>
                <span>Precio: <strong>{{$course->precio}} €</strong></span>
            </div>

            <!-- Tipo de Curso -->
            <div class="flex items-center text-gray-700 mb-4">
                <i class="fa-solid fa-book mr-2 text-indigo-500"></i>
                <span>Tipo: <strong>{{$course->type->nombre}}</strong></span>
            </div>

            <!-- Etiquetas -->
            <div class="flex items-center space-x-2 mb-4">
                @foreach ($course->tags as $tag)
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium text-white" style="background-color:{{$tag->color}};">
                    #{{$tag->nombre}}
                </span>
                @endforeach
                
            </div>
        </x-slot>
        <x-slot name="footer">
            <!-- Botón Cerrar -->
            <button wire:click="cerrarDetalle" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 focus:outline-none">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </x-slot>
    </x-dialog-modal>
    @endif
</x-self.base>