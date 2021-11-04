<?php
session_start();
$errMsg = array(
    "full_name" => "<b>Nama lengkap</b> anda tidak valid",
    "email" => "<b>Email</b> anda tidak valid",
    "phone" => "<b>Nomor telepon</b> anda tidak valid",
    "password" => "<b>Password</b> anda tidak valid"
);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = test_input($_POST["full_name"]);
    $email = test_input($_POST["email"]);
    $phone = test_input($_POST["phone"]);
    $password = test_input($_POST["password"]);

    if (
        vFullName($full_name) &&
        vEmail($email) &&
        vPhone($phone) &&
        vPassword($password)
    ) {
        $_SESSION["user"] = array(
            "full_name" => vFullName($full_name),
            "email" => vEmail($email),
            "phone" => vPhone($phone),
            "password" => vPassword($password)
        );
        header("Location: dashboard.php");
        exit;
    } else {
        // 180 = 3 menit
        if (!vFullName($full_name)) {
            setcookie("errfull_name", $errMsg["full_name"], time() + (180), "/");
        } else {
            setcookie("full_name", vFullName($full_name), time() + (180), "/");
        }
        if (!vEmail($email)) {
            setcookie("erremail", $errMsg["email"], time() + (180), "/");
        } else {
            setcookie("email", vEmail($email), time() + (180), "/");
        }
        if (!vPhone($phone)) {
            setcookie("errphone", $errMsg["phone"], time() + (180), "/");
        } else {
            setcookie("phone", vPhone($phone), time() + (180), "/");
        }
        if (!vPassword($password)) {
            setcookie("errpassword", $errMsg["password"], time() + (180), "/");
        } else {
            setcookie("password", vPassword($password), time() + (180), "/");
        }
        header("Location: index.php");
        exit;
    }
}

// fungsi untuk menghilangkan script-script jahat
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function vFullName($full_name)
{
    // Mengubah string menjadi huruf kecil 
    // lalu mengubah tiap awalan kata menjadi huruf kapital
    $full_name = ucwords(strtolower($full_name));

    // Mengecek apakah Huruf awal tiap kata Kapital
    // Tidak ada angka dan simbol - simbol aneh
    $pattern = "/^[A-Za-z]+((\s)?((\'|\-|\.)?([A-Za-z])+))*$/";

    // mengecek apakah regex sesuai dengan pola yang telah ditentukan
    $regex = preg_match($pattern, $full_name);

    if (!$regex) {
        return false;
    } else {
        return $full_name;
    }
}

function vEmail($email)
{
    // Mengecek apakah Email valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    } else {
        return $email;
    }
}

function vPhone($phone)
{
    //menghilangkan char selain 0-9
    $phone = preg_replace("/[^0-9]/", '', $phone);

    // Mengecek apakah nomor valid
    if (strlen($phone) >= 10 && strlen($phone) <= 14) {
        return $phone;
    } else {
        return false;
    }
}

function vPassword($password)
{
    // Mengecek apakah terdapat minimal 8 karakter
    // terdapat minimal 1 angka
    // terdapat minimal 1 huruf kapital
    // terdapat minimal 1 huruf kecil
    $pattern = "/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/";

    // mengecek apakah regex sesuai dengan pola yang telah ditentukan
    $regex = preg_match($pattern, $password);

    if (!$regex) {
        return false;
    } else {
        return $password;
    }
}