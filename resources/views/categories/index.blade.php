@extends('layouts.app')

@section('content')
    <div class="row">

        @foreach($categories as $category)
            <div class="col-md-4">
                <h5>{{ $category->name }}</h5>
                <hr>

                @foreach($category->children as $subCategory)
                    <h5>
                        <a href="{{ route('category.listings.index', [$area, $subCategory]) }}">{{ $subCategory->name }}</a>
                        ({{ $subCategory->listings->count() }})
                    </h5>
                @endforeach

            </div>
        @endforeach

    </div>
@endsection
