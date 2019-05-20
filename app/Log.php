<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    //
    protected $fillable = ['message'];

    public static function add_log($message)
    {
        Log::create(['message' => $message]);
    }
}
