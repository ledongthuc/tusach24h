<?php 
function RandomID()
{
	$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
	$size = strlen( $chars );
	for( $i = 0; $i < 14; $i++ ) {
		$id .= $chars[ rand( 0, $size - 1 ) ];
	}
	return $id;
}
function GetPageContent($url)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	$data=curl_exec($ch);
	curl_close ($ch);
	return $data;
}

function GetLinkMobiFile($id)
{
	$data = GetPageContent("http://www.convertfiles.com/convertrogressbar.php?progress_key=" . $id);
	$arr = explode("\"", $data);
	$link = explode("\"", $arr[1]);
	return $link[0];
}
function DownloadTextFile($id, $url)
{
	$path = 'upload/story_sources/' . $id . '.html';
	$del_path = 'upload/story_mobies/' . $id . '.mobi';
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($ch);
	if (isset($_POST['del_empty_line']))
	{
		$fix_unicode = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head><body>';
		$body = preg_replace('/^[ \t]*[\r\n]+/m', '', $data);
		$body = str_replace("\r\n", "<br/>", $body);
		$data = $fix_unicode . $body . '</body></html>';
	}
	else 
	{
		$fix_unicode = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head><body>';
		$body = str_replace("\r\n", "<br/>", $data);
		$data = $fix_unicode . $body . '</body></html>';
	}
	curl_close($ch);
	
	
	
	file_put_contents($path, $data);
	if ($data != "")
	{
		@unlink($del_path);
		return 	'<h3>Hoàn tất.</h3><p><a href="../upload/story_sources/' . $id . '.html" target="_blank" title="Click phải, chọn save as... để tải tập tin.">Mở tập tin này</a></p>'.
				'<form action="" method="post">'.
				'<input type="hidden" value="'.$_POST["story"].'" name="truyenid" />'.
				'<input type="hidden" value="'.$_POST['id'].'" name="source" />'.
				'<p><input type="checkbox" name="cbsource" id="cb" /> <label for="cb">Bạn có muốn chọn file này làm source? Bạn có thể xóa sau khi hoàn tất thêm trang cho truyện.</label></p>'.
				'<input type="submit" value="Chọn" onclick="javascript:Loading();" />'.
				'</form>';
	}
	else
	{
		return 'Thời gian chuyển chưa đủ. Bạn vui lòng <form><input type="button" value=" thử lại" onclick="history.go(-1)"></form>.';
	}
}
function Convert($id)
{
	$post = array(
			"APC_UPLOAD_PROGRESS" => $id,
			"MAX_FILE_SIZE" => "",
			"storedOpt" => "26",
			"FileOrURLFlag" => "url",
			"http_referer" => "",
			"aid" => "",
			"file_or_url" => "url",
			"input_format" => ".mobi",
			"output_format" => ".txt",
			"email" => "",
			//"uploadedfile" => "@".$file_path
			"download_url" => "http://tusach24h.com/admin_panel/upload/story_mobies/$id.mobi"
	);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"http://www.convertfiles.com/converter.php");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	$data=curl_exec($ch);
	curl_close ($ch);

	$flag = true;
	$result = "";
	while($flag)
	{
		$percent = GetPageContent("http://www.convertfiles.com/getprogress.php?progress_key=" . $id);
		if ($percent == "100")
		{
			//echo $percent;
			$flag = false;
		}
	}
	return $data;
}
?>