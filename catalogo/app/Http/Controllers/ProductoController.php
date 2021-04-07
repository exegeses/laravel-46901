<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //listado de productos
        $productos = Producto::with('relMarca', 'relCategoria')
                                ->paginate(8);
        return view('adminProductos',
                    [ 'productos'=>$productos ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //listados de marcas y categorías
        $marcas = Marca::all();
        $categorias = Categoria::all();
        return view('agregarProducto',
            [
                'marcas'=>$marcas,
                'categorias'=>$categorias
            ]
        );
    }

    private function validar(Request $request)
    {
        $request->validate(
            [
                'prdNombre'=>'required|min:3|max:70',
                'prdPrecio'=>'required|numeric|min:0',
                'prdPresentacion'=>'required|min:3|max:150',
                'prdStock'=>'required|integer|min:1',
                'prdImagen'=>'mimes:jpg,jpeg,png,gif,svg,webp|max:2048'
            ],
            [
                'prdNombre.required'=>'Complete el campo Nombre',
                'prdNombre.min'=>'Complete el campo Nombre con al menos 3 caractéres',
                'prdNombre.max'=>'Complete el campo Nombre con 70 caractéres como máxino',
                'prdPrecio.required'=>'Complete el campo Precio',
                'prdPrecio.numeric'=>'Complete el campo Precio con un número',
                'prdPrecio.min'=>'Complete el campo Precio con un número positivo',
                'prdPresentacion.required'=>'Complete el campo Presentación',
                'prdPresentacion.min'=>'Complete el campo Presentación con al menos 3 caractéres',
                'prdPresentacion.max'=>'Complete el campo Presentación con 150 caractérescomo máxino',
                'prdStock.required'=>'Complete el campo Stock',
                'prdStock.integer'=>'Complete el campo Stock con un número entero',
                'prdStock.min'=>'Complete el campo Stock con un número positivo',
                'prdImagen.mimes'=>'Debe ser una imagen',
                'prdImagen.max'=>'Debe ser una imagen de 2MB como máximo'
            ]
        );
    }

    private function subirImagen(Request $request)
    {
        //si no enviaron imagen en método store()
        $prdImagen = 'noDisponible.jpg';

        //si no enviaron imagen en método update()
        if( $request->has('orgImagen') ){
            $prdImagen = $request->orgImagen;
        }

        //si enviaron imagen
        if( $request->file('prdImagen') ){
            //renombrar
                # time() . extension
             $ext = $request->file('prdImagen')->extension();
             $prdImagen = time().'.'.$ext;
            //subir archivo
            $request
                    ->file('prdImagen')
                    ->move( public_path('productos/'), $prdImagen );
        }

        return $prdImagen;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prdNombre = $request->prdNombre;
        //validación
        $this->validar($request);
        //subir imagen
        $prdImagen = $this->subirImagen($request);
        //instanciar
        $Producto = new Producto;
        //asignar
        $Producto->prdNombre = $prdNombre;
        $Producto->prdPrecio = $request->prdPrecio;
        $Producto->idMarca = $request->idMarca;
        $Producto->idCategoria = $request->idCategoria;
        $Producto->prdPresentacion = $request->prdPresentacion;
        $Producto->prdStock = $request->prdStock;
        $Producto->prdImagen = $prdImagen;
        //guardar
        $Producto->save();
        //redirección + mensaje ok
        return redirect('/adminProductos')
            ->with('mensaje', 'Producto: '. $prdNombre. ' agregado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $marcas = Marca::all();
        $categorias = Categoria::all();
        $Producto = Producto::find($id);
        return view('modificarProducto',
                    [
                        'marcas'=>$marcas,
                        'categorias'=>$categorias,
                        'Producto'=>$Producto
                    ]
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $prdNombre = $request->prdNombre;
        //validar
        $this->validar($request);
        //subir imagen
        $prdImagen = $this->subirImagen($request);
        //obtener objeto, asignar atributos, guardar
        $Producto = Producto::find( $request->idProducto );
        $Producto->prdNombre = $prdNombre;
        $Producto->prdPrecio = $request->prdPrecio;
        $Producto->idMarca = $request->idMarca;
        $Producto->idCategoria = $request->idCategoria;
        $Producto->prdPresentacion = $request->prdPresentacion;
        $Producto->prdStock = $request->prdStock;
        $Producto->prdImagen = $prdImagen;
        $Producto->save();
        //rediercción + mensaje ok
        return redirect('/adminProductos')
            ->with('mensaje', 'Producto: '. $prdNombre. ' modificado correctamente');
    }

    public function confirmarBaja($id)
    {
        $Producto = Producto::find($id);
        return view('eliminarProducto',
                    [ 'Producto'=>$Producto ]
                );
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $idProducto = $request->idProducto;
        $prdNombre = $request->prdNombre;
        # Producto::find($idProducto)->delete();
        Producto::destroy($idProducto);
        return redirect("/adminProductos")
            ->with( ["mensaje"=>"Producto '.$prdNombre.' eliminado correctamente"]);

    }
}
