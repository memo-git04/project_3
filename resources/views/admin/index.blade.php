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

            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body pb-0 d-flex justify-content-between">
                                    <div>
                                        <h4 class="mb-1">Product Sales</h4>
                                        <p>Total Earnings of the Month</p>
                                        <h3 class="m-0">$ 12,555</h3>
                                    </div>
                                    <div>
                                        <ul>
                                            <li class="d-inline-block mr-3"><a class="text-dark" href="#">Day</a></li>
                                            <li class="d-inline-block mr-3"><a class="text-dark" href="#">Week</a></li>
                                            <li class="d-inline-block"><a class="text-dark" href="#">Month</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="chart-wrapper">
                                    <canvas id="chart_widget_2"></canvas>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div class="w-100 mr-2">
                                            <h6>Pixel 2</h6>
                                            <div class="progress" style="height: 6px">
                                                <div class="progress-bar bg-danger" style="width: 40%"></div>
                                            </div>
                                        </div>
                                        <div class="ml-2 w-100">
                                            <h6>iPhone X</h6>
                                            <div class="progress" style="height: 6px">
                                                <div class="progress-bar bg-primary" style="width: 80%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>







            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="active-member">
                                <div class="table-responsive">
                                    <table class="table table-xs mb-0">
                                        <thead>
                                        <tr>
                                            <th>Customers</th>
                                            <th>Product</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th>Payment Method</th>
                                            <th>Activity</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><img src="{{ asset('admin/images/avatar/1.jpg') }}" class=" rounded-circle mr-3" alt="">Sarah Smith</td>
                                            <td>iPhone X</td>
                                            <td>
                                                <span>United States</span>
                                            </td>
                                            <td>
                                                <div>
                                                    <div class="progress" style="height: 6px">
                                                        <div class="progress-bar bg-success" style="width: 50%"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><i class="fa fa-circle-o text-success  mr-2"></i> Paid</td>
                                            <td>
                                                <span>Last Login</span>
                                                <span class="m-0 pl-3">10 sec ago</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ asset('admin/images/avatar/2.jpg') }}" class=" rounded-circle mr-3" alt="">Walter R.</td>
                                            <td>Pixel 2</td>
                                            <td><span>Canada</span></td>
                                            <td>
                                                <div>
                                                    <div class="progress" style="height: 6px">
                                                        <div class="progress-bar bg-success" style="width: 50%"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><i class="fa fa-circle-o text-success  mr-2"></i> Paid</td>
                                            <td>
                                                <span>Last Login</span>
                                                <span class="m-0 pl-3">50 sec ago</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ asset('admin/images/avatar/3.jpg') }}" class=" rounded-circle mr-3" alt="">Andrew D.</td>
                                            <td>OnePlus</td>
                                            <td><span>Germany</span></td>
                                            <td>
                                                <div>
                                                    <div class="progress" style="height: 6px">
                                                        <div class="progress-bar bg-warning" style="width: 50%"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><i class="fa fa-circle-o text-warning  mr-2"></i> Pending</td>
                                            <td>
                                                <span>Last Login</span>
                                                <span class="m-0 pl-3">10 sec ago</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ asset('admin/images/avatar/6.jpg') }}" class=" rounded-circle mr-3" alt=""> Megan S.</td>
                                            <td>Galaxy</td>
                                            <td><span>Japan</span></td>
                                            <td>
                                                <div>
                                                    <div class="progress" style="height: 6px">
                                                        <div class="progress-bar bg-success" style="width: 50%"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><i class="fa fa-circle-o text-success  mr-2"></i> Paid</td>
                                            <td>
                                                <span>Last Login</span>
                                                <span class="m-0 pl-3">10 sec ago</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ asset('admin/images/avatar/4.jpg') }}" class=" rounded-circle mr-3" alt=""> Doris R.</td>
                                            <td>Moto Z2</td>
                                            <td><span>England</span></td>
                                            <td>
                                                <div>
                                                    <div class="progress" style="height: 6px">
                                                        <div class="progress-bar bg-success" style="width: 50%"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><i class="fa fa-circle-o text-success  mr-2"></i> Paid</td>
                                            <td>
                                                <span>Last Login</span>
                                                <span class="m-0 pl-3">10 sec ago</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ asset('admin/images/avatar/5.jpg') }}" class=" rounded-circle mr-3" alt="">Elizabeth W.</td>
                                            <td>Notebook Asus</td>
                                            <td><span>China</span></td>
                                            <td>
                                                <div>
                                                    <div class="progress" style="height: 6px">
                                                        <div class="progress-bar bg-warning" style="width: 50%"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><i class="fa fa-circle-o text-warning  mr-2"></i> Pending</td>
                                            <td>
                                                <span>Last Login</span>
                                                <span class="m-0 pl-3">10 sec ago</span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





        </div>
        <!-- #/ container -->
    </div>
    <!--**********************************
        Content body end
    ***********************************-->


@endsection
