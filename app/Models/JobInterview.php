<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobInterview extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_application_id',
        'title',
        'contact_info',
        'description',
        'scheduled_time'
    ];
}
