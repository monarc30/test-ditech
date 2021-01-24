<?php

session_start();

require_once ( "../env.php" );
require_once ( "../dao/DataBase.php" ) ;
require_once ( "../models/Users.php" );

$Users = new Users();

$data = new DataBase( $host, $user, $password, $dbname );

if ($_POST) {

	if ($_POST['login']=="admin" and $_POST['password']=="123456") {
		
		header('Location: ../start.php');
		exit;
	}
	
	else{ 

		$login = $Users->setLogin($_POST['login']);	
		$password = $Users->setPassword($_POST['password']);	

		$res = $data->getUser( $Users );

		if ($res > 0) {
			$_SESSION["id_user"]=$res;
			header('Location: select_room.php');
			exit;
		}else{
			header('Location: login.php?error=1');
			exit;
		}

	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Test</title>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

</head>
<body>

<div class="container">

    <div class="row" style="margin-top:100px;">
        <div class="col-4">
            &nbsp;
        </div>
        <div class="col-4">
            <h2 style="text-align:center">Login Form</h2>		
            <hr>
        </div>
        <div class="col-4">
            &nbsp;
        </div>
    </div>

	<div class="row">        
            <div class="col-4">
                &nbsp;
            </div>
            <div class="col-4">
                <form name="form1" id="form1" method="post">	

					<?php

					if (isset ($_GET["error"])) { ?>
						<div class="col-12" style="color:red;font-weight:bold;text-align:center;">Invalid login</div>
					<?php } ?>

                    <label>Login:</label>
                    <input class="form-control" type="text" name="login" id="login" maxlength=10 size=10 required>		

                    <label>Password:</label>
                    <input class="form-control" type="password" name="password" id="password" maxlength=10 size=10 required>			                    
                    
                    <hr>
                    <p style="text-align:center"><input id="save" class="btn btn-primary" type="submit" value="Login"></input></p>
                </form>

            </dlv>
            <div class="col-4">
                &nbsp;
            </div>        
    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>
</html>