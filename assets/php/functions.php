<?php

require_once 'config.php';

// Function for showing pages
function showPage($page, $data = "")
{
    include("assets/pages/$page.php");
}

// Function to show error messages for specific fields
function showError($field)
{
    if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];
        if (isset($error['field']) && $field == $error['field']) {
            echo '<div class="alert alert-danger my-2" role="alert">' . $error['msg'] . '</div>';
        }
    }
}

// Function to retain form data after submission
function showFormData($field)
{
    if (isset($_SESSION['form'][$field])) {
        return $_SESSION['form'][$field];
    }
    return ''; // Return empty string if field is not set
}

// Function to validate signup form
function validateSignupForm($form)
{
    $response = array();
    $response['status'] = true;  // Initialize status as true

    // Validate User Role
    if (empty($form['userRole'])) {
        $response['msg'] = "Role is not selected";
        $response['status'] = false;
        $response['field'] = 'userRole';
    }

    // Validate Gender
    if (empty($form['gender'])) {
        $response['msg'] = "Gender is not selected";
        $response['status'] = false;
        $response['field'] = 'gender';
    }

    // Validate Password
    if (empty($form['password'])) {
        $response['msg'] = "Password is not given";
        $response['status'] = false;
        $response['field'] = 'password';
    } elseif (strlen($form['password']) < 8) {
        $response['msg'] = "Password must be at least 8 characters long";
        $response['status'] = false;
        $response['field'] = 'password';
    } elseif (!preg_match('/[A-Z]/', $form['password']) || !preg_match('/[a-z]/', $form['password']) || !preg_match('/[0-9]/', $form['password'])) {
        $response['msg'] = "Password must contain at least one uppercase letter, one lowercase letter, and one digit";
        $response['status'] = false;
        $response['field'] = 'password';
    }

    // Confirm Password
    if (empty($form['confirmPassword']) || $form['confirmPassword'] !== $form['password']) {
        $response['msg'] = "Passwords do not match";
        $response['status'] = false;
        $response['field'] = 'confirmPassword';
    }

    // Validate Email
    if (empty($form['email'])) {
        $response['msg'] = "Email is not given";
        $response['status'] = false;
        $response['field'] = 'email';
    } elseif (!filter_var($form['email'], FILTER_VALIDATE_EMAIL)) {
        $response['msg'] = "Email format is invalid";
        $response['status'] = false;
        $response['field'] = 'email';
    }

    // Validate Username
    if (empty($form['username'])) {
        $response['msg'] = "Username is not given";
        $response['status'] = false;
        $response['field'] = 'username';
    } elseif (strlen($form['username']) < 3 || strlen($form['username']) > 15) {
        $response['msg'] = "Username must be between 3 and 15 characters long";
        $response['status'] = false;
        $response['field'] = 'username';
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $form['username'])) {
        $response['msg'] = "Username can only contain letters, numbers, and underscores";
        $response['status'] = false;
        $response['field'] = 'username';
    }

    // Validate Last Name
    if (empty($form['lastName'])) {
        $response['msg'] = "Last name is not given";
        $response['status'] = false;
        $response['field'] = 'lastName';
    } elseif (!preg_match('/^[a-zA-Z]+$/', $form['lastName'])) {
        $response['msg'] = "Last name can only contain letters";
        $response['status'] = false;
        $response['field'] = 'lastName';
    } elseif (strlen($form['lastName']) < 2) {
        $response['msg'] = "Last name must be at least 2 characters long";
        $response['status'] = false;
        $response['field'] = 'lastName';
    }

    // Validate First Name
    if (empty($form['firstName'])) {
        $response['msg'] = "First name is not given";
        $response['status'] = false;
        $response['field'] = 'firstName';
    } elseif (!preg_match('/^[a-zA-Z\s]+$/', $form['firstName'])) {
        $response['msg'] = "First name can only contain letters";
        $response['status'] = false;
        $response['field'] = 'firstName';
    } elseif (strlen($form['firstName']) < 2) {
        $response['msg'] = "First name must be at least 2 characters long";
        $response['status'] = false;
        $response['field'] = 'firstName';
    }

    // Role-Specific Validations
    if ($form['userRole'] == 'student') {
        // Validate Student Fields
        if (empty($form['currentYear'])) {
            $response['msg'] = "Current year/semester is required";
            $response['status'] = false;
            $response['field'] = 'currentYear';
        }
        if (empty($form['program'])) {
            $response['msg'] = "Course/program enrolled is required";
            $response['status'] = false;
            $response['field'] = 'program';
        }
        if (empty($form['expectedGraduationYear'])) {
            $response['msg'] = "Expected graduation year is required";
            $response['status'] = false;
            $response['field'] = 'expectedGraduationYear';
        }
    } elseif ($form['userRole'] == 'alumni') {
        // Validate Alumni Fields
        if (empty($form['graduationYear'])) {
            $response['msg'] = "Graduation year is required";
            $response['status'] = false;
            $response['field'] = 'graduationYear';
        }
        if (empty($form['degree'])) {
            $response['msg'] = "Degree/program completed is required";
            $response['status'] = false;
            $response['field'] = 'degree';
        }
        if (empty($form['occupation'])) {
            $response['msg'] = "Current occupation/job title is required";
            $response['status'] = false;
            $response['field'] = 'occupation';
        }
        if (empty($form['companyName'])) {
            $response['msg'] = "Company name is required";
            $response['status'] = false;
            $response['field'] = 'companyName';
        }
    }

    return $response;
}

function createUser($data)
{
    global $db;

    if ($db === null || !($db instanceof mysqli)) {
        die("Database connection is not available.");
    }

    // Extracting data from the input array
    $userRole = isset($data['userRole']) ? $data['userRole'] : '';
    $firstName = isset($data['firstName']) ? $data['firstName'] : '';
    $lastName = isset($data['lastName']) ? $data['lastName'] : '';
    $email = isset($data['email']) ? $data['email'] : '';
    $username = isset($data['username']) ? $data['username'] : '';
    $password = isset($data['password']) ? password_hash($data['password'], PASSWORD_BCRYPT) : '';
    $gender = isset($data['gender']) ? $data['gender'] : '';
    $graduationYear = isset($data['graduationYear']) ? $data['graduationYear'] : '';
    $degree = isset($data['degree']) ? $data['degree'] : '';
    $occupation = isset($data['occupation']) ? $data['occupation'] : '';
    $companyName = isset($data['companyName']) ? $data['companyName'] : '';
    $linkedin = isset($data['linkedin']) ? $data['linkedin'] : '';
    $currentYear = isset($data['currentYear']) ? $data['currentYear'] : '';
    $program = isset($data['program']) ? $data['program'] : '';
    $expectedGraduationYear = isset($data['expectedGraduationYear']) ? $data['expectedGraduationYear'] : '';

    if ($userRole == 'student') {
        $query = "INSERT INTO signup (first_name, last_name, email, username, password, gender, current_year, program, expected_graduation_year) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        if ($stmt === false) {
            die("Prepare failed: " . $db->error);
        }

        $stmt->bind_param('sssssssss', $firstName, $lastName, $email, $username, $password, $gender, $currentYear, $program, $expectedGraduationYear);
        $stmt->execute();
        $stmt->close();

    } elseif ($userRole == 'alumni') {
        $query = "INSERT INTO signup (first_name, last_name, email, username, password, gender, graduation_year, degree, occupation, company_name, linkedin_profile) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        if ($stmt === false) {
            die("Prepare failed: " . $db->error);
        }

        $stmt->bind_param('sssssssssss', $firstName, $lastName, $email, $username, $password, $gender, $graduationYear, $degree, $occupation, $companyName, $linkedin);
        $stmt->execute();
        $stmt->close();
    } else {
        return false; // Invalid role
    }

    return true; // Successful operation
}


{
//error
    function validateLoginForm($emailOrUsername, $password)
    {
        $emailRegex = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';
        $emailOrUsername = trim($emailOrUsername);
        $password = trim($password);
        if (empty($emailOrUsername)) {
            return 'Email/Username is required.';
        }
        if (!preg_match($emailRegex, $emailOrUsername) && strlen($emailOrUsername) < 3) {
            return 'Please enter a valid email or username.';
        }
        if (empty($password)) {
            return 'Password is required.';
        }
        return true;
    }

}

//check user

function checkUser($login_data) {
    global $db;
    
 
    $username_email = $login_data['useremail'];
    $password = $login_data['password'];
    
    // Prepare the SQL query using prepared statements to prevent SQL injection
    $query = "SELECT * FROM signup WHERE (email = ? OR username = ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $username_email, $username_email);
    
    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if a user was found
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Password is correct, return user data or true
            return $user;
        } else {
            // Password is incorrect
            return false;
        }
    } else {
        // No user found with that email or username
        return false;
    }
}
