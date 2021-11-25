<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\productRequest;
use App\Models\brand;
use App\Models\category;
use App\Models\product;
use Image;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = product::all();

        // foreach ($product as $item) {
        //     $getArrImage = json_decode($item['hinhanh'], true);
        //     echo $getArrImage[1];
        // }
        return view('frontend.product.index')->with('product', $product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = category::all();
        $brand = brand::all();
        // $getProducts = product::find(4)->toArray();
        // $getArrImage = json_decode($getProducts['hinhanh'], true);

        return view('frontend.product.add', compact('category', 'brand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(productRequest $request)
    {

        $product = new product();
        $product->name = $request->name;
        // $product->email = $request->email;
        $product->price = $request->price;
        $product->id_category = $request->category;
        $product->id_brand = $request->brand;
        $product->status = $request->status;
        if ($product->status == 1) {
            $product->sale = $request->sale;
        } else {
            $product->sale = 0;
        }
        $product->company = $request->companyprofile;

        $product->detail = $request->detail;

        if ($request->hasfile('hinhanh')) {
            if (count($request->file('hinhanh')) > 3) {
                return back()->withErrors('image phai nho hon 3');
            }
            foreach ($request->file('hinhanh') as $image) {
                $time = strtotime(date('Y-m-d H:i:s'));
                $name = $image->getClientOriginalName();
                $name_2 = "hinh50_" . $time . "_" . $image->getClientOriginalName();
                $name_3 = "hinh200_" . $time . "_" . $image->getClientOriginalName();

                //$image->move('upload/product/', $name);
                // 7457474_xxx.png: iphone

                // 747547_xxx.png: sámsun

                if (!is_dir('upload/product')) {
                    // dd(true);
                    mkdir('upload/product');
                }
                // dd(false);
                $path = public_path('upload/product/' . $name);
                $path2 = public_path('upload/product/' . $name_2);
                $path3 = public_path('upload/product/' . $name_3);

                Image::make($image->getRealPath())->save($path);
                Image::make($image->getRealPath())->resize(50, 70)->save($path2);
                Image::make($image->getRealPath())->resize(200, 300)->save($path3);

                $data[] = $name;
                // dd($data);
            }
            $product->hinhanh = json_encode($data);
        }


        // dd($product->hinhanh);
        if ($product->save()) {
            return back()->with('success', 'Create product success');
        } else {
            return back()->withErrors('Create product fail');
        }
        // $productt = $request->all();
        // dd($product);
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
        $category = category::all();
        $brand = brand::all();
        $product = product::find($id);
        $getProducts = product::find($id)->toArray();
        $getArrImage = json_decode($getProducts['hinhanh'], true);
        // dd($getArrImage);

        return view('frontend.product.edit', compact('category', 'brand', 'product', 'getArrImage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(productRequest $request, $id)
    {


        $hinhxoa = $request->xoa;
        // $getProducts = product::find($id)->toArray();
        $product = product::find($id);
        // $hinhcu = json_decode($getProducts['hinhanh'], true);
        $hinhcu = json_decode($product->hinhanh, true);
        // dd($hinhxoa);
        // dd($hinhcu);
        // $daxoa = array_diff($hinhcu, $hinhxoa);
        // dd($daxoa);
        // $file_count = count($request->file('hinhanh'));
        // if (empty($hinhxoa) && empty($request->hasfile('hinhanh'))) {
        //     dd('rong');
        //     // dd(empty($request->hasfile('hinhanh')));
        // } else {
        //     dd('k rong');
        // }
        if (empty($request->hasfile('hinhanh'))) {
            if (!empty($hinhxoa)) {
                // dd('rong co');
                foreach ($hinhxoa as $k => $v) {
                    // echo $v;
                    unset($hinhcu[array_search($v, $hinhcu)]);
                    // unset($hinhcu[$k]);
                }

                $hinhcu = array_values($hinhcu);
                if ($hinhcu == null) {
                    $product->hinhanh = null;
                } else {
                    $product->hinhanh = json_encode($hinhcu);
                }
                // dd($product->hinhanh);
            }
        } else {

            $file_count = count($request->file('hinhanh'));
            if (empty($hinhxoa)) {
                // dd('co rong');
                if ($hinhcu == null) {
                    if ($request->hasfile('hinhanh')) {
                        if (count($request->file('hinhanh')) > 3) {
                            return back()->withErrors('image phai nho hon 3');
                        }
                        foreach ($request->file('hinhanh') as $image) {
                            $time = strtotime(date('Y-m-d H:i:s'));
                            $name = $image->getClientOriginalName();
                            $name_2 = "hinh50_" . $time . "_" . $image->getClientOriginalName();
                            $name_3 = "hinh200_" . $time . "_" . $image->getClientOriginalName();

                            //$image->move('upload/product/', $name);
                            // 7457474_xxx.png: iphone

                            // 747547_xxx.png: sámsun

                            if (!is_dir('upload/product')) {
                                // dd(true);
                                mkdir('upload/product');
                            }
                            // dd(false);
                            $path = public_path('upload/product/' . $name);
                            $path2 = public_path('upload/product/' . $name_2);
                            $path3 = public_path('upload/product/' . $name_3);

                            Image::make($image->getRealPath())->save($path);
                            Image::make($image->getRealPath())->resize(50, 70)->save($path2);
                            Image::make($image->getRealPath())->resize(200, 300)->save($path3);

                            $data[] = $name;
                        }
                    }
                    $product->hinhanh = json_encode($data);
                } else {
                    if (count($hinhcu) + $file_count  > 3) {
                        return back()->withErrors('image phai nho hon 3');
                    }
                }
            } else {
                // dd('co co');
                if (count($hinhcu) + $file_count - count($hinhxoa) > 3) {
                    return back()->withErrors('image phai nho hon 3');
                } else {
                    foreach ($hinhxoa as $k => $v) {
                        // echo $v;
                        unset($hinhcu[array_search($v, $hinhcu)]);
                        // unset($hinhcu[$k]);
                    }

                    // $product->hinhanh = json_encode($hinhcu);
                    // dd($hinhcu);
                    // dd(count($hinhcu));
                    if ($request->hasfile('hinhanh')) {
                        foreach ($request->file('hinhanh') as $image) {
                            $time = strtotime(date('Y-m-d H:i:s'));
                            $name = $image->getClientOriginalName();
                            $name_2 = "hinh50_" . $time . "_" . $image->getClientOriginalName();
                            $name_3 = "hinh200_" . $time . "_" . $image->getClientOriginalName();

                            //$image->move('upload/product/', $name);
                            // 7457474_xxx.png: iphone

                            // 747547_xxx.png: sámsun

                            if (!is_dir('upload/product')) {
                                // dd(true);
                                mkdir('upload/product');
                            }
                            // dd(false);
                            $path = public_path('upload/product/' . $name);
                            $path2 = public_path('upload/product/' . $name_2);
                            $path3 = public_path('upload/product/' . $name_3);

                            Image::make($image->getRealPath())->save($path);
                            Image::make($image->getRealPath())->resize(50, 70)->save($path2);
                            Image::make($image->getRealPath())->resize(200, 300)->save($path3);

                            $data[] = $name;
                        }
                    }
                    $anhtong = array_merge($hinhcu, $data);
                    $product->hinhanh = json_encode($anhtong);
                }
            }
        }
        // dd($data);
        // dd($hinhcu);
        // $anhtong = array_merge($hinhcu, $data);
        // dd($anhtong);
        // $product = new product();
        $product->name = $request->name;
        // $product->email = $request->email;
        $product->price = $request->price;
        $product->id_category = $request->category;
        $product->id_brand = $request->brand;
        $product->status = $request->status;
        if ($product->status == 1) {
            $product->sale = $request->sale;
        } else {
            $product->sale = 0;
        }
        $product->company = $request->companyprofile;
        $product->detail = $request->detail;
        if ($product->save()) {
            return back()->with('success', 'update product success');
        } else {
            return back()->withErrors('update product fail');
        }





        // - mang xoa: [1,2]
        // - hinh cu lay sql [1,2,3]
        // => [3]
        // - hinh 3;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        product::find($id)->delete();
        return back()->with('success', ('Delete success'));
    }
}
