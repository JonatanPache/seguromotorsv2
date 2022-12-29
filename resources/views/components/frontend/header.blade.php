<header>

    <nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5
        rounded dark:bg-gray-900">
        <div class="container flex flex-wrap items-center justify-between mx-auto">
            <a href="{{ route('welcome') }}" class="flex items-center">
                <img src="/img/logo.webp" class="mr-2 h-8 sm:h-24" alt="SeguroMotors Logo" id="logo"/>
                <span class="self-center text-xl font-semibold whitespace-nowrap
                    dark:text-white">SeguroMotors</span>
            </a>
            <div class="flex items-center md:order-2 dropdown relative">

                @auth
                <button class="dropdown-toggle inline-block px-6 py-2.5 bg-purple-600
                    text-white font-medium text-xs leading-tight uppercase rounded
                    shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700
                    focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800
                    active:shadow-lg active:text-white transition duration-150 ease-in-out
                    flex items-center whitespace-nowrap" type="button" id="dropdownMenuButton2"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="w-8 h-8 rounded-full" src="/img/condor-logo-header.jpg" alt="user photo">

                </button>
                <ul class="dropdown-menu min-w-max absolute hidden bg-white text-base z-50
                float-left py-2 list-none text-left rounded-lg shadow-lg mt-1 hidden m-0
                bg-clip-padding border-none bg-gray-800"
                    aria-labelledby="dropdownMenuButton2">
                    <h6
                        class="text-gray-400 font-semibold text-sm py-2 px-4 block w-full
                        whitespace-nowrap bg-transparent">
                        {{ auth()->user()->name}}
                    </h6>
                    <!--
                    <span
                        class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap
                        bg-transparent text-gray-300">Notificaciones</span>
                    -->
                        <li>
                        <a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-300 hover:bg-gray-700 hover:text-white focus:text-white focus:bg-gray-700 active:bg-blue-600"
                            href="{{ route('notifications') }}">Notificaciones</a>
                    </li>
                    <li>
                        <a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-300 hover:bg-gray-700 hover:text-white focus:text-white focus:bg-gray-700"
                            href="{{ route('notifications') }}">Salir</a>
                    </li>

                </ul>
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
                        <a href="{{ route('pagos') }}" class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100
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



    </nav>

</header>
