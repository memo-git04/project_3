@extends('admin.layout.master_layout')
@section('content')


    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">

        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="card gradient-1">
                        <div class="card-body">
                            <h3 class="card-title text-white">Products </h3>
                            <div class="d-inline-block">
                                <h2 class="text-white">
                                    {{ $data['productsCount'] }}
                                </h2>
{{--                                <p class="text-white mb-0">Jan - March 2019</p>--}}
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card gradient-2">
                        <div class="card-body">
                            <h3 class="card-title text-white">Net Profit</h3>
                            <div class="d-inline-block">
                                <h2 class="text-white">{{$data['totalRevenue']}}</h2>
{{--                                <p class="text-white mb-0">Jan - March 2019</p>--}}
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card gradient-3">
                        <div class="card-body">
                            <h3 class="card-title text-white">New Customers</h3>
                            <div class="d-inline-block">
                                <h2 class="text-white">{{ $data['customersCount'] }} </h2>
{{--                                <p class="text-white mb-0">Jan - March 2019</p>--}}
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card gradient-4">
                        <div class="card-body">
                            <h3 class="card-title text-white">Product is out of stock</h3>
                            <div class="d-inline-block">
                                <h2 class="text-white">
                                    {{--                                {{ $InStockProducts}}--}}
                                </h2>
                                <p class="text-white mb-0">Jan - March 2019</p>
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fa-solid fa-triangle-exclamation"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div style="display: flex; gap: 20px;">
                <div>
                    <div style="width: 600px; height: 400px; padding: 10px" class="bg-white">
                        <canvas id="myChart"></canvas>
                    </div>
                    {{--                {{ json_encode($chartData["labels"])}}--}}
                    <script>
                        const ctx = document.getElementById('myChart');
                        {{--console.log({{$chartData['labels']}});--}}
                        const labelsCate = {!!json_encode($chartData["labels"])!!};
                        const dataCate =  {!!json_encode($chartData['data'])!!};
                        console.log(labelsCate);
                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labelsCate,
                                datasets: [{
                                    label: 'Quantity',
                                    data: dataCate,
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>
                </div>
                <div class="bg-white" style="width: 600px; justify-content: center;">
                    <div class="">
                        <canvas id="pieChart"></canvas>
                    </div>
                    <script>
                        var chartDom = document.getElementById('pieChart');
                        var myChart = echarts.init(chartDom);
                        var option;
                        option = {
                            title: {
                                text: 'Referer of a Website',
                                subtext: 'Fake Data',
                                left: 'center'
                            },
                            tooltip: {
                                trigger: 'item'
                            },
                            legend: {
                                orient: 'vertical',
                                left: 'left'
                            },
                            series: [
                                {
                                    name: 'Access From',
                                    type: 'pie',
                                    radius: ['20%', '80%'],
                                    data: [
                                        { value: 1048, name: 'Search Engine' },
                                        { value: 735, name: 'Direct' },
                                        { value: 580, name: 'Email' },
                                        { value: 484, name: 'Union Ads' },
                                        { value: 300, name: 'Video Ads' }
                                    ],
                                    emphasis: {
                                        itemStyle: {
                                            shadowBlur: 10,
                                            shadowOffsetX: 0,
                                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                                        }
                                    }
                                }
                            ]
                        };
                        option && myChart.setOption(option);
                    </script>
                </div>
            </div>

            <div>
                <div id="piechart" style="width: 900px; height: 500px; margin-top: 20px" ></div>
                <script type="text/javascript">
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {

                        var data = google.visualization.arrayToDataTable([
                            ['Task', 'Hours per Day'],
                            ['Work',     11],
                            ['Eat',      2],
                            ['Commute',  2],
                            ['Watch TV', 2],
                            ['Sleep',    7]
                        ]);

                        var options = {
                            title: 'My Daily Activities',
                            colors: ['#BBD8F2', '#ADA2F2', '#D9A0BB', '#91D9BF', '#FCF0CF']
                        };

                        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                        chart.draw(data, options);
                    }
                </script>
            </div>
        </div>
        <!-- #/ container -->
    </div>
    <!--**********************************
        Content body end
    ***********************************-->


@endsection
