<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TelegramMessage extends Model
{
    protected $fillable = ['id', 'group_id', 'user_id', 'text', 'date'];
    public $incrementing = false;
}
