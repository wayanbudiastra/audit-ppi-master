@extends('layouts.main')
@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container px-6 mx-auto grid mt-2">
            <!-- CTA -->
            <form action="{{ route('apd.lanjut') }}" method="POST">
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
                                            <label htmlFor="observer1" class="block text-sm font-medium text-gray-700">
                                                {{ $data->nama_auditor }}
                                            </label>
                                        </div>
                                        <div class="col-span-6">
                                            <label htmlFor="tanggal_observasi"
                                                class="block text-sm font-medium text-gray-700">
                                                Auditor
                                            </label>
                                            <label htmlFor="tanggal_observasi"
                                                class="block text-sm font-medium text-gray-700">
                                                {{ $data->auditor }}
                                            </label>
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label htmlFor="lantai" class="block text-sm font-medium text-gray-700">
                                                Ruangan
                                            </label>
                                            <label htmlFor="lantai" class="block text-sm font-medium text-gray-700">
                                                {{ $data->ruangan->nama_ruangan }}
                                            </label>
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label htmlFor="periode" class="block text-sm font-medium text-gray-700">
                                                Periode
                                            </label>
                                            <label htmlFor="periode" class="block text-sm font-medium text-gray-700">
                                                {{ $data->periode->nama_periode }}
                                            </label>
                                        </div>
                                        <div class="col-span-6">
                                            <table class="w-full whitespace-no-wrap">
                                                <thead>
                                                    <tr
                                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                                        <th class="px-4 py-3">No</th>
                                                        <th class="px-4 py-3">Nama Petugas</th>
                                                        <th class="px-4 py-3">Masker</th>
                                                        <th class="px-4 py-3">Handschoen</th>
                                                        <th class="px-4 py-3">Apron</th>
                                                        <th class="px-4 py-3">Haircap</th>
                                                        <th class="px-4 py-3">Google</th>
                                                        <th class="px-4 py-3">Glow</th>
                                                        <th class="px-4 py-3">Keterangan</th>
                                                        <th class="px-4 py-3">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                                    @foreach ($data_detail as $item)
                                                        <tr class="text-gray-700 dark:text-gray-400">
                                                            <td class="px-4 py-2">
                                                                <div class="flex items-center text-sm">
                                                                    {{ $no = $no + 1 }}
                                                                </div>
                                                            </td>
                                                            <td class="px-4 py-3">
                                                                <div class="flex items-center text-sm">
                                                                    {{ $item->nama_petugas }}
                                                                </div>
                                                            </td>
                                                            <td class="px-4 py-3 text-sm">
                                                                {{ $item->masker }}
                                                            </td>
                                                            <td class="px-4 py-3 text-sm">
                                                                {{ $item->handschoen }}
                                                            </td>
                                                            <td class="px-4 py-3 text-xs">
                                                                {{ $item->apron }}
                                                            </td>

                                                            <td class="px-4 py-3 text-sm">
                                                                {{ $item->haircap }}
                                                            </td>
                                                            <td class="px-4 py-3 text-sm">
                                                                {{ $item->google }}
                                                            </td>
                                                            <td class="px-4 py-3 text-sm">
                                                                {{ $item->glow }}
                                                            </td>
                                                            <td class="px-4 py-3 text-sm">
                                                                {{ $item->keterangan }}
                                                            </td>
                                                            <td class="px-4 py-3 text-sm">
                                                                <div class="inline-flex">

                                                                    <a href="{{ route('apd.lanjut.input', $data->id) }}"
                                                                        class="ml-2 rounded px-2 py-2 text-xs bg-green-500 text-green-100 hover:bg-green-600 duration-300">
                                                                        Lanjutkan
                                                                    </a>

                                                                    <a href="{{ route('apd.lanjut.detail', $item->id) }}"
                                                                        class="ml-2 rounded px-2 py-2 text-xs bg-red-500 text-red-100 hover:bg-red-600 duration-300">
                                                                        Hapus
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-span-6">
                                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                                <input type="hidden" value="{{ $data->id }}" name="apd_id">
                                                <a href="{{ route('apd.list') }}"
                                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-400 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                    Kembali
                                                </a>
                                                <a href="{{ route('apd.lanjut.input', $data->id) }}"
                                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-400 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                    Lanjutkan
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
