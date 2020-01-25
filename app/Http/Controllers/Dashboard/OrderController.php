<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $number = $request->input('number');
        $buyerUserName = $request->input('buyerUserName');
        $productName = $request->input('productName');
        $companyName = $request->input('companyName');
        $status = $request->input('status');

        $orders = Order::query();
        if ($number != null) {
            $orders = $orders->where('number', 'like', '%' . $number . '%');
        }
        if ($buyerUserName != null) {
            $orders = $orders->whereHas('user', function (Builder $query) use ($buyerUserName) {
                $query->where('name', 'like', '%' . $buyerUserName . '%');
            });
        }
        if ($productName != null) {
            $orders = $orders->whereHas('product', function (Builder $query) use ($productName) {
                $query->where('name', 'like', '%' . $productName . '%');
            });
        }
        if ($companyName != null) {
            $orders = $orders->whereHas('product.company', function (Builder $query) use ($companyName) {
                $query->where('name', 'like', '%' . $companyName . '%');
            });
        }
        if ($status != null) {
            $orders = $orders->where('status', $status);
        }
        $orders = $orders->with('user')
            ->with('product.company')
            ->orderBy('id', 'desc')
            ->paginate(10);

        $orderStatusList = [
            OrderStatus::PENDING => __('messages.order_pending'),
            OrderStatus::IN_PROGRESS => __('messages.order_in_progress'),
            OrderStatus::FINISHED => __('messages.order_finished'),
            OrderStatus::CANCELED => __('messages.order_canceled'),
        ];

        $request->flash();
        return view('dashboard.pages.order.list', [
            'orders' => $orders,
            'orderStatusList' => $orderStatusList,
        ]);
    }

    public function show($id)
    {
        $order = Order::query()
            ->with('user')
            ->with('product')
            ->findOrFail($id);
        return view('dashboard.pages.order.show', [
            'order' => $order,
        ]);
    }

    public function processOrder(Order $order)
    {
        if ($order->status == OrderStatus::PENDING) {
            $order->status = OrderStatus::IN_PROGRESS;
            $order->save();
        }
        return redirect()->back()->with('success', __('messages.order_status_changed'));
    }

    public function finishOrder(Order $order)
    {
        if ($order->status == OrderStatus::IN_PROGRESS) {
            $order->status = OrderStatus::FINISHED;
            $order->save();
        }
        return redirect()->back()->with('success', __('messages.order_status_changed'));
    }

    public function cancelOrder(Order $order)
    {
        if ($order->status == OrderStatus::PENDING || $order->status == OrderStatus::IN_PROGRESS) {
            $order->status = OrderStatus::CANCELED;
            $order->save();
        }
        return redirect()->back()->with('success', __('messages.order_status_changed'));
    }
}