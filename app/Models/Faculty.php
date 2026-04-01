<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Faculty extends Model
{
    protected $fillable = ['campus_id', 'code', 'name', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function campus(): BelongsTo
    {
        return $this->belongsTo(Campus::class);
    }

    public function programs(): HasMany
    {
        return $this->hasMany(Program::class)->where('is_active', true)->orderBy('name');
    }
}
