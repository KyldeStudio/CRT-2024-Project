<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>
    <style>
        
table{
    background-color: rgb(255, 255, 255);
    color: rgb(0, 0, 0);
    width: 100%;
    border-spacing: 0;
    box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.6);
    
}

body {
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: start;
    align-items: center;
    background-color: #e1e1e1;
    font-family: Arial, sans-serif;
    display: flex;
    height: 100vh;
    margin: 0;
    flex-direction: column;
    background-color: #e6e6e6;
}

th {
    padding-right: 50px;
    padding-left: 50px;
    font-weight: bolder;
    border-bottom: 1px solid #887979;
    text-align: center;
    background-color: #1DA1F2;
    padding-top: 40px;
    padding-bottom: 10px;
    color: white;

    
}
td{
    border-bottom: 1px solid #747474;
    padding: 15px;
    margin-bottom: 10px;
    text-align: center;
    
    
}

thead img {
    width: 30px;
    

}
h2 {
    text-align: center;
}



.add-btn {
    padding: 15px 30px;
    margin-bottom: 10px;
    border-radius: 5px;
    background-color: #fff;
    border: #0000ff solid 1px;
    color: #0000ff;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
    font-size: 16px;
    font-weight: 600;
    box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.2);

}

.logbtn {
    padding: 15px 30px;
    margin-bottom: 10px;
    border-radius: 5px;
    background-color: #ff0000;
    border: #ff0000 solid 1px;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
    font-size: 14px;
    font-weight: 100;
    box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.2);

}

.add-btn:hover {
    border: solid 1px #000099;
    background-color: #eaeaea; 
    transform: scale(1.05); 
}
.add-btn:active {
    border: solid 1px #000066;
    background-color: #eaeaea; 
    transform: scale(0.95);
}
.div1{
    display: flex;
    flex-direction: column;
    align-items: start;
    outline: none;
}

