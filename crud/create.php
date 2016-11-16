
<?php
    require 'database.php';
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
            $addressError = 'Please enter your Nationality';
            $valid = false;
        }


        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO customers_entry (name,email,mobile,gender,status,nationality,address) values(?, ?, ?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$email,$mobile,$gender,$status,$nationality,$address));
            Database::disconnect();
            header("Location: index.php");
        }
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
</head>
<body>

    <div class="container">
                <div class="col-sm-12">
                    <div class="row">
                        <h3>Create a Customer</h3>
                    </div>
                    <form class="form-horizontal" action="create.php" method="post">
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
                            <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
                            <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
                            <?php if (!empty($genderError)): ?>
                                <span class="help-inline"><?php echo $genderError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($statusError)?'error':'';?>">
                        <label class="control-label">Status</label>
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
                            <input name="address" type="text"  placeholder="Address" value="<?php echo !empty($address)?$address:'';?>">
                            <?php if (!empty($addressError)): ?>
                                <span class="help-inline"><?php echo $addressError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="index.php">Back</a>
                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
