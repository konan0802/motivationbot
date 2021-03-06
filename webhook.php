<?php

/**
 * Copyright 2016 LINE Corporation
 *
 * LINE Corporation licenses this file to you under the Apache License,
 * version 2.0 (the "License"); you may not use this file except in compliance
 * with the License. You may obtain a copy of the License at:
 *
 *   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

require_once('./LINEBotTiny.php');
require_once('./test1.php');

$channelAccessToken = 'ChZVXqJ0p77jaRvxCIMmunAKUNrPJuyTKf5P8ROL8PoQQ+SNrotL5ebjRqRkJ9WplS+xPFSJabUChA8bFs6aQJMU9paAY6/Qxw0Sln3aHYmhbCV5hBVe+EMCRFH9cYGG2FK97Ks+PsKMjvhdFYt32AdB04t89/1O/w1cDnyilFU=';
$channelSecret = 'bbc30ba962430718cf5e6b1ef67fdb65';

$client = new LINEBotTiny($channelAccessToken, $channelSecret);
$sendText = $result[0].$result[1];#$message['text']
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            switch ($message['type']) {
                case 'text':
                    $client->replyMessage([
                        'replyToken' => $event['replyToken'],
                        'messages' => [
                            [
                                'type' => 'text',
                                'text' => $sendText
                            ]
                        ]
                    ]);
                    break;
                default:
                    error_log('Unsupported message type: ' . $message['type']);
                    break;
            }
            break;
        default:
            error_log('Unsupported event type: ' . $event['type']);
            break;
    }
};
