<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $dumpPath = base_path('docker/mysql/test.sql');

        if (!file_exists($dumpPath)) {
            Log::error("File mot found: {$dumpPath}");
            throw new Exception("File mot found: {$dumpPath}");
        }

        DB::statement("SET NAMES 'utf8mb4';");
        DB::statement("SET sql_mode = '';");

        $sql = file_get_contents($dumpPath);

        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
