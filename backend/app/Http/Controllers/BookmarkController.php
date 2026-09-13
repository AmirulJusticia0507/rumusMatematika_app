<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Rumus;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function toggle(Request $request, Rumus $rumus)
    {
        $exists = Bookmark::where('user_id', auth()->id())
            ->where('rumus_title', $rumus->title)
            ->first();

        if ($exists) {
            $exists->delete();
            $bookmarked = false;
        } else {
            Bookmark::create([
                'user_id' => auth()->id(),
                'rumus_title' => $rumus->title,
            ]);
            $bookmarked = true;
        }

        return back()->with('status', $bookmarked ? 'Rumus disimpan ke favorit! ⭐' : 'Rumus dihapus dari favorit.');
    }

    public function index(RumusController $rumusController)
    {
        $titles = auth()->user()->bookmarks()->orderByDesc('updated_at')->pluck('rumus_title')->toArray();

        $rumus = $rumusController->forFavorites($titles);

        return view('favorit.index', ['rumus' => $rumus]);
    }
}
