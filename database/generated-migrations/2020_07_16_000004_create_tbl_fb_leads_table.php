<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblFbLeadsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'tbl_fb_leads';

    /**
     * Run the migrations.
     * @table tbl_fb_leads
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->char('ad_id', 64)->nullable()->default(null);
            $table->char('form_id', 64)->nullable()->default(null);
            $table->char('leadgen_id', 64)->nullable()->default(null);
            $table->char('created_time', 64)->nullable()->default(null);
            $table->char('page_id', 64)->nullable()->default(null);
            $table->char('adgroup_id', 64)->nullable()->default(null);
            $table->nullableTimestamps();
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
