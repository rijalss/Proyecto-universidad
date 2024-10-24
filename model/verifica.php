<?php
class verifica{
	function leesesion(){
		
		if(empty($_SESSION)){
		  session_start();
		}
	  	if(isset($_SESSION['name'])){
			$s = $_SESSION['name'];
		}	  
		else{
		    $s = "";
		}
		return $s;
	}
	function destruyesesion(){
		session_start();
		session_destroy();
		header("Location: . ");
	}
}
?>