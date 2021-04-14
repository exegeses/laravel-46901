<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Administración de marcas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                    <div class="mt-1">



                        <div class="w-3/4 mx-auto">
                            <div class="bg-gray-50 shadow-md rounded p-6">

                            <form action="/agregarMarca" method="post">
                                @csrf
                                <div class="mb-4">
                                    <label for="mkNombre">Nombre de la marca</label>
                                    <input type="text" name="mkNombre"
                                           value="{{ old('mkNombre') }}"
                                           class="shadow appearance-none w-full border border-gray-300 rounded py-2 px-3 text-grey-darker" id="mkNombre">
                                </div>

                                <button class="bg-gray-900 hover:bg-gray-700 font-semibold text-white hover:text-white-50 py-2 px-4 border border-gray-400 hover:border-transparent rounded mr-2">
                                    Agregar marca
                                </button>
                                <a href="/adminMarcas" class="bg-transparent hover:bg-gray-400 text-gray-800 font-semibold hover:text-white py-2 px-4 border border-gray-400 hover:border-transparent rounded mr-2">
                                    Volver a panel
                                </a>
                            </form>

                            </div>
                        </div>

                        @if ( $errors->any() )
                            <div class="space-x-2 bg-red-50 rounded flex items-start text-red-600 my-4 mx-auto max-w-2xl shadow-lg">
                                <div class="w-1 self-stretch bg-red-300">

                                </div>
                                <ul class="p-4">
                                    @foreach ( $errors->all() as $error )
                                        <li class="flex space-x-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-5" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.5 5h3l-1 10h-1l-1-10zm1.5 14.25c-.69 0-1.25-.56-1.25-1.25s.56-1.25 1.25-1.25 1.25.56 1.25 1.25-.56 1.25-1.25 1.25z"/></svg>
                                            <span class="pl-2">{{ $error }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif




                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
