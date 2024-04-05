<?php

namespace App\Services;

use App\Models\Listing\Listing;
use App\Models\User\User;
use App\Notifications\ListingAssigned;
use App\Notifications\ListingDeassigned;
use App\Notifications\ListingDeleted;
use App\Notifications\ListingUpdated;

class ListingService
{
    /**
     * Create a new Listing.
     *
     * @param array $data
     * @param User $creator
     * @return Listing
     */
    public function createListing(array $data, User $creator): Listing
    {
        if (isset($data['inspector_uuid'])) {
            $inspector = User::query()->byUUID($data['inspector_uuid'])->first();
        }

        /** @var Listing $listing */
        $listing = Listing::query()->create([
            'creator_id'    => $creator->id,
            'inspector_id'  => isset($data['inspector_uuid']) ? $inspector->id : null,
            'title'         => $data['title'],
            'description'   => $data['description'],
            'address'       => $data['address'],
            'start'         => $data['start'],
            'end'           => $data['end'],
            'contact_name'  => $data['contact_name'],
            'contact_phone' => $data['contact_phone'],
            'contact_email' => $data['contact_email']
        ]);

        if (isset($data['inspector_uuid'])) {
//            $listing->inspector->notify(new ListingAssigned($listing));
        }

        return $listing;
    }

    public function updateListing(Listing $listing, array $data): Listing
    {
        $oldListing = clone $listing;

        $listing = $this->updateListingFields($listing, $data);

        if ($listing->inspector_id === $oldListing->inspector_id) {
//            $listing->inspector->notify(new ListingUpdated($listing));

            return $listing;
        }

        if (!$listing->inspector_id) {
//            $oldListing->inspector->notify(new ListingDeassigned($listing));

            return $listing;
        }

        if (!$oldListing->inspector_id) {
//            $listing->inspector->notify(new ListingAssigned($listing));

            return $listing;
        }

//        $oldListing->inspector->notify(new ListingDeassigned($listing));
//        $listing->inspector->notify(new ListingAssigned($listing));

        return $listing;
    }

    public function deleteListing(Listing $listing): Listing
    {
        $listing->delete();

//        $listing->inspector->notify(new ListingDeleted($listing));

        return $listing;
    }

    private function updateListingFields(Listing $listing, array $data): Listing
    {
        $fieldsToUpdate = [
            'inspector_id' => null
        ];

        if (isset($data['inspector_uuid'])) {
            $inspector = User::query()->byUUID($data['inspector_uuid'])->first();

            $fieldsToUpdate['inspector_id'] = $inspector->id;
        }

        $fields = ['description', 'title', 'address', 'start', 'end', 'contact_name', 'contact_phone', 'contact_email'];

        foreach ($fields as $field) {
            if (isset($data[$field])) {
                $fieldsToUpdate[$field] = $data[$field];
            }
        }

        $listing->update($fieldsToUpdate);

        return $listing;
    }
}
