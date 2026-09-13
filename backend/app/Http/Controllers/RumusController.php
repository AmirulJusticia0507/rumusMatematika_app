<?php

namespace App\Http\Controllers;

use App\Models\Rumus;

class RumusController extends Controller
{
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

    public function show(Rumus $rumus)
    {
        $jenis = $rumus->title;
        $slug = $rumus->slug;
        $rumusInfo = [
            'rumus' => $rumus->rumus,
            'keterangan' => $rumus->keterangan,
        ];
        $kategoriJenjang = $rumus->jenjang;
        $emoji = $rumus->emoji;
        $gradient = $rumus->gradient;
        $isBookmarked = auth()->check() && auth()->user()->hasBookmarked($rumus->title);

        return view('rumus.show', compact('jenis', 'slug', 'rumusInfo', 'kategoriJenjang', 'emoji', 'gradient', 'isBookmarked'));
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
        return Rumus::query()
            ->orderBy('urutan')
            ->get()
            ->map(fn (Rumus $rumus): array => [
                'title' => $rumus->title,
                'slug' => $rumus->slug,
                'keterangan' => $rumus->keterangan,
                'rumus' => $rumus->rumus,
                'jenjang' => $rumus->jenjang,
                'emoji' => $rumus->emoji,
                'gradient' => $rumus->gradient,
            ])
            ->all();
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
}
