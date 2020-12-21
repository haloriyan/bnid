<?php

namespace App\Middleware;

use App\Framework\Auth;

class Admin {
    public function handle() {
        if (!Auth::guard('admin')->check()) {
            return redirect('admin/login');
        }
    }
}