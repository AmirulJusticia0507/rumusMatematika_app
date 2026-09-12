<?php

namespace App\Http\Controllers;

use App\Models\SubMateri;
use Illuminate\Http\Request;

class SubMateriController extends Controller
{
    // Menampilkan semua subMateri dengan relasi materi dan kelas
    public function index()
    {
        $subMateri = SubMateri::with(['materi.kelas'])->get();
        return response()->json($subMateri);
    }

    // Menampilkan subMateri tertentu berdasarkan ID
    public function show($id)
    {
        $subMateri = SubMateri::with(['materi.kelas'])->findOrFail($id);
        return response()->json($subMateri);
    }

    // Menambahkan subMateri baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'nullable|string',
            'materi_id' => 'required|exists:materi,id'
        ]);

        $subMateri = SubMateri::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'materi_id' => $request->materi_id
        ]);

        return response()->json($subMateri, 201);
    }

    // Mengubah subMateri tertentu
    public function update(Request $request, $id)
    {
        $subMateri = SubMateri::findOrFail($id);

        $request->validate([
            'judul' => 'sometimes|required|string|max:255',
            'isi' => 'sometimes|nullable|string',
            'materi_id' => 'sometimes|required|exists:materi,id'
        ]);

        $subMateri->update($request->only(['judul', 'isi', 'materi_id']));

        return response()->json($subMateri);
    }

    // Menghapus subMateri
    public function destroy($id)
    {
        SubMateri::destroy($id);
        return response()->json(null, 204);
    }
}
