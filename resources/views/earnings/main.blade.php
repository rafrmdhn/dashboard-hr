@extends('layouts.main')

@section('container')
    @if (session()->has('success'))
        <div class="flex sm:ml-72 sm:mr-8 mt-4 mitems-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">{{ session('success') }}
            </div>
        </div>
    @endif

    <div class="flex flex-col sm:ml-64 ">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="p-4">
                                    <div class="flex items-center">
                                        <input id="select_all_ids" aria-describedby="checkbox-1" type="checkbox"
                                            class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-all" class="sr-only">checkbox</label>
                                    </div>
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Name
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Bulan, Tahun
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Tipe
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    PIC Project
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Talent
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    SOW
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Rate
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Rate Talent
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Keuntungan
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Status
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Link Project
                                </th>
                                @can('edit earnings')
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Actions
                                </th>
                                @endcan
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @foreach ($tables as $finance)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700"
                                    id="{{ $search }}_ids{{ $finance->id }}">
                                    <td class="w-4 p-4">
                                        <div class="flex items-center">
                                            <input id="" aria-describedby="checkbox-1" name="ids"
                                                type="checkbox"
                                                class="checkbox_ids w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600"
                                                value="{{ $finance->id }}">
                                            <label for="checkbox" class="sr-only">checkbox</label>
                                        </div>
                                    </td>
                                    <td class="items-center p-4 mr-12 space-x-6 whitespace-nowrap">
                                        {{-- <img class="w-10 h-10 rounded-full" src="{{ asset($finance->photo) }}" alt="{{ $finance->name }}"> --}}
                                        <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                            <div class="text-base font-semibold text-gray-900 dark:text-white">
                                                {{ $finance->name }}</div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-base text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ \Carbon\Carbon::parse($finance->date)->format('F, Y') }}</td>
                                    <td class="p-4 text-base text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ basename(str_replace('\\', '/', $finance->earnable_type)) }}</td>
                                    <td class="p-4 text-base text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $finance->earnable->name }}</td>
                                    <td class="p-4 text-base text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $finance->talent->name }}</td>
                                    <td class="p-4 text-base text-gray-900 whitespace-nowrap dark:text-white">
                                        @foreach ($finance->sows as $sow)
                                            @if (!$loop->last)
                                                {{ $sow->name }},
                                            @else
                                                {{ $sow->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="p-4 text-base text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ 'Rp' . number_format($finance->rate, 2, ',', '.') }}</td>
                                    @php
                                        $talent_rate = $finance->sows->sum(function ($sow) use ($finance) {
                                            return $sow->pivot->talent_rate;
                                        });
                                    @endphp
                                    <td class="p-4 text-base text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ 'Rp' . number_format($talent_rate, 2, ',', '.') }}</td>
                                    <td class="p-4 text-base text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ 'Rp' . number_format($finance->rate - $talent_rate, 2, ',', '.') }}</td>
                                    <td class="p-4 text-base text-gray-900 whitespace-nowrap dark:text-white">
                                        @php
                                            $status_color = [
                                                'proses' =>
                                                    'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                                                'selesai' =>
                                                    'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                                'gagal' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                                            ];
                                        @endphp
                                        <span
                                            class="text-xs font-medium me-2 px-2.5 py-0.5 rounded {{ $status_color[$finance->status] }}">{{ $finance->status }}</span>
                                    </td>
                                    <td class="p-4 text-base text-blue-900 whitespace-nowrap dark:text-white"><a
                                            href="{{ $finance->link_project }}"
                                            target="_blank">{{ $finance->link_project }}</a></td>
                                    {{-- <td class="max-w-sm p-4 overflow-hidden text-base font-normal text-gray-500 truncate xl:max-w-xs dark:text-gray-400">{{ $intern->biography }}</td>
                                <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $intern->position->name }}</td>
                                <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $intern->university }}</td>
                                <td class="p-4 text-base font-normal text-gray-900 whitespace-nowrap dark:text-white">{{ $intern->instagram }}, {{ $intern->linkedin }}</td>--}}
                                @can('edit earnings')
                                <td class="p-4 space-x-2 whitespace-nowrap">
                                    <!-- Edit User Modal -->
                                    @include('earnings.edit')
                                    <!-- Delete User Modal -->
                                    <form action="/earnings/{{ $finance->id }}" method="POST" class="inline-flex">
                                        @method('delete')
                                        @csrf
                                        <!-- Delete User Modal -->
                                        @include('earnings.delete')
                                    </form>
                                </td> 
                                @endcan
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    {{ $tables->links('partials.paginate') }}

    @include('earnings.create')
@endsection
