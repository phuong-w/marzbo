<?php

namespace App\Http\Requests\Permission;

use App\Acl\Acl;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return checkPermission(Acl::PERMISSION_PERMISSION_MANAGE);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' =>  ['required', 'string', 'max:100', Rule::unique('permissions', 'name')->ignore($this->permission)]
        ];
    }
}
