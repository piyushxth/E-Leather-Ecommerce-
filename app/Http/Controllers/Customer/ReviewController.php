<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Review;
use App\Notifications\StatusNotification;
use Auth, Notification;;


class ReviewController extends Controller
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
        $reviews = Review::where('user_id',$this->user_id)->join(
            "products",
            "reviews.product_id",
            "=",
            "products.id"
        )->paginate(12);
        return view('frontend.customer.reviews', compact('reviews'));
    }

    public function store(Request $request)
    {
        try {
            if ($request->user() == null) {
                return response()->json([
                    "error" =>
                    "Sorry, review cannot be submitted. Please login first",
                ]);
            } else {
                if ($request->user()->role == "admin") {
                    return response()->json([
                        "error" =>
                        "Site admin cannot review product, Review cannot be submitted",
                    ]);
                } else {
                    $request->validate(
                        [
                            "rating" => "required|numeric|min:1",
                        ],
                        [
                            "rating.required" => "Rating is requried",
                            "rating.numeric" => "Rating must be number",
                            "rating.min" => "Rating must be minimum 1",
                        ]
                    );

                    $product_info = Product::where(
                        "slug",
                        $request->product_slug
                    )->firstOrfail();
                    $data = $request->all();
                    $data["product_id"] = $product_info->id;
                    $data["user_id"] = $request->user()->id;
                    $data["customer_name"] = $request->user()->name;
                    $reviews = Review::where([
                        'user_id' => $request->user()->id,
                        'product_id' => $product_info->id,
                    ])->get();
                    if ($reviews->isNotEmpty()) {
                        return response()->json(["error" => "Review can only be submitted once"]);
                    } else {
                        $status = Review::create($data);
                        $user = User::where("role", "admin")->first();
                        $details = [
                            "title" => "New Product Rating!",
                            "actionURL" => route(
                                "main_product",
                                $product_info->slug
                            ),
                            "fas" => "fa-star",
                        ];
                        //sends notifications to the admin user
                        Notification::send($user, new StatusNotification($details));
                        if ($status) {
                            return response()->json([
                                "success" => "Thank you for your reivew",
                            ]);
                        } else {
                            return response()->json([
                                "error" =>
                                "Review submitted successfully, notifcation failed",
                            ]);
                        }
                    }
                }
            }
        } catch (Exception $e) {
            return response()->json(["error" => "Review cannot be submitted"]);
        }
    }
}
