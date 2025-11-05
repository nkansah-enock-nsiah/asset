
<?php
include 'db_connect.php';
// add_asset.php
session_start();

/* Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}*/

// Database connection (will update when we create SQL DB)
$servername = "localhost";
$username = "root"; 
$password = "";     
$dbname = "asset_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $asset_name = trim($_POST['asset_name']);
    $asset_type = trim($_POST['asset_type']);
    $serial_number = trim($_POST['serial_number']);
    $purchase_date = trim($_POST['purchase_date']);
    $status = trim($_POST['status']);

    // Validate inputs
    if (empty($asset_name) || empty($asset_type) || empty($serial_number) || empty($purchase_date) || empty($status)) {
        $message = "<div class='alert alert-danger'>All fields are required.</div>";
    } else {
        $query = "INSERT INTO assets ( asset_name, asset_type, serial_number, date, status) VALUES ('$asset_name','$asset_type','$serial_number','$purchase_date','$status' )"; 
         $result = mysqli_query($conn, $query);

        if ($result) {
            $message = "<div class='alert alert-success'>Asset added successfully!</div>";
        } else {
            $message = "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        }
    }
}

$conn->close();
?>
<?php include 'header.php' ?>;

  <!-- Main Content -->
  <main class="content">
    <div class="card card-custom">
      <h4 class="card-title mb-3">➕ Add New Asset</h4>
      <?php echo $message; ?>
      <form action="add_asset.php" method="POST">
        
        <div class="mb-3">
          <label for="asset_name" class="form-label">Asset Name</label>
          <input type="text" name="asset_name" id="asset_name" class="form-control" placeholder="e.g. Dell Laptop, HP Printer" required>
        </div>

        <div class="mb-3">
          <label for="asset_type" class="form-label">Asset Type</label>
          <select name="asset_type" id="asset_type" class="form-select" required>
            <option value="">-- Select Type --</option>
            <option value="Laptop">Laptop</option>
            <option value="Desktop">Desktop</option>
            <option value="Printer">Printer</option>
            <option value="Projector">Projector</option>
            <option value="Mouse">Mouse</option>
            <option value="Keyboard">Keyboard</option>
            <option value="Other">Other</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="serial_number" class="form-label">Serial Number</label>
          <input type="text" name="serial_number" id="serial_number" class="form-control" placeholder="Enter serial number" required>
        </div>

        <div class="mb-3">
          <label for="purchase_date" class="form-label">Purchase Date</label>
          <input type="date" name="purchase_date" id="purchase_date" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <select name="status" id="status" class="form-select" required>
            <option value="">-- Select Status --</option>
            <option value="Available">Available</option>
            <option value="Assigned">Assigned</option>
            <option value="Under Maintenance">Under Maintenance</option>
          </select>
        </div>

        <button type="submit" class="btn btn-custom w-100">💾 Save Asset</button>
      </form>
    </div>
  </main>

<?php include 'footer.php' ?>;
