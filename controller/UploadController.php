<?php
require_once("../../model/Upload.php");
class UploadController 
{
	public function submitUpload()
	{
		$test = new Upload();
		$test->pushUpload();
		if(count($test::$errors)>0)
		{	
			echo "<div id='errorBox'>
			<div id='errorTitle'>
			Errors:
			</div>";
			UploadController::getInfo($test::$errors);
		}
		echo "</div>";
		if(array_key_exists("name",$test::$existingFiles))
		{
			echo "<div id='replaceBox'>
				<div id='replaceTitle'>
				Do you want to overwrite these files? :
				</div>";
			UploadController::displayInfo(Upload::$existingFiles);
		}
		echo "</div>";
		if(count($test::$successFiles)>0)
		{
			echo "<div id='successBox'>
			<div id='successTitle'>
			Successfully Uploaded :
			</div>";
			UploadController::getInfo($test::$successFiles);
		}
		echo "</div>";


	}
	public function countArray($array)
	{
		if(count($array)>0)
			return true;
		else
			return false;
	}
	public function displayInfo($data)
	{
		$counter = 0;
		//print_r($data);
		echo "<form name='replaceBox' action='' method ='POST'>";
		while($counter<count($data['name']))
		{
		//	echo $counter;
			echo "{$data['name'][$counter]} of ".floor($data['oldFileSize'][$counter]/2048)." KB with ".floor($data['newFileSize'][$counter]/2048)." KB <input type='checkbox' name='setReplace[]' value='{$data['name'][$counter]}'/><br/>";
		       $counter++;	
		}
	//	echo "<a href='' onClick='".$riskyArray=."getChkboxValidation({$counter})'>Replace</a>";
		echo "<input type='submit' value='Replace' name='replace'/>";

	} 
	public function getInfo($data)
	{
		foreach($data as $display)
		{
			echo "<div id='msgBox'>";
			echo $display;
			echo "</div>";

		}
	}
}