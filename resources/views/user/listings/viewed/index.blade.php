@extends('layouts.app')

@section('content')
    <div class="row">
    <h4>Showing your last {{ $indexLimit }} viewed listings.</h4>
        @if($listings->count())
            @foreach($listings as $listing)
                @include('listings.partials._listing', compact('listing'))
            @endforeach
        @else
            <p>You haven't viewed any listings yet!</p>
        @endif
    </div>
@endsection
