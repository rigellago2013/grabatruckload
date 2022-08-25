<?php

namespace App\Transitions\Loads;

use App\Actions\Loads\DeleteLoadMatches;
use App\Models\Load;
use App\Notifications\LoadExpiredNotification;
use App\States\Load\Expired;
use Spatie\ModelStates\Transition;

class PublishedToExpired extends Transition
{
    private Load $load;

    public function __construct(Load $load)
    {
        $this->load = $load;
    }

    public function handle(): Load
    {
        $this->load->state = new Expired($this->load);
        $this->load->save();

        app(DeleteLoadMatches::class)->execute($this->load);

        $this->load->owner->notify(new LoadExpiredNotification($this->load));

        return $this->load;
    }
}
