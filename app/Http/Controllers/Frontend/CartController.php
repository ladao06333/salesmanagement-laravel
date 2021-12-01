<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\brand;
use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Session\Session;

session_start();
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }
    public function add_to_cart_ajax(Request $request)
    {
        $id = $request->id;
        $product = product::find($id);
        $getArrImage = json_decode($product->hinhanh, true);
        if ($product->sale != 0) {
            // $sale_price = $product->price * ((100 - $product->sale) / 100);
            $sale_price = $product->price - (($product->price * $product->sale) / 100);
            $price = $sale_price;
        } else {
            $price = $product->price;
        }
        $array = [
            'id' => $id,
            'qty' => 1,
            'name' => $product->name,
            'image' => $getArrImage[0],
            'price' => $price,

        ];
        if (session()->has('cart')) {

            $getCart = session()->get('cart');
            // dd($getCart);
            $is_available = 0;
            foreach ($getCart as $key => $val) {
                if ($id == $val['id']) {
                    $getCart[$key]['qty'] += 1;
                    // dd(session()->put('cart', $getCart));
                    session()->put('cart', $getCart);
                    $is_available = 1;
                    break;
                }
            }
            if ($is_available == 0) {
                session()->push('cart', $array);
            }
        } else {
            session()->push('cart', $array);
        }
        return response()->json(['success', 'Add product to your cart successfully']);



        // $id = $request->id;
        // $product = product::find($id);
        // $getArrImage = json_decode($product->hinhanh, true);
        // $array  = [];
        // $array['id'] = $id;
        // $array['qty'] = 1;
        // $array['image'] = $getArrImage[0];
        // $array['price'] = $product->price;
        // if (session()->has('cart')) {
        //     $getsession = session()->get('cart');
        //     // dd($getsession);
        //     $flag = 1;
        //     foreach ($getsession as $key => $value) {
        //         // dd($key);
        //         if ($id == $value['id']) {
        //             // dd($getsession[$key]['qty']);
        //             $getsession[$key]['qty'] += 1;
        //             // dd(session()->put('cart', $getsession));
        //             session()->put('cart', $getsession);
        //             $flag = 0;
        //             break;
        //         }
        //     }
        //     if ($flag == 1) {
        //         session()->push('cart', $array);
        //     }
        // } else {
        //     session()->push('cart', $array);
        // }
        // return response()->json(['success' => 'Add product successfully']);





        // $id = $request->id;
        // $product = product::find($id);
        // $getArrImage = json_decode($product->hinhanh, true);
        // $array  = [];
        // $array['id'] = $id;
        // $array['qty'] = 1;
        // $array['image'] = $getArrImage[0];
        // $array['price'] = $product->price;
        // if (session()->has('cart')) {
        //     $getsession = session()->get('cart');
        //     // dd($getsession);
        //     $flag = 1;
        //     foreach ($getsession as $key => $value) {
        //         // dd($key);
        //         if ($id == $value['id']) {
        //             // dd($getsession[$key]['qty']);
        //             $getsession[$key]['qty'] += 1;
        //             // dd(session()->put('cart', $getsession));
        //             session()->put('cart', $getsession);
        //             $flag = 0;
        //             break;
        //         }
        //     }
        //     if ($flag == 1) {
        //         session()->push('cart', $array);
        //     }
        // } else {
        //     session()->push('cart', $array);
        // }
        // return response()->json(['success' => 'Add product successfully']);


        // $id = $request->id;
        // $array  = [];
        // $array['id'] = $id;
        // $array['qty'] = 1;
        // if (session()->has('cart')) {
        //     $getsession = session()->get('cart');
        //     $flag = 1;
        //     foreach ($getsession as $key => $value) {
        //         if ($id == $value['id']) {
        //             $getsession[$key]['qty'] += 1;
        //             session()->put('cart', $getsession);
        //             $flag = 0;
        //             break;
        //         }
        //     }
        //     if ($flag == 1) {
        //         session()->push('cart', $array);
        //     }
        // } else {
        //     session()->push('cart', $array);
        // }
        // return response()->json(['success' => 'Add product successfully']);

        // $id = $request->id;
        // $product = product::find($id);
        // $getArrImage = json_decode($product->hinhanh, true);
        // // dd($product);
        // if (session()->has('cart')) {
        //     $cart = $request->session()->get('cart');
        //     // $cart = Session::get('cart');
        //     $is_avaiable = 0;
        //     foreach ($cart as $key => $val) {
        //         if ($id == $val['product_id']) {
        //             $is_avaiable++;
        //             $cart[$key]['product_qty'] += 1;
        //             break;
        //         }
        //     }
        //     if ($is_avaiable == 0) {
        //         $cart = array(
        //             'product_id' =>  $product->id,
        //             'product_name' => $product->name,
        //             'product_image' =>  $getArrImage[0],
        //             'product_qty' => 1,
        //             'product_price' =>  $product->price,
        //         );
        //         session()->push('cart', $cart);
        //     }
        // } else {
        //     $cart = array(
        //         'product_name' => $product->name,
        //         'product_id' =>  $product->id,
        //         'product_image' => $getArrImage[0],
        //         'product_qty' => 1,
        //         'product_price' =>  $product->price,
        //     );
        //     session()->put('cart', $cart);
        // }
        // return response()->json(['success' => 'Add product to cart successfully']);
    }
    public function update_cart_ajax(Request $request)
    {
        if (isset($_POST['up'])) {
            if ($_POST['up'] == true) {
                $id = $_POST['id'];
                $getSession = session()->get('cart');
                foreach ($getSession as $key => $value) {
                    if ($id == $value['id']) {
                        $getSession[$key]['qty'] += 1;
                        session()->put('cart', $getSession);
                    }
                }
            }
        }
        if (isset($_POST['down'])) {
            if ($_POST['down'] == true) {
                $id = $_POST['id'];
                $getSession = session()->get('cart');
                foreach ($getSession as $key => $value) {
                    if ($id == $value['id']) {

                        $getSession[$key]['qty'] -= 1;
                        if ($getSession[$key]['qty'] == 0) {
                            unset($getSession[$key]);
                        }
                        session()->put('cart', $getSession);
                    }
                }
            }
        }
        if (isset($request->delete)) {
            if ($request->delete == true) {
                $id  = $request->id;
                $getSession = session()->get('cart');
                foreach ($getSession as $key => $value) {
                    if ($id == $value['id']) {
                        unset($getSession[$key]);
                    }
                }
                session()->put('cart', $getSession);
            }
        }

        // return response()->json(['success']);
    }
    public function gio_hang(Request $request)
    {
        $allcategory = category::all();
        $allbrand = brand::all();
        if (session()->has('cart')) {
            $value = $request->session()->get('cart');

            // dd($value);
            return view('frontend.cart.cart_ajax', compact('value', 'allcategory', 'allbrand'));
        } else {
            return view('frontend.cart.cart_ajax', compact('allcategory', 'allbrand'));
        }
    }
    public function sendmail()
    {

        echo ' a';
    }








    public function add_cart_ajax(Request $request)
    {
        $data = $request->all();
        print_r($data);
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $cart = Session::get('cart');
        if ($cart == true) {
            $is_avaiable = 0;
            foreach ($cart as $key => $val) {
                if ($val['product_id'] == $data['cart_product_id']) {
                    $is_avaiable++;
                }
            }
            if ($is_avaiable == 0) {
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                );
                Session::put('cart', $cart);
            }
        } else {
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],

            );
            Session::put('cart', $cart);
        }

        Session::save();
    }
    // public function gio_hang(Request $request)
    // {
    //     // $meta_desc = "Giỏ hàng của bạn";
    //     // $meta_keywords = "Giỏ hàng Ajax";
    //     // $meta_title = "Giỏ hàng Ajax";
    //     $url_canonical = $request->url();
    //     $allcategory = category::all();
    //     $allbrand = brand::all();

    //     return view('frontend.cart.cart_ajax', compact('allcategory', 'allbrand'))->with('url_canonical', $url_canonical);
    // }

    public function save_cart(Request $request)
    {
        $product_id = $request->productid_hidden;
        $quantity = $request->qty;
        $product_info = product::where('id', $product_id)->first();
        $allcategory = category::all();
        $allbrand = brand::all();
        $getArrImage = json_decode($product_info->hinhanh, true);
        $data['id'] = $product_info->id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->name;
        $data['price'] = $product_info->price;
        $data['weight'] = '123';
        $data['options']['image'] = $getArrImage[0];
        // Cart::destroy();
        Cart::add($data);
        return Redirect::to('/show-cart');
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // dd($data);
    }
    public function show_cart()
    {
        $allcategory = category::all();
        $allbrand = brand::all();
        return view('frontend.cart.show_cart', compact('allcategory', 'allbrand'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
