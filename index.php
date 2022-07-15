<?php
include("function.php");

$objCrudAdmin = new crudApp();

if (isset($_POST['_btn'])) {
    $returnMsg = $objCrudAdmin->addData($_POST);
}

$students = $objCrudAdmin->display();

if (isset($_GET['status'])) {
    if ($_GET['status'] = 'delete') {
        $dlt_id = $_GET['id'];
        $del_msg = $objCrudAdmin->delete_data($dlt_id);
    }
}

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Crud App</title>
</head>

<body>
    <div class="container my-4 p-4 shadow">
        <h2><a style="text-decoration: none;" href="index.php"><b>All Student Database</b></a></h2>
        <form class="form" action="" method="POST" enctype="multipart/form-data">
            <?php
            if (isset($returnMsg)) {
                echo $returnMsg;
            }
            if (isset($del_msg)) {
                echo $del_msg;
            }
            ?>
            <input class="form-control mb-2" type="text" name="_name" placeholder="Enter Your Name">
            <input class="form-control mb-2" type="number" name="_roll" placeholder="Enter Your Roll">
            <lebel for="image">Upload Your Image</lebel>
            <input class="form-control mb-2" type="file" name="_img">
            <input type="submit" value="Add Information" name="_btn" class="form-control bg-warning">
        </form>
    </div>
    <div class="container my-4 p-4 shadow">
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Roll</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            <tbody>
                <?php while ($student = mysqli_fetch_assoc($students)) { ?>
                    <tr>
                        <td><?php echo $student['id']; ?></td>
                        <td><?php echo $student['name']; ?></td>
                        <td><?php echo $student['roll']; ?></td>
                        <td><img style="height: 100px;" src="upload/<?php echo $student['image']; ?>" alt=""></td>
                        <td>
                            <a class="btn btn-success" href="edit.php?status=edit&&id=<?php echo $student['id']; ?>">Edit</a>
                            <a class="btn btn-warning" href="?status=delete&&id=<?php echo $student['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
            </thead>
        </table>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>