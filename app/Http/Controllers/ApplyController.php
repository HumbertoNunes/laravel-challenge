<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class ApplyController extends Controller
{
    public function __invoke(Request $request, Job $job)
    {
        $profile = auth()->user()->profile;

        if ($job->requirement === $profile->course) {
            $job->candidates()->attach($profile);
        }

        return to_route('job.index', ['page' => $request->page]);
    }
}
