<html>
<head>
</head>
	<body>
	<table border="1">
	   <tr>
	    <th>ФИО</th>
	    <th>дата рождения</th>
	    <th>отдел</th>
	    <th>должность</th>
	    <th>тип сотрудника</th>
	    <th>оплата за месяц</th>
	   </tr>
	 	<?php while ($row = mysql_fetch_assoc($result)) :?>
	 		<?php
	 		if($row['tname']=="hourly"){
	 			$pay=$row['RATE']*$row['hours'];
	 		}
	 		else{
	 			$pay=$row['RATE'];
	 		}
	 		?>
	 		<tr>
	 		<td><?= $row['id'];?></td>
	 		<td><?= $row['date'];?></td>
	 		<td><a href="/department/<?= $row['did'];?>">
	 			<?= $row['dname'];?>
	 			</a>
	 		</td>
	 		<td><?= $row['position'];?></td>
	 		<td><?= $row['tname'];?></td>
	 		<td><?= $pay;?></td>
	 		</tr>
		<? endwhile;?>
	 </table>
	 	<div>
		 	<span>Страница</span>
			<?foreach ($this->pgs as $value):?>
				<a href="/<?= $this->category?>/<?= $value?>
				?limit=<?=$this->limit?>"> 
					<?=$value?>	
				</a>
	  		<? endforeach;?>
  		</div>


  		<div>
	  		<span>Количество  сотрудников на страницу :</span>
	  		<a href="/<?= $this->category.'/'. $id?>/?limit=5">5</a>
	  		<a href="/<?= $this->category.'/'. $id?>/?limit=10">10</a>
			<a href="/<?= $this->category.'/'. $id?>/?limit=20">20</a>
			<a href="/<?= $this->category.'/'. $id?>/?limit=40">40</a>
			<a href="/<?= $this->category.'/'. $id?>/?limit=50">50</a>
			<a href="/<?= $this->category.'/'. $id?>/?limit=100">100</a>
	 	</div>
	</body>
</html>