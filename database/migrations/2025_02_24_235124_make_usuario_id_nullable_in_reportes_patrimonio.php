<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('reportes_patrimonio', function (Blueprint $table) {
            $table->unsignedBigInteger('usuario_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('reportes_patrimonio', function (Blueprint $table) {
            // Aquí revertir el cambio si es necesario
            $table->unsignedBigInteger('usuario_id')->nullable(false)->change();
        });
    }
};
