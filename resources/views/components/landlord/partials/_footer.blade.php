<footer class="py-4 space-y-5 border-t-2 px-6 mt-4 bg-white">
    <section class="flex flex-wrap flex-col gap-5 md:gap-0 md:flex-row justify-between items-stretch ">
        <article>
            <header class="mb-3 text-xl font-bold text-gray-500">{{config('app.name')}}</header>
            <p class="text-gray-500">A platform for E-Library Services</p>
        </article>
        <nav>
            <header class="mb-3 text-xl font-bold text-gray-500">Quick Links</header>
            <ul>
                <li class="w-full">
                    <a href="{{route('landlord.home')}}" class="py-3 block md:text-center text-gray-500 active:text-gray-800 hover:text-gray-800 underline">
                        Home
                    </a>
                </li>
                <li class="w-full">
                    <a href="{{route('landlord.services')}}" class="py-3 block md:text-center text-gray-500 active:text-gray-800 hover:text-gray-800 underline">
                        Services
                    </a>
                </li>
                <li class="w-full">
                    <a href="{{route('landlord.about')}}" class="py-3 block md:text-center text-gray-500 active:text-gray-800 hover:text-gray-800 underline">
                        About Us
                    </a>
                </li>
            </ul>
        </nav>
        <div>
            <header class="mb-3 text-xl font-bold text-gray-500">Support</header>
            <ul>
                <li class="w-full">
                    <a href="mailto:herojk64@gmail.com" class="py-3 block text-gray-500 hover:text-gray-800 underline">
                        Email Support
                    </a>
                </li>
                <li class="w-full">
                    <a href="tel:+9779801109082" class="py-3 block text-gray-500 hover:text-gray-800 underline">
                        Call Us: +977 9801109082
                    </a>
                </li>

            </ul>
        </div>
        <div class="">
            <header class="mb-3 text-xl font-bold text-gray-500">Follow Us</header>
            <div class="flex gap-3 justify-between">
                <a href="https://www.facebook.com/herojk66" target="_blank"><x-css-facebook class="h-10 w-10 border rounded"/></a>
                <a href="https://github.com/herojk64" target="_blank"><x-eva-github-outline class="h-10 w-10 border rounded"/></a>
                <a href="https://www.instagram.com/herojk65/" target="_blank"><x-css-instagram class="h-10 w-10 border rounded"/></a>
                <a href="https://www.upwork.com/freelancers/~01d362a701e1fc7717?mp_source=share" target="_blank"><x-fab-upwork class="h-10 w-10 border rounded"/></a>
            </div>
        </div>
    </section>
    <p class="border-t border-t-gray-300  w-11/12 mx-auto text-sm italic text-gray-400">
        &copy; {{config('app.name')}} | {{now()->format('Y')}}
    </p>
</footer>
