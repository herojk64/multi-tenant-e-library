<x-tenant-app-layout>
    <div id="pspdfkit-container" data-url="{{ $url }}" style="width: 100%;"></div>
@can('view-content', $book)
        @if($url)
            @push('js')
                <script src="https://unpkg.com/pspdfkit@latest/dist/pspdfkit.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const container = document.getElementById('pspdfkit-container');
                        const url = container.dataset.url;

                        // Set the base URL for PSPDFKit assets if needed
                        const baseUrl = `${window.location.protocol}//${window.location.host}/assets/`;

                        PSPDFKit.load({
                            container: container,
                            document: url,
                            baseUrl: baseUrl
                        }).then(function (instance) {
                            // Customize toolbar and view state
                            instance.setViewState((state) => {
                                return state
                                    .set("allowPrinting", false)    // Disable printing
                                    .set("allowDownloading", false) // Disable downloading
                                    .set("allowAnnotations", false) // Disable annotations
                                    .set("allowSharing", false);    // Disable sharing
                            });

                            // Customize toolbar to include only essential items
                            const toolbarItems = PSPDFKit.defaultToolbarItems;

                            // Keep only page navigation, zoom, fit page, and thumbnail items
                            const essentialToolbarItems = toolbarItems.filter(item =>
                                ["pager", "zoom-in", "zoom-out", "fit", "thumbnails", "pan"].includes(item.type)
                            );

                            instance.setToolbarItems(essentialToolbarItems);

                        }).catch(function (error) {
                            console.error('Error loading PSPDFKit', error);
                        });
                    });
                </script>
            @endpush
        @endif
    @endcan

</x-tenant-app-layout>
