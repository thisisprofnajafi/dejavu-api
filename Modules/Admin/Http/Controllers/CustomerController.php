<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Admin\Models\Customer;
use Modules\Admin\Services\CustomerService;

class CustomerController extends Controller
{
    protected $customerService;

    /**
     * Create a new controller instance.
     *
     * @param CustomerService $customerService
     */
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * Display a listing of customers.
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $customers = $this->customerService->getCustomers($request);
        
        return response()->json([
            'success' => true,
            'data' => $customers
        ]);
    }
    
    /**
     * Store a newly created customer.
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'status' => 'nullable|string|in:active,inactive',
            'notes' => 'nullable|string',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        
        $customer = $this->customerService->createCustomer($request->all());
        
        return response()->json([
            'success' => true,
            'message' => 'Customer created successfully',
            'data' => $customer
        ], 201);
    }
    
    /**
     * Display the specified customer.
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $customer = $this->customerService->getCustomerById($id);
        
        return response()->json([
            'success' => true,
            'data' => $customer
        ]);
    }
    
    /**
     * Update the specified customer.
     * 
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $customer = $this->customerService->getCustomerById($id);
        
        $validator = Validator::make($request->all(), [
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:customers,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'status' => 'nullable|string|in:active,inactive',
            'notes' => 'nullable|string',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        
        $customer = $this->customerService->updateCustomer($customer, $request->all());
        
        return response()->json([
            'success' => true,
            'message' => 'Customer updated successfully',
            'data' => $customer
        ]);
    }
    
    /**
     * Remove the specified customer.
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $customer = $this->customerService->getCustomerById($id);
        $this->customerService->deleteCustomer($customer);
        
        return response()->json([
            'success' => true,
            'message' => 'Customer deleted successfully'
        ]);
    }
} 