<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "responsi_web";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete data based on ID
if (isset($_POST['delete'])) {
    $id_to_delete = $_POST['id'];
    $delete_sql = "DELETE FROM nama_tabel WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $id_to_delete);
    $stmt->execute();
    $stmt->close();
}

// Create SELECT query
$sql = "SELECT * FROM nama_tabel";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Booking</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: url('images/bg booking.jpeg') no-repeat center center fixed;
            background-size: cover;
            color: #f8f9fa;
            /* Light color for text */
            padding: 20px;

        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.7);
            color: #FFCC00;
            font-family: 'Georgia', serif;
            font-size: 2.5em;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .table-container {
            margin: 20px auto;
            background: rgba(255, 165, 0, 0.9);
            /* Soft orange background for table */
            padding: 20px;
            /* Padding around the table */
            border-radius: 10px;
            /* Rounded corners */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            /* Enhanced shadow for depth */
        }

        th,
        td {
            text-align: center;
        }

        .btn-delete {
            background-color: #FF5733;
            /* Warm red for delete button */
            color: white;
        }

        .btn-delete:hover {
            background-color: #C70039;
            /* Darker red on hover */
        }

        .no-data {
            text-align: center;
            color: #FFCC00;
            /* Soft yellow for no data message */
        }
    </style>
</head>

<body>
    <h1>Daftar Booking</h1>
    <div class="container table-container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Umur</th>
                    <th>Asal</th>
                    <th>Gunung</th>
                    <th>Basecamp</th>
                    <th>Jumlah Rombongan</th>
                    <th>Leader Rombongan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . $row["id"] . "</td>
                            <td>" . $row["nama"] . "</td>
                            <td>" . $row["umur"] . "</td>
                            <td>" . $row["asal"] . "</td>
                            <td>" . $row["gunung"] . "</td>
                            <td>" . $row["basecamp"] . "</td>
                            <td>" . $row["jumlah_rombongan"] . "</td>
                            <td>" . $row["leader_rombongan"] . "</td>
                            <td>
                                <form method='post' style='display:inline;'>
                                    <input type='hidden' name='id' value='" . $row["id"] . "'>
                                    <button type='submit' name='delete' class='btn btn-delete'>Hapus</button>
                                </form>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9' class='no-data'>Tidak ada data.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>