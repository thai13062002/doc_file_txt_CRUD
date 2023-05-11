<?php
require_once '../model/student.php';
require_once '../model/studentDAO.php';

if (isset($_POST['add'])) {
    // Tạo đối tượng DAO và đọc dữ liệu từ file students.txt
    $dao = new StudentDAO('../student.txt');
    $dao->readData();

    // Lấy thông tin từ form
    $name = $_POST['name'];
    $age = $_POST['age'];
    $grade = $_POST['grade'];

    // Tạo đối tượng Student mới với id được sinh ngẫu nhiên
    do {
        $id = rand(1000, 9999);
    } while ($dao->getById($id) !== null);

    $student = new Student($id, $name, $age, $grade);

    // Thêm sinh viên vào danh sách
    if ($dao->create($student)) {
        echo "<p>Thêm sinh viên thành công!</p>";
    } else {
        echo "<p>Thêm sinh viên không thành công!</p>";
    }
    header('Location: ../index.php');
}
