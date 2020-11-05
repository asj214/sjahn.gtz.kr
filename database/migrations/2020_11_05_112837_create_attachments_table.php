<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('attachment_id');
            $table->string('attachment_type');
            $table->bigInteger('user_id');
            $table->string('filename');
            $table->string('url');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['deleted_at', 'attachment_id', 'attachment_type'], 'attachments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attachments');
    }
}
