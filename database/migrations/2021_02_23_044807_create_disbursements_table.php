<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisbursementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disbursements', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("business_unit_id");
            $table->unsignedInteger("project_id");
            $table->unsignedInteger("costcenter_id");
            $table->unsignedInteger("company_id");
            $table->bigInteger('amount');
            $table->string("bank_name");
            $table->string("bank_account_name");
            $table->string("bank_account_number");
            $table->string("email");
            $table->string("email_cc")->nullable();
            $table->string("email_bcc")->nullable();
            $table->string("submitter")->nullable();
            $table->integer("batch");
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
        Schema::dropIfExists('disbursements');
    }
}
