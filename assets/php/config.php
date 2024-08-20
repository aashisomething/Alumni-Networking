<?php 
session_start();
//db connection
const DB_NAME = 'alumni';
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = '';

$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$db) {
    die("Database connection failed: " . mysqli_connect_error());
}
