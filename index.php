<?php
	// Composer�ŃC���X�g�[���������C�u�������ꊇ�ǂݍ���
	require_once __DIR__ . '/vendor/autoload.php';
	
	// �A�N�Z�X�g�[�N�����g��CurlHTTPClient���C���X�^���X��
	$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('ChZVXqJ0p77jaRvxCIMmunAKUNrPJuyTKf5P8ROL8PoQQ+SNrotL5ebjRqRkJ9WplS+xPFSJabUChA8bFs6aQJMU9paAY6/Qxw0Sln3aHYmhbCV5hBVe+EMCRFH9cYGG2FK97Ks+PsKMjvhdFYt32AdB04t89/1O/w1cDnyilFU=');
	
	//CurlHTTPClient�ƃV�[�N���b�g���g��LINEBot���C���X�^���X��
	$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => 'bbc30ba962430718cf5e6b1ef67fdb65']);
	
	// LINE Messaging API�����N�G�X�g�ɕt�^�����������擾
	$signature = $_SERVER["HTTP_" . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
	
	//�������`�F�b�N���A�����ł���΃��N�G�X�g���p�[�X���z��ցA�s���ł���Η�O����
	$events = $bot->parseEventRequest(file_get_contents('php://input'), $signature);
	
	foreach ($events as $event) {
		// ���b�Z�[�W��ԐM
		$response = $bot->replyMessage(
			$event->getReplyToken(), new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($event->getText())  
		);
	}
?>