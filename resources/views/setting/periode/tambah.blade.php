@extends('layouts.main')
@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container mx-auto mt-5 ml-5">
            <a href="{{ url('periode') }}"
                class="inline-flex justify-center py-2 px-3 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-400 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                kembali
            </a>
        </div>
        <div class="container px-6 mx-auto grid mt-2">
            <!-- CTA -->
            <div class="box-border md:box-content bg-white h-400 w-300 p-4 border-4 rounded-lg">
                <!-- ... -->
                <h4 class="text-black"> Data Periode</h4>
                <form action="{{ $aksi }}" method="POST">
                    {{ csrf_field() }}
                    <div class="mb-6 mt-5">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Nama Periode</label>
                        <input type="text" id="email" name="nama_periode" value="{{ $nama_periode }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                            placeholder="periode">
                    </div>
                    <div class="mb-6 mt-5">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Index Bulan</label>
                        <input type="text" id="email" name="index_bulan" value="{{ $index_bulan }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                            placeholder="periode">
                    </div>
                    <div class="mb-6 mt-5">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Tahun</label>
                        <select id="tahun_id" name="tahun_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                            @foreach ($tahun as $th)
                                @php
                                    $selected = ' ';
                                    if ($th->id == $tahun_id) {
                                        $selected = 'selected';
                                    }
                                @endphp
                                <option value="{{ $th->id }}" {{ $selected }}>{{ $th->nama_tahun }}</option>
                            @endforeach
                        </select>
                    </div>

                    @if ($mode == 'edit')
                        @php
                            if ($aktif == 'Y') {
                                $cek1 = 'checked';
                                $cek2 = '';
                            } else {
                                $cek1 = '';
                                $cek2 = 'checked';
                            }
                            
                        @endphp
                        <fieldset>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                Aktifasi</label>
                            <div class="flex items-center mb-4">
                                <input id="country-option-1" type="radio" name="aktif" value="Y"
                                    class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600"
                                    aria-labelledby="country-option-1" aria-describedby="country-option-1"
                                    {{ $cek1 }}>
                                <label for="country-option-1"
                                    class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    Ya
                                </label>
                            </div>

                            <div class="flex items-center mb-4">
                                <input id="country-option-2" type="radio" name="aktif" value="N"
                                    class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600"
                                    aria-labelledby="country-option-2" aria-describedby="country-option-2"
                                    {{ $cek2 }}>
                                <label for="country-option-2"
                                    class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    Tidak
                                </label>
                            </div>
                        </fieldset>
                        <input type="hidden" name="id" value="{{ $id }}">
                    @endif

                    <button type="submit"
                        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Submit</button>
                </form>

            </div>

        </div>
    </main>
@endsection
