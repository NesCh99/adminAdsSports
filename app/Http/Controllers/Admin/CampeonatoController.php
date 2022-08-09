<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campeonato;
use App\Models\Deporte;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CampeonatoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.campeonatos.index')->only('index');
        $this->middleware('can:admin.campeonatos.create')->only('create');
        $this->middleware('can:admin.campeonatos.edit')->only('edit');
        $this->middleware('can:admin.campeonatos.show')->only('show');
        $this->middleware('can:admin.campeonatos.destroy')->only('destroy');
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
            $campeonatos = Campeonato::where('NombreCam', 'like', $search)
            ->orderBy('FechaInicioCam', 'asc')->paginate(10);
        }else{
            $campeonatos = Campeonato::orderBy('FechaInicioCam', 'asc')->paginate(10);
        }
        return view('admin.campeonatos.index', compact('campeonatos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $deportes = Deporte::pluck('NombreDep','idDeporte')->toArray(); //envia el array de todos los deportes, sirve para el select
        return view('admin.campeonatos.create', compact('deportes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datenow = date("Y-m-d"); //Fecha de hoy, para la validación
        $request -> validate([
            'Nombre'=>'required|unique:campeonatos,NombreCam',
            'Descripcion'=>'required',
            'FechaInicio'=>'required|after_or_equal:'.$datenow, //La fecha ingresada no puede ser menor a la de hoy
            'Descuento'=>'required',
            'Portada' => 'required|image|max:5000',
            'Deporte' => 'required'
            
        ]);
        $portada = Storage::disk('public')->put('campeonatos', $request->file('Portada'));
        $campeonato = Campeonato::create([
            'idDeporte' => $request->input('Deporte'),
            'NombreCam' => $request->input('Nombre'),
            'DescripcionCam' => $request->input('Descripcion'),
            'FechaInicioCam' => $request->input('FechaInicio'),
            'PortadaCam' => $portada,
            'DescuentoCam' => $request->input('Descuento')
            
        ]);
        return redirect()->route('admin.campeonatos.index', $campeonato)->with('info', $campeonato->NombreCam.' se ha registrado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Campeonato $campeonato)
    {
        $deporte = $campeonato->deporte;
        $videos = $campeonato->videos;

        return view('admin.campeonatos.show', compact(['campeonato', 'videos', 'deporte']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Campeonato $campeonato)
    {
        $deportes = Deporte::pluck('NombreDep','idDeporte')->toArray();
        return view('admin.campeonatos.edit', compact(['campeonato', 'deportes']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Campeonato $campeonato)
    {
        $datenow = substr($campeonato->created_at, 0, 10);
        $request -> validate([
            'NombreCam'=>"required|unique:campeonato,NombreCam,$campeonato->idCampeonato,idCampeonato",
            'DescripcionCam'=>'required',
            'FechaInicioCam'=>'required|after_or_equal:'.$datenow,
            'PortadaCam' => 'image|max:5000',
            'Descuento'=>'required',
            
            
        ]);
        if($request->file('PortadaCam')){
            Storage::delete($campeonato->PortadaCam);
            $portada = Storage::put('campeonatos', $request->file('PortadaCam'));
            $datos = $request->except('PortadaCam');
            $datos['PortadaCam'] = $portada;
        }else{
            $datos = $request->except('PortadaCam');
        }
        
        $campeonato->update($datos);
        return redirect()->route('admin.campeonatos.show', $campeonato)->with('info', 'El campeonato: '.$campeonato->NombreCam.' se ha actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campeonato $campeonato)
    {
        $precio = $campeonato->videos->where('PrecioVid', '>', '0');
        if($precio->count()>0){
            return 'No se puede Eliminar, tiene videos con precio';
        }else{
            return 'Si se puede eliminar, no tiene videos con precio';
            $campeonato->delete();
            return redirect()->route('admin.campeonatos.index')->with('info', $campeonato->NombreCam.' se ha eliminado con éxito');
        } 
    }
}
