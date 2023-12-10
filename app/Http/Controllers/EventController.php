<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{
    public function index()
    {
        $search = request("search");
        if ($search) {
            $events = Event::Where([
                ["title", "like", "%" . $search . "%"]
            ])->get();
        } else {
            $events = Event::all();
        }
        return view("welcome", ["events" => $events, "search" => $search]);
    }
    public function create()
    {
        return view("events.Create");
    }
    public function store(Request $request)
    {
        try {
            $event = new Event();
            $fields = ["title", "city", "private", "description", "image", "date", "items"];
            foreach ($fields as $field) {
                if ($request->filled($field)) {
                    $event->{$field} = $request->{$field};
                } else {
                    return redirect("/events/create")->with("error", "O campo $field é obrigatório");
                }
            }
            if ($request->hasFile("image")) {
                $requestImage = $request->file("image")->getClientOriginalName();
                $filename = pathinfo($requestImage, PATHINFO_FILENAME);
                $extension = $request->file("image")->getClientOriginalExtension();
                $fileNameToStore = $filename . "_" . time() . "." . $extension;
                $image = $request->file("image");
                $image->move(public_path("img/events"), $fileNameToStore);
                $event->image = $fileNameToStore;
            } else {
                $event->image = "/img/banner.jpg";
            }

            $user = auth()->user();
            $event->user_id = $user->id;
            $event->save();
            return redirect("/")->with("success", "Evento criado com Sucesso!");
        } catch (\Exception $e) {
            return redirect("/events/create")->with("error", "Não foi possível criar o evento." . $e->getMessage());
        }
    }
    public function show($id)
    {
        $event = Event::findOrFail($id);
        $eventOwner = User::where("id", $event->user_id)->first()->toArray();
        return view("events.show", ["event" => $event, "eventOwner" => $eventOwner]);
    }
    public function dashboard()
    {
        $user = auth()->user();
        $events = $user->events;
        return view("events.dashboard", ["events" => $events]);
    }
    public function destroy($id)
    {
        Event::findOrFail($id)->delete();
        return redirect("/dashboard")->with("success", "Evento deletado com sucesso!");
    }
    public function update(Request $request){
        
        try {
            $data = $request->all();
            $filteredRequest = array_filter($data, function($value) {
                if (!is_null($value) && $value !== ''){
                    return !is_null($value) && $value !== '';
                } else {
                    return redirect("/dashboard")->with("error", "Preencha todos os campos!");
                }
            });

            if ($request->hasFile("image")) {
                $requestImage = $request->file("image")->getClientOriginalName();
                $filename = pathinfo($requestImage, PATHINFO_FILENAME);
                $extension = $request->file("image")->getClientOriginalExtension();
                $fileNameToStore = $filename . "_" . time() . "." . $extension;
                $image = $request->file("image");
                $image->move(public_path("img/events"), $fileNameToStore);
                $data["image"] = $fileNameToStore;
            } else {
                $data["image"] = "/img/banner.jpg";
            }


            Event::findOrFail($request->id)->update($filteredRequest);
            return redirect("/dashboard")->with("success", "Dados alterados com sucesso!");
        } catch (\Exception $e) {
            return redirect("/dashboard")->with("error", "Não foi possivel alterar os dados");
        }
    }
}
