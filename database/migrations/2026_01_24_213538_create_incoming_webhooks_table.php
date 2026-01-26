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
        Schema::create('incoming_webhooks', function (Blueprint $table) {
            $table->id();
            $table->string('bank')->nullable();
            $table->longText('payload')->nullable();
            $table->enum('status', ['recived', 'done', 'processed', 'failed'])->default('recived');
            $table->timestamp('received_at')->useCurrent();
            $table->timestamp('processed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incoming_webhooks');
    }
};
