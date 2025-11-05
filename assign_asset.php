<?php
include 'db_connect.php';
// assign_asset.php
session_start();

/* Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}*/

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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $asset_name = $_POST['asset_name'];
    $department = trim($_POST['department']);
    $assigned_date = trim($_POST['date']);
    $purpose = trim($_POST['purpose']);

    if (empty($asset_name)|| empty($department) || empty($assigned_date) || empty($purpose)) {
        $message = "<div class='alert alert-danger'>All fields are required.</div>";
    } else {
        // Insert into assignments table
        $query = "INSERT INTO asset_assignments ( name, department, date, purpose) VALUES ('$asset_name','$department','$assigned_date','$purpose')"; 
         $result = mysqli_query($conn, $query);

        if ($result) {
            // Update asset status to "Assigned"
            $update_sql = "UPDATE assets SET status = 'Assigned' WHERE asset_name = '$asset_name'";
             $update = mysqli_query($conn, $query);

            $message = "<div class='alert alert-success'>Asset assigned successfully!</div>";
        } else {
            $message = "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        }

       
    }
}

// Fetch available assets for dropdown
$assets = [];
$sql = "SELECT asset_name FROM assets WHERE status = 'Available'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $assets[] = $row;
    }
}
$conn->close();
?>

<?php include 'header.php' ?>;

<main class="content">
    <div class="card card-custom">
      <h4 class="card-title mb-3">📝 Assign Asset</h4>
      <?php echo $message; ?>
      <form action="assign_asset.php" method="POST">
        
         <div class="mb-3">
            <label class="form-label">Select Asset</label>
            <select name="asset_name" id="asset_name" class="form-select" required>
              <option value="">-- Select Asset --</option>
              <?php foreach ($assets as $asset): ?>
                <option value="<?php echo $asset['asset_name']; ?>">
                  <?php echo $asset['asset_name'] ; ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

        <div class="mb-3">
          <label for="assigned_to" class="form-label">Assigned To</label>
          <input type="text" name="department" id="department" class="form-control" placeholder="Enter staff name" required>
        </div>

        <div class="mb-3">
          <label for="assignment_date" class="form-label">Assignment Date</label>
          <input type="date" name="date" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="purpose" class="form-label">Purpose</label>
          <textarea name="purpose" class="form-control" placeholder="Enter purpose of assignment" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-custom w-100">Assign Asset</button>
      </form>
    </div>
</main>
  
<?php include 'footer.php' ?>;
