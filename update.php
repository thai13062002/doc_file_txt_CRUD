<!DOCTYPE html>
<html>

<head>
    <title>Sửa sinh viên mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>
<?php
    require_once './model/student.php';
    require_once './model/studentDAO.php';

    $dao = new StudentDAO('./student.txt');
    $dao->readData();
    $id = $_GET['id'];
    $student = $dao->getById($id);
?>

<body>
    <div class="container">
        <h1 class="text-center">Sửa sinh viên mới</h1>
        <form method="post" action="./controller/processUpdate.php?id=<?php echo $id; ?>">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Tên sinh viên</label>
                <input name="name" type="text" class="form-control" value="<?php echo $student->getName(); ?>" required>
            </div>
            <div class=" mb-3">
                <label for="exampleInputPassword1" class="form-label">Tuổi</label>
                <input name="age" type="text" class="form-control" value="<?php echo $student->getAge(); ?>"  id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Cấp</label>
                <input name="grade" type="text" class="form-control" value="<?php echo $student->getGrade(); ?>"  id="exampleInputPassword1">
            </div>
            <button name="update" type="submit" class="btn btn-primary">Thêm</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>