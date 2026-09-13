<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        return response()->json(Kelas::with('materi.subMateri')->get());
    }

    public function show($id)
    {
        return response()->json(Kelas::with('materi.subMateri')->findOrFail($id));
    }

    public function store(Request $request)
    {
        $kelas = Kelas::create($request->only('nama'));

        return response()->json($kelas, 201);
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->update($request->only('nama'));

        return response()->json($kelas);
    }

    public function destroy($id)
    {
        Kelas::destroy($id);

        return response()->json(null, 204);
    }
}
