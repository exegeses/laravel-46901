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
Route::get('/modificarRegion/{id}', function ($id)
{
    //obtenemos datos de la región por si id
    $region = DB::table('regiones')
                    ->where( 'regID', $id )
                    ->first();

    //returnamos vista con los datos
    return view('modificarRegion',
                    [ 'region'=>$region ]
              );
});
Route::post('/modificarRegion', function ()
{
    //capturamos datos desde el form
    $regID = $_POST['regID'];
    $regNombre = $_POST['regNombre'];
    //modificamos
    /*
    DB::update('UPDATE regiones
                    SET regNombre = ?
                  WHERE regID = ?',
                [ $regNombre, $regID ]
                );
    */
    DB::table('regiones')
            ->where( 'regID', $regID )
            ->update( [ 'regNombre'=>$regNombre ] );
    //redireccionamos con mensaje de ok
    return redirect('/adminRegiones')
            ->with( ['mensaje'=>'Region: '.$regNombre.' modificada correctamente'] );
});
Route::get('/eliminarRegion/{id}', function ($id)
{
    //obtenemos datos de la región a eliminar
    $region = DB::table('regiones')
                    ->where('regID', $id)
                    ->first();
    //retornamos vista de confirmacion pasando datos
    return view('eliminarRegion',
                    [ 'region'=>$region ]
                );
});
Route::post('/eliminarRegion', function ()
{
    //capturamos datos en viados por el form
    $regNombre = $_POST['regNombre'];
    $regID = $_POST['regID'];
    //borramos la región
    /*
    DB::delete('DELETE FROM regiones
                    WHERE regID = :regID',
                    [ $regID ]
              );
    */
    DB::table('regiones')
            ->where('regID', $regID)
            ->delete();
    //redireccionamos con mensaje de ok
    return redirect('/adminRegiones')
        ->with( ['mensaje'=>'Region: '.$regNombre.' eliminada correctamente'] );

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
Route::get('/agregarDestino', function ()
{
    //obtenemos listado de regiones
    $regiones = DB::table('regiones')->get();
    return view('agregarDestino',
                [ 'regiones'=>$regiones ]
            );
});
Route::post('/agregarDestino', function()
{
    //capturamos datos enviados por el form
    $destNombre = $_POST['destNombre'];
    $regID = $_POST['regID'];
    $destPrecio = $_POST['destPrecio'];
    $destAsientos = $_POST['destAsientos'];
    $destDisponibles = $_POST['destDisponibles'];
    //insertar datos
    DB::table('destinos')
            ->insert(
                [
                'destNombre'=>$destNombre,
                'regID'=>$regID,
                'destPrecio'=>$destPrecio,
                'destAsientos'=>$destAsientos,
                'destDisponibles'=>$destDisponibles
                ]
            );
    //redireccion + mensaje de ok
    return redirect('/adminDestinos')
                ->with([ 'mensaje'=>'Destino: '.$destNombre.' agregado correctamente' ]);
});
