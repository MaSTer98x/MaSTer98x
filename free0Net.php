<?php

$API_KEY = '1177378670:AAHEatrfANVoiu6Aq6Dd1aqxWnpceHJuPyk';  
define('API_KEY',$API_KEY);
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}


$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$text = $message->text;
$chat_id = $message->chat->id;
$mid = $message->message_id;
$id = $message->from->id;
$username = $message->from->username;
$first_name = $message->from->first_name;
$last_name = $message->from->last_name;
$type = $message->chat->type;
$group_name = $message->chat->title;
$chat_id2 = $update->callback_query->message->chat->id;
$msg_id = $update->callback_query->message->message_id;
$data = $update->callback_query->data;
$get_ids = file_get_contents('ids.txt');
$ids = explode("\n", $get_ids);
$get_groups = file_get_contents("Groups.txt");
$groups = explode("\n", $get_groups);
$you = bot('getChatMember',['chat_id'=>$chat_id,'user_id'=>$id])->result->status;
$join = bot('getChatMember',['chat_id'=>"@M_Ld1",'user_id'=>$id])->result->status;
$sudo = 204535577; // ايدي المطور 

$count1 = count($ids);
$count2 = count($groups);
if($text == "/panel" and $type == "private" and $id == $sudo){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"Bot Users : " . $count1 . "\n" . "Bot Groups : " . $count2,
]);
}

$bc = explode("/bcu", $text);

if($bc and $id == $sudo){
for($y=0;$y<count($ids); $y++){
bebo('sendMessage', [
'chat_id'=>$ids[$y],
'text'=>"$bc[1]",
'parse_mode'=>'markdown',
'disable_web_page_preview'=>true,
]);
}
}

$bc = explode("/bcu", $text);

if($bc and $id == $sudo){
for($y=0;$y<count($groups); $y++){
bebo('sendMessage', [
'chat_id'=>$groups[$y],
'text'=>"$bc[1]",
'parse_mode'=>'markdown',
'disable_web_page_preview'=>true,
]);
}
}


if($text == "/start" and $join == 'left' and $type == "private"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
'text'=>"📛 ¦ عذرا عزيزي $n1
⚠️ ¦ يجب ان تشترك في قناة البوت اولا 
‼️¦ البوت لن يستجيب للاوامر بدون اشتراك المشرفين في المجموعة 
〰〰〰〰
📛 ¦ *Sorry Dear*
⚠️ ¦ *You Must Subscribe To The Channel First*
‼️ ¦ *Bot will not respond to orders without the subscription of the group administrators*",
'reply_to_message_id'=>$mid,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
    [['text'=>"اضغط هنا للأشتراك ☄️💥", 'url'=>"https://t.me/free_syria_max"]],
]
])
]);
}

if($text == '/start' and !in_array($id,$ids) and $type == 'private' and $join != 'left'){
file_put_contents("ids.txt", $id . "\n", FILE_APPEND);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👾¦ اهلا وسهلا بك عزيزي في بوت حماية المجموعات ( *100k* )" . "\n" . "☄️¦ البوت يقوم بحماية مجموعتك بطريقتين ( * التقييد + الحذف * )" . "\n" . "➕¦ فقط اضف البوت لمجموعتك وارسل ( * تفعيل * ) " . "\n" . "📬¦ تمت الكتابة بيد ( *@M_Ld1* )",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"معلوماتك 🔰",'callback_data'=>'information']],
[['text'=>"UserName :  " . $username,'callback_data'=>'username']],
[['text'=>"UserID : " . $id,'callback_data'=>'Id']],
[['text'=>"UserFUllName :  " . $first_name . " " . $last_name,'callback_data'=>'Name']],
[['text'=>"أضف البوت لمجموعتك ➕",'url'=>'https://t.me/botusername?startgroup=new']] // خلي معرف بوتك بمكان ( Net_7_BOT )
]
])
]);}
if($text == '/start' and in_array($id,$ids) and $type == 'private' and $join != 'left'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👾¦ اهلا وسهلا بك عزيزي في بوت حماية المجموعات ( *100k* )" . "\n" . "☄️¦ البوت يقوم بحماية مجموعتك بطريقتين ( * التقييد + الحذف * )" . "\n" . "➕¦ فقط اضف البوت لمجموعتك وارسل ( * تفعيل * ) " . "\n" ."📬¦ تمت الكتابة بيد ( *@M_Ld1* )",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"معلوماتك 🔰",'callback_data'=>'information']],
[['text'=>"UserName :  " . $username,'callback_data'=>'username']],
[['text'=>"UserID : " . $id,'callback_data'=>'Id']],
[['text'=>"UserFUllName :  " . $first_name . " " . $last_name,'callback_data'=>'Name']],
[['text'=>"أضف البوت لمجموعتك ➕",'url'=>'https://t.me/Net_7_BOT?startgroup=new']]             (botusername )

]
])
]);
}

