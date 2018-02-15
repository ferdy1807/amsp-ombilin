<?php namespace App\Http\Requests\Backoffice;

use Illuminate\Foundation\Http\FormRequest;

class CertificateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'             => 'required',
            'certificate_code' => 'required',
            'user_id'          => 'required|exists:users,id',
        ];

        if (!empty($this->id)) {
            $rules['file'] = 'mimes:jpg,jpeg,png,pdf';
        } else {
            $rules['file'] = 'required|mimes:jpg,jpeg,png,pdf';
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'             => 'Kami membutuhkan data Nama kamu',
            'certificate_code.required' => 'Kami membutuhkan data Kode Sertifikat kamu',
            'file.required'             => 'Kami membutuhkan data Berkas Sertifikat kamu',
            'user_id.required'          => 'Kami membutuhkan data User kamu',
            'user_id.exists'            => 'User yang kamu pilih tidak valid',
            'image.mimes'               => 'Berkas Kamu tidak sesuai dengan formatnya',
        ];
    }
}
