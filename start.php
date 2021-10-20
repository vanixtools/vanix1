<?php
date_default_timezone_set('Asia/Baghdad');
$config = json_decode(file_get_contents('config.json'),1);
$id = $config['id'];
$token = $config['token'];
$config['filter'] = $config['filter'] != null ? $config['filter'] : 1;
$screen = file_get_contents('screen');
exec('kill -9 ' . file_get_contents($screen . 'pid'));
file_put_contents($screen . 'pid', getmypid());
include 'index.php';
$accounts = json_decode(file_get_contents('accounts.json') , 1);
$cookies = $accounts[$screen]['cookies'] . $accounts[$screen]['sessionid'];
$useragent = $accounts[$screen]['useragent'];
$users = explode("\n", file_get_contents($screen));
$uu = explode(':', $screen) [0];
$se = 100;
$i = 0;
$nott = 0;
$za = 0;
$gmail = 0;
$hotmail = 0;
$yahoo = 0;
$mailru = 0;
$true = 0;
$false = 0;
$edit = bot('sendMessage',[
    'chat_id'=>$id,
    'text'=>"- بدأ الفحص ✅",
    'parse_mode'=>'markdown',
    'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>'تم فحص  : '.$i,'callback_data'=>'fgf']],
                [['text'=>'اليوزر المفحوص : '.$user,'callback_data'=>'fgdfg']],
                [['text'=>'EMAIL: '.$mail,'callback_data'=>'ghj']],
                [['text'=>"Gmail : $gmail",'callback_data'=>'dfgfd'],['text'=>"Yahoo : $yahoo",'callback_data'=>'gdfgfd']],
                [['text'=>'MailRu : '.$mailru,'callback_data'=>'fgd'],['text'=>'Hotmail : '.$hotmail,'callback_data'=>'ghj']],
                [['text'=>'غير مستعمل ✖️ : '.$nott,'callback_data'=>'hdhdh'],['text'=>'Business ✔️ : '.$za,'callback_data'=>'hdfhdh']],
                [['text'=>'تم صيد ✅ : '.$true,'callback_data'=>'gj'],['text'=>'Not Vailds ❌: '.$false,'callback_data'=>'dghkf']],
                [['text'=>'Blacklist ♻️: '.$bla,'callback_data'=>'pvja']],
            ]
        ])
]);
$se = 100;
$editAfter = 1;
foreach ($users as $user) {
    $info = getInfo($user, $cookies, $useragent);
    if ($info != false ) {
        $mail = trim($info['mail']);
        $usern = $info['user'];
        $e = explode('@', $mail);
               if (preg_match('/(live|hotmail|outlook|yahoo|Yahoo|yAhoo)\.(.*)|(gmail)\.(com)|(mail|bk|yandex|inbox|list)\.(ru)/i', $mail,$m)) {
            echo 'check ' . $mail . PHP_EOL;
            $za +=1;
                    if(checkMail($mail)){
                        $inInsta = inInsta($mail);
                        if ($inInsta !== false) {
                            // if($config['filter'] <= $follow){
                                echo "True - $user - " . $mail . "\n";
                                if(strpos($mail, 'gmail.com')){
                                    $gmail += 1;
                                } elseif(strpos($mail, 'hotmail.') or strpos($mail,'outlook.') or strpos($mail,'live.com')){
                                    $hotmail += 1;
                                } elseif(strpos($mail, 'yahoo')){
                                    $yahoo += 1;
                                } elseif(preg_match('/(mail|bk|yandex|inbox|list)\.(ru)/i', $mail)){
                                    $mailru += 1;
                                }
                                $follow = $info['f'];
                                $following = $info['ff'];
                                $media = $info['m'];
                                bot('sendMessage', ['disable_web_page_preview' => true, 'chat_id' => $id, 'text' => " ᕼI ᐯᗩᑎI᙭ ᑎᗴᗯ ᖴᑌᑕKᗴᗪ  ✅ \n━━━━━━━━━━━━━━━\n 𖡦-› 𝐮𝐬𝐞𝐫𝐧𝐚𝐦𝐞 : [$usern](instagram.com/$usern)\n 𖡦-› 𝐞𝐦𝐚𝐢𝐥 : [$mail]\n 𖡦-› 𝐟𝐨𝐥𝐥𝐨𝐰𝐞𝐫𝐬 : $follow\n 𖡦-› 𝐟𝐨𝐥𝐥𝐨𝐰𝐢𝐧𝐠 : $following\n 𖡦-› 𝐩𝐨𝐬𝐭 : $media\n━━━━━━━━━━━━━━━\n.💸. ᖴᖇOᗰ : @U_3_Z
.💸. ᑕᕼ : @BBTJJ",
                                
                                'parse_mode'=>'markdown']);
                                
                                bot('editMessageReplyMarkup',[
                                    'chat_id'=>$id,
                                    'message_id'=>$edit->result->message_id,
                                    'reply_markup'=>json_encode([
                                        'inline_keyboard'=>[
                [['text'=>'تم فحص : '.$i,'callback_data'=>'fgf']],
                [['text'=>'اليوزرات المفحوصة : '.$user,'callback_data'=>'fgdfg']],
                [['text'=>'EMAIL: '.$mail,'callback_data'=>'ghj']],
                [['text'=>"Gmail : $gmail",'callback_data'=>'dfgfd'],['text'=>"Yahoo : $yahoo",'callback_data'=>'gdfgfd']],
                [['text'=>'MailRu : '.$mailru,'callback_data'=>'fgd'],['text'=>'Hotmail : '.$hotmail,'callback_data'=>'ghj']],
                [['text'=>'غير مستعمل : '.$nott,'callback_data'=>'hdhdh'],['text'=>'Business ✔️ : '.$za,'callback_data'=>'hdfhdh']],
                [['text'=>'تم صيد : '.$true,'callback_data'=>'gj'],['text'=>'Not Vailds ❌: '.$false,'callback_data'=>'dghkf']],
                [['text'=>'Blacklist ♻️: '.$bla,'callback_data'=>'pvja']],
                                        ]
                                    ])
                                ]);
                                $true += 1;
                            // } else {
                            //     echo "Filter , ".$mail.PHP_EOL;
                            // }
                            
                        } else {
                          echo "No Rest $mail\n";
                        }
                    } else {
                    	$false +=1;
                        echo "Not Vaild 2 - $mail\n";
                    }
        } else {
        $bla +=1;
          echo "BlackList - $mail\n";
        }
    } else {
    		$nott +=1;
        echo "Not Bussines - $user\n";
    }
    usleep(750000);
    $i++;
    if($i == $editAfter){
        bot('editMessageReplyMarkup',[
            'chat_id'=>$id,
            'message_id'=>$edit->result->message_id,
            'reply_markup'=>json_encode([
                'inline_keyboard'=>[
                [['text'=>'تم فحص : '.$i,'callback_data'=>'fgf']],
                [['text'=>'اليوزرات المفحوصة : '.$user,'callback_data'=>'fgdfg']],
                [['text'=>'EMAIL: '.$mail,'callback_data'=>'ghj']],
                [['text'=>"Gmail : $gmail",'callback_data'=>'dfgfd'],['text'=>"Yahoo : $yahoo",'callback_data'=>'gdfgfd']],
                [['text'=>'MailRu : '.$mailru,'callback_data'=>'fgd'],['text'=>'Hotmail : '.$hotmail,'callback_data'=>'ghj']],
                [['text'=>'غير مستعمل : '.$nott,'callback_data'=>'hdhdh'],['text'=>'Business ✔️ : '.$za,'callback_data'=>'hdfhdh']],
                [['text'=>'تم صيد : '.$true,'callback_data'=>'gj'],['text'=>'Not Vailds ❌: '.$false,'callback_data'=>'dghkf']],
                [['text'=>'Blacklist ♻️: '.$bla,'callback_data'=>'pvja']],
                  [['text'=>'Not Vailds ❌: '.$false,'callback_data'=>'dghkf']]
                ]
            ])
        ]);
        $editAfter += 1;
    }
}
bot('sendMessage', ['chat_id' => $id, 'text' =>"  تم انتهاء الفحص   : ".explode(':',$screen)[0]]);

