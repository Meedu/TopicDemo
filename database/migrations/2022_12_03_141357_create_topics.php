<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demo_topics', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->default(0)->comment('分类id');
            $table->string('title', 140)->default('')->comment('图文标题');
            $table->mediumText('content')->nullable()->default(null)->comment('内容');
            $table->timestamp('published_at')->nullable(true)->default(null)->comment('上架时间');
            $table->timestamps();

            $table->index(['category_id'], 'cid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topics');
    }
}
