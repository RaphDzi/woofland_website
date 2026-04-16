<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Conversation extends Model
{
    protected $connection = 'mongodb';

    protected $fillable = [
        'participants',
        'last_message',
        'updated_at'
    ];
}
