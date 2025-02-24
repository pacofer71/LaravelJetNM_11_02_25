<x-app-layout>
    <x-self.base>
        <h3 class="text-center text-2xl">Formulario de Contacto</h3>
        <div class="mt-4 w-1/2 mx-auto p-4 rounded-2xl shadow-2xl border-2 border-gray-500">
            <form action="{{route('contacto.send')}}" method="POST">
                @csrf
                <x-label value="Nombre" />
                <x-input type="text" class="my-2 w-full" name="name" value="{{@old('name')}}" />
                <x-input-error for="name" />
                @guest
                <x-label value="Email" />
                <x-input type="email" class="my-2 w-full" name="email" value="{{@old('email')}}" />
                <x-input-error for="email" />
                @endguest
                <x-label value="Comentario" />
                <textarea rows="5" name="comentario" class="w-full">{{old('comentario')}}</textarea>
                <x-input-error for="comentario" />
                <div class="flex flex-row-reverse mt-4">
                    <x-button type="submit">
                        <i class="fas fa-plane mr-2"></i>ENVIAR
                    </x-button>
                    <x-button type="button" class="mr-2">
                    <i class="fas fa-xmark mr-2"></i>
                    <a href="/">CANCELAR</a>
                    </x-button>
                </div>
            </form>

        </div>
    </x-self.base>
</x-app-layout>