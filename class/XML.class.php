<?php
abstract class XML 
{
	public static function xmlResponse($_data)
	{
		 header ("content-type: text/xml");
		 echo '<?xml version="1.0" encoding="UTF-8"?>';
		 echo '<response>'.$_data.'</response>';
	}					
	
	
}
?>