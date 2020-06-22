<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinkStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_statistics', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('link_id')->unsigned();
            $table->ipAddress('visitor_ip');
            $table->timestamp('visit_at');
            $table->string('commercial_image')->nullable();
            $table->timestamps();

            $table->index(['visitor_ip', 'visit_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('link_statistics');
    }
}
