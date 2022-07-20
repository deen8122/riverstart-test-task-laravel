<?php

namespace App\Http\Requests\Products;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class UpdateRequest extends FormRequest
{


    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' =>"nullable|max:255|min:1",
            'price' => "nullable|numeric",
            'category_id' => "required|array",
            'category_id.*' => 'exists:categories,id',
        ];
    }




}
