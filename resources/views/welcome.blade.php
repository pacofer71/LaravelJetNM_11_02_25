<x-app-layout>
    <x-self.base>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 p-6">
            @foreach($cursos as $item)
            <article
                @class(
                [ 'rounded-3xl shadow-lg transition-all duration-300 h-92
                         transform hover:scale-105 hover:shadow-2xl overflow-hidden border-2 border-black' , 
                         'md:col-span-2'=> $loop->first
                ])
                >
                <div class="flex flex-col h-full w-full justify-between">
                    <!-- Imagen de encabezado -->
                    <div class="relative h-32 bg-cover bg-center rounded-t-3xl"
                        style="background-image:url({{ Storage::url($item->imagen) }})">
                        <div class="absolute inset-0 bg-black opacity-10"></div>
                    </div>

                    <!-- Contenido del card -->
                    <div class="flex flex-col justify-between h-full bg-white p-4 rounded-b-3xl">
                        <!-- Titulo -->
                        <h2 class="text-xl font-bold text-gray-900 mb-2 tracking-wide">
                            {{ $item->nombre }}
                        </h2>

                        <!-- Descripción -->
                        <p class="text-gray-700 text-sm italic leading-relaxed mb-4 flex-grow">
                            {{ Str::limit($item->descripcion, 60) }}
                        </p>
                        <!-- Correo -->
                         <p class="italic font-semibold">{{$item->user->email}}</p> 

                        <!-- Categoria -->
                        <div class="flex items-center justify-center mb-4">
                            <span
                                class="px-3 py-1 font-semibold rounded-full text-sm"
                                style="background-color:{{ $item->type->color }}; color: white;"
                                aria-label="Categoría del curso">
                                {{ $item->type->nombre }}
                            </span>
                        </div>

                        <!-- Fecha y botón -->
                        <div class="flex flex-col sm:flex-row items-center justify-between mt-auto">
                            <!-- Fecha de inicio -->
                            <span class="text-gray-600 text-sm font-medium flex-shrink-0">
                                Inicio: {{ $item->fecha_inicio->format('d/m/Y') }}
                            </span>

                            <!-- Botón Ver más -->
                            <button
                                class="px-4 py-2 bg-gradient-to-r from-purple-600 via-pink-600 to-red-600 text-white font-semibold rounded-md shadow-md hover:from-purple-700 hover:via-pink-700 hover:to-red-700 transition duration-300 mt-4 sm:mt-0 flex-shrink-0"
                                aria-label="Ver detalles del curso">
                                Ver más
                            </button>
                        </div>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </x-self.base>
</x-app-layout>