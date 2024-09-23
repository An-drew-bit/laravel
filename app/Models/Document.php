<?php

declare(strict_types=1);

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property string id
 * @property string status
 * @property array payload
 * @property DateTime created_at
 * @property DateTime updated_at
 */
class Document extends Model
{
    use HasFactory;

    protected $casts = ['id' => 'string'];

    public $incrementing = false;
}
