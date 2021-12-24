<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'text' => ['required', 'string', 'max:255'],
            'rate' => ['required', 'numeric',  'min:0', 'max:5']
        ];
    }
}
