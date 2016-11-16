
<?php
    require 'database.php';

    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

    if ( null==$id ) {
        header("Location: index.php");
    }

    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $emailError = null;
        $mobileError = null;
        $genderError = null;
        $statusError = null;
        $nationalityError = null;
        $addressError = null;

        // keep track post values
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $gender = $_POST['gender'];
        $status = $_POST['status'];
        $nationality = $_POST['nationality'];
        $address = $_POST['address'];

        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }

        if (empty($email)) {
            $emailError = 'Please enter Email Address';
            $valid = false;
        } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $emailError = 'Please enter a valid Email Address';
            $valid = false;
        }

        if (empty($mobile)) {
            $mobileError = 'Please enter Mobile Number';
            $valid = false;
        } else if (!is_numeric($mobile)) {
            $mobileError = 'Data entered was not numeric';
            $valid = false;
        } else if (strlen($mobile) !=6) {
            $mobileError = 'The number entered was not a 6 digits long';
            $valid = false;
        }


        if (empty($gender)) {
            $genderError = 'Please enter your Gender';
            $valid = false;
        }

        if (empty($status)) {
            $statusError = 'Please enter your Status';
            $valid = false;
        }

        if (empty($nationality)) {
            $nationalityError = 'Please enter your Nationality';
            $valid = false;
        }

        if (empty($address)) {
            $addressError = 'Please enter your Address';
            $valid = false;
        }

        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE customers_entry  set name = ?, email = ?, mobile = ?, gender = ?, status = ?, nationality = ?, address = ? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$email,$mobile,$gender,$status,$nationality,$address,$id));
            Database::disconnect();
            header("Location: index.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM customers_entry where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $name = $data['name'];
        $email = $data['email'];
        $mobile = $data['mobile'];
        $gender = $data['gender'];
        $status = $data['status'];
        $nationality = $data['nationality'];
        $address = $data['address'];
        Database::disconnect();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="col-sm-12">
            <div class="row">
                <h3>Update a Customer</h3>
            </div>
            <form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
              <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                <label class="control-label">Name</label>
                <div class="controls">
                    <input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
                    <?php if (!empty($nameError)): ?>
                        <span class="help-inline"><?php echo $nameError;?></span>
                    <?php endif; ?>
                </div>
              </div>
              <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                <label class="control-label">Email Address</label>
                <div class="controls">
                    <input name="email" type="text" placeholder="Email Address" value="<?php echo !empty($email)?$email:'';?>">
                    <?php if (!empty($emailError)): ?>
                        <span class="help-inline"><?php echo $emailError;?></span>
                    <?php endif;?>
                </div>
              </div>
              <div class="control-group <?php echo !empty($mobileError)?'error':'';?>">
                <label class="control-label">Mobile Number</label>
                <div class="controls">
                    <input name="mobile" type="text"  placeholder="Mobile Number" value="<?php echo !empty($mobile)?$mobile:'';?>">
                    <?php if (!empty($mobileError)): ?>
                        <span class="help-inline"><?php echo $mobileError;?></span>
                    <?php endif;?>
                </div>
              </div>

              <div class="control-group <?php echo !empty($genderError)?'error':'';?>">
                <label class="control-label">Gender</label>
                <div class="controls">
                    <input type="radio" name="gender" <?php if (isset($gender) && $gender=="Female") echo "checked";?> value="Female">Female
                    <input type="radio" name="gender" <?php if (isset($gender) && $gender=="Male") echo "checked";?> value="Male">Male
                    <?php if (!empty($genderError)): ?>
                        <span class="help-inline"><?php echo $genderError;?></span>
                    <?php endif;?>
                </div>
              </div>

              <div class="control-group <?php echo !empty($statusError)?'error':'';?>">
                <label class="control-label">Stutus</label>
                <div class="controls">
                    <input type="radio" name="status" <?php if (isset($status) && $status=="Single") echo "checked";?> value="Single">Single
                    <input type="radio" name="status" <?php if (isset($status) && $status=="Maried") echo "checked";?> value="Maried">Maried
                    <?php if (!empty($statusError)): ?>
                        <span class="help-inline"><?php echo $statusError;?></span>
                    <?php endif;?>
                </div>
              </div>

              <div class="control-group <?php echo !empty($nationalityError)?'error':'';?>">
                <label class="control-label">Nationality</label>
                <div class="controls">
                    <input name="nationality" type="text"  placeholder="Nationality" value="<?php echo !empty($nationality)?$nationality:'';?>">
                    <?php if (!empty($nationalityError)): ?>
                        <span class="help-inline"><?php echo $nationalityError;?></span>
                    <?php endif;?>
                </div>
              </div>

              <div class="control-group <?php echo !empty($addressError)?'error':'';?>">
                <label class="control-label">Address</label>
                <div class="controls">
                    <input name="Address" type="text"  placeholder="Address" value="<?php echo !empty($address)?$address:'';?>">
                    <?php if (!empty($addressError)): ?>
                        <span class="help-inline"><?php echo $addressError;?></span>
                    <?php endif;?>
                </div>
              </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Update</button>
                    <a class="btn" href="index.php">Back</a>
                </div>
            </form>
        </div>

    </div> <!-- /container -->
  </body>
</html>
