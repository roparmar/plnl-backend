<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TenantResource;
use App\Http\Resources\TenantCollection;
use App\Models\Tenant;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ApiResponse;

    // TODO: Add authentication middleware for production use

    public function index(): JsonResponse
    {
        $tenants = Tenant::with('domains')->get();
        
        return $this->successResponse(
            new TenantCollection($tenants),
            'Tenants retrieved successfully'
        );
    }

     /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id' => 'required|string|unique:tenants',
            'name' => 'required|string|max:255',
            'domain' => 'required|string|unique:domains,domain'
        ]);

        $tenant = Tenant::create(['id' => $validated['id']]);
        $tenant->domains()->create(['domain' => $validated['domain']]);
        $tenant->update(['name' => $validated['name']]);

        return $this->successResponse(
            new TenantResource($tenant->load('domains')),
            'Tenant created successfully',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant): JsonResponse
    {
        return $this->successResponse(
            new TenantResource($tenant->load('domains')),
            'Tenant retrieved successfully'
        );
    }

     /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'domain' => 'sometimes|string|unique:domains,domain,' . $tenant->domains->first()?->id
        ]);

        if (isset($validated['name'])) {
            $tenant->update(['name' => $validated['name']]);
        }

        if (isset($validated['domain']) && $tenant->domains->first()) {
            $tenant->domains->first()->update(['domain' => $validated['domain']]);
        }

        return $this->successResponse(
            new TenantResource($tenant->load('domains')),
            'Tenant updated successfully'
        );
    }

      /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant): JsonResponse
    {
        $tenant->delete();

        return $this->successResponse(
            null,
            'Tenant deleted successfully'
        );
    }
}
