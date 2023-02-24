<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Enrollment System</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container"><br>
        <a class="btn btn-primary float-right" href="admin/login.php">Login</a>
        <h1 class="text-center">Welcome To Student Enrollment System</h1>

        <div class="row">
            <div class="col-md-4 offset-md-4">
                <form action="" method="post">
            <table class="text-center infotable">
                <tr>
                    <th colspan="2">
                        <p class="text-center">student Information</p>
                    </th>
                </tr>
                <td>
                    <p>Choose Class</p>
                </td>
                
                <td>
                    <select name="" id="" class="form-control" name="choose">

                        <option value="1st year">1st Year</option>

                        <option value="2nd year">2nd Year</option>

                        <option value="3rd year">3rd Year</option>

                        <option value="4th year">4th Year</option>
                    </select>
                </td>
                </tr>

                <tr>
                    <td>
                        <p><label for="reg">Registration Number</label></p>
                    </td>
                    <td>
                        <input type="text" class="form-control" id="reg" placeholder="Registration Number" name="reg">
                    </td>
                </tr>

                <tr>
                    <td colspan="2" class="text-center">
                       <input type="submit" class="btn bt-danger" name="showinfo">
                    </td>
                </tr>
            </table>
        </form>
    </div>
        </div>
        <br>

        <?php if (isset($_POST['showinfo'])){
            $choose = $_POST['choose'];
            $reg = $_POST['reg'];

            if(!empty($choose && $reg)){
                $query = mysqli_query($db_connect, "SELECT *FROM `student_info` WHERE `reg` = '$reg' AND `class` = '$choose'");

                if(!empty($row = mysqli_fetch_array($query))){
                    if($row['reg'] == $reg && $choose == $row['class']){
                        $student_registration = $row['reg'];
                        $student_name = $rom['name'];
                        $student_class = $row['class'];
                        $student_city = $row['city'];
                        $student_photo = $row['photo'];
                        $student_contact = $row['contact'];
                        ?>  
                        <div class="row">
                            <div class="col-sm-6 offset-sm-3">
                                <table class="table table-bordered">
                                    <tr>
                                        <td rowspan="5"><h3>Student Information</h3><img src="admin/images/<?= isset($photo)?$photo: '';?>" width="250px"></td>
                                        <td>Name</td>
                                        <td><?= isset($student_name)?$student_name: '';?></td>
                                    </tr>
                                    <tr>
                                    <td>Registration</td>
                                        <td><?= isset($student_registration)?$student_registration: '';?></td> 
                                    </tr>
                                    <tr>
                                    <td>Class</td>
                                        <td><?= isset($student_class
                                        )?$student_class: '';?></td>
                                    </tr>
                                    <tr>
                                    <td>City</td>
                                        <td><?= isset($student_city)?$student_city: '';?></td>
                                    </tr>
                                    <tr>
                                    <td>Submit Date</td>
                                        <td><?= isset($student_contact
                                        )?$student_contact: '';?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <?php
                    }else{
                        echo '<p style="color:red;>Please Enter A Valid Registration Number & Email</p>';
                    }
                    }else{
                        echo '<p style="color:red;>Your Input Doesn\'t match</p>';
                    }
                    }else{?>
                        <script>alert("Your Details Were Not Found");</script>
                        <?php }
                    }; ?>

                </div>
                  
                <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
   
</body>
</html>