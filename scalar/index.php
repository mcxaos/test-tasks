<?php


/*
connection to db
*/

class db{
  private $host="127.0.0.1";
  private $username="root";
  private $password="root";
  private $db="skalar";

  public function getConn(){
    try{
      $link = mysql_connect($this->host, $this->username, $this->password);
      if (!mysql_select_db($this->db, $link)){
                throw new Exception(mysql_error());
            }
            return $link;
    }
    catch (Exception $e){
            return $e->getMessage();
        }

  }     
}

/*
main class
*/
class index
{

    private  $conn,$pgs,$query,$num,$category,$count;
    private  $limit = 5, $page = 1;
    function __construct() {
    	$db = new db();
      $this->conn = $db->getConn();
    	$this->call();
   	}

    /* what page render*/
   	private function call(){
      $this->category=htmlspecialchars($_GET['category']);
      switch ( $this->category) {
        case 'employes':
          $this->renderEmployee();
          break;
          case 'department':
          $this->renderDep();
          break;  
        default:
          $this->renderIndex();
          break;
      }
   	}



   	public function renderIndex(){
   		include_once("index.html");	
   	}



    public function renderDep(){
      $id='';
      if(isset($_GET['id']) && (int) $_GET['id'] > 0 ){
        $id=(int) $_GET['id'] ;
      }
      $count = mysql_fetch_assoc(mysql_query("SELECT count(*) as C FROM department Where id=".$id, $this->conn));
      $this->count =  $count['C'];
      $this->Pagination();
      $query=$this->getQuery()."Where d.id=".$id." Limit ".$this->num.", ".$this->limit;
      $result = mysql_query($query,$this->conn);
      if (!$result) {
        die('Неверный запрос: ' . mysql_error());
      }   
      include_once("employeeView.php");
    }

  


  	public function renderEmployee(){
      $count = mysql_fetch_assoc(mysql_query("SELECT count(*) as C FROM employees ",$this->conn));
      $this->count =  $count['C'];
  		$this->Pagination();
  		$query =$this->getQuery()." Limit ".$this->num.", ".$this->limit;
	  	$result = mysql_query($query,$this->conn);
	  	if (!$result) {
	    	die('Неверный запрос: ' . mysql_error());
		  }		
		  include_once("employeeView.php");
	  }

    private function Pagination(){
        $pageshow = 2;
        /*limit and page*/
        if(isset($_GET['limit']) && (int) $_GET['limit'] >  0 ){
          $this->limit=(int) $_GET['limit'] ;
        }
        if(isset($_GET['page']) && (int) $_GET['page'] > 0 ){
          $this->page=(int) $_GET['page'] ;
        }        
        /* how namy pages */
        $pages=ceil ( $this->count / $this->limit);
        $this->num=$this->limit*($this->page-1);
        /* Pagination */
        for($i=$this->page-$pageshow; $i<= $this-> page + $pageshow;$i++)
        {
          if($i >=1 && $i<= $pages)
            $this->pgs[]=$i;
        }
      }


    private function getQuery(){
      $this->query="
      select e.id,d.id as did, e.name as ename,e.date,d.name as dname ,t.name as tname,w.RATE,w.hours,w.position
      FROM employees e
      LEFT JOIN  work w  ON w.employee_id=e.id
      LEFT JOIN Department d ON w.department_id=d.id
      LEFT JOIN type t ON w.type_id=t.id ";
      return $this->query;
    }
}


$run=new index();
?>