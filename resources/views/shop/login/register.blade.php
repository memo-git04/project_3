
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Account</title>
    <link rel="stylesheet" href="./css1/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- bootstrap links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- bootstrap links -->
    <!-- fonts links -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
    <!-- fonts links -->

    <link href="../Web/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../Web/admin/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        #button {
            margin-top: 10px;
            border-radius: 50px 50px 50px 50px;
            width: 650px;
            height: 50px;
            margin-left: auto;
        }

        .form-group input {
            border-radius: 50px;
        }

        #input1 {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>


<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block">
                    <img style="width: 477px; height: 610px;" src="{{asset('store/img/pic_2.jpg')}}" alt="">
                </div>
                <div class="col-lg-7">
                    <div class="p-5">

                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form class="user" action="{{route('registerProcess')}}" method="POST">
                            @csrf
                            <div id="input1" class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" name="user_name" class="form-control form-control-user" id="exampleInputPassword" placeholder="User name">
                                </div>
                                <div id="input" class="col-sm-6">
                                    <input type="text" name="fullname" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Full Name">
                                </div>
                            </div>

                            <div id="input1" class="form-group">
                                <input id="input1" type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" value="<?php if (isset($email)) echo $email; ?>">
                                <span class="text-danger">

                                </span>
                            </div>
                            <div id="input1" class="form-group">
                                <input id="input1" type="text" name="phone" class="form-control form-control-user" id="exampleInputEmail" placeholder="Phone Number">
                            </div>
                            <div id="input1" class="form-group">
                                <input id="input1" type="text" name="address" class="form-control form-control-user" id="exampleInputEmail" placeholder="Address">
                            </div>
                            <div id="input1" class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                </div>
                                <div id="input" class="col-sm-6">
                                    <input type="password" name="repeatpass" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password">
                                </div>
                            </div>

                            <!-- </button> -->

                            <button id="button" name="register" value="register" type="submit" class="btn btn-primary">Register Account</button>

                            <!-- <button> -->
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



<a href="#" class="arrow"><i><img src="./images/arrow.png" alt=""></i></a>


<!-- Bootstrap core JavaScript-->
<script src="../Web/admin/vendor/jquery/jquery.min.js"></script>
<script src="../Web/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../Web/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../Web/admin/js/sb-admin-2.min.js"></script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>
