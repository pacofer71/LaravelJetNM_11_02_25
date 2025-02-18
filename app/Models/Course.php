<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;
    protected $fillable=[
        'nombre', 'descripcion', 
        'imagen', 'fecha_inicio', 
        'fecha_fin', 'precio',
        'user_id', 'type_id'
    ];

    //Relacion 1:N con users
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
    //Relacion 1:N con types
    public function type(): BelongsTo{
        return $this->belongsTo(Type::class);
    }
    //Relacion N:m con tags
    public function tags(): BelongsToMany{
        return $this->belongsToMany(Tag::class);
    }
    //accesors y muttators
    public function nombre(): Attribute{
        return Attribute::make(
            set: fn($v)=>ucfirst($v),
        );
    }
    public function descripcion(): Attribute{
        return Attribute::make(
            set: fn($v)=>ucfirst($v),
        );
    }

    protected function casts(): array
    {
        return [
            'fecha_inicio' => 'datetime',
            'fecha_fin'=>'datetime'
        ];
    }

    public function getArrayIdCourseTags(): array{
        return $this->tags()->pluck('tags.id')->toArray();
    }







}
