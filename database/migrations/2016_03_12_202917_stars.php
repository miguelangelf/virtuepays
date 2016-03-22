<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Stars extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    //id, on_blog, from_user, body, at_time
    Schema::create('stars', function(Blueprint $table)
    {
      $table -> integer('on_post') -> unsigned() -> default(0);
      $table->foreign('on_post') ->references('id')->on('posts')->onDelete('cascade');

      $table -> integer('by_user') -> unsigned() -> default(0);
      $table->foreign('by_user') ->references('id')->on('users')->onDelete('cascade');

      $table -> integer('rate') -> unsigned() -> default(0);
    });
  }
  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    // drop comment
    Schema::drop('stars');
  }
}