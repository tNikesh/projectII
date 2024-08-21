<x-app-layout>
    <section
        class="bg-white flex items-center justify-center w-full md:justify-evenly gap-x-5 md:gap-x-20 gap-y-10 md:gap-y-14 flex-wrap md:px-14 py-5">
        <div class="w-full  drop-shadow-2xl  space-y-4">
            <div class="flex justify-start items-center gap-3"><x-icons.trackOrder />
                <h2 class="text-xl font-semibold tracking-wider">Track Your Order</h2>
            </div>
            <div class="w-full overflow-x-auto">
                <table class="table-auto drop-shadow-lg text-center bg-primary">
                    <thead class="drop-shadow-lg border-b ">
                        <tr >
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
                            <td class=" text-gray-700 p-2 ">{{ $order->number }}</td>
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
                            <td class="text-gray-700 p-2 capitalize ">{{ $order->delivery_status }}</td>
                            <td class="text-gray-700 p-2 capitalize ">  {{ $order->created_at->format('M d,Y') }}</td>
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
        </div>
    </section>
</x-app-layout>