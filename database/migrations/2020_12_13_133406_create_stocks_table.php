<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
           $table->id('productDataId');
           $table->string('productCode')->unique();
            $table->string('productName',50);
            $table->string('productDescription',255);
            $table->string('stock')->nullable();
            $table->decimal('costInGbp',9,2)->nullable();
            $table->string('discontinued')->nullable();
            $table->timestamp('dtmAdded', $precision = 0);
            $table->timestamp('dtmDiscontinued')->default(\DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('stocks');
    }
}
