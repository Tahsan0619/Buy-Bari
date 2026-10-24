<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'image', 'alt', 'link', 'plain', 'eyebrow', 'title', 'text', 'cta', 'category', 'sort', 'is_active',
])]
class Banner extends Model
{
    protected function casts(): array
    {
        return [
            'plain' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function imageUrl(): string
    {
        return CatalogPath::url($this->image);
    }
}
