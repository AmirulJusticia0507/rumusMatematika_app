<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rumus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RumusController extends Controller
{
    private array $gradients = [
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

    public function index(Request $request): View
    {
        $rumus = Rumus::query()
            ->when($request->filled('cari'), function ($q) use ($request) {
                $search = trim($request->cari);

                return $q->where('title', 'ilike', "%{$search}%")
                    ->orWhere('keterangan', 'ilike', "%{$search}%");
            })
            ->when($request->filled('jenjang'), fn ($q) => $q->where('jenjang', $request->jenjang))
            ->orderBy('urutan')
            ->paginate(10)
            ->withQueryString();

        return view('admin.rumus.index', ['rumus' => $rumus]);
    }

    public function create(): View
    {
        $rumus = new Rumus;

        return view('admin.rumus.form', ['rumus' => $rumus, 'gradients' => $this->gradients]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request, null);
        Rumus::create($data);

        return redirect()->route('admin.rumus.index')->with('status', 'Rumus berhasil ditambahkan! 🎉');
    }

    public function edit(Rumus $rumus): View
    {
        return view('admin.rumus.form', ['rumus' => $rumus, 'gradients' => $this->gradients]);
    }

    public function update(Request $request, Rumus $rumus): RedirectResponse
    {
        $data = $this->validated($request, $rumus->id);
        $rumus->update($data);

        return redirect()->route('admin.rumus.index')->with('status', 'Rumus berhasil diperbarui! 👍');
    }

    public function destroy(Rumus $rumus): RedirectResponse
    {
        $rumus->delete();

        return redirect()->route('admin.rumus.index')->with('status', 'Rumus dihapus.');
    }

    private function validated(Request $request, ?int $ignoreId): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255', 'unique:rumus,title,'.($ignoreId ?? 'NULL').',id'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:rumus,slug,'.($ignoreId ?? 'NULL').',id'],
            'keterangan' => ['nullable', 'string'],
            'rumus' => ['nullable', 'string'],
            'jenjang' => ['required', 'in:SD,SMP,SMA'],
            'emoji' => ['nullable', 'string', 'max:16'],
            'gradient' => ['required', 'string', 'in:'.implode(',', $this->gradients)],
            'urutan' => ['nullable', 'integer', 'min:0'],
        ]);

        $slug = trim((string) ($data['slug'] ?? ''));
        $slug = $slug !== '' ? Str::slug($slug) : Str::slug($data['title']);
        $slug = $this->uniqueSlug($slug, $ignoreId);

        return [
            'title' => $data['title'],
            'slug' => $slug,
            'keterangan' => $data['keterangan'] ?? null,
            'rumus' => $data['rumus'] ?? null,
            'jenjang' => $data['jenjang'],
            'emoji' => $data['emoji'] ?? '🧮',
            'gradient' => $data['gradient'],
            'urutan' => $data['urutan'] ?? 0,
        ];
    }

    private function uniqueSlug(string $slug, ?int $ignoreId): string
    {
        $candidate = $slug;
        $counter = 2;

        while (Rumus::where('slug', $candidate)
            ->when($ignoreId !== null, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->exists()) {
            $candidate = $slug.'-'.$counter;
            $counter++;
        }

        return $candidate;
    }
}
