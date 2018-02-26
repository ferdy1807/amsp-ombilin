<?php namespace App\Http\Controllers\Backoffice;

use Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backoffice\TrainingRequest;
use App\Models\History;
use App\Models\Training;
use App\Models\User;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use Yajra\Datatables\Datatables;

class TrainingController extends Controller
{
    /**
     * function for show list training
     * @param  Request  $request
     * @return object
     */
    public function index(Request $request)
    {
        // search data
        $trainings = $this->search($request);

        //get training
        $trainings = $trainings->get();

        //return page
        return view('backoffice.training.index', compact('trainings'));
    }

    /**
     * function for get form new training
     * @return view
     */
    public function form($id = '')
    {
        $users    = User::orderBy('name', 'asc')->pluck('name', 'id');
        $training = null;
        if (!empty($id) || $id != '') {
            $training = Training::find($id);
            if (empty($training)) {
                Alert::error("Diklat Tidak Ditemukan");
                return back();
            }
        }

        //return page create training
        return view('backoffice.training.form', compact('training', 'users'));
    }

    /**
     * function save or update training
     * @param  trainingRequest $request
     * @return object
     */
    public function save(
        TrainingRequest $request,
        $id = ''
    ) {
        //check if request id/ form update
        if (!empty($id)) {
            //search training by id
            $training = Training::firstOrNew(['id' => $id])
                ->update($request->all());
            $this->createHistory(History::TRAINING, History::EDIT, $training);
        } else {
            $training = Training::create($request->all());
            $this->createHistory(History::TRAINING, History::CREATE, $training);
        }

        //return alert and back
        Alert::success("Sukses Simpan Data Diklat");
        return redirect()->route('backoffice.trainings');
    }

    /**
     * function for delete training
     * @param  [type] $id id training
     * @return back
     */
    public function delete($id)
    {
        //search and delete categiry by id
        $training = Training::find($id);
        if (empty($training)) {
            Alert::error("Diklat Tidak Ditemukan");
            return back();
        }
        $this->createHistory(History::TRAINING, History::DELETE, $training);
        $training->delete();

        return $training;
    }

    /**
     * Searches for the first match.
     *
     * @param  object   $request The request
     * @return object
     */
    public function search($request)
    {
        $trainings = Training::orderBy('id', 'desc');

        // check level
        if (Auth::user()->level == User::USER) {
            $trainings = $trainings->where('user_id', Auth::user()->id);
        }

        //check if request search training
        $date_training = $request->input('search_date_training');
        if (!empty($date_training)) {
            $created    = (explode("-", $date_training));
            $start_date = date("Y-m-d", strtotime(trim($created[0]))) . " 00:00:00";
            $end_date   = date("Y-m-d", strtotime(trim($created[1]))) . " 23:59:59";
            //search training by name
            $trainings = $trainings->where('date_training', '>=', $start_date)
                ->where('date_training', '<=', $end_date);
        }

        //check if request search training finish
        $end_date_training = $request->input('search_end_date_training');
        if (!empty($end_date_training)) {
            $created    = (explode("-", $end_date_training));
            $start_date = date("Y-m-d", strtotime(trim($created[0]))) . " 00:00:00";
            $end_date   = date("Y-m-d", strtotime(trim($created[1]))) . " 23:59:59";
            //search training by name
            $trainings = $trainings->where('end_date_training', '>=', $start_date)
                ->where('end_date_training', '<=', $end_date);
        }

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

    /**
     * this function to export to excel
     *
     * @param  \Illuminate\Http\Request $request The request
     * @return object
     */
    public function export(Request $request)
    {
        // search data
        $trainings = $this->search($request);

        //get training
        $trainings = $trainings->get();
        $this->createHistory(History::TRAINING, History::EXPORT, $trainings);

        // generate to excel
        return Excel::create('Data Diklat', function ($excel) use ($trainings) {
            $excel->sheet('sheet1', function ($sheet) use ($trainings) {
                $sheet->loadView('backoffice.training.excel')
                    ->with('trainings', $trainings);
            });
        })->download('csv');

        return redirect()->route('backoffice.trainings');
    }
}
