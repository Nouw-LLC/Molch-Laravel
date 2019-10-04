<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warning extends Model
{
    protected $fillable = ['reason'];

    public function user()
    {
        return $this->belongsTo(User::class, 'reported');
    }
}
