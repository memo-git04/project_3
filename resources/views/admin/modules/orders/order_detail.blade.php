@extends('admin.layout.master_layout')
@section('content')



    <div class="content-body">

        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Order Item: </h6>
            </div>
            <div class="card-body shadow">

                <form class="row" action="" method="POST" enctype="multipart/form-data">



                    <div class="col-sm-6">
                        <label for="exampleFormControlInput1"><b>Customer information</b></label>
                        <hr>
                        <p>Order ID: </p>
                        <p>Customer: </p>
                        <p>Phone: </p>
                        <p>Address: </p>
                        <p>Total order: </p>
                        <p>Order Date: </p>
                        <p>Status:
                            <span class="text text-primary">
                            </span>
                        </p>
                        <hr>
                    </div>

                    <div class="col-sm-12">
                        <label for="exampleFormControlInput1"><b>Product information</b></label>
                    </div>
                    <div class="col-sm-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Img</th>
                                    <th style="width: 450px;">Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>

                                    <tr>

                                        <td>
                                            <img width="70px" height="100px" src="" alt="">
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                            <hr>

                            </tbody>

                        </table>
                    </div>
            </form>
        </div>


        <div class="row" style="margin-left: 15px;">
            <div class="col-md-12">
                <a href="" type="button" class="btn btn-success">Update</a>

                <a href="" type="button" class="btn btn-primary">Back to</a>
            </div>
        </div>
    </div>
    <!--**********************************
                Content body end
            ***********************************-->



@endsection
