<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\FlashcardProgress;
use App\Models\QuizScore;
use App\Models\Rumus;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'rumusTotal' => Rumus::count(),
            'rumusPerJenjang' => Rumus::selectRaw('jenjang, count(*) as total')
                ->groupBy('jenjang')
                ->orderBy('jenjang')
                ->get()
                ->pluck('total', 'jenjang'),
            'userTotal' => User::count(),
            'adminTotal' => User::where('is_admin', true)->count(),
            'bookmarkTotal' => Bookmark::count(),
            'quizTotal' => QuizScore::count(),
            'flashTotal' => FlashcardProgress::count(),
            'latestRumus' => Rumus::orderByDesc('updated_at')->take(5)->get(),
        ]);
    }
}
