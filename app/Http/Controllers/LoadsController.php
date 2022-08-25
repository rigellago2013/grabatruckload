<?php

namespace App\Http\Controllers;

use App\Models\Load;
use App\ViewModel\Loads\LoadViewModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Spatie\ModelStates\Exceptions\TransitionNotAllowed;
use Spatie\ModelStates\Exceptions\TransitionNotFound;

class LoadsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Load::class, 'load');
    }

    public function index(): View
    {
        return view('loads.index', ['header' => 'Loads']);
    }

    public function create(): Factory|View|Application
    {
        return view('loads.create');
    }

    public function pickupDetails(Load $load): View
    {
        return view('loads.update-pickup-details', compact('load'));
    }

    public function deliveryDetails(Load $load): View
    {
        return view('loads.update-delivery-details', compact('load'));
    }

    public function show(Load $load)
    {
        return (new LoadViewModel($load))->view('loads.show');
    }

    public function edit(Load $load): Response
    {
        return response();
    }

    public function update(Request $request, Load $load): Response
    {
        return response();
    }

    public function destroy(Load $load): Response
    {
        return response();
    }

    // State changes
    public function transition(Load $load, string $state): RedirectResponse|Response
    {
        // All users must be able to update the load. Specific permissions are checked in the
        // transitions, ie for publish, accept etc.
        abort_unless(
            auth()->user()->can('update', $load),
            Response::HTTP_FORBIDDEN
        );

        try {
            $load->state->transitionTo($state, auth()->user());
        } catch (TransitionNotAllowed $transitionNotAllowed) {
            throw ValidationException::withMessages([
                'state' => "The transition to `{$state}` is not allowed.",
            ]);
        } catch (TransitionNotFound $transitionNotFound) {
            throw ValidationException::withMessages([
                'state' => "The transition to `{$state}` is not available for this load.",
            ]);
        }

        return back()
            ->with([
                'message' => 'Success',
            ]);
    }
}
