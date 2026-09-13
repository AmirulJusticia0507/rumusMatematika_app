<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rumus extends Model
{
    protected $table = 'rumus';

    protected $fillable = [
        'slug',
        'title',
        'keterangan',
        'rumus',
        'jenjang',
        'emoji',
        'gradient',
        'urutan',
    ];

    protected $casts = [
        'urutan' => 'integer',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
