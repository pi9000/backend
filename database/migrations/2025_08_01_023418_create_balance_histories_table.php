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
        Schema::create('balance_histories', function (Blueprint $table) {
            $table->id();
            $table->string('parent_id');
            $table->string('destination_id');
            $table->string('agent_id');
            $table->string('parent_before_balance');
            $table->string('parent_after_balance');
            $table->string('before_balance');
            $table->string('after_balance');
            $table->text('note');
            $table->integer('type');
            $table->string('ip_address')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balance_histories');
    }
};
