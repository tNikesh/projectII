<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="flex w-full max-w-[400px]  flex-col justify-center items-start gap-y-1">
            <x-forms.label for="update_password_current_password" content="Current Password" />
            <x-forms.input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            @error('current_password')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
        </div>

        <div class="flex w-full max-w-[400px]  flex-col justify-center items-start gap-y-1">
              <x-forms.label  for="update_password_password" content="New Password" />
              <x-forms.input  id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            @error('password')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
        </div>

        <div class="flex w-full max-w-[400px]  flex-col justify-center items-start gap-y-1">
              <x-forms.label  for="update_password_password_confirmation" content="Confirm Password" />
              <x-forms.input  id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
              @error('password_confirmation')
              <span class="text-red-500 text-sm">{{ $message }}</span>
          @enderror
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
