<?php namespace App\Composer;

use App\Models\Certificate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * this function for check Privileges
 *
 * @param \Illuminate\View\View $view The view
 */
class HeaderComposer
{
    /**
     * this function for send data to view sidebar
     *
     * @param \Illuminate\View\View $view The view
     */
    public function compose(View $view)
    {
        $one_month            = Carbon::now()->addMonths(1)->toDateString();
        $now                  = Carbon::now()->toDateString();
        $certificate_expireds = Certificate::where('date_expired', '<', $now);
        $certificate_warnings = Certificate::where('date_expired', '>=', $now)
            ->where('date_expired', '<', $one_month);

        if (Auth::user()->level == User::USER) {
            $certificate_expireds = $certificate_expireds->where('user_id', Auth::user()->id);
            $certificate_warnings = $certificate_warnings->where('user_id', Auth::user()->id);
        }

        $certificate_expireds = $certificate_expireds->get();
        $certificate_warnings = $certificate_warnings->get();

        // return data to view
        $view->with('certificate_expireds', $certificate_expireds)
            ->with('certificate_warnings', $certificate_warnings);
    }
}
