<header
    x-data="{ open:false }"
    class="bg-white shadow-sm h-20 flex items-center justify-between px-8">

    <div>

        <h1 class="text-3xl font-bold text-gray-800">

            Dashboard

        </h1>

        <p class="text-gray-500">

            Selamat Datang,
            <span class="font-semibold">

                {{ Auth::user()->name }}

            </span>

        </p>

    </div>


    <div class="flex items-center gap-6">

        <!-- Notifikasi -->

        <button
            class="relative text-2xl hover:text-red-700 transition">

            🔔

            <span
                class="absolute -top-1 -right-1 w-3 h-3 rounded-full bg-red-600">

            </span>

        </button>


        <!-- Profile -->

        <div class="relative">

            <button
                @click="open=!open"
                class="flex items-center gap-4">

                <div class="text-right">

                    <h3 class="font-semibold">

                        {{ Auth::user()->name }}

                    </h3>

                    <p class="text-sm text-gray-500 capitalize">

                        {{ Auth::user()->role }}

                    </p>

                </div>

                <div
                    class="w-12 h-12 rounded-full bg-red-700 text-white flex items-center justify-center font-bold text-lg">

                    {{ strtoupper(substr(Auth::user()->name,0,1)) }}

                </div>

            </button>


            <!-- Dropdown -->

            <div
                x-show="open"
                @click.away="open=false"
                x-transition
                class="absolute right-0 mt-4 w-56 rounded-xl bg-white shadow-xl border overflow-hidden">

                <a
                    href="#"
                    class="block px-5 py-3 hover:bg-gray-100">

                    👤 Profil

                </a>

                <a
                    href="#"
                    class="block px-5 py-3 hover:bg-gray-100">

                    ⚙ Pengaturan

                </a>

                <hr>

                <form action="{{ route('logout') }}" method="POST">

                    @csrf

                    <button
                        class="w-full text-left px-5 py-3 hover:bg-red-700 hover:text-white transition">

                        🚪 Logout

                    </button>

                </form>

            </div>

        </div>

    </div>

</header>