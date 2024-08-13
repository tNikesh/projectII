<x-app-layout>
    <section class="w-full flex items-center flex-col justify-center gap-y-9 py-14">
        <h1 class="text-3xl font-bold text-black tracking-widest uppercase ">login</h1>
        <form method ="post" action="{{ route('login.store') }}"
            class=" w-full flex flex-col justify-center items-center mx-auto gap-y-6 md:px-0 px-2">
            @csrf
            <x-forms.input type="text" name="role" value="user" hidden />
            <div class="flex w-full max-w-[400px]  flex-col justify-center items-start gap-y-1">
                <x-forms.label for="email" content="email" />
                <x-forms.input type="text" name="email" placeholder="Enter Your Email" value="{{ old('email') }}"
                    autofocus />
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex w-full flex-col justify-center items-start gap-y-1 max-w-[400px] ">
                <x-forms.label for="password" content="password" />
                <x-forms.input type="password" name="password" placeholder="********" />
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <x-forms.button type="submit" content="sign in"
                class="w-full max-w-[400px] h-[40px] text-3xl tracking-widest" />
            <a href="{{ route('signup') }}" class="text-xl font-normal tracking-widest">create account</a>
        </form>
    </section>
</x-app-layout>
