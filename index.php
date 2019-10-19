<?php
	// Composerでインストールしたライブラリを一括読み込み
	require_once __DIR__ . '/vendor/autoload.php';
	
	// アクセストークンを使いCurlHTTPClientをインスタンス化
	$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('ChZVXqJ0p77jaRvxCIMmunAKUNrPJuyTKf5P8ROL8PoQQ+SNrotL5ebjRqRkJ9WplS+xPFSJabUChA8bFs6aQJMU9paAY6/Qxw0Sln3aHYmhbCV5hBVe+EMCRFH9cYGG2FK97Ks+PsKMjvhdFYt32AdB04t89/1O/w1cDnyilFU=');
	
	//CurlHTTPClientとシークレットを使いLINEBotをインスタンス化
	$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => 'bbc30ba962430718cf5e6b1ef67fdb65']);
	
	// LINE Messaging APIがリクエストに付与した署名を取得
	$signature = $_SERVER["HTTP_" . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
	
	//署名をチェックし、正当であればリクエストをパースし配列へ、不正であれば例外処理
	$events = $bot->parseEventRequest(file_get_contents('php://input'), $signature);
	
	foreach ($events as $event) {
		// メッセージを返信
		$response = $bot->replyMessage(
			$event->getReplyToken(), new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($event->getText())  
		);
	}
?>