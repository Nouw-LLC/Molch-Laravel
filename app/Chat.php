<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = ['chat_creator', 'participants'];

    protected $casts = [
        'participants' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
