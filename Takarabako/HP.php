<?php
require_once __DIR__ . '/header.php';
require_once __DIR__ . '/HP_DB.php';


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
    <form method="POST" style="display: inline;">
        <input type="submit" name="tag" value="<?php echo $value['tag']; ?>">
    </form>

    <?php
  }
  //iframeの表示
  foreach ($all as $value) {

    $result = str_replace("http://", "https://", $value['URL'], $n);
    $iframe_num = 'frame' . $num;

  ?>

    <div class="drag-and-drop" id="red-box"><img id="dragImage" src="carsole.png" style="width: 30px;height: 30px;">
        <!--スタイルを直で書いてます-->

        <div class="contents">
            <iframe id="frame" width="400px" height="400px" src="">
                お使いのブラウザはiframeに対応しておりません
            </iframe>
        </div>
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

    <div class="drag-and-drop" id="blue-box"><img id="dragImage" src="carsole.png" style="width: 30px;height: 30px;">
    </div>
    <div class="drag-and-drop" id="yellow-box"><img id="dragImage" src="carsole.png" style="width: 30px;height: 30px;">
    </div>
</main>

<?php
require_once __DIR__ . '/footer.php';
?>

<script type="text/javascript">
//以下要素移動の為のScript
(function() {

    //要素の取得
    var elements = document.getElementsByClassName("drag-and-drop");

    //要素内のクリックされた位置を取得するグローバル（のような）変数
    var x;
    var y;

    //マウスが要素内で押されたとき、又はタッチされた際の関数
    for (var i = 0; i < elements.length; i++) {
        elements[i].addEventListener("mousedown", mdown, false);
        elements[i].addEventListener("touchstart", mdown, false);
    }

    //マウスが押された際の関数
    function mdown(e) {

        //クラス名に .drag を追加
        this.classList.add("drag");

        //タッチデイベントとマウスのイベントの差異を吸収
        if (e.type === "mousedown") {
            var event = e;
        } else {
            var event = e.changedTouches[0];
        }

        //要素内の相対座標を取得
        x = event.pageX - this.offsetLeft;
        y = event.pageY - this.offsetTop;

        //ムーブイベントにコールバック
        document.body.addEventListener("mousemove", mmove, false);
        document.body.addEventListener("touchmove", mmove, false);
    }

    //マウスカーソルが動いた際の関数
    function mmove(e) {

        //ドラッグしている要素を取得
        var drag = document.getElementsByClassName("drag")[0];

        //同様にマウスとタッチの差異を吸収
        if (e.type === "mousemove") {
            var event = e;
        } else {
            var event = e.changedTouches[0];
        }

        //フリックしたときに画面を動かさないようにデフォルト動作を抑制
        e.preventDefault();

        //マウスが動いた場所に要素を動かす
        drag.style.top = event.pageY - y + "px";
        drag.style.left = event.pageX - x + "px";

        //マウスボタンが離されたとき、またはカーソルが外れたとき発火
        drag.addEventListener("mouseup", mup, false);
        document.body.addEventListener("mouseleave", mup, false);
        drag.addEventListener("touchend", mup, false);
        document.body.addEventListener("touchleave", mup, false);

    }

    //マウスボタンが上がった際の関数
    function mup(e) {
        var drag = document.getElementsByClassName("drag")[0];

        //ムーブベントハンドラの消去
        document.body.removeEventListener("mousemove", mmove, false);
        drag.removeEventListener("mouseup", mup, false);
        document.body.removeEventListener("touchmove", mmove, false);
        drag.removeEventListener("touchend", mup, false);

        //クラス名 .drag も消す
        drag.classList.remove("drag");
    }

})()
</script>