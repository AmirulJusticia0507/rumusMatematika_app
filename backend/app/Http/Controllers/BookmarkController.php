<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function toggle(Request $request, string $jenis)
    {
        $exists = Bookmark::where('user_id', auth()->id())
            ->where('rumus_title', $jenis)
            ->first();

        if ($exists) {
            $exists->delete();
            $bookmarked = false;
        } else {
            Bookmark::create([
                'user_id' => auth()->id(),
                'rumus_title' => $jenis,
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
