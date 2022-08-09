<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campeonato;
use App\Models\Cliente;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Extension\DescriptionList\Parser\DescriptionTermContinueParser;
use Throwable;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::paginate(10);
        return view('admin.clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        $suscripcionesVideos = $cliente->suscripciones()->wherePivot('TipoSus','=','2')->get();  
        $videos = Video::whereNotIn('idVideo',$suscripcionesVideos->pluck('idVideo')->toArray())->get();
        return view('admin.clientes.show', compact(['cliente', 'videos', 'suscripcionesVideos']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    public function subscribeVideo($idCliente, $idVideo)
    {
        $cliente = Cliente::findOrFail($idCliente);
        $video = Video::find($idVideo);
        $cliente->suscripciones()->attach($video,['TipoSus'=>'2','CreacionSus'=>Carbon::now()]);
        return redirect()->route('admin.clientes.show', $cliente)->with('info', 'Se entrego la suscripción a '.$video->NombreVid);
    }

    public function unsubscribeVideo($idCliente, $idVideo){
        $video = Video::find($idVideo);
        $video->suscripciones()->detach($idCliente);
        $cliente = Cliente::find($idCliente);
        return redirect()->route('admin.clientes.show', $cliente)->with('info', 'Se quito la suscripción a '.$video->NombreVid);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
