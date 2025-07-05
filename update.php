<?php 
include("connection.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = "";
$name = "";
$section = "";
$coursecode = "";
$prelim = "";
$midterm = "";
$finals = "";

$errorMessage = "";
$successMessage = "";

// Handle GET request (load student data for editing)
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location:/IT05,ELEC7/home.php");
        exit;
    }

    $id = $_GET["id"];
    $sql = "SELECT * FROM students WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location:/IT05,ELEC7/home.php");
        exit;
    }

    // Fill variables with data from database
    $name = $row["name"];
    $section = $row["section"];
    $coursecode = $row["coursecode"];
    $prelim = $row["prelim"];
    $midterm = $row["midterm"];
    $finals = $row["finals"];

} else {
    // Handle POST request (update logic)
    $id = $_POST["id"];
    $name = $_POST["name"];
    $section = $_POST["section"];
    $coursecode = $_POST["coursecode"];
    $prelim = $_POST["prelim"];
    $midterm = $_POST["midterm"];
    $finals = $_POST["finals"];

    do {
        if (empty($name) || empty($section) || empty($coursecode) || empty($prelim) || empty($midterm) || empty($finals)) {
            $errorMessage = "All fields are required!";
            break;
        }

        $sql = "UPDATE students SET name = ?, section = ?, coursecode = ?, prelim = ?, midterm = ?, finals = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $name, $section, $coursecode, $prelim, $midterm, $finals, $id);

        if (!$stmt->execute()) {
            $errorMessage = "Update failed: " . $stmt->error;
            break;
        }

        $successMessage = "Student updated successfully!";
        header("Location: /IT05,ELEC7/home.php");
        exit;

    } while (false);
}
?>




            
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Student</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="addpage.css">
</head>
<body>
    <div class="container mt-5" style="max-width: 700px;">
        <h1 class="text-center">Update Student</h1>
        <h3 class="text-center text-muted">Edit Details Below</h3>

        <?php if (!empty($errorMessage)): ?>
            <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
        <?php endif; ?>
            <img src="CRT2.jpg" alt="" style="position: relative; margin-bottom: -50px; height: 100px; width: 100px;"> 
        <form method="POST">

            <!-- Hidden ID field -->
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">


            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($name); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Section</label>
                <input type="text" name="section" class="form-control" value="<?php echo htmlspecialchars($section); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Course Code</label>
                <input type="text" name="coursecode" class="form-control" value="<?php echo htmlspecialchars($coursecode); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Prelim</label>
                <input type="text" name="prelim" class="form-control" value="<?php echo htmlspecialchars($prelim); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Midterm</label>
                <input type="text" name="midterm" class="form-control" value="<?php echo htmlspecialchars($midterm); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Finals</label>
                <input type="text" name="finals" class="form-control" value="<?php echo htmlspecialchars($finals); ?>">
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="home.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
