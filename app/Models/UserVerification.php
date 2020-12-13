<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserVefirication
 * @package App\Models
 *
 * @property int $id
 * @property int $user_id
 * @property string $hash
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */

class UserVerification extends Model
{
    use HasFactory;

    protected $table ='user_verifications';
}
