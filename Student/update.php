<?php
global $link;
require_once 'config.php';
$name = $email = "";
$name_err = $email_err = "";

if (!empty($_POST["id"])){
    $id = $_POST["id"];

    $input_name = trim($_POST["name"]);
    if (empty($input_name)){
        $name_err = "Please enter a name";
    } elseif (!filter_var(trim($_POST["name"]),FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'.\s ]+$/" )))){
        $name_err = "Invalid Name";

    }else{
        $name = $input_name;
    }
    $input_email = trim(($_POST["email"]));
    if (empty($input_email)){
        $email_err = "Enter an Email";
    } else {
        $email = $input_email;
    }
    if (empty($name_err) && empty($email_err)){
        $sql = "UPDATE `student` SET name=?, email = ? WHERE id =?";

        if ($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt,"ssi",$param_name, $param_email, $param_id);

            $param_name=$name;
            $param_email = $email;
            $param_id = $id;
            if (mysqli_stmt_execute($stmt)){
                header("location:index.php");
                exit();
            }else{
                echo "Something went Wrong. Please try again later";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
} else{
    if (isset($_GET["id"])&& !empty(trim($_GET["id"]))){
        $id = trim($_GET["id"]);

        $sql = "SELECT * FROM `student` WHERE id = ?";
        if ($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            $param_id= $id;
            if (mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) ==1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $name = $row["name"];
                    $address = $row["email"];
                } else{
                    header("location: error.php");
                    exit();
                }
            }else{
                echo "Oops!! Something went wrong, try again later.";
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($link);
    }else{
        header("location : error.php");
        exit();
    }
}
?>
<!DOCTYPE  html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>

</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h2>Update Record</h2>
                </div>
                <p>Please edit tje input values and submit to update the record</p>
                <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI']));?>" method="post">
                    <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                        <label>Name</label>
                        <label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                        </label>
                        <span class="help-block"><?php echo $name_err?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($email_err))? 'has-error' : '';?>">
                        <label>Email</label>
                        <label>
                            <textarea name="email" class="form-control"><?php echo $email;?></textarea>
                        </label>
                        <span class="help-block"><?php echo $email_err;?></span>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id;?>"/>
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="index.php" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
