<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pizzak', function (Blueprint $table) {
            $table->id();
            $table->string('nev', 100);
            $table->foreignId('kategoria_id')->constrained('kategoriak')->onDelete('cascade');
            $table->boolean('vegetarianus')->default(false);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('pizzak');
    }
};
