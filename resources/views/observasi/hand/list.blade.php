@extends('layouts.main')
@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container px-6 mx-auto grid mt-2">
            <!-- CTA -->
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">No</th>
                                <th class="px-4 py-3">Observer</th>
                                <th class="px-4 py-3">Periode</th>
                                <th class="px-4 py-3">Profesi</th>
                                <th class="px-4 py-3">Lantai-Ruangan</th>
                                <th class="px-4 py-3">Tanggal | Mulai-Selesai</th>
                                <th class="px-4 py-3">Opportunity</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @foreach ($data as $item)
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            {{ $no = $no + 1 }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            {{ $item->observer }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $item->periode->nama_periode }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $item->profesi->nama_profesi }}
                                    </td>
                                    <td class="px-4 py-3 text-xs">
                                        {{ $item->lantai }} - {{ $item->ruangan->nama_ruangan }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $item->tanggal_observasi }}|
                                        {{ $item->waktu_start }}-{{ $item->waktu_end }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ opportunity($item->id) }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        @if (opportunity($item->id) > 5)
                                            <form action="{{ route('handhygiene.posting') }}" method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <button type="submit"
                                                    class="inline-flex justify-center py-2 px-3 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-400 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                    Posting
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('handhygiene.lanjut.input', $item->id) }}"
                                                class="inline-flex justify-center py-2 px-3 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-400 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                Lanjutkan
                                            </a>
                                            <form action="{{ route('handhygiene.posting') }}" method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <button type="submit"
                                                    class="inline-flex justify-center py-2 px-3 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-400 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                    Posting
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div
                    class="flex justify-center px-6 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                    {{ $data->links('pagination::tailwind') }}

                </div>
            </div>


        </div>
    </main>
@endsection
