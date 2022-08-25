<?php

namespace App\Actions\Loads;

use App\Models\Load;
use Illuminate\Support\Str;
use Vinkla\Hashids\Facades\Hashids;

class UpdateLoadCode
{
    public function execute(Load $load): void
    {
        $load->update([
            'code' => 'load-' . Str::of(Hashids::encode($load->id))->split(4)->join('-'),
        ]);
    }
}
