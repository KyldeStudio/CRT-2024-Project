<?php 
include("connection.php");
error_reporting(0);

$id="";

$name="";
$section="";
$coursecode="";
$prelim="";
$midterm="";
$finals="";

$errorMessage="";
$successMessage="";

if ( $_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET["id"])){
        header("location:/IT05,ELEC7/index.php");
        exit;
    }

        $id = $_GET["id"];

        $sql = "SELECT * FROM students WHERE id=$id";
        $result =$conn->query($sql);
        $row = $result->fetch_assoc();
    
    if (!$row){
        header("location:/IT05,ELEC7/index.php");
        exit;
    }

    $name = $row ["name"];
    $section = $row ["section"];
    $coursecode = $row ["coursecode"];
    $prelim = $row ["prelim"];
    $midterm = $row ["midterm"];
    $finals = $row ["finals"];
    

}
else {
    $id = $_POST ["id"];
    $name = $_POST["name"];
    $section = $_POST ["section"];
    $coursecode = $_POST ["coursecode"];
    $prelim = $_POST ["prelim"];
    $midterm = $_POST ["midterm"];
    $finals = $_POST ["finals"];

    do {
        if (empty($name) ||empty($section) ||empty($coursecode) ||empty($prelim) ||empty($midterm)||empty($finals) ){
            $errorMessage = "All field are required!";
            break;
        }

                $sql = "UPDATE students 
                SET name = '$name', 
                    section = '$section', 
                    coursecode = '$coursecode', 
                    prelim = '$prelim',
                    midterm = '$midterm',
                    finals = '$finals'
                WHERE id = $id";

                $result = $conn->query($sql);

                if(!$result) {
                    $errorMessage = "Invalid query: " . $conn->error;
                    break;
                }

                $successMessage = "Students updated correctly!";

                header("location:/IT05,ELEC7/index.php");
                exit;
    } while(false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add </title>
    <link rel="stylesheet" href="add.css">

</head>
<body>
    <div>
        <h1>EDIT STUDENTS</h1>
        <h3>Edit Details</h3>
        <?php 
        if(!empty($errorMessage)){
            echo"
            <div>
                <div class='alert alert-success alert-dismissable fade show' role='alert' id='notif'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' id='btnx'>x</button>
                </div>
            </div>
            ";
        }
        ?>

        <form method="POST">
            <input type="hidden" name="id" id="" value="<?php echo $id;?>">
            <div>
            <label for="">Name</label>
            <div>
                <input type="text" name="name" id="" value="<?php echo$name?>">
            </div>
            </div>

            <div>
            <label for="">Section</label>
            <div>
                <input type="text" name="section" id="" value="<?php echo$section?>">
            </div>
            </div>

            <div>
            <label for="">Course Code</label>
            <div>
                <input type="text" name="coursecode" id="" value="<?php echo$coursecode?>">
            </div>
            </div>

            <div>
            <label for="">Prelim</label>
            <div>
                <input type="text" name="prelim" id="" value="<?php echo$prelim?>">
            </div>
            </div>

            <div>
            <label for="">Midterm</label>
            <div>
                <input type="text" name="midterm" id="" value="<?php echo$midterm?>">
            </div>
            </div>

            <div>
            <label for="">Finals</label>
            <div>
                <input type="text" name="finals" id="" value="<?php echo$finals?>">
            </div>
            </div>

            <?php 
        if(!empty($successMessage)){
            echo"
            <div>
                <div class='alert alert-success alert-dismissable fade show' role='alert'>
                    <strong>$successMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>x</button>
                </div>
            </div>
            ";
        }
        ?>

            <div class="btn">

                    <button type="submit" class="submitbtn">Submit</button>
                    

                    <a href="index.php">Cancel</a>
            </div>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js">
    </script>

</body>
</html>