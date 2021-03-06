<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('rolegroup_id')->default(0)->comment = "id của bảng rolegroups";
            $table->string('controller')->comment = "Tên controller được truy cập (controller 1,controller 2,...)";
            $table->string('action')->comment = "Tên action được quyền truy cập";            
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
        Schema::dropIfExists('roles');
    }
}
