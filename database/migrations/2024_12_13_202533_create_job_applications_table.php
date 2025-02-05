<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->string('company_name', length: 100);
            $table->string('role', length: 100);
            $table->text('job_description');
            $table->text('job_requirements');
            $table->double('annual_salary')->nullable();
            $table->string('cv')->nullable();
            $table->binary('cv_file')->nullable();
            $table->string('status', length: 10);
            $table->boolean('offered')->default(false);
            $table->date('application_date')->nullable();
            $table->date('offer_date')->nullable();
            $table->date('decision_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
