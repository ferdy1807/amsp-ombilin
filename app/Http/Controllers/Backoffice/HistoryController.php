<?php namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $histories = History::orderBy('id', 'desc')->get();

        return view('backoffice.history.index', compact('histories'));
    }
}