if($text == "تفعيل" and !in_array($chat_id,$groups) and $join != 'left' and $you == "creator" and $type == 'supergroup'){
file_put_contents("Groups.txt", $chat_id . "\n", FILE_APPEND);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🆔¦ ايديك : " . "*" . $id . "*" . "\n" . "🛑¦ايدي المجموعة  : " . "*" . $chat_id. "*" . "\n" . "⚠️¦ تم تفعيل البوت في المجموعة بنجاح",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "تفعيل" and in_array($chat_id,$groups) and $join != 'left' and $you == "creator" and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"⚠️¦ البوت بالفعل تم تفعيله في المجموعة",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "تعطيل" and in_array($chat_id,$groups) and $join != 'left' and $you == "creator" and $type == 'supergroup'){
$open = file_get_contents("Groups.txt");
$str = str_replace("$chat_id", "", $open);
$open = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $open);
file_put_contents("Groups.txt", $str);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🆔¦ ايديك : " . "*" . $id . "*" . "\n" . "🛑¦ايدي المجموعة  : " . "*" . $chat_id. "*" . "\n" . "⚠️¦ تم تعطيل البوت في المجموعة بنجاح",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "تعطيل" and !in_array($chat_id,$groups) and $join != 'left' and $you == "creator" and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"⚠️¦ البوت بالفعل تم تعطيله في المجموعة",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

$get_tqeed = file_get_contents("tqeed/fwd.txt");
$tq_fwd = explode("\n", $get_tqeed);
mkdir("tqeed");

if($text == "قفل التوجيه بالتقييد" and in_array($chat_id,$groups) and !in_array($chat_id,$tq_fwd) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
file_put_contents("tqeed/fwd.txt", $chat_id . "\n", FILE_APPEND);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم قفل التوجيه بالتقييد بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "قفل التوجيه بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_fwd) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ التوجيه بالتقييد بالفعل تم قفلة 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح التوجيه بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_fwd) and $join != 'left' and $you != "member" and $type == 'supergroup'){
$open = file_get_contents("tqeed/fwd.txt");
$str = str_replace("$chat_id", "", $open);
$open = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $open);
file_put_contents("tqeed/fwd.txt", $str);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم فتح التوجيه بالتقييد بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح التوجيه بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_fwd) and $join != 'left' and $you != "member" and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ التوجيه بالتقييد بالفعل تم فتحة 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}
if($message->forward_from_chat and in_array($chat_id, $groups) and in_array($chat_id,$tq_fwd) and $you == "member" and $type == 'supergroup'){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$mid,
]);
bot('restrictChatMember',[
'chat_id'=>$chat_id,
'user_id'=>$id,
'can_send_messages'=>FALSE,
'can_send_media_messages'=>FALSE,
'can_send_other_messages'=>FALSE,
'can_add_web_page_previews'=>FALSE,
]);
}

$tqeed_links = file_get_contents("tqeed/links.txt");
$tq_links = explode("\n", $tqeed_links);

if($text == "قفل الروابط بالتقييد" and in_array($chat_id,$groups) and !in_array($chat_id,$tq_links) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
file_put_contents("tqeed/links.txt", $chat_id . "\n", FILE_APPEND);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم قفل الروابط بالتقييد بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "قفل الروابط بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_links) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ الروابط بالتقييد بالفعل تم قفلها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح الروابط بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_links) and $join != 'left' and $you != "member" and $type == 'supergroup'){
$open = file_get_contents("tqeed/links.txt");
$str = str_replace("$chat_id", "", $open);
$open = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $open);
file_put_contents("tqeed/links.txt", $str);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم فتح الروابط بالتقييد بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح الروابط بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_links) and $join != 'left' and $you != "member" and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ الروابط بالتقييد بالفعل تم فتحها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}
if(preg_match('/^([Hh]ttp|[Hh]ttps|[Tt].[Mm][Ee]|[Tt][Ee][Ll][Ee][Gg][Rr][Aa][Mm].[Mm][Ee]|[Tt][Ll][Gg][Rr][Mm].[Mm][Ee]|[Tt][Ee][Ll][Ee][Ss][Cc][Oo].[Pp][Ee])(.*)/',$text) and in_array($chat_id, $groups) and in_array($chat_id,$tq_links) and $you == "member" and $type == 'supergroup'){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$mid,
]);
bot('restrictChatMember',[
'chat_id'=>$chat_id,
'user_id'=>$id,
'can_send_messages'=>FALSE,
'can_send_media_messages'=>FALSE,
'can_send_other_messages'=>FALSE,
'can_add_web_page_previews'=>FALSE,
]);
}

$tqeed_photo = file_get_contents("tqeed/photo.txt");
$tq_photo = explode("\n", $tqeed_photo);

if($text == "قفل الصور بالتقييد" and in_array($chat_id,$groups) and !in_array($chat_id,$tq_photo) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
file_put_contents("tqeed/photo.txt", $chat_id . "\n", FILE_APPEND);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم قفل الصور بالتقييد بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "قفل الصور بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_photo) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ الصور بالتقييد بالفعل تم قفلها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح الصور بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_photo) and $join != 'left' and $you != "member" and $type == 'supergroup'){
$open = file_get_contents("tqeed/photo.txt");
$str = str_replace("$chat_id", "", $open);
$open = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $open);
file_put_contents("tqeed/photo.txt", $str);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم فتح الصور بالتقييد بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح التوجيه بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_photo) and $join != 'left' and $you != "member" and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ الصور بالتقييد بالفعل تم فتحها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}
if($message->photo and in_array($chat_id, $groups) and in_array($chat_id,$tq_photo) and $you == "member" and $type == 'supergroup'){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$mid,
]);
bot('restrictChatMember',[
'chat_id'=>$chat_id,
'user_id'=>$id,
'can_send_messages'=>FALSE,
'can_send_media_messages'=>FALSE,
'can_send_other_messages'=>FALSE,
'can_add_web_page_previews'=>FALSE,
]);
}

