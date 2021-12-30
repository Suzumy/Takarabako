<?php
require_once __DIR__ . '/header.php';
require_once __DIR__ . '/HP_DB.php';

session_start();

if (empty($_SESSION['id'])) {
  //ログイン画面へ遷移
  header('Location: ./user/login.php');
}

?>

<main>
  <!-- 後でフロントの人に見た目を整えてもらう 1 -->
  <p>もうすぐ締め切りのもの</p>
  <?php
  if (!$near_deadline == 'false') {
    echo $near_deadline['title'];
  } else {
    echo '現在締め切りの近いものはありません';
  }

  ?>
  <!-- 1 ここまで -->
  <div class="title">
    <h1>My Favorite Contents</h1>
  </div>
  <?php
  foreach ($tags as $value) {
  ?>
    <input type="submit" value="<?php echo $value['tag']; ?>">

  <?php
  }
  //iframeの表示
  foreach ($all as $value) {

    $result = str_replace("http://", "https://", $value['URL'], $n);
    $iframe_num = 'frame' . $num;

  ?>
    <div class="contents">
      <iframe id="frame" width="400px" height="400px" src="">
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

  <a href="./hobby/register_Hobby.php">新規登録</a>
</main>

<?php
require_once __DIR__ . '/footer.php';
?>