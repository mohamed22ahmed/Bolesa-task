<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['body','avatar','seen'];

    public static $sortable = ['body', 'seen', 'created_at', 'updated_at'];
    public static $filterable = ['body'];
}
