<div class="w-full p-5 space-y-5">
    <div class="w-full flex justify-between items-center px-5 ">
        <div class="flex justify-center items-center gap-x-2">
            <select wire:model.lazy="status"
                class="w-20 rounded h-10 text-lg text-center capitalize border border-gray-900 ">
                <option value="all">all</option>
                <option value="pending">pending</option>
                <option value="verified">verified</option>
                <option value="on warehouse">on warehouse</option>
                <option value="on way">on way</option>
                <option value="delivered">delivered</option>
                <option value="cancelled">cancelled</option>
            </select>
        </div>
        <div
            class="flex justify-center items-center bg-gray-100 border drop-shadow-lg  border-gray-100 w-72 max-40 h-10 divide-x  divide-gray-400 ">
            {{-- <x-icons.search class=" " /> --}}
            <input type="text" wire:model.lazy="search" placeholder="search by Id or Name or Number"
                class="w-full h-full pl-2 border-none" />
        </div>
    </div>
    <div class="w-full overflow-x-auto">
        <table class="table-auto drop-shadow-lg text-center bg-primary">
            <thead class="drop-shadow-lg border-b ">
                <tr>
                    <th class="font-medium text-gray-700 p-2">Order ID</th>
                    <th class="font-medium text-gray-700 p-2">Full Name</th>
                    <th class="font-medium text-gray-700 p-2">Number</th>
                    <th class="font-medium text-gray-700 p-2">Email</th>
                    <th class="font-medium text-gray-700 p-2">Province</th>
                    <th class="font-medium text-gray-700 p-2">District</th>
                    <th class="font-medium text-gray-700 p-2">City</th>
                    <th class="font-medium text-gray-700 p-2">Street</th>
                    <th class="font-medium text-gray-700 p-2">Item Name</th>
                    <th class="font-medium text-gray-700 p-2">quantitiy</th>
                    <th class="font-medium text-gray-700 p-2">Grand Total</th>
                    <th class="font-medium text-gray-700 p-2">Payment Status</th>
                    <th class="font-medium text-gray-700 p-2">Order Status</th>
                    <th class="font-medium text-gray-700 p-2">Date Added</th>
                </tr>
            </thead>
            @forelse ($orders as $order)
                <tr class="drop-shadow-lg border-b">
                    <td class=" text-gray-700 p-2 capitalize min-w-max">#{{ $order->id }}</td>
                    <td class=" text-gray-700 p-2 capitalize min-w-max">{{ $order->full_name }}</td>
                    <td class=" text-gray-700 p-2 capitalize min-w-max">{{ $order->number }}</td>
                    <td class=" text-gray-700 p-2 ">{{ $order->email }}</td>
                    <td class=" text-gray-700 p-2 capitalize ">{{ $order->province }}</td>
                    <td class=" text-gray-700 p-2 capitalize ">{{ $order->distict }}</td>
                    <td class=" text-gray-700 p-2 capitalize ">{{ $order->city }}</td>
                    <td class=" text-gray-700 p-2 capitalize ">{{ $order->street }}</td>
                    <td class=" text-gray-700 p-2 capitalize  ">
                        @foreach ($order->orderItem as $item)
                            <div class=" p-2 capitalize "> {{ $item->product->name }}</div>
                        @endforeach
                    </td>
                    <td class=" text-gray-700 p-2 w-full">
                        @foreach ($order->orderItem as $item)
                            <div class="w-full p-2 capitalize "> {{ $item->quantity }}x</div>
                        @endforeach
                    </td>
                    <td class="text-gray-700 p-2 capitalize ">Rs.{{ $order->grand_total }}/-</td>
                    <td class="text-gray-700 p-2 capitalize ">{{ $order->payment_status }}</td>
                    <td class=" w-auto  p-3 text-center">
                        <select wire:change="updateDeliveryStatus({{ $order->id }}, $event.target.value)"
                            class="cursor-pointer rounded ">
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
                    <td class="text-gray-700 p-2 capitalize "> {{ $order->created_at->format('d:m:y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="13" class=" text-gray-700 p-2 capitalize m text-center">No orders found.</td>
                </tr>
            @endforelse
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
