<?php namespace App\Models;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\URL;

class Certificate extends Model
{
    use SoftDeletes;

    protected $table   = 'certificates';
    protected $guarded = [];
    protected $appends = ['file_url', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getFileUrlAttribute()
    {
        if (empty($this->attributes['file']) || $this->attributes['file'] == null) {
            return asset('/images/user/user-admin.png');
        } else {
            return URL::to('medias' . config('path.certificate') . $this->attributes['file']);
        }
    }

    public function getStatusAttribute()
    {
        $now       = Carbon::now()->toDateString();
        $one_month = Carbon::now()->addMonths(1)->toDateString();
        $six_month = Carbon::now()->addMonths(6)->toDateString();
        $one_year  = Carbon::now()->addYears(1)->toDateString();
        $expired   = $this->attributes['date_expired'];

        if ($expired < $now) {
            return 'danger';
        } elseif ($expired > $now && $expired < $one_month) {
            // satu bulan
            return 'warning';
        } elseif ($expired > $now && $expired < $six_month) {
            // enam bulan
            return 'success';
            // } elseif ($expired > $now && $expired < $one_year) {
        } else {
            // satu tahun
            return 'primary';
        }
    }
}
