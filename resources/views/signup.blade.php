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
    <main class="w-full flex flex-col items-center justify-center py-14">
        <section class="w-full flex items-center flex-col justify-center gap-y-9">
            <h1 class="text-3xl font-bold text-black tracking-widest uppercase ">Sign up</h1>
            <form action="" class=" w-full flex flex-col justify-center items-center mx-auto gap-y-6 md:px-0 px-2">
                @csrf
               <div class="flex w-full max-w-[400px]  flex-col justify-center items-start gap-y-1">
                <x-forms.label for="fname" content="First Name"/>
                <x-forms.input type="text" name="fname" placeholder="Enter Your First Name" autofocus/>
               </div>
               <div class="flex w-full max-w-[400px]  flex-col justify-center items-start gap-y-1">
                <x-forms.label for="lname" content="Last Name"/>
                <x-forms.input type="text" name="lname" placeholder="Enter Your Last Name"/>
               </div>
               <div class="flex w-full max-w-[400px]  flex-col justify-center items-start gap-y-1">
                <x-forms.label for="email" content="email"/>
                <x-forms.input type="text" name="email" placeholder="Enter Your Email"/>
               </div>
               <div class="flex w-full flex-col justify-center items-start gap-y-1 max-w-[400px] ">
                <x-forms.label for="password" content="password"/>
                <x-forms.input type="password" name="password" placeholder="********"/>
               </div>
               <x-forms.button type="submit" content="create" class="w-full max-w-[400px] h-[40px] text-3xl tracking-widest"/>
            </form>
        </section>
    </main>
    <x-footer/>
    @stack('scripts')
</body>
</html>