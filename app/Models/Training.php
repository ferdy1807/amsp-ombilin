<?php namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Training extends Model
{
    use SoftDeletes;

    protected $table   = 'trainings';
    protected $guarded = [];

    const PLN    = 1;
    const NONPLN = 2;

    const FOLLOW   = 1;
    const UNFOLLOW = 2;

    const SICK         = 1;
    const OFFDAY       = 2;
    const BUSINESSTRIP = 3;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
