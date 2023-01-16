<div>
    <x-input-label for="title" :value="__('Title')" />
    <x-text-input id="title" name="title" type="text" class="block w-full mt-1" :value="old('title', $category->title ?? '')" required autofocus autocomplete="title" />
    <x-input-error class="mt-2" :messages="$errors->get('title')" />
</div>

<div class="flex items-center gap-4">
    <x-primary-button>{{ __('Create Category') }}</x-primary-button>
</div>
