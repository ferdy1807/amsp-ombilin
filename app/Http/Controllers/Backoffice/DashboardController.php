<?php namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\History;
use App\Models\Training;
use App\Models\Unit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $units                      = Unit::orderBy('name')->get();
        $user_have_certificates     = [];
        $user_have_not_certificates = [];
        $data_units                 = [];
        $certificate                = Certificate::orderBy('id');
        $training                   = Training::orderBy('id');
        $history                    = History::count();
        $user                       = User::count();
        $now                        = Carbon::now()->toDateString();
        $one_month                  = Carbon::now()->addMonths(-1)->toDateString();
        $three_month                = Carbon::now()->addMonths(-3)->toDateString();
        $six_month                  = Carbon::now()->addMonths(-6)->toDateString();
        $twelve_month               = Carbon::now()->addMonths(-12)->toDateString();
        $certificate_user           = Certificate::select('user_id', DB::raw('count(*) as total'))
            ->groupBy('user_id')
            ->get();
        $certificate_user = count($certificate_user);

        // check if access user
        if (Auth::user()->level == User::USER) {
            $certificate = $certificate->where('user_id', Auth::user()->id);
            $training    = $training->where('user_id', Auth::user()->id);
        }

        $certificate = $certificate->count();
        $training    = $training->count();

        // looping units
        foreach ($units as $unit) {
            $data_units[]          = $unit->name;
            $list_users            = $unit->users->pluck('id')->toArray();
            $user_have_certificate = Certificate::whereIn('user_id', $list_users)->select('user_id', DB::raw('count(*) as total'))
                ->groupBy('user_id');

            // check status
            // dd($one_month, $three_month, $six_month, $twelve_month);
            if (isset($request['1month'])) {
                $user_have_certificate = $user_have_certificate->where('created_at', '>', $one_month);                
            } elseif (isset($request['3month'])) {
                $user_have_certificate = $user_have_certificate->where('created_at', '>', $three_month);
            } elseif (isset($request['6month'])) {
                $user_have_certificate = $user_have_certificate->where('created_at', '>', $six_month);
            } elseif (isset($request['12month'])) {
                $user_have_certificate = $user_have_certificate->where('created_at', '>', $twelve_month);
            }

            // get data certificate
            $user_have_certificate = $user_have_certificate->get();

            $user_have_certificates[]     = count($user_have_certificate);
            $user_have_not_certificates[] = count($unit->users) - count($user_have_certificate);
        }

        return view('backoffice.dashboard.index', compact('certificate', 'history', 'training', 'user', 'certificate_user', 'data_units', 'user_have_certificates', 'user_have_not_certificates'));
    }
}
