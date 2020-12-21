<?php

namespace App\Controllers;

use App\Framework\DB;
use App\Framework\Request;

class MediaController {
    public function load() {
        $medias = DB::table('medias')->select()->get();
        echo json_encode($medias);
    }
    public function uploasd(Request $req) {
        $file = $req->file('file')->getFileName();
        echo json_encode($file);
    }
    public function upload(Request $req) {
        $file = $req->file('file');
        $fileName = $file->getFileName();
        $fileSize = $file->getFileSize();

        $saveData = DB::table('medias')->create([
            'filename' => $fileName,
            'size' => $fileSize
        ])->execute();

        $file->store('media', $fileName);

        echo json_encode([
            'status' => 200
        ]);
    }
}