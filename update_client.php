<?php
include 'db.php';

if(isset($_GET['id'])){
  $id = $_GET['id'];
  $sql = "SELECT * FROM clients WHERE id=$id";
  $result = $conn->query($sql);

  if($result->num_rows > 0){
    $row = $result->fetch_assoc();
  } else {
    echo "No record found!";
    exit;
  }
}

if(isset($_POST['update'])){
  $client_name = $_POST['client_name'];
  $contact_number = $_POST['contact_number'];
  $address = $_POST['address'];
  $project_reg_date = $_POST['project_reg_date'];
  $nature_of_work = $_POST['nature_of_work'];
  $meeting_dates = $_POST['meeting_dates'];
  $completion_date = $_POST['completion_date'];
  $project_report = $_POST['project_report'];

  $sql = "UPDATE clients SET 
    client_name='$client_name',
    contact_number='$contact_number',
    address='$address',
    project_reg_date='$project_reg_date',
    nature_of_work='$nature_of_work',
    meeting_dates='$meeting_dates',
    completion_date='$completion_date',
    project_report='$project_report'
    WHERE id=$id";

  if($conn->query($sql) === TRUE){
    echo "<div class='container'><div class='alert alert-success mt-4'>✅ Updated Successfully! <a href='view_clients.php'>View Clients</a></div></div>";
  } else {
    echo "<div class='container'><div class='alert alert-danger mt-4'>❌ Error: " . $conn->error . "</div></div>";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Update Client | Client Portal</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container my-5">
    <div class="card shadow p-4">
      <h2 class="mb-4 text-primary">✏️ Update Client</h2>

      <form method="post" action="">
        <div class="mb-3">
          <label class="form-label">Client Name</label>
          <input type="text" name="client_name" class="form-control" value="<?php echo $row['client_name']; ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Contact Number</label>
          <input type="text" name="contact_number" class="form-control" value="<?php echo $row['contact_number']; ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Address</label>
          <input type="text" name="address" class="form-control" value="<?php echo $row['address']; ?>" required>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Project Registration Date</label>
            <input type="date" name="project_reg_date" class="form-control" value="<?php echo $row['project_reg_date']; ?>" required>
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label">Nature of Work</label>
            <input type="text" name="nature_of_work" class="form-control" value="<?php echo $row['nature_of_work']; ?>" required>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Meeting Dates</label>
          <textarea name="meeting_dates" class="form-control"><?php echo $row['meeting_dates']; ?></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Project Completion Date</label>
          <input type="date" name="completion_date" class="form-control" value="<?php echo $row['completion_date']; ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Project Report</label>
          <textarea name="project_report" class="form-control"><?php echo $row['project_report']; ?></textarea>
        </div>

        <button type="submit" name="update" class="btn btn-success">✅ Update Client</button>
        <a href="view_clients.php" class="btn btn-secondary">🔙 Back to Clients</a>
      </form>
    </div>
  </div>
</body>
</html>
