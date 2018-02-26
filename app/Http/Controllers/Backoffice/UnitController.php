<?php namespace App\Http\Controllers\Backoffice;

use Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backoffice\UnitRequest;
use App\Models\History;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * function for show list unit
     * @param  Request  $request
     * @return object
     */
    public function index(Request $request)
    {
        //get unit sort by name
        $units = Unit::orderBy('id', 'desc')->get();

        //return page
        return view('backoffice.unit.index', compact('units'));
    }

    /**
     * function for get form new unit
     * @return view
     */
    public function form($id = '')
    {
        $unit = null;
        if (!empty($id) || $id != '') {
            $unit = Unit::find($id);
            if (empty($unit)) {
                Alert::error("Bagian Tidak Ditemukan");
                return back();
            }
        }

        //return page create unit
        return view('backoffice.unit.form', compact('unit'));
    }

    /**
     * function save or update unit
     * @param  unitRequest $request
     * @return object
     */
    public function save(
        unitRequest $request,
        $id = ''
    ) {
        //check if request id/ form update
        if (!empty($id)) {
            //search unit by id
            $unit = Unit::firstOrNew(['id' => $id])
                ->update($request->all());
            $this->createHistory(History::UNIT, History::EDIT, $unit);
        } else {
            $unit = Unit::create($request->all());
            $this->createHistory(History::UNIT, History::CREATE, $unit);
        }

        //return alert and back
        Alert::success("Sukses Simpan Data Bagian");
        return redirect()->route('backoffice.units');
    }

    /**
     * function for delete unit
     * @param  [type] $id id unit
     * @return back
     */
    public function delete($id)
    {
        //search and delete categiry by id
        $unit = Unit::find($id);
        if (empty($unit)) {
            Alert::error("Bagian Tidak Ditemukan");
            return back();
        }
        $this->createHistory(History::UNIT, History::DELETE, $unit);
        $unit->delete();

        return $unit;
    }
}
