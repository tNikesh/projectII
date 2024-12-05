<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerOrder extends Component
{
    use WithPagination;

    public $status = "all";
    public $perPage = '5';


    public function updated($peroperties)
    {
        if (in_array($peroperties, ['perPage',  'status'])) {
            $this->resetPage();
        }
    }
    public function updateDeliveryStatus($orderId, $status)
    {
        $order = Order::find($orderId);
        if (!$order) {
            $this->dispatch('notification', ['type' => 'error', 'message' => 'Failed, Order not found']);
            return;
        }

        $order->delivery_status = $status;

        if ($order->save()) {
            $this->dispatch('notification', ['type' => 'success', 'message' => 'Order status updated successfully']);
        } else {
            $this->dispatch('notification', ['type' => 'error', 'message' => 'Failed to update the order status']);
        }
    }
    public function render()
    {

        $orders = Order::with([
            'orderItem' => function ($query) {
                $query->with('product');
            },
        ])
            ->where(function ($query) {
                if ($this->status !== 'all') {
                    $query->where('delivery_status', $this->status);
                }
            })
            ->latest()
            ->paginate($this->perPage);
        return view('livewire.admin.customer-order', compact('orders'));
    }
}
