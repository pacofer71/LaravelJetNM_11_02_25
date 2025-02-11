<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    protected $fillable=['nombre', 'color'];
    public $timestamps=false;

    //Relacion 1:N con cursos
    public function courses(): HasMany{
        return $this->hasMany(Course::class);
    }
    public function nombre(): Attribute{
        return Attribute::make(
            set: fn($v)=>ucfirst($v),
        );
    }
}