$tqeed_voice = file_get_contents("tqeed/voice.txt");
$tq_voice = explode("\n", $tqeed_voice);

if($text == "قفل البصمه بالتقييد" and in_array($chat_id,$groups) and !in_array($chat_id,$tq_voice) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
file_put_contents("tqeed/voice.txt", $chat_id . "\n", FILE_APPEND);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم قفل البصمة بالتقييد بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "قفل البصمه بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_voice) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ البصمه بالتقييد بالفعل تم قفلها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح البصمه بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_voice) and $join != 'left' and $you != "member" and $type == 'supergroup'){
$open = file_get_contents("tqeed/voice.txt");
$str = str_replace("$chat_id", "", $open);
$open = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $open);
file_put_contents("tqeed/voice.txt", $str);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم فتح البصمه بالتقييد بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح البصمه بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_voice) and $join != 'left' and $you != "member" and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ البصمه بالتقييد بالفعل تم فتحها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}
if($message->voice and in_array($chat_id, $groups) and in_array($chat_id,$tq_voice) and $you == "member" and $type == 'supergroup'){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$mid,
]);
bot('restrictChatMember',[
'chat_id'=>$chat_id,
'user_id'=>$id,
'can_send_messages'=>FALSE,
'can_send_media_messages'=>FALSE,
'can_send_other_messages'=>FALSE,
'can_add_web_page_previews'=>FALSE,
]);
}

$tqeed_audio = file_get_contents("tqeed/audio.txt");
$tq_audio = explode("\n", $tqeed_audio);

if($text == "قفل الصوت بالتقييد" and in_array($chat_id,$groups) and !in_array($chat_id,$tq_audio) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
file_put_contents("tqeed/audio.txt", $chat_id . "\n", FILE_APPEND);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم قفل الصوت بالتقييد بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "قفل الصوت بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_audio) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ الصوت بالتقييد بالفعل تم قفله 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح الصوت بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_audio) and $join != 'left' and $you != "member" and $type == 'supergroup'){
$open = file_get_contents("tqeed/audio.txt");
$str = str_replace("$chat_id", "", $open);
$open = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $open);
file_put_contents("tqeed/audio.txt", $str);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم فتح الصوت بالتقييد بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح الصوت بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_audio) and $join != 'left' and $you != "member" and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ البصمه بالتقييد بالفعل تم فتحها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}
if($message->audio and in_array($chat_id, $groups) and in_array($chat_id,$tq_audio) and $you == "member" and $type == 'supergroup'){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$mid,
]);
bot('restrictChatMember',[
'chat_id'=>$chat_id,
'user_id'=>$id,
'can_send_messages'=>FALSE,
'can_send_media_messages'=>FALSE,
'can_send_other_messages'=>FALSE,
'can_add_web_page_previews'=>FALSE,
]);
}

$tqeed_doc = file_get_contents("tqeed/doc.txt");
$tq_doc = explode("\n", $tqeed_doc);

if($text == "قفل المتحركه بالتقييد" and in_array($chat_id,$groups) and !in_array($chat_id,$tq_doc) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
file_put_contents("tqeed/doc.txt", $chat_id . "\n", FILE_APPEND);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم قفل الصور المتحركة والملفات بالتقييد بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "قفل المتحركه بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_doc) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ الصور المتحركه والملفات بالتقييد بالفعل تم قفلها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح المتحركه بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_doc) and $join != 'left' and $you != "member" and $type == 'supergroup'){
$open = file_get_contents("tqeed/doc.txt");
$str = str_replace("$chat_id", "", $open);
$open = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $open);
file_put_contents("tqeed/doc.txt", $str);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم فتح الصور المتحركة والملفات بالتقييد بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح المتحركه بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_doc) and $join != 'left' and $you != "member" and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ الصور المتحركة والملفات بالتقييد بالفعل تم فتحها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}
if($message->document and in_array($chat_id, $groups) and in_array($chat_id,$tq_doc) and $you == "member" and $type == 'supergroup'){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$mid,
]);
bot('restrictChatMember',[
'chat_id'=>$chat_id,
'user_id'=>$id,
'can_send_messages'=>FALSE,
'can_send_media_messages'=>FALSE,
'can_send_other_messages'=>FALSE,
'can_add_web_page_previews'=>FALSE,
]);
}

$tqeed_game = file_get_contents("tqeed/game.txt");
$tq_game = explode("\n", $tqeed_game);

