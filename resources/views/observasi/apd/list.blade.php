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
                                <th class="px-4 py-3">Nama Auditor</th>
                                <th class="px-4 py-3">Periode</th>
                                <th class="px-4 py-3">Ruangan</th>
                                <th class="px-4 py-3">Keterangan</th>
                                <th class="px-4 py-3">Count</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @foreach ($data as $item)
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-2">
                                        <div class="flex items-center text-sm">
                                            {{ $no = $no + 1 }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            {{ $item->nama_auditor }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $item->periode->nama_periode }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $item->ruangan->nama_ruangan }}
                                    </td>
                                    <td class="px-4 py-3 text-xs">
                                        {{ $item->auditor }}
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        -
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <div class="inline-flex">
                                            <form action="{{ route('apd.posting') }}" method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <button type="submit"
                                                    class="flex rounded px-2 py-2 text-xs bg-yellow-500 text-yellow-100 hover:bg-yellow-600 duration-300">
                                                    Posting
                                                </button>
                                            </form>
                                            <a href="{{ route('apd.lanjut.input', $item->id) }}"
                                                class="ml-2 rounded px-2 py-2 text-xs bg-green-500 text-green-100 hover:bg-green-600 duration-300">
                                                Lanjutkan
                                            </a>

                                            <a href="{{ route('apd.lanjut.detail', $item->id) }}"
                                                class="ml-2 rounded px-2 py-2 text-xs bg-red-500 text-red-100 hover:bg-red-600 duration-300">
                                                Detail
                                            </a>
                                        </div>

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
