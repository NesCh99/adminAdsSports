<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campeonato;
use App\Models\MetaDato;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.videos.index')->only('index');
        $this->middleware('can:admin.videos.create')->only('create');
        $this->middleware('can:admin.videos.edit')->only('edit');
        $this->middleware('can:admin.videos.show')->only('show');
        $this->middleware('can:admin.videos.destroy')->only('destroy');
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
            $videos = Video::where('NombreVid', 'like', $search)
            ->orderBy('FechaInicioVid', 'asc')->paginate(8);
        }else{
            $videos = Video::orderBy('FechaInicioVid', 'asc')->paginate(8);
        }        
        return view('admin.videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $campeonatos = Campeonato::pluck('NombreCam','idCampeonato')->toArray();
        return view('admin.videos.create', compact('campeonatos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datenow = date("Y-m-d");//Variable con la fecha actual
        $request -> validate([ //Valida las entradas de datos
            'Nombre'=>'required|unique:videos,NombreVid',
            'Descripcion'=>'required',
            'Fecha'=>'required|after_or_equal:'.$datenow,
            'Portada' => 'required|image|max:5000',
            'Precio'=>'required',
            'Campeonato' => 'required'
        ]);      
        $portada = Storage::disk('public')->put('videos', $request->file('Portada'));
        $video = Video::create([
            'idCampeonato' => $request->input('Campeonato'),
            'NombreVid' => $request->input('Nombre'),
            'PortadaVid' => $portada,
            'DescripcionVid' => $request->input('Descripcion'),
            'FechaInicioVid' => $request->input('Fecha'),
            'HoraInicioVid' => $request->input('Hora'),
            'PrecioVid' => $request->input('Precio'),
            'EstadoVid' => '1'

        ]);
        return redirect()->route('admin.videos.show', $video)->with('info', $video->NombreVid.' se ha registrado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        $campeonato = $video->campeonato;
        $deporte = $campeonato->deporte;
        $metadato = $video->metadato;
        
        return view('admin.videos.show', compact(['video', 'campeonato', 'deporte', 'metadato']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        $campeonatos = Campeonato::pluck('NombreCam','idCampeonato')->toArray();
        return view('admin.videos.edit', compact(['video', 'campeonatos']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        $datenow = substr($video->created_at, 0, 10); //Variable que toma la fecha de creacion del video
        $request -> validate([
            'Nombre'=>"required|unique:videos,NombreVid,$video->idVideo,idVideo",
            'Descripcion'=>'required',
            'FechaInicio'=>'required|after_or_equal:'.$datenow,
            'Portada' => 'image|max:5000',
            'Precio'=>'required'
        ]);
        if($request->file('Portada')){
            Storage::disk('public')->delete($video->PortadaVid);
            $portada = Storage::put('videos', $request->file('Portada'));
        }else{
            $portada = $video->PortadaVid;
        }
        
        $video->update([
            'idCampeonato' => $request->input('Campeonato'),
            'NombreVid' => $request->input('Nombre'),
            'PortadaVid' => $portada,
            'DescripcionVid' => $request->input('Descripcion'),
            'FechaInicioVid' => $request->input('Fecha'),
            'HoraInicioVid' => $request->input('Hora'),
            'PrecioVid' => $request->input('Precio'),

        ]);
        return redirect()->route('admin.videos.edit', $video)->with('info', $video->NombreVid.' se ha actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        if($video->PrecioVid > 0){
            return 'Video no se puede eliminar, tiene precio';
        }else{
            return 'Video Si se puede eliminar, sin precio';
            $video->delete();
            return redirect()->route('admin.videos.index')->with('info', $video->NombreVid.' se ha eliminado con éxito');
        }

    }

    public function createLiveStream($idVideo){
        $video = Video::find($idVideo);        
        return view('admin.videos.createLiveStream', compact('video'));
    }

    /**
     * Funcion para crear el Live Stream
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idVideo
     * @return \Illuminate\Http\Response
     */
    public function storeLiveStream(Request $request){
        //require __DIR__ . '/vendor/autoload.php';

        $apikey = 'vtn1DDWBF38K8F7maYCODQi6lUw9TdwpKhIoPOwnzgH';
        
        $client = new \ApiVideo\Client\Client(
            'https://sandbox.api.video',
            $apikey, 
            new \Symfony\Component\HttpClient\Psr18Client()
        );

        $liveStream = $client->liveStreams()->create((new \ApiVideo\Client\Model\LiveStreamCreationPayload())
        ->setRecord(true) // Whether you are recording or not. True for record, false for not record.
        ->setName($request->input('Nombre')) // Add a name for your live stream here.
        ->setPublic(true) // Whether your video can be viewed by everyone, or requires authentication to see it. 
        ->setPlayerId($request->input('PlayerID'))); // The unique identifier for the player. 
        $metadata = json_decode($liveStream);
        $metadato = MetaDato::create([
        'idVideo' => $request->input('idVideo'),
        'StreamKeyMetaDato' => $metadata->streamKey,
        'LiveStreamIdMetaDato' => $metadata->liveStreamId,
        'PlayerMetaDato' => $metadata->assets->player
        ]);    
        $video = Video::find($request->input('idVideo'));
        return view('admin.videos.retrieveLiveStream', compact(['video','metadato']));
    }

    public function retrieveLiveStream($idVideo){
        $apikey = 'vtn1DDWBF38K8F7maYCODQi6lUw9TdwpKhIoPOwnzgH';
        
        $client = new \ApiVideo\Client\Client(
            'https://sandbox.api.video',
            $apikey, 
            new \Symfony\Component\HttpClient\Psr18Client()
        );
        $video = Video::find($idVideo);
        $idLiveStream = $video->metadato->LiveStreamIdMetaDato;
        $liveStream = $client->liveStreams()->get($idLiveStream);
        return view('admin.videos.retrieveLiveStream', compact('video'));

    }

}
