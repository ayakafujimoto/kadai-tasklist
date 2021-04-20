<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   //カラムを追加
        Schema::table('tasks', function (Blueprint $table) {
        $table->unsignedBigInteger('user_id');
        
        // 外部キー制約 存在しないuser_idが入らないようにする。
            $table->foreign('user_id')->references('id')->on('users');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            
        //外部キーの関連付けを削除
        $table->dropForeign('tasks_user_id_foreign');
        
        //カラムをはずす
        $table->dropColumn('user_id');
         
        });
    }
}
