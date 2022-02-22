<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actividad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActividadController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:actividades.index')->only('index');
        $this->middleware('can:actividades.create')->only(['create','store']);
        $this->middleware('can:actividades.edit')->only(['edit','update']);
        $this->middleware('can:actividades.show')->only(['show']);
        $this->middleware('can:actividades.destroy')->only(['destroy']);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actividades = Actividad::query()->paginate(5);
        return view('admin.actividad.index',compact('actividades'))       
                ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.actividad.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$validacion=$request->validate([
            'actividad'=> 'required|unique:actividades'
        ]);*/
        $validacion=Validator::make($request->all(),[
            'actividad'=> 'required|unique:actividades'
        ]);

        if($validacion->fails()){
            return redirect()->route('actividades.index')->with('error','La actividad ya se encuentra registrada o esta en blanco');
        }      
       
        Actividad::create($request->all());
        return redirect()->route('actividades.index')->with('success','Actividad agregada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function show(Actividad $actividad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function edit(Actividad $actividad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Actividad $actividad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Actividad $actividad)
    {
        //
    }
}
