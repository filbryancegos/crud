<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <h3>SAMPLE PHP CRUD</h3>
        </div>
        <div class="row">
            <p><a href="create.php" class="btn btn-success">Create</a></p>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                    <th>Name</th>
                    <th>Email Address</th>
                    <th>Mobile Number</th>
                    <th>Gender</th>
                    <th>Civil Status</th>
                    <th>Nationality</th>
                    <th>Address</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'database.php';
                    $bryan = Database::connect();
                    $customer_sql = 'SELECT * FROM customers_entry ORDER BY id ASC';
                    foreach ($bryan->query($customer_sql) as $row) {
                    echo '<tr>';
                    echo '<td>'. $row['name'] . '</td>';
                    echo '<td>'. $row['email'] . '</td>';
                    echo '<td>'. $row['mobile'] . '</td>';
                    echo '<td>'. $row['gender'] . '</td>';
                    echo '<td>'. $row['status'] . '</td>';
                    echo '<td>'. $row['nationality'] . '</td>';
                    echo '<td>'. $row['address'] . '</td>';
                    echo '<td width=250>';
                    echo '<a class="btn btn-success" href="read.php?id='.$row['id'].'">Read</a>';
                    echo ' ';
                    echo '<a class="btn btn-primary" href="update.php?id='.$row['id'].'">Update</a>';
                    echo ' ';
                    echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Delete</a>';
                    echo '</td>';
                    echo '</tr>';
                    }
                    Database::disconnect();
                    ?>
                </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>
