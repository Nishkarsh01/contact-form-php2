<?php 

    //Message vars
    $msg = '';
    $msgClass = '';

    //check for submit
    if(filter_has_var(INPUT_POST, 'submit')){

        //GET FORM DATA
        $name = $_POST['name'];
        $email=$_POST['email'];
        $message=$_POST['message'];        

        if(!empty($email) && !empty($name) && !empty($message)){


            if(filter_var($email, FILTER_VALIDATE_EMAIL)===false){
                $msg = 'Please use a valid email';
                $msgClass = 'alert-danger';
            }else{
                // PASSED
                // RECIPIENT EMAIL
                $toMail='nishdubb20@gmail.com';
                $subject='Contact Request Form'.$name;
                $body='<h2>Contact Request</h2>
                    <h4>Name:</h4><p>'.$name.'</p>
                    <h4>email:</h4><p>'.$email.'</p>
                    <h4>message:</h4><p>'.$message.'</p>
                ';

                //Email headers
                $headers="MIME-Version 1.0"."\r\n";
                $headers="Content-Type:text/html; charset=UTF-8"."\r\n";

                //Additional headers
                $headers.="From: ".$name."<".$email.">"."\r\n";


                if(mail($toMail, $subject, $body, $headers)){
                    $msg='Your email has been sent';
                    $msgClass='alert-success';
                }else{
                    $msg='Your email was not sent';
                    $msgClass='alert-danger';
                }
            }
        }
        else{
            //failed
            $msg = 'Please fill in all fields';
            $msgClass = 'alert-danger';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Contact Us</title>
</head>
<body>
    
    <nav class="navbar navbar-default">

        <div class="container">
            <div class="navbar-header">
                <a href="index.php" class="navbar-brand">My Website</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php if($msg != ''): ?>
            <div class="alert <?php echo $msgClass; ?>">
                <?php echo $msg; ?>
            </div>
        <?php endif ?> 
        <form action="" method="post">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo isset($_POST['name']) ? $name : ''?>">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="">
            </div>

            <div class="form-group">
                <label>Message</label>
                <textarea name="message" class="form-control" cols="30" rows="10"></textarea>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Submit </button>
        </form>
    </div>
</body>
</html>
