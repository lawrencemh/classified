@extends('layouts.app')

@section('content')
    <div class="row">

        @if (Auth::check())
            <!-- left sidebar -->
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <nav class="nav nav-stacked">
                            <!-- links -->
                            <li><a href="">Email to a friend</a></li>
                            @if (!$listing->favouritedBy(Auth::user()))
                                <li>
                                    <a href="#"
                                       onclick="event.preventDefault(); document.getElementById('listings-favourite-form').submit();"
                                    >Add to favourites</a>
                                    <form method="post" action="{{ route('listing.favourites.store', [$area, $listing]) }}"
                                          id="listings-favourite-form" class="hidden">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            @endif
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
                    <p>Viewed {{ $listing->getViewedCount() }} times</p>
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
                            <form action="{{ route('listings.contact.store', [$area, $listing]) }}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group {{ $errors->has('message') ? ' has-error' : '' }}">
                                    <label for="message" class="control-label">Message</label>
                                    <textarea class="form-control" name="message" id="message" cols="30" rows="5">
                                    </textarea>

                                    @if ($errors->has('message'))
                                        <span class="help-block">
                                            {{ $errors->first('message') }}
                                        </span>
                                    @endif
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
@endsection
