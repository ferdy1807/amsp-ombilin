<?php namespace App\Http\Requests\Backoffice;

use Illuminate\Foundation\Http\FormRequest;

class TrainingRequest extends FormRequest
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
        return [
            'name'           => 'required',
            'no_mail_call'   => 'required',
            'title_learning' => 'required',
            'date_training'  => 'required',
            'place_training' => 'required',
            'user_id'        => 'required|exists:users,id',
            'type'           => 'required',
            'follow'         => 'required',
            'follow_reason'  => 'required_if:follow,==,2',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'           => 'Kami membutuhkan data Nama kamu',
            'no_mail_call.required'   => 'Kami membutuhkan data No Surat Panggilan kamu',
            'title_learning.required' => 'Kami membutuhkan data Judul Diklat kamu',
            'date_training.required'  => 'Kami membutuhkan data Tanggal Diklat kamu',
            'place_training.required' => 'Kami membutuhkan data Tempat Diklat kamu',
            'user_id.required'        => 'Kami membutuhkan data User kamu',
            'user_id.exists'          => 'User yang kamu pilih tidak valid',
            'type.required'           => 'Kami membutuhkan data Jenis kamu',
            'follow.required'         => 'Kami membutuhkan data Mengikuti kamu',
            'follow_reason.required'  => 'Kami membutuhkan data Alasan Tidak Mengikuti kamu',
        ];
    }
}
