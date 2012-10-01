<?php 
function check_string_length($string, $min, $max)
{
	if((strlen(strval($string)) > ($min - 1) && (strlen(strval($string)) < $max)))
	{
		return 1;
	}
	else
	{
		return 0;
	}
}
function check_string_db_available($tbl, $column, $string)
{
	try 
	{
		$table = Zend_Db_Table::getDefaultAdapter();
		$sql = "SELECT * FROM $tbl WHERE $column = ?";
		$data = $table->query($sql, $string)->fetchAll();
		$count = count($data);
		if($count == 0)
		{
			return 1;
		}	
		else 
		{
			return 0;
		}
	} 
	catch (Exception $e) {
		return 0;
	}
	
}
function check_pass_match($pass_1, $pass_2)
{
	if($pass_1 == $pass_2)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}

function check_username_format($username)
{	
	if(ereg('^[a-z0-9_]{6,32}$', $username))
	{
		return 1;
	}
	else 
	{
		return 0;
	}
}
function check_email_format($email)
{
	$email_validator = new Zend_Validate_EmailAddress();
	if($email_validator->isValid($email))
	{
		return 1;
	}
	else
	{
		return 0;
	}
}
function check_captcha_match($challenge, $response, $public_key, $private_key)
{
	$captcha = new Zend_Service_ReCaptcha($public_key, $private_key);
	$result = $captcha->verify($challenge, $response);
	if($result->isValid())
	{
		return 1;
	}
	else
	{
		return 0;
	}
}
function EncryptPassword($value, $string_hash)
{
	for($i = 0; $i < 9; $i++)
	{
		$value = md5($value . $string_hash);
	}	
	return $value;
}
?>