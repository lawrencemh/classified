@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Continue editing listing
                    @if ($listing->live())
                        <span class="pull-right"><a class="btn btn-default btn-xs" href="{{ route('listings.show', [$area, $listing]) }}">Visit Listing</a></span>
                    @endif
                </div>
                <div class="panel-body">
                    <form action="{{ route('listings.update', [$area, $listing]) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}

                        @include('listings.partials.forms._areas')

                        @include('listings.partials.forms._categories')
                        <input type="hidden" name="category_id" value="{{ $listing->category->id }}"/>
                        
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="title" class="control-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $listing->title }}">

                            @if ($errors->has('title'))
                                <span class="help-block">
                                    {{ $errors->first('title') }}
                                </span>
                            @endif

                        </div>
                        
                        <div class="form-group {{ $errors->has('body') ? ' has-error' : '' }}">
                            <label for="body" class="control-label">Body</label>
                            <textarea type="text" name="body" id="body" class="form-control">{{ $listing->body }}
                            </textarea>

                            @if ($errors->has('body'))
                                <span class="help-block">
                                    {{ $errors->first('body') }}
                                </span>
                            @endif

                        </div>

                        <div class="form-group clearfix">
                            <button class="btn btn-default">Save</button>
                            
                            @if (!$listing->live())
                            <button class="btn btn-primary pull-right" type="submit" name="payment" value="true">
                                Continue to Payment
                            </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
