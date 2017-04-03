<?php
$access_token = 'yATEFXRiGBMdLHONoWTkIduiBN5t2tAlhI3qsH6bvSMnlslg6Ve6ax5CHvXW3LgTsDPO5h/z6VmbX6GHh7hx28AiV3FW/ZqoP1cZJxqDu8WoXl7hoq46PCT6gJoTCuodQl3qPHugynJ18leRiS09IgdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		$responce = "พูดอัลไลมะถวกไม่เข้าจายยย";
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$message = $event['message']['text'];
			if(strpos($message, "กี่โมงแล้ว") !== false){
				$responce = date("g:i a");
			}else if(strpos($message, "กินอะไร") !== false){
				$currentHour = (date('h')+7);
				if ($currentHour>5 && $currentHour<9) {
					$responce = "อาหารเช้า ควรเป็นอาหารเบาๆ เช่นโจ๊กดีม๊ะ";
				}else if($currentHour>11 && $currentHour<14){
					$responce = "กลางวันต้องจัดหนัก ผัดกระเพราพิเศษเป็นไง";
				}else if($currentHour>17 && $currentHour<21){
					$responce = "เวลานี้ะไรก็ได้มั้ง เน้นมีเหล้าขายเป็นพอ กิกิ";
				}else{
					$responce = "ใช้เวลาแดกมั้ยมึง แสรดดดดดดดดดดด อีอ้วน";
				}
			}else if(strpos($message, "สวัสดี") !== false){
				$responce = "สวัสดีจ้าา คิคิ";
			}else if(strpos($message, "เป็นคนยังไง") !== false){
				$testlist = explode("เป็นคนยังไง", $message);
				$testlist[0];
				$input = array("ดูดี", "ขี้เหล่", "ติงต๊อง", "บ้าบอ", "แปลกๆ","ไม่อยากจะบรรยาย", "ไม่รู้เว้ยยย");
				$rand_keys = rand(0, 6);
				$responce = ($testlist[0]."เป็นคน".$input[$rand_keys]);
			}else if(strpos($message, "ดีมั้ย")!== false){
				$input = array("จัดไป", "ดีซิ","ไม่ดีหรอกแกร");
				$rand_keys = rand(0, $input.count);
				$responce = $input[$rand_keys];
			}else if(strpos($message, "หิว")!== false){
				$input = array("สงบจิตใจแล้วทนไป", "อย่างนี้ต้องจัด");
				$rand_keys = rand(0, $input.count);
				$responce = $input[$rand_keys];
			}

		}else if ($event['type'] == 'message' && $event['message']['type'] == 'image') {
			# code...
			// Get text sent
			$responce = "รูปสวยมากๆจร๊ะ";
		}
			$replyToken = $event['replyToken'];
				$messages = [
				'type' => 'text',
				'text' => $responce
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);
			
	}
}
?>

