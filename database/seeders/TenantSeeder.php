<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = [
            ['id' => 'tenant1', 'name' => 'Tenant One', 'domain' => 'tenant1.localhost'],
            ['id' => 'tenant2', 'name' => 'Tenant Two', 'domain' => 'tenant2.localhost'],
        ];

        foreach ($tenants as $tenantData) {
            $tenant = Tenant::create(['id' => $tenantData['id']]);
            $tenant->domains()->create(['domain' => $tenantData['domain']]);
            $tenant->update(['name' => $tenantData['name']]);
        }
    }
}
