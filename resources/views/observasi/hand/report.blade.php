@extends('layouts.main')
@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container px-6 mx-auto grid mt-2">
            <!-- CTA -->
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                {{-- <div class="container">
                    Periode :
                </div> --}}
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">Observer</th>
                                <th class="px-4 py-3">Periode</th>
                                <th class="px-4 py-3">Profesi</th>
                                <th class="px-4 py-3">Lantai-Ruangan</th>
                                <th class="px-4 py-3">Tanggal | Mulai-Selesai</th>
                                <th class="px-4 py-3">Opportunity</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @foreach ($data as $item)
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            {{ $item->observer }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $item->periode->nama_periode }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $item->profesi }}
                                    </td>
                                    <td class="px-4 py-3 text-xs">
                                        {{ $item->lantai }} - {{ $item->ruangan }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $item->tanggal_observasi }}|
                                        {{ $item->waktu_start }}-{{ $item->waktu_end }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ opportunity($item->id) }}
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
