<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{
    public function index()
    {
        $search = request("search"); // obetendo o item da pesquisa

        if ($search) {
            $events = Event::where([
                ["title", "like", "%" . $search . "%"] // Coluna pesquisada - tipos de pesquisa - query
            ])->get(); // obtém os resultados
        } else {
            $events = Event::all();
        }


        return view('welcome', ["events" => $events, "search" => $search]);
    }

    public function create()
    {
        return view("events.create");
    }

    public function products()
    {
        return view("product");
    }

    public function contacts()
    {
        return view("contact");
    }

    public function store(Request $request)
    {
        //propriedades form
        $event = new Event();

        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items;

        //upload image
        if ($request->hasFile("image") && $request->file("image")->isValid()) { // verificação da img
            $requestImage = $request->image;
            $extension = $requestImage->extension(); // pega a extensão

            //nome relativo do path no db
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now") . "." . $extension);

            $requestImage->move(public_path("img/events"), $imageName); // move a imagem para a pasta selecionada com o nome especificado

            $event->image = $imageName;

            //Salvando o id do user autenticado no evento criado
            $user = auth()->user();
            $event->user_id = $user->id;

        }

        $event->save();

        return redirect("/")->with("msg", "Evento criado com sucesso");
    }

    public function show($id)
    {
        //Procura o evento do id passado
        $event = Event::findOrFail($id);

        //Busca o user com o mesmo id do evento->pega o primeiro resultado->retorn em array
        $eventOwner = User::where("id", $event->user_id)->first()->toArray();

        //verifica se já se cadastrou no evento
        $user = auth()->user();

        $hasUserJoined = false;

        if ($user) {
            $userEvents = $user->eventsAsParticipant->toArray();

            foreach ($userEvents as $userEvent) {
                if ($userEvent["id"] == $id) {
                    $hasUserJoined = true;
                }
            }
        }

        return view("events.show", ["event" => $event, "eventOwner" => $eventOwner, "hasUserJoined" => $hasUserJoined]);
    }

    public function dashboard(){
        $user = auth()->user();

        $events = $user->events;

        //Mostrando os eventos que o user participa
        $eventsAsParticipant = $user->eventsAsParticipant; // basicamente irá buscar os usuários que tenham ligação com o evento especificado

        return view('events.dashboard', ['events' => $events, "eventsAsParticipant" => $eventsAsParticipant]);

    }

    public function destroy($id)
    {
        Event::findOrFail($id)->delete(); // encontrou os dados e deletou

        return redirect("/dashboard")->with("msg", "Evento Excluído"); // redireciona com msg
    }

    public function edit($id)
    {
       $user = auth()->user();

       $event = Event::findOrFail($id);

       if ($user->id != $event->user_id) {
            return redirect("/dashboard");
       }

       return view("events.edit", ["event" => $event]);
    }

    public function update(Request $request)
    {
        //atualizar imagem
        $data = $request->all();

        $requestImage = $request->image;
            $extension = $requestImage->extension(); // pega a extensão

            //nome relativo do path no db
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now") . "." . $extension);

            $requestImage->move(public_path("img/events"), $imageName); // move a imagem para a pasta selecionada com o nome especificado

            $data['image'] = $imageName;


        //pega todos os dados com a propriedade Request e através dela fara o tratamento -pegou todos os dados de maneira direta
        Event::findOrFail($request->id)->update($data);

       return redirect("/dashboard")->with("msg", "Evento editado com sucesso!");
    }

    public function teste()
    {
        return view("teste");
    }

    public function joinEvent($id)
    {
        $user = auth()->user(); // User autenticado

        $user->eventsAsParticipant()->attach($id); // vai inserir o id do evento no id do user na tabela de many to many - junto do attach

        $event = Event::findOrFail($id);

        return redirect("/dashboard")->with("msg", "Presença confimada no evento" . $event->title);

    }

    public function leaveEvent($id)
    {
       $user = auth()->user();

       $user->eventsAsParticipant()->detach($id); // tirando a ligação do user com o evento

       $event = Event::findOrFail($id);

       return redirect("/dashboard")->with("msg", "Você saiu do evento" . $event->title);
    }

}
