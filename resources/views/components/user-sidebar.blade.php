<aside class="w-72 bg-red-700 text-white flex flex-col justify-between min-h-screen">


    {{-- BAGIAN ATAS --}}
    <div>


        {{-- Logo --}}
        <div class="flex items-center gap-3 p-6 border-b border-red-600">


            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center">

                <span class="text-red-700 font-bold text-xl">
                    K
                </span>

            </div>


            <div>

                <h2 class="font-bold text-2xl">
                    SISMA KOPDES
                </h2>

                <p class="text-red-100 text-sm">
                    Desa Merah Putih
                </p>

            </div>


        </div>





        {{-- MENU --}}
        <div class="px-5 mt-6">


            <p class="text-xs uppercase text-red-200 mb-3">
                Menu
            </p>



            {{-- Dashboard --}}
            <a href="{{ route('user.dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-red-800 transition
                {{ request()->routeIs('user.dashboard') ? 'bg-red-900' : '' }}">

                🏠

                <span>
                    Dashboard
                </span>

            </a>


        </div>






        {{-- BELANJA --}}
        <div class="px-5 mt-8">


            <p class="text-xs uppercase text-red-200 mb-3">
                Belanja
            </p>



            {{-- Katalog --}}
            <a href="{{ route('user.katalog.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-red-800 transition
                {{ request()->routeIs('user.katalog.*') ? 'bg-red-900' : '' }}">


                🛍️


                <span>
                    Katalog Barang
                </span>


            </a>





            {{-- Keranjang --}}
            <a href="{{ route('user.keranjang.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl mt-2 hover:bg-red-800 transition
                {{ request()->routeIs('user.keranjang.*') ? 'bg-red-900' : '' }}">


                🛒


                <span>
                    Keranjang
                </span>


            </a>


        </div>







        {{-- TRANSAKSI --}}
        <div class="px-5 mt-8">


            <p class="text-xs uppercase text-red-200 mb-3">
                Transaksi
            </p>



            {{-- Riwayat --}}
            <a href="{{ route('user.riwayat.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-red-800 transition
                {{ request()->routeIs('user.riwayat.*') ? 'bg-red-900' : '' }}">


                📦


                <span>
                    Riwayat Pembelian
                </span>


            </a>


        </div>







        {{-- AKUN --}}
        <div class="px-5 mt-8">


            <p class="text-xs uppercase text-red-200 mb-3">
                Akun
            </p>




            {{-- Profil --}}
            <a href="{{ route('user.profile.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-red-800 transition
                {{ request()->routeIs('user.profile.*') ? 'bg-red-900' : '' }}">


                👤


                <span>
                    Profil Saya
                </span>


            </a>


        </div>



    </div>







    {{-- FOOTER USER --}}
    <div class="border-t border-red-600 p-5">


        <div class="mb-4">


            <p class="text-sm text-red-200">
                Login sebagai
            </p>



            <p class="font-bold">
                {{ Auth::user()->name }}
            </p>



            <p class="text-red-100 text-sm">
                User
            </p>


        </div>






        {{-- Logout --}}
        <form action="{{ route('logout') }}" method="POST">

            @csrf


            <button
                class="w-full bg-white text-red-700 font-semibold py-3 rounded-xl hover:bg-gray-100 transition">


                Logout


            </button>


        </form>


    </div>



</aside>