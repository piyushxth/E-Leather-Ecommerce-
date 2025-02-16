<?php
namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use App\Models\ProductSizes;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductAttribute;
use Cart, Auth;

class WishlistController extends Controller
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
        $title = "Wishlist";
        $wishlistItems = Cart::instance("wishlist_".$this->user_id)->content();
        return view("frontend.pages.wishlist", compact("title","wishlistItems"));
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $duplicates = Cart::instance("wishlist_".$this->user_id)->search(
                function ($cartItem, $rowId) use ($request) {
                    return $cartItem->id === $request->id;
                }
            );

            $product = Product::find($request->id);
            $title = $product->product_name;
            $qty = $request->quantity;
            $image = $product->product_image;
            $size = $request->size;
            $price = ($product->special_price > 0.0) ? $product->special_price : $product->regular_price;
            $weight = isset($product->weight) ? $product->weight : 0;

            $item_stocks = ProductSizes::where([
                "product_id" => $product->id,
                "size" => $size,
            ])->get("stock");
            if ($item_stocks->isNotEmpty()) {
                $item_stock = $item_stocks[0]["stock"];
            } else {
                $item_stock = "";
            }

            if ($duplicates->isNotEmpty()) {
                return response()->json([
                    "status" => 200,
                    "result" => "exist",
                ]);
            }
            Cart::instance("wishlist_".$this->user_id)
                ->add($request->id, $title, $qty, $price, $weight, [
                    $size,
                    $image,
                    $item_stock,
                ])->associate("App\Models\Product");

            $wishlistItemCount = Cart::instance("wishlist_".$this->user_id)
                ->content()
                ->count();

            return response()->json([
                "status" => 200,
                "result" => "added",
                "wishlistItemCount" => $wishlistItemCount,
            ]);
        }
        $request->validate(
            [
                "id" => "required|exists:products,id",
                "size" => "required",
            ],
            [
                "id.required" => "Product is required",
                "id.exists" => "Product already exists",
                "size.required" => "Size is required",
            ]
        );
        // add cart items to a specific user
        Cart::instance("wishlist_".$this->user_id)
            ->add(
                $request->id,
                $request->product_name,
                $request->quantity,
                $request->price,
                isset($request->weight) ? $request->weight : 0,
                [
                    $request->size,
                    isset($request->product_attr_image)
                        ? $request->product_attr_image
                        : "",
                    isset($request->color_name) ? $request->color_name : "",
                ]
            )
            ->associate("App\Models\Product");
        return redirect()
            ->back()
            ->with("success_msg", "Item added to WishList");
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
        Cart::instance("wishlist_".$this->user_id)->remove($id);
        return back()->with("success_msg", "Item has been removed from  WishList");
    }
}
