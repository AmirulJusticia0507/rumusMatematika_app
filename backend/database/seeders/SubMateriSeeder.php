<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubMateriSeeder extends Seeder
{
    public function run()
    {
        // Kelas 1
        $subMateriK1 = [
            ['judul' => 'Menghitung benda dari 1 sampai 10', 'isi' => 'Latihan menghitung benda sehari-hari.', 'materi_id' => 1],
            ['judul' => 'Menulis angka 1 sampai 10', 'isi' => 'Latihan menulis angka dengan benar.', 'materi_id' => 1],
            ['judul' => 'Menyebutkan angka secara urut', 'isi' => 'Latihan menyebut angka maju dan mundur.', 'materi_id' => 1],

            ['judul' => 'Penjumlahan 1 + 1 sampai 5 + 5', 'isi' => 'Latihan penjumlahan sederhana.', 'materi_id' => 6],
            ['judul' => 'Penjumlahan dengan benda konkret', 'isi' => 'Menggunakan benda nyata untuk menjumlahkan.', 'materi_id' => 6],

            ['judul' => 'Pengurangan 10 – 1 sampai 10 – 5', 'isi' => 'Latihan pengurangan sederhana.', 'materi_id' => 9],
            ['judul' => 'Cerita pengurangan sehari-hari', 'isi' => 'Mengurangi benda nyata dalam kehidupan sehari-hari.', 'materi_id' => 10],

            ['judul' => 'Mengenal bentuk segitiga, lingkaran, dan persegi', 'isi' => 'Membedakan bentuk-bentuk dasar.', 'materi_id' => 13],
            ['judul' => 'Mendeskripsikan benda berdasarkan bentuk', 'isi' => 'Melatih anak mengenal bentuk benda di sekitarnya.', 'materi_id' => 14],
        ];

        // Kelas 2
        $subMateriK2 = [
            ['judul' => 'Membilang sampai 50', 'isi' => 'Latihan menghitung dari 1 sampai 50.', 'materi_id' => 17],
            ['judul' => 'Menulis bilangan sampai 50', 'isi' => 'Latihan menulis bilangan dengan benar.', 'materi_id' => 18],
            ['judul' => 'Perbandingan bilangan', 'isi' => 'Menentukan bilangan lebih besar atau lebih kecil.', 'materi_id' => 20],

            ['judul' => 'Penjumlahan hingga 50', 'isi' => 'Latihan penjumlahan bilangan sampai 50.', 'materi_id' => 22],
            ['judul' => 'Pengurangan hingga 50', 'isi' => 'Latihan pengurangan bilangan sampai 50.', 'materi_id' => 24],

            ['judul' => 'Mengenal setengah dan seperempat', 'isi' => 'Latihan pecahan sederhana dari benda nyata.', 'materi_id' => 27],
        ];

        // Kelas 3
        $subMateriK3 = [
            ['judul' => 'Bilangan cacah sampai 1.000', 'isi' => 'Latihan membaca, menulis, dan membandingkan bilangan hingga 1.000.', 'materi_id' => 31],
            ['judul' => 'Penjumlahan bilangan cacah sampai 100', 'isi' => 'Latihan penjumlahan bilangan hingga 100.', 'materi_id' => 35],
            ['judul' => 'Pengukuran panjang dan berat', 'isi' => 'Latihan mengukur benda dengan satuan baku.', 'materi_id' => 40],
            ['judul' => 'Sisi dan sudut bangun datar', 'isi' => 'Latihan mengenal sisi dan sudut pada segitiga dan segiempat.', 'materi_id' => 43],
        ];

        // Kelas 4
        $subMateriK4 = [
            ['judul' => 'Membaca dan menulis bilangan sampai 10.000', 'isi' => 'Latihan membaca dan menulis bilangan besar.', 'materi_id' => 50],
            ['judul' => 'Komposisi dan dekomposisi bilangan', 'isi' => 'Latihan memecah bilangan menjadi nilai tempat.', 'materi_id' => 54],
            ['judul' => 'Pecahan senilai dan desimal', 'isi' => 'Latihan memahami pecahan dan desimal.', 'materi_id' => 60],
            ['judul' => 'Mengukur luas dan volume', 'isi' => 'Latihan menghitung luas dan volume benda.', 'materi_id' => 64],
            ['judul' => 'Piktogram dan diagram batang', 'isi' => 'Latihan membuat dan membaca diagram.', 'materi_id' => 67],
        ];

        // Kelas 5
        $subMateriK5 = [
            ['judul' => 'Bilangan cacah sampai 100.000', 'isi' => 'Latihan membaca, menulis, dan membandingkan bilangan hingga 100.000.', 'materi_id' => 70],
            ['judul' => 'KPK dan FPB', 'isi' => 'Latihan menentukan kelipatan dan faktor persekutuan.', 'materi_id' => 75],
            ['judul' => 'Keliling dan luas bangun datar', 'isi' => 'Latihan menghitung keliling dan luas bangun datar sederhana.', 'materi_id' => 80],
            ['judul' => 'Sudut: mengukur dan melukis', 'isi' => 'Latihan mengukur sudut dengan busur derajat.', 'materi_id' => 85],
            ['judul' => 'Mengumpulkan data dan membuat diagram', 'isi' => 'Latihan menyusun data menjadi piktogram dan diagram batang.', 'materi_id' => 88],
        ];

        // Kelas 6
        $subMateriK6 = [
            ['judul' => 'Perkalian dan pembagian pecahan', 'isi' => 'Latihan operasi pecahan sederhana.', 'materi_id' => 95],
            ['judul' => 'Bilangan desimal dan rasio', 'isi' => 'Latihan memahami bilangan desimal dan rasio.', 'materi_id' => 98],
            ['judul' => 'Kubus dan balok: mengonstruksi dan mengurai', 'isi' => 'Latihan membuat dan menghitung volume kubus dan balok.', 'materi_id' => 102],
            ['judul' => 'Peluang sederhana', 'isi' => 'Latihan menghitung peluang kejadian sederhana.', 'materi_id' => 106],
        ];

        // Kelas 7
        $subMateriK7 = [
            ['judul' => 'Bilangan bulat dan operasi', 'isi' => 'Latihan penjumlahan, pengurangan, perkalian, dan pembagian bilangan bulat.', 'materi_id' => 110],
            ['judul' => 'Pecahan dan desimal', 'isi' => 'Latihan operasi pecahan dan desimal.', 'materi_id' => 111],
            ['judul' => 'Persamaan linear sederhana', 'isi' => 'Latihan menyelesaikan persamaan linear satu variabel.', 'materi_id' => 112],
            ['judul' => 'Bangun datar dan bangun ruang', 'isi' => 'Latihan menghitung keliling, luas, dan volume bangun sederhana.', 'materi_id' => 113],
            ['judul' => 'Statistika dasar', 'isi' => 'Latihan menghitung rata-rata, modus, dan median.', 'materi_id' => 114],
        ];

        // Kelas 8
        $subMateriK8 = [
            ['judul' => 'Bilangan rasional dan operasi', 'isi' => 'Latihan operasi bilangan rasional.', 'materi_id' => 120],
            ['judul' => 'Persamaan linear dua variabel', 'isi' => 'Latihan menyelesaikan persamaan linear dua variabel.', 'materi_id' => 121],
            ['judul' => 'Sistem persamaan linear', 'isi' => 'Latihan menyelesaikan sistem persamaan linear sederhana.', 'materi_id' => 122],
            ['judul' => 'Bangun ruang dan volume', 'isi' => 'Latihan menghitung volume prisma, limas, tabung, kerucut, dan bola.', 'materi_id' => 123],
            ['judul' => 'Data dan peluang', 'isi' => 'Latihan membuat tabel frekuensi, diagram, dan menghitung peluang sederhana.', 'materi_id' => 124],
        ];

        // Kelas 9
        $subMateriK9 = [
            ['judul' => 'Eksponen dan akar', 'isi' => 'Latihan operasi bilangan berpangkat dan akar.', 'materi_id' => 130],
            ['judul' => 'Persamaan kuadrat', 'isi' => 'Latihan menyelesaikan persamaan kuadrat sederhana.', 'materi_id' => 131],
            ['judul' => 'Sifat segitiga dan trigonometri dasar', 'isi' => 'Latihan menghitung sisi dan sudut segitiga menggunakan perbandingan trigonometri.', 'materi_id' => 132],
            ['judul' => 'Statistika dan peluang lanjut', 'isi' => 'Latihan menghitung mean, median, modus, dan peluang gabungan.', 'materi_id' => 133],
            ['judul' => 'Fungsi linier dan grafik', 'isi' => 'Latihan membuat grafik fungsi linier.', 'materi_id' => 134],
        ];

        // ==== Contoh SubMateri SMA (Kelas 10–12) ====

        // Kelas 10
        $subMateriK10 = [
            ['judul' => 'Fungsi aljabar', 'isi' => 'Latihan operasi fungsi aljabar dan grafik.', 'materi_id' => 140],
            ['judul' => 'Persamaan dan pertidaksamaan kuadrat', 'isi' => 'Latihan menyelesaikan persamaan/pertidaksamaan kuadrat.', 'materi_id' => 141],
            ['judul' => 'Logaritma dasar', 'isi' => 'Latihan menghitung logaritma bilangan positif.', 'materi_id' => 142],
            ['judul' => 'Trigonometri', 'isi' => 'Latihan menentukan nilai sinus, cosinus, dan tangen.', 'materi_id' => 143],
            ['judul' => 'Geometri analitik', 'isi' => 'Latihan persamaan garis dan jarak titik ke garis.', 'materi_id' => 144],
        ];

        // Kelas 11
        $subMateriK11 = [
            ['judul' => 'Fungsi eksponen dan logaritma', 'isi' => 'Latihan fungsi eksponen dan logaritma tingkat lanjut.', 'materi_id' => 150],
            ['judul' => 'Limit dan turunan dasar', 'isi' => 'Latihan menentukan limit dan turunan sederhana fungsi aljabar.', 'materi_id' => 151],
            ['judul' => 'Trigonometri lanjutan', 'isi' => 'Latihan identitas trigonometri dan grafik fungsi trigonometri.', 'materi_id' => 152],
            ['judul' => 'Peluang lanjutan', 'isi' => 'Latihan kombinasi, permutasi, dan peluang majemuk.', 'materi_id' => 153],
            ['judul' => 'Matriks dan determinan', 'isi' => 'Latihan operasi matriks dan menghitung determinan.', 'materi_id' => 154],
        ];

        // Kelas 12
        $subMateriK12 = [
            ['judul' => 'Fungsi lanjutan', 'isi' => 'Latihan fungsi polinomial, rasional, dan irasional.', 'materi_id' => 160],
            ['judul' => 'Limit, turunan, dan integral', 'isi' => 'Latihan limit, turunan, dan integral fungsi aljabar sederhana.', 'materi_id' => 161],
            ['judul' => 'Vektor dan ruang dimensi 3', 'isi' => 'Latihan operasi vektor dan posisi titik dalam ruang 3D.', 'materi_id' => 162],
            ['judul' => 'Statistika dan peluang tingkat lanjut', 'isi' => 'Latihan distribusi, probabilitas, dan peluang gabungan.', 'materi_id' => 163],
            ['judul' => 'Barisan dan deret', 'isi' => 'Latihan aritmatika dan geometri barisan dan deret.', 'materi_id' => 164],
        ];

        // Insert semua submateri
        DB::table('sub_materis')->insert($subMateriK1);
        DB::table('sub_materis')->insert($subMateriK2);
        DB::table('sub_materis')->insert($subMateriK3);
        DB::table('sub_materis')->insert($subMateriK4);
        DB::table('sub_materis')->insert($subMateriK5);
        DB::table('sub_materis')->insert($subMateriK6);
        DB::table('sub_materis')->insert($subMateriK7);
        DB::table('sub_materis')->insert($subMateriK8);
        DB::table('sub_materis')->insert($subMateriK9);
        DB::table('sub_materis')->insert($subMateriK10);
        DB::table('sub_materis')->insert($subMateriK11);
        DB::table('sub_materis')->insert($subMateriK12);
    }
}
