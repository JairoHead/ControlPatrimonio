<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexesToReportesPatrimonioTable extends Migration
{
    public function up()
    {
        Schema::table('reportes_patrimonio', function (Blueprint $table) {
            $table->index('codigo');
            $table->index('fecha');
        });
    }

    public function down()
    {
        Schema::table('reportes_patrimonio', function (Blueprint $table) {
            $table->dropIndex(['codigo']);
            $table->dropIndex(['fecha']);
        });
    }
}