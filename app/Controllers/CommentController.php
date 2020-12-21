<?php

namespace App\Controllers;

use App\Framework\DB;
use App\Framework\Request;

use App\Controllers\UserController as UserCtrl;
use App\Controllers\PostController as PostCtrl;

class CommentController {
    public static function get($filter) {
        return DB::table('comments')->select()->where($filter)->with('users', [
            'id' => 'user_id'
        ]);
    }
    public function store(Request $req) {
        $userData = UserCtrl::me();
        $postID = $req->post_id;
        $post = PostCtrl::get([
            ['id', '=', $postID]
        ])->first();

        $saveData = DB::table('comments')->create([
            'user_id' => $userData->id,
            'post_id' => $postID,
            'body' => $req->body
        ])->execute();

        return redirect('read/'.$post->slug);
    }
    public function delete($id) {
        $db = DB::table('comments');
        $data = $db->select()->where('id', '=', $id)->first();
        $deleteData = $db->delete()->where('id', '=', $id)->execute();

        return redirect('admin/post/'.$data->post_id.'/comments');
    }
}