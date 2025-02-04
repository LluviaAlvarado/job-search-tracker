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
            'jobApplications' => JobApplication::with('jobInterviews')
                ->WithoutCV()
                ->get()
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
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:100',
            'role' => 'required|string|max:100',
            'job_description' => 'string',
            'job_requirements' => 'string',
            'anual_salary' => 'numeric',
            'cv' => 'file|mimes:pdf',
        ]);
        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $validatedData['cv_file'] = file_get_contents($file->getRealPath());
            $validatedData['cv'] = $file->getClientOriginalName();
        }
        $validatedData['status'] = 'New';
        JobApplication::create($validatedData);

        return redirect()->route('jobApplication.index')
            ->with('success', 'New Job Application created correctly!');
    }

    /**
     * Display the specified resource.
     */
    public function show(JobApplication $jobApplication)
    {
        $jobApplication = $jobApplication->with('jobInterviews')
            ->WithoutCV()->first();
        return inertia('JobApplication/Show', [
            'jobApplication' => $jobApplication
        ]);
    }

    /**
     * Get the cv pdf file.
     */
    public function getCV(JobApplication $jobApplication)
    {
        return response($jobApplication->cv_file)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="' . $jobApplication->cv . '"');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobApplication $jobApplication)
    {
        $jobApplication = $jobApplication->WithoutCV()->first();
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
            ($request->get('status') === 'Applied' ? 'application_date' : null) => now(),
            ($request->get('status') === 'Offered' ? 'offer_date' : null) => now(),
            ($request->get('status') === 'Accepted' || $request->get('status') === 'Rejected' ?
                'decision_date' : null) => now(),
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
        $jobApplication->jobInterviews()->delete();
        $jobApplication->delete();
        redirect()->route('jobApplication.index')
            ->with('success', 'Job Application deleted successfully');
        return response()->json(
            [
                'message' => 'Job Application deleted successfully.'
            ],
            Response::HTTP_OK
        );
    }
}
