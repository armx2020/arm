<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TelegramGroup extends Model
{
    protected $fillable = ['id', 'username', 'title', 'description'];
    public $incrementing = false;
}
