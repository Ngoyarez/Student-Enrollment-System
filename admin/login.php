<?php 
require_once 'db_connect.php';

session_start();

if(isset($_SESSION['user_login'])){
    header('Location: index.php');
}

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $input_array = array();

    if(empty($username)){
        $input_array['input_user_error'] = "Username is required";
    }

    if(empty($password)){
        $input_array['input_pass_error'] = "Password is required";
    }

    if(count($input_array) == 0){
        $query = "SELECT * FROM `users` WHERE `username` = '$username';";
        
        $result = mysqli_query($db_connect, $query);

        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            if($row['password'] == sha1(md5($password))){
                if($row['status'] == 'active'){
                    $_SESSION['user_login'] = $username;
                    header('Location: index.php');
                }
                else{
                    $status_inactive = "Your status is inactive, Please contact your admin for support!";
                }
            }else{
                $wrongpass = "This password is wrong";
            }
        }else{
            $username = "Username Not Found";
        }
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Student Enrollment System</title>
  </head>
  <body>
    <div class="container">
        <h1 class="text-center">Login User!</h1><hr><br>
        <div class="d-flex justify-content-center">
            <?php if(isset($usernameerror)){ ?> <div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-danger fade hide" data-delay="2000"><php echo $usernameerror ?></div><?php };?>

            <?php if(isset($wrongpass)){ ?> <div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-danger fade hide" data-delay="2000"><php echo $wrongpass ?></div><?php };?>

            <?php if(isset($status_inactive)){ ?> <div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-danger fade hide" data-delay="2000"><php echo $status_inactive ?></div><?php };?>
        </div>

        <div class="row animate_animated animate_pulse">
            <div class="col-md-4 offset-md-4">
                <form action="" method="POST">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="username" value="<?= isset($username)? $username: ''; ?>" placeholder="Username" id="inputEmail3"> <?php echo isset($input_array['input_user_error'])? '<label>'.$input_array['input_user_error'].'</label>':''; ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="password" class="form-control" name="password" value="<?= isset($username)? $username: ''; ?>" placeholder="Password" id="inputPassword3"> <?php echo isset($input_array['input_user_error'])? '<label>'.$input_array['input_user_error'].'</label>':''; ?>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" name="login" class="btn btn-warning">Sign In</button>
                    </div>

                    <p>If you don't have a user account, You can <a href="register.php">Register Here</a></p>

                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
        <script type="text/javascript">
    	$('.toast').toast('show')

    </script>
  </body>
</html>
