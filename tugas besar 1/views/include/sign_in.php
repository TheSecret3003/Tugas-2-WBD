/*Login page : PHP*/
<?php

if (isset($_POST['submit'])) {
    include 'dbh.inc.php';

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    //Error Handlers
    // Check if inputs are empty
    if (empty($username) || empty($password)) {
        # code...
        header("Location: ../login.php?login=empty");
        exit();
    } else {
        $sql = "SELECT * FROM user WHERE username='" . $username . "'";
        echo($sql);
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck < 1) {
            # code...
            header("Location: ../login.php?login=WrongUserName");
            exit();
        } else {
            if ($row = mysqli_fetch_assoc($result)) {
                // echo $row['secret_code'];
                $pwdCheck = ($password == $row['password']);
                if ($pwdCheck == false) {
                    # code...
                    header("Location: ../login.php?login=wrongPW");
                    exit();
                }
                elseif ($pwdCheck == true) {
                    include 'set_cookie.php';
                }
            }
        }
    }
} else {
    header("Location: ../login.php?woiwoi");
    exit();
}
