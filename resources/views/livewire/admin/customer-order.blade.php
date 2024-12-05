<div class="w-full p-5 space-y-5">
    <div class="w-full flex justify-between items-center px-5 ">
        <div class="flex justify-center items-center gap-x-2">
            <select wire:model.lazy="status"
                class="w-auto px-2 py-1 rounded text-lg text-center capitalize border border-gray-900 ">
                <option value="all">all</option>
                <option value="pending">pending</option>
                <option value="verified">verified</option>
                <option value="on warehouse">on warehouse</option>
                <option value="on way">on way</option>
                <option value="delivered">delivered</option>
                <option value="cancelled">cancelled</option>
            </select>
        </div>
    </div>
    <div class="w-full overflow-x-auto">
        <table class="w-full table-auto drop-shadow-lg text-center bg-primary">
            <thead class="w-full border-b border-gray-300">
                <tr>
                    <th class="p-1">Id</th>
                    <th class="p-1">Name</th>
                    <th class="p-1">Number</th>
                    <th class="p-1">Email</th>
                    <th class="p-1">Address</th>
                    <th class="p-1">Product</th>
                    <th class="p-1">Total</th>
                    <th class="p-1">Payment</th>
                    <th class="p-1">Status</th>
                    <th class="p-1">Date</th>
                </tr>
            </thead>
            <tbody class="w-full divide-x divide-gray-500 text-gray-800 capitalize">
            @forelse ($orders as $order)
                <tr class="">
                    <td class=" p-1 ">#{{ $order->id }}</td>
                    <td class=" p-1 ">{{ $order->full_name }}</td>
                    <td class=" p-1 ">{{ $order->number }}</td>
                    <td class=" p-1 ">{{ $order->email }}</td>
                    <td class=" p-1  ">
                  <div class="w-36">
                    {{ $order->province }}, {{ $order->district }}, {{ $order->city }}
                  </div>
                    
                        </td>
                    <td class=" p-1  ">
                      <div class="w-auto flex justify-center items-center flex-col gap-1">
                        @foreach ($order->orderItem as $item)
                        <div class="flex justify-center items-center gap-1">

                            <div class=" p-1 "> {{ $item->product->name }}</div>
                            <div class=" p-1  whitespace-nowrap"> Rs .{{ $item->base_price }}</div>
                            <div class=" p-1 whitespace-nowrap"> {{ $item->quantity }}x</div>
                            <div class=" p-1  whitespace-nowrap"> {{ $item->discount }}%</div>
                        </div>
                    @endforeach
                      </div>
                    </td>

                    <td class=" p-1 ">Rs.{{ $order->grand_total }}/-</td>
                    <td class=" p-1 ">{{ $order->payment_status }}</td>
                    <td class=" p-1 text-center">
                        <select wire:change="updateDeliveryStatus({{ $order->id }}, $event.target.value)"
                            class="cursor-pointer rounded px-2 py-1 ">
                            <option value="pending" {{ $order->delivery_status == 'pending' ? 'selected' : '' }}>
                                pending
                            </option>
                            <option value="verified" {{ $order->delivery_status == 'verified' ? 'selected' : '' }}>
                                verified
                            </option>
                            <option value="on warehouse"
                                {{ $order->delivery_status == 'on warehouse' ? 'selected' : '' }}>
                                on warehouse
                            </option>
                            <option value="on way" {{ $order->delivery_status == 'on way' ? 'selected' : '' }}>
                                on way
                            </option>
                            <option value="delivered" {{ $order->delivery_status == 'delivered' ? 'selected' : '' }}>
                                delivered
                            </option>
                            <option value="cancelled" {{ $order->delivery_status == 'cancelled' ? 'selected' : '' }}>
                                cancelled
                            </option>

                        </select>
                    </td>
                    <td class=" p-1  "> {{ $order->created_at->format('M d,Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="13" class="  p-1 text-center">No orders found.</td>
                </tr>
            @endforelse
        </tbody>
        </table>
    </div>
    <div class="conatiner py-6">
        {{ $orders->links('vendor.pagination.tailwind') }}
    </div>

    <div class="my-10 w-full flex justify-between items-center">
        <div class="flex justify-center items-center gap-x-2">
            <select wire:model.debounce.500ms="perPage" class="w-20 h-10 rounded border border-gray-900">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="50">50</option>
            </select>
        </div>
        <div>
            {{ $orders->links('vendor.pagination.tailwind') }}
        </div>
    </div>
</div>
