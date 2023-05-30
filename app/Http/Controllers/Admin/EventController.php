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
}
