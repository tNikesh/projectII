<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <style>

    </style>
    @vite('resources/css/app.css')
</head>

<body class="bg-white w-screen h-screen p-0 m-0 overflow-x-hidden">
    <x-admin.side-bar />
    <main class="w-[87%] absolute right-0 top-0 p-5 pb-20">
        <section class=" md:px-10 space-y-10">
            <div class="w-full flex justify-center items-center  flex-wrap sm:gap-14 gap-10 ">


                <div class=" w-full flex justify-between sm:justify-evenly items-center sm:gap-14 gap-10">
                    <div
                        class="h-16 bg-indigo-500 flex justify-between items-center px-3 sm:w-52 w-full rounded-lg drop-shadow-sm border border-gray-300">
                        <div class="flex justify-start items-start flex-col gap-y-1">
                            <span class="text-base font-medium whitespace-nowrap text-white">Total Order</span>
                            <span
                                class="text-xl font-bold whitespace-nowrap text-white">{{ number_format($totalOrders) }}</span>
                        </div>
                    </div>
                    <div
                        class="h-16 bg-green-500 flex justify-between items-center px-3 sm:w-52 w-full  rounded-lg drop-shadow-sm border border-gray-300">
                        <div class="flex justify-start items-start flex-col gap-y-1">
                            <span class="text-base font-medium whitespace-nowrap text-white">Total Revenue</span>
                            <span
                                class="text-xl font-bold whitespace-nowrap text-white">Rs.{{ number_format($totalRevenue) }}</span>
                        </div>
                        <div>
                        </div>
                    </div>
                    <div
                        class="h-16 bg-red-500 flex justify-between items-center px-3 sm:w-52 w-full  rounded-lg drop-shadow-sm border border-gray-300">
                        <div class="flex justify-start items-start flex-col gap-y-1">
                            <span class="text-base font-medium whitespace-nowrap text-white">Cancelled Rate</span>
                            <span
                                class="text-xl font-bold whitespace-nowrap text-white">{{ number_format($cancellationRate) }}
                                %</span>
                        </div>
                        <div>
                        </div>
                    </div>
                    <div
                        class="h-16 bg-blue-500 flex justify-between items-center px-3 sm:w-52 w-full  rounded-lg drop-shadow-sm border border-gray-300">
                        <div class="flex justify-start items-start flex-col gap-y-1">
                            <span class="text-base font-medium text-white whitespace-nowrap">Delivered Rate</span>
                            <span
                                class="text-xl font-bold text-white whitespace-nowrap">{{ number_format($deliveryRate) }}
                                %</span>
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="W-full">
                <div
                    class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
                    <div class="text-center pb-2">
                        <h1 class="text-gray-900 font-semibold text-lg">Recent Orders</h1>
                    </div>
                    <table class="w-full text-left table-auto min-w-max">
                        <thead>
                            <tr>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        Id
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        Name
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        Phone
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        Total
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        Payment
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        Status
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
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
                                        <p class="block text-sm text-slate-800 whitespace-nowrap">
                                            Rs.{{ $order->grand_total }}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-slate-200">
                                        <p class="block text-sm text-slate-800">
                                            {{ $order->payment_status }}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-slate-200">
                                        <p class="block text-sm text-slate-800">
                                            {{ $order->delivery_status }}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-slate-200">
                                        <p class="block text-sm text-slate-800">
                                            {{ $order->created_at->format('M d,Y') }}
                                        </p>
                                    </td>


                                </tr>

                            @empty
                                <tr class="hover:bg-slate-50">
                                    <td colspan="6">no orders</td>
                                </tr>
                            @endforelse
                            <tr>
                                <td colspan="7" class="border pl-3 py-1 text-left">
                                    <a href="{{ route('customer.order') }}" class="text-gray-700 lowercase">See More
                                        ...</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>


            </div>
            <div class="W-full">
                <div
                    class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
                    <div class="text-center pb-2">
                        <h1 class="text-gray-900 font-semibold text-lg">Recent Reviews</h1>
                    </div>
                    <table class="w-full text-left table-auto min-w-max">
                        <thead>
                            <tr>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        Id
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        User Name
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block w-40 text-sm font-normal leading-none text-slate-500">
                                        Reviews
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        Ratings
                                    </p>
                                </th>

                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        Date
                                    </p>
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reviews as $review)
                                <tr class="hover:bg-slate-50">
                                    <td class="p-4 border-b border-slate-200">
                                        <p class="block text-sm text-slate-800">
                                            {{ $review->id }}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-slate-200">
                                        <p class="block text-sm text-slate-800 whitespace-nowrap">
                                            {{ $review->user->name }}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-slate-200">
                                        <p class="block w-40 text-sm text-slate-800">
                                            {{ $review->reviews }}
                                        </p>
                                    </td>
                                    <td class="p-4 border-b border-slate-200">
                                        <p class="block text-sm text-slate-800 whitespace-nowrap">
                                            {{ $review->ratings }} stars
                                        </p>
                                    </td>
                                  
                                    <td class="p-4 border-b border-slate-200">
                                        <p class="block text-sm text-slate-800">
                                            {{ $review->created_at->format('M d,Y') }}
                                        </p>
                                    </td>


                                </tr>

                            @empty
                                <tr class="hover:bg-slate-50">
                                    <td colspan="6">no reviews</td>
                                </tr>
                            @endforelse
                            <tr>
                                <td colspan="5" class="border pl-3 py-1 text-left">
                                    <a href="{{ route('view.review') }}" class="text-gray-700 lowercase">See More
                                        ...</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>


            </div>
        </section>
    </main>
    @stack('scripts')
</body>

</html>
