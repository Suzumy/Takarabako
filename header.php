<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>サンプル</title>
    <link rel="stylesheet" href="HP.css">
</head>

<body>
    <div id=navArea>
        <nav>
            <div class="inner">
                <ul>
                    <li><a href="/Takarabako/HP.php">Home</a></li>

                    <li><a href="/Takarabako/hobby/register_Hobby.php">趣味・画像登録画面</a></li>
                    <li><a href="/Takarabako/hobby/hobbylist.php">趣味・画像一覧</a></li>
                    <li><a href="/Takarabako/deadline/register_Deadline.php">締め切り登録画面</a></li>
                    <li><a href="/Takarabako/deadline/list.php">締め切り一覧画面</a></li>

                </ul>
            </div>
        </nav>


        <header>
            <!--  <p><a href="#"><img src="box.jpg" alt="宝箱" class="image1"></a></p>-->

            <h1 class="titlefont">たからばこ</h1>
            <!-- ログイン後の画面にログイン画面と新規登録画面は不要 -->
            <!-- <a href="new.html" class="btn">ログイン</a>
            <a href="rogin.html" class="btn2">新規登録</a> -->
            <a href="/Takarabako/user/logout.php" class="btn2">ログアウト</a>
        </header>

        <div class="toggle-btn">

            <!--ハンバーガーメニュー-->
            <span></span>
            <span></span>
            <span></span>
        </div>

        <div id="mask"></div>