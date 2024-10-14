<?php
require '../../Database.php';
function studentForm() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $course = $_POST['course'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $db = new Database();

        $result = $db->insertStudent($name, $age, $course, $email, $phone);
        if ($result) {            
            header("Location:../../index.php");
            exit(); 
        } else {
            echo "Error inserting student data: " . $result;
        }

        } else {
        echo "Form was not submitted properly.";
    }
}
studentForm();
?>
