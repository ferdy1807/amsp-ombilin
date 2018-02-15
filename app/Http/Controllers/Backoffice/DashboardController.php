<?php namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\History;
use App\Models\Training;
use App\Models\Unit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $certificate      = Certificate::count();
        $history          = History::count();
        $training         = Training::count();
        $user             = User::count();
        $certificate_user = Certificate::select('user_id', DB::raw('count(*) as total'))
            ->groupBy('user_id')
            ->get();
        $certificate_user     = count($certificate_user);
        $mytime               = Carbon::now();
        $one_month            = Carbon::now()->addMonths(1);
        $one_month            = $one_month->toDateString();
        $now                  = $mytime->toDateString();
        $certificate_expireds = Certificate::where('date_expired', '<', $now);
        $certificate_warnings = Certificate::where('date_expired', '>=', $now)
            ->where('date_expired', '<', $one_month);

        if (Auth::user()->level == User::USER) {
            $certificate_expireds = $certificate_expireds->where('user_id', Auth::user()->id);
            $certificate_warnings = $certificate_warnings->where('user_id', Auth::user()->id);
        }

        $certificate_expireds = $certificate_expireds->get();
        $certificate_warnings = $certificate_warnings->get();

        // get units
        $units                      = Unit::orderBy('name')->get();
        $user_have_certificates     = [];
        $user_have_not_certificates = [];
        $data_units                 = [];

        // looping units
        foreach ($units as $unit) {
            $data_units[]          = $unit->name;
            $list_users            = $unit->users->pluck('id')->toArray();
            $user_have_certificate = Certificate::whereIn('user_id', $list_users)->select('user_id', DB::raw('count(*) as total'))
                ->groupBy('user_id')
                ->get();
            $user_have_certificates[]     = count($user_have_certificate);
            $user_have_not_certificates[] = count($unit->users) - count($user_have_certificate);
        }

        return view('backoffice.dashboard.index', compact('certificate', 'history', 'training', 'user', 'certificate_user', 'certificate_expireds', 'certificate_warnings', 'data_units', 'user_have_certificates', 'user_have_not_certificates'));
    }
}
