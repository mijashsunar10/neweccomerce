<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

use function PHPUnit\Framework\fileExists;

class AdminController extends Controller
{
    public function view_category()
    {
        $data = Category::all();

        return view('admin.category',compact('data'));
    }

    public function add_category(Request $request)
    {
       $category = new Category;
       $category->category_name = $request->category;
    //    flash()->success('Your form has been submitted.');
       toastr()->timeOut(2000)->closeButton()->addSuccess('Category deleted successfully');
       $category -> save();
       return redirect()->back();
    }

    public function delete_category($id)
    {
        $data = Category::find($id);
        $data->delete();
       
        return redirect()->back();

    }
    public function edit_category($id)
    {
        $data = Category::find($id);
        return view('admin.edit',compact('data'));
         
    }
    public function update_category(Request $request, $id)
    {
        $data = Category::find($id);
        $data->category_name = $request->category;
        $data->save();
        return redirect('/view_category');
    }

    public function add_product(Request $request)
    {
        $data = Category::all();
        return view('admin.add_product',compact('data'));
    }

    public function upload_product(Request $request)
    {
       $data = new Product;
       $data->title = $request->title;
       $data->description = $request->description;
       $data->price = $request->price;
       $data->quantity = $request->qty;
       $data->category = $request->category;

       if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads'), $imageName);
        $data->image= $imageName;
        } 
         else {
        $imageName = null;
         }

       $data -> save();
       return redirect()->back();
    }

    public function view_product()
    {
        // $data = Product::paginate(3);
        $data =  Product::all();
        return view('admin.view_product',compact('data'));
    }

    public function delete_product($id)
    {
        $data = Product::find($id);
        
        if ($data) {
            $image_path = public_path('uploads/'.$data->image);
    
            if ($data->image && file_exists($image_path) && !is_dir($image_path)) {
                unlink($image_path);
            } else {
                // Debugging statement
                logger('Image path is either invalid or points to a directory: ' . $image_path);
            }
            
            $data->delete();
        } else {
            // Debugging statement
            logger('Product not found with id: ' . $id);
        }
    
        return redirect()->back();
    }

    public function search_product(Request $request)
    {
        $query = $request->input('search');
        $data = Product::where('title', 'LIKE', '%'.$query.'%')->paginate(3);
        return view('admin.view_product', compact('data'));
    }

    public function view_order()
    {
        $data = Order::all();
        return view('admin.vieworder',compact('data'));
    }

    public function on_the_way($id)
    {
        $data = Order::find($id);
        $data->status = 'On the way';
        $data->save();
        return redirect()->back();
    }

    public function delivered($id)
    {
        $data = Order::find($id);
        $data->status = 'Delivered';
        $data->save();
        return redirect()->back();
    }

    
    
}

