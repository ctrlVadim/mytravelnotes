<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'article' => ['required', 'string', 'max:3000'],
            'file' => ['image', 'mimes:jpg,png,jpeg,svg']
        ];
    }
}
