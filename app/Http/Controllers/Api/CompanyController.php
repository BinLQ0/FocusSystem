<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $company = Company::query();

        // Get Supplier Query
        $company = $company->when(request('isSupplier', false), function ($q) {
            return $q->where('is_supplier', 1);
        });

        // Get Supplier Query
        $company = $company->when(request('isCustomer', false), function ($q) {
            return $q->where('is_customer', 1);
        });

        return $company->orderBy('name')->get();
    }
}
