<?php

namespace App\Http\Requests;

use App\Enums\LoadTypeEnum;
use App\Models\Load;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Enum\Laravel\Rules\EnumRule;

class CreateLoadRequest extends FormRequest
{
    public const RULES = [];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('create', new Load());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'weight' => [
                'required',
            ],
            'volume' => [
                'required',
            ],
            'internal_code' => [
                Rule::unique('users')->where(function ($query) {
                    return $query->where('user_id', auth()->user()->id);
                }),
            ],
            'load_type' => [
                new EnumRule(LoadTypeEnum::class),
            ],
            'images[]' => [
                'image',
                'dimensions:min_width=500,min_height=500',
                'max:5120', // 5MB max file size
            ],
            'files[]' => [
                'image',
                'mimes:pdf,doc,docx,xls,xlsx',
                'max:20480', // 25MB max file size
            ],
        ];
    }
}
