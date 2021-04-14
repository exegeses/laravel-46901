<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel de administración de marcas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

            <!-- contenido -->
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-2">

                    @if ( session('mensaje') )
                        <!-- alert -->
                            <div class="w-3/4 mx-auto text-sm text-green-600 bg-green-100 border border-green-400 h-12 flex items-center p-4 rounded-sm relative" role="alert">
                            <span class="mr-1">
                            <svg class="fill-current text-green-500 inline-block h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path class="heroicon-ui" d="M15 19a3 3 0 0 1-6 0H4a1 1 0 0 1 0-2h1v-6a7 7 0 0 1 4.02-6.34 3 3 0 0 1 5.96 0A7 7 0 0 1 19 11v6h1a1 1 0 0 1 0 2h-5zm-4 0a1 1 0 0 0 2 0h-2zm0-12.9A5 5 0 0 0 7 11v6h10v-6a5 5 0 0 0-4-4.9V5a1 1 0 0 0-2 0v1.1z"/>
                            </svg>
                            </span>
                                <span>
                                <strong class="mr-1">{{ session('mensaje') }}</strong>
                            </span>
                            </div>
                            <!-- fin alert -->
                    @endif

                        <div class="w-3/4 mx-auto">
                            <div class="bg-white shadow-md rounded my-6">
                                <table class="text-left w-full border-collapse">
                                    <thead>
                                    <tr>
                                        <th class="py-4 px-6 bg-gray-100 font-bold uppercase text-sm text-grey-dark border-b border-grey-light">#</th>
                                        <th class="py-4 px-6 bg-gray-100 font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Marca</th>
                                        <th class="py-4 px-6 bg-gray-100 font-bold uppercase text-sm text-grey-dark border-b border-grey-light" colspan="2">
                                            <a href="/agregarMarca" class="bg-transparent hover:bg-gray-400 text-gray-800 hover:text-white py-2 px-4 border border-gray-400 hover:border-transparent rounded mr-2">
                                                Agregar
                                            </a>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $marcas as $marca )
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-4 px-6 border-b">{{ $marca->idMarca }}</td>
                                            <td class="py-4 px-6 border-b">{{ $marca->mkNombre }}</td>
                                            <td class="py-4 px-6 border-b">
                                                <a href="/modificarMarca/{{ $marca->idMarca }}" class="bg-transparent hover:bg-gray-400 text-gray-800 hover:text-white py-2 px-4 border border-gray-400 hover:border-transparent rounded mr-2">
                                                    Modificar
                                                </a>
                                            </td>
                                            <td class="py-4 px-6 border-b">
                                                <a href="/eliminarMarca/{{ $marca->idMarca }}" class="bg-transparent hover:bg-gray-400 text-gray-800 hover:text-white py-2 px-4 border border-gray-400 hover:border-transparent rounded mr-2">
                                                    Eliminar
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>

                            {{ $marcas->links() }}

                        </div>

                    </div>
                    </div>
                </div>
            <!-- fin contendido -->

            </div>
        </div>
    </div>
</x-app-layout>
