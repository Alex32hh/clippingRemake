<?php
include 'config.php';
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

            
            echo '<script>
            $(".login-content-page").css( "border", "3px solid rgb(45,208,121)" );
            window.location.href= "/clippinRemake/";
            </script>';
        } else {
            echo '<script>
             $(".inputBox-email").val("'.$myusername. '");
             $(".inputBox-senha").val("'.$mypassword.'");
             
             $(".login-content-page").css( "border", "3px solid red" );
             $(".login-danger").html("E-mail ou senha errada");
             </script>';
        }
    }

function logoff(){
        session_destroy();
        echo '<script>window.location.href= "/clipping/";</script>';
}