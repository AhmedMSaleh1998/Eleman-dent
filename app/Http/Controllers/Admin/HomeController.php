<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Contact;
use App\Models\Event;
use App\Models\Order;
use App\Models\Brand;
use App\Models\City;
use App\Models\User;
use App\Models\Banner;
use App\Models\Certificate;
use App\Models\Achievement;
use App\Models\CustomerReview;
use App\Models\Payment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'categories' => Category::count(),
            'products' => Product::count(),
            'contacts' => Contact::where('status', 0)->count(),
            'events' => Event::count(),
            'orders' => Order::count(),
            'brands' => Brand::count(),
            'cities' => City::count(),
            'users' => User::count(),
            'banners' => Banner::count(),
            'certificates' => Certificate::count(),
            'achievements' => Achievement::count(),
            'reviews' => CustomerReview::count(),
            'paymentMethods' => Payment::count(),
        ];
        
        return view('admin.home', $data);
    }
}
