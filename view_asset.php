<?php
include 'db_connect.php';
session_start();


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
$sql = "SELECT * FROM assets";
$result = $conn->query($sql);

?>
<?php include 'header.php' ?>;
   <div class="content">
     <h2>Registered Assets</h2>
        <div class="card mt-4 shadow-ms">
            
            <div class="table-responsive">
                <table  id="datatablesSimple" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Asse tName</th>
                            <th>Serial Number</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                       <?php 
                          if ($result->num_rows > 0) {
                                while($Item = $result->fetch_assoc()) {
                                    
                          ?>
                        <tr>
                            <td><?= $Item['id'] ?></td>
                            <td><?= $Item['asset_name'] ?></td>
                            <td>
                                <?= $Item['serial_number'] ?>
                            </td>
                            <td>
                                <?= $Item['date'] ?>
                            </td>
                            <td><?= $Item['status'] ?></td>
                            <td>

                                <a href="#" class="btn btn-success">Edit</a>
                                <a 
                                    href="#" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Asset')">
                                    Delete
                                </a>
                            </td>
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
    </div>
<?php include 'footer.php' ?>;
