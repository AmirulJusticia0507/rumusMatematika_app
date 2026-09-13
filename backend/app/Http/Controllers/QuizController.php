<?php

namespace App\Http\Controllers;

use App\Models\QuizScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    private array $bank = [
        'Penjumlahan' => [
            'emoji' => '➕',
            'soal' => [
                ['q' => 'Berapakah hasil dari 25 + 37?', 'pil' => ['52', '62', '72', '42'], 'jwb' => 1],
                ['q' => 'Berapakah hasil dari 123 + 456?', 'pil' => ['569', '579', '589', '599'], 'jwb' => 1],
                ['q' => 'Bilangan yang membuat 45 + ... = 80 adalah?', 'pil' => ['35', '45', '25', '55'], 'jwb' => 0],
                ['q' => 'Berapakah hasil dari 1.004 + 896?', 'pil' => ['1.900', '1.800', '1.700', '2.000'], 'jwb' => 0],
                ['q' => 'Berapakah hasil dari 99 + 1?', 'pil' => ['98', '100', '110', '90'], 'jwb' => 1],
            ],
        ],
        'Perkalian' => [
            'emoji' => '✖️',
            'soal' => [
                ['q' => 'Berapakah hasil dari 7 × 8?', 'pil' => ['54', '56', '48', '64'], 'jwb' => 1],
                ['q' => 'Berapakah hasil dari 12 × 11?', 'pil' => ['121', '132', '122', '131'], 'jwb' => 1],
                ['q' => 'Berapakah hasil dari 25 × 4?', 'pil' => ['90', '100', '110', '80'], 'jwb' => 1],
                ['q' => 'Hasil dari 0 × 9.999 adalah...', 'pil' => ['9.999', '1', '0', '10.000'], 'jwb' => 2],
                ['q' => 'Hasil dari 15 × 6 ÷ 3 adalah...', 'pil' => ['20', '30', '15', '45'], 'jwb' => 1],
            ],
        ],
        'Geometri Bangun Datar' => [
            'emoji' => '📐',
            'soal' => [
                ['q' => 'Luas persegi dengan sisi 8 cm adalah...', 'pil' => ['32 cm²', '64 cm²', '16 cm²', '48 cm²'], 'jwb' => 1],
                ['q' => 'Keliling persegi panjang (p = 10, l = 6) adalah...', 'pil' => ['60', '32', '16', '24'], 'jwb' => 1],
                ['q' => 'Luas segitiga dengan alas 12 dan tinggi 5 adalah...', 'pil' => ['60', '30', '17', '24'], 'jwb' => 1],
                ['q' => 'Luas lingkaran dengan jari-jari 7 (π = 22/7) adalah...', 'pil' => ['154', '44', '1540', '22'], 'jwb' => 0],
                ['q' => 'Bangun datar dengan 4 sisi sama panjang dan 4 sudut siku-siku adalah...', 'pil' => ['Persegi panjang', 'Persegi', 'Jajargenjang', 'Belah ketupat'], 'jwb' => 1],
            ],
        ],
        'Persamaan Linear Satu Variabel' => [
            'emoji' => '🧮',
            'soal' => [
                ['q' => 'Jika x + 7 = 15, maka nilai x adalah...', 'pil' => ['8', '22', '7', '15'], 'jwb' => 0],
                ['q' => 'Jika 3x = 21, maka nilai x adalah...', 'pil' => ['3', '7', '18', '24'], 'jwb' => 1],
                ['q' => 'Jika 2x + 5 = 17, maka nilai x adalah...', 'pil' => ['5', '6', '7', '8'], 'jwb' => 1],
                ['q' => 'Jika x - 4 = 11, maka nilai x adalah...', 'pil' => ['7', '15', '44', '11'], 'jwb' => 1],
                ['q' => 'Persamaan linear satu variabel memiliki pangkat tertinggi variabelnya yaitu...', 'pil' => ['0', '1', '2', '3'], 'jwb' => 1],
            ],
        ],
        'Trigonometri Dasar' => [
            'emoji' => '📏',
            'soal' => [
                ['q' => 'Nilai dari sin 30° adalah...', 'pil' => ['1/2', '√3/2', '1', '0'], 'jwb' => 0],
                ['q' => 'Nilai dari cos 60° adalah...', 'pil' => ['1/2', '√3/2', '1', '0'], 'jwb' => 0],
                ['q' => 'Nilai dari tan 45° adalah...', 'pil' => ['0', '1/2', '1', '√3'], 'jwb' => 2],
                ['q' => 'Nilai dari sin 0° adalah...', 'pil' => ['0', '1', '1/2', '√2/2'], 'jwb' => 0],
                ['q' => 'Pada segitiga siku-siku, sin θ = ...', 'pil' => ['sisi miring / depan', 'depan / sisi miring', 'samping / miring', 'depan / samping'], 'jwb' => 1],
            ],
        ],
        'Fungsi Kuadrat' => [
            'emoji' => '📈',
            'soal' => [
                ['q' => 'Akar-akar dari f(x) = x² - 4x + 3 adalah...', 'pil' => ['1 dan 3', '-1 dan -3', '1 dan -3', '-1 dan 3'], 'jwb' => 0],
                ['q' => 'Jika f(x) = x² + 1, maka nilai f(2) adalah...', 'pil' => ['3', '4', '5', '6'], 'jwb' => 2],
                ['q' => 'Grafik fungsi kuadrat berbentuk...', 'pil' => ['Garis lurus', 'Parabola', 'Lingkaran', 'Hiperbola'], 'jwb' => 1],
                ['q' => 'Diskriminan dirumuskan sebagai D = b² - 4ac. Jika D > 0, maka...', 'pil' => ['Dua akar real berbeda', 'Dua akar kembar', 'Tidak punya akar real', 'Satu akar real'], 'jwb' => 0],
                ['q' => 'Titik potong sumbu-y dari f(x) = x² - 2x - 3 adalah...', 'pil' => ['(0, -2)', '(0, 2)', '(0, -3)', '(0, 3)'], 'jwb' => 2],
            ],
        ],
    ];

    public function index()
    {
        $list = [];
        foreach ($this->bank as $materi => $data) {
            $best = auth()->check() ? auth()->user()->bestScore($materi) : null;
            $list[] = [
                'title' => $materi,
                'emoji' => $data['emoji'],
                'soalCount' => count($data['soal']),
                'best' => $best ? $best->score : null,
            ];
        }

        return view('kuis.index', ['kuis' => $list]);
    }

    public function show(string $jenis)
    {
        $quiz = $this->bank[$jenis] ?? null;

        if ($quiz === null) {
            abort(404);
        }

        return view('kuis.show', ['jenis' => $jenis, 'soal' => $quiz['soal']]);
    }

    public function submit(Request $request, string $jenis)
    {
        $quiz = $this->bank[$jenis] ?? null;

        if ($quiz === null) {
            abort(404);
        }

        $jawaban = $request->input('jawaban', []);

        $score = 0;
        $total = count($quiz['soal']);
        $details = [];

        foreach ($quiz['soal'] as $index => $soal) {
            $userAnswer = isset($jawaban[$index]) ? (int) $jawaban[$index] : null;
            $correct = $userAnswer !== null && $userAnswer === $soal['jwb'];

            if ($correct) {
                $score++;
            }

            $details[] = [
                'q' => $soal['q'],
                'pil' => $soal['pil'],
                'jwb' => $soal['jwb'],
                'user' => $userAnswer,
                'correct' => $correct,
            ];
        }

        $saved = false;
        if (auth()->check()) {
            QuizScore::create([
                'user_id' => auth()->id(),
                'materi' => $jenis,
                'score' => $score,
                'total' => $total,
            ]);
            $saved = true;
        }

        $leaderboard = QuizScore::where('materi', $jenis)
            ->select('user_id', DB::raw('MAX(score) as best'))
            ->with('user:id,name,photo')
            ->groupBy('user_id')
            ->orderByDesc('best')
            ->limit(10)
            ->get();

        $history = auth()->check()
            ? auth()->user()->quizScores()->where('materi', $jenis)->orderByDesc('created_at')->take(5)->get()
            : collect();

        return view('kuis.hasil', [
            'jenis' => $jenis,
            'emoji' => $quiz['emoji'],
            'score' => $score,
            'total' => $total,
            'details' => $details,
            'saved' => $saved,
            'leaderboard' => $leaderboard,
            'history' => $history,
        ]);
    }
}
