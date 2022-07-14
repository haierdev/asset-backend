<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->enum('asset_type', ['IT', 'NON IT']);
            $table->string('asset_code');
            $table->integer('id_category');
            $table->string('asset_name');
            $table->string('specification');
            $table->date('capitalization');
            $table->string('sap_code');
            $table->integer('id_employee');
            $table->integer('id_location');
            $table->integer('id_condition');
            $table->string('asset_cordinate');
            $table->integer('id_cost');
            $table->integer('acquisition_value');
            $table->string('useful_life');
            $table->string('depreciation_value');
            $table->enum('depreciation', ['1', '0']);
            $table->integer('value_book');
            $table->integer('id_vendor');
            $table->string('eproc');
            $table->string('budget');
            $table->string('device');
            $table->string('type');
            $table->string('brand');
            $table->string('monitor_inch');
            $table->string('model_brand');
            $table->string('mac_address');
            $table->string('warranty');
            $table->string('computer_name');
            $table->string('dlp');
            $table->string('soc');
            $table->string('snnbpc');
            $table->string('processor');
            $table->string('hardware');
            $table->string('windows_os');
            $table->string('sn_windows');
            $table->string('ms_office');
            $table->string('antivirus');
            $table->text('notes');
            $table->string('pict');
            $table->string('edvidace');
            $table->enum('status', ['Used', 'Disposal', 'Vacant', 'Stock IT', 'Display', 'Broken', 'Lost', 'Damaged', 'Repair', 'Scrapped']);
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
        Schema::dropIfExists('assets');
    }
}
