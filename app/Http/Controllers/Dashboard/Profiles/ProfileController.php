<?php

namespace App\Http\Controllers\Dashboard\Profiles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Profiles\UpdateRequest;
use App\Services\Dashboard\Profiles\ProfileService;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function edit()
    {
        return view('dashboard.profiles.edit');
    }

    public function update(UpdateRequest $request)
    {
        $profile = $this->profileService->update($request->validated());

        return redirect($profile['intended_url'])->with('alert', [
            'type' => 'success',
            'message' => $profile['message'],
        ]);
    }
}
