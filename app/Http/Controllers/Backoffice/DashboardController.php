<?php namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\History;
use App\Models\Training;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $units                      = Unit::orderBy('name')->get();
        $user_have_certificates     = [];
        $user_have_not_certificates = [];
        $data_units                 = [];
        $certificate                = Certificate::orderBy('id');
        $training                   = Training::orderBy('id');
        $history                    = History::count();
        $user                       = User::count();
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
                ->groupBy('user_id')
                ->get();
            $user_have_certificates[]     = count($user_have_certificate);
            $user_have_not_certificates[] = count($unit->users) - count($user_have_certificate);
        }

        return view('backoffice.dashboard.index', compact('certificate', 'history', 'training', 'user', 'certificate_user', 'data_units', 'user_have_certificates', 'user_have_not_certificates'));
    }
}