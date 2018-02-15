<?php namespace App\Http\Controllers\Backoffice;

use Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backoffice\UserRequest;
use App\Models\Grade;
use App\Models\History;
use App\Models\Position;
use App\Models\Unit;
use App\Models\User;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * function for show list User
     * @param  Request  $request
     * @return object
     */
    public function index(Request $request)
    {
        $users = $this->search($request);
        //get User
        $users = $users->get();

        //return page
        return view('backoffice.user.index', compact('users'));
    }

    /**
     * function for get form new User
     * @return view
     */
    public function form($id = '')
    {
        $positions = Position::orderBy('name')->pluck('name', 'id');
        $grades    = Grade::orderBy('name')->pluck('name', 'id');
        $units     = Unit::orderBy('name')->pluck('name', 'id');
        $user      = null;
        if (!empty($id) || $id != '') {
            $user = User::find($id);
            if (empty($user)) {
                Alert::error("User Tidak Ditemukan");
                return back();
            }
        }

        //return page create User
        return view('backoffice.user.form', compact('user', 'positions', 'grades', 'units'));
    }

    /**
     * function save or update User
     * @param  UserRequest $request
     * @return object
     */
    public function save(
        UserRequest $request,
        $id = ''
    ) {
        $data = $request->all();

        //get file image
        $file = $request->file('image');
        if (!empty($file)) {
            //set new name image
            $fileName = str_random(15) . time() . '.' . $file->getClientOriginalExtension();
            $storage  = Storage::put(
                config('path.user') . $fileName,
                file_get_contents($file->getRealPath()),
                'public'
            );

            $data['image'] = $fileName;
        } else {
            unset($data['image']);
        }

        // save password
        $password = $request->input('password');
        if (!empty($password)) {
            $data['password'] = Hash::make($password);
        } else {
            unset($data['password']);
        }

        //check if request id/ form update
        if (!empty($id)) {
            //search User by id
            $user = User::firstOrNew(['id' => $id])
                ->update($data);
            $this->createHistory(History::USER, History::EDIT, $user);
        } else {
            $user = User::create($data);
            $this->createHistory(History::USER, History::CREATE, $user);
        }

        //return alert and back
        Alert::success("Sukses Simpan Data User");
        return redirect()->route('backoffice.users');
    }

    /**
     * function for delete User
     * @param  [type] $id id User
     * @return back
     */
    public function delete($id)
    {
        //search and delete categiry by id
        $user = User::find($id);
        if (empty($user)) {
            Alert::error("User Tidak Ditemukan");
            return back();
        }
        $this->createHistory(History::USER, History::DELETE, $user);
        Storage::delete(config('path.user') . $user->image);
        $user->delete();

        return $user;
    }

    /**
     * Searches for the first match.
     *
     * @param  object   $request The request
     * @return object
     */
    public function search($request)
    {
        //get User sort by name
        $users = User::orderBy('id', 'desc');

        //check if request search users
        $created_at = $request->input('search_created_at');
        if (!empty($created_at)) {
            $created    = (explode("-", $created_at));
            $start_date = date("Y-m-d", strtotime(trim($created[0])));
            $end_date   = date("Y-m-d", strtotime(trim($created[1])));
            //search users by name
            $users = $users->where('created_at', '>=', $start_date)
                ->where('created_at', '<=', $end_date);
        }

        return $users;
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
        $users = $this->search($request);

        //get user
        $users = $users->get();
        $this->createHistory(History::USER, History::EXPORT, $users);

        // generate to excel
        return Excel::create('Data Pegawai', function ($excel) use ($users) {
            $excel->sheet('sheet1', function ($sheet) use ($users) {
                $sheet->loadView('backoffice.user.excel')
                    ->with('users', $users);
            });
        })->download('csv');

        return redirect()->route('backoffice.users');
    }

    /**
     * function for get form new User
     * @return view
     */
    public function detail($id = '')
    {
        $user = User::find($id);
        if (empty($user)) {
            Alert::error("User Tidak Ditemukan");
            return back();
        }

        //return page create User
        return view('backoffice.user.detail', compact('user'));
    }
}