if($text == "قفل الالعاب بالتقييد" and in_array($chat_id,$groups) and !in_array($chat_id,$tq_game) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
file_put_contents("tqeed/game.txt", $chat_id . "\n", FILE_APPEND);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم قفل الالعاب بالتقييد بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "قفل الالعاب بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_game) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦الالعاب بالتقييد بالفعل تم قفلها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح الالعاب بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_game) and $join != 'left' and $you != "member" and $type == 'supergroup'){
$open = file_get_contents("tqeed/game.txt");
$str = str_replace("$chat_id", "", $open);
$open = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $open);
file_put_contents("tqeed/game.txt", $str);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم فتح الالعاب بالتقييد بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح الالعاب بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_game) and $join != 'left' and $you != "member" and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ الالعاب بالتقييد بالفعل تم فتحها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}
if($message->game and in_array($chat_id, $groups) and in_array($chat_id,$tq_game) and $you == "member" and $type == 'supergroup'){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$mid,
]);
bot('restrictChatMember',[
'chat_id'=>$chat_id,
'user_id'=>$id,
'can_send_messages'=>FALSE,
'can_send_media_messages'=>FALSE,
'can_send_other_messages'=>FALSE,
'can_add_web_page_previews'=>FALSE,
]);
}

$tqeed_sticker = file_get_contents("tqeed/sticker.txt");
$tq_sticker = explode("\n", $tqeed_sticker);

if($text == "قفل الملصقات بالتقييد" and in_array($chat_id,$groups) and !in_array($chat_id,$tq_sticker) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
file_put_contents("tqeed/sticker.txt", $chat_id . "\n", FILE_APPEND);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم قفل الملصقات بالتقييد بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "قفل الملصقات بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_sticker) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"الملصقات بالتقييد بالفعل تم قفلها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح الملصقات بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_sticker) and $join != 'left' and $you != "member" and $type == 'supergroup'){
$open = file_get_contents("tqeed/sticker.txt");
$str = str_replace("$chat_id", "", $open);
$open = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $open);
file_put_contents("tqeed/sticker.txt", $str);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم فتح الملصقات بالتقييد بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح الملصقات بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_sticker) and $join != 'left' and $you != "member" and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ الملصقات بالتقييد بالفعل تم فتحها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}
if($message->sticker and in_array($chat_id, $groups) and in_array($chat_id,$tq_game) and $you == "member" and $type == 'supergroup'){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$mid,
]);
bot('restrictChatMember',[
'chat_id'=>$chat_id,
'user_id'=>$id,
'can_send_messages'=>FALSE,
'can_send_media_messages'=>FALSE,
'can_send_other_messages'=>FALSE,
'can_add_web_page_previews'=>FALSE,
]);
}

$tqeed_video = file_get_contents("tqeed/video.txt");
$tq_video = explode("\n", $tqeed_video);

if($text == "قفل الفيديو بالتقييد" and in_array($chat_id,$groups) and !in_array($chat_id,$tq_video) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
file_put_contents("tqeed/video.txt", $chat_id . "\n", FILE_APPEND);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم قفل الفيديو بالتقييد بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "قفل الفيديو بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_video) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"الفيديو بالتقييد بالفعل تم قفله 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح الفيديو بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_video) and $join != 'left' and $you != "member" and $type == 'supergroup'){
$open = file_get_contents("tqeed/video.txt");
$str = str_replace("$chat_id", "", $open);
$open = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $open);
file_put_contents("tqeed/video.txt", $str);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم فتح الفيديو بالتقييد بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح الفيديو بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_video) and $join != 'left' and $you != "member" and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ الفيديو بالتقييد بالفعل تم فتحه 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}
if($message->video and in_array($chat_id, $groups) and in_array($chat_id,$tq_video) and $you == "member" and $type == 'supergroup'){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$mid,
]);
bot('restrictChatMember',[
'chat_id'=>$chat_id,
'user_id'=>$id,
'can_send_messages'=>FALSE,
'can_send_media_messages'=>FALSE,
'can_send_other_messages'=>FALSE,
'can_add_web_page_previews'=>FALSE,
]);
}

$tqeed_contact = file_get_contents("tqeed/contact.txt");
$tq_contact = explode("\n", $tqeed_contact);

if($text == "قفل الجهات بالتقييد" and in_array($chat_id,$groups) and !in_array($chat_id,$tq_contact) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
file_put_contents("tqeed/contact.txt", $chat_id . "\n", FILE_APPEND);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم قفل جهات الاتصال بالتقييد بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "قفل الجهات بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_contact) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"جهات الاتصال بالتقييد بالفعل تم قفلها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح الجهات بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_contact) and $join != 'left' and $you != "member" and $type == 'supergroup'){
$open = file_get_contents("tqeed/contact.txt");
$str = str_replace("$chat_id", "", $open);
$open = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $open);
file_put_contents("tqeed/contact.txt", $str);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم فتح جهات الاتصال بالتقييد بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح الجهات بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_contact) and $join != 'left' and $you != "member" and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ جهات الاتصال بالتقييد بالفعل تم فتحها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}
if($message->contact and in_array($chat_id, $groups) and in_array($chat_id,$tq_video) and $you == "member" and $type == 'supergroup'){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$mid,
]);
bot('restrictChatMember',[
'chat_id'=>$chat_id,
'user_id'=>$id,
'can_send_messages'=>FALSE,
'can_send_media_messages'=>FALSE,
'can_send_other_messages'=>FALSE,
'can_add_web_page_previews'=>FALSE,
]);
}

