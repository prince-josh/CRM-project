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
            $table->unique(['organization_id', 'email'], 'unique_email_per_org');
            $table->index(['organization_id', 'email'], 'idx_org_email');
            $table->index('role', 'idx_role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('unique_email_per_org');
            $table->dropIndex('idx_org_email');
            $table->dropIndex('idx_role');
        });
    }
};
