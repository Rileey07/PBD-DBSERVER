<?php
    session_start();
    if(!isset($_SESSION['username'])){ header("location:login.php"); } 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        h2, h3 {
            color: #333;
            text-align: center;
            font-family: 'Verdana', sans-serif;
        }

        h2 {
            margin-bottom: 10px;
            border-bottom: 2px solid #333;
            padding-bottom: 5px;
        }

        h3 {
            margin-top: 10px;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>

<body>
    <h2>
        <?php
            $ju = ($_SESSION['jenisuser'] == '0') ? 'User-Client' : 'User-Admin';
            echo $ju;
        ?>
    </h2>
    <h3>
        <?php echo  "Welcome " . $_SESSION['username'] . ' | <a href="sistem.php?op=out">Log Out</a>'; ?>
    </h3>
</body>

</html>
