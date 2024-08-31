<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();

        return view('welcome', ['events' => $events]);
    }

    public function create() {
        return view('events.create');
    }

    public function store(request $request) {
        
        $event = new Event;

        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items;

        // image upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now") . "." . $extension);
            // puxa o nome original da imagem + hora de agora + extensão do arquivo

            $requestImage->move(public_path('img/events'), $imageName);
            // move a pasta para esse diretório, com esse nome

            $event->image = $imageName;
        }

        $user = auth()->user();
        // puxa o user logado
        $event->user_id = $user->id;

        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso');

    }

    public function show($id) {
        $event = Event::findOrFail($id);

        $eventOwner = User::where('id', $event->user_id)->first();
        // puxa o user com id = id_user(relacionado ao evento puxado), pega só o primeiro(só tem um)

        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner]);
    }

    public function dashboard() {
        $user = auth()->user();

        $events = $user->events;
        // user tem vários eventos


        $eventsAsParticipant = $user->eventsAsParticipant;

        return view('events.dashboard', 
                    ['events' => $events, 'eventsasparticipant' => $eventsAsParticipant]);
    }

    public function destroy($id) {

        $event = Event::findOrFail($id);
        
        $user = auth()->user();
        
        if ($user->id != $event->user_id) {
            return redirect('/dashboard');
        }

        Event::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso');
    }
    
    public function edit($id) {

        $event = Event::findOrFail($id);
        
        $user = auth()->user();
        
        if ($user->id != $event->user_id) {
            return redirect('/dashboard');
        }

        return view('events.edit', ['event' => $event]);

    }

    public function update(Request $request) {

        $data = $request->all();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now") . "." . $extension);
            // puxa o nome original da imagem + hora de agora + extensão do arquivo

            $requestImage->move(public_path('img/events'), $imageName);
            // move a pasta para esse diretório, com esse nome

            $data['image'] = $imageName;
        }

        Event::findOrFail($request->id)->update($data);
        // findOrFail puxa um objeto, update request all atualiza esse objeto com todos
        // os dados das requisições passadas
        return redirect('/dashboard')->with('msg', 'Evento editado com sucesso');
    }
    
    public function joinEvent($id) {

        $user = auth()->user();

        $eventsAsParticipant = $user->eventsAsParticipant;

        $event = Event::findOrFail($id);

        foreach ($eventsAsParticipant as $eventAsParticipant) {
            if ($eventAsParticipant->id == $id) {
                return redirect('/dashboard')->with('msg', 'Você já está inscrito no evento ' . $event->title);
            }
        }

        $user->eventsAsParticipant()->attach($id);

        return redirect('/dashboard')->with('msg', 'Sua presença foi confirmada no evento ' . $event->title);
    }

    public function leaveEvent($id) {
        $user = auth()->user();

        $event = Event::findOrFail($id);

        $user->eventsAsParticipant()->detach($id);


        return redirect('/dashboard')->with('msg', 'Presença retirada do evento ' . $event->title);
    }
}
