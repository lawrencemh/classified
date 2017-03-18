@extends('layouts.app')

@section('content')
    <div class="row">

        <!-- for each country -->
        @foreach($areas as $country)
            <div class="col-md-12">
                <div class="panel panel-detault">
                    <div class="panel-body">
                        <h3><a href="{{ route('user.area.store', $country) }}">{{ $country->name }}</a></h3>
                        <!-- State -->
                        <div class="row">
                            <!-- for each state/county -->
                            @foreach($country->children as $state)
                                <div class="col-md-4">
                                    <!-- for each city -->
                                    <h4><a href="{{ route('user.area.store', $state) }}">{{ $state->name }}</a></h4>
                                    @foreach($state->children as $city)
                                        <h5><a href="{{ route('user.area.store', $city) }}">{{ $city->name }}</a></h5>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