.div2 img {
    height: 100px;
    width: 100px;
    position: relative;
    display: block;
    margin-left: auto;
    margin-right: auto;
    margin-right: 20px;
    margin-top: 20px;


}
.div2 {
    display: flex;
    flex-direction: row;
    align-items: center;
    margin-bottom: 10px;
}
#logoutModal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            z-index: 1000;
        }

        #modalBackdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .modal-button {
            padding: 10px 20px;
            margin: 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .yes-button {
            background-color: #336edd;
            color: white;
        }

        .no-button {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body>
        <div class="div1">
        <div class="div2"><img src="CRT2.jpg" alt=""> 
        <h1>LIST OF STUDENTS</h1></div>
        
        
        <div style="display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        ">
        <button class="add-btn" onclick="addBtn()">ADD</button>

        <!-- Search Form -->
        <form action="" method="POST" style="display: flex; gap: 10px;">
            <input type="text" name="search" id="" placeholder="Search"
            style="padding:15px;
            width:500px;
            margin-bottom:10px;
            border-radius: 3px;
            border: 1px solid #000;
            outline: none;
            box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.2);
            background-color: #eeeeee; 
            font-size:large;
            "
                value="<?php if(isset($_POST['search'])) { echo $_POST['search']; } ?>">
            <button type="submit" style="    padding: 10px 20px;
    background-color: #e6e6e6;
    margin-bottom: 10px;
    margin-left: -10px;
    border-radius: 3px;
    border: solid 1px #000;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
    font-size: 16px;
    font-weight: 600;
    box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.2);
    
    "><img src="search.png" alt="" style='width: 25px; height: 25px; padding: 0 5px;'></button>
        </form>

        <!-- Logout Link -->
    <button onclick="logbtn()" class="logbtn" id="logoutButton">LOGOUT</button>
        </div>

        <div id="modalBackdrop"></div>
    <div id="logoutModal">
        <p>Are you sure you want to logout?</p>
        <button class="modal-button yes-button" id="yesButton">Yes</button>
        <button class="modal-button no-button" id="noButton">No</button>
    </div>

    <!-- Delete Modal -->

    <div class="delete-modal" id="deleteModal" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 20px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); border-radius: 8px; z-index: 1000; display:none;
        ">
        <p>Are you sure you want to delete this record?</p>
        <button class="modal-button yes-button" id="yesDeleteButton">Yes</button>
        <button class="modal-button no-button" id="noDeleteButton">No</button>

    </div>

        <!-- Table -->
        <table>
            <thead>
                <th>Actions</th>
                <th>No.</th>
                <th>Name</th>
                <th>Section</th>
                <th>Course Code</th>
                <th>Prelim</th>
                <th>Midterm</th>
                <th>Finals</th>
                <th>Average</th>

            </thead>
            <tbody>
    <?php 
    include('connection.php');
    error_reporting(0);

    // Check if a search query is set
    $search_query = "";
    if (isset($_POST['search']) && $_POST['search'] != "") {
        $search_query = $_POST['search'];
        $sql = "SELECT * FROM students WHERE 
                name LIKE '%$search_query%' OR 
                section LIKE '%$search_query%' OR 
                coursecode LIKE '%$search_query%'";
    } else {
        $sql = "SELECT * FROM students";
    }

    $result = $conn->query($sql);

    if (!$result) {
        die("Invalid query: " . $conn->error);
    }

    // Check if there are any results
    if ($result->num_rows > 0) {
        // Displaying rows
        while ($row = $result->fetch_assoc()) {
            $prelim = $row['prelim']; // Assume 'prelim' column exists in the database
            $midterm = $row['midterm']; // Assume 'midterm' column exists in the database
            $finals = $row['finals']; // Assume 'finals' column exists in the database
            
            // Calculate weighted average
            $average = ($prelim * 0.3) + ($midterm * 0.3) + ($finals * 0.4);

            echo "<tr>
                    <td>
                        <a href='/IT05,ELEC7/update.php?id={$row['id']}' style='text-decoration:none;'>
                            <img src='edit.png' alt='Edit' style='width: 25px; height: 25px; padding: 0 5px;'>
                        </a>
                        <a href='/IT05,ELEC7/delete.php?id={$row['id']}' style='text-decoration:none;'>
                            <img src='bin.png' alt='Delete' style='width: 25px; height: 25px; padding: 0 5px;'>
                        </a>
                    </td>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['section']}</td>
                    <td>{$row['coursecode']}</td>
                    <td>{$prelim}</td>
                    <td>{$midterm}</td>
                    <td>{$finals}</td>
                    <td>" . number_format($average, 2) . "</td>
                </tr>";
        }
    } else {
        // No results found
        echo "<tr>
                <td colspan='8' style='text-align:center; padding:20px; font-size:16px; font-weight:bold; color:red;'>
                    No records found for '$search_query'
                </td>
            </tr>";
    }
    ?>
</tbody>
        </table>
    </div>

    <script>
        function addBtn() {
            window.location.href = "add.php";
        }
        const logoutButton = document.getElementById("logoutButton");
        const logoutModal = document.getElementById("logoutModal");
        const modalBackdrop = document.getElementById("modalBackdrop");
        const yesButton = document.getElementById("yesButton");
        const noButton = document.getElementById("noButton");
        

        logoutButton.addEventListener("click", () => {
            logoutModal.style.display = "block";
            modalBackdrop.style.display = "block";
        });
        
        yesButton.addEventListener("click", () => {

            window.location.href = "index.php";
            closeModal();
        });
        

        noButton.addEventListener("click", closeModal);
        
 
        function closeModal() {
            logoutModal.style.display = "none";
            modalBackdrop.style.display = "none";
        }
        const deleteModal = document.getElementById("deleteModal");
        const yesDeleteButton = document.getElementById("yesDeleteButton");
        const noDeleteButton = document.getElementById("noDeleteButton");
        const deleteLinks = document.querySelectorAll("a[href*='delete.php']");
        deleteLinks.forEach(link => {
            link.addEventListener("click", (event) => {
                event.preventDefault(); // Prevent the default link behavior
                deleteModal.style.display = "block";
                modalBackdrop.style.display = "block";
                const deleteUrl = link.getAttribute("href");

                yesDeleteButton.onclick = function() {
                    window.location.href = deleteUrl; // Redirect to the delete URL
                };
            });
        });


    </script>
</body>
</html>
