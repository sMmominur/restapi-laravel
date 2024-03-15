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
        Schema::create('ip_lists', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 40)->nullable();
            $table->enum('status', ['Whitelist', 'Blocklist'])->default('Whitelist');
            $table->enum('ip_type', ['IPv4', 'IPv6'])->default('IPv4');
            $table->string('remarks', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ip_lists');
    }
};
