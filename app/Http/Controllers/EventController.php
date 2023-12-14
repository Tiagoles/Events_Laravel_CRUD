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

        $event = new Event();
        $event->title  = $request->title;
        $event->city = $request->city;
        $event->private = $request->privateOrPublic;
        $event->description = $request->descriptionEvent;
        $event->image = $request->image;
        $event->date = $request->date;
        $event->items = $request->items;

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
    }
    public function show($id)
    {

        $event = Event::findOrFail($id);
        $eventOwner = User::where("id", $event->user_id)->first()->toArray();
        $user = auth()->user();
        $eventsAsParticipant = $user->eventsAsParticipant;
        return view("events.show", ["event" => $event, "eventOwner" => $eventOwner, "user" => $user, "eventsAsParticipant" => $eventsAsParticipant]);
    }
    public function dashboard()
    {
        $user = auth()->user();
        $events = $user->events;
        $eventsAsParticipant = $user->eventsAsParticipant;
        return view("events.dashboard", ["events" => $events, "eventsAsParticipant" => $eventsAsParticipant]);
    }
    public function destroy($id)
    {
        Event::findOrFail($id)->delete();
        return redirect("/dashboard")->with("success", "Evento deletado com sucesso!");
    }
    public function update(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile("image")) {
            $requestImage = $request->file("image")->getClientOriginalName();
            $filename = pathinfo($requestImage, PATHINFO_FILENAME);
            $extension = $request->file("image")->getClientOriginalExtension();
            $fileNameToStore = $filename . "_" . time() . "." . $extension;
            $image = $request->file("image");
            $image->move(public_path("img/events"), $fileNameToStore);
            $data['image'] = $fileNameToStore;
        } else {
            $data['image'] = "/img/banner.jpg";
        }
        Event::findOrFail($request->id)->update($data);
        return redirect("/dashboard")->with("msg", "Evento editado com sucesso");
    }
    public function joinEvent($id)
    {
        $user = auth()->user();
        $user->eventsAsParticipant()->attach($id);
        $event =  Event::findOrFail($id);
        return redirect("/events/$id")->with("success", "Presença confirmada em " . ucfirst($event->title));
    }
    public function leaveEvent($id)
    {
        $user = auth()->user();
        $event = Event::findOrFail($id);
        $user->eventsAsParticipant()->detach($event->$id);
        return redirect("/events/{$id}")->with("success", "Presença removida com sucesso !");
    }
}