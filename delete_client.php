<?php
include 'db.php';

if(isset($_GET['id'])){
  $id = $_GET['id'];
  $sql = "DELETE FROM clients WHERE id=$id";

  if($conn->query($sql) === TRUE){
    echo "Deleted Successfully! <a href='view_clients.php'>View Clients</a>";
  } else {
    echo "Error: " . $conn->error;
  }
}
?>
