@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            @foreach($categories as $category)
                <div class="col-md-4">
                    <h5>{{ $category->name }}</h5>
                    <hr>

                    @foreach($category->children as $subCategory)
                        <h5><a href="">{{ $subCategory->name }}</a> (0)</h5>
                    @endforeach

                </div>
            @endforeach


        </div>
    </div>
@endsection