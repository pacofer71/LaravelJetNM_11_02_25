<div>
   <x-button wire:click="$set('openCrear', true)"><i class="fas fa-add mr-2"></i>NUEVO</x-button>
   <x-dialog-modal wire:model="openCrear">
      <x-slot name="title">
         Crear Curso
      </x-slot>
      <x-slot name="content">
         <!-- Campo Nombre -->
         <div class="relative">
            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
            <div class="mt-1 relative">
               <input type="text" id="nombre" name="nombre" placeholder="Escribe tu nombre" wire:model="cform.nombre"
                  class="block w-full pr-10 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
               <i class="fa-solid fa-user absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
            <x-input-error for="cform.nombre" />
         </div>

         <!-- Campo Descripción -->
         <div class="relative">
            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
            <div class="mt-1 relative">
               <textarea id="descripcion" wire:model="cform.descripcion" name="descripcion" rows="4" placeholder="Escribe una descripción"
                  class="block w-full pr-10 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
               <i class="fa-solid fa-align-left absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
            <x-input-error for="cform.descripcion" />
         </div>

         <!-- Fechas -->
         <div class="grid grid-cols-1 gap-6">
            <div class="relative">
               <label for="fecha_inicio" class="block text-sm font-medium text-gray-700">Fecha de Inicio</label>
               <div class="mt-1 relative">
                  <input type="date" id="fecha_inicio" name="fecha_inicio" wire:model="cform.fecha_inicio"
                     class="block w-full pr-10 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  <i class="fa-solid fa-calendar-days absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
               </div>
               <x-input-error for="cform.fecha_inicio" />
            </div>
            <div class="relative">
               <label for="fecha_fin" class="block text-sm font-medium text-gray-700">Fecha de Fin</label>
               <div class="mt-1 relative">
                  <input type="date" id="fecha_fin" name="fecha_fin" wire:model="cform.fecha_fin"
                     class="block w-full pr-10 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  <i class="fa-solid fa-calendar-days absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
               </div>
               <x-input-error for="cform.fecha_fin" />
            </div>
         </div>

         <!-- Precio -->
         <div class="relative">
            <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
            <div class="mt-1 relative">
               <input type="number" id="precio" name="precio" placeholder="Escribe el precio" wire:model="cform.precio"
                  class="block w-full pr-10 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
               <i class="fa-solid fa-dollar-sign absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
            <x-input-error for="cform.precio" />
         </div>

         <!-- Tipo de Curso -->
         <div class="relative">
            <label for="tipo_curso" class="block text-sm font-medium text-gray-700">Tipo de Curso</label>
            <div class="mt-1 relative">
               <select id="tipo_curso" name="tipo_curso" wire:model="cform.type_id"
                  class="block w-full pr-10 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  <option value="">Selecciona un tipo</option>
                  @foreach ($types as $tipo)
                     <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                  @endforeach
               </select>
               <i class="fa-solid fa-book absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
            <x-input-error for="cform.type_id" />
         </div>
         <!-- Tags (Checkbox) -->
         <div>
            <label class="block text-sm font-medium text-gray-700">Tags</label>
            <div class="mt-2 space-x-4">
               @foreach($tags as $tag)
               <label class="inline-flex items-center" for="c{{$tag->id}}">
                  <input id="c{{$tag->id}}"  type="checkbox" name="tags[]" value="{{$tag->id}}" wire:model="cform.tags" class="form-checkbox h-4 w-4 text-indigo-600">
                  <span class="ml-2 text-gray-700">#{{$tag->nombre}}</span>
               </label>
               @endforeach
   
            </div>
            <x-input-error for="cform.tags" />
         </div>
         <!-- Imagen -->
         <label class="block text-sm font-medium text-gray-700">Imagen</label>
         <div class="h-80 w-full relative bg-gray-200">
            <input id="cimagen" type="file" accept="image/*" wire:model="cform.imagen" class="hidden" />
            <label for="cimagen" 
            class="text-white font-semibold p-2 rounded-xl bg-gray-600 hover:bg-black absolute end-2 bottom-2">
               <i class="fas fa-upload mr-2"></i>SUBIR
            </label>
            @if($cform->imagen)
            <img src="{{$cform->imagen->temporaryUrl()}}" class="size-full bg-center bg-no-repeat bg-cover" />
            @endif
         </div>
         <x-input-error for="cform.imagen" />
      </x-slot>
      <x-slot name="footer">
         <!-- Botones -->
         <div class="flex justify-end space-x-4">
            <button wire:click="store"
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
</div>