@extends('layouts.main')

@section('container')
<div class="p-6 sm:ml-64 mt-14">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="flex items-center mb-1">
                        <div class="text-2xl font-semibold">{{ $staffs }}</div>
                    </div>
                    <div class="text-sm font-medium text-gray-400">Staff</div>
                </div>
            </div>

            <a href="/staff" class="text-[#f84525] font-medium text-sm hover:text-red-800">View</a>
        </div>
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="text-2xl font-semibold mb-1">{{ $talents }}</div>
                    <div class="text-sm font-medium text-gray-400">Talent</div>
                </div>
            </div>
            <a href="/talent" class="text-[#f84525] font-medium text-sm hover:text-red-800">View</a>
        </div>
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="text-2xl font-semibold mb-1">{{ $interns }}</div>
                    <div class="text-sm font-medium text-gray-400">Intern</div>
                </div>
            </div>
            <a href="/intern" class="text-[#f84525] font-medium text-sm hover:text-red-800">View</a>
        </div>
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-4">
                <div>
                    <div class="flex items-center mb-1">
                        <div class="text-2xl font-semibold">{{ $positions }}</div>
                    </div>
                    <div class="text-sm font-medium text-gray-400">Position</div>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <div class="p-6 relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words w-full shadow-md shadow-black/5 rounded">
            <div class="rounded-t mb-0 px-0 border-0">
              <div class="flex flex-wrap items-center px-4 py-2">
                <div class="relative w-full max-w-full flex-grow flex-1">
                  <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Kinerja</h3>
                </div>
              </div>
              <div class="block w-full overflow-x-auto">
                    <div id="column-chart"></div>
              </div>
            </div>
          </div>
            <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
              <div class="relative w-full max-w-full flex-grow flex-1">
                <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Total Posisi</h3>
              </div>
                <div class="py-6" id="pie-chart"></div>
            </div>
            
    </div>
    <div class="grid grid-cols-4 gap-6 mb-6">
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md lg:col-span-2">
            <div class="flex justify-between mb-4 items-start">
                <div class="font-medium">Spendings</div>
                <a href="/spendings" class="text-sm text-blue-600 hover:text-blue-800">See All</a>
            </div>
            <div class="overflow-x-auto">
              <table class="w-full min-w-[460px]">
                <thead>
                    <tr>
                        <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tl-md rounded-bl-md">Nama</th>
                        <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">Pengeluaran</th>
                        <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tr-md rounded-br-md">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($spendings as $spend)
                        <tr>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <div class="flex items-center">
                                    <p class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ $spend->staff->name }}</a>
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span class="text-[13px] font-medium text-emerald-500">{{ 'Rp' . number_format($spend->budget, 2, ',', '.') }}</span>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                @if($spend->status == 'gagal')
                                    <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-pink-500 bg-pink-100/60 dark:bg-gray-800">
                                        <h2 class="text-sm font-normal">Gagal</h2>
                                    </div>
                                @elseif($spend->status == 'selesai')
                                    <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-emerald-500 bg-emerald-100/60 dark:bg-gray-800">
                                        <h2 class="text-sm font-normal">Selesai</h2>
                                    </div>
                                @elseif($spend->status == 'proses')
                                    <div class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-blue-500 bg-blue-100/60 dark:bg-gray-800">
                                        <h2 class="text-sm font-normal">Proses</h2>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md lg:col-span-2">
            <div class="flex justify-between mb-4 items-start">
                <div class="font-medium">Earnings</div>
                <a href="/earnings" class="text-sm text-blue-600 hover:text-blue-800">See All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[460px]">
                    <thead>
                        <tr>
                            <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tl-md rounded-bl-md">Nama Project</th>
                            <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">Pendapatan</th>
                            <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tr-md rounded-br-md">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($earnings as $earning)
                            <tr>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <div class="flex items-center">
                                        <a href="{{ $earning->link_project }}" class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ $earning->name }}</a>
                                    </div>
                                </td>
                                @php
                                    $talent_rate = $earning->sows->sum(function ($sow) use ($earning) {
                                        return $sow->pivot->talent_rate;
                                    });
                                @endphp
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span class="text-[13px] font-medium text-emerald-500">{{ 'Rp' . number_format($earning->rate - $talent_rate, 2, ',', '.') }}</span>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    @if ($earning->status == 'proses')
                                        <span class="inline-block p-1 rounded bg-yellow-100 text-yellow-800 font-medium text-[12px] leading-none">{{ $earning->status }}</span>
                                    @elseif ($earning->status == 'selesai')
                                        <span class="inline-block p-1 rounded bg-green-100 text-green-800 font-medium text-[12px] leading-none">{{ $earning->status }}</span>
                                    @elseif ($earning->status == 'gagal')
                                    <span class="inline-block p-1 rounded bg-red-100 text-red-800 font-medium text-[12px] leading-none">{{ $earning->status }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>

const getChartOptions = () => {
  return {
    series: {!! json_encode($pie) !!},
    colors: ["#1C64F2", "#16BDCA", "#9061F9", "#F21C64", "#CA16BD", "#F99061", "#F9F91C", "#64F21C", "#1CAAF2", "#F21CA3"],
    chart: {
      height: 420,
      width: "100%",
      type: "pie",
    },
    stroke: {
      colors: ["white"],
      lineCap: "",
    },
    plotOptions: {
      pie: {
        labels: {
          show: true,
        },
        size: "100%",
        dataLabels: {
          offset: -25
        }
      },
    },
    labels: {!! json_encode($labels) !!},
    dataLabels: {
      enabled: true,
      style: {
        fontFamily: "Inter, sans-serif",
      },
    },
    legend: {
      position: "bottom",
      fontFamily: "Inter, sans-serif",
    },
    yaxis: {
      labels: {
        formatter: function (value) {
          return value + "%"
        },
      },
    },
    xaxis: {
      labels: {
        formatter: function (value) {
          return value  + "%"
        },
      },
      axisTicks: {
        show: false,
      },
      axisBorder: {
        show: false,
      },
    },
  }
}

if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
  const chart = new ApexCharts(document.getElementById("pie-chart"), getChartOptions());
  chart.render();
}

</script>

<script>
    const options = {
        colors: ["#1A56DB", "#FDBA8C"],
        series: [
            {
                name: "Intern",
                color: "#1A56DB",
                data: {!! json_encode($internData) !!}.map(item => ({ x: item.month_name, y: item.result }))
            },
            {
                name: "Staff",
                color: "#FDBA8C",
                data: {!! json_encode($staffData) !!}.map(item => ({ x: item.month_name, y: item.result }))
            },
        ],
        chart: {
            type: "bar",
            height: "420px",
            fontFamily: "Inter, sans-serif",
            toolbar: {
                show: false,
            },
        },
    };

    if (document.getElementById("column-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("column-chart"), options);
        chart.render();
    }
</script>
@endsection