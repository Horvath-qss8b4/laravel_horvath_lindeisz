<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('rendelesek', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pizza_id')->constrained('pizzak')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('mennyiseg')->default(1);
            $table->timestamp('datum')->useCurrent();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('rendelesek');
    }
};
