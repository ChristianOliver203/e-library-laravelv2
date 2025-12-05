<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained('books');
            $table->string('borrower'); // name-based borrowing
            $table->date('borrow_date');
            $table->string('status')->default('Borrowed'); // Borrowed / Returned
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('borrows');
    }
};
