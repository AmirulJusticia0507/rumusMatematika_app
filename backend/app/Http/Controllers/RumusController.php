<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RumusController extends Controller
{
    // Semua rumus dari PHP native
    private $rumus_detail = [
        'Penjumlahan' => [
            'rumus' => 'a + b = c<br>a + b = c',
            'keterangan' => 'Penjumlahan dua bilangan a dan b menghasilkan hasil c.'
        ],
        'Pengurangan' => [
            'rumus' => 'a - b = c<br>a - b = c',
            'keterangan' => 'Pengurangan bilangan a dengan b menghasilkan hasil c.'
        ],
        'Perkalian' => [
            'rumus' => 'a × b = c<br>a × b = c',
            'keterangan' => 'Perkalian bilangan a dan b menghasilkan hasil c.'
        ],
        'Pembagian' => [
            'rumus' => 'a / b = c (dengan b ≠ 0)<br>b ≠ 0',
            'keterangan' => 'Pembagian bilangan a dengan b menghasilkan hasil c (syarat b tidak boleh nol).'
        ],
        'Bilangan Cacah' => [
            'rumus' => '0, 1, 2, 3, 4, …',
            'keterangan' => 'Bilangan cacah adalah bilangan yang dimulai dari 0 dan seterusnya.'
        ],
        'Bilangan Bulat' => [
            'rumus' => '…, -3, -2, -1, 0, 1, 2, 3, …',
            'keterangan' => 'Bilangan bulat terdiri dari bilangan positif, negatif, dan nol.'
        ],
        'Bilangan Pecahan' => [
            'rumus' => 'p/q (dengan q ≠ 0)',
            'keterangan' => 'Pecahan terdiri dari pembilang p dan penyebut q, dengan syarat penyebut tidak boleh nol.'
        ],
        'Bilangan Desimal' => [
            'rumus' => 'Contoh: 1.5, 2.75, 0.4, -3.25',
            'keterangan' => 'Bilangan desimal dituliskan dengan tanda titik desimal.'
        ],
        'Pengukuran Panjang' => [
            'rumus' => '1 m = 100 cm<br>1 km = 1000 m<br>1 m = 10 dm<br>1 cm = 10 mm',
            'keterangan' => 'Konversi satuan panjang.'
        ],
        'Pengukuran Berat' => [
            'rumus' => '1 kg = 1000 g<br>1 ton = 1000 kg<br>1 g = 1000 mg',
            'keterangan' => 'Konversi satuan berat.'
        ],
        'Pengukuran Waktu' => [
            'rumus' => '1 jam = 60 menit<br>1 menit = 60 detik<br>1 hari = 24 jam',
            'keterangan' => 'Konversi satuan waktu.'
        ],
        'Pengukuran Volume' => [
            'rumus' => '1 liter = 1000 mL<br>1 m³ = 1000 L<br>1 cm³ = 1 mL',
            'keterangan' => 'Konversi satuan volume.'
        ],
        'Geometri Bangun Datar' => [
            'rumus' => 'Luas Persegi: L = s²<br>Luas Persegi Panjang: L = p × l<br>Luas Segitiga: L = ½ × a × t<br>Luas Lingkaran: L = π × r²',
            'keterangan' => 'Kumpulan rumus luas bangun datar.'
        ],
        'Geometri Bangun Ruang' => [
            'rumus' => 'Volume Kubus: V = s³<br>Volume Balok: V = p × l × t<br>Volume Prisma: V = L_alas × t<br>Volume Bola: V = 4/3 × π × r³',
            'keterangan' => 'Kumpulan rumus volume bangun ruang.'
        ],
        'Statistika dan Data' => [
            'rumus' => 'Mean = (x₁ + x₂ + ... + xₙ) / n<br>Modus = nilai yang sering muncul<br>Median = nilai tengah data yang diurutkan',
            'keterangan' => 'Rumus dasar statistika.'
        ],
        'Pengenalan Pecahan' => [
            'rumus' => 'Penjumlahan Pecahan Sama: a/c + b/c = (a+b)/c<br>Berbeda: a/c + b/d = (ad+bc)/cd<br>Perkalian: a/b × c/d = (a×c)/(b×d)<br>Pembagian: a/b ÷ c/d = (a×d)/(b×c)',
            'keterangan' => 'Operasi dasar pada pecahan.'
        ],
        'Uang dan Perdagangan' => [
            'rumus' => 'Harga Setelah Diskon: H = P - (P × D / 100)<br>Keuntungan: K = H - C<br>Persentase Keuntungan: (K / C) × 100%',
            'keterangan' => 'Rumus dasar dalam transaksi jual beli.'
        ],

        // SMP & SMA (sudah dipersingkat)
        'Bilangan Negatif dan Rasional' => [
            'rumus' => 'Contoh: -3, -1/2, 0.75',
            'keterangan' => 'Bilangan negatif kurang dari nol, bilangan rasional dapat dinyatakan sebagai p/q.'
        ],
        'FPB dan KPK' => [
            'rumus' => 'FPB: Faktor terbesar yang sama<br>KPK: Kelipatan terkecil yang sama',
            'keterangan' => 'Gunakan faktorisasi prima untuk menentukan FPB dan KPK.'
        ],
        'Persamaan Linear Satu Variabel' => [
            'rumus' => 'ax + b = 0 ⇒ x = -b/a',
            'keterangan' => 'Persamaan linear memiliki satu variabel dengan pangkat tertinggi 1.'
        ],
        'Fungsi Kuadrat' => [
            'rumus' => 'y = ax² + bx + c',
            'keterangan' => 'Persamaan kuadrat berbentuk umum.'
        ],
        'Trigonometri Dasar' => [
            'rumus' => 'Sin θ = Opp / Hyp<br>Cos θ = Adj / Hyp<br>Tan θ = Opp / Adj',
            'keterangan' => 'Rumus dasar trigonometri dalam segitiga siku-siku.'
        ],
        // ... tambah semua rumus SMA yang lain sesuai file PHP native
    ];

    public function show($jenis)
    {
        $rumus_info = $this->rumus_detail[$jenis] ?? null;

        // Tentukan jenjang pendidikan
        $sd = [
            'Penjumlahan','Pengurangan','Perkalian','Pembagian',
            'Bilangan Cacah','Bilangan Bulat','Bilangan Pecahan','Bilangan Desimal',
            'Pengukuran Panjang','Pengukuran Berat','Pengukuran Waktu','Pengukuran Volume',
            'Geometri Bangun Datar','Geometri Bangun Ruang','Statistika dan Data',
            'Pengenalan Pecahan','Uang dan Perdagangan'
        ];

        $smp = [
            'Bilangan Negatif dan Rasional','FPB dan KPK',
            'Persamaan Linear Satu Variabel','Bentuk Aljabar','Pemfaktoran Aljabar',
            'Fungsi Linear','Sudut dan Segitiga','Bangun Ruang Sisi Datar','Statistika SMP',
            'Peluang Dasar','Koordinat Kartesius'
        ];

        $sma = [
            'Fungsi dan Persamaan','Fungsi Linear','Fungsi Kuadrat','Fungsi Eksponen',
            'Fungsi Logaritma','Persamaan dan Pertidaksamaan','Trigonometri Dasar',
            'Distribusi Data','Probabilitas','Barisan dan Deret','Aritmetika dan Geometri',
            'Logika Matematika','Matriks Dasar','Kalkulus','Limit','Turunan','Integral',
            'Vektor','Geometri Analitik','Lingkaran','Parabola','Elips','Hiperbola',
            'Trigonometri Lanjutan','Matriks dan Determinan','Statistika dan Peluang',
            'Program Linear','Transformasi Geometri'
        ];

        $kategoriJenjang = 'Unknown';
        if (in_array($jenis, $sd)) $kategoriJenjang = 'SD';
        elseif (in_array($jenis, $smp)) $kategoriJenjang = 'SMP';
        elseif (in_array($jenis, $sma)) $kategoriJenjang = 'SMA';

        return view('rumus.show', compact('jenis', 'rumus_info', 'kategoriJenjang'));
    }
}
