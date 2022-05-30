<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    const STATUS_PUBLISHED = 'published';

    protected $casts = ['id' => 'string'];

    public $incrementing = false;
}
