<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblRespMetaTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'tbl_resp_meta';

    /**
     * Run the migrations.
     * @table tbl_resp_meta
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->char('tablename', 255)->nullable()->default(null);
            $table->longText('msg')->nullable()->default(null);
            $table->dateTime('insert_date')->nullable()->default(null);
            $table->dateTime('altered_date')->nullable()->default(null);
            $table->integer('current_status')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
