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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('name'); // ❌ Not Nullable (Required)
            $table->string('email')->unique(); // ❌ Not Nullable (Required)
            $table->string('password'); // ❌ Not Nullable (Required)
            $table->string('phone')->nullable(); // ✅ Nullable (Optional)
            $table->string('role')->default('user'); // ✅ Has a default value
            $table->boolean('is_active')->default(true); // ✅ Has a default value
            $table->timestamps(); // ✅ Nullable (Handled by Laravel)
            $table->softDeletes(); // ✅ Nullable (Handled by Laravel)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};