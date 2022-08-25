<?php

namespace App\Transitions\Loads;

use App\Models\Load;
use App\Models\User;
use App\Notifications\LoadPendingApprovalNotification;
use App\States\Load\Pending;
use Spatie\ModelStates\Transition;

class DraftToPending extends Transition
{
    private Load $load;
    private ?User $user;

    public function __construct(Load $load, ?User $user)
    {
        $this->load = $load;
        $this->user = $user ?? auth()->user();
    }

    public function handle(): Load
    {
        // @todo which roles can do this?
        $this->load->state = new Pending($this->load);
        $this->load->save();

        // Send to customer service
        User::role('customer-service')->get()->each(function (User $user): void {
            $user->notify(new LoadPendingApprovalNotification($this->load));
        });

        return $this->load;
    }
}
