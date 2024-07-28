<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products as Products;
use App\Models\Product_sizes as Product_sizes; 
use App\Models\Banners as Banners;
use App\Models\Comments;

use App\Models\ProductsApi;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $ProductNews = Products::ProductNews();
        $ProductHot = Products::ProductHot();
        $ProductApi= ProductsApi::getProductsHot();
        $View_banner = Banners::View_banner();
        return view('home',compact('ProductNews','ProductHot','View_banner','ProductApi'));

    }
    
}
