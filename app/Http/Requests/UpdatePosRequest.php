<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePosRequest extends FormRequest
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
            'name' => 'required|max:255|unique:pos,name,' . $this->id,
            'ip_address' => 'required|ipv4|unique:pos,ip_address,' . $this->id,
            'controller_ip_address' => 'required|ipv4|unique:pos,controller_ip_address,' . $this->id,
            'controller_port' => 'required|numeric',
            'camera_in' => 'array',
            'camera_out' => 'array',
            'status' => 'boolean'
        ];
    }
}
