<!DOCTYPE html>
<html lang="en">
<?php include('config/connection.php');  ?>

<head>
    <link rel="shortcut icon" href="images/favicon.png">
    <title>Login</title>
    <!--Core CSS -->
    <link href="ASSETS/bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="ASSETS/css/bootstrap-reset.css" rel="stylesheet">
    <link href="ASSETS/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="ASSETS/css/style.css" rel="stylesheet">
    <link href="ASSETS/css/style-responsive.css" rel="stylesheet" /> </head>

<body class="login-body">
    <div class="container">
        <form class="form-signin" method="post">
            <h2 class="form-signin-heading">login now!</h2>
            <div class="login-wrap">
                <div class="user-login-info">
                    <div class="input-group m-bot15"> <span class="input-group-addon"><i class ="fa fa-user"></i></span>
                        <input name="username" type="text" class="form-control" placeholder="Username" value="" required> </div>
                    <div class="input-group m-bot15"> <span class="input-group-addon"><i class ="fa fa-lock"></i></span>
                        <input name="password" id="password" type="password" class="form-control" placeholder="Password" value="" required> </div>
                    <?php
				    session_start();
                    if(isset($_SESSION['logged_in']))
                    {   if($_SESSION['logged_user']['role']=="Organization")
                        { header("location:DIR_ORG/dashboard.php");  }
                        else if($_SESSION['logged_user']['role']=="OSAS HEAD")
                         { header("location:DIR_OSAS/dashboard.php"); }
                        else if($_SESSION['logged_user']['role']=="Administrator")
                        { header("location:DIR_ADMIN/dashboard.php"); }
                        else if($_SESSION['logged_user']['role']=="Student")
                        { }  
                        else if(empty($_SESSION['logged_user'])||empty($_SESSION['logged_in']))
                        { header("location:login.php");}
                    }
                    else{
								if (isset($_POST['login'])){
								$username = $_POST['username'];
								$password = $_POST['password'];
                                $query = "call Login_User('$username','$password')"; 
								$result = mysqli_query($con,$query);
                                $num_row = mysqli_num_rows($result); 
                                $row = mysqli_fetch_assoc($result);  
                               
									if( $num_row > 0 ) {
                                        $_SESSION['logged_in']=	$row["Users_USERNAME"];
                                        $_SESSION['logged_user']=array(
                                            'username'=>$row['Users_USERNAME'], 
                                            'role'=>$row['Users_ROLES'],
                                            'ppath'=>$row['Users_PROFILE_PATH'],
                                            'ref'=>$row['Users_REFERENCED']);
                                        $role = $_SESSION['logged_user']['role'];
                                           if($_SESSION['logged_user']['role']=="Organization")
                                            { header("location:DIR_ORG/dashboard.php");  }
                                            else if($_SESSION['logged_user']['role']=="OSAS HEAD")
                                            { header("location:DIR_OSAS/dashboard.php"); }
                                            else if($_SESSION['logged_user']['role']=="Administrator")
                                            { header("location:DIR_ADMIN/dashboard.php"); }
                                            else if($_SESSION['logged_user']['role']=="Student")
                                            { }
                                            else if(empty($_SESSION['logged_user'])||empty($_SESSION['logged_in']))
                                            { header("location:login.php");
									}}
									else{ ?>
                        <div class="alert alert-danger">Access Denied</div>
                        <?php
								}}}
								?>
                </div>
                <label class="checkbox">
                        <input type="checkbox" value="remember-me"> Remember me <span class="pull-right">
                    <a data-toggle="modal" href="#ForgotPassword"> Forgot Password?</a>
                </span> </label>
                <button name="login" class="btn btn-lg btn-login btn-block" id="btnlogin" type="submit">Sign in</button>
            </div>
        </form>
        <form>
            <!-- Modal -->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="ForgotPassword" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Forgot Password ?</h4>
                        </div>
                        <div class="modal-body">
                            <p>Enter your e-mail address below to reset your password.</p>
                            <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix"> </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                            <button class="btn btn-success" type="button">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal -->
        </form>
    </div>
    <!-- Placed js at the end of the document so the pages load faster -->
    <!--Core js-->
    <script src="ASSETS/js/jquery.js"></script>
    <script src="ASSETS/bs3/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {


        });

    </script>
</body>

</html>
