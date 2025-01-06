<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
