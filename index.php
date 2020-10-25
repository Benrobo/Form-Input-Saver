<?php

// check if the submit button is set

if (isset($_POST['submit'])) {
    $user = $_POST['user'];
    $eml = $_POST['email'];
    $pwd = md5(password_hash($_POST['pwd'], PASSWORD_BCRYPT));
    
    // validate if all fields are empty
    if (empty($user) || empty($eml) || empty($pwd)) {
        echo "<div class='alert alert-danger empt' style='width:450px; margin:0px auto;'>Fields Cannot Be Empty</div>";
    }else{
    // validate email
    if (filter_var($eml, FILTER_VALIDATE_EMAIL) !== "false") {
        echo "<div class='alert alert-success emlsuc' style='width:450px; margin:0px auto;'>Valid Email </div>";
    }else{
        echo "invalid email";
    }

    // check if file already exists and save file to their file names

        $emlfile = "email.txt";  
        $pwdfile = "pwd.txt";
        if (file_exists($emlfile)) {
            $oldfile = file_get_contents($emlfile);
            $oldfile .= "$eml\n";
            file_put_contents($emlfile, $oldfile);
        }
        if (file_exists($pwdfile)) {
            $oldpwdfile = file_get_contents($pwdfile);
            $oldpwdfile .= "$pwd\n";
            file_put_contents($pwdfile, $oldpwdfile);
        }
    }
     
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Collector</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>
        form{
            width:350px;
            height:300px;
            box-shadow:0px 0px 3px #000;
            padding:12px;
            margin:120px auto;
        }

        @media(max-width:700px){
            form{
            width:320px;
            height:300px;
            box-shadow:0px 0px 3px #000;
            padding:12px;
            margin:120px auto;
        }
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="<?php $_SERVER['PHP_SELF']; ?>" class="form-group" method="post">
            <label>Username</label>
            <input type="text" name="user" class="form-control">
            <label>Email</label>
            <input type="text" name="email" class="form-control">
            <label>Password</label>
            <input type="password" name="pwd" class="form-control" id="pwdinp">

            <input type="checkbox" id="chk">

            <input type="submit" value="Submit" name="submit" class="btn btn-primary btn-block mt-2">
        </form>
    </div>

    <script>
        let empt = document.querySelector('.empt');
        let eml = document.querySelector('.emlsuc');

        // get the alert off the screen after showing up;
        function hidealrt(){
            const set = setTimeout(() => {
                empt.style.display = "none";
            }, 2000);
            const set_2 = setTimeout(() => {
                eml.style.display = "none";
            }, 2000);

            // hide and see password
            let chk = document.querySelector('#chk');
            let pwdinp = document.querySelector('#pwdinp');

            // check to see if it is checked or unchecked and set the input field to text otherwise set to password
            chk.addEventListener('click', function(e){

                if (pwdinp.type == "password") {
                    pwdinp.type = "text";
                }else{
                    pwdinp.type = "password";
                }
            })
        }hidealrt();
    </script>
</body>
</html>