<x-self.base>
<h3 class="text-center txt-xl">Listado de Tipos</h3>
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
                    <td class="px-6 py-4">
                       Acciones
                    </td>

                </tr>
                @endforeach

            </tbody>
        </table>
</x-self.base>
