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
        Schema::create('wedding_comments', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->enum('presence', [
                'Hadir',
                'Berhalangan',
            ]);

            $table->text('message');

            $table->ipAddress('ip_address')->nullable();
            $table->text('user_agent')->nullable();

            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->boolean('is_published')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weding_comments');
    }
};
