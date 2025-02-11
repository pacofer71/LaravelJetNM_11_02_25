<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    protected $fillable=['nombre', 'color'];
    public $timestamps=false;

    //Relacion N:M con cursos
    public function courses(): BelongsToMany{
        return $this->belongsToMany(Course::class);
    }

    public function nombre(): Attribute{
        return Attribute::make(
            set: fn($v)=>strtolower($v),
        );
    }
}
