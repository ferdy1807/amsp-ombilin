<?php namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use SoftDeletes;

    protected $table   = 'units';
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class, 'unit_id');
    }
}
