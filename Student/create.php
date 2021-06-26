<?php
require_once "../Utils/connection_db.php";
$age = 20;
$name = $address = $telephone = "";
$age_err = $name_err = $address_err = $telephone_err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter name";
    } elseif (strlen($input_name) > 255) {
        $name_err = "Name too long";
    }
    $name = $input_name;

    $input_age = $_POST["age"];
    echo $input_age;
    if (empty($input_age)) {
        $age_err = "Please enter age";
    } elseif ($input_age > 9999 || $input_age < 1 || !is_numeric($input_age)) {
        $age_err = "Invalid age";
    }
    $age = $input_age;

    $input_address = trim($_POST["address"]);
    if (empty($input_address)) {
        $address_err = "Please enter address";
    } elseif (strlen($input_address) > 200) {
        $address_err = "Address too long";
    }
    $address = $input_address;

    $input_telephone = trim($_POST["telephone"]);
    if (empty($input_telephone)) {
        $telephone_err = "Please enter telephone";
    } elseif (strlen($input_telephone) < 10 || strlen($input_telephone) > 20 || !is_numeric($input_telephone)) {
        $telephone_err = "Invalid telephone";
    }
    $telephone = $input_telephone;

    if (empty($address_err) && empty($age_err) && empty($name_err) && empty($telephone_err)) {
        $sql = "INSERT INTO students (name, age, address, telephone) VALUES ('$name', '$age', '$address', '$telephone')";
        echo $sql;
        if (mysqli_query($conn, $sql)) {
            header("location: listStudents.php");
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    if ($conn != null) {
        $conn->close();
    }
    exit();
}
//else if ($_SERVER["REQUEST_METHOD"] == "GET") {
//    $sql = "SELECT * FROM chuyennganh ORDER BY tencn";
//    if ($result = mysqli_query($conn, $sql)) {
//        if (mysqli_num_rows($result) > 0) {
//            $i = 0;
//            while ($row = mysqli_fetch_array($result)) {
//                $listSpec[$i] = [$row['macn'], $row['tencn']];
//                $i++;
//            }
//        }
//    }
//    if ($conn != null) {
//        $conn->close();
//    }
//}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5">Create Record</h2>
                <p>Please fill this form and click to Create to add student.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name"
                               class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>"
                               value="<?php echo $name; ?>">
                        <span class="invalid-feedback"><?php echo $name_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Age</label>
                        <input type="number" name="age"
                               class="form-control <?php echo (!empty($aage_err)) ? 'is-invalid' : ''; ?>"
                               placeholder="20"
                               value="<?php echo $age; ?>">
                        <span class="invalid-feedback"><?php echo $age_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea type="text" name="address" class="form-control
<?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>"><?php echo $address; ?></textarea>
                        <span class="invalid-feedback"><?php echo $address_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Telephone</label>
                        <input type="number" name="telephone"
                               class="form-control <?php echo (!empty($telephone_err)) ? 'is-invalid' : ''; ?>"
                               value="<?php echo $telephone; ?>" placeholder="0987xxxxxx">
                        <span class="invalid-feedback"><?php echo $telephone_err; ?></span>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Create">
                    <a href="listStudents.php" class="btn btn-secondary ml-2">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>