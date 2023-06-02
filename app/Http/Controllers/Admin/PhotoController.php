<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller {
    public function index() {
        $photos = Photo::orderBy('created_at', 'desc')->paginate(12);
        $events = Event::orderBy('name', 'asc')->get();
        return view('admin.photo.index', compact('photos', 'events'));
    }

    public function upload(Request $request) {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'photos' => 'required|array',
            'photos.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $event = Event::find($request->event_id);

        foreach ($request->photos as $photo) {
            $path = $photo->store('photos', 'public');
            Photo::create([
                'event_id' => $event->id,
                'filename' => $photo->getClientOriginalName(),
                'url' => 'storage/' . $path,
            ]);
        }

        return redirect()->back()->with('success', 'Photos uploaded on event ' . $event->name . ' successfully.');
    }

    public function delete($id) {
        $photo = Photo::find($id);
        $filename = $photo->filename;

        if (!$photo) {
            return redirect()->back()->with('error', 'Photo not found.');
        }

        Storage::disk('public')->delete(str_replace('storage/', '', $photo->url));

        $photo->delete();

        return redirect()->back()->with('success', 'Photo ' . $filename . ' deleted successfully.');
    }
}
