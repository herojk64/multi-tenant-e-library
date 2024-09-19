<x-landlord-app-layout>
    <main class="grid grid-cols-[auto_1fr] gap-2 mx-2">
        <x-landlord.partials._sidenavbar/>

        <!-- Main Content -->
        <div class="overflow-x-auto bg-white p-6 space-y-8">
            <div class="border border-orange-300 bg-orange-200 p-4 rounded-xl text-orange-800" aria-label="notice">
                <header class="text-xl font-bold mb-3">Notice:</header>
                <ul class="space-y-5">
                    <li>If your service is inactive for a long time please contact admin for activation.</li>
                    <li>If your service has expired. You can re-active by purchasing service again</li>
                </ul>
            </div>
            <livewire:landlord.tables.service-table/>
        </div>
    </main>
</x-landlord-app-layout>
