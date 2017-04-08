@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Listing</div>
                <div class="panel-body">
                    <form action="{{ route('listings.store', [$area]) }}" method="post">
                        {{ csrf_field() }}

                        @include('listings.partials.forms._areas')

                        @include('listings.partials.forms._categories')

                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="title" class="control-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control">

                            @if ($errors->has('title'))
                                <span class="help-block">
                                    {{ $errors->first('title') }}
                                </span>
                            @endif

                        </div>

                        <div class="form-group {{ $errors->has('body') ? ' has-error' : '' }}">
                            <label for="body" class="control-label">Body</label>
                            <textarea type="text" name="body" id="body" class="form-control"></textarea>

                            @if ($errors->has('body'))
                                <span class="help-block">
                                    {{ $errors->first('body') }}
                                </span>
                            @endif

                        </div>
                        
                        <div class="form-group">
                            <button class="btn btn-default">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
