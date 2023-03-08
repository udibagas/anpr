<?php

namespace App\Http\Requests;

use App\Models\AccessLog;
use Illuminate\Foundation\Http\FormRequest;

class StoreAccessLogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'perusahaan_id' => 'required|exists:perusahaans,id',
            'dari' => 'required|max:255',
            'plat_nomor' => 'required|max:255',
            'bongkar_muat' => 'required|in:BONGKAR,MUAT',
            'keterangan' => 'max:255',
            'card_number' => ['required', function ($attribute, $value, $fail) {
                $registered = AccessLog::whereIn(
                    'status',
                    [
                        AccessLog::STATUS_REGISTERED,
                        AccessLog::STATUS_IN,
                        AccessLog::STATUS_HOLD
                    ]
                )->where('card_number', $value)->first();

                if ($registered) {
                    $fail("Kartu terpakai untuk kendaraan dengan plat nomor {$registered->plat_nomor} tujuan {$registered->perusahaan->nama}");
                }
            }]
        ];
    }

    public function attributes()
    {
        return [
            'perusahaan_id' => 'Tujuan',
            'dari' => 'Dari',
            'plat_nomor' => 'Plat Nomor',
            'bongkar_muat' => 'Bongkar Muat',
            'keterangan' => 'Keterangan',
            'card_number' => 'Nomor Kartu',
            'time_in' => 'date_format:Y-m-d h:i'
        ];
    }
}
