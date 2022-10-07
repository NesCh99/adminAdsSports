<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campeonato;
use App\Models\Deporte;
use App\Models\Video;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeporteController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.deportes.index')->only('index');
        $this->middleware('can:admin.deportes.create')->only('create');
        $this->middleware('can:admin.deportes.edit')->only('edit');
        $this->middleware('can:admin.deportes.show')->only('show');
        $this->middleware('can:admin.deportes.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->input('search')){
            $search = '%'.$request->input('search').'%';
            $deportes = Deporte::where('NombreDep', 'like', $search)
            ->orderBy('CreacionDep', 'asc')->paginate(10);
        }else{
            $deportes = Deporte::orderBy('CreacionDep', 'asc')->paginate(10);
        }
        return view('admin.deportes.index', compact('deportes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.deportes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request -> validate([ // Valida los datos enviados desde el formulario en create
            'Nombre'=>'required|unique:deportes,NombreDep',
            'Descripcion'=>'required',
            'Portada' => 'required|image|max:5000'
        ]);


      //  $portada = Storage::disk('public')->put('deportes', $request->file('Portada'));//Guarda la imagen en public/deportes y devuelve el url
        $portada = Storage::url( $request->file('Portada')->store('public/imagenes'));//Guarda la imagen en public/deportes y devuelve el url
         

      
        $deporte = Deporte::create([ //Crea el registro en la tabla
            'NombreDep' => $request->input('Nombre'),
            'PortadaDep' => $portada,
            'DescripcionDep' => $request->input('Descripcion'),
        ]);       
        
        return redirect()->route('admin.deportes.index', $deporte)->with('info', $deporte->NombreDep.' ha sido registrado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Deporte $deporte)
    {
        $campeonatos = $deporte->campeonatos; // Relacion construida en el modelo
                                 //Funcion campeonatos en el modelo deportes
        return view('admin.deportes.show', compact(['deporte', 'campeonatos']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Deporte $deporte)
    {        
        return view('admin.deportes.edit', compact('deporte'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deporte $deporte)
    {
        $request -> validate([
            'Nombre'=>"required|unique:deportes,NombreDep,$deporte->idDeporte,idDeporte",
            'Descripcion'=>'required',
            'Portada' => 'image|max:5000'
        ]);
        
        if($request->file('Portada')){
            Storage::disk('public')->delete($deporte->PortadaDep);
            $portada = Storage::disk('public')->put('deportes', $request->file('Portada'));
        }else{
            $portada = $deporte->PortadaDep;
        }

        $deporte->update([
            'NombreDep' => $request->input('Nombre'),
            'DescripcionDep' => $request->input('Descripcion'),
            'PortadaDep' => $portada,
        ]);
        return redirect()->route('admin.deportes.show', $deporte)->with('info', $deporte->NombreDep. ' se ha actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deporte $deporte)
    {
        $campeonatos = $deporte->campeonatos;
        if($campeonatos->count() > 0){
            foreach($campeonatos as $campeonato){
                $precio = $campeonato->videos->where('PrecioVid','>','0');
            }
            if($precio->count() > 0){
                return 'No se puede eliminar';
                return redirect()->route('admin.deportes.index')->with('info', $deporte->NombreDep.' posee videos con precio, no se permite eliminar');
            }
            else{
                return 'Si se puede eliminar';
                $deporte -> delete();
            }
        }else{
            return 'No posee campeonatos';
            $deporte -> delete();
            return redirect()->route('admin.deportes.index')->with('info', $deporte->NombreDep.' se ha eliminado con éxito');
        }   
    }
}
