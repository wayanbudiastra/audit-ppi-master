@extends('layouts.main')
@section('content')
<main class="h-full pb-16 overflow-y-auto">
    <div class="container px-6 mx-auto grid mt-2">
        <!-- CTA -->
        <h1 class="mt-3 mb-3 flex justify-center text-lg font-semibold">Rekap HH Per-Profesi</h1>
        <div class="w-full overflow-hidden rounded-lg shadow-xs mt-2">
            <div class="w-full overflow-x-auto">

                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <form action="{{ url('report-hh-perprofesi-tahun') }}" method="POST">
                        {{ csrf_field() }}
                        <select name="tahun_id"
                            class="w-40 inline-flex justify-center border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                            @foreach ($period as $a)
                            @php
                            $selected = ' ';
                            if ($periode_id == $a->id) {
                            $selected = 'selected';
                            }
                            @endphp
                            <option value="{{ $a->id }}" {{ $selected }}>{{ $a->nama_tahun }}
                            </option>
                            @endforeach
                        </select>
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-400 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Cari
                        </button>
                        <a href="{{ url('report-handhygiene') }}"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-400 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Kembali
                        </a>
                    </form>
                </div>

                <table class="w-full whitespace-no-wrap mt-5">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">Nama Profesi</th>
                            <th class="px-4 py-3">Note</th>
                            <th class="px-4 py-3">Jan</th>
                            <th class="px-4 py-3">Feb</th>
                            <th class="px-4 py-3">Mar</th>
                            <th class="px-4 py-3">Apr</th>
                            <th class="px-4 py-3">Mei</th>
                            <th class="px-4 py-3">Juni</th>
                            <th class="px-4 py-3">Jul</th>
                            <th class="px-4 py-3">Agst</th>
                            <th class="px-4 py-3">Sep</th>
                            <th class="px-4 py-3">Okt</th>
                            <th class="px-4 py-3">Nov</th>
                            <th class="px-4 py-3">Des</th>
                            {{-- <th class="px-4 py-3">Teknik Benar</th> --}}
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($profesi as $item)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <th class="px-4 py-3" rowspan="3">
                                <div class="flex items-center text-sm">
                                    {{ $no = $no + 1 }}
                                </div>
                            </th>
                            <th class="px-4 py-3" rowspan="3">
                                <div class="flex items-center text-sm">
                                    {{ $item->nama_profesi }}
                                </div>
                            </th>
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    Jumlah Ya
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ hhaction_rekap_profesi_ya($item->id, $tahun->id, 1) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ hhaction_rekap_profesi_ya($item->id, $tahun->id, 2) }}
                            </td>
                            <td class="px-4 py-3 text-xs">
                                {{ hhaction_rekap_profesi_ya($item->id, $tahun->id, 3) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ hhaction_rekap_profesi_ya($item->id, $tahun->id, 4) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ hhaction_rekap_profesi_ya($item->id, $tahun->id, 5) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ hhaction_rekap_profesi_ya($item->id, $tahun->id, 6) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ hhaction_rekap_profesi_ya($item->id, $tahun->id, 7) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ hhaction_rekap_profesi_ya($item->id, $tahun->id, 8) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ hhaction_rekap_profesi_ya($item->id, $tahun->id, 9) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ hhaction_rekap_profesi_ya($item->id, $tahun->id, 10) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ hhaction_rekap_profesi_ya($item->id, $tahun->id, 11) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ hhaction_rekap_profesi_ya($item->id, $tahun->id, 12) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    Total Kesempatan
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ kesempatan_rekap_profesi($item->id, $tahun->id, 1) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ kesempatan_rekap_profesi($item->id, $tahun->id, 2) }}
                            </td>
                            <td class="px-4 py-3 text-xs">
                                {{ kesempatan_rekap_profesi($item->id, $tahun->id, 3) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ kesempatan_rekap_profesi($item->id, $tahun->id, 4) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ kesempatan_rekap_profesi($item->id, $tahun->id, 5) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ kesempatan_rekap_profesi($item->id, $tahun->id, 6) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ kesempatan_rekap_profesi($item->id, $tahun->id, 7) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ kesempatan_rekap_profesi($item->id, $tahun->id, 8) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ kesempatan_rekap_profesi($item->id, $tahun->id, 9) }}
                            <td class="px-4 py-3 text-sm">
                                {{ kesempatan_rekap_profesi($item->id, $tahun->id, 10) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ kesempatan_rekap_profesi($item->id, $tahun->id, 11) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ kesempatan_rekap_profesi($item->id, $tahun->id, 12) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    Persentase
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ persentase_rekap_profesi($item->id, $tahun->id, 1) }} %
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ persentase_rekap_profesi($item->id, $tahun->id, 2) }} %
                            </td>
                            <td class="px-4 py-3 text-xs">
                                {{ persentase_rekap_profesi($item->id, $tahun->id, 3) }} %
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ persentase_rekap_profesi($item->id, $tahun->id, 4) }} %
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ persentase_rekap_profesi($item->id, $tahun->id, 5) }} %
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ persentase_rekap_profesi($item->id, $tahun->id, 6) }} %
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ persentase_rekap_profesi($item->id, $tahun->id, 7) }} %
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ persentase_rekap_profesi($item->id, $tahun->id, 8) }} %
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ persentase_rekap_profesi($item->id, $tahun->id, 9) }} %
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ persentase_rekap_profesi($item->id, $tahun->id, 10) }} %
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ persentase_rekap_profesi($item->id, $tahun->id, 11) }} %
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ persentase_rekap_profesi($item->id, $tahun->id, 12) }} %
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>


    </div>
</main>
@endsection