<?php
include 'config.php';


function login($email, $password,$db)
{
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['email'] == null) {
        // username and password sent from form 

        $myusername = mysqli_real_escape_string($db, $_POST['email']);
        $mypassword = mysqli_real_escape_string($db, $_POST['password']);

        $sql = "SELECT id FROM assinantes WHERE Email = '$myusername' and senha = '$mypassword'";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $active = $row['status'];

        $count = mysqli_num_rows($result);

        // If result matched $myusername and $mypassword, table row must be 1 row

        if ($count == 1) {
            session_start();
            $_SESSION['email'] = $myusername;
            $_SESSION['senha'] = $mypassword;

            echo '<script>window.location.href= "/clipping/";</script>';
        } else {
            echo '<script>alert("Your Login Name or Password is invalid");</script>';
        }
    }
}

function logoff(){
        session_destroy();
        echo '<script>window.location.href= "/clipping/";</script>';
}