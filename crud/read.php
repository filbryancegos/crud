<?php
    require 'database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
    if ( null==$id ) {
        header("Location: index.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM customers_entry where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Read a Customer</h3>
                    </div>

                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['name'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Email Address</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['email'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Mobile Number</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['mobile'];?>
                            </label>
                        </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">Gender</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['gender'];?>
                            </label>
                        </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">Civil Status</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['status'];?>
                            </label>
                        </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">Nationality</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['nationality'];?>
                            </label>
                        </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">Address</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['address'];?>
                            </label>
                        </div>
                      </div>

                        <div class="form-actions">
                          <a class="btn btn-warning" href="index.php">Back</a>
                       </div>
                    </div>
                </div>

    </div> <!-- /container -->
  </body>
</html>
