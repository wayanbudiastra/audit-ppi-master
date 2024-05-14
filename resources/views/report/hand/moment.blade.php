@extends('layouts.main')
@section('content')
<main class="h-full pb-16 overflow-y-auto">
    <div class="container px-6 mx-auto grid mt-2">
        <!-- CTA -->
        <h1 class="mt-3 mb-3 flex justify-center text-lg font-semibold">Rekap HH Permoment</h1>
        <div class="w-full overflow-hidden rounded-lg shadow-xs mt-2">
            <div class="w-full overflow-x-auto">

                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <form action="{{ url('report-hh-permoment-periode') }}" method="POST">
                        {{ csrf_field() }}
                        <select name="periode_id"
                            class="w-40 inline-flex justify-center border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                            @foreach ($period as $a)
                            @php
                            $selected = ' ';
                            if ($periode_id == $a->id) {
                            $selected = 'selected';
                            }
                            @endphp
                            <option value="{{ $a->id }}" {{ $selected }}>{{ $a->nama_periode }}
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
                            <th class="px-4 py-3">Tanggal Observvasi</th>
                            <th class="px-4 py-3">Observer</th>
                            <th class="px-4 py-3">Profesi</th>
                            <th class="px-4 py-3">Ruangan</th>
                            <th class="px-4 py-3">M1</th>
                            <th class="px-4 py-3">M2</th>
                            <th class="px-4 py-3">M3</th>
                            <th class="px-4 py-3">M4</th>
                            <th class="px-4 py-3">M5</th>
                            <th class="px-4 py-3">HW</th>
                            <th class="px-4 py-3">HR</th>
                            <th class="px-4 py-3">MISS</th>
                            <th class="px-4 py-3">GLOW</th>
                            {{-- @if (Auth()->user()->id =='2')
                            <th class="px-4 py-3">Aksi</th>
                            @endif --}}
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @php
                        $counter_m1 = 0;
                        $counter_m2 = 0;
                        $counter_m3 = 0;
                        $counter_m4 = 0;
                        $counter_m5 = 0;
                        $counter_hw = 0;
                        $counter_hr = 0;
                        $counter_miss = 0;
                        $counter_glove = 0;

                        @endphp
                        @foreach ($data as $item)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                     {{ $no = $no + 1 }} 
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    {{ $item->tanggal_observasi }}
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    {{ $item->observer }}
                                </div>
                            </td>

                            <td class="px-4 py-3 text-sm">
                                {{ get_profesi($item->profesi_id) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ get_ruangan($item->ruangan_id) }}
                            </td>
                            <td class="px-4 py-3 text-xs">
                                {{ $m1 = rekap_m1($item->id) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $m2 = rekap_m2($item->id) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $m3 = rekap_m3($item->id) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $m4 = rekap_m4($item->id) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $m5 = rekap_m5($item->id) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $hw = rekap_hw($item->id) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $hr = rekap_hr($item->id) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $miss = rekap_miss($item->id) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $glove = rekap_glove($item->id) }}
                            </td>
                            @if (Auth()->user()->id =='2')
                            <td class="px-4 py-3 text-sm">
                                <a href="{{url('report-hh-perruangan-edit/'.$item->id)}}" title="Edit data"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-400 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">edit</a>
                                <a onclick="return confirm('Apakah yakin akan menghapus data  ini?') || event.stopImmediatePropagation();"
                                    href="{{url('report-hh-perruangan-del/'.$item->id)}}" title="Hapus data"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-400 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Del
                                </a>
                            </td>
                            @endif

                        </tr>
                        @php
                        $counter_m1 = $counter_m1 + rekap_hasil_ya($m1);
                        $counter_m2 = $counter_m2 + rekap_hasil_ya($m2);
                        $counter_m3 = $counter_m3 + rekap_hasil_ya($m3);
                        $counter_m4 = $counter_m4 + rekap_hasil_ya($m4);
                        $counter_m5 = $counter_m5 + rekap_hasil_ya($m5);
                        $counter_hw = $counter_hw + rekap_hasil_ya($hw);
                        $counter_hr = $counter_hr + rekap_hasil_ya($hr);
                        $counter_miss = $counter_miss + rekap_hasil_ya($miss);
                        $counter_glove = $counter_glove + rekap_hasil_ya($glove);
                        @endphp
                        @endforeach
                    </tbody>
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3" colspan="5">Rekap Hasil Ya</th>

                            <th class="px-4 py-3">{{ $counter_m1 }}</th>
                            <th class="px-4 py-3">{{ $counter_m2 }}</th>
                            <th class="px-4 py-3">{{ $counter_m3 }}</th>
                            <th class="px-4 py-3">{{ $counter_m4 }}</th>
                            <th class="px-4 py-3">{{ $counter_m5 }}</th>
                            <th class="px-4 py-3">{{ $counter_hw }}</th>
                            <th class="px-4 py-3">{{ $counter_hr }}</th>
                            <th class="px-4 py-3">{{ $counter_miss }}</th>
                            <th class="px-4 py-3">{{ $counter_glove }}</th>
                            @if (Auth()->user()->id =='2')
                            <th class="px-4 py-3">-</th>
                            @endif
                        </tr>
                    </thead>
                </table>
            </div>

        </div>


    </div>
</main>
@endsection