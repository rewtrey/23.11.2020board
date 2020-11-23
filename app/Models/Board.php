<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Board
 * @package App\Models
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property integer $price
 * @property integer $created_at
 *
 */
class Board extends Model
{
    protected $fillable = [
        'title', 'description'
    ];
}
