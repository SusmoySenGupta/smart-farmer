<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Balance') }} ({{ $user->balance }} Tk)
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's balance information.") }}
        </p>
    </header>

    <form method="post" action="{{ route('users.update-balance', $user) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="balance" :value="__('Add money')" />
            <x-text-input id="balance" name="balance" type="text" class="block w-full mt-1" :value="old('balance')" required autocomplete="balance" />
            <x-input-error class="mt-2" :messages="$errors->get('balance')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
