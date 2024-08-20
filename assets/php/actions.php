<?php
require_once 'functions.php';
//for signup
if (isset($_GET['signup'])) {
    // Validate the form data
    $response = validateSignupForm($_POST);

    if ($response['status'] == true) {
        $creationSuccess = createUser($_POST);
        if ($creationSuccess) {
            header('Location: ../../?success');
            exit;  
        } else {
           
            $_SESSION['error'] = [
                'msg' => 'Failed to create user. Please try again later.',
                'field' => ''
            ];
            $_SESSION['form'] = $_POST;

           
            header('Location: ../../?signup');
            exit;  
        }
    } else {
        
        $_SESSION['error'] = $response;
        $_SESSION['form'] = $_POST;
        header('Location: ../../?signup');
        exit;  
    }
}

//for login
if (isset($_GET['login'])) {
    // Validate the form inputs
    $validation = validateLoginForm($_POST['useremail'], $_POST['password']);
    if ($validation === true) {
       $user = checkUser($_POST);
        
        if ($user) {
           
            $_SESSION['user'] = $user;
            header('Location: ../../?success'); 
            exit();
        } else {
           $_SESSION['error'] = 'Invalid email/username or password.';
            $_SESSION['form'] = $_POST;
            header('Location: ../../?login');  
            exit();
        }
    } else {
        $_SESSION['error'] = $validation;
        $_SESSION['form'] = $_POST;
        header('Location: ../../?login');  
        exit();
    }
}