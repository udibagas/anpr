<?php

namespace App\Http\Requests;

use App\Models\AccessLog;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAccessLogRequest extends FormRequest
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
                $status = [
                    AccessLog::STATUS_REGISTERED,
                    AccessLog::STATUS_IN,
                    AccessLog::STATUS_HOLD
                ];

                if (in_array($this->status, $status)) {
                    $registered = AccessLog::whereIn('status', $status)
                        ->where('card_number', $value)
                        ->where('id', '!=', $this->id)->first();

                    if ($registered) {
                        $fail("Kartu terpakai untuk kendaraan dengan plat nomor {$registered->plat_nomor} tujuan {$registered->perusahaan->nama}");
                    }
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
            'bongkar_muat' => 'Barang',
            'keterangan' => 'Keterangan',
            'card_number' => 'Nomor Kartu'
        ];
    }
}
