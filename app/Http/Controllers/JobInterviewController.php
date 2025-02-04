<?php

namespace App\Http\Controllers;

use App\Models\JobInterview;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JobInterviewController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        JobInterview::create([
            ...$request->validate([
                'job_application_id' => 'required|numeric|max:20',
                'title' => 'required|string|max:100',
                'contact_info' => 'string|max:256',
                'description' => 'string',
                'scheduled_time' => 'date',
            ]),
        ]);
        return redirect($request->headers->get('referer'))
            ->with('success', 'New Interview created correctly!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobInterview $jobInterview)
    {
        $jobInterview->update([
            ...$request->validate([
                'job_application_id' => 'required|numeric|max:20',
                'title' => 'required|string|max:100',
                'contact_info' => 'string|max:256',
                'description' => 'string',
                'scheduled_time' => 'date',
            ]),
        ]);
        return redirect($request->headers->get('referer'))
            ->with('success', 'Interview edited correctly!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,  JobInterview $jobInterview)
    {
        $jobInterview->delete();
        redirect($request->headers->get('referer'))
            ->with('success', 'Interview deleted correctly!');
        return response()->json(
            [
                'message' => 'Job Application deleted successfully.'
            ],
            Response::HTTP_OK
        );
    }
}
