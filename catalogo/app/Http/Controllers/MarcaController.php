<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Producto;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //obtenemos listado de marcas
        //$marcas = Marca::all();
        $marcas = Marca::paginate(7);
        //retornamos vista pasando datos
        return view('adminMarcas',
                    [ 'marcas'=>$marcas ]
                );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agregarMarca');
    }
    ##############################################
    #### validación
    /**
     * @param Request $request
     */
    private function validar(Request $request): void
    {
        $request->validate(
            [
                'mkNombre' => 'required|min:2|max:30'
            ],
            [
                'mkNombre.required' => 'El campo "Nombre de la marca", es obligatorio',
                'mkNombre.min' => 'El campo "Nombre de la marca" debe tener al menos 2 caractéres.',
                'mkNombre.max' => 'El campo "Nombre de la marca" debe tener 30 caractéres como máximo.'
            ]
        );
    }
    ##############################################


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mkNombre = $request->mkNombre;
        //validación
        $this->validar($request);
        //instanciación, asignación, guardado
        $Marca = new Marca;
        $Marca->mkNombre = $mkNombre;
        $Marca->save();
        //redirección con mensaje ok
        return redirect('/adminMarcas')
                    ->with(
                        [
                            'mensaje'=>'Marca: '.$mkNombre.' agregada correctamente',
                        ]
                    );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //obtenemos datos de una marca
        $Marca = Marca::find($id);
        //returnamos vista del form
        return view('modificarMarca',
                    [ 'Marca'=>$Marca ]
                );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $mkNombre = $request->mkNombre;
        //validación
        $this->validate($request);
        //datos de una marca
        $Marca = Marca::find($request->idMarca);
        //asignamos
        $Marca->mkNombre = $mkNombre;
        //guardamos
        $Marca->save();
        //redirección con mensaje ok
        return redirect('/adminMarcas')
            ->with(
                [
                    'mensaje'=>'Marca: '.$mkNombre.' modificada correctamente',
                ]
            );
    }

    private function checkProducto($id)
    {
        //$check = Producto::where('idMarca', $id)->first();
        $check = Producto::firstWhere('idMarca', $id);
        //$check = Producto::where('idMarca', $id)->count();
        return $check;
    }
    public function confirmarBaja($id)
    {
        //obtener datos de una marca
        $Marca = Marca::find($id);
        //chequear si hay productos de ese marca
        if( !$this->checkProducto($id) ){
            return view('/eliminarMarca', [ 'Marca'=>$Marca ]);
        }
        return redirect('/adminMarcas')
            ->with(
                [
                    'mensaje'=>' No se puede eliminar la marca: '.$Marca->mkNombre.' ya que tiene productos relacionados.'
                ]
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $idMarca = $request->idMarca;
        $mkNombre = $request->mkNombre;
        Marca::destroy($idMarca);

        return redirect('/adminProductos')->with('mensaje', 'Marca: '. $mkNombre. ' borrado correctamente');
    }

}
