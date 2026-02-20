<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookInsertRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title"=>"required|min:3|max:100|string",
            "isbn"=>"nullable|number",
            "description"=>"required|min:10|max:110",
            "published_at"=>"nullable|number",
            "total_copies"=>"required|number",
            "avialable_copies"=>"required|number",
            "cover_image"=>"nullable|string",
            "status"=>"required",
            "price"=>"nullable|number",
            "author_id"=>"required|integer",
            "genre"=>"required",
        ];
    }
}
