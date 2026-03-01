<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BorrowingUpdateRequest extends FormRequest
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
            //
            "borrowed_date"=>"nullable|date",
            "book_id"=>"nullable|integer",
            "member_id"=>"nullable|integer",
            "returned_date"=>"required|date",
            "status"=>"required|string",
        ];
    }
}
