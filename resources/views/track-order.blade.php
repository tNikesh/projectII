<x-app-layout>
    <section
        class="bg-white flex items-center justify-center w-full md:justify-evenly gap-x-5 md:gap-x-20 gap-y-10 md:gap-y-14 flex-wrap md:px-14 py-5">
        <div class="w-full  drop-shadow-sm  space-y-4">
            <div class="flex justify-start items-center gap-3"><x-icons.trackOrder />
                <h2 class="text-xl font-semibold tracking-wider">Track Your Order</h2>
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
                                {{ $order->delivery_status }}
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
        </div>
    </section>
</x-app-layout>