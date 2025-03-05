<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateLedgersTable extends Migration
{
    public function up()
    {
        // Ensure schema 'master' exists
        DB::statement('CREATE SCHEMA IF NOT EXISTS master');

        Schema::create('master.ledgers', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->boolean('is_active')->default(true);
            $table->boolean('is_deleted')->default(false);
            $table->timestamp('updated_date')->default(DB::raw('CURRENT_TIMESTAMP')); 
            $table->integer('version')->nullable()->default(1);
            $table->string('code', 16)->nullable();
            $table->boolean('is_group')->nullable();
            $table->boolean('is_ledger')->nullable();
            $table->boolean('is_sub_group')->nullable();
            $table->string('ledger_name', 256)->nullable();
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->smallInteger('ledger_type_id')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('tb_menu_id')->default(0);
            $table->integer('serialnumber')->default(0);
            $table->text('formula')->nullable();
            $table->boolean('is_editable')->default(false);
            $table->integer('depreciation_ledger_id')->default(0);
            $table->integer('accumulated_depreciation_id')->default(0);
            $table->boolean('is_optional')->default(false);
            $table->integer('ap_version')->default(101);
            $table->smallInteger('fsa_area_id')->nullable();
            $table->string('ledger_header', 255)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('master.ledgers');
    }
}
