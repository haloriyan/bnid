<?php

namespace App\Controllers;

use App\Framework\DB;
use App\Framework\Request;

use App\Controllers\PostController as PostCtrl;

class SeriesController {
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return DB::table('series')->select()->paginate(20);
        }
        return DB::table('series')->select()->where($filter);
    }
    public function create() {
        return view('admin.series.create');
    }
    public function store(Request $req) {
        $saveData = DB::table('series')->create([
            'title' => $req->title,
            'slug' => $req->slug,
            'description' => $req->description,
        ])->execute();

        return redirect('admin/series', [
            'message' => "Series berhasil dibuat"
        ]);
    }
    public function update($id, Request $req) {
        $updateData = DB::table('series')->update([
            'title' => $req->title,
            'slug' => $req->slug,
            'description' => $req->description,
        ])
        ->where('id', '=', $id)
        ->execute();

        return redirect('admin/series', [
            'message' => "Series berhasil diubah"
        ]);
    }
    public function delete($id) {
        $deleteData = DB::table('series')->delete()->where('id', '=', $id)->execute();
        
        return redirect('admin/series', [
            'message' => "Series berhasil dihapus"
        ]);
    }
    public function posts($seriesID) {
        $series = self::get([
            ['id', '=', $seriesID]
        ])->first();

        $datas = DB::table('series_posts')->select()
        ->where('series_id', '=', $seriesID)
        ->with('posts', [
            'id' => 'post_id'
        ])
        ->orderBy('post_id', 'DESC')
        ->get();

        // header("Content-Type: application/json");
        // echo json_encode($datas);
        // die();
        
        return view('admin.series.posts', [
            'series' => $series,
            'datas' => $datas
        ]);
    }
    public function searchPosts(Request $req) {
        $posts = DB::table('posts')->select('id', 'title')->where([
            ['title', 'LIKE', '%'.$req->q.'%']
        ])->get();

        header("Content-Type: application/json");
        echo json_encode($posts);
    }
    public function addPost($seriesID, Request $req) {
        $postIDs = [];
        foreach (explode(",", $req->posts) as $postID) {
            array_push($postIDs, $postID);
            $saveData = DB::table('series_posts')->create([
                'series_id' => $seriesID,
                'post_id' => $postID,
            ])->execute();
        }

        return redirect('admin/series/'.$seriesID.'/posts');
    }
    public function removePost($seriesID, $contentID) {
        $removeData = DB::table('series_posts')->delete()->where([
            ['series_id', '=', $seriesID],
            ['post_id', '=', $contentID],
        ])->execute();

        return redirect('admin/series/'.$seriesID.'/posts');
    }
}