@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            @if (Auth::check())
                <!-- left sidebar -->
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <nav class="nav nav-stacked">
                                <!-- links -->
                                <li><a href="">Email to a friend</a></li>
                                <li><a href="">Add to favourites</a></li>
                            </nav>
                        </div>
                    </div>
                </div>
            @endif

            <!-- right body -->
            <div class="{{ Auth::check() ? 'col-md-9' : 'col-md-12' }}">

                <!-- listing panel -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>{{ $listing->title }} <span class="text-muted">in {{ $listing->area->name }}</span></h4>
                    </div>
                    <div class="panel-body">
                        {!! nl2br(e($listing->body)) !!}
                        <hr>
                        <p>Viewed x times</p>
                    </div>
                </div>

                @if (Auth::guest())
                    <p><a href="{{ route('register') }}">Sign up</a> for an account or <a href="{{ route('login') }}">sign in</a> to
                        contact {{ $listing->user->name }}</p>
                @else
                    <!-- contact panel -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Contact {{ $listing->user->name }}
                            </div>
                            <div class="panel-body">
                                <form action="" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <textarea class="form-control" name="message" id="message" cols="30" rows="5">
                                        </textarea>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-default" type="submit">Send</button>
                                        <span class="help-block">This will email {{ $listing->user->name }} who will be able
                                 to respond to your query.</span>
                                    </div>
                                </form>
                            </div>
                        </div>
                @endif


            </div>
        </div>
    </div>
@endsection
