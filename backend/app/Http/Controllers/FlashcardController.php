<?php

namespace App\Http\Controllers;

use App\Models\FlashcardProgress;
use Illuminate\Http\Request;

class FlashcardController extends Controller
{
    public function index(RumusController $rumusController)
    {
        $jenjang = in_array(request('jenjang'), ['SD', 'SMP', 'SMA'], true) ? request('jenjang') : 'semua';

        $rumus = $rumusController->buildList();

        if ($jenjang !== 'semua') {
            $rumus = array_values(array_filter($rumus, fn ($item) => $item['jenjang'] === $jenjang));
        }

        $progress = auth()->check()
            ? auth()->user()->flashcardProgress()->pluck('known', 'rumus_title')
            : collect();

        return view('flashcard.index', compact('jenjang', 'rumus', 'progress'));
    }

    public function progress(Request $request)
    {
        $jawaban = $request->input('jawaban', []);

        if (empty($jawaban)) {
            auth()->user()->flashcardProgress()->delete();

            return redirect(route('flashcard.index'))->with('status', 'Progres flashcard dihapus.');
        }

        foreach ($jawaban as $title => $known) {
            FlashcardProgress::updateOrCreate(
                ['user_id' => auth()->id(), 'rumus_title' => $title],
                ['known' => (bool) $known],
            );
        }

        return redirect(route('flashcard.index'))->with('status', 'Progres flashcard tersimpan! 🃏');
    }
}
