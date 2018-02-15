<?php namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class History extends Model
{
    use SoftDeletes;

    protected $table   = 'histories';
    protected $guarded = [];

    const INDEX  = 1;
    const CREATE = 2;
    const EDIT   = 3;
    const DELETE = 4;
    const EXPORT = 5;

    const CERTIFICATE = 1;
    const HISTORY     = 2;
    const TRAINING    = 3;
    const USER        = 4;
    const GRADE       = 5;
    const POSITION    = 6;
    const UNIT        = 7;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
