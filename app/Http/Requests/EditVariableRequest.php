<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EditVariableRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = Auth::user()->id;
        $projectId = $this->project->id;
        return [
            'key' => ['required', Rule::unique('variables')->ignore($this->variable->id)->where(function ($query) use ($projectId) {
                return $query->where('key', $this->request->get('key'))->where('project_id', $projectId);
            })],
            'value' => 'required',
            'description' => 'nullable',
            'scope' => 'required'
        ];
    }


}