$tqeed_edit = file_get_contents("tqeed/edit.txt");
$tq_edit = explode("\n", $tqeed_edit);

if($text == "قفل التعديل بالتقييد" and in_array($chat_id,$groups) and !in_array($chat_id,$tq_edit) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
file_put_contents("tqeed/edit.txt", $chat_id . "\n", FILE_APPEND);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم قفل التعديل بالتقييد بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "قفل التعديل بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_edit) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ التعديل بالتقييد بالفعل تم قفلة 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح التعديل بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_edit) and $join != 'left' and $you != "member" and $type == 'supergroup'){
$open = file_get_contents("tqeed/edit.txt");
$str = str_replace("$chat_id", "", $open);
$open = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $open);
file_put_contents("tqeed/edit.txt", $str);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم فتح التعديل بالتقييد بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح التعديل بالتقييد" and in_array($chat_id,$groups) and in_array($chat_id,$tq_edit) and $join != 'left' and $you != "member" and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ التعديل بالتقييد بالفعل تم فتحها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}
if($update->edited_message and in_array($chat_id,$groups) and in_array($chat_id,$tq_edit) and $you == "member" and $type == "supergroup"){
bot('deletemessage',[
'chat_id'=>$update->edited_message->chat->id,
'message_id'=>$update->edited_message->message_id,
]);
bot('restrictChatMember',[
'chat_id'=>$chat_id,
'user_id'=>$id,
'can_send_messages'=>FALSE,
'can_send_media_messages'=>FALSE,
'can_send_other_messages'=>FALSE,
'can_add_web_page_previews'=>FALSE,
]);
}

/* Start With Delete Msg */

$del_fwd = file_get_contents("delete/fwd.txt");
$dl_fwd = explode("\n", $del_fwd);
mkdir("delete");

if($text == "قفل التوجيه بالحذف" and in_array($chat_id,$groups) and !in_array($chat_id,$dl_fwd) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
file_put_contents("delete/fwd.txt", $chat_id . "\n", FILE_APPEND);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم قفل التوجيه بالحذف بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "قفل التوجيه بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_fwd) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ التوجيه بالحذف بالفعل تم قفلة 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح التوجيه بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_fwd) and $join != 'left' and $you != "member" and $type == 'supergroup'){
$open = file_get_contents("delete/fwd.txt");
$str = str_replace("$chat_id", "", $open);
$open = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $open);
file_put_contents("delete/fwd.txt", $str);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم فتح التوجيه بالحذف بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح التوجيه بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_fwd) and $join != 'left' and $you != "member" and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ التوجيه بالحذف بالفعل تم فتحة 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}
if($message->forward_from_chat and in_array($chat_id, $groups) and in_array($chat_id,$dl_fwd) and $you == "member" and $type == 'supergroup'){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$mid,
]);
}

$del_links = file_get_contents("delete/links.txt");
$dl_links = explode("\n", $del_links);

if($text == "قفل الروابط بالحذف" and in_array($chat_id,$groups) and !in_array($chat_id,$dl_links) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
file_put_contents("delete/links.txt", $chat_id . "\n", FILE_APPEND);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم قفل الروابط بالحذف بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "قفل الروابط بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_links) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ الروابط بالحذف بالفعل تم قفلها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح الروابط بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_links) and $join != 'left' and $you != "member" and $type == 'supergroup'){
$open = file_get_contents("delete/links.txt");
$str = str_replace("$chat_id", "", $open);
$open = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $open);
file_put_contents("delete/links.txt", $str);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم فتح الروابط بالحذف بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح الروابط بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_links) and $join != 'left' and $you != "member" and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ الروابط بالحذف بالفعل تم فتحها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}
if(preg_match('/^([Hh]ttp|[Hh]ttps|[Tt].[Mm][Ee]|[Tt][Ee][Ll][Ee][Gg][Rr][Aa][Mm].[Mm][Ee]|[Tt][Ll][Gg][Rr][Mm].[Mm][Ee]|[Tt][Ee][Ll][Ee][Ss][Cc][Oo].[Pp][Ee])(.*)/',$text) and in_array($chat_id, $groups) and in_array($chat_id,$tq_links) and $you == "member" and $type == 'supergroup'){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$mid,
]);
}

$del_photo = file_get_contents("delete/photo.txt");
$dl_photo = explode("\n", $del_photo);

if($text == "قفل الصور بالحذف" and in_array($chat_id,$groups) and !in_array($chat_id,$dl_photo) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
file_put_contents("delete/photo.txt", $chat_id . "\n", FILE_APPEND);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم قفل الصور بالحذف بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "قفل الصور بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_photo) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ الصور بالحذف بالفعل تم قفلها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح الصور بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_photo) and $join != 'left' and $you != "member" and $type == 'supergroup'){
$open = file_get_contents("delete/photo.txt");
$str = str_replace("$chat_id", "", $open);
$open = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $open);
file_put_contents("delete/photo.txt", $str);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم فتح الصور بالحذف بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح التوجيه بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_photo) and $join != 'left' and $you != "member" and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ الصور بالحذف بالفعل تم فتحها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}
if($message->photo and in_array($chat_id, $groups) and in_array($chat_id,$tq_photo) and $you == "member" and $type == 'supergroup'){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$mid,
]);
}

