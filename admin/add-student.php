<?php
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);

if($corepage !== 'index.php'){
    if($corepage == $corepage){
    $corepage = explode('.', $corepage);
    header('Location: index.php?page='.$corepage[0]);
}
}

if(isset($_POST['addstudent'])){
    $name = $_POST['name'];
    $reg = $_POST['reg'];
    $address = $_POST['address'];
    $pcontact = $_POST['pcontact'];
    $class = $_POST['class'];

    $photo = explode('.', $_FILES['photo']['name']);
    $photo = end($photo);
    $photo = $reg.date('Y-m-d-m-s').'.'.$photo;

    $query = "INSERT INTO `student_info`(`name`, `reg`, `class`, `city`, `pcontact`, `photo`) VALUES('$name', '$reg', '$class', '$address', '$pcontact', '$photo');";
    if(mysqli_query($db_connect, $query)){
        $datainsert['insertsuccess'] = '<p style="color:green;">Student Details Inserted!</p>';
        move_uploaded_file($_FILES['photo']['tmp_name'], 'images/'.$photo);
    }else{
        $datainsert['inserterror'] = '<p style="color:red;">Student Details Not Inserted. Please Enter Correct Information!</p>';
    }
}
?>

<h1 class="text-primary"><i class="fas fa-user-plus"></i>Add Student </h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="index.php">Dashboard</a></li>
    </ol>
</nav>

<div class="row">
    <div class="col-sm-6">
        <?php if(isset($datainsert)) {?>
       <div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="2000">
        <div class="toast-header">
            <strong class="mr-auto">Student Insert Alert</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="toast-body">
            <?php
            if(isset($datainsert['insertsuccess'])){
                echo $datainsert['insertsuccess'];
            }
            if(isset($datainsert['inserterror'])){
                echo $datainsert['inserterror'];
            }
            ?>
        </div>
        <?php } ?>

        <form action="" enctype="multipart/form-data" method="POST">
            <div class="form-group">
                <label for="name">Student Name</label>
                <input type="text" name="name" class="form-control" id="name" value="<?= isset($name)? $name: '' ; ?>" required="">
            </div>

            <div class="form-group">
                <label for="reg">Student Registration Number</label>
                <input type="text" name="reg" class="form-control" id="reg" value="<?= isset($reg)? $reg: '' ; ?>" required="">
            </div>

            <div class="form-group">
                <label for="name">Student Address</label>
                <input type="text" name="address" class="form-control" id="address" value="<?= isset($address)? $address: '' ; ?>" required="">
            </div>

            <div class="form-group">
                <label for="name">Parent/Guardian Contact No.</label>
                <input type="text" name="pcontact" class="form-control" id="pcontact" value="<?= isset($pcontact)? $pcontact: '' ; ?>" required="">
            </div>

            <div class="form-group">
		    <label for="class">Student Class</label>
		    <select name="class" type="text" class="form-control" id="class"  value="<?= isset($class)? $class: '' ; ?>" required="">
                <option value="" selected disabled>Select</option>
                <!-- <option value="4th"></option> -->
                <option value="1st">1st</option>
                <option value="2nd">2nd</option>
                <option value="3rd">3rd</option>
                <option value="4th">4th</option>
            </select>
	  	</div>
        <div class="form-group">
            <label for="photo">Student Photo</label>
            <input type="file" name="photo" class="form-control" id="photo" required="">
        </div>

        <div class="form-group text-center">
            <input type="submit" name="addstudent" value="Add Student" class="btn btn-danger">
        </div>

        </form>
       
    </div>
    
</div>

