<?php

namespace App\Http\Controllers;

class RumusController extends Controller
{
    private array $rumusDetail = [
        'Penjumlahan' => [
            'rumus' => 'a + b = c<br>a + b = c',
            'keterangan' => 'Penjumlahan dua bilangan a dan b menghasilkan hasil c.',
        ],
        'Pengurangan' => [
            'rumus' => 'a - b = c<br>a - b = c',
            'keterangan' => 'Pengurangan bilangan a dengan b menghasilkan hasil c.',
        ],
        'Perkalian' => [
            'rumus' => 'a × b = c<br>a × b = c',
            'keterangan' => 'Perkalian bilangan a dan b menghasilkan hasil c.',
        ],
        'Pembagian' => [
            'rumus' => 'a / b = c (dengan b ≠ 0)<br>b ≠ 0',
            'keterangan' => 'Pembagian bilangan a dengan b menghasilkan hasil c (syarat b tidak boleh nol).',
        ],
        'Bilangan Cacah' => [
            'rumus' => '0, 1, 2, 3, 4, …',
            'keterangan' => 'Bilangan cacah adalah bilangan yang dimulai dari 0 dan seterusnya.',
        ],
        'Bilangan Bulat' => [
            'rumus' => '…, -3, -2, -1, 0, 1, 2, 3, …',
            'keterangan' => 'Bilangan bulat terdiri dari bilangan positif, negatif, dan nol.',
        ],
        'Bilangan Pecahan' => [
            'rumus' => 'p/q (dengan q ≠ 0)',
            'keterangan' => 'Pecahan terdiri dari pembilang p dan penyebut q, dengan syarat penyebut tidak boleh nol.',
        ],
        'Bilangan Desimal' => [
            'rumus' => 'Contoh: 1.5, 2.75, 0.4, -3.25',
            'keterangan' => 'Bilangan desimal dituliskan dengan tanda titik desimal.',
        ],
        'Pengukuran Panjang' => [
            'rumus' => '1 m = 100 cm<br>1 km = 1000 m<br>1 m = 10 dm<br>1 cm = 10 mm',
            'keterangan' => 'Konversi satuan panjang.',
        ],
        'Pengukuran Berat' => [
            'rumus' => '1 kg = 1000 g<br>1 ton = 1000 kg<br>1 g = 1000 mg',
            'keterangan' => 'Konversi satuan berat.',
        ],
        'Pengukuran Waktu' => [
            'rumus' => '1 jam = 60 menit<br>1 menit = 60 detik<br>1 hari = 24 jam',
            'keterangan' => 'Konversi satuan waktu.',
        ],
        'Pengukuran Volume' => [
            'rumus' => '1 liter = 1000 mL<br>1 m³ = 1000 L<br>1 cm³ = 1 mL',
            'keterangan' => 'Konversi satuan volume.',
        ],
        'Geometri Bangun Datar' => [
            'rumus' => 'Luas Persegi: L = s²<br>Luas Persegi Panjang: L = p × l<br>Luas Segitiga: L = ½ × a × t<br>Luas Lingkaran: L = π × r²',
            'keterangan' => 'Kumpulan rumus luas bangun datar.',
        ],
        'Geometri Bangun Ruang' => [
            'rumus' => 'Volume Kubus: V = s³<br>Volume Balok: V = p × l × t<br>Volume Prisma: V = L_alas × t<br>Volume Bola: V = 4/3 × π × r³',
            'keterangan' => 'Kumpulan rumus volume bangun ruang.',
        ],
        'Statistika dan Data' => [
            'rumus' => 'Mean = (x₁ + x₂ + ... + xₙ) / n<br>Modus = nilai yang sering muncul<br>Median = nilai tengah data yang diurutkan',
            'keterangan' => 'Rumus dasar statistika.',
        ],
        'Pengenalan Pecahan' => [
            'rumus' => 'Penjumlahan Pecahan Sama: a/c + b/c = (a+b)/c<br>Berbeda: a/c + b/d = (ad+bc)/cd<br>Perkalian: a/b × c/d = (a×c)/(b×d)<br>Pembagian: a/b ÷ c/d = (a×d)/(b×c)',
            'keterangan' => 'Operasi dasar pada pecahan.',
        ],
        'Uang dan Perdagangan' => [
            'rumus' => 'Harga Setelah Diskon: H = P - (P × D / 100)<br>Keuntungan: K = H - C<br>Persentase Keuntungan: (K / C) × 100%',
            'keterangan' => 'Rumus dasar dalam transaksi jual beli.',
        ],

        // SMP & SMA (sudah dipersingkat)
        'Bilangan Negatif dan Rasional' => [
            'rumus' => 'Contoh: -3, -1/2, 0.75',
            'keterangan' => 'Bilangan negatif kurang dari nol, bilangan rasional dapat dinyatakan sebagai p/q.',
        ],
        'FPB dan KPK' => [
            'rumus' => 'FPB: Faktor terbesar yang sama<br>KPK: Kelipatan terkecil yang sama',
            'keterangan' => 'Gunakan faktorisasi prima untuk menentukan FPB dan KPK.',
        ],
        'Persamaan Linear Satu Variabel' => [
            'rumus' => 'ax + b = 0 ⇒ x = -b/a',
            'keterangan' => 'Persamaan linear memiliki satu variabel dengan pangkat tertinggi 1.',
        ],
        'Fungsi Kuadrat' => [
            'rumus' => 'y = ax² + bx + c',
            'keterangan' => 'Persamaan kuadrat berbentuk umum.',
        ],
        'Trigonometri Dasar' => [
            'rumus' => 'Sin θ = Opp / Hyp<br>Cos θ = Adj / Hyp<br>Tan θ = Opp / Adj',
            'keterangan' => 'Rumus dasar trigonometri dalam segitiga siku-siku.',
        ],
        'Bentuk Aljabar' => [
            'rumus' => 'x + x = 2x<br>x · x = x²<br>a(b + c) = ab + ac',
            'keterangan' => 'Bentuk aljabar memuat variabel, koefisien, dan konstanta.',
        ],
        'Pemfaktoran Aljabar' => [
            'rumus' => 'a² - b² = (a + b)(a - b)<br>a² + 2ab + b² = (a + b)²',
            'keterangan' => 'Pemfaktoran mengubah bentuk aljabar menjadi perkalian faktor-faktornya.',
        ],
        'Fungsi Linear' => [
            'rumus' => 'f(x) = mx + c<br>Gradien m = Δy / Δx',
            'keterangan' => 'Fungsi linear memiliki grafik berupa garis lurus.',
        ],
        'Sudut dan Segitiga' => [
            'rumus' => 'Jumlah sudut segitiga = 180°<br>Luas = ½ × a × t',
            'keterangan' => 'Konsep sudut dan luas pada segitiga.',
        ],
        'Bangun Ruang Sisi Datar' => [
            'rumus' => 'Kubus: V = s³, L = 6s²<br>Balok: V = p × l × t',
            'keterangan' => 'Volume dan luas permukaan bangun ruang sisi datar.',
        ],
        'Statistika SMP' => [
            'rumus' => 'Mean = Σx / n<br>Median = nilai tengah<br>Modus = nilai terbanyak',
            'keterangan' => 'Ukuran pemusatan data pada tingkat SMP.',
        ],
        'Peluang Dasar' => [
            'rumus' => 'P(A) = n(A) / n(S)',
            'keterangan' => 'Peluang kejadian A adalah perbandingan banyak kejadian dengan ruang sampel.',
        ],
        'Koordinat Kartesius' => [
            'rumus' => 'Titik (x, y)<br>Jarak dari O = √(x² + y²)',
            'keterangan' => 'Sistem koordinat kartesius dua dimensi.',
        ],

        // SMA
        'Fungsi dan Persamaan' => [
            'rumus' => 'Domain, Kodomain, Range<br>Komposisi: (f ∘ g)(x) = f(g(x))',
            'keterangan' => 'Konsep fungsi dan relasi pada matematika tingkat SMA.',
        ],
        'Fungsi Eksponen' => [
            'rumus' => 'f(x) = a·bˣ (a ≠ 0, b > 0, b ≠ 1)<br>aᵐ · aⁿ = aᵐ⁺ⁿ',
            'keterangan' => 'Fungsi eksponen memiliki peubah sebagai pangkat.',
        ],
        'Fungsi Logaritma' => [
            'rumus' => 'logₐ b = c ⇔ aᶜ = b<br>log(ab) = log a + log b',
            'keterangan' => 'Logaritma adalah kebalikan dari eksponen.',
        ],
        'Persamaan dan Pertidaksamaan' => [
            'rumus' => 'Himpunan Penyelesaian<br>Interval notasi',
            'keterangan' => 'Menyelesaikan persamaan dan pertidaksamaan.',
        ],
        'Distribusi Data' => [
            'rumus' => 'Mean, Median, Modus<br>Ragam dan Simpangan Baku',
            'keterangan' => 'Analisis distribusi data statistika.',
        ],
        'Probabilitas' => [
            'rumus' => 'P(A ∪ B) = P(A) + P(B) - P(A ∩ B)',
            'keterangan' => 'Peluang gabungan dua kejadian.',
        ],
        'Barisan dan Deret' => [
            'rumus' => 'Aritmetika: Un = a + (n-1)b<br>Geometri: Un = a·rⁿ⁻¹',
            'keterangan' => 'Barisan dan deret aritmetika serta geometri.',
        ],
        'Aritmetika dan Geometri' => [
            'rumus' => 'Sn (Arit) = n/2 (2a + (n-1)b)<br>Sn (Geo) = a(rⁿ - 1)/(r - 1)',
            'keterangan' => 'Jumlah n suku pertama deret.',
        ],
        'Logika Matematika' => [
            'rumus' => 'Implikasi: p → q<br>Kontraposisi: ¬q → ¬p',
            'keterangan' => 'Kalimat logika dan tabel kebenaran.',
        ],
        'Matriks Dasar' => [
            'rumus' => 'Determinan 2×2 = ad - bc<br>Invers = 1/det · [[d, -b], [-c, a]]',
            'keterangan' => 'Operasi dasar matriks.',
        ],
        'Kalkulus' => [
            'rumus' => 'Limit, Turunan, Integral',
            'keterangan' => 'Konsep dasar kalkulus.',
        ],
        'Limit' => [
            'rumus' => 'lim x→a f(x) = L<br>Trik: Faktorisasi dan L\'Hospital',
            'keterangan' => 'Limit fungsi pada titik tertentu.',
        ],
        'Turunan' => [
            'rumus' => 'd/dx (xⁿ) = n·xⁿ⁻¹<br>(u·v)\' = u\'v + uv\'',
            'keterangan' => 'Aturan turunan fungsi.',
        ],
        'Integral' => [
            'rumus' => '∫ xⁿ dx = xⁿ⁺¹/(n+1) + C',
            'keterangan' => 'Integral tak tentu dan tentu.',
        ],
        'Vektor' => [
            'rumus' => 'Dot: a·b = |a||b| cos θ<br>Cross: |a × b| = |a||b| sin θ',
            'keterangan' => 'Operasi vektor dalam bidang dan ruang.',
        ],
        'Geometri Analitik' => [
            'rumus' => 'Jarak dua titik<br>Gradien garis',
            'keterangan' => 'Geometri dengan pendekatan koordinat.',
        ],
        'Lingkaran' => [
            'rumus' => '(x - h)² + (y - k)² = r²',
            'keterangan' => 'Persamaan lingkaran dengan pusat (h,k).',
        ],
        'Parabola' => [
            'rumus' => 'y² = 4px atau x² = 4py',
            'keterangan' => 'Persamaan parabola dan sifat-sifatnya.',
        ],
        'Elips' => [
            'rumus' => 'x²/a² + y²/b² = 1',
            'keterangan' => 'Persamaan elips dengan sumbu mayor dan minor.',
        ],
        'Hiperbola' => [
            'rumus' => 'x²/a² - y²/b² = 1',
            'keterangan' => 'Persamaan hiperbola dan asimtotnya.',
        ],
        'Trigonometri Lanjutan' => [
            'rumus' => 'sin²θ + cos²θ = 1<br>sin 2θ = 2 sin θ cos θ',
            'keterangan' => 'Identitas dan rumus trigonometri lanjutan.',
        ],
        'Matriks dan Determinan' => [
            'rumus' => 'Invers Matriks 2×2<br>Determinan 3×3 (Ekspansi Kofaktor)',
            'keterangan' => 'Matriks, determinan, dan aplikasinya.',
        ],
        'Statistika dan Peluang' => [
            'rumus' => 'Kombinasi: C(n,r) = n!/(r!(n-r)!)<br>Permutasi: P(n,r) = n!/(n-r)!',
            'keterangan' => 'Kombinasi dan permutasi.',
        ],
        'Program Linear' => [
            'rumus' => 'Z = ax + by<br>Garis Selidik',
            'keterangan' => 'Optimasi fungsi tujuan dengan kendala linear.',
        ],
        'Transformasi Geometri' => [
            'rumus' => 'Translasi, Refleksi, Rotasi, Dilatasi',
            'keterangan' => 'Perubahan posisi atau ukuran suatu objek geometri.',
        ],
    ];

