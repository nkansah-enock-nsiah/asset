<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root"; 
$password = "";     
$dbname = "asset_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

/* Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login if not logged in
    header("Location: login.php");
    exit(); 
}*/
?>

<?php include 'header.php' ?>;

 <div class="content">
    <h2 class="mb-4">Dashboard</h2>
    <div class="row">
      <!-- Total Assets -->
      <div class="col-md-4 mb-3">
        <?php
            $query = "SELECT * FROM assets";
          $query_run = mysqli_query($conn, $query);
          if($query_run)
          {
        $totalCount = mysqli_num_rows($query_run);
          }
         ?>
        <div class="card card-custom p-3">
          <h5 class="card-title">Total Assets</h5>
          <p class="display-6 text-primary"><?= $totalCount ?></p>
        </div>
      </div>
      <!-- Assigned Assets -->
      <div class="col-md-4 mb-3">
         <?php
            $query = "SELECT * FROM asset_assignments ";
          $query_asset = mysqli_query($conn, $query);
          if($query_asset)
          {
        $assingCount = mysqli_num_rows($query_asset);
          }else{
            $assingCount = '0';
          }
         ?>
        <div class="card card-custom p-3">
          <h5 class="card-title">Assigned Assets</h5>
          <p class="display-6 text-success"><?= $assingCount ?></p>
        </div>
      </div>
      <!-- Available Assets -->
      <div class="col-md-4 mb-3">
         <?php
            $query = "SELECT * FROM assets where status='available'";
          $query_run = mysqli_query($conn, $query);
          if($query_run)
          {
        $availableCount = mysqli_num_rows($query_run);
          }else{
            $availableCount = '0';
          }
         ?>
        <div class="card card-custom p-3">
          <h5 class="card-title">Available Assets</h5>
          <p class="display-6 text-warning"><?= $availableCount ?></p>
        </div>
      </div>
    </div>

    <!-- Recent Assignments Table -->
    <div class="card card-custom mt-4 p-3">
      <h5 class="card-title mb-3">Recent Assignments</h5>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Asset Name</th>
            <th>Assigned To</th>
            <th>Date</th>
            <th>Purpose</th>
          </tr>
        </thead>
        <tbody>
          
          <?php 
            if ($query_asset->num_rows > 0) {
                  while($Item = $query_asset->fetch_assoc()) {
                      
            ?>
          <tr>
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
