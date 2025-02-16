<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Shipping;
use Cart, Auth;

class CartController extends Controller
{
    private $user_id;

    public function __construct()
    {
        $this->middleware(["XssSanitizer"]);

        $this->middleware(function ($request, $next) {
            $this->user_id = Auth::user()->id;
            return $next($request);
        });
    }

    public function index()
    {
        $title = "Cart";
        $cartItems = Cart::instance($this->user_id)->content();
        return view("frontend/pages/cart", compact("title", "cartItems"));
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $duplicates = Cart::instance($this->user_id)->search(function (
                $cartItem,
                $rowId
            ) use ($request) {
                return $cartItem->id === $request->id;
            });

            $product = Product::find($request->id);
            $title = $product->product_name;
            $qty = $request->quantity;
            $image = $product->product_image;
            $size = $request->size;
            $price =
                $product->special_price != null
                    ? $product->special_price
                    : $product->regular_price;
            $weight = isset($product->weight) ? $product->weight : 0;

            if ($duplicates->isNotEmpty()) {
                return response()->json([
                    "status" => 200,
                    "result" => "exist",
                ]);
            }

            Cart::instance($this->user_id)
                ->add($request->id, $title, $qty, $price, $weight, [
                    $size,
                    $image,
                ])
                ->associate("App\Models\Product");

            if ($request->wishlistitem) {
                Cart::instance("wishlist_" . $this->user_id)->remove(
                    $request->wishlistitem
                );
            }

            return response()->json([
                "status" => 200,
                "result" => "added",
                "cartItemCount" => Cart::instance($this->user_id)
                    ->content()
                    ->count(),
                "wishListItemCount" => Cart::instance(
                    "wishlist_" . $this->user_id
                )
                    ->content()
                    ->count(),
            ]);
            return redirect()
                ->back()
                ->with("success_msg", "Item added to cart");
        } else {
            return redirect()
                ->back()
                ->with("error_msg", "Item cannot be added to cart");
        }

    }

    public function update(Request $request)
    {
        $request->validate(
            [
                "rowId" => "required",
                "quantity" => "required|numeric",
            ],
            [
                "rowId.required" => "Product is required",
                "quantity.required" => "Quantity is required",
                "quantity.numeric" => "Quantity must be numeric",
            ]
        );
        Cart::update($request->rowId, $request->quantity);
        return redirect()
            ->back()
            ->with("success_msg", "Cart updated successfully");
    }

    public function destroy($id)
    {
        try {
            Cart::instance($this->user_id)->remove($id);
            return back()->with(
                "success_msg",
                "Cart item has been removed successfully"
            );
        } catch (\Exception $e) {
            return back()->with(
                "error_msg",
                "Cart item cannot be removed successfully"
            );
        }
    }
}
