<x-app-layout>
    <x-self.base>
        <div class="w-1/2 mx-auto p-8 rounded-xl border-2 border-black shadow-2xl">
        <form action="{{route('tags.store')}}" method="POST">
            @csrf
            <x-label value="Nombre" class="mb-1" />
            <x-input type='text' class="w-full" name="nombre" value="{{@old('nombre')}}" />
            <x-input-error for="nombre" />
            <x-label value="Color" class="mt-4 mb-1" />
            <x-input type='color' class="w-full" name="color" value="{{@old('color')}}" />
            <x-input-error for="color" />
            <div class="flex flex-row-reverse mt-4">
                <x-button><i class="fas fa-save mr-2"></i>Guardar</x-button>
                <x-button type="button" class="mr-4"><i class="fas fa-xmark mr-2"></i>
                <a href="/tags">Cancelar</a>
                </x-button>
            </div>
        </form>
        </div>
    </x-self.base>
</x-app-layout>