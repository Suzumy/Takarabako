<!DOCTYPE html>
<html lang="ja">

<link rel="stylesheet" type="text/css" href="Move.css">

<header>

</header>

<body>
    <!-- Twitter埋め込みコード-->
    <div class="drag-and-drop" id="red-box"><img id="dragImage" src="image/carsole.png"> <a class="twitter-timeline"
            data-lang="ja" data-width="500" data-height="500"
            href="https://twitter.com/DUST_CELL?ref_src=twsrc%5Etfw"></a>
        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    </div>

    <div class="drag-and-drop" id="blue-box"><img id="dragImage" src="image/carsole.png">
        <ul id="list">
            <li id="title">Title</li>
            <il id="images"><img src="image/unnamed.png"></il>
            <il id="caption">--</il>
        </ul>
    </div>

    <div class="drag-and-drop" id="yellow-box"><img id="dragImage" src="image/carsole.png"></div>


</body>

<footer>

</footer>
<script type="text/javascript">
// 実際には入力チェックなどする
var today = new Date();
var month = today.getMonth() + 1;
var day = today.getDate();
document.write("今日は" + month + "月" + day + "日です。");
// JacaScript未対応ブラウザ対策　

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