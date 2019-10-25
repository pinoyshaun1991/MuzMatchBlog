<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommentCommentsColumnToBlogEtcCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_etc_comments', function (Blueprint $table) {
            $table->json("comment_comments")->comment("Lists all comments under a comment as a JSON format");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_etc_comments', function (Blueprint $table) {
            //
        });
    }
}
