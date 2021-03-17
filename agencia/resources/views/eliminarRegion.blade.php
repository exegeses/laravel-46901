@extends('layouts.plantilla')

    @section('contenido')
        <h1>Baja de una región</h1>

        <div class="bg-light border-secondary col-6 mx-auto
                    shadow rounded p-4 text-danger">
            Se eliminará la región:
            <span class="lead">{{ 'regNombre' }}</span>
            <form action="/eliminarRegion" method="post">
                <input type="hidden" name="regNombre"
                       value="{{ 'regNombre' }}">
                <input type="hidden" name="regID"
                       value="{{ 'regID' }}">
                <button class="btn btn-danger btn-block my-3">
                    Confirmar baja
                </button>
                <a href="/adminRegiones" class="btn btn-outline-secondary btn-block">
                    Volver a panel
                </a>
            </form>
        </div>
        <script>

        </script>

    @endsection
