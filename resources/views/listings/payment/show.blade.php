@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Pay for your listing</div>
                <div class="panel-body">
                    @if ($listing->cost() == 0)
                        <form method="post" action="">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <p>This listing is included as part of our free categories.<p>
                            <button class="btn btn-primary" type="submit">Proceed</button>
                        </form>
                    @else
                        <p>Total cost: &pound; {{ number_format($listing->cost(), 2) }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
