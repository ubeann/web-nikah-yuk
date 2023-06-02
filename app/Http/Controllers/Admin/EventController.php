<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller {
    public function index() {
        $events = Event::orderBy('date', 'desc')->paginate(10);
        return view('admin.event.index', compact('events'));
    }

    public function detail($id) {
        $event = Event::findOrFail($id);
        $guests = $event->guests()->orderBy('created_at', 'desc')->paginate(10, ['*'], 'guests');
        $photos = $event->photos()->orderBy('created_at', 'desc')->paginate(12, ['*'], 'photos');
        return view('admin.event.detail', compact('event', 'guests', 'photos'));
    }

    public function editForm($id) {
        $event = Event::findOrFail($id);
        return view('admin.event.edit', compact('event'));
    }

    public function edit(Request $request, $id) {
        $event = Event::findOrFail($id);
        $event->name = $request->name;
        $event->service = $request->service;
        $event->date = $request->date;
        $event->location = $request->location;
        $event->description = $request->description;
        $event->save();
        return redirect()->route('admin.event.index')->with('success', 'Berhasil mengubah event ' . $event->name);
    }

    public function confirmed($id) {
        $event = Event::findOrFail($id);

        if($event->status == 'canceled')
            return redirect()->route('admin.event.index')->with('error', 'Event ' . $event->name . ' telah dibatalkan');

        $event->status = 'confirmed';
        if ($event->guest_url === null) {
            $uuid = Str::random(10);
            $existingEvent = Event::where('guest_url', $uuid)->exists();

            while ($existingEvent) {
                $uuid = Str::random(10);
                $existingEvent = Event::where('guest_url', $uuid)->exists();
            }

            $event->guest_url = $uuid;
        }
        $event->save();

        return redirect()->route('admin.event.index')->with('success', 'Berhasil mengkonfirmasi event ' . $event->name);
    }

    public function rejected($id) {
        $event = Event::findOrFail($id);

        if($event->status == 'canceled')
            return redirect()->route('admin.event.index')->with('error', 'Event ' . $event->name . ' telah dibatalkan');

        $event->status = 'rejected';
        $event->save();
        return redirect()->route('admin.event.index')->with('success', 'Berhasil menolak event ' . $event->name);
    }

    public function delete($id) {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('admin.event.index')->with('success', 'Berhasil menghapus event ' . $event->name);
    }
}
