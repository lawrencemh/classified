<?php

namespace App\Policies;

use App\Listing;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ListingPolicy
{
    use HandlesAuthorization;

    /**
     * Validates whether a user has permission to edit a listing.
     *
     * @param \App\User $user
     * @param \App\Listing $listing
     * @return bool
     */
    public function edit(User $user, Listing $listing)
    {
        return $listing->ownedByUser($user);
    }

    /**
     * Validates whether a user has permission to update a listing.
     *
     * @param \App\User $user
     * @param \App\Listing $listing
     * @return bool
     */
    public function update(User $user, Listing $listing)
    {
        return $listing->ownedByUser($user);
    }

    /**
     * Validates whether a user has permission to destroy a listing.
     *
     * @param \App\User $user
     * @param \App\Listing $listing
     * @return bool
     */
    public function destroy(User $user, Listing $listing)
    {
        return $listing->ownedByUser($user);
    }
}
