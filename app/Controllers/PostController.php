<?php

namespace App\Controllers;

use App\Framework\DB;
use App\Framework\Request;

use App\Controllers\AdminController as AdminCtrl;
use App\Controllers\CategoryController as CategoryCtrl;

class PostController {
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return DB::table('posts')->select()->orderBy('created_at', 'DESC');
        }
        return DB::table('posts')->select()->where($filter)->orderBy('created_at', 'DESC');
    }
    public static function change($id, $toUpdate) {
        return DB::table('posts')->update($toUpdate)->where('id', '=', $id)->execute();
    }
    public function create() {
        $categories = CategoryCtrl::get()->get();

        return view('admin.post.create', [
            'categories' => $categories
        ]);
    }
    public function store(Request $req) {
        $myData = AdminCtrl::me();
        $isPremium = $req->is_premium == "on" ? 1 : 0;

        $image = $req->file('featured_image');
        $imageFileName = $image->getFileName();

        $saveData = DB::table('posts')->create([
            'admin_id' => $myData->id,
            'title' => $req->title,
            'categories' => $req->categories,
            'slug' => $req->slug,
            'featured_image' => $imageFileName,
            'body' => $req->body,
            'is_premium' => $isPremium
        ])->execute();

        $image->store('featured_image', $imageFileName);

        return redirect('admin/post', [
            'message' => ""
        ]);
    }
    public function edit($id) {
        $post = DB::table('posts')->select()->where('id', '=', $id)->first();
        $categories = CategoryCtrl::get()->get();

        return view('admin.post.edit', [
            'post' => $post,
            'categories' => $categories,
        ]);
    }
    public function update($id, Request $req) {
        $isPremium = $req->is_premium == "on" ? 1 : 0;
        $toUpdate = [
            'title' => $req->title,
            'categories' => $req->categories,
            'slug' => $req->slug,
            'body' => $req->body,
            'is_premium' => $isPremium
        ];

        $image = $req->file('featured_image');
        $imageFileName = $image->getFileName();
        if ($imageFileName != "")  {
            $toUpdate['featured_image'] = $imageFileName;
            $image->store('featured_image', $imageFileName);
        }

        $updateData = DB::table('posts')->update($toUpdate)
        ->where('id', '=', $id)
        ->execute();
        
        return redirect('admin/post', [
            'message' => ""
        ]);
    }
    public function delete($id) {
        $deleteData = DB::table('posts')->delete()->where('id', '=', $id)->execute();
        
        return redirect('admin/post', [
            'message' => ""
        ]);
    }
}