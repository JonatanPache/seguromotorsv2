<header>

    <nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5
        rounded dark:bg-gray-900">
        <div class="container flex flex-wrap items-center justify-between mx-auto">
            <a href="#" class="flex items-center">
                <img src="/img/logo.webp" class="mr-2 h-8 sm:h-24" alt="Flowbite Logo" />
                <span class="self-center text-xl font-semibold whitespace-nowrap
                    dark:text-white">SeguroMotors</span>
            </a>
            <div class="flex items-center md:order-2">

                @auth
                <button type="button" class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4
                    focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false"
                    data-dropdown-toggle="user-id" data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full" src="/img/condor-logo-header.jpg" alt="user photo">
                </button>
                @else
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div>
                        <a href="{{ route('login') }}" class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100
                            md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-gray-400
                            md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white
                            md:dark:hover:bg-transparent dark:border-gray-700">Login</a>
                    </div>
                </form>
                @endauth

                <!-- Dropdown menu -->
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y
                    divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="user-id">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900 dark:text-white">Bonnie Green</span>
                        <span
                            class="block text-sm font-medium text-gray-500 truncate dark:text-gray-400">name@flowbite.com</span>
                    </div>
                    <ul class="py-1" aria-labelledby="user-menu-button">
                        <li>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100
                                dark:hover:bg-gray-600 dark:text-gray-200
                                dark:hover:text-white">Dashboard</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100
                                dark:hover:bg-gray-600 dark:text-gray-200
                                dark:hover:text-white">Settings</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100
                                dark:hover:bg-gray-600 dark:text-gray-200
                                dark:hover:text-white">Earnings</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100
                                dark:hover:bg-gray-600 dark:text-gray-200
                                dark:hover:text-white">Sign
                                out</a>
                        </li>
                    </ul>
                </div>

                <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg
                        md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2
                        focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700
                        dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="mobile-menu-2">
                <ul class="flex flex-col p-4 mt-4 border border-gray-100 rounded-lg bg-gray-50
                        md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0
                        md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="#" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded
                            md:bg-transparent md:text-blue-700 md:p-0 dark:text-white" aria-current="page">Home</a>
                    </li>
                    <li>
                        <button id="mega-menu-full-dropdown-button" class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100
                            md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-gray-400
                            md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white
                            md:dark:hover:bg-transparent dark:border-gray-700"
                            data-collapse-toggle="mega-menu-full-dropdown">Personales
                        </button>
                    </li>
                    <li>
                        <a href="#" class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100
                            md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-gray-400
                            md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white
                            md:dark:hover:bg-transparent dark:border-gray-700">Paga Tu Seguro</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100
                            md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-gray-400
                            md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white
                            md:dark:hover:bg-transparent dark:border-gray-700">Solicita un Servicio</a>
                    </li>

                </ul>
            </div>
        </div>

        <div id="mega-menu-full-dropdown"
            class="mt-1 border-gray-200 shadow-sm bg-gray-50 md:bg-white border-y dark:bg-gray-800 dark:border-gray-600">
            <div class="grid max-w-screen-xl px-4 py-5 mx-auto text-gray-900 dark:text-white sm:grid-cols-2 md:px-6">
                <ul>
                    <li>
                        <a href="#" class="block p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                            <div class="font-semibold">Online Stores</div>
                            <span class="text-sm font-light text-gray-500 dark:text-gray-400">Connect with third-party
                                tools that you're already using.</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                            <div class="font-semibold">Segmentation</div>
                            <span class="text-sm font-light text-gray-500 dark:text-gray-400">Connect with third-party
                                tools that you're already using.</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                            <div class="font-semibold">Marketing CRM</div>
                            <span class="text-sm font-light text-gray-500 dark:text-gray-400">Connect with third-party
                                tools that you're already using.</span>
                        </a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="#" class="block p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                            <div class="font-semibold">Online Stores</div>
                            <span class="text-sm font-light text-gray-500 dark:text-gray-400">Connect with third-party
                                tools that you're already using.</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                            <div class="font-semibold">Segmentation</div>
                            <span class="text-sm font-light text-gray-500 dark:text-gray-400">Connect with third-party
                                tools that you're already using.</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                            <div class="font-semibold">Marketing CRM</div>
                            <span class="text-sm font-light text-gray-500 dark:text-gray-400">Connect with third-party
                                tools that you're already using.</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </nav>

</header>