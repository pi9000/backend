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
        Schema::create('request_otps', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id');
            $table->string('action');
            $table->string('code');
            $table->string('ip_address');
            $table->integer('status')->lenght(10)->default(0);
            $table->timestamp('expired_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_otps');
    }
};
