<?
/* класс для человека, указывающий пересек ли реку он */
class pass_river{
	public $passed=false;
	public $name;
	public function __construct($name="human"){
		$this->name=$name;
	}
	public function cross(){
		$this->passed=!$this->passed;
	}
}

class river{
	private	$log;
	protected $iteration=0;
	public $continue_cross=array("adult"=>false,"children"=>false); //проверяем все ли пересекли
	public $xml;
	public $boat;
	public $people=array();
	public function __construct($setting='setting.ini'){
		$this->boat=array("adult"=>1,"children"=>2);
		$this->log=fopen('logs.txt', 'a+');
		$this->xml = new SimpleXMLElement(file_get_contents($setting));
		fwrite($this->log, date("Y-m-d H:i:s").": Запуск скрипта.\n");
	}
	public function start_cross(){
		/* создаем объекты детей и взрослых */
		for($i=1;$i<=$this->xml->children->quantity;$i++)
		{		
			$this->people['children'][$i]=new pass_river("children №".$i);
		}
		for($i=1;$i<=$this->xml->adults->quantity;$i++)
		{
			$this->people['adult'][$i]=new pass_river("adult №".$i);
		}
		$this->people['adult'][$this->xml->children->quantity+1]=new pass_river("fisherman");
		
		/* решаем кто первый будет пересекать реку, т.к лодку нужно будет вернуть назад*/
		$start= $this->boat['adult']>= $this->boat['children']?'adult':'children';
		$end  =	$this->boat['adult']< $this->boat['children']?'adult':'children';
		
		fwrite($this->log, date("Y-m-d H:i:s").": $this->iteration: Начало переправы.\n");
		$this->iteration++;
		/*Переправляем базовую группу */
		$this->cross($start);
		/* Переправляем  вторую группу */
		while(!$this->continue_cross[$end]){
			$this->iteration++;
			$this->people[$start][1]->cross();
			fwrite($this->log, date("Y-m-d H:i:s").": Итерация№ $this->iteration: Переправляем домой ".$this->people[$start][1]->name."\n");
			$this->iteration++;	
			$this->cross($end);	
			$this->iteration++;
			$this->people[$start][2]->cross();
			fwrite($this->log, date("Y-m-d H:i:s").": Итерация№ $this->iteration: Переправляем домой ".$this->people[$start][2]->name."\n");
			$this->iteration++;	
			$this->cross($start);
		}
		/* Переправляем рыбка */
		$this->iteration++;
		$this->people[$start][1]->cross();
		fwrite($this->log, date("Y-m-d H:i:s").": Итерация№ $this->iteration: Переправляем домой ".$this->people[$start][1]->name."\n");
		$this->iteration++;	
		fwrite($this->log, date("Y-m-d H:i:s").": Итерация№ $this->iteration: Переправляем рыбака \n");
		$this->iteration++;
		$this->people[$start][2]->cross();
		fwrite($this->log, date("Y-m-d H:i:s").": Итерация№ $this->iteration: Переправляем домой ".$this->people[$start][2]->name."\n");
		$this->iteration++;	
		$this->cross($start);
		/* Переправляем первую группу */
		while(!$this->continue_cross[$start]){
			$this->iteration++;
			$this->people[$start][1]->cross();
			fwrite($this->log, date("Y-m-d H:i:s").": Итерация№ $this->iteration: Переправляем домой ".$this->people[$start][1]->name."\n");	
			$this->iteration++;	
			$this->cross($start);
		}
		fwrite($this->log, date("Y-m-d H:i:s").": Итерация№ $this->iteration: Рыбак уплывает \n");
		$this->people['adult'][$this->xml->children->quantity+1]->cross();
		fwrite($this->log, date("Y-m-d H:i:s").": Окончание работы, проведено $this->iteration итераций \n");	
		fclose($this->log);
	}
	
	private function cross($who)
	{
	/* выберем какое количество можно переправить за 1 итерацию */
		if($this->boat[$who] >= count($this->people[$who]))
		{
			for($i=1;$i<=count($this->people[$who]);$i++)
			{
				if($this->people[$who][$i]->passed==false)
				{
					$this->people[$who][$i]->cross();
					fwrite($this->log, date("Y-m-d H:i:s").": Итерация№ $this->iteration: Переправляем на другой берег ".$this->people[$who][$i]->name."\n");
				}
			}
		}
		else
		{
			$n=$this->boat[$who];
			for($i=1;$i<=count($this->people[$who]);$i++)
			{
				if($this->people[$who][$i]->passed==false)
				{
					$this->people[$who][$i]->cross();	
					fwrite($this->log, date("Y-m-d H:i:s").": Итерация№ $this->iteration: Переправляем на другой берег ".$this->people[$who][$i]->name."\n");
					$n--;
				}
					if($n==0) break;
			}
		}	
		
		$this->continue_cross["adult"]=true;
		$this->continue_cross["children"]=true;
		for($i=2;$i<=$this->xml->children->quantity;$i++)
		{
			if($this->people['children'][$i]->passed==false)
			{
				$this->continue_cross["children"]=false;		
			}
		}
		for($i=1;$i<=$this->xml->adults->quantity;$i++)
		{
			if($this->people['adult'][$i]->passed==false)
			{
				$this->continue_cross["adult"]=false;
			}
		}
	}
}


$obj=new river();
$obj->start_cross();
?>