$del_voice = file_get_contents("delete/voice.txt");
$dl_voice = explode("\n", $del_voice);

if($text == "قفل البصمه بالحذف" and in_array($chat_id,$groups) and !in_array($chat_id,$dl_voice) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
file_put_contents("delete/voice.txt", $chat_id . "\n", FILE_APPEND);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم قفل البصمة بالحذف بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "قفل البصمه بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_voice) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ بالحذف بالتقييد بالفعل تم قفلها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح البصمه بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_voice) and $join != 'left' and $you != "member" and $type == 'supergroup'){
$open = file_get_contents("delete/voice.txt");
$str = str_replace("$chat_id", "", $open);
$open = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $open);
file_put_contents("delete/voice.txt", $str);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم فتح البصمه بالحذف بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح البصمه بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_voice) and $join != 'left' and $you != "member" and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ البصمه بالحذف بالفعل تم فتحها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}
if($message->voice and in_array($chat_id, $groups) and in_array($chat_id,$dl_voice) and $you == "member" and $type == 'supergroup'){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$mid,
]);
}

$del_audio = file_get_contents("delete/audio.txt");
$dl_audio = explode("\n", $del_audio);

if($text == "قفل الصوت بالحذف" and in_array($chat_id,$groups) and !in_array($chat_id,$dl_audio) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
file_put_contents("delete/audio.txt", $chat_id . "\n", FILE_APPEND);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم قفل الصوت بالحذف بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "قفل الصوت بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_audio) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ الصوت بالحذف بالفعل تم قفله 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح الصوت بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_audio) and $join != 'left' and $you != "member" and $type == 'supergroup'){
$open = file_get_contents("delete/audio.txt");
$str = str_replace("$chat_id", "", $open);
$open = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $open);
file_put_contents("delete/audio.txt", $str);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم فتح الصوت بالحذف بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح الصوت بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_audio) and $join != 'left' and $you != "member" and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ بالحذف بالتقييد بالفعل تم فتحها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}
if($message->audio and in_array($chat_id, $groups) and in_array($chat_id,$tq_audio) and $you == "member" and $type == 'supergroup'){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$mid,
]);
}

$del_doc = file_get_contents("delete/doc.txt");
$dl_doc = explode("\n", $tqeed_doc);

if($text == "قفل المتحركه بالحذف" and in_array($chat_id,$groups) and !in_array($chat_id,$dl_doc) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
file_put_contents("delete/doc.txt", $chat_id . "\n", FILE_APPEND);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم قفل الصور المتحركة والملفات بالحذف بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "قفل المتحركه بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_doc) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ الصور المتحركه والملفات بالحذف بالفعل تم قفلها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح المتحركه بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_doc) and $join != 'left' and $you != "member" and $type == 'supergroup'){
$open = file_get_contents("delete/doc.txt");
$str = str_replace("$chat_id", "", $open);
$open = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $open);
file_put_contents("delete/doc.txt", $str);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم فتح الصور المتحركة والملفات بالحذف بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح المتحركه بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_doc) and $join != 'left' and $you != "member" and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ الصور المتحركة والملفات بالحذف بالفعل تم فتحها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}
if($message->document and in_array($chat_id, $groups) and in_array($chat_id,$dl_doc) and $you == "member" and $type == 'supergroup'){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$mid,
]);
}

$del_game = file_get_contents("delete/game.txt");
$dl_game = explode("\n", $del_game);

if($text == "قفل الالعاب بالحذف" and in_array($chat_id,$groups) and !in_array($chat_id,$dl_game) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
file_put_contents("delete/game.txt", $chat_id . "\n", FILE_APPEND);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم قفل الالعاب بالحذف بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "قفل الالعاب بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_game) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦الالعاب بالحذف بالفعل تم قفلها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح الالعاب بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_game) and $join != 'left' and $you != "member" and $type == 'supergroup'){
$open = file_get_contents("delete/game.txt");
$str = str_replace("$chat_id", "", $open);
$open = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $open);
file_put_contents("delete/game.txt", $str);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم فتح الالعاب بالحذف بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح الالعاب بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_game) and $join != 'left' and $you != "member" and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ الالعاب بالحذف بالفعل تم فتحها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}
if($message->game and in_array($chat_id, $groups) and in_array($chat_id,$dl_game) and $you == "member" and $type == 'supergroup'){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$mid,
]);
}

$del_sticker = file_get_contents("delete/sticker.txt");
$dl_sticker = explode("\n", $del_sticker);

if($text == "قفل الملصقات بالحذف" and in_array($chat_id,$groups) and !in_array($chat_id,$dl_sticker) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
file_put_contents("delete/sticker.txt", $chat_id . "\n", FILE_APPEND);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم قفل الملصقات بالحذف بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "قفل الملصقات بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_sticker) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"الملصقات بالحذف بالفعل تم قفلها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح الملصقات بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_sticker) and $join != 'left' and $you != "member" and $type == 'supergroup'){
$open = file_get_contents("delete/sticker.txt");
$str = str_replace("$chat_id", "", $open);
$open = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $open);
file_put_contents("delete/sticker.txt", $str);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم فتح الملصقات بالحذف بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح الملصقات بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_sticker) and $join != 'left' and $you != "member" and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ الملصقات بالحذف بالفعل تم فتحها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}
if($message->sticker and in_array($chat_id, $groups) and in_array($chat_id,$tq_game) and $you == "member" and $type == 'supergroup'){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$mid,
]);
}

