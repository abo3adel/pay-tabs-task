<x-guest-layout>
    <div class="w-full text-center">
        <select  name="category_id" id="category_id1" class="select bg-gray-700 text-white">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <div id="sub-categories">

        </div>
    </div>
</x-guest-layout>