<?php
require_once 'db_connect.php';
session_start();
if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];

    $photo = explode('.', $_FILES['photo']['name']);
    $photo = end($photo);
    $photo_name = $username.'.'.$photo;

    $input_error = array();
    if(empty($name)){
        $input_error['name'] = "The name field is required";
    }

   if(empty($email)){
        $input_error['name'] = "The Email field is required";
    }

    if(empty($username)){
        $input_error['name'] = "The Username field is required";
    }

    if(empty($password)){
        $input_error['name'] = "The Password field is required";
    }
    if(empty($photo)){
        $input_error['name'] = "The Photo field is required";
    }

    if(count($input_error) == 0){
        $check_email = mysqli_query($db_connect, "SELECT *FROM `users` WHERE `email` = '$email';");

        if(mysqli_num_rows($check_email) == 0){
            $check_username = mysqli_query($db_connect, "SELECT * FROM `users` WHERE `username` = '$username';");
            if(mysqli_num_rows($check_username) == 0){
                if(strlen($username) > 7){
                    $password = sha1(md5($password));
                    $query = "INSERT INTO `users`(`name`, `email`, `password`, `photo`, `status`)VALUES('$name', '$email', '$password', '$username', '$photo_name', 'inactive');";

                    $result = mysqli_query($db_connect, $query);
                    if($result){
                        move_uploaded_file($_FILES['photo']['tmp_name'], 'images/'.$photo_name);
                        header('Location: register.php?insert=success');
                    }else{
                        header('Location: register.php?insert=error');
                    }
                }else{
                    $password_length = "Password Should Be More Than 8 Characters";
                }
            }else{
                $username_length = "Username should be more than 8 characters";
            }
        }else{
            $username_error = "Username Already Exists"; 
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
        <h1 class="text-center">Please, Register</h1><hr><br>
        <div class="d-flex justify-content-center">
            <?php
                if(isset($_GET['insert'])){
                    if($_GET['insert']=='success'){ echo '<div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-success fade hide" data-delay="2000">Your Registration was successful!</div>';}
                }; ?>
        </div>
        <div class="row animate_animated animate_pulse">
            <div class="col-md-8 offset-md-2">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group column">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" value="<?= isset($name)? $name:'' ?>" name="name" placeholder="Name" id="inputEmail3"><?= isset($input_error['name'])? '<label for = "inputEmail3" class="error">'.$input_error['name'].'</label>': ""; ?>
                        </div>
                        <br>

                        <div class="col-sm-6">
                            <input type="email" class="form-control" value="<?= isset($email)? $email:'' ?>" name="email" placeholder="Email" id="inputEmail3"><?= isset($input_error['email'])? '<label class="error">'.$input_error['email'].'</label>': ""; ?>
                            <?= isset($email_error)? '<label class="error">'.$email_error.'</label>':''; ?>
                        </div>
            </div>

                        <div class="form-group column">
                            <div class="col-sm-4">
                            <input type="text" class="form-control" value="<?= isset($username)? $username:'' ?>" name="username" placeholder="Username" id="inputPassword3"><?= isset($input_error['username'])? '<label for = "inputEmail3" class="error">'.$input_error['email'].'</label>': ""; ?>
                            <?= isset($username_error)? '<label class="error">'.$username_error.'</label>':''; ?>
                            <?= isset($username_length)? '<label class="error">'.$username_length.'</label>':''; ?>
                        </div>
                        <br>

                        <div class="col-sm-4">
                            <input type="password" class="form-control" value="<?= isset($username)? $username:'' ?>" name="password" placeholder="Password" id="inputPassword3"><?= isset($input_error['password'])? '<label class="error">'.$input_error['password'].'</label>': ""; ?>
                            <?= isset($password_length)? '<label class="error">'.$password_length.'</label>':''; ?>
                        </div>
                        <br>

                        <div class="col-sm-4">
                            <input type="password" class="form-control" value="<?= isset($username)? $username:'' ?>" name="c_password" placeholder="Confirm Password" id="inputPassword3"><?= isset($input_error['notmatch'])? '<label class="error">'.$input_error['notmatch'].'</label>': ""; ?>
                            <?= isset($password_length)? '<label class="error">'.$password_length.'</label>':''; ?>
                        </div>
                        <br>
            </div>

                    <div class="column">
                        <div class="col-sm-3"><label for="photo">Choose Your Photo</label></div>
                        <div class="col-sm-9">
                            <input type="file" id="photo" name="photo" id="inputPassword3" class="form-control">
                            <br>
                        </div>
                    </div>
                    <div class="justify-content">
				      <button type="submit" name="register" class="btn btn-danger">Register!</button>
				    </div>
                </form>
            </div>
        </div>
        <p class="justify-content">Already Have An Account? You Can <a href="login.php">Login Here </a>To Your Account</p>
        </div>
    </div>

        <footer class="text-center">
            <p>Copyright &copy; Brian Ngoyarez <?php echo date('Y') ?></p>
        </footer>
         <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript">
    	$('.toast').toast('show')
    </script>
  </body>
</html>

    