<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class User extends Controller {
    public function home() {
        // Your user home page content goes here
        return view('user/home');
    }
}
