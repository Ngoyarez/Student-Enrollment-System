<?php
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if($corepage !== 'index.php'){
    if($corepage == $corepage){
        $corepage = explode('.', $corepage);
        header('Location: index.php?page='.$corepage[0]);
    }
}
?>
<h1 class="text-primary"><i class="fas fa-users"></i>All Students</h1>
<nav aria-label="braedcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="index.php">Dashboard</a>
        </li>

        <li class="breadcrumb-item active" aria-current="page">All Students
        </li>
    </ol>
</nav>

<?php if(isset($_GET['delete']) || isset($_GET['edit'])) {?>
    <div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="2000">
        <div class="toast-header">
            <strong class="mr-auto">Student Insert Alert</strong>
            <small><?php echo date('d-m-Y'); ?></small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="toast-body">
            <?php
            if(isset($_GET['delete'])){
                if($_GET['delete'] == 'success'){
                    echo "p style='color': green; font-weight: bold; '>Student Deleted Successfully!</p>";
                }
            }

            if(isset($_GET['delete'])){
                if($_GET['delete'] == 'error'){
                    echo "p style='color': red; font-weight: bold; '>Student Not Deleted!</p>";
                }
            }

            if(isset($_GET['edit'])){
                if($_GET['edit'] == 'success'){
                    echo "p style='color': green; font-weight: bold; '>Student Details Edited Successfully</p>";
                }
            }

            if(isset($_GET['edit'])){
                if($_GET['edit'] == 'error'){
                    echo "p style='color': red; font-weight: bold; '>Student Details Not Edited </p>";
                }
            }
            ?>
        </div>
        <?php }?>

        <table class="table table-striped table-bordered" id="data">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Number</th>
                    <th scope="col">Name</th>
                    <th scope="col">Reg</th>
                    <th scope="col">City</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            
            <tbody>
                <?php 
                $query = mysqli_query($db_connect, "SELECT* FROM `student_info` ORDER BY `student_info`.    `datetime` DESC");
                $i = 1;
                while($result = mysqli_fetch_array($query)) { ?>
                <tr>
                    <?php
                    echo '<td>'.$i.'</td> <td>'.ucwords($result['name']).'</td>
                    <td>'.$result['reg'].'</td>
                    <td>'.ucwords($result['city']).'</td>
                    <td>'.$result['student_contact'].'</td>
                    <td><img src="images/'.$result['photo'].'" height="50px"></td>
                    <td>
                        <a class="btn btn-xs btn-warning" href="index.php?page=editstudent&id='.base64_encode($result['id']).'&photo='.base64_encode($result['photo']).'">
                            <i class="fa fa-edit"></i></a>

                            &nbsp; <a class="btn btn-xs btn-danger" onclick="javascript:confirmationDelete($(this));return false;" href="index.php?page=delete&id='.base64_encode($result['id']).'&photo='.base64_encode($result['photo']).'">
                            <i class="fas fa-trash-alt"></i></a></td>';?>
            </tr>
            <?php $i++; } ?>
            </tbody>

                </table>
                <script>
                    function confirmDelete(anchor){
                        var conf = confirm('Are You sure you want to delete this record?');
                        if(conf){
                            window.location = anchor.atrr("href");
                        }
                    }
                </script>
