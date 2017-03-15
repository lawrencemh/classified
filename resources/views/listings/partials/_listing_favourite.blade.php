@component('listings.partials._base_listing', compact('listing'))
    @slot('listing_links')
        <ul class="list-inline">
            <li>Added {{ $listing->pivot->created_at->diffForHumans() }}</li>
            <li><a href="#" onClick="event.preventDefault();document.getElementById('remove-listing-favourite-{{ $listing->id }}').submit();">Remove</a></li>
        </ul>

        <form id="remove-listing-favourite-{{ $listing->id }}" action="{{ route('listing.favourites.destroy', [$area, $listing]) }}" class="hidden" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
        </form>
    @endslot
@endcomponent