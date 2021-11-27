<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profesor_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->integer('puntualidad');
            $table->integer('personalidad');
            $table->integer('aprendizaje_obtenido');
            $table->integer('manera_evaluar');
            $table->integer('calificacion_obtenida');
            $table->integer('conocimiento');
            $table->string('categoria');
            $table->text('comentario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grades');
    }
}
