<?php

namespace App\Rules;

trait LoadBasicDataRules
{
    public function rules(): array
    {
        return [
            'loadType' => 'required|string',
            'noOfItems' => 'required|numeric|integer|min:1',
            'weight' => 'required|numeric|integer|min:1',
            'volume' => 'required|numeric|min:0.1',
            'description' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:10000',
            'files.*' => 'mimes:csv,txt,xlx,xls,pdf,doc,docx|max:10000',
        ];
    }
}
