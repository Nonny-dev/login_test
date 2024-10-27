<?php

$u = $_GET['email'];
$p = $_GET['password'];

include_once('db.php');
$sql = "SELECT u.id_user, u.email, u.username, u.password, r.id_role, r.name_role
        FROM    users u , role r
        WHERE   u.id_role = r.id_role
        AND     u.email = ?
        AND     u.password = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $u, $p);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {

    session_start();
    $_SESSION['id_user'] = $row['id_user'];
    $_SESSION['id_role'] = $row['id_role'];
    $_SESSION['u'] = $u;
    $_SESSION['p'] = $p;
    $_SESSION['username'] = $row['username'];

    if ($_SESSION['id_role'] == '1') {
        header('location:../admin/index.php');
        exit(0);
    } elseif ($_SESSION['id_role'] == '2') {
        header('location:../user/index.php');
        exit(0);
    } else {
        $_SESSION['alert'] = 'Login Error';
        header('location:../admin/index.php');
        exit(0);
    }

} else {
    session_start();
    $_SESSION['alert'] = 'Login Error';
    header('location:../admin/index.php');
    exit(0);
}
?>