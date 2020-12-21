<?php

namespace App\Controllers;

use App\Framework\DB;
use App\Framework\Request;

class CategoryController {
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return DB::table('categories')->select();
        }
        return DB::table('categories')->select()->where($filter);
    }
    public function add() {
        return view('admin.category.add');
    }
    public function store(Request $req) {
        $saveData = DB::table('categories')->create([
            'category' => $req->name,
            'counter' => 0
        ])->execute();

        return redirect('admin/category', [
            'message' => "Kategori baru berhasil ditambahkan"
        ]);
    }
    public function delete($id) {
        $deleteData = DB::table('categories')->delete()->where('id', '=', $id)->execute();
        
        return redirect('admin/category', [
            'message' => "Kategori berhasil dihapus"
        ]);
    }
}