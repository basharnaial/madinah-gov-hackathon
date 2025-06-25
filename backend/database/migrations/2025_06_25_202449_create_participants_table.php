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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->integer('age');
            $table->string('city');
            $table->enum('field_of_interest', ['AI', 'Web Development', 'IoT', 'Mobile Development', 'Data Science', 'Cybersecurity', 'Blockchain', 'Other']);
            $table->enum('registration_type', ['Individual', 'Team']);
            $table->string('cv_path')->nullable();
            $table->text('project_idea')->nullable();
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->boolean('terms_accepted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