$del_video = file_get_contents("delete/video.txt");
$dl_video = explode("\n", $del_video);

if($text == "قفل الفيديو بالحذف" and in_array($chat_id,$groups) and !in_array($chat_id,$dl_video) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
file_put_contents("delete/video.txt", $chat_id . "\n", FILE_APPEND);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم قفل الفيديو بالحذف بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "قفل الفيديو بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_video) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"الفيديو بالحذف بالفعل تم قفله 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح الفيديو بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_video) and $join != 'left' and $you != "member" and $type == 'supergroup'){
$open = file_get_contents("delete/video.txt");
$str = str_replace("$chat_id", "", $open);
$open = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $open);
file_put_contents("delete/video.txt", $str);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم فتح الفيديو بالحذف بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح الفيديو بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_video) and $join != 'left' and $you != "member" and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ الفيديو بالحذف بالفعل تم فتحه 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}
if($message->video and in_array($chat_id, $groups) and in_array($chat_id,$dl_video) and $you == "member" and $type == 'supergroup'){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$mid,
]);
}

$del_contact = file_get_contents("delete/contact.txt");
$dl_contact = explode("\n", $del_contact);

if($text == "قفل الجهات بالحذف" and in_array($chat_id,$groups) and !in_array($chat_id,$dl_contact) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
file_put_contents("delete/contact.txt", $chat_id . "\n", FILE_APPEND);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم قفل جهات الاتصال بالحذف بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "قفل الجهات بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_contact) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"جهات الاتصال بالحذف بالفعل تم قفلها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح الجهات بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_contact) and $join != 'left' and $you != "member" and $type == 'supergroup'){
$open = file_get_contents("delete/contact.txt");
$str = str_replace("$chat_id", "", $open);
$open = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $open);
file_put_contents("delete/contact.txt", $str);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم فتح جهات الاتصال بالحذف بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح الجهات بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_contact) and $join != 'left' and $you != "member" and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ جهات الاتصال بالحذف بالفعل تم فتحها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}
if($message->contact and in_array($chat_id, $groups) and in_array($chat_id,$dl_video) and $you == "member" and $type == 'supergroup'){
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$mid,
]);
}

$del_edit = file_get_contents("delete/edit.txt");
$dl_edit = explode("\n", $del_edit);

if($text == "قفل التعديل بالحذف" and in_array($chat_id,$groups) and !in_array($chat_id,$dl_edit) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
file_put_contents("delete/edit.txt", $chat_id . "\n", FILE_APPEND);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم قفل التعديل بالحذف بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "قفل التعديل بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_edit) and $join != 'left' and $you != 'member' and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ التعديل بالحذف بالفعل تم قفلة 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح التعديل بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_edit) and $join != 'left' and $you != "member" and $type == 'supergroup'){
$open = file_get_contents("delete/edit.txt");
$str = str_replace("$chat_id", "", $open);
$open = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $open);
file_put_contents("delete/edit.txt", $str);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬¦ بواسطة : " . "[" . $first_name ."](https://t.me/" . $username . ")" . "\n" . "🔐¦ تم فتح التعديل بالحذف بنجاح ✔️",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}

if($text == "فتح التعديل بالحذف" and in_array($chat_id,$groups) and in_array($chat_id,$dl_edit) and $join != 'left' and $you != "member" and $type == 'supergroup'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔐¦ التعديل بالحذف بالفعل تم فتحها 😕",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
]);
}
if($update->edited_message and in_array($chat_id,$groups) and in_array($chat_id,$dl_edit) and $you == "member" and $type == "supergroup"){
bot('deletemessage',[
'chat_id'=>$update->edited_message->chat->id,
'message_id'=>$update->edited_message->message_id,
]);
}

/* Same More Thinks */

if($text == "/me" or $text == "موقعي" or $text == "معلوماتي" and in_array($chat_id,$groups) and $type == "supergroup"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📟¦ معلوماتك هي 👇",
'reply_to_message_id'=>$mid,
'parse_mode'=>'Markdown',
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"رتبتك 🔰 : " . $you,'callback_data'=>'st']],
[['text'=>"UserName :  " . "@" . $username,'callback_data'=>'username']],
[['text'=>"UserID : " . $id,'callback_data'=>'Id']],
[['text'=>"UserFUllName :  " . $first_name . " " . $last_name,'callback_data'=>'Name']],
[['text'=>"ChatTitle: " . $group_name, 'callback_data'=>'gName'],['text'=>"ChatID: " . $caht_id , 'callback_data'=>'gid']],
]
])
]);
}
$re = $message->reply_to_message;
$re_id = $re->from->id;
if($re and $text == "رفع ادمن" and $join != "left" and $you == "creator" and $type == "supergroup" and in_array($chat_id,$groups)){
bebo('promoteChatMember',[
'chat_id'=>$chat_id,
'user_id'=>$re_id,
'can_change_info'=>TRUE,
'can_delete_messages'=>TRUE,
'can_invite_users'=>TRUE,
'can_restrict_members'=>TRUE,
'can_pin_messages'=>TRUE,
'can_promote_members'=>TRUE,
]);
bebo('sendMessage',[
'chat_id'=>$chat_id,
'parse_mode'=>'markdown',
'disable_web_page_preview'=>true,
'text'=>"👤 • العضو |*$re_id*|
☑️ • تم رفعه ادمن",
'reply_to_message_id'=>$mid,
]);
}

