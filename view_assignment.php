<?php
include 'db_connect.php';
session_start();
/*
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}*/

// Database connection
$servername = "localhost";
$username = "root"; // default username
$password = "";     // default password is empty
$dbname = "asset_db"; // our database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check DB connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all assets
$sql = "SELECT * FROM asset_assignments";
$result = $conn->query($sql);


?>

<?php include 'header.php' ?>;

   <div class="content">
    <div class="card card-custom">
      <h4 class="card-title mb-3">📑 View Assignments</h4>
      <table class="table table-striped table-bordered">
        <thead class="table-dark">
          <tr>
            <th>Assignment ID</th>
            <th>Asset Name</th>
            <th>Assigned To</th>
            <th>Assignment Date</th>
            <th>Purpose</th>
          </tr>
        </thead>
        <tbody>
                       
            <?php 
                if ($result->num_rows > 0) {
                    while($Item = $result->fetch_assoc()) {
                        
                ?>
            <tr>
                <td><?= $Item['id'] ?></td>
                <td><?= $Item['name'] ?></td>
                <td>
                    <?= $Item['department'] ?>
                </td>
                <td>
                    <?= $Item['date'] ?>
                </td>
                <td><?= $Item['purpose'] ?></td>
            </tr>
            <?php
                        }
                } else {
                    echo "<p>No assets found.</p>";
                }
            ?>  
            
        </tbody>
      </table>
    </div>
  </div>

<?php include 'footer.php' ?>;