    private array $sd = [
        'Penjumlahan', 'Pengurangan', 'Perkalian', 'Pembagian',
        'Bilangan Cacah', 'Bilangan Bulat', 'Bilangan Pecahan', 'Bilangan Desimal',
        'Pengukuran Panjang', 'Pengukuran Berat', 'Pengukuran Waktu', 'Pengukuran Volume',
        'Geometri Bangun Datar', 'Geometri Bangun Ruang', 'Statistika dan Data',
        'Pengenalan Pecahan', 'Uang dan Perdagangan',
    ];

    private array $smp = [
        'Bilangan Negatif dan Rasional', 'FPB dan KPK',
        'Persamaan Linear Satu Variabel', 'Bentuk Aljabar', 'Pemfaktoran Aljabar',
        'Fungsi Linear', 'Sudut dan Segitiga', 'Bangun Ruang Sisi Datar', 'Statistika SMP',
        'Peluang Dasar', 'Koordinat Kartesius',
    ];

    private array $sma = [
        'Fungsi dan Persamaan', 'Fungsi Linear', 'Fungsi Kuadrat', 'Fungsi Eksponen',
        'Fungsi Logaritma', 'Persamaan dan Pertidaksamaan', 'Trigonometri Dasar',
        'Distribusi Data', 'Probabilitas', 'Barisan dan Deret', 'Aritmetika dan Geometri',
        'Logika Matematika', 'Matriks Dasar', 'Kalkulus', 'Limit', 'Turunan', 'Integral',
        'Vektor', 'Geometri Analitik', 'Lingkaran', 'Parabola', 'Elips', 'Hiperbola',
        'Trigonometri Lanjutan', 'Matriks dan Determinan', 'Statistika dan Peluang',
        'Program Linear', 'Transformasi Geometri',
    ];

