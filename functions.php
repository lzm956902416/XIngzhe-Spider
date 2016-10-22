<?php
/**
 * 爬取行者的GPX数据。
 *
 * @param int $id
 *        	行者轨迹ID
 * @return GPX数据
 */
function getGPX($id) {
	global $sessionId, $folder;
	$url = 'http://www.imxingzhe.com/xing/' . $id . '/gpx/'; // 欲爬取的url
	
	$ch = curl_init ( $url );
	curl_setopt ( $ch, CURLOPT_COOKIE, 'sessionid=' . $sessionId ); // 模拟登录
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true ); // 存入$result而不是直接输出
	$result = curl_exec ( $ch );
	curl_close ( $ch );
	
	return $result == NULL ? false : $result;
}

/**
 * 将指定内容写入文件。
 *
 * @param String $content
 *        	欲写入的内容
 * @param String $filename
 *        	欲存入的文件名
 */
function write2File($content, $filename) {
	$file = fopen ( $filename, 'a' );
	fwrite ( $file, $content );
	fclose ( $file );
}

// TODO zip打包gpx