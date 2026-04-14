<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chien extends Model
{
    protected $table = 'chiens';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'nom',
        'age',
        'race',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
