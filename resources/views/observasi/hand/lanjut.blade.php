@extends('layouts.main')
@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container px-6 mx-auto grid mt-2">
            <!-- CTA -->
            <form action="{{ route('handhygiene.lanjut') }}" method="POST">
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
                                    Form Observasi Hand Hygiene
                                </h3>
                            </div>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6">
                                            <label htmlFor="observer1" class="block text-sm font-medium text-gray-700">
                                                Observer
                                            </label>
                                            <label htmlFor="observer1" class="block text-sm font-medium text-gray-700">
                                                {{ $data->observer }}
                                            </label>

                                        </div>
                                        <div class="col-span-6">
                                            <label htmlFor="tanggal_observasi"
                                                class="block text-sm font-medium text-gray-700">
                                                Tanggal Observasi
                                            </label>
                                            <label htmlFor="tanggal_observasi"
                                                class="block text-sm font-medium text-gray-700">
                                                {{ $data->tanggal_observasi }}
                                            </label>

                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label htmlFor="lantai" class="block text-sm font-medium text-gray-700">
                                                Lantai
                                            </label>
                                            <label htmlFor="lantai" class="block text-sm font-medium text-gray-700">
                                                {{ $data->lantai }}
                                            </label>

                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label htmlFor="ruangan" class="block text-sm font-medium text-gray-700">
                                                Ruangan
                                            </label>
                                            <label htmlFor="ruangan" class="block text-sm font-medium text-gray-700">
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
                                            <label htmlFor="street-address" class="block text-sm font-medium text-gray-700">
                                                Profesi
                                            </label>
                                            <label htmlFor="street-address" class="block text-sm font-medium text-gray-700">
                                                {{ $data->profesi->nama_profesi }}
                                            </label>

                                        </div>

                                        <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                            <label htmlFor="waktu_start" class="block text-sm font-medium text-gray-700">
                                                Waktu Mulai
                                            </label>
                                            <label htmlFor="waktu_start" class="block text-sm font-medium text-gray-700">
                                                {{ $data->waktu_start }}
                                            </label>

                                        </div>

                                        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <label htmlFor="region" class="block text-sm font-medium text-gray-700">
                                                Waktu Selesai
                                            </label>
                                            <label htmlFor="waktu_start" class="block text-sm font-medium text-gray-700">
                                                {{ $data->waktu_start }}
                                            </label>
                                        </div>
                                        <div class="col-span-6">
                                            <h3 class="text-lg font-medium leading-6 text-gray-900">
                                                Opportunity = {{ $data_detail->opportunity + 1 }}
                                            </h3>
                                            <h3 class="text-lg font-medium leading-6 text-gray-900">
                                                Indication
                                            </h3>
                                             @error('indication')
                                                <div class=" text-red-500 mt-2 rounded-sm relative text-sm" role="alert">
                                                    <span class="block sm:inline">{{ $message }}</span>
                                                </div>
                                            @enderror
                                            <div class="flex items-center">
                                                <input id="push-everything" name="indication" type="radio" value="Bef-Pat"
                                                    class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300"  required/>
                                                <label htmlFor="push-everything"
                                                    class="ml-3 block text-sm font-medium text-gray-700">
                                                    Before Touching a Patient
                                                </label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="push-email" name="indication" type="radio" value="Bef-Asept"
                                                    class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300" />
                                                <label htmlFor="push-email"
                                                    class="ml-3 block text-sm font-medium text-gray-700">
                                                    Before Clean/Aseptic Procedure
                                                </label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="push-nothing" name="indication" type="radio" value="Aft-B.f"
                                                    class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300" />
                                                <label htmlFor="push-nothing"
                                                    class="ml-3 block text-sm font-medium text-gray-700">
                                                    After-Body fluid expore Risk
                                                </label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="push-nothing" name="indication" type="radio" value="Aft-Pat"
                                                    class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300" />
                                                <label htmlFor="push-nothing"
                                                    class="ml-3 block text-sm font-medium text-gray-700">
                                                    After Touching A Patient
                                                </label>
                                            </div>

                                            <div class="flex items-center">
                                                <input id="push-nothing" name="indication" type="radio" value="Aft-P.surr"
                                                    class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300" />
                                                <label htmlFor="push-nothing"
                                                    class="ml-3 block text-sm font-medium text-gray-700">
                                                    After Touching patien surroundings
                                                </label>
                                            </div>

                                        </div>

                                        <div class="col-span-6">
                                            <h3 class="text-lg font-medium leading-6 text-gray-900">
                                                Hand Hygiene Action
                                            </h3>
                                            <div class="mt-2 space-y-2">
                                                <div class="flex items-center">
                                                    <input id="push-everything" name="hh_action1" type="radio" value="hr"
                                                        class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300"/>
                                                    <label htmlFor="push-everything"
                                                        class="ml-3 block text-sm font-medium text-gray-700">
                                                        Handrub
                                                    </label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="push-email" name="hh_action1" type="radio" value="hw"
                                                        class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300" />
                                                    <label htmlFor="push-email"
                                                        class="ml-3 block text-sm font-medium text-gray-700">
                                                        Handwash
                                                    </label>
                                                </div>
                                                <hr>
                                                <div class="flex items-center">
                                                    <input id="push-nothing" name="hh_action1" type="radio" value="missed"
                                                        class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300" />
                                                    <label htmlFor="push-nothing"
                                                        class="ml-3 block text-sm font-medium text-gray-700">
                                                        Missed
                                                    </label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="push-nothing" name="hh_action2" type="radio" value="glove"
                                                        class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300" />
                                                    <label htmlFor="push-nothing"
                                                        class="ml-3 block text-sm font-medium text-gray-700">
                                                        Gloves
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                                <input type="hidden" value="{{ $data_detail->opportunity }}"
                                                    name="opportunity">
                                                <input type="hidden" value="{{ $data->id }}" name="hand_hygiene_id">
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
                            </div>
                        </div>
                    </div>
                </div>

            </form>

        </div>
    </main>
@endsection
