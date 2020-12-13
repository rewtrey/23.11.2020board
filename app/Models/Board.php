<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;


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
 * @property string $image
 */
class Board extends Model
{
    protected $fillable = [
        'title', 'description'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isTheOwner($user)
    {
        return $this->user_id === $user->id;
    }

    public function getImageAttribute(string $attribute): string
    {
        return Storage::url($attribute);
    }
}
