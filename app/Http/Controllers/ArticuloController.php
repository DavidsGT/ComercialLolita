<?php

namespace comercial\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use comercial\Http\Requests;
use comercial\http\Requests\ArticuloFormRequest;
use comercial\Articulo;
use DB;

class ArticuloController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
    		if ($request){
    			$query=trim($request->get('searchText'));
    			$articulos=Articulo::where(DB::raw("CONCAT(`codigo`,' ',`nombre`,' ',`descripcion`)"),'LIKE','%'.$query.'%')
                            ->where('estado',true)
                            ->orderBy('codigo')
                			->paginate(12);
    			return view('almacen.articulo.index',["articulo"=>$articulos,"searchText"=>$query]);
    		}
    }

    public function indexstock(Request $request) 
    {
        if ($request){
         try
            {
                $query=trim($request->get('searchText'));
                $articulos=DB::table('articulo as a')
                ->join('pg_detalle as c','a.idcategoria','=','c.id')
            ->select('a.idarticulo','a.nombre','a.codigo','a.stock','a.stockmin','c.descripcion as categoria','a.descripcion','a.imagen','a.estado','a.iva')
                ->whereColumn('a.stock','<=','a.stockmin')
                ->where('a.nombre','LIKE','%'.$query.'%')
                ->orderBy('a.idarticulo','desc')
                ->paginate(7);
            }
        catch(\Illuminate\Database\QueryException $e)
            {
            return 'existe un error' + $e;
            }
                return view('almacen.stockmin.indexstock',["stock"=>$articulos,"searchText"=>$query]);

            }
    }

	public function create()
    {
    	$categorias=DB::table('categoria')->where('condicion','=','1')->get();
    	return view('almacen.articulo.create',["categorias"=>$categorias]);

    }

    public function store(ArticuloFormRequest $request)
    {
    	$articulo=new Articulo;
    	$articulo->idcategoria=$request->get('idcategoria');
    	$articulo->codigo=$request->get('codigo');
    	$articulo->nombre=$request->get('nombre');
    	$articulo->stock=$request->get('stock');
        $articulo->stockmin=$request->get('stockmin');
    	$articulo->descripcion=$request->get('descripcion');
    	$articulo->estado='Activo';
        $articulo->iva=$request->get('iva');

    	if (Input::exists('imagen')) {
    		$file=Input::file('imagen');
    		$file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
    		$articulo->imagen=$file->getClientOriginalName();
    	}

    	$articulo->save();
    	return Redirect::to('almacen/articulo');
    }

    public function show($id)
    {
    	return view("almacen.articulo.show",["articulo"=>Articulo::findOrFail($id)]);
       // return view("almacen.categoria.show",["categoria"=>Categoria::findOrFail($id)]);

    }

    public function edit($id)
    {
    	$articulo=Articulo::findOrFail($id);
    	$categorias=DB::table('categoria')->where('condicion','=','1')->get();
    	
        return view("almacen.articulo.edit",["articulo"=>$articulo,"categorias"=>$categorias]);
    }

    public function update(ArticuloFormRequest $request,$id)
    {
    	$articulo=Articulo::findOrFail($id);
    	
    	$articulo->idcategoria=$request->get('idcategoria');
    	$articulo->codigo=$request->get('codigo');
    	$articulo->nombre=$request->get('nombre');
    	$articulo->stock=$request->get('stock');
        $articulo->stockmin=$request->get('stockmin');
    	$articulo->descripcion=$request->get('descripcion');
        $articulo->iva=$request->get('iva');
    	
    	if (Input::exists('imagen')) {
    		$file=Input::file('imagen');
    		$file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
    		$articulo->imagen=$file->getClientOriginalName();
    	}
    	$articulo->update();

    	return Redirect::to('almacen/articulo');
    }

    public function destroy($id)
    {

    	$articulo=Articulo::findOrFail($id);
		$articulo->estado='Inactivo';
		$articulo->update();

    	return Redirect::to('almacen/articulo');
    }
}
