<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function home()
    {
        $product = Product::all();

        if(Auth::id())
        {

            $user = Auth::user();

            $userid = $user->id ;



         $count = Cart::where('user_id',$userid)->count();

        }

        else
        {
            $count = '';
        }
        
        

        return view('home.index',compact('product','count'));
    }
    public function login_home()
    {
        $product = Product::all();

        if(Auth::id())
        {

            $user = Auth::user();

            $userid = $user->id ;



         $count = Cart::where('user_id',$userid)->count();

        }

        else
        {
            $count = '';
        }
        
        

        return view('home.index',compact('product','count'));

    }

    public function product_details($id)
    {
        $data=Product::find($id);

        $user = Auth::user();

        $userid = $user->id ;



        $count = Cart::where('user_id',$userid)->count();

        return view('home.product_details',compact('data','count'));
    }

    public function add_cart($id)
    {
    // dd($id);
    try {
        // Retrieve authenticated user
        $user = Auth::user();

        // Check if user is authenticated
        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'You need to be logged in to add a product to the cart.']);
        }

        // Check if the product is already in the cart
        $existingCartItem = Cart::where('user_id', $user->id)
                                ->where('product_id', $id)
                                ->first();

        if ($existingCartItem) {
            toastr()->timeOut(2000)->closeButton()->addWarning('Product is already in your cart.');
            return redirect()->back();
        }

        // Create a new Cart entry
        $data = new Cart;

        $data->user_id = $user->id;

        $data->product_id = $id;
        
        $data->save();

        // Display success message
        toastr()->timeOut(2000)->closeButton()->addSuccess('Product added to cart successfully');

        } 
        catch (\Exception $e) 
        {
            // Handle errors and display a friendly error message
            return redirect()->back()->withErrors(['error' => 'An error occurred while adding the product to the cart.']);
        }

        // Redirect back to the previous page
        return view('home.cart');
    }

    public function mycart()
    {
        if(Auth::id())
        {
            $user = Auth::user();

            $userid = $user->id ;

            $count = Cart::where('user_id',$userid)->count();

            $cart = Cart::where('user_id',$userid)->get();

            return view('home.mycart',compact('count','cart'));
        }
    }

    public function confirm_order(Request $request)

    {
        //  dd($request->all());

        $userid = Auth::user()->id;

        $cart = Cart::where('user_id', $userid)->get();

        foreach($cart as $carts)
        {

        $order = new Order;
        $order->name = $request->name;
        $order->rec_address = $request->address;
        $order->phone = $request->phone;
        $order->user_id = $userid;
        $order->product_id = $carts->product_id;

        $order->save();
    

        }

        $cart_remove = Cart::where('user_id', $userid)->get();
        foreach($cart_remove as $remove)
        {
            $data = Cart::find($remove->id);
            $data->delete();
        }
        toastr()->timeOut(2000)->closeButton()->addSuccess('Product added to order successfully');

        return redirect()->back();

    }

   
}
