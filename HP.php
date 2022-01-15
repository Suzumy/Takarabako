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
  <div class="tag0">
  <?php
    foreach ($tags as $value) {
  ?>
    <form method="POST" style="display: inline;">
      <input type="submit" name="tag" value="<?php echo $value['tag']; ?>">
    </form>

    <?php
    }
    ?>
  </div>

  <div class="simekiri">
    <p>もうすぐ締め切りのもの</p>
    <?php
    if ($near_deadline == 'false') {
      echo '現在締め切りの近いものはありません';
    } else {
      echo $near_deadline['title'];
    }
    ?>
  </div>
</div>

<div class="main1">
  <div class="main2">
    <?php
    //iframeの表示
    foreach ($all as $value){
      $result = str_replace("http://", "https://", $value['URL'], $n);
      $iframe_num = 'frame' . $num;
    ?>
        <iframe id="frame" width="300px" height="300px" src="">
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
      </script>

      <?php
        $num += 1;
      }
      ?>

    <a href="./hobby/register_Hobby.php"><img src="plus.jpg" alt="新規登録" class="image2"></a>
  </div>
</div>
</main>

<?php
require_once __DIR__ . '/footer.php';
?>