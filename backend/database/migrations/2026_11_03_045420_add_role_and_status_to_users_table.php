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
    Schema::table('users', function (Blueprint $table) {
        $table->unsignedTinyInteger('role')->default(3)->after('password');   // 1 admin, 2 vendor, 3 shop owner
        $table->unsignedTinyInteger('status')->default(0)->after('role');     // 0 pending, 1 approved, 2 suspended
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['role', 'status']);
    });
}
};
