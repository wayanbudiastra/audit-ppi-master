@extends('layouts.main')
@section('content')
    <main class="w-full pb-16 overflow-y-auto">
        <div class="container px-6 mx-auto grid mt-2">
            <!-- CTA -->
            <form action="{{ route('apd') }}" method="POST">
                {{ csrf_field() }}
                @if (session()->has('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline"> {{ session('success') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <title>Close</title>
                                <path
                                    d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                            </svg>
                        </span>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline"> {{ session('error') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <title>Close</title>
                                <path
                                    d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                            </svg>
                        </span>
                    </div>
                @endif

                <div class="mt-10 sm:mt-0">
                    <div class="md:grid md:grid-cols-1 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-6 sm:px-0  justify-between text-center">
                                <h3 class="text-lg font-medium leading-8 text-gray-900">
                                    Form Audit Penggunaan APD
                                </h3>
                            </div>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6">
                                            <label htmlFor="observer1" class="block text-sm font-medium text-gray-700">
                                                Nama Auditor
                                            </label>
                                            <input type="text" name="nama_auditor" id="nama_auditor"
                                                value="{{ old('nama_auditor') }}"
                                                class="mt-1 focus:ring-green-500 focus:border-green-500 block border-gray-300 w-full shadow-sm sm:text-sm  rounded-md @error('nama_auditor') border-red-500 @enderror" />
                                            @error('nama_auditor')
                                                <div class=" text-red-500 mt-2 rounded-sm relative text-sm" role="alert">
                                                    <span class="block sm:inline">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-span-6">
                                            <label htmlFor="auditor" class="block text-sm font-medium text-gray-700">
                                                Keterangan
                                            </label>
                                            <input type="text" name="auditor" id="auditor" value="{{ old('auditor') }}"
                                                class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md  @error('auditor') border-red-500 @enderror" />
                                            @error('auditor')
                                                <div class=" text-red-500 mt-2 rounded-sm relative text-sm" role="alert">
                                                    <span class="block sm:inline">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label htmlFor="ruangan" class="block text-sm font-medium text-gray-700">
                                                Ruangan
                                            </label>
                                            <select id="ruangan_id" name="ruangan_id" autoComplete="ruangan_id"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm  @error('periode') border-red-500 @enderror">
                                                @foreach ($ruangan as $data)
                                                    <option value={{ $data->id }}>
                                                        {{ $data->nama_ruangan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('ruangan_id')
                                                <div class=" text-red-500 mt-2 rounded-sm relative text-sm" role="alert">
                                                    <span class="block sm:inline">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>


                                        <div class="col-span-6 sm:col-span-3">
                                            <label htmlFor="periode" class="block text-sm font-medium text-gray-700">
                                                Periode
                                            </label>
                                            <select id="periode" name="periode" autoComplete="periode"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm  @error('periode') border-red-500 @enderror">
                                                @foreach ($period as $data)
                                                    <option value={{ $data->id }}>
                                                        {{ $data->nama_periode }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('periode')
                                                <div class=" text-red-500 mt-2 rounded-sm relative text-sm" role="alert">
                                                    <span class="block sm:inline">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                        <a href="{{ route('handhygiene.list') }}"
                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-400 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            Kembali
                                        </a>
                                        <button type="submit"
                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-400 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                            Lanjutkan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

            </form>

        </div>
    </main>
@endsection
