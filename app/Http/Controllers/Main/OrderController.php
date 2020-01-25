<?php

namespace App\Http\Controllers\Main;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function poultryJamOrders(Request $request)
    {
        $userId = Auth::user()->id;
        $orders = Order::query()
            ->where('buyerUserId', $userId)
            ->with('product.company.company')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('pages.order.list', [
            'orders' => $orders,
        ]);
    }

    public function createOrder(Request $request)
    {
        $request->validate([
            'productId' => 'required|numeric',
            'quantity' => 'required|numeric|min:1'
        ]);

        $productId = $request->input('productId');
        $product = Product::query()->findOrFail($productId);
        $order = new Order();
        $order->productId = $productId;
        $order->productPrice = $product->price;
        $order->productWeight = $product->weight;
        $order->productWeightType = $product->weightType;
        $order->buyerUserId = Auth::user()->id;
        $order->quantity = $request->input('quantity');
        $order->price = $order->quantity * $product->price;
        $order->number = $this->generateCode(12);
        $order->status = OrderStatus::PENDING;
        $order->date = date('Y-m-d h:i:s');
        $order->save();

        return redirect()->route('poultry-jam.orders')
            ->with('success', __('messages.order_set'));
    }

    private function generateCode($length = 6)
    {
        return strtoupper(substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $length));
    }

    public function companyOrders(Request $request)
    {
        $userId = Auth::user()->id;
        $orders = Order::query()
            ->whereHas('product', function (Builder $query) use ($userId) {
                $query->where('companyId', $userId);
            })
            ->with('product')
            ->with('user.poultryJam')
            ->orderBy('date', 'desc')
            ->paginate(10);
        return view('pages.order.list', [
            'orders' => $orders,
        ]);
    }
}
