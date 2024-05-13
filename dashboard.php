<?php
 include '../db/db_connect.php';
session_start();


// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin.php");
    exit();
}

// Database connection
// $servername = "localhost";
// $username = "root";
// $password = "";
// $database = "contact";

// $conn = mysqli_connect($servername, $username, $password, $database);

// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }

// Pagination
$results_per_page = 10;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$start_index = ($page - 1) * $results_per_page;

// Retrieve search term if provided
$search_term = "";
if (isset($_GET['search'])) {
    $search_term = $_GET['search'];
}

// Retrieve total number of records
$sql_total_records = "SELECT COUNT(*) AS total_records FROM contact_messages";
if (!empty($search_term)) {
    $sql_total_records .= " WHERE name LIKE '%$search_term%' OR email LIKE '%$search_term%' OR phone LIKE '%$search_term%' OR message LIKE '%$search_term%'";
}
$result_total_records = mysqli_query($conn, $sql_total_records);
$row_total_records = mysqli_fetch_assoc($result_total_records);
$total_records = $row_total_records['total_records'];

// Calculate total pages
$total_pages = ceil($total_records / $results_per_page);

// Retrieve data with pagination and search term
$sql = "SELECT * FROM contact_messages ORDER BY created_at DESC";
if (!empty($search_term)) {
    $sql .= " WHERE name LIKE '%$search_term%' OR email LIKE '%$search_term%' OR phone LIKE '%$search_term%' OR message LIKE '%$search_term%'";
}
$sql .= " LIMIT $start_index, $results_per_page";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error retrieving data: " . mysqli_error($conn));
}

// Logout mechanism
if (isset($_GET['logout'])) {
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    header("Location: admin.php"); // Redirect to admin login page after logout
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" type="image/png" href="./assets/img/fav2.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .search-button {
            transition: all 0.3s;
        }

        .search-button:hover {
            transform: scale(1.1);
        }
        .logout-button {
            transition: all 0.3s;
        }

        .logout-button:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Dashboard</h2>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search..." value="<?php echo $search_term; ?>">
            <div class="input-group-append">
                <button class="btn btn-primary search-button" type="button" onclick="search()">Search</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // if (mysqli_num_rows($result) > 0) {
                    //     while ($row = mysqli_fetch_assoc($result)) {
                    //         echo "<tr>";
                    //         echo "<td>" . $row['id'] . "</td>";
                    //         echo "<td>" . $row['name'] . "</td>";
                    //         echo "<td>" . $row['email'] . "</td>";
                    //         echo "<td>" . $row['phone'] . "</td>";
                    //         echo "<td>" . $row['message'] . "</td>";
                    //         echo "<td>" . $row['created_at'] . "</td>";
                    //         echo "</tr>";
                    //     }
                    // } else {
                    //     echo "<tr><td colspan='6'>No records found</td></tr>";
                    // }
                    if (mysqli_num_rows($result) > 0) {
                        $counter = ($page - 1) * $results_per_page + 1; // Initialize counter
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $counter . "</td>"; // Display counter
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['phone'] . "</td>";
                            echo "<td>" . $row['message'] . "</td>";
                            echo "<td>" . $row['created_at'] . "</td>";
                            echo "</tr>";
                            $counter++; // Increment counter
                        }
                    } else {
                        echo "<tr><td colspan='6'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
if ($total_pages > 1) {
    echo "<ul class='pagination justify-content-center'>";
    // Previous button
    if ($page > 1) {
        echo "<li class='page-item'><a class='page-link' href='dashboard.php?page=".($page - 1)."&search=$search_term'>Previous</a></li>";
    } else {
        echo "<li class='page-item disabled'><span class='page-link'>Previous</span></li>";
    }
    // Page numbers
    $max_pages = 5; // Maximum number of page links to display
    $start_page = max(1, $page - floor($max_pages / 2));
    $end_page = min($total_pages, $start_page + $max_pages - 1);
    for ($i = $start_page; $i <= $end_page; $i++) {
        echo "<li class='page-item";
        if ($i == $page) {
            echo " active";
        }
        echo "'><a class='page-link' href='dashboard.php?page=$i&search=$search_term'>$i</a></li>";
    }
    // Next button
    if ($page < $total_pages) {
        echo "<li class='page-item'><a class='page-link' href='dashboard.php?page=".($page + 1)."&search=$search_term'>Next</a></li>";
    } else {
        echo "<li class='page-item disabled'><span class='page-link'>Next</span></li>";
    }
    echo "</ul>";
}
?>


        <div>Total results: <?php echo $total_records; ?></div>
        <div class="mt-3">
            <a href="?logout" class="btn btn-danger logout-button">Logout</a>
        </div>
    </div>
</body>
<script>
    function search() {
        var searchInput = document.querySelector('.form-control').value;
        window.location.href = "dashboard.php?search=" + searchInput;
    }
</script>
</html>
