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
                <td class="px-6 py-4 whitespace-nowrap">
                    <button class="mr-2" wire:click="edit({{$item->id}})">
                    <i class="fas fa-edit text-lg text-blue-500 hover:text-xl"></i> 
                    </button>
                   <button wire:click="confirmarBorrado({{$item->id}})">
                    <i class="fas fa-trash text-lg hover:text-xl"></i>
                   </button>
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
    <!------------------------------------------------ Modal Para detalle curso -->
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
            
            <button wire:click="cerrarDetalle" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 focus:outline-none">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </x-slot>
    </x-dialog-modal>
    @endif
    <!--------------------------------- Modal para editar curso ---------------------->
    @if($uform->course!=null)
    <x-dialog-modal wire:model="openUpdate">
      <x-slot name="title">
         Editar Curso
      </x-slot>
      <x-slot name="content">
         <!-- Campo Nombre -->
         <div class="relative">
            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
            <div class="mt-1 relative">
               <input type="text" id="nombre" name="nombre" placeholder="Escribe tu nombre" wire:model="uform.nombre"
                  class="block w-full pr-10 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
               <i class="fa-solid fa-user absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
            <x-input-error for="uform.nombre" />
         </div>

         <!-- Campo Descripción -->
         <div class="relative">
            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
            <div class="mt-1 relative">
               <textarea id="descripcion" wire:model="uform.descripcion" name="descripcion" rows="4" placeholder="Escribe una descripción"
                  class="block w-full pr-10 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
               <i class="fa-solid fa-align-left absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
            <x-input-error for="uform.descripcion" />
         </div>

         <!-- Fechas -->
         <div class="grid grid-cols-1 gap-6">
            <div class="relative">
               <label for="fecha_inicio" class="block text-sm font-medium text-gray-700">Fecha de Inicio</label>
               <div class="mt-1 relative">
                  <input type="date" @disabled($uform->fechaInicioDisable)
                  id="fecha_inicio" name="fecha_inicio" wire:model="uform.fecha_inicio"
                     class="block w-full pr-10 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  <i class="fa-solid fa-calendar-days absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
               </div>
               <x-input-error for="uform.fecha_inicio" />
            </div>
            <div class="relative">
               <label for="fecha_fin" class="block text-sm font-medium text-gray-700">Fecha de Fin</label>
               <div class="mt-1 relative">
                  <input type="date" @disabled($uform->fechaFinDisable) 
                  id="fecha_fin" name="fecha_fin" wire:model="uform.fecha_fin"
                     class="block w-full pr-10 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  <i class="fa-solid fa-calendar-days absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
               </div>
               <x-input-error for="uform.fecha_fin" />
            </div>
         </div>

         <!-- Precio -->
         <div class="relative">
            <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
            <div class="mt-1 relative">
               <input type="number" id="precio" name="precio" placeholder="Escribe el precio" wire:model="uform.precio"
                  class="block w-full pr-10 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
               <i class="fa-solid fa-dollar-sign absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
            <x-input-error for="uform.precio" />
         </div>

         <!-- Tipo de Curso -->
         <div class="relative">
            <label for="tipo_curso" class="block text-sm font-medium text-gray-700">Tipo de Curso</label>
            <div class="mt-1 relative">
               <select id="tipo_curso" name="tipo_curso" wire:model="uform.type_id"
                  class="block w-full pr-10 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  <option value="">Selecciona un tipo</option>
                  @foreach ($types as $tipo)
                     <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                  @endforeach
               </select>
               <i class="fa-solid fa-book absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
            <x-input-error for="uform.type_id" />
         </div>
         <!-- Tags (Checkbox) -->
         <div>
            <label class="block text-sm font-medium text-gray-700">Tags</label>
            <div class="mt-2 space-x-4">
               @foreach($tags as $tag)
               <label class="inline-flex items-center" for="u{{$tag->id}}">
                  <input id="u{{$tag->id}}"  type="checkbox" name="tags[]" value="{{$tag->id}}" wire:model="uform.tags" class="form-checkbox h-4 w-4 text-indigo-600">
                  <span class="ml-2 text-gray-700">#{{$tag->nombre}}</span>
               </label>
               @endforeach
   
            </div>
            <x-input-error for="uform.tags" />
         </div>
         <!-- Imagen -->
         <label class="block text-sm font-medium text-gray-700">Imagen</label>
         <div class="h-80 w-full relative bg-gray-200">
            <input id="uimagen" type="file" accept="image/*" wire:model="uform.imagen" class="hidden" />
            <label for="uimagen" 
            class="text-white font-semibold p-2 rounded-xl bg-gray-600 hover:bg-black absolute end-2 bottom-2">
               <i class="fas fa-upload mr-2"></i>SUBIR
            </label>
            @if($uform->imagen)
            <img src="{{$uform->imagen->temporaryUrl()}}" class="size-full bg-center bg-no-repeat bg-cover" />
            @else
            <img src="{{Storage::url($uform->course->imagen)}}" class="size-full bg-center bg-no-repeat bg-cover" />

            @endif
         </div>
         <x-input-error for="uform.imagen" />
      </x-slot>
      <x-slot name="footer">
         <!-- Botones -->
         <div class="flex justify-end space-x-4">
            <button wire:click="update"
               class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
               <i class="fa-solid fa-paper-plane mr-2"></i>Enviar
            </button>
            <button type="button" wire:click="cancelar"
               class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
               <i class="fa-solid fa-ban mr-2"></i>Cancelar
            </button>
         </div>
      </x-slot>
   </x-dialog-modal>
   @endif
</x-self.base>