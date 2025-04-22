<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:250',
            'designation' => 'required|max:250',
            'youtube_link' => 'required_if:comment_type,==,Youtube Video',
            'video_link_id' => 'required_if:comment_type,==,Video From Computer',
            'comment' => 'required_if:comment_type,==,Text',
        ];
    }
}
