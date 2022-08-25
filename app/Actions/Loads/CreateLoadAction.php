<?php

namespace App\Actions\Loads;

use App\Data\Loads\BasicData;
use App\Models\Load;

class CreateLoadAction
{
    public function execute(BasicData $data): Load
    {
        // If there is an existing load with an internal reference should we update assuming something went wrong
        // with the file or image saving??

        // We can assume basic data is already validated
        $load = Load::create([
            'weight' => $data->weight,
            'volume' => $data->volume,
            'user_id' => $data->user->id ?? auth()->user()->id,
            'internal_code' => $data->reference,
            'load_type' => $data->loadType,
            'description' => $data->description,
        ]);

        app(UpdateLoadCode::class)->execute($load);

        // Handle images
        foreach ((array)$data->images as $image) {
            $load->addMedia($image)
                ->toMediaCollection('images');
        }

        // Handle files
        foreach ((array)$data->files as $file) {
            $load->addMedia($file)
                ->toMediaCollection('files');
        }


        // return load
        return $load;
    }
}
