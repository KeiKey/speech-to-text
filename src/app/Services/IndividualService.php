<?php

namespace App\Services;

use App\Models\Individual\Individual;

class IndividualService
{
    /**
     * Create a new Individual.
     *
     * @param array $data
     * @return Individual
     */
    public function createIndividual(array $data): Individual
    {
        /** @var Individual $individual */
        $individual = Individual::query()->create([
            'name'         => $data['name'],
            'email'        => $data['email'],
            'address'      => $data['address'],
            'phone_number' => $data['phone_number'],
            'vat_number'   => $data['vat_number'],
        ]);

        return $individual;
    }

    /**
     * Update an existing Individual.
     *
     * @param Individual $individual
     * @param array $data
     * @return Individual
     */
    public function updateIndividual(Individual $individual, array $data): Individual
    {
        $individual->update([
            'name'         => $data['name'],
            'email'        => $data['email'],
            'address'      => $data['address'],
            'phone_number' => $data['phone_number'],
        ]);

        return $individual;
    }

    /**
     * Delete a Individual.
     *
     * @param Individual $individual
     * @return Individual
     */
    public function deleteIndividual(Individual $individual): Individual
    {
        $individual->delete();

        return $individual;
    }
}
