<div class="w-full p-5 space-y-5">

    <div class="W-full">
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
        <div
            class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
            
            <div class="text-center pb-2">
                <h1 class="text-gray-900 font-semibold text-lg text-center">customer Order</h1>
            </div>
            <table class="w-full text-left table-auto min-w-max">
                <thead>
                    <tr>
                        <th class="p-4 text-center border-b border-slate-300 bg-slate-50">
                            <p class="block text-sm font-normal leading-none text-slate-500">
                                Id
                            </p>
                        </th>
                        <th class="p-4 text-center border-b border-slate-300 bg-slate-50">
                            <p class="block text-sm font-normal leading-none text-slate-500">
                                Name
                            </p>
                        </th>
                        <th class="p-4 text-center border-b border-slate-300 bg-slate-50">
                            <p class="block text-sm font-normal leading-none text-slate-500">
                                Phone
                            </p>
                        </th>
                        <th class="p-4 text-center border-b border-slate-300 bg-slate-50">
                            <p class="block text-sm font-normal leading-none text-slate-500">
                                Address
                            </p>
                        </th>
                        <th class="p-4 text-center border-b border-slate-300 bg-slate-50">
                            <p class="block text-sm font-normal leading-none text-slate-500">
                                Product
                            </p>
                        </th>
                        <th class="p-4 text-center border-b border-slate-300 bg-slate-50">
                            <p class="block text-sm font-normal leading-none text-slate-500">
                                Total
                            </p>
                        </th>
                        <th class="p-4 text-center border-b border-slate-300 bg-slate-50">
                            <p class="block text-sm font-normal leading-none text-slate-500">
                                Payment
                            </p>
                        </th>
                        <th class="p-4 text-center border-b border-slate-300 bg-slate-50">
                            <p class="block text-sm font-normal leading-none text-slate-500">
                                Status
                            </p>
                        </th>
                        <th class="p-4 text-center border-b border-slate-300 bg-slate-50">
                            <p class="block text-sm font-normal leading-none text-slate-500">
                                Date
                            </p>
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr class="hover:bg-slate-50">
                            <td class="p-4 border-b border-slate-200">
                                <p class="block text-sm text-slate-800">
                                    {{ $order->id }}
                                </p>
                            </td>
                            <td class="p-4 border-b border-slate-200">
                                <p class="block text-sm text-slate-800 whitespace-nowrap">
                                    {{ $order->full_name }}
                                </p>
                            </td>
                            <td class="p-4 border-b border-slate-200">
                                <p class="block text-sm text-slate-800">
                                    {{ $order->number }}
                                </p>
                            </td>
                          
                            <td class="p-4 border-b border-slate-200">
                                <p class="block text-sm text-slate-800">
                                    {{ $order->city }}
                                </p>
                            </td>
                            <td class="p-4 border-b border-slate-200">
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
                            <td class="p-4 border-b border-slate-200">
                                <p class="block text-sm text-slate-800">
                                    {{ $order->grand_total }}
                                </p>
                            </td>
                            <td class="p-4 border-b border-slate-200">
                                <p class="block text-sm text-slate-800">
                                    {{ $order->payment_status }}
                                </p>
                            </td>
                            <td class="p-4 border-b border-slate-200">
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
                            <td class="p-4 border-b border-slate-200">
                                <p class="block text-sm text-slate-800">
                                    {{ $order->created_at->format('M d,Y') }}
                                </p>
                            </td>


                        </tr>

                    @empty
                        <tr class="hover:bg-slate-50">
                            <td colspan="9" class="p-2 text-center">no orders</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


    </div>


    <div class="conatiner py-6">
        {{ $orders->links('vendor.pagination.tailwind') }}
    </div>

    <div class="my-10 w-full flex justify-between items-center">
        <div class="flex justify-center items-center gap-x-2">
            <select wire:model.debounce.500ms="perPage" class=" py-2 px-4 text-center rounded border border-gray-900">
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
