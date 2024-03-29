<?php

namespace App\Services;

use App\Models\Company\Company;

class CompanyService
{
    /**
     * Create a new Company.
     *
     * @param array $data
     * @return Company
     */
    public function createCompany(array $data): Company
    {
        /** @var Company $company */
        $company = Company::query()->create([
            'name'          => $data['name'],
            'email'         => $data['email'],
            'address'       => $data['address'],
            'vat_number'    => $data['vat_number'],
            'contact_name'  => $data['contact_name'],
            'contact_phone' => $data['contact_phone'],
            'contact_email' => $data['contact_email'],
        ]);

        return $company;
    }

    /**
     * Update an existing Company.
     *
     * @param Company $company
     * @param array $data
     * @return Company
     */
    public function updateCompany(Company $company, array $data): Company
    {
        $company->update([
            'name'          => $data['name'],
            'email'         => $data['email'],
            'address'       => $data['address'],
            'vat_number'    => $data['vat_number'],
            'contact_name'  => $data['contact_name'],
            'contact_phone' => $data['contact_phone'],
            'contact_email' => $data['contact_email'],
        ]);

        return $company;
    }

    /**
     * Delete a Company.
     *
     * @param Company $company
     * @return Company
     */
    public function deleteCompany(Company $company): Company
    {
        $company->delete();

        return $company;
    }
}
