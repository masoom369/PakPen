<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        if (Auth::check()) {
            $role = Auth::user()->actual_usertype;
            switch ($role) {
                case 'admin':
                    $users = User::where('actual_usertype', '!=', 'admin')->get();
                    $sellers = User::where('actual_usertype', 'seller')->get();
                    $customers = User::where('actual_usertype', 'customer')->get();
                    $delivery_agents = User::where('actual_usertype', 'delivery_agent')->get();
                    return view('admin.dashboard', compact('users', 'sellers', 'customers', 'delivery_agents'));

                case 'customer':
                    return view('customer.dashboard');

                case 'seller':
                    return view('seller.dashboard');

                case 'delivery_agent':
                    return view('delivery.dashboard');

                default:
                    return view('auth.login');
            }
        }

        return view('auth.login');
    }

    public function index()
    {
        return $this->viewWithCommonData('website.index');
    }

    public function aboutus()
    {
        return $this->viewWithCommonData('website.aboutus');
    }

    public function cart()
    {
        $cartItems = CartItem::where('customer_id', Auth::id())->get();
        $cartTotal = $cartItems->sum(function ($item) {
            return $item->product->p_price * $item->quantity;
        });

        return view('website.cart', array_merge(
            $this->getCommonData(),
            compact('cartItems', 'cartTotal')
        ));
    }

    public function contactus()
    {
        return $this->viewWithCommonData('website.contactus');
    }

    public function productDetail($id)
    {
        $product = Product::findOrFail($id);

        return view('website.product-detail', array_merge(
            $this->getCommonData(),
            compact('product')
        ));
    }

    public function categorywise($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $id)->get();

        return view('website.categorywise', array_merge(
            $this->getCommonData(),
            compact('category', 'products')
        ));
    }

    private function viewWithCommonData($view)
    {
        return view($view, $this->getCommonData());
    }
    public function cartSummary()
{
    if (Auth::check()) {
        // Get the current authenticated user's ID
        $userId = Auth::id();

        // Fetch unique products in the cart
        $uniqueProductsCount = CartItem::where('customer_id', $userId)
            ->distinct('product_id')
            ->count('product_id');

        // Fetch total price of the cart
        $totalPrice = CartItem::where('customer_id', $userId)
            ->get()
            ->sum(function ($item) {
                return $item->product->p_price * $item->quantity;
            });

        return response()->json([
            'totalItems' => $uniqueProductsCount,
            'totalPrice' => $totalPrice,
        ]);
    }

    // Return zero for users not signed in
    return response()->json([
        'totalItems' => 0,
        'totalPrice' => 0,
    ]);
}

public function adminInfo()
{
    $admin = User::where('actual_usertype', 'admin')->first();

    return view('admin.dashboard', compact('admin'));
}



    private function getCommonData()
    {
        $search = request('search');
        return [
            'products' => $this->getProducts($search),
            'categories' => $this->getCategories($search),
            'sellers' => $this->getSellers($search),
        ];
    }

    private function getProducts($search = null)
    {
        $query = Product::query();
        if ($search) {
            $query->where('p_name', 'LIKE', '%' . $search . '%');
        }
        return $query->get();
    }

    private function getCategories($search = null)
    {
        $query = Category::query();
        if ($search) {
            $query->where('c_name', 'LIKE', '%' . $search . '%');
        }
        return $query->get();
    }

    private function getSellers($search = null)
    {
        $query = User::where('actual_usertype', 'seller');
        if ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        }
        return $query->get();
    }
}
