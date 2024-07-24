<?php

namespace App\Http\Controllers\CustomerController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;

class ProductController extends Controller
{

    function index() {

        $products = ProductModel::all();
        return response([
            "message" => $products,
            "status" => 200
        ]);

    }
    
    function store(Request $request) {

        if($request->file('image')) {
           
            $productName = $request->name;
            $productDescription = $request->description;
            $productPrice = $request->price;
            $productImage = $request->file('image');

            $productModel = new ProductModel;

            $productModel->name = $productName;
            $productModel->description = $productDescription;
            $productModel->price = $productPrice;
            $productModel->image = $request->file('image')->store('products');

            $result = $productModel->save();

            if($result) {

                return response([
                    "message" => "Product Saved Successfully",
                    "status" => 200
                ]);

            }

        } else {

            return "Unable to find the image";

        }

    }


    public function edit(int $id) {

        $product = ProductModel::find($id);
        if($product) {

            return response([

                "message" => $product,
                "status" => 200

            ]);

        } else {

            return response([
                "message" => "Unable to find the product! Try again",
                "status" => 404
            ]);

        }

    }


    public function update(Request $request, int $id) {

        if($request->file('image')) {

            $productName = $request->name;
            $productDescription = $request->description;
            $productPrice = $request->price;
            $productImage = $request->file('image');

            $product = ProductModel::find($id);
            if($product) {

                $product->name = $productName;
                $product->description = $productDescription;
                $product->price = $productPrice;
                $product->image = $request->file('image')->store('products');

                $result = $product->update();
                return $result;
                
            } else {

                return response([
                    "message" => "Unable to find the product",
                    "status" => 404
                ]);

            }

        } else {

            return response([
                "message" => "Image Not Found!",
                "status" => 404
            ]);

        }

    }

}
