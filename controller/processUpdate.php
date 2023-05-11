<?php
require_once '../model/student.php';
require_once '../model/studentDAO.php';

$dao = new StudentDAO('../student.txt');

if(isset($_POST['update'])) {
    $id = $_GET['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $grade = $_POST['grade'];

    $studentNEW = new Student($id, $name, $age, $grade);

    if ($dao->update($studentNEW)) {
        header('Location: ../index.php');
        exit();
    } else {
        echo "Cập nhật thất bại!";
    }
}
?>
