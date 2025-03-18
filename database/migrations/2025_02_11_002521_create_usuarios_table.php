<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasTable('empleados_sbn')) {
            Schema::create('empleados_sbn', function (Blueprint $table) {
                $table->id();
                $table->string('codigo')->unique();
                $table->string('nombres');
                $table->string('apellido_paterno');
                $table->string('apellido_materno');
                $table->string('tipo_doc_identidad');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('empleados_sbn');
    }
};
