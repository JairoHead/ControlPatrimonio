<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('reportes_patrimonio', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->timestamp('fecha')->useCurrent();
            $table->unsignedBigInteger('usuario_id');
            $table->string('accion');
            $table->text('detalle')->nullable();
            $table->timestamps();

            $table->foreign('usuario_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reportes_patrimonio');
    }
};
