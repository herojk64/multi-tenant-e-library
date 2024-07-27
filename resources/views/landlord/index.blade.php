<x-app-layout>
{{--    @dd(resource_path('/images/landlord_home_image_1.png'));--}}
<main>
    <x-landlord.content_wrapper :overlay="true" class="flex flex-col items-center justify-center text-center space-y-6 px-4 lg:px-44" :bg="asset('storage/landlord_home_image_1.png')">
        <header class="font-libre" style="font-size: 3rem">
            <div>
            Empower Reading
            </div>
            <div>
            Inspire Minds
            </div>
        </header>
        <p class="font-extralight italic opacity-75">
            A website by {{config('app.author')}}
        </p>
        <p class="">
            Novelsby is your key to unlocking the full potential of eLibrary administration for your community. You can acquire and customize domains to provide a more personalized reading experience. With Novelsby, you'll give your users access to a wide range of books, personalized reading trips, and flexible subscription rates. Our user-friendly administrative tools allow you to quickly manage books, users, and subscriptions. Invest in a Novelsby domain today, and give your tenants the knowledge and inspiration they deserve. 
        </p>
    </x-landlord.content_wrapper>
    <div style="min-height: 10svh" class="text-light-1 text-center py-12">
        <div class="font-libre" style="font-size: 4rem">Content</div>
    </div>
    <x-landlord.content_wrapper id="about_us" :overlay="true" class="flex flex-col items-center justify-center text-center space-y-6 px-4 lg:px-44" :bg="asset('storage/landlord_home_image_2.jpg')">
        <header class="font-libre" style="font-size: 3rem">
              About Us
        </header>
        <p class="font-extralight italic opacity-75">
            A website by {{config('app.author')}}
        </p>
        <p class="">
            Novelsby is your key to unlocking the full potential of eLibrary administration for your community. You can acquire and customize domains to provide a more personalized reading experience. With Novelsby, you'll give your users access to a wide range of books, personalized reading trips, and flexible subscription rates. Our user-friendly administrative tools allow you to quickly manage books, users, and subscriptions. Invest in a Novelsby domain today, and give your tenants the knowledge and inspiration they deserve. 
        </p>
    </x-landlord.content_wrapper>
</main>
</x-app-layout>
