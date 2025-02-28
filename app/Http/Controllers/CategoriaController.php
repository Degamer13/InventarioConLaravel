<?php


namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;


class CategoriaController extends Controller
{

    function __construct() {

         // Permisos para Categorías
    $this->middleware('permission:categoria-list|categoria-create|categoria-edit|categoria-delete', ['only' => ['index', 'store']]);
    $this->middleware('permission:categoria-show', ['only' => ['show']]);
    $this->middleware('permission:categoria-create', ['only' => ['create', 'store']]);
    $this->middleware('permission:categoria-edit', ['only' => ['edit', 'update']]);
    $this->middleware('permission:categoria-delete', ['only' => ['destroy']]);

    }
     public function index(Request $request)
    
    {
        $buscarpor=$request->get('buscarpor');
        $categorias = Categoria::where('nombre','like','%'.$buscarpor.'%')->paginate(4);
    return view('categorias.index',compact('categorias', 'buscarpor'));

    }
    public function create(){

        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nombre' => 'required|unique:categorias,nombre']);
        $categorias= Categoria::create($request->all());

        return redirect()->route("categorias.index")->with("success","Categoria registrada con éxito");

    }

    public function show(Categoria $categoria)
    {
        //return $categoria;
    }
   public function edit(string $id)
    {
        $categoria = Categoria::find($id);

        return view('categorias.edit',compact('categoria'));
    }


    public function update(Request $request, Categoria $categoria)
    {
        $request->validate(['nombre' => 'required']);
        $categoria->update($request->all());
        return redirect()->route("categorias.index")->with("success","Categoria actualizada con éxito");    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
         return redirect()->route("categorias.index")->with("success","Categoria eliminada con éxito");
    }
}
