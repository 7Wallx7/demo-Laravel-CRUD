<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Event;
use App\Models\Tipe_event;
class TipeEventController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }


    public function index(){

        $all_tipe_events= Tipe_event::all();

        return view('tipe_events.index',compact('all_tipe_events')) ;
    }

    public function store(Request $request){

        $tipe_event= new Tipe_event();

        //Si existe el Tipo de evento mandar alerta
        // Sino guardar los datos
        $this->validate($request, [
            'nombre' => ['required', 'string', 'max:255','unique:tipe_event'],
            'background' => ['required', 'string'],
            'color_text' => ['required', 'string'],
            'border' => ['required', 'string']
        ],
        // Errores personalizados
        [
            'nombre.unique' => 'Nombre de Tipo de Evento duplicado'
        ]);

        //Asignamos cada valor al Tipo de Evento
        $tipe_event-> nombre= $request->nombre;
        $tipe_event-> background= $request->background;
        $tipe_event-> color_text= $request->border;
        $tipe_event-> border= $request->color_text;

        $tipe_event->save();

        return redirect()->route('tipe_events.index');
    }
    public function update(Request $request,$id){

        $tipe_event = Tipe_event::find($id);


        $this->validate($request, [
            'nombre' => ['required', 'string',  Rule::unique('tipe_event')->ignore($tipe_event->id)]
        ],
        // Errores personalizados
        [
            'nombre.unique' => 'Nombre de Tipo de Evento duplicado'

        ]);
        $tipe_event->update([
            'nombre' => $request->nombre,
            'background' => $request->background,
            'color_text' => $request->color_text,
            'border' => $request->border

        ]);

        $tipe_event -> update($request ->all());

        return redirect()->route('tipe_events.index');
    }

    public function destroy($id){

        $tipe_event = Tipe_event::find($id);

        $tipe_event -> delete();

        return redirect()->route('tipe_events.index');
    }
}
