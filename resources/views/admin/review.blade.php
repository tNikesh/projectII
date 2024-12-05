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
            <div class="text-center pb-2">
                <h1 class="text-gray-900 font-semibold text-lg">Customer Reviews</h1>
            </div>
            <div class="W-full">
                <div
                    class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
                  
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
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        Action
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
                                <td class="p-4 border-b border-slate-200">
                                    <p class="block text-sm text-slate-800">
                                        <form action="{{ route('delete.review',$review->id) }}" method="get">
                                            @csrf
                                            <button type="submit" class="px-3 p-1 text-sm bg-blue-500 text-white">Delete</button>
                                        </form>
                                    </p>
                                </td>


                            </tr>

                            @empty
                            <tr class="hover:bg-slate-50">
                                <td colspan="6">no reviews</td>
                            </tr>
                            @endforelse
                          
                        </tbody>
                    </table>
                </div>
                <div class="w-full pt-5">{{ $reviews->links() }}</div>


            </div>
        </section>
    </main>
    @stack('scripts')
</body>

</html>