<?php

namespace App\Controllers;

use App\Framework\DB;
use App\Framework\Auth;
use App\Framework\Request;
use \Carbon\Carbon;

use App\Controllers\PostController as PostCtrl;
use App\Controllers\UserController as UserCtrl;
use App\Controllers\CommentController as CommentCtrl;
use App\Controllers\CategoryController as CategoryCtrl;

class AdminController {
    public static function me() {
        return Auth::guard('admin')->user();
    }
    public function loginPage() {
        return view('admin.login');
    }
    public function login(Request $req) {
        $loggingIn = Auth::guard('admin')->attempt([
            'email' => $req->email,
            'password' => $req->password,
        ]);

        if (!$loggingIn) {
            redirect('admin/login', [
                'message' => "Email atau Password salah"
            ]);
        }

        redirect('admin/dashboard');
    }
    public function logout() {
        $loggingOut = Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
    public function dashboard() {
        $users = UserCtrl::get()->get();
        $posts = PostCtrl::get()->get();
        
        $premiumRequests = DB::table('premium_requests')->select()
        ->where('status', '=', 0)
        ->with('users', [
            'id' => 'user_id'
        ])->get();

        return view('admin.dashboard', [
            'users' => count($users),
            'posts' => count($posts),
            'premiumRequests' => $premiumRequests
        ]);
    }
    public function post(Request $req) {
        $filter = NULL;
        if ($req->q != "") {
            $posts = PostCtrl::get([
                ['title', 'LIKE', '%'.$req->q.'%']
            ])->with('comments', [
                'post_id' => 'id'
            ]);
        }else {
            $posts = PostController::get($filter)
            ->with('comments', [
                'post_id' => 'id'
            ])
            ->paginate(20);
        }
        
        return view('admin.post', [
            'posts' => $posts
        ]);
    }
    public function category() {
        $categories = CategoryCtrl::get()->paginate(10);
        return view('admin.category', [
            'categories' => $categories
        ]);
    }
    public function user(Request $req) {
        $filter = NULL;
        if ($req->q != "") {
            $filter = [['name', 'LIKE', '%'.$req->q.'%']];
        }
        $users = UserCtrl::get($filter)->paginate(20);
        return view('admin.user', [
            'users' => $users,
            'q' => $req->q
        ]);
    }
    public function updateUser(Request $req) {
        $userID = $req->user_id;

        $updateData = DB::table('users')->update([
            'name' => $req->name,
            'premium_until' => $req->premium_until,
        ])
        ->where('id', '=', $userID)
        ->execute();

        return redirect('admin/user');
    }
    public function media() {
        return view('admin.media');
    }
    public function acceptPremium($userID) {
        $date = Carbon::parse(date('Y-m-d'))->addDays(30)->format('Y-m-d');
        
        $updateUser = UserCtrl::update($userID, [
            'premium_until' => $date
        ]);
        $updateData = DB::table('premium_requests')->update([
            'status' => 1
        ])
        ->where('user_id', '=', $userID)
        ->execute();

        return redirect('admin/dashboard');
    }
    public function postComments($postID) {
        $comments = CommentCtrl::get([
            ['post_id', '=', $postID]
        ])
        ->get();
        
        $post = PostCtrl::get([
            ['id', '=', $postID]
        ])->first();

        return view('admin.post.comments', [
            'comments' => $comments,
            'post' => $post
        ]);
    }
}
