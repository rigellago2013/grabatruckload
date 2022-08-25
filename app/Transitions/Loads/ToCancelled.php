<?php

namespace App\Transitions\Loads;

use App\Actions\Loads\DeleteLoadMatches;
use App\Models\Load;
use App\Notifications\LoadCancelled;
use App\States\Load\Cancelled;
use Spatie\ModelStates\Transition;

class ToCancelled extends Transition
{
    private Load $load;

    public function __construct(Load $load)
    {
        $this->load = $load;
    }

    public function handle(): Load
    {
        // @todo PENDING, PUBLISHED, NEGOTIATING can go to cancelled only

        // @todo ACCEPTED to cancelled is for customer service only

        $notifyUsers = $this->load->state === 'negotiating';

        $this->load->state = new Cancelled($this->load);
        $this->load->save();

        app(DeleteLoadMatches::class)->execute($this->load);

        if ($notifyUsers === true) {
            // @todo notify the truck owner that was negotiating

            // notify load owner
            $this->load->owner->notify(new LoadCancelled($this->load));
        }

        return $this->load;
    }
}
