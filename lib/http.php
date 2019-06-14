<?php
namespace lib\http;

class Http {

	public function alimama_get($url) {

		$header = array(
			"method" => "get",
			"scheme" => "https",
			"Accept" => "application/json, text/javascript, */*; q=0.01",
			"X-Requested-With" => "XMLHttpRequest",
			"User-Agent" => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36",
			"Accept-Encoding" => "gzip, deflate, sdch",
			"Accept-Language" => "zh,en-US;q=0.8,en;q=0.6,zh-CN;q=0.4,zh-TW;q=0.2",
			"content-type:" => "text/html;charset=GBK",
		);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,3000);
		$data = curl_exec($curl);
		curl_close($curl);
		return $data;
	}

	public function get_http($url){

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($curl);
        curl_close($curl);
        return $data;
    }
}