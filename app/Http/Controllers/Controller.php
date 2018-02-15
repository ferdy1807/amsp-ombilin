<?php namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function createHistory(
        $menu,
        $function,
        $payload = ''
    ) {
        $data = [
            'object_id' => $menu,
            'function'  => $function,
            'user_id'   => Auth::user()->id,
            'payload'   => json_encode($payload),
        ];

        History::create($data);
    }
}
