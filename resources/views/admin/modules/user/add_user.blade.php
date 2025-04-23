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
                        <h4 class="card-title">Add new member</h4>
                        <div class="form-validation">
                            <form class="form-valide" action="{{route('users.store')}}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Username <span class="text-danger"></span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="val-username" name="user_name" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-fullname">Fullname <span class="text-danger"></span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="val-fullname" name="full_name" value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-email">Email <span class="text-danger"></span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="val-email" name="email" value="">
                                        <span class="text-danger">

                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-password">Password <span class="text-danger"></span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="password" class="form-control" id="val-password" name="password">
                                        <span class="text-danger">

                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-confirm-password">Address <span class="text-danger"></span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="" name="address">
                                        <span class="text-danger">

                                        </span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-phone">Phone<span class="text-danger"></span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="phone" value="" name="phone">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-skill">Level <span class="text-danger"></span>
                                    </label>
                                    <div class="col-lg-6">
                                        <select class="form-control" id="val-skill" name="role_id">
                                            <option>Please select</option>
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}">
                                                    {{$role->role_name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
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

@endsection
