<?php
$newName = RandomString(14);
$allowedExts = array("jpg", "jpeg", "gif", "png");
$extension = end(explode(".", $_FILES["Filedata"]["name"]));
if (in_array($extension, $allowedExts))
{
	if ($_FILES["Filedata"]["size"] < 200000)
	{
		if ($_FILES["Filedata"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["Filedata"]["error"] . "<br />";
		}
		else
		{
			if (file_exists("../../upload/story_images/" . $_FILES["Filedata"]["name"]))
			{
				echo 2;
			}
			else
			{
				move_uploaded_file($_FILES["Filedata"]["tmp_name"],
				"../../upload/story_images/" . $newName .'.'. $extension);
				echo $newName .'.'. $extension;
			}
		}
	}
	else
	{
		echo 1;
	}
}
else
{
	echo 0;
}
//0: type is invalid
//1: size > 500kb
//2: file exist
function RandomString($length)
{
	$chars = "abcdefghijklmnopqrstuvwxyz0123456789";	
	$size = strlen( $chars );
	for( $i = 0; $i < $length; $i++ ) {
		$id .= $chars[ rand( 0, $size - 1 ) ];
	}
	return $id;
}
?>