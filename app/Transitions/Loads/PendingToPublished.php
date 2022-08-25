<?php

namespace App\Transitions\Loads;

use App\Actions\Loads\CreateLoadMatches;
use App\Models\Load;
use App\Models\User;
use App\States\Load\Published;
use Illuminate\Support\Facades\Gate;
use Spatie\ModelStates\Transition;
use Symfony\Component\HttpFoundation\Response;

class PendingToPublished extends Transition
{
    private Load $load;
    private ?User $user;

    public function __construct(Load $load, ?User $user = null)
    {
        $this->load = $load;
        $this->user = $user ?? auth()->user();
    }

    public function handle(): Load
    {
        if (! app()->runningInConsole() && ! Gate::forUser($this->user)->allows('publish', $this->load)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->load->state = new Published($this->load);
        $this->load->save();

        app(CreateLoadMatches::class)->execute($this->load, true);

        return $this->load;
    }
}
