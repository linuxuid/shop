<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Basket;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cookie;

class BasketController extends Controller
{
    public function index(Request $request)
    {
        $basket_id = $request->cookie('basket_id');
        if(!empty($basket_id)){
            $products = Basket::findOrFail($basket_id)->products;
            return view('basket.index', compact('products'));
        } else {
            abort(404);
        }
        
    }

    /*
     * BASKET CREATE ORDERS
     */ 
    public function create()
    {
        return view('basket.create');
    }

    public function createOrder(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:255'
        ]);

        $basket = new Basket();
        $user_id = auth()->check() ? auth()->user()->id : null;
        $order = Order::create(
            $attributes + ['amount' => $basket->getAmount(), 'user_id' => $user_id]
        );

        foreach($basket->products as $product){
            $order->items()->create([
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $product->pivot->quantity,
                'cost' => $product->price * $product->pivot->quantity,
            ]);
        }

        $basket->delete();

        return redirect()->route('basket.success')->with('success', 'your order has been successfully placed');
    }

    public function storeOrder()
    {
        return view('basket.store');
    }
    /*
     * BASKET END CREATE ORDERS
     */ 

    public function store( Request $request, $id)
    {
        $basket_id = $request->cookie('basket_id');
        $quantity = $request->input('quantity') ?? 1;
        if (empty($basket_id)) {
            // if basket does not exists - create an object
            $basket = Basket::create();
            // we get indentifier to get id
            $basket_id = $basket->id;
        } else {
            // if basket
            $basket = Basket::findOrFail($basket_id);
            // update field `updated_at` table `baskets`
            $basket->touch();
        }
        if ($basket->products->contains($id)) {
            // if such product exists - change quantity
            $pivotRow = $basket->products()->where('product_id', $id)->first()->pivot;
            $quantity = $pivotRow->quantity + $quantity;
            $pivotRow->update(['quantity' => $quantity]);
        } else {
            // if does not exists product add to basket
            $basket->products()->attach($id, ['quantity' => $quantity]);
        }
        // return back to page where was press button "basket"
        return back()->withCookie(cookie('basket_id', $basket_id, 525600));
    }

    public function plus(Request $request, $id) {
        $basket_id = $request->cookie('basket_id');
        if (empty($basket_id)) {
            abort(404);
        }
        $this->change($basket_id, $id, 1);
        // redirect back
        return redirect()
            ->route('basket.index')
            ->withCookie(cookie('basket_id', $basket_id, 525600));
    }

    public function minus(Request $request, $id) {
        $basket_id = $request->cookie('basket_id');
        if (empty($basket_id)) {
            abort(404);
        }
        $this->change($basket_id, $id, -1);
        // redirect back
        return redirect()
            ->route('basket.index')
            ->withCookie(cookie('basket_id', $basket_id, 525600));
    }
    
    private function change($basket_id, $product_id, $count = 0) {
        if ($count == 0) {
            return;
        }
        $basket = Basket::findOrFail($basket_id);
        // if basket contain product
        if ($basket->products->contains($product_id)) {
            $pivotRow = $basket->products()->where('product_id', $product_id)->first()->pivot;
            $quantity = $pivotRow->quantity + $count;
            if ($quantity > 0) {
                // update qua-ty in $product_id
                $pivotRow->update(['quantity' => $quantity]);
                // update field `updated_at` table `baskets`
                $basket->touch();
            } else {
                // quan-ty == 0 del product
                $pivotRow->delete();
            }
        }
    }

    // remove
    public function remove($id) {
        $product = Product::find($id);

        $product->delete();

        return redirect()->route('basket.index');
    }
}
