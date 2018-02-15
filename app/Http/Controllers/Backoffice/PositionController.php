<?php namespace App\Http\Controllers\Backoffice;

use Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backoffice\PositionRequest;
use App\Models\History;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * function for show list position
     * @param  Request  $request
     * @return object
     */
    public function index(Request $request)
    {
        //get position sort by name
        $positions = Position::orderBy('id', 'desc')->get();

        //return page
        return view('backoffice.position.index', compact('positions'));
    }

    /**
     * function for get form new position
     * @return view
     */
    public function form($id = '')
    {
        $position = null;
        if (!empty($id) || $id != '') {
            $position = Position::find($id);
            if (empty($position)) {
                Alert::error("Jabatan Tidak Ditemukan");
                return back();
            }
        }

        //return page create position
        return view('backoffice.position.form', compact('position'));
    }

    /**
     * function save or update position
     * @param  positionRequest $request
     * @return object
     */
    public function save(
        PositionRequest $request,
        $id = ''
    ) {
        //check if request id/ form update
        if (!empty($id)) {
            //search position by id
            $position = Position::firstOrNew(['id' => $id])
                ->update($request->all());
            $this->createHistory(History::POSITION, History::EDIT, $position);
        } else {
            $position = Position::create($request->all());
            $this->createHistory(History::POSITION, History::CREATE, $position);
        }

        //return alert and back
        Alert::success("Sukses Simpan Data Jabatan");
        return redirect()->route('backoffice.positions');
    }

    /**
     * function for delete position
     * @param  [type] $id id position
     * @return back
     */
    public function delete($id)
    {
        //search and delete categiry by id
        $position = Position::find($id);
        if (empty($position)) {
            Alert::error("Jabatan Tidak Ditemukan");
            return back();
        }
        $this->createHistory(History::POSITION, History::DELETE, $position);
        $position->delete();

        return $position;
    }
}
