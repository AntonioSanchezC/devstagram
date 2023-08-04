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
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            //asociamos el id del user (user_id que es como esta en BD)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');;
            // y el post
            $table->foreignId('post_id')->constrained()->onDelete('cascade');;
            // y el comentario que reciba
            $table->string('comentario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};
