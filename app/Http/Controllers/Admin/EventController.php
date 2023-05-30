<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller {
    public function index() {
        $events = Event::orderBy('date', 'desc')->paginate(10);
        return view('admin.event.index', compact('events'));
    }

    public function detail($id) {
        $event = Event::findOrFail($id);
        return view('admin.event.detail', compact('event'));
    }

    public function confirmed($id) {
        $event = Event::findOrFail($id);

        if($event->status == 'canceled')
            return redirect()->route('admin.event.index')->with('error', 'Event ' . $event->name . ' telah dibatalkan');

        $event->status = 'confirmed';
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
