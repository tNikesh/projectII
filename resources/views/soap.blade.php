<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body class="w-screen h-screen bg-primary overflow-x-hidden p-0 m-0">
    <x-header.header />
    <main class="w-full flex flex-col items-center justify-center gap-y-16 py-14">
        <h1 class="w-full text-center font-bold uppercase text-4xl tracking-widest">Soap</h1>
            <section class="flex items-center justify-center w-full md:justify-evenly gap-x-5 md:gap-x-20 gap-y-10 md:gap-y-14 flex-wrap md:px-14">
                @foreach($soaps as $product)
                
            <x-product-card :product="$product"/>
            @endforeach
        </section>
    </main>
    <x-footer/>
    @stack('scripts')
</body>
</html>