    public function index()
    {
        $rumus = $this->buildList();

        $cari = trim((string) request('cari'));
        if ($cari !== '') {
            $rumus = array_values(array_filter($rumus, function ($item) use ($cari) {
                return stripos($item['title'], $cari) !== false
                    || stripos($item['keterangan'], $cari) !== false;
            }));
        }

        return view('rumus.index', ['rumus' => $rumus]);
    }

    public function show(string $jenis)
    {
        $rumusInfo = $this->rumusDetail[$jenis] ?? null;
        $kategoriJenjang = $this->jenjang($jenis);

        if ($rumusInfo === null) {
            abort(404);
        }

        [$emoji, $gradient] = $this->visual($jenis);
        $isBookmarked = auth()->check() && auth()->user()->hasBookmarked($jenis);

        return view('rumus.show', compact('jenis', 'rumusInfo', 'kategoriJenjang', 'emoji', 'gradient', 'isBookmarked'));
    }

    public function rangkuman()
    {
        return view('rumus.rangkuman', ['rumus' => $this->buildList()]);
    }

    /**
     * @return array<int, array<string, string>>
     */
    public function buildList(): array
    {
        $rumus = [];
        foreach ($this->rumusDetail as $key => $item) {
            [$emoji, $gradient] = $this->visual($key);
            $rumus[] = [
                'title' => $key,
                'keterangan' => $item['keterangan'],
                'rumus' => $item['rumus'],
                'jenjang' => $this->jenjang($key),
                'emoji' => $emoji,
                'gradient' => $gradient,
            ];
        }

        return $rumus;
    }

