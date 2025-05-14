<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
    <style>
        #button {
            border-radius: 50px 50px 50px 50px;
            width: 345px;
            height: 50px;
        }

        #button1 {
            border-radius: 50px 50px 50px 50px;
            width: 345px;
            height: 50px;
            margin-bottom: 10px;
        }

        .form-group input {
            border-radius: 50px;
        }

        #input1 {
            margin-bottom: 10px;
        }
    </style>
    <link href="../Web/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../Web/admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body>

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block">
                            <img style="width: 455px; height: 600px;" src="{{asset('store/img/pic_2.jpg')}}" alt="">
                        </div>

                        <div class="col-lg-6">
                            <div class="p-5">

                                   <div class="alert alert-danger d-flex align-items-center" role="alert">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                      </svg>
                                      <div>
                                        Email or Password error!
                                      </div>
                                    </div>';
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>

                                <div class="mb-2 ">
                                        <span class="text text-danger">

                                        </span>
                                </div>

                                <form action="{{route('password.update')}}" class="user" method="post">
                                    @csrf
                                    <div id="input1" class="form-group">
                                        <label class="control-label">Reset Code</label>

                                        <input type="text" name="code" class="form-control form-control-user" id="exampleInputPassword" placeholder="code">
                                    </div>

                                    <div id="input1" class="form-group">
                                        <label class="control-label"> New Password</label>

                                        <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="">
                                    </div>
                                    <div id="input1" class="form-group">
                                        <label class="control-label">Repassword</label>

                                        <input type="password" name="re_password" class="form-control form-control-user" id="exampleInputPassword">
                                    </div>

                                    <!-- <button> -->
                                    <button id="button" name="ForgotPassword" value="login" type="submit" class="btn btn-primary">submit</button>
                                </form>
                            </div>
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
