<?php
//DBへのアクセス
$dsn = 'mysql:host=localhost;dbname=takarabako;charset=utf8';
$user = 'treasure';
$password = 'box';

$pdo = new PDO($dsn, $user, $password);
$sql = "SELECT * FROM hobbys";
$stmt = $pdo->query($sql);
$stmt->execute();
$all = $stmt->fetchall();
$num = 0;
?>
<!--web表示-->
<!doctype html>
<html lang="ja">

<body>

    <?php
    //iframeの表示
    foreach ($all as $value) {
        $result = str_replace("http://", "https://", $value['URL'], $n);
        $iframe_num = 'frame' . $num;
    ?>
        <iframe id="frame" width="400px" height="400px" src="">
            お使いのブラウザはiframeに対応しておりません
        </iframe>
        <!-- frameにidを割り当て    -->
        <script>
            var iframe_id = document.getElementById('frame')
            iframe_id.setAttribute('id', '<?php echo $iframe_num; ?>');
        /*iframeにURL代入   */
            var url;
            url = '<?php echo $result; ?>';
            iframe_id.setAttribute('src', url);
            document.write(url);
        </script>
    <?php
    $num +=1;
    }
    ?>

</body>

</html>