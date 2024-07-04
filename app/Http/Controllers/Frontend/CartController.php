<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function viewCart()
    {
        return view('frontend.pages.cart.cartView');
    }

    public function  addToCart($productId)
    {
       $product = Product::find($productId);
        $myCart = session()->get('cart');

        if (empty($myCart)) {
            //1. add to cart
            $newCart[$productId] = [
                'id' => $productId,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => 1,
                'subtotal' => $product->price * 1
            ];

            // dd($newCart);
            session()->put('cart', $newCart);
            notify()->success('Product added to cart successfully.');
            return redirect()->back();
        } else {
            //check product exist or not
            if (array_key_exists($productId, $myCart)) {
                //update quantity


                $myCart[$productId]['quantity'] = $myCart[$productId]['quantity'] + 1;
                $myCart[$productId]['subtotal'] = $myCart[$productId]['quantity'] * $myCart[$productId]['price'];

                session()->put('cart', $myCart);
                notify()->success('Product quantity updated.');
                return redirect()->back();
            } else {

                //add to cart new product
                $myCart[$productId] = [
                    'id' => $productId,
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => $product->image,
                    'quantity' => 1,
                    'subtotal' => $product->price * 1
                ];

                session()->put('cart', $myCart);

                notify()->success('New product added to cart successfully.');
                return redirect()->back();
            }
        }
    }

    public function updateCart(Request $request)
    {
        $cart = session()->get('cart');
        $cartId = $request->input('cartId');
        $newQuantity = $request->input('quantity');

        if (isset($cart[$cartId])) {
            $cart[$cartId]['quantity'] = $newQuantity;
            $cart[$cartId]['subtotal'] = $cart[$cartId]['price'] * $newQuantity;
            session()->put('cart', $cart);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function clearCart()
    
    {

        session()->forget('cart');
        notify()->success('Cart cleared.');
        return redirect()->back();
    }

    public function deletecart($productId) 
    {
        $myCart = session()->get('cart', []);

        if (isset($myCart[$productId])) {
            unset($myCart[$productId]);
            session()->put('cart', $myCart);
            notify()->success('Item deleted from cart successfully.');
        } else {
            notify()->error('Item not found in cart.');
        }
    
        return redirect()->back();
    }

}

