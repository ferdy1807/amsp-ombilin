<?php namespace App\Http\Controllers\Backoffice;

use Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backoffice\CertificateRequest;
use App\Models\Certificate;
use App\Models\History;
use App\Models\User;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    /**
     * function for show list certificate
     * @param  Request  $request
     * @return object
     */
    public function index(Request $request)
    {
        $certificates = $this->search($request);

        //get certificate
        $certificates = $certificates->get();

        //return page
        return view('backoffice.certificate.index', compact('certificates'));
    }

    /**
     * function for get form new certificate
     * @return view
     */
    public function form($id = '')
    {
        $users       = User::orderBy('name', 'asc')->pluck('name', 'id');
        $certificate = null;
        if (!empty($id) || $id != '') {
            $certificate = Certificate::find($id);
            if (empty($certificate)) {
                Alert::error("certificate Tidak Ditemukan");
                return back();
            }
        }

        //return page create certificate
        return view('backoffice.certificate.form', compact('certificate', 'users'));
    }

    /**
     * function save or update certificate
     * @param  certificateRequest $request
     * @return object
     */
    public function save(
        CertificateRequest $request,
        $id = ''
    ) {
        $data = $request->all();

        //get file file
        $file = $request->file('file');
        if (!empty($file)) {
            //set new name file
            $fileName = str_random(15) . time() . '.' . $file->getClientOriginalExtension();
            $storage  = Storage::put(
                config('path.certificate') . $fileName,
                file_get_contents($file->getRealPath()),
                'public'
            );

            $data['file'] = $fileName;
        } else {
            unset($data['file']);
        }

        //check if request id/ form update
        if (!empty($id)) {
            //search certificate by id
            $certificate = Certificate::firstOrNew(['id' => $id])
                ->update($data);
            $this->createHistory(History::CERTIFICATE, History::EDIT, $certificate);
        } else {
            $certificate = Certificate::create($data);
            $this->createHistory(History::CERTIFICATE, History::CREATE, $certificate);
        }

        //return alert and back
        Alert::success("Sukses Simpan Data Sertifikat");
        return redirect()->route('backoffice.certificates');
    }

    /**
     * function for delete certificate
     * @param  [type] $id id certificate
     * @return back
     */
    public function delete($id)
    {
        //search and delete categiry by id
        $certificate = Certificate::find($id);
        if (empty($certificate)) {
            Alert::error("certificate Tidak Ditemukan");
            return back();
        }
        $this->createHistory(History::CERTIFICATE, History::DELETE, $certificate);
        Storage::delete(config('path.certificate') . $certificate->file);
        $certificate->delete();

        return $certificate;
    }

    /**
     * Searches for the first match.
     *
     * @param  object   $request The request
     * @return object
     */
    public function search($request)
    {
        //get certificate sort by name
        $certificates = Certificate::orderBy('id', 'desc');

        //check if request search certificate
        $search_date_expired = $request->input('search_search_date_expired');
        if (!empty($search_date_expired)) {
            $created    = (explode("-", $search_date_expired));
            $start_date = date("Y-m-d", strtotime(trim($created[0])));
            $end_date   = date("Y-m-d", strtotime(trim($created[1])));
            //search certificate by name
            $certificates = $certificates->where('date_expired', '>=', $start_date)
                ->where('date_expired', '<=', $end_date);
        }

        //check if request search certificate
        $created_at = $request->input('search_created_at');
        if (!empty($created_at)) {
            $created    = (explode("-", $created_at));
            $start_date = date("Y-m-d", strtotime(trim($created[0])));
            $end_date   = date("Y-m-d", strtotime(trim($created[1])));
            //search certificate by name
            $certificates = $certificates->where('created_at', '>=', $start_date)
                ->where('created_at', '<=', $end_date);
        }

        return $certificates;
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
        $certificates = $this->search($request);

        //get certificate
        $certificates = $certificates->get();

        $this->createHistory(History::CERTIFICATE, History::EXPORT, $certificates);

        // generate to excel
        return Excel::create('Data Sertifikat', function ($excel) use ($certificates) {
            $excel->sheet('sheet1', function ($sheet) use ($certificates) {
                $sheet->loadView('backoffice.certificate.excel')
                    ->with('certificates', $certificates);
            });
        })->download('csv');

        return redirect()->route('backoffice.certificates');
    }
}
