<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\URL;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    const SUPERADMIN = 1;
    const ADMIN      = 2;
    const USER       = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getImageFileAttribute()
    {
        if (empty($this->attributes['image']) || $this->attributes['image'] == null) {
            return asset('/images/user/user-admin.png');
        } else {
            return URL::to('medias' . config('path.user') . $this->attributes['image']);
        }
    }
}
