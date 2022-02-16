<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentAccessRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_access_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('granted_by')->nullable();
            $table->string('description');
            $table->integer('document_id');
            $table->string('status')->default('pending_approval');
            $table->string('decline_reason')->nullable();
            $table->timestamp('granted_at')->nullable();
            $table->bigInteger('granted_duration')->nullable();
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
        Schema::dropIfExists('document_access_requests');
    }
}
