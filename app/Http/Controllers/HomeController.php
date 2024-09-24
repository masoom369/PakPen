<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    const ROLE_ADMIN = 'admin';
    const ROLE_SELLER = 'seller';
    const ROLE_CUSTOMER = 'customer';
    const ROLE_DELIVERY_AGENT = 'delivery_agent';

    public function home()
    {
        if (Auth::check()) {
            $role = Auth::user()->actual_usertype;

            if ($role === self::ROLE_ADMIN) {
                return $this->adminDashboard();
            }

            return view("{$role}.dashboard");
        }

        return view('auth.login');
    }

    private function adminDashboard()
    {
        $users = User::where('actual_usertype', '!=', self::ROLE_ADMIN)->get();

        return view('admin.dashboard', [
            'users' => $users,
            'sellers' => $users->where('actual_usertype', self::ROLE_SELLER),
            'customers' => $users->where('actual_usertype', self::ROLE_CUSTOMER),
            'delivery_agents' => $users->where('actual_usertype', self::ROLE_DELIVERY_AGENT),
        ]);
    }

    public function index()
    {
        return $this->viewWithCommonData('website.index');
    }

    public function library()
    {
        return $this->viewWithCommonData('website.library');
    }

    public function aboutus()
    {
        return $this->viewWithCommonData('website.aboutus');
    }

    public function contactus()
    {
        return $this->viewWithCommonData('website.contactus');
    }

    public function cart()
    {
        // Fetch cart items and summary from the backend
        return $this->viewWithCommonData('website.cart');
    }

    public function productDetail($id)
    {
        return $this->viewWithCommonData('website.product-detail', ['product' => Product::findOrFail($id)]);
    }

    public function bookDetail($id)
    {
        return $this->viewWithCommonData('website.book-detail', ['book' => Book::findOrFail($id)]);
    }

    public function categorywise($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $id)->get();

        return $this->viewWithCommonData('website.categorywise', compact('category', 'products'));
    }

    /**
     * Helper function to merge common data with specific view data
     */
    private function viewWithCommonData($view, $data = [])
    {
        return view($view, array_merge($this->getCommonData(), $data));
    }

    /**
     * Get common data like products, books, categories, and cart items
     */
    private function getCommonData()
    {
        $search = request('search');

        return [
            'products' => $this->getProducts($search),
            'books' => $this->getBooks($search),
            'categories' => $this->getCategories($search),
            'sellers' => $this->getSellers($search),
            'cartItems' => $this->getCartItems(),
            'cartSummary' => $this->cartSummaryData(),
        ];
    }

    /**
     * Calculate the total cart price and item count.
     */
    private function cartSummaryData()
    {
        $userId = Auth::id();
        $cartItems = CartItem::where('customer_id', $userId)
            ->with(['product', 'book'])
            ->get();

        $totalItems = $cartItems->count();
        $totalPrice = $cartItems->sum(function ($item) {
            $price = $item->product->p_price ?? $item->book->b_price ?? 0;
            return $price * $item->order_quantity;
        });

        return compact('totalItems', 'totalPrice');
    }

    /**
     * Get books with optional search filter
     */
    private function getBooks($search = null)
    {
        return $this->filterQuery(Book::query(), 'b_name', $search)->get();
    }

    /**
     * Get products with optional search filter
     */
    private function getProducts($search = null)
    {
        return $this->filterQuery(Product::query(), 'p_name', $search)->get();
    }

    /**
     * Get categories with optional search filter
     */
    private function getCategories($search = null)
    {
        return $this->filterQuery(Category::query(), 'c_name', $search)->get();
    }

    /**
     * Get sellers with optional search filter
     */
    private function getSellers($search = null)
    {
        return $this->filterQuery(User::where('actual_usertype', self::ROLE_SELLER), 'name', $search)->get();
    }

    /**
     * Helper function to filter queries based on search input
     */
    private function filterQuery($query, $field, $search)
    {
        return $search ? $query->where($field, 'LIKE', "%{$search}%") : $query;
    }

    /**
     * Get the items in the user's cart
     */
    private function getCartItems()
    {
        return CartItem::where('customer_id', Auth::id())
            ->with(['product', 'book'])
            ->get();
    }
}
