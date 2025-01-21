<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('JobApplication/Index', [
            'jobApplications' => JobApplication::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('JobApplication/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        JobApplication::create([
            ...$request->validate([
                'company_name' => 'required|string|max:100',
                'role' => 'required|string|max:100',
                'job_description' => 'string',
                'job_requirements' => 'string',
                'anual_salary' => 'numeric',
                'cv' => 'file|mimes:pdf',
            ]),
            'status' => 'New',
        ]);
        return redirect()->route('jobApplication.index')
            ->with('success', 'New Job Application created correctly!');
    }

    /**
     * Display the specified resource.
     */
    public function show(JobApplication $jobApplication)
    {
        $jobApplication->load('jobInterviews');
        return inertia('JobApplication/Show', [
            'jobApplication' => $jobApplication
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobApplication $jobApplication)
    {
        return inertia('JobApplication/Edit', [
            'jobApplication' => $jobApplication
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobApplication $jobApplication)
    {
        $jobApplication->update([
            ...$request->validate([
                'company_name' => 'required|string|max:100',
                'role' => 'required|string|max:100',
                'job_description' => 'string',
                'job_requirements' => 'string',
                'anual_salary' => 'numeric',
            ]),
        ]);
        return redirect()->route('jobApplication.index')
            ->with('success', 'Job Application edited correctly!');
    }

    /**
     * Update the status of the job application.
     */
    public function updateStatus(Request $request, JobApplication $jobApplication)
    {
        $jobApplication->update([
            ...$request->validate([
                'status' => [
                    'required',
                    Rule::in(['New', 'Applied', 'Interviews', 'Offered', 'Rejected', 'Accepted'])
                ],
            ]),
        ]);
        return response()->json(
            [
                'message' => 'Job Application status updated to ' . $jobApplication->status
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobApplication $jobApplication)
    {
        $jobApplication->delete();
        return redirect()->route('jobApplication.index')
            ->with('success', 'Job Application deleted correctly!');
    }
}
