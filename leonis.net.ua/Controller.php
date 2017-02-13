<?php 

class index
{
	private $db;
	private $error;

	public function __construct()
	{
		$this->db = new db();
		if(isset($_GET['send'])) return $this->ajax();
		return $this->IndexView();
	}

	public function IndexView()
	{
		if (! $this->UploadFile()) echo $this->error;
	
		$data = $this->db->select();
		$i=0;
		$dir = opendir("images/");

		while( $row = mysql_fetch_assoc($data)){
    		$new_array[$i] = $row; 
    		$string_to_search=$row['id'] . '.';
			while(($file = readdir($dir)) !== false)
			{
			   	if(strstr($file,$string_to_search))
			   	{
			   		$href[$i]=strstr($file,$string_to_search);
			   		break;
			   	}
			}
			$i++;
		}
		
		closedir($dir);

		$arr_keys=array_keys($new_array[0]);
		
		include_once('view.php');
	}


	private function ajax()
	{
	
		if ($this->UploadFile()) echo true;
		else echo $this->error;
	}

	private function UploadFile()
	{
		$Image = new Image();
		$file = $_FILES['photo'];
		if($file != null)
		{
			$Image->open($file['tmp_name']);
			if($file['error'] != null) 
				{ 
					$this->error = 'Error,code: '.$file['error'];
					return false;
				}

			if(!preg_match('/^image/', $file['type'])) 	   
				{ 
					$this->error = 'Error, please select image'; 
					return false;
				}
			$idFile = $this->db->insert($file['name']);
			$Image->save('images/',$idFile);
		}
		return true;
	}
}