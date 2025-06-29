<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, temporarily change the field to varchar to allow data migration
        DB::statement("ALTER TABLE participants MODIFY COLUMN field_of_interest VARCHAR(255)");
        
        // Update existing data to new values
        DB::table('participants')->where('field_of_interest', 'AI')->update(['field_of_interest' => 'SmartMonitoring']);
        DB::table('participants')->where('field_of_interest', 'Web Development')->update(['field_of_interest' => 'SmartMobility']);
        DB::table('participants')->where('field_of_interest', 'IoT')->update(['field_of_interest' => 'SmartInfrastructure']);
        DB::table('participants')->where('field_of_interest', 'Mobile Development')->update(['field_of_interest' => 'DigitalHealthcare']);
        DB::table('participants')->where('field_of_interest', 'Data Science')->update(['field_of_interest' => 'EnvironmentalTech']);
        DB::table('participants')->where('field_of_interest', 'Cybersecurity')->update(['field_of_interest' => 'SmartInfrastructure']);
        DB::table('participants')->where('field_of_interest', 'Blockchain')->update(['field_of_interest' => 'InteractiveTourism']);
        // 'Other' remains the same
        
        // Now set the enum with new values
        DB::statement("ALTER TABLE participants MODIFY COLUMN field_of_interest ENUM('SmartMonitoring', 'InteractiveTourism', 'SmartMobility', 'DigitalHealthcare', 'EnvironmentalTech', 'SmartInfrastructure', 'Other')");
        
        // Update the enum for registration_type to include Organization
        DB::statement("ALTER TABLE participants MODIFY COLUMN registration_type ENUM('Individual', 'Team', 'Organization')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to original enums
        DB::statement("ALTER TABLE participants MODIFY COLUMN field_of_interest ENUM('AI', 'Web Development', 'IoT', 'Mobile Development', 'Data Science', 'Cybersecurity', 'Blockchain', 'Other')");
        
        DB::statement("ALTER TABLE participants MODIFY COLUMN registration_type ENUM('Individual', 'Team')");
    }
}; 