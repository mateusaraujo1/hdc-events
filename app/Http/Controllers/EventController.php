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

        return view('events.dashboard', ['events' => $events]);
    }

    public function destroy($id) {

        Event::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso');
    }

    public function edit($id) {

        $event = Event::findOrFail($id);

        return view('events.edit', ['event' => $event]);

    }
}
