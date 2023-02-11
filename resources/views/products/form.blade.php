<!-- Title & Category -->
<div class="flex flex-col w-full gap-4 md:flex-row md:items-center md:justify-between">
    <!-- Title -->
    <div class="w-full">
        <x-input-label for="title" :value="__('Title')" />
        <x-text-input id="title" class="block w-full mt-1" type="text" name="title" :value="old('title', $product?->title ?? '')" required autofocus placeholder="Enter product title" />
        <x-input-error for="title" class="mt-2" :messages="$errors->get('title')" />
    </div>

    <!-- Category Id -->
    <div class="w-full">
        <x-input-label for="category_id" :value="__('Category')" />
        <x-select-input id="category_id" class="block w-full mt-1" name="category_id" required>
            <option value="">Select Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $product?->category_id ?? -1) == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
            @endforeach
        </x-select-input>
        <x-input-error for="category_id" class="mt-2" :messages="$errors->get('category_id')" />
    </div>
</div>

<!-- Price & Stock -->
<div class="flex flex-col w-full gap-4 mt-4 md:flex-row md:items-center md:justify-between">
    <!-- Price -->
    <div class="w-full">
        <x-input-label for="price" :value="__('Price')" />
        <x-text-input id="price" class="block w-full mt-1" type="number" name="price" :value="old('price', $product?->price ?? '')" required placeholder="Enter product price" />
        <x-input-error for="price" class="mt-2" :messages="$errors->get('price')" />
    </div>

    <!-- Stock -->
    <div class="w-full">
        <x-input-label for="stock" :value="__('Stock')" />
        <x-text-input id="stock" class="block w-full mt-1" type="number" name="stock" :value="old('stock', $product?->stock ?? '')" required placeholder="Enter product stock" />
        <x-input-error for="stock" class="mt-2" :messages="$errors->get('stock')" />
    </div>
</div>

<!-- Image -->
<div class="flex items-center gap-4 mt-4">
    <div class="w-full">
        <x-input-label for="image" :value="__('Image')" />
        <x-text-input id="image" class="block w-full mt-1 border" type="file" name="image" placeholder="Upload product image" :required="!$product->image_url" />
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF (MAX 2MB)</p>
        <x-input-error for="file" class="mt-2" :messages="$errors->get('image')" />
    </div>
    @if ($product->image_url)
        <div class="overflow-hidden border-2 border-dashed rounded-md shadow-md border-spacing-2 dark:border-gray-600">
            <img src="{{ Storage::url($product->image_url) }}" alt="{{ $product->title }}" class="object-cover w-32 h-32 rounded-md" />
        </div>
    @endif
</div>

<!-- Description -->
<div class="mt-4">
    <x-input-label for="description" :value="__('Description')" />
    <x-textarea-input id="description" class="block w-full mt-1" rows="4" type="text" name="description" :value="old('description', $product?->description ?? '')" placeholder="Enter product description" />
    <x-input-error for="description" class="mt-2" :messages="$errors->get('description')" />
</div>

<!-- Active -->
<div class="mt-4">
    <label class="relative inline-flex items-center cursor-pointer">
        <input type="checkbox" value="1" name="active" class="sr-only peer" {{ old('active', $product?->is_active ?? 1) == 1 ? 'checked' : '' }}>
        <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Active</span>
    </label>
    <x-input-error for="active" class="mt-2" :messages="$errors->get('active')" />
</div>
