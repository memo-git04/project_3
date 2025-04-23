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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('full_name');
            $table->string('email');
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->boolean('is_active')->default(1); //1: active, 0: inactive
            $table->boolean('is_deleted')->default(0); //1: deleted, 0: not deleted
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
