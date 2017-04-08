<div class="form-group">
    <label for="category" class="control-label">Category</label>
    <select name="category_id" id="category" class="form-control">

        @foreach ($categories as $category)
            <optgroup label="{{ $category->name }}">
                @foreach ($category->children as $child)
                    <option value="{{ $child->id }}">{{ $child->name }}
                        @if ($child->price > 0)
                            (&pound; {{ number_format($child->price, 2) }})
                        @endif
                    </option>
                @endforeach
            </optgroup>
        @endforeach

    </select>
</div>