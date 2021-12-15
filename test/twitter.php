<!DOCTYPE html>
<html>
	<head>
		<title>JavaScriptで埋め込みツイートを表示するデモ</title>
	</head>
<body>

<h1>JavaScriptで埋め込みツイートを表示するデモ</h1>
<p>JavaScriptを利用して、指定した場所に埋め込みツイートを表示するデモです。元のツイートは<a href="https://twitter.com/arayutw/status/819568298794754049" target="_blank">こちら</a>です。</p>

<!-- コンテナ -->
<div id="tweet-container"></div>

<script type="text/javascript" async src="https://platform.twitter.com/widgets.js"></script>
<script>
// コンテナを取得
var container = document.getElementById( "tweet-container" ) ;

// ツイートを埋め込み表示するメソッドを実行
twttr.widgets.createTweet (
	"810830501347020800" ,	// ツイートID
	container ,	// コンテナの要素
	{	// パラメータ
//		cards: "hidden" ,
//		conversation: "none" ,
   		theme: "dark" ,
//		link-color: "#D36015" ,
   		width: 250 ,
   		align: "center" ,
//		lang: "ja" ,
//		dnt: true ,
	}
) ;
</script>
</body>
</html>