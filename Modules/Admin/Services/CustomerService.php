<?php

namespace Modules\Admin\Services;

use Illuminate\Http\Request;
use Modules\Admin\Models\Customer;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomerService
{
    /**
     * Get a filtered, sorted, and paginated list of customers
     *
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getCustomers(Request $request): LengthAwarePaginator
    {
        $query = Customer::query();
        
        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        // Search by name, email or phone
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }
        
        // Order
        $orderBy = $request->order_by ?? 'created_at';
        $orderDir = $request->order_dir ?? 'desc';
        $query->orderBy($orderBy, $orderDir);
        
        // Pagination
        $perPage = $request->per_page ?? 15;
        return $query->paginate($perPage);
    }
    
    /**
     * Create a new customer with the provided attributes
     *
     * @param array $attributes
     * @return Customer
     */
    public function createCustomer(array $attributes): Customer
    {
        return DB::transaction(function () use ($attributes) {
            return Customer::create($attributes);
        });
    }
    
    /**
     * Get a customer by ID
     *
     * @param int $id
     * @return Customer
     */
    public function getCustomerById(int $id): Customer
    {
        return Customer::findOrFail($id);
    }
    
    /**
     * Update a customer with the provided attributes
     *
     * @param Customer $customer
     * @param array $attributes
     * @return Customer
     */
    public function updateCustomer(Customer $customer, array $attributes): Customer
    {
        return DB::transaction(function () use ($customer, $attributes) {
            $customer->update($attributes);
            return $customer->fresh();
        });
    }
    
    /**
     * Delete a customer
     *
     * @param Customer $customer
     * @return bool
     */
    public function deleteCustomer(Customer $customer): bool
    {
        return DB::transaction(function () use ($customer) {
            return $customer->delete();
        });
    }
} 