<?php namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $histories = $this->search($request);
        $histories = $histories->get();

        return view('backoffice.history.index', compact('histories'));
    }

    /**
     * Searches for the first match.
     *
     * @param  object   $request The request
     * @return object
     */
    public function search($request)
    {
        $trainings = History::orderBy('id', 'desc');

        //check if request search training
        $created_at = $request->input('search_created_at');
        if (!empty($created_at)) {
            $created    = (explode("-", $created_at));
            $start_date = date("Y-m-d", strtotime(trim($created[0]))) . " 00:00:00";
            $end_date   = date("Y-m-d", strtotime(trim($created[1]))) . " 23:59:59";
            //search training by name
            $trainings = $trainings->where('created_at', '>=', $start_date)
                ->where('created_at', '<=', $end_date);
        }

        return $trainings;
    }
}
