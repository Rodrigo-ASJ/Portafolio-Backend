<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveProjectsRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'project_title' => ['required'],
            'project_description' => ['required'],
            'project_tech' =>  ['required'],
            'project_github' => ['required'],
            'project_deployment' => ['required'],
            'project_img' => ['']
        ];
    }
}
