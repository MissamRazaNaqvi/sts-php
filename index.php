<?php
require 'Database.php';
$students = $db->getAllStudents();

 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Management System</title>
    <link rel="stylesheet" href="styles.css" />
    <!-- Link to your CSS file -->
  </head>
  <body>
    <h1>Student Management System</h1>

    <div class="search-container">
      <input
        type="text"
        id="search"
        placeholder="Search for students..."
        onkeyup="searchTable()"
      />
      <button onclick="window.location.href='src/student/student_form.html'">
        Add New Student
      </button>
    </div>

    <table id="studentTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Age</th>
          <th>Course</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($students as $student): ?>
        <tr>
          <td><?php echo $student['id']; ?></td>
          <td><?php echo $student['name']; ?></td>
          <td><?php echo $student['age']; ?></td>
          <td><?php echo $student['course']; ?></td>
          <td><?php echo $student['email']; ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <script>
      function searchTable() {
        const searchInput = document
          .getElementById("search")
          .value.toLowerCase();
        const table = document.getElementById("studentTable");
        const rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) {
          // Start from 1 to skip the header
          const cells = rows[i].getElementsByTagName("td");
          let rowContainsSearch = false;

          for (let j = 0; j < cells.length; j++) {
            if (cells[j].innerText.toLowerCase().includes(searchInput)) {
              rowContainsSearch = true;
              break;
            }
          }

          rows[i].style.display = rowContainsSearch ? "" : "none";
        }
      }
    </script>
  </body>
</html>
