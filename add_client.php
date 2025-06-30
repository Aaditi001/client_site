<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Add New Client | Client Portal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f1f3f4;
      font-family: 'Roboto', sans-serif;
    }
    .form-card {
      max-width: 700px;
      margin: 50px auto;
      background: #fff;
      padding: 50px 60px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    .form-title {
      font-size: 30px;
      font-weight: 700;
      margin-bottom: 35px;
      color: #202124;
    }
    .form-label {
      font-weight: 500;
      margin-bottom: 8px;
    }
    .form-control {
      border: none;
      border-bottom: 2px solid #dadce0;
      border-radius: 0;
      padding-left: 0;
      box-shadow: none !important;
      transition: all 0.3s;
    }
    .form-control:focus {
      border-color: #1a73e8;
      box-shadow: none;
    }
    .mb-4 {
      margin-bottom: 30px !important;
    }
    .btn-primary {
      background-color: #1a73e8;
      border: none;
    }
    .btn-primary:hover {
      background-color: #1669c1;
    }
  </style>
</head>
<body>

  <div class="form-card">
    <div class="form-title">➕ Add New Client</div>

    <!-- IMPORTANT: enctype added -->
    <form method="post" action="" enctype="multipart/form-data">
      <div class="mb-4">
        <label class="form-label">Client Name</label>
        <input type="text" name="client_name" class="form-control" required>
      </div>

      <div class="mb-4">
        <label class="form-label">Contact Number</label>
        <input type="text" name="contact_number" class="form-control" required>
      </div>

      <div class="mb-4">
        <label class="form-label">Address</label>
        <input type="text" name="address" class="form-control" required>
      </div>

      <div class="mb-4">
        <label class="form-label">Project Registration Date</label>
        <input type="date" name="project_reg_date" class="form-control" required>
      </div>

      <div class="mb-4">
        <label class="form-label">Nature of Work</label>
        <input type="text" name="nature_of_work" class="form-control" required>
      </div>

      <div class="mb-4">
        <label class="form-label">Meeting Dates</label>
        <textarea name="meeting_dates" class="form-control" rows="2"></textarea>
      </div>

      <div class="mb-4">
        <label class="form-label">Project Completion Date</label>
        <input type="date" name="completion_date" class="form-control">
      </div>

      <div class="mb-4">
        <label class="form-label">Project Report (Upload PDF/Word)</label>
        <input type="file" name="project_report_file" class="form-control" accept=".pdf,.doc,.docx">
      </div>

      <button type="submit" name="submit" class="btn btn-primary px-4">Submit</button>
      <a href="index.php" class="btn btn-outline-secondary ms-2 px-4">🏠 Back to Home</a>
      <a href="view_clients.php" class="btn btn-outline-info ms-2 px-4">📋 View Client Details</a>
    </form>

    <?php
    if(isset($_POST['submit'])){
      $client_name = $_POST['client_name'];
      $contact_number = $_POST['contact_number'];
      $address = $_POST['address'];
      $project_reg_date = $_POST['project_reg_date'];
      $nature_of_work = $_POST['nature_of_work'];
      $meeting_dates = $_POST['meeting_dates'];
      $completion_date = $_POST['completion_date'];

      // File Upload
      $file_name = $_FILES['project_report_file']['name'];
      $file_tmp = $_FILES['project_report_file']['tmp_name'];
      $upload_dir = "uploads/";

      if(!is_dir($upload_dir)){
        mkdir($upload_dir, 0777, true);
      }

      if(!empty($file_name)){
        move_uploaded_file($file_tmp, $upload_dir . $file_name);
      }

      $sql = "INSERT INTO clients (client_name, contact_number, address, project_reg_date, nature_of_work, meeting_dates, completion_date, project_report)
              VALUES ('$client_name', '$contact_number', '$address', '$project_reg_date', '$nature_of_work', '$meeting_dates', '$completion_date', '$file_name')";

      if($conn->query($sql) === TRUE){
        echo "<div class='alert alert-success mt-4'>✅ Client added successfully with file!</div>";
      } else {
        echo "<div class='alert alert-danger mt-4'>❌ Error: " . $conn->error . "</div>";
      }
    }
    ?>
  </div>

</body>
</html>
