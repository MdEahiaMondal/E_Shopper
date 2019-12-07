<?php

namespace App\Http\Controllers\Backend;

use App\Brand;
use App\Category;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\Slider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
session_start();

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){

        $users = User::count();
        $categorys = Category::count();
        $brands = Brand::count();
        $sliders = Slider::count();
        $products = Product::count();
        $comments = Comment::count();
        $orders = Order::count();

        return view('backend.admin.dashboard.dashboard', compact('users',
            'categorys', 'brands', 'sliders', 'products', 'orders', 'comments'));
    }


}
