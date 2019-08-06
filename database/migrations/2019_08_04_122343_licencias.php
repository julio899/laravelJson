<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Licencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creando la tabla para las licencias

        Schema::create('licencias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->date('expire');
            $table->timestamp('confirmada')->nullable();
            $table->string('status');
            $table->timestamps();
        });
        // primer registro licencia demo
        INSERT INTO `licencias` (`id`, `code`, `expire`, `confirmada`, `status`, `created_at`, `updated_at`) VALUES (NULL, 'c95212f10ee3c332ad7db40ad542e6691c6ff7b6', '2019-08-31', NULL, 'A', NULL, NULL);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // borrado para actualizar estructura lo limpiar datos
        Schema::dropIfExists('licencias');
    }
}
