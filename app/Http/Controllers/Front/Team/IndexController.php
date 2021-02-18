<?php

namespace App\Http\Controllers\Front\Team;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {
        $data['team'] = Team::where('active', 1)->orderBy('sort')->get();

        return view('front.team.index')->with($data);
    }
}
