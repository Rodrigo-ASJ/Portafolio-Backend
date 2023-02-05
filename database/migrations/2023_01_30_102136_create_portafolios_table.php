<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portafolios', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id'); // almacenar id de las personas que suban la imagen
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade'); // llave foranea, referencia a la columna id, en la migracion users, borra todo los registros si se borra el usuario

            $table->string('project_title');
            $table->string('project_img');
            $table->longText('project_description');
            $table->string('project_tech');
            $table->string('project_github');
            $table->string('project_deployment');
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
        Schema::dropIfExists('portafolios');
    }
};
