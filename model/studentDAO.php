<?php
class StudentDAO
{
  private $students;
  private $file;

  public function __construct($filename)
  {
    $this->students = array();
    $this->file = $filename;
  }

  // Đọc dữ liệu từ file và lưu vào mảng students
  public function readData()
  {
    $students = array();
    if (($handle = fopen($this->file, "r")) !== FALSE) {
      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        // Bỏ qua dòng đầu tiên
        if ($data[0] == 'id') {
          continue;
        }
        $student = new Student($data[0], $data[1], $data[2], $data[3]);
        array_push($students, $student);
      }
      fclose($handle);
    }
    return $students;
  }

  // Thêm sinh viên
  public function create($student)
  {
    // Mở file để ghi
    $fp = fopen($this->file, 'a+');
    if (!$fp) {
      return false; // Không mở được file
    }

    // Đặt con trỏ về cuối file
    fseek($fp, 0, SEEK_END);

    // Ghi đối tượng sinh viên vào file, cách nhau bằng dấu phẩy
    $line = $student->getId() . ',' . $student->getName() . ',' . $student->getAge() . ',' . $student->getGrade() . "\n";
    $result = fwrite($fp, $line);

    // Đóng file
    fclose($fp);

    return $result !== false; // Nếu ghi thành công, trả về true
  }

  // Lấy danh sách sinh viên
  public function getAll()
  {
    // Nếu mảng sinh viên chưa được đọc từ file thì đọc dữ liệu trước khi trả về
    if (empty($this->students)) {
      $this->students = $this->readData();
    }
    return $this->students;
  }

  // Lấy sinh viên theo id
  public function getById($id)
  {
    $students = $this->readData();
    foreach ($students as  $student) {
      if ($student->getId() == $id) {
        return $student;
      }
    }
    return null;
  }

  // Cập nhật sinh viên
  public function update($studentNEW)
  {
      $students = $this->readData();
      $found = false;
  
      foreach ($students as $student) {
          if ($student->getId() == $studentNEW->getId()) {
              $student->setName($studentNEW->getName());
              $student->setAge($studentNEW->getAge());
              $student->setGrade($studentNEW->getGrade());
              $found = true;
              break;
          }
      }
  
      if ($found) {
          $this->writeData($students);
          return true;
      } else {
          return false;
      }
  }
  

  public function writeData($students)
  {
      $file = fopen($this->file, 'w');
      foreach ($students as $student) {
          $line = $student->getId() . ',' . $student->getName() . ',' . $student->getAge() . ',' . $student->getGrade() . "\n";
          fwrite($file, $line);
      }
      fclose($file);
  }
  

  // Xóa sinh viên
  public function delete($id)
  {
    // Lấy danh sách sinh viên
    $students = $this->readData();

    // Tìm sinh viên có id trùng với $id và xóa khỏi mảng students
    foreach ($students as $key => $student) {
      if ($student->getId() == $id) {
        unset($students[$key]);
        break;
      }
    }

    // Mở file để ghi
    $fp = fopen($this->file, 'w+');
    if (!$fp) {
      return false; // Không mở được file
    }

    // Ghi lại danh sách sinh viên sau khi xóa
    fwrite($fp, "id,name,age,grade\n"); // Ghi lại dòng tiêu đề
    foreach ($students as $student) {
      $line = $student->getId() . ',' . $student->getName() . ',' . $student->getAge() . ',' . $student->getGrade() . "\n";
      fwrite($fp, $line);
    }

    // Đóng file
    fclose($fp);

    return true;
  }
}
