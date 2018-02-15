<?php namespace App\Composer;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * this function for check Privileges
 *
 * @param \Illuminate\View\View $view The view
 */
class SideBarComposer
{
    /**
     * this function for send data to view sidebar
     *
     * @param \Illuminate\View\View $view The view
     */
    public function compose(View $view)
    {
        if (Auth::user()->level == User::SUPERADMIN) {
            $menus = [
                [
                    'code' => 'backoffice.dashboard',
                    'icon' => 'fa fa-dashboard',
                    'menu' => 'Dashboard',
                ],
                [
                    'code' => 'backoffice.users',
                    'icon' => 'fa fa-user',
                    'menu' => 'User',
                ],
                [
                    'code' => 'backoffice.certificates',
                    'icon' => 'fa fa-credit-card',
                    'menu' => 'Sertifikat',
                ],
                [
                    'code' => 'backoffice.trainings',
                    'icon' => 'fa fa-address-card-o',
                    'menu' => 'Diklat',
                ],
                [
                    'code' => 'backoffice.histories',
                    'icon' => 'fa fa-history',
                    'menu' => 'History',
                ],
                [
                    'code' => 'backoffice.grades',
                    'icon' => 'fa fa-archive',
                    'menu' => 'Grade',
                ],
                [
                    'code' => 'backoffice.positions',
                    'icon' => 'fa fa-id-badge',
                    'menu' => 'Jabatan',
                ],
                [
                    'code' => 'backoffice.units',
                    'icon' => 'fa fa-beer',
                    'menu' => 'Bagian',
                ],
            ];
        } elseif (Auth::user()->level == User::ADMIN) {
            $menus = [
                [
                    'code' => 'backoffice.dashboard',
                    'icon' => 'fa fa-dashboard',
                    'menu' => 'Dashboard',
                ],
                [
                    'code' => 'backoffice.users',
                    'icon' => 'fa fa-user',
                    'menu' => 'User',
                ],
                [
                    'code' => 'backoffice.certificates',
                    'icon' => 'fa fa-credit-card',
                    'menu' => 'Sertifikat',
                ],
                [
                    'code' => 'backoffice.trainings',
                    'icon' => 'fa fa-address-card-o',
                    'menu' => 'Diklat',
                ],
                [
                    'code' => 'backoffice.grades',
                    'icon' => 'fa fa-archive',
                    'menu' => 'Grade',
                ],
                [
                    'code' => 'backoffice.positions',
                    'icon' => 'fa fa-id-badge',
                    'menu' => 'Jabatan',
                ],
                [
                    'code' => 'backoffice.units',
                    'icon' => 'fa fa-beer',
                    'menu' => 'Bagian',
                ],
            ];
        } else {
            $menus = [
                [
                    'code' => 'backoffice.dashboard',
                    'icon' => 'fa fa-dashboard',
                    'menu' => 'Dashboard',
                ],
                [
                    'code' => 'backoffice.trainings',
                    'icon' => 'fa fa-address-card-o',
                    'menu' => 'Diklat',
                ],
            ];
        }

        // return data to view
        $view->with('menus', $menus);
    }
}
