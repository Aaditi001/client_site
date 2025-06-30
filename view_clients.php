<?php
include 'db.php';

// Fetch clients
$sql = "SELECT * FROM clients";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>View Clients | Client Portal</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f1f3f4;
      font-family: 'Roboto', sans-serif;
    }
    .container {
      margin-top: 50px;
    }
    .table {
      background: #fff;
      border-collapse: separate;
      border-spacing: 0 10px;
    }
    th, td {
      vertical-align: middle !important;
      text-align: left;
      padding: 12px 20px !important;
    }
    thead {
      background-color: #1a73e8;
      color: #fff;
    }
    tbody tr {
      background: #fff;
      border-radius: 5px;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    tbody tr td {
      background: #fff;
    }
    .actions .btn {
      margin-right: 5px;
    }
  </style>
</head>
<body>

  <div class="container">
    <h2 class="mb-4">📋 Client Details</h2>

    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Client Name</th>
            <th>Contact</th>
            <th>Address</th>
            <th>Reg. Date</th>
            <th>Nature of Work</th>
            <th>Meeting Dates</th>
            <th>Completion Date</th>
            <th>Project Report</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>".$row['id']."</td>";
              echo "<td>".$row['client_name']."</td>";
              echo "<td>".$row['contact_number']."</td>";
              echo "<td>".$row['address']."</td>";
              echo "<td>".$row['project_reg_date']."</td>";
              echo "<td>".$row['nature_of_work']."</td>";
              echo "<td>".$row['meeting_dates']."</td>";
              echo "<td>".$row['completion_date']."</td>";

              // Project report link
              if (!empty($row['project_report'])) {
                echo "<td><a href='uploads/".$row['project_report']."' target='_blank'>📄 Download</a></td>";
              } else {
                echo "<td>—</td>";
              }

              // Actions buttons
              echo "<td class='actions'>
                      <a href='edit_client.php?id=".$row['id']."' class='btn btn-sm btn-warning'>✏️ Edit</a>
                      <a href='delete_client.php?id=".$row['id']."' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure?\")'>🗑️ Delete</a>
                    </td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='10'>No clients found.</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>

    <a href="add_client.php" class="btn btn-primary mt-3">➕ Add New Client</a>
    <a href="index.php" class="btn btn-outline-secondary ms-2 mt-3">🏠 Back to Home</a>
  </div>

</body>
</html>
