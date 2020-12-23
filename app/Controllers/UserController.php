<?php

namespace App\Controllers;

use App\Framework\DB;
use App\Framework\Auth;
use App\Framework\Mailer;
use App\Framework\Request;

use App\Controllers\PostController as PostCtrl;
use App\Controllers\SeriesController as SeriesCtrl;
use App\Controllers\CommentController as CommentCtrl;
use App\Controllers\HistoryController as HistoryCtrl;
use App\Controllers\CategoryController as CategoryCtrl;

class UserController {
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return DB::table('users')->select()->orderBy('created_at', 'DESC');
        }
        return DB::table('users')->select()->where($filter)->orderBy('created_at', 'DESC');
    }
    public static function me() {
        return Auth::guard('user')->user();
    }
    public static function update($id, $toUpdate) {
        return DB::table('users')->update($toUpdate)->where('id', '=', $id)->execute();
    }
    public function loginPage() {
        return view('login');
    }
    public function login(Request $req) {
        $loggingIn = Auth::guard('user')->attempt([
            'email' => $req->email,
            'password' => $req->password,
        ]);

        if (!$loggingIn) {
            redirect('user/login', [
                'message' => "Email atau Password salah"
            ]);
        }

        echo $loggingIn;
    }
    public function checkUser($name, $email) {
        return self::get([
            ['name', '=', $name],
            ['email', '=', $email]
        ])->get();
    }
    public function loginWithGoogle(Request $req) {
        $name = $req->name;
        $email = $req->email;

        if (count($this->checkUser($name, $email)) == 0) {
            $register = DB::table('users')->create([
                'name' => $name,
                'email' => $email,
                'password' => md5("withgoogle")
            ])->execute();
        }

        $login = Auth::guard('user')->attempt([
            'email' => $email,
            'password' => "withgoogle"
        ]);

        $user = Auth::guard('user')->user();

        echo json_encode([
            'status' => 200,
            'data' => $user
        ]);
    }
    public function logout() {
        $loggingOut = Auth::guard('user')->logout();
        return view('logout');
    }
    public function checkIsExists($array, $text) {
        foreach ($array as $arr) {
            if ($arr['text'] == $text) {
                return $arr;
            }else {
                return false;
            }
        }
    }
    public function index() {
        $myData = self::me();

        if ($myData != "") {
            $favoriteCategories = explode(",", $myData->favorite_categories);
            $recommendedPosts = [];
            $recommendedPostID = [];
            
            foreach ($favoriteCategories as $category) {
                if (count($recommendedPosts) < 6) {
                    $posts = PostCtrl::get([
                        ['categories', 'LIKE', '%'.$category.'%']
                    ])->get();
                    // echo json_encode($posts);
                    foreach ($posts as $post) {
                        if (!in_array($post->id, $recommendedPostID)) {
                            $recommendedPosts[] = $post;
                            array_push($recommendedPostID, $post->id);
                        }
                    }
                }
            }
        }

        $allCategories = CategoryCtrl::get()->get();
        $latestPosts = PostCtrl::get()->paginate(12)->get();
        $premiumPosts = PostCtrl::get([
            ['is_premium', '=', 1]
        ])->paginate(6)->get();
        
        return view('index', [
            'latestPosts' => $latestPosts,
            'recommendedPosts' => $recommendedPosts,
            'allCategories'=> $allCategories,
            'premiumPosts' => $premiumPosts,
        ]);
    }
    public function read($slug, Request $req) {
        $myData = self::me();
        $post = PostController::get([
            ['slug', '=', $slug]
        ])->first();
        $postCategories = explode(",", $post->categories);
        $comments = CommentCtrl::get([
            ['post_id', '=', $post->id]
        ])->get();

        $relatedPosts = [];
        foreach ($postCategories as $category) {
            $getRelatedPost = PostCtrl::get([
                ['categories', 'LIKE', '%'.$postCategories[1].'%'],
                ['id', '!=', $post->id]
            ])->paginate(2)->get();
            foreach ($getRelatedPost as $p) {
                if (!in_array($p, $relatedPosts)) {
                    array_push($relatedPosts, $p);
                }
            }
        }

        if ($req->series_id != NULL) {
            $series = SeriesCtrl::get([
                ['id', '=', $req->series_id]
            ])->first();

            $contents = DB::table('series_posts')->select()
            ->where('series_id', '=', $series->id)
            ->with('posts', [
                'id' => 'post_id'
            ])
            ->get();
        }

        if ($post == "") {
            return view("error.404");
        }
        if ($post->is_premium == 1) {
            $dateNow = date('Y-m-d');
            $myPremiumExpire = $myData->premium_until;
            $isPremium = $myPremiumExpire > $dateNow ? true : false;
            if (!$isPremium) {
                return redirect('get-premium');
            }
        }
        if ($myData != "") {
            $updateHistory = HistoryCtrl::hit($myData->id, $post->id);
        }
        $hitCounter = PostCtrl::change($postID, ['counter' => $hit->counter + 1]);

        return view('read', [
            'post' => $post,
            'comments' => $comments,
            'series' => $series,
            'contents' => $contents,
            'relatedPosts' => $relatedPosts
        ]);
    }
    public function search(Request $req) {
        $q = $req->q;

        $posts = PostCtrl::get([
            ['title', 'LIKE', '%'.$q.'%']
        ])->get();

        return view('search', [
            'posts' => $posts
        ]);
    }
    public function error() {
        return view('error.404');
    }
    public function history() {
        $myData = self::me();

        $histories = HistoryCtrl::get([
            ['user_id', '=', $myData->id]
        ])
        ->with('posts', [
            'id' => 'post_id'
        ])
        ->orderBy('updated_at', 'DESC')
        ->get();

        return view('history', [
            'histories' => $histories
        ]);
    }
    public function getStarted() {
        $userData = self::me();
        $categories = CategoryCtrl::get()->get();

        return view('getStarted', [
            'myData' => $userData,
            'categories' => $categories
        ]);
    }
    public function getStartedSubmit(Request $req) {
        $myData = self::me();
        $categories = $req->categories;

        $updateData = DB::table('users')->update([
            'favorite_categories' => $categories
        ])
        ->where('id', '=', $myData->id)
        ->execute();

        return redirect('');
    }
    public function account() {
        $myData = self::me();
        $categories = CategoryCtrl::get()->get();

        return view('account', [
            'myData' => $myData,
            'categories' => $categories
        ]);
    }
    public function updateAccount(Request $req) {
        $myData = self::me();

        $toUpdate = [
            'name' => $req->name,
            'favorite_categories' => $req->favorite_categories
        ];
        if ($req->password != "") {
            $toUpdate['password'] = $req->password;
        }

        $updateData = DB::table('users')->update($toUpdate)
        ->where('id', '=', $myData->id)
        ->execute();

        return redirect('account');
    }
    public function getPremium() {
        $myData = self::me();

        return view('getPremium', [
            'myData' => $myData
        ]);
    }
    public function bePremium(Request $req) {
        $myData = self::me();
        $evidence = $req->file('evidence');
        $evidenceFileName = $evidence->getFileName();
        $evidence->store('transfer_evidence', $evidenceFileName);

        $saveData = DB::table('premium_requests')->create([
            'user_id' => $myData->id,
            'evidence' => $evidenceFileName,
            'status' => 0
        ])->execute();

        Mailer::to("riyan.satria.619@gmail.com", "Riyan Satria")
        ->from(env("MAIL_USERNAME"), env("APP_NAME"))
        ->subject("PREMIUM REQUEST!")
        ->send(
            view('email/notifPremium')
        );

        return redirect('get-premium/success');
    }
    public function getPremiumSuccess() {
        return view('getPremiumSuccess');
    }
    public function category($category) {
        $check = CategoryCtrl::get([
            ['category', 'LIKE', '%'.$category.'%']
        ])->get();

        if (count($check) == 0) {
            return view('error.404');
        }

        $posts = PostCtrl::get([
            ['categories', 'LIKE', '%'.$category.'%']
        ])->paginate(10);

        return view('category', [
            'posts' => $posts,
            'category' => $category
        ]);
    }
    public function latest() {
        $posts = PostCtrl::get()->paginate(16);

        return view('latest', [
            'posts' => $posts
        ]);
    }
    public function series($slug) {
        $series = SeriesCtrl::get([
            ['slug', '=', $slug]
        ])
        ->first();

        $contents = DB::table('series_posts')->select()
        ->where('series_id', '=', $series->id)
        ->with('posts', [
            'id' => 'post_id'
        ])
        ->get();

        // echo json_encode($contents);
        // die();

        return view('series', [
            'series' => $series,
            'contents' => $contents
        ]);
    }
}
