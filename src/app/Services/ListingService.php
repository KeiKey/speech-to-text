<?php

namespace App\Services;

use App\Models\Listing\Listing;
use App\Models\User\User;
use App\Notifications\ListingAssigned;
use Illuminate\Support\Carbon;

class ListingService
{
    /**
     * Create a new Listing.
     *
     * @param array $data
     * @return Listing
     */
    public function createListing(array $data, User $creator): Listing
    {
        /** @var Listing $listing */
        $listing = Listing::query()->create([
            'creator_id'    => $creator->id,
            'inspector_id'  => $data['inspector_id'] ?? null,
            'title'         => $data['title'],
            'description'   => $data['description'],
            'address'       => $data['address'],
            'start'         => $data['start'],
            'end'           => $data['end'],
            'contact_name'  => $data['contact_name'],
            'contact_phone' => $data['contact_phone'],
            'contact_email' => $data['contact_email']
        ]);

        if ($listing->inspector) {
            $listing->inspector->notify(new ListingAssigned($listing));
        }

        return $listing;
    }

    public function updateListing(Listing $listing, array $data): Listing
    {

    }

    public function deleteListing(Listing $listing): Listing
    {

    }
}
