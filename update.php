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

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location:/IT05,ELEC7/index.php");
        exit;
    }

    $id = $_GET["id"];
    $sql = "SELECT * FROM students WHERE id=?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if (!$row) {
            header("location:/IT05,ELEC7/index.php");
            exit;
        }

        $name = $row["name"];
        $section = $row["section"];
        $coursecode = $row["coursecode"];
        $prelim = $row["prelim"];
        $midterm = $row["midterm"];
        $finals = $row["finals"];
    }
} else {
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
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssssssi", $name, $section, $coursecode, $prelim, $midterm, $finals, $id);
            
            if (!$stmt->execute()) {
                $errorMessage = "Invalid query: " . $stmt->error;
                break;
            }

            $successMessage = "Student updated successfully!";
            header("Location: /IT05,ELEC7/index.php");
            exit;
        } else {
            $errorMessage = "Failed to prepare the statement!";
        }
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Students</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="addpage.css">
    
</head>
<body>
    <div class="container mt-5" style="width: 700px;" >
        <h1 class="text-center">Update Students</h1>
        <h3 class="text-center text-muted">Update Details</h3>

        
        
        <?php if (!empty($errorMessage)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?php echo $errorMessage; ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <img src="CRT2.jpg" alt=""> 
        <form method="POST" class="login-form">
            
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($name); ?>">
            </div>

            <div class="mb-3">
                <label for="section" class="form-label">Section</label>
                <input type="text" name="section" class="form-control" value="<?php echo htmlspecialchars($section); ?>">
            </div>

            <div class="mb-3">
                <label for="coursecode" class="form-label">Course Code</label>
                <input type="text" name="coursecode" class="form-control" value="<?php echo htmlspecialchars($coursecode); ?>">
            </div>

            <div class="mb-3">
                <label for="prelim" class="form-label">Prelim</label>
                <input type="text" name="prelim" class="form-control" value="<?php echo htmlspecialchars($prelim); ?>">
            </div>

            <div class="mb-3">
                <label for="midterm" class="form-label">Midterm</label>
                <input type="text" name="midterm" class="form-control" value="<?php echo htmlspecialchars($midterm); ?>">
            </div>

            <div class="mb-3">
                <label for="finals" class="form-label">Finals</label>
                <input type="text" name="finals" class="form-control" value="<?php echo htmlspecialchars($finals); ?>">
            </div>

            <?php if (!empty($successMessage)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><?php echo $successMessage; ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>