<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Tipe_event;
use Illuminate\Validation\Rule;
class EventController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }


    public function index(){

        $all_events= Event::all();
        $tipe_events= Tipe_event::all();
        $events=[];


        //Recorremos todos los eventos
        foreach ($all_events as $event){

            //Obtenemos los valores del tipo de evento en concreto
            $tipe_eventName = Tipe_event::where('id',$event->id_tipe_event)->get('id');
            $tipe_eventBackground = Tipe_event::where('id',$event->id_tipe_event)->get('background')[0]->background;
            $tipe_eventText = Tipe_event::where('id',$event->id_tipe_event)->get('color_text')[0]->color_text;
            $tipe_eventBorder = Tipe_event::where('id',$event->id_tipe_event)->get('border')[0]->border;

            //Asignamos los valores a cada evento
            $events[]=[
                'id'=> $event->id,
                'title'=> $event->event,
                'start'=> $event->start_date,
                'end'=> $event->end_date,
                'id_tipe_event'=> $tipe_eventName,
                'backgroundColor'=> $tipe_eventBackground,
                'textColor'=>   $tipe_eventText,
                'borderColor'=> $tipe_eventBorder,
            ];
        }


        return view('events.index',compact('events','tipe_events'));
    }

    public function store(Request $request){

        $event= new Event();

        //Si existe el Evento mandar alerta
        // Sino guardar los datos
        $this->validate($request, [
            'event' => ['required', 'string', 'max:255','unique:event'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'string'],
            'id_tipe_event' => ['required', 'numeric']
        ],
        // Errores personalizados
        [
            'event.unique' => 'Nombre de Evento duplicado'
        ]);


        //Asignamos cada valor al Evento
        $event-> event= $request->event;
        $event-> start_date= $request->start_date;
        $event-> end_date= $request->end_date;
        $event-> id_tipe_event= $request->id_tipe_event;

        $event->save();

        return redirect()->route('events.index');
    }
    public function update(Request $request,$id){

        $event = Event::find($id);


        $this->validate($request, [
            'event' => ['required', 'string', Rule::unique('event')->ignore($event->id)],
            'start_date' => ['required', 'string', Rule::unique('event')->ignore($event->id)],
            'end_date' => ['required', 'string', Rule::unique('event')->ignore($event->id)]
        ],
        // Errores personalizados
        [
            'event.unique' => 'Nombre de Email duplicado'

        ]);
        $event->update([
            'event' => $request->event,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'id_tipe_event' => $request->id_tipe_event

        ]);

        return redirect()->route('events.index');
    }

    public function destroy($id){

        $event = Event::find($id);

        $event -> delete();

        return redirect()->route('events.index');
    }
}
