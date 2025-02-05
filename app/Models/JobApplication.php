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
        'cv_file',
        'status',
        'application_date',
        'offer_date',
        'decision_date'
    ];

    public function scopeWithoutCV($query)
    {
        $columns = $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
        $columns = array_diff($columns, ['cv_file']);
        return $query->select($columns);
    }

    public function jobInterviews()
    {
        return $this->hasMany(JobInterview::class, 'job_application_id', 'id')
            ->orderBy('scheduled_time', 'desc');
    }
}
