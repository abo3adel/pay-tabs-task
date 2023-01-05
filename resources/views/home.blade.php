<x-guest-layout>
    <div class="w-full text-center">
        <select name="category_id" id="category_id" class="bg-gray-700 text-white">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
</x-guest-layout>