<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    // Menampilkan semua materi dengan subMateri dan kelas
    public function index()
    {
        $materi = Materi::with(['subMateri', 'kelas'])->get();

        return response()->json($materi);
    }

    // Menampilkan materi tertentu berdasarkan ID
    public function show($id)
    {
        $materi = Materi::with(['subMateri', 'kelas'])->findOrFail($id);

        return response()->json($materi);
    }

    // Menambahkan materi baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $materi = Materi::create([
            'judul' => $request->judul,
            'kelas_id' => $request->kelas_id,
        ]);

        return response()->json($materi, 201);
    }

    // Mengubah materi tertentu
    public function update(Request $request, $id)
    {
        $materi = Materi::findOrFail($id);

        $request->validate([
            'judul' => 'sometimes|required|string|max:255',
            'kelas_id' => 'sometimes|required|exists:kelas,id',
        ]);

        $materi->update($request->only(['judul', 'kelas_id']));

        return response()->json($materi);
    }

    // Menghapus materi
    public function destroy($id)
    {
        Materi::destroy($id);

        return response()->json(null, 204);
    }
}
