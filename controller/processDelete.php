<?php
    require_once '../model/student.php';
    require_once '../model/studentDAO.php';
    $dao = new StudentDAO('../student.txt');
    $id = $_GET['id'];
    if ($dao->delete($id)) {
        echo "<p>Xóa sinh viên thành công!</p>";
    } else {
        echo "<p>Xóa sinh viên không thành công!</p>";
    }
    header('Location: ../index.php');

?>