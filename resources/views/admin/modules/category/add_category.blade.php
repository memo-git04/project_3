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

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add new category</h4>
                        <div class="form-validation">
                            <form class="form-valide" action="{{ route('categories.store') }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Name<span class="text-danger"></span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="val-username" name="category_name">
                                    </div>

{{--                                    <label class="col-lg-4 col-form-label" for="val-username">Icon<span class="text-danger"></span>--}}
{{--                                    </label>--}}
{{--                                    <div class="col-lg-6 mt-3">--}}
{{--                                        <input type="text" class="form-control" id="val-username" name="category_icon">--}}
{{--                                    </div>--}}
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" name="submit" class="btn btn-primary">Add new</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>
<!--**********************************
@endsection