    /**
     * @return array<int, array<string, string>>
     */
    public function forFavorites(array $titles): array
    {
        $all = collect($this->buildList())->keyBy('title');

        $result = [];
        foreach ($titles as $title) {
            if ($all->has($title)) {
                $result[] = $all->get($title);
            }
        }

        return $result;
    }

    private function jenjang(string $jenis): string
    {
        $jenjang = 'Umum';

        foreach (['SD' => $this->sd, 'SMP' => $this->smp, 'SMA' => $this->sma] as $level => $list) {
            if (in_array($jenis, $list)) {
                $jenjang = $level;
                break;
            }
        }

        return $jenjang;
    }

    /**
     * @return array{0: string, 1: string}
     */
    private function visual(string $title): array
    {
        $emojis = ['➕', '➖', '✖️', '➗', '🔢', '📏', '⚖️', '⏰', '🧮', '📐', '🧊', '📊', '🧮', '💡', '🧩', '🎲', '📈', '🧠', '🌐', '💹', '🥧', '🪐'];

        $gradients = [
            'from-indigo-500 to-violet-600',
            'from-sky-500 to-blue-600',
            'from-emerald-500 to-teal-600',
            'from-amber-500 to-orange-600',
            'from-rose-500 to-pink-600',
            'from-fuchsia-500 to-purple-600',
            'from-cyan-500 to-sky-600',
            'from-lime-500 to-emerald-600',
            'from-orange-500 to-red-600',
            'from-violet-500 to-fuchsia-600',
        ];

        $hash = 0;
        foreach (str_split($title) as $char) {
            $hash = ($hash * 31 + ord($char)) & 0x7FFFFFFF;
        }

        return [$emojis[$hash % count($emojis)], $gradients[$hash % count($gradients)]];
    }
}
