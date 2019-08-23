<?php

    session_start();

//initialising variables

    $username = "";

    $errors = array();

//connect to db

    $db = mysqli_connect('localhost','root','','log-n-text') or die("could not connect to database");

//Register users

    $username = mysqli_real_escape_string($db,$_POST['username']);
    $password_1 = mysqli_real_escape_string($db,$_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db,$_POST['password_2']);

//form validation

    if(empty($username))
    {
        array_push($errors,"Username is required");
    }

    if(empty($password_1)) 
    {
        array_push($errors,"Password is required");
    }

    if(empty($password_2)) 
    {
        array_push($errors,"Please confirm your password");
    }

    if($password_1 != $password_2) 
    {
        array_push($errors,"Passwords don't match.");
    }

// check db for existing user with same username

    $user_check_query = "SELECT * FROM user WHERE username = '$username' LIMIT 1";

    $results = mysqli_query($db,$user_check_query);
    $user = mysqli_fetch_assoc($results);

    if($user)
    {
        if($user['username'] === $username)
        {
            array_push($errors,"Username already exists");
        }
    }

//register the user if there's no error

    if(count($errors) == 0)
    {
        $password = md5($password_1); //encrypt password
        $query = "INSERT INTO user (username,password) VALUES ('$username','$password')";

        mysqli_query($db,$query);
        $_SESSION['username'] =  $username;
        $_SESSION['success'] = "You are now logged in";

        header('location: index.php');
    }

//log in user

    if(isset($_POST['login_user']))
    {
        $username = mysqli_real_escape_string($db,$_POST['username']);
        $password = mysqli_real_escape_string($db,$_POST['password']);

        if(empty($username))
        {
            array_push($errors,"Username is required.");
        }
        if(empty($password))
        {
            array_push($errors,"Password is required.");
        }

        if(count($errors) == 0)
        {
            $password = md5($password);

            $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
            $results = mysqli_query($db,$query);

            if(mysqli_num_rows($results))
            {
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "Logged in successfully";
                header('location: index.php');
            }
            else
            {
                array_push($errors, "Wrong username or password.");
            }
        }
    }

 ?>