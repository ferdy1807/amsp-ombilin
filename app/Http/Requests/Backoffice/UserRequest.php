<?php namespace App\Http\Requests\Backoffice;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'nip'           => 'required',
            'name'          => 'required',
            'level'         => 'required|numeric',
            'date_of_birth' => 'required|date',
            'position_id'   => 'required',
            'grade_id'      => 'required',
            'unit_id'       => 'required',
        ];

        if (!empty($this->id)) {
            $rules['email']    = 'email|required|unique:users,email,' . $this->id;
            $rules['password'] = '';
            $rules['image']    = 'mimes:jpg,jpeg,png';
        } else {
            $rules['email']    = 'email|required|unique:users,email';
            $rules['password'] = 'required';
            $rules['image']    = 'required|mimes:jpg,jpeg,png';
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
            'nip.required'           => 'Kami membutuhkan data NIP kamu',
            'name.required'          => 'Kami membutuhkan data Nama kamu',
            'level.required'         => 'Kami membutuhkan data Level kamu',
            'date_of_birth.required' => 'Kami membutuhkan data Tanggal Lahir kamu',
            'position_id.required'   => 'Kami membutuhkan data Jabatan kamu',
            'grade_id.required'      => 'Kami membutuhkan data Grade kamu',
            'unit_id.required'       => 'Kami membutuhkan data Bagian kamu',
            'email.required'         => 'Kami membutuhkan data Email kamu',
            'email.email'            => 'Email Kamu tidak sesuai dengan formatnya',
            'email.unique'           => 'Email Kamu sudah ada yang memiliki',
            'image.mimes'            => 'Gambar Kamu tidak sesuai dengan formatnya',
            'image.required'         => 'Kami membutuhkan data Gambar kamu',
            'password.required'      => 'Kami membutuhkan data Password kamu',
        ];
    }
}
