<?php

$shellscript = "sudo /usr/bin/chpasswd";

function ValiateFrom($UserID, $old_password, $new_password, $new_confirm_password)
{
    if (empty($UserID) || empty($old_password) || empty($new_password) || empty($new_confirm_password)) {
        header("Location:changepass.php?change-password=empty");
        exit();
    }
    if ((strlen($new_password) < 6 ) || (strlen($new_confirm_password) < 6 )) {
        header("Location:changepass.php?password-length");
        exit();
    }
    if ($old_password == $new_password) {
        header("Location:changepass.php?password-same");
        exit();
    }
    if ($new_password != $new_confirm_password) {
        header("Location:changepass.php?confirm-password");
        exit();
    }
    if (imap_open('{mail.del.ac.id:143/novalidate-cert}INBOX', $UserID, $old_password)){
        //call shell script to update password
        $cmd="sudo /usr/bin/chpasswd -u " . $_POST['UserID'] . " -p " . $_POST['new_password'];
        
        exec($cmd,$output,$status);
        if ( $status == 0 ) { // Success - password changed
            header("Location:changepass.php?change-password-successful");
            exit();
        } else {
            header("Location:changepass.php?changepassword-failed");
            exit();
        }
    } else {
        header("Location:changepass.php?authentication-failed");
        exit();
    }
}


if (isset($_POST['submit'])) {
    ValiateFrom($_POST['UserID'], $_POST['old_password'], $_POST['new_password'], $_POST['new_confirm_password']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/tailwind.js"></script>
    <script src="js/main.js"></script>
    <title>Change Password</title>
</head>

<body class="antialiased text-slate-500 dark:text-slate-400 bg-white dark:bg-slate-900">
    <div class="w-full max-w-xs m-auto mt-8">

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <?php
            $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            if (strpos($fullUrl, "change-password=empty") == true) {
                echo '<p class="text-red-500 font-bold text-2xl">All fields are required.</p><a class="text-red-500 font-bold" href="changepass.php">Go back!</a><br>';
                exit();
            }
            if (strpos($fullUrl, "confirm-password")) {
                echo '<p class="text-red-500 font-bold text-2xl">Password and new password mismatch.</p><a class="text-red-500 font-bold" href="changepass.php">Go back!</a><br>';
                exit();
            }
            if (strpos($fullUrl, "password-length")) {
                echo '<p class="text-red-500 font-bold text-2xl">Password minimum 6 character</p><a class="text-red-500 font-bold" href="changepass.php">Go back!</a><br>';
                exit();
            }
            if (strpos($fullUrl, "password-same")) {
                echo '<p class="text-red-500 font-bold text-2xl">Old and new password should be different</p><a class="text-red-500 font-bold" href="changepass.php">Go back!</a><br>';
                exit();
            }
            if (strpos($fullUrl, "authentication-failed")) {
                echo '<p class="text-red-500 font-bold text-1xl">Authentication Failed.</p><a class="text-red-500 font-bold" href="changepass.php">Go back!</a>';
                exit();
            }
            if (strpos($fullUrl, "changepassword-failed")) {
                echo '<p class="text-red-500 font-bold text-1xl">Change password was failed.</p><a class="text-red-500 font-bold" href="changepass.php">Go back!</a>';
                exit();
            }
            if (strpos($fullUrl, "change-password-successful")) {
                echo '<p class="text-green-500 font-bold text-1xl">Password change successful.</p><a class="text-green-500 font-bold" href="https://mail.del.ac.id/">Go back!</a>';
                exit();
            }
            ?>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="UserID">
                    User ID <span class="text-red-500">*</span>
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="text" name="UserID">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="old_password">
                    Old Password <span class="text-red-500">*</span>
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="old_password">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="new_password">
                    New Password <span class="text-red-500">*</span>
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="new_password">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="confirm_new_password">
                    Confirm New Password <span class="text-red-500">*</span>
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="new_confirm_password">
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" name="submit" class="bg-slate-900 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2 focus:ring-offset-slate-50 text-white font-semibold h-12 px-6 rounded-lg w-full flex items-center justify-center sm:w-auto dark:bg-sky-500 dark:highlight-white/20 dark:hover:bg-sky-400" type="button">
                    Submit
                </button>
            </div>
        </form>
    </div>
</body>

</html>