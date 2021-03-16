<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
##Route::get( petición, acción );
Route::get('/saludo', function()
{
    return 'hola mundo!';
});
Route::get('/uno', function ()
{
    return view('primera');
});
Route::get('/dos', function ()
{
    $nombre = 'marcos';
    return view('segunda',
                [
                    'nombre'=>$nombre,
                    'limite'=>15,
                    'alemanes'=>[
                                    'Audi', 'BMW',
                                    'Porsche',
                                    'Mercedes Benz'
                                ]
                ]
            );
});
Route::get('/form', function ()
{
    return view('formulario');
});
Route::post('/procesa', function ()
{
    $nombre = $_POST['nombre'];
    return view('procesa',
                [ 'nombre'=>$nombre ]
            );
});
################################
### Plantilla Blade
Route::get('/inicio', function ()
{
    return view('inicio');
});

##################################
###### CRUD de regiones
Route::get('/adminRegiones', function ()
{
  /*
    $regiones = DB::select(
                    'SELECT regID, regNombre
                        FROM regiones'
                );
  */
    $regiones = DB::table('regiones')
                    ->get();
    return view('adminRegiones',
                    [ 'regiones'=>$regiones ]
            );
});
Route::get('/agregarRegion', function ()
{
    return view('agregarRegion');
});
Route::post('/agregarRegion', function ()
{
    //capturamos datos enviados por el form
    $regNombre = $_POST['regNombre'];
    //insertamos datos
    /*
    DB::insert('INSERT INTO regiones
                        ( regNombre )
                    VALUES
                        ( :regNombre )',
                [ $regNombre ] );
    */
    DB::table('regiones')->insert([ 'regNombre'=>$regNombre ]);
    //redireccionamos con mensaje ok
    return redirect('/adminRegiones')
                ->with( ['mensaje'=>'Region: '.$regNombre.' agregada correctamente'] );
});
##################################
###### CRUD de Destinos
Route::get('/adminDestinos', function ()
{
   /*
    $destinos = DB::select("
                    SELECT destID, destNombre,
                        destinos.regID, regNombre,
                        destPrecio
                    FROM regiones, destinos
                    WHERE destinos.regID = regiones.regID
                ");
    */
/*
    SELECT  destID, destNombre, r.regNombre
        FROM destinos d
        INNER JOIN regiones r
        ON d.regID = r.regID
*/
    $destinos = DB::table('destinos as d')
                    ->join('regiones as r', 'r.regID', '=', 'd.regID')
                    ->get();

    return view('adminDestinos',
                [ 'destinos'=>$destinos ]
            );
});
