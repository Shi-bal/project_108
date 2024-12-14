<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
{
    // Get the authenticated user
    $user = Auth::user();

    // Fetch the user's cart items
    $cartItems = Cart::where('user_id', $user->user_id)->get();

    // Check if there are items in the cart
    if ($cartItems->isEmpty()) {
        // Flash a message and redirect back to the checkout page
        session()->flash('message', 'Your cart is empty.');
        return redirect()->route('checkout.page');  // Replace 'checkout.page' with your actual route name for the checkout page
    }

    // Calculate the total price
    $totalPrice = $cartItems->sum(function($cart) {
        return $cart->price * $cart->quantity;
    });

    // Create a new order
    $order = Order::create([
        'user_id' => $user->user_id,
        'total_price' => $totalPrice,
        'payment_status' => 'Pending', // Default value, you can adjust
        'delivery_status' => 'Pending', // Default value, you can adjust
    ]);

    // Move cart items to the order by updating the 'order_id' field
    foreach ($cartItems as $cart) {
        $cart->update(['order_id' => $order->order_id]);
    }

    // Insert delivery information into the OrderDetails table
    OrderDetail::create([
        'order_id' => $order->order_id,
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'address' => $request->input('address'),
        'region' => $request->input('region'),
        'province' => $request->input('province'),
        'city' => $request->input('city'),
        'barangay' => $request->input('barangay'),
        'phone' => $request->input('phone'),
        'payment_method' => $request->input('payment_method')
    ]);

    // Return a success message
    return redirect()->back()->with('message', 'Order placed successfully');
}

}
