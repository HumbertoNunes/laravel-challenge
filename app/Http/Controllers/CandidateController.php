<?php

namespace App\Http\Controllers;

use App\Http\Requests\CandidateCreateRequest;
use App\Http\Requests\CandidateUpdateRequest;
use App\Models\Candidate;

class CandidateController extends Controller
{
    public function store(CandidateCreateRequest $request)
    {
        auth()->user()->addProfile(
            Candidate::create($request->validated())
        );

        return to_route('profile.edit');
    }

    public function update(CandidateUpdateRequest $request)
    {
        $profile = auth()->user()->profile;

        $profile->fill($request->only(['course', 'biography']))->save();

        return to_route('profile.edit');
    }
}