if($re and $text == "تنزيل ادمن" and $join != "left" and $you == "creator" and $type == "supergroup" and in_array($chat_id,$groups)){
bebo('promoteChatMember',[
'chat_id'=>$chat_id,
'user_id'=>$re_id,
'can_change_info'=>FALSE,
'can_delete_messages'=>FALSE,
'can_invite_users'=>FALSE,
'can_restrict_members'=>FALSE,
'can_pin_messages'=>FALSE,
'can_promote_members'=>FALSE,
]);
bebo('sendMessage',[
'chat_id'=>$chat_id,
'parse_mode'=>'markdown',
'disable_web_page_preview'=>true,
'text'=>"👤 • العضو |*$re_id*|
☑️ • تم تنزيله من الادمنية",
'reply_to_message_id'=>$mid,
]);
}
$re_msg = $re->message_id;
if($re and $text == "تثبيت" and $join != "left" and $you == "creator" and $type == "supergroup" and in_array($chat_id,$groups)){
bebo('pinChatMessage',[
'chat_id'=>$chat_id,
'message_id'=>$re_msg,
]);
bebo('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"☑️ • تم تثبيت الرسالة بنجاح",
'reply_to_message_id'=>$mid,
]);
}

if($re and $text == "الغاء تثبيت" and $join != "left" and $you == "creator" and $type == "supergroup" and in_array($chat_id,$groups)){
bebo('unpinChatMessage',[
'chat_id'=>$chat_id,
'message_id'=>$re_msg,
]);
bebo('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"☑️ • تم الغاء تثبيت الرسالة بنجاج",
'reply_to_message_id'=>$mid,
]);
}

if($text == "م1" and $join != "left" and $you != "member" and $type == "supergroup" and in_array($chat_id,$groups)){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"*📮 • اوامر حمايه بالحذف المجـــGroupــموعة
•  •  •  •  •  •  •  •  •  •  •  •  •  •  •  •  •  •  •
🔒 • قفل ➖ لقفل امر
🔓 • فتح ➖ لفتح امر
•  •  •  •  •  •  •  •  •  •  •  •  •  •  •  •  •  •  •
🌐 • الروابط بالحذف
💠 • التعديل بالحذف
🌀 • المتحركه بالحذف  :  الصور المتحركة : الملفات 
🖼 • الصور بالحذف

📜 • الملصقات بالحذف
🎥 • الفيديو بالحذف
♻️ • التوجيه بالحذف
🎧 • الصوت بالحذف
🎤 • البصمه بالحذف
📞 • الجهات بالحذف

📡┇Ch ~⪼* [تم الأنشاء بواسطة محمد لاند](https://t.me/free_syria_max)",
'parse_mode'=>'markdown',
'disable_web_page_preview'=>true,
'reply_to_message_id'=>$mid,
]);
}

if($text == "م2" and $join != "left" and $you != "member" and $type == "supergroup" and in_array($chat_id,$groups)){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"*📮 • اوامر حمايه بالتقييد المجـــGroupــموعة
•  •  •  •  •  •  •  •  •  •  •  •  •  •  •  •  •  •  •
🔒 • قفل ➖ لقفل امر
🔓 • فتح ➖ لفتح امر
•  •  •  •  •  •  •  •  •  •  •  •  •  •  •  •  •  •  •
🌐 • الروابط بالتقييد
💠 • التعديل بالتقييد
🌀 • المتحركه بالتقييد  :  الصور المتحركة : الملفات 
🖼 • الصور بالتقييد

📜 • الملصقات بالتقييد
🎥 • الفيديو بالتقييد
♻️ • التوجيه بالتقييد
🎧 • الصوت بالتقييد
🎤 • البصمه بالتقييد
📞 • الجهات بالتقييد

📡┇Ch ~⪼* [تم الأنشاء بواسطة محمد لاند](https://t.me/M_YT_98)",
'parse_mode'=>'markdown',
'disable_web_page_preview'=>true,
'reply_to_message_id'=>$mid,
]);
}

if($text == "/help" or $text == "الاوامر" and $join != "left" and $you != "member" and $type == "supergroup" and in_array($chat_id,$groups)){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"*🔰¦ يوجد قائمتين اوامر 👇

1️⃣¦ م1  لعرض اوامر الحذف

2️⃣¦ م2  لعرض اوامر التقييد

📡┇Ch ~⪼* [تم الأنشاء بواسطة محمد لاند](https://t.me/M_YT_98)",
'parse_mode'=>'markdown',
'disable_web_page_preview'=>true,
'reply_to_message_id'=>$mid,
]);
}
