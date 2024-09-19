<x-landlord-app-layout>
    <div class="grid grid-cols-[auto_1fr] gap-4 mx-2">

        <!-- Sidebar -->
        <x-landlord.partials._sidenavbar class="border-r border-gray-200" />

        <!-- Main Content -->
        <main class="p-6 bg-white rounded-lg shadow-md overflow-x-auto space-y-8">
            <div class="border border-gray-200 bg-gray-50 p-6 rounded-xl shadow-sm">
                <h2 class="text-xl font-semibold mb-4">Tenant Details</h2>

                <div class="space-y-3">
                    <p class="text-gray-700">
                        <span class="font-medium">Name:</span> {{$tenant->name}}
                    </p>
                    <p class="text-gray-700">
                        <span class="font-medium">Domain:</span>
                        <a href="http://{{$tenant->domain}}" target="_blank" class="text-blue-600 hover:text-blue-800">
                            {{$tenant->domain}}
                        </a>
                    </p>
                    <p class="text-gray-700">
                        <span class="font-medium">Status:</span>
                        <span class="font-medium {{ $tenant->status == 'Active' ? 'text-green-600' : ($tenant->status == 'Inactive' ? 'text-yellow-600' : 'text-red-600') }}">
                            {{$tenant->status}}
                        </span>
                    </p>
                </div>
            </div>

            <!-- Livewire Table Component -->
            <div class="bg-white rounded-lg shadow-md">
                <div class="overflow-x-auto max-w-full">
                    <livewire:landlord.tables.service-sub-table :tenantId="$tenant->id"/>
                </div>
            </div>
        </main>
    </div>
</x-landlord-app-layout>
