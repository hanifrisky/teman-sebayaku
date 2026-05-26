<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ubah ENUM menjadi VARCHAR agar lebih fleksibel menampung 'youtube'
        DB::statement("ALTER TABLE lesson_sections MODIFY COLUMN type VARCHAR(50) NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan ke ENUM (opsional, tapi disarankan tetap varchar agar tidak error jika di rollback dan ada data youtube)
        // DB::statement("ALTER TABLE lesson_sections MODIFY COLUMN type ENUM('text', 'image', 'video', 'pdf', 'link') NOT NULL");
    }
};
