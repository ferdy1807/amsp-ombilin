<?php namespace App\Http\Controllers\Backoffice;

use Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backoffice\GradeRequest;
use App\Models\Grade;
use App\Models\History;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * function for show list grade
     * @param  Request  $request
     * @return object
     */
    public function index(Request $request)
    {
        //get grade sort by name
        $grades = Grade::orderBy('id', 'desc')->get();

        //return page
        return view('backoffice.grade.index', compact('grades'));
    }

    /**
     * function for get form new grade
     * @return view
     */
    public function form($id = '')
    {
        $grade = null;
        if (!empty($id) || $id != '') {
            $grade = Grade::find($id);
            if (empty($grade)) {
                Alert::error("Grade Tidak Ditemukan");
                return back();
            }
        }

        //return page create grade
        return view('backoffice.grade.form', compact('grade'));
    }

    /**
     * function save or update grade
     * @param  gradeRequest $request
     * @return object
     */
    public function save(
        GradeRequest $request,
        $id = ''
    ) {
        //check if request id/ form update
        if (!empty($id)) {
            //search grade by id
            $grade = Grade::firstOrNew(['id' => $id])
                ->update($request->all());
            $this->createHistory(History::GRADE, History::EDIT, $grade);
        } else {
            $grade = Grade::create($request->all());
            $this->createHistory(History::GRADE, History::CREATE, $grade);
        }

        //return alert and back
        Alert::success("Sukses Simpan Data Grade");
        return redirect()->route('backoffice.grades');
    }

    /**
     * function for delete grade
     * @param  [type] $id id grade
     * @return back
     */
    public function delete($id)
    {
        //search and delete categiry by id
        $grade = Grade::find($id);
        if (empty($grade)) {
            Alert::error("Grade Tidak Ditemukan");
            return back();
        }
        $this->createHistory(History::GRADE, History::DELETE, $grade);
        $grade->delete();

        return $grade;
    }
}
