@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            @if($listings->count())
                @foreach($listings as $listing)
                    @include('listings.partials._listing_favourite', compact('listing'))
                @endforeach

                {{ $listings->links() }}
            @else
                <p>No favourite listings.</p>
            @endif
        </div>
    </div>
@endsection
