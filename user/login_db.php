<?php

require_once '../DB.php';

session_start();


//空じゃないか確認
if ($_POST['address'] != '' && $_POST['password'] != '') {
    //login.phpの情報を受け取る
    $email = $_POST['address'];
    $password = $_POST['password'];

    //ログイン処理
    //DBに情報があるか確認
    $sql = "select * from users where meal = ? and password = ?";
    $login = $pdo->prepare($sql);
    $login->execute(array($email, $password));
    $user = $login->fetch();

    //ログイン成功か判定
    if ($user) {
        //情報があればlogin成功としてHP.phpに飛ばす
        $_SESSION['id'] = $user['id'];
        header('Location: ../HP.php');
    } else {
        //ログイン失敗
        $_SESSION['error'] = 'login_faild';
        header('Location: login.php');
    }
}



//情報が無ければログイン失敗とする
