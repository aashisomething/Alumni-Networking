<?php
require_once 'assets/php/config.php';
require_once 'assets/php/functions.php'; 

if(isset($_GET['landing'])){
    showPage("header",['page_title'=>'Alumni network']);
    showPage("landing");
    
}

if(isset($_GET['signup'])){
    showPage("header",['page_title'=>'Signup']);
    showPage("signup");
    
}
if(isset($_GET['login'])){
    showPage("header",['page_title'=>'Login']);
    showPage("login");
    
}
if(isset($_GET['success'])){
    showPage("header",['page_title'=>'success']);
    showPage("success");
    
}
showPage("footer");
unset($_SESSION['error']);
unset($_SESSION['form']);