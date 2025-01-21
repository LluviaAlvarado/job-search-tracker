<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'role',
        'job_description',
        'job_requirements',
        'anual_salary',
        'cv',
        'status',
        'application_date',
        'offer_date',
        'decision_date'
    ];

    public function jobInterviews()
    {
        return $this->hasMany(JobInterview::class, 'job_application_id', 'id');
    }
}
