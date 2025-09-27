<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && in_array(auth()->user()->role->name, ['superadmin','admin']);
    }

    public function rules(): array
    {
        return [
            'name'      => ['required','string','max:255'],
            'email'     => ['required','email','max:255', Rule::unique('users','email')->ignore($this->user->id)],
            'password'  => ['nullable','string','min:8','confirmed'],
            'role_id'   => ['nullable','exists:roles,id'],
            'phone'     => ['nullable','string','max:32'],
            'birth_date'=> ['nullable','date'],
            'gender'    => ['nullable','string','max:16'],
            'address'   => ['nullable','string'],
            'is_pic'    => ['nullable','boolean'],
            'partner_school_id'    => ['nullable','exists:schools,id'],
            'current_class_group_id'=> ['nullable','exists:class_groups,id'],
            'avatar'    => ['nullable','file','image','max:2048'],
            'idcard'    => ['nullable','file','mimes:pdf,jpg,jpeg,png','max:5120'],
        ];
    }
}
