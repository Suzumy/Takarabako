<?php
require_once __DIR__ . '/header.php';
require_once __DIR__ . '/HP_DB.php';


if (empty($_SESSION['id'])) {
  //ログイン画面へ遷移
  header('Location: ./user/login.php');
}

?>

<main>
  <!-- この機能を右に移動する 1 -->
<div class="main0">
  <div class="main2">
    <h1>My Favorite Contents</h1>

    <?php
    foreach ($tags as $value) {
    ?>
  <!-- 1 ここまで -->
  ?>
    <form method="POST" style="display: inline;">
      <input type="submit" name="tag" value="<?php echo $value['tag']; ?>">
    </form>

    <?php
    }

    //iframeの表示
    foreach ($all as $value){
      $result = str_replace("http://", "https://", $value['URL'], $n);
      $iframe_num = 'frame' . $num;
    ?>
      <div class="contents">
      <iframe id="frame" width="100%" height="400px" src="">
        お使いのブラウザはiframeに対応しておりません
      </iframe>
      </div>
      <!-- frameにidを割り当て    -->
      <script>
        var iframe_id = document.getElementById('frame')
        iframe_id.setAttribute('id', '<?php echo $iframe_num; ?>');
        /*iframeにURL代入   */
        var url;
        url = '<?php echo $result; ?>';
        iframe_id.setAttribute('src', url);
      </script>

      <?php
      $num += 1;
    }
    ?>

    <a href="./hobby/register_Hobby.php"><img src="plus.jpg" alt="新規登録" class="image2"></a>
  </div>

  <div class="main1">
    <p>もうすぐ締め切りのもの</p>
    <?php
    if ($near_deadline == 'false') {
      echo '現在締め切りの近いものはありません';
    } else {
      echo $near_deadline['title'];
    }
    ?>
  <!-- 1 ここまで -->
  </div>
</div>
</main>

<?php
require_once __DIR__ . '/footer.php';
?>