<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'created_at',
        'updated_at',
        'titre',
        'contenu',
        'image',
        'visibilite',
        'id_formateur',

    ];

    public function formateur()
    {
        return $this->belongsTo(Formateur::class, 'id_formateur');
    }

    public function getImageUrlAttribute()
    {
        return $this->image
            ? asset('storage/' . $this->image)
            : asset('images/default.jpg');
    }
}
