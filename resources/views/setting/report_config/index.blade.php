@extends('layouts.main')
@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container mx-auto mt-5 ml-5">
            <a href="{{ route('home') }}"
                class="inline-flex justify-center py-2 px-3 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-400 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                kembali
            </a>
        </div>
        <div class="container px-6 mx-auto grid mt-2">
            <!-- CTA -->
            <div class="box-border md:box-content bg-white h-400 w-300 p-4 border-4 rounded-lg">
                <!-- ... -->
                <h4 class="text-black"> Data Setting Report</h4>
                @if (session()->has('success'))
                    <div class="flex p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                        role="alert">
                        <svg class="inline flex-shrink-0 mr-3 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <span class="font-medium">Success</span> {{ session('success') }}
                        </div>
                    </div>
                @endif
                <form action="{{ $aksi }}" method="POST">
                    {{ csrf_field() }}
                    <div class="mb-6 mt-5">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            HH Rekap Per-Moment</label>
                        <select id="hh_rekap_permoment" name="hh_rekap_permoment"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                            @foreach ($tahun as $th)
                                @php
                                    $selected = ' ';
                                    if ($th->id == $hh_rekap_permoment) {
                                        $selected = 'selected';
                                    }
                                @endphp
                                <option value="{{ $th->id }}" {{ $selected }}>{{ $th->nama_tahun }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-6 mt-5">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            HH Rekap Per-Ruangan</label>
                        <select id="hh_rekap_perruangan" name="hh_rekap_perruangan"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                            @foreach ($tahun as $th)
                                @php
                                    $selected = ' ';
                                    if ($th->id == $hh_rekap_perruangan) {
                                        $selected = 'selected';
                                    }
                                @endphp
                                <option value="{{ $th->id }}" {{ $selected }}>{{ $th->nama_tahun }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-6 mt-5">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            HH Rekap Per-Periode</label>
                        <select id="hh_rekap_perperiode" name="hh_rekap_perperiode"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                            @foreach ($tahun as $th)
                                @php
                                    $selected = ' ';
                                    if ($th->id == $hh_rekap_perperiode) {
                                        $selected = 'selected';
                                    }
                                @endphp
                                <option value="{{ $th->id }}" {{ $selected }}>{{ $th->nama_tahun }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="id" value="1">
                    <button type="submit"
                        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Submit</button>
                </form>

            </div>

        </div>
    </main>
@endsection
