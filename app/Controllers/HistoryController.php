<?php

namespace App\Controllers;

use App\Framework\DB;
use App\Framework\Request;

use App\Controllers\PostController as PostCtrl;

class HistoryController {
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return DB::table('histories')->select();
        }
        return DB::table('histories')->select()->where($filter);
    }
    public static function check($userID, $postID) {
        $data = DB::table('histories')->select()->where([
            ['user_id', '=', $userID],
            ['post_id', '=', $postID],
        ])->first();

        return $data;
    }
    public function hit($userID, $postID) {
        $isExists = self::check($userID, $postID);
        if ($isExists) {
            $update = DB::table('histories')->update([
                'counter' => $isExists->counter + 1
            ])
            ->where('post_id', '=', $postID)
            ->execute();
        }else {
            $save = DB::table('histories')->create([
                'user_id' => $userID,
                'post_id' => $postID,
                'counter' => 1
            ])->execute();
        }

        $hit = PostCtrl::get([
            ['id', '=', $postID]
        ])->first();
    }
}