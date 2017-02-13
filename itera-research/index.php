<?
$array=array( 
array( 
'text'=> 'Текст зеленого цвета',
'cells'=> '8,9' ,
'align'=> 'right' , 
'valign'  => 'bottom' , 
'color'=> '00FF00' ,
'bgcolor' => 'FFFFFF'),
array( 
 'text'=>'Текст красного цвета',
 'cells'=> '1,2,4,5',
 'align'=>'center',
 'valign'=>'center' ,
 'color'=> 'FF0000' ,
 'bgcolor' => '0000FF')
 );
usort($array, "compare");
function compare ($v1, $v2) {
	if ($v1["cells"] == $v2["cells"]) return 0;
	return ($v1["cells"] < $v2["cells"])? -1: 1;
}
?>

<?
//этот блок я сделал за 1.5 часа, поскольку я долго думал как автоматически обьединять ячейки
$bl=array();
for($i=1;$i<=9;$i++)
{
		$bl[$i]['visibility']=true;
		$bl[$i]['colspan']=1;
		$bl[$i]['rowspan']=1;
		$bl[$i]['text']="&nbsp";
}
for($m=0;$m<count($array);$m++)
{

	$a=$array[$m];
	$cells=explode(",",$a['cells']);
	if($cells[0]<=3) $n=3;
	if($cells[0]>3 and $cells[0]<=6) $n=6;
	if($cells[0]>6 and $cells[0]<=9) $n=9;
	foreach ($cells as $value){
		$bl[$value]['visibility']=false;
		if($value>$cells[0] and $value<=$n)
		{
			$bl[$cells[0]]['colspan']+=1;
		}
		if($value>$n and $value<=$n+3)
		{
			$bl[$cells[0]]['rowspan']=2;
		}
	}
	$bl[$cells[0]]['visibility']=true;
	$bl[$cells[0]]['text']="<div style='color:".$a['color']."'>".$a['text']."</div>";
	$bl[$cells[0]]['style']="align=".$a['align']." valign=".$a['valign']." bgcolor=".$a['bgcolor'];
}
?>
<html>
	<head>
		<title>
			Тестовое задание PHP
		</title>
	</head>
	<body>
		<table width='50%' border='1'>
			<?
				for($i=1;$i<=9;$i=$i+3)
				{
					echo "\n<tr>";
					for($j=$i;$j<=$i+2;$j++)
					{
						if($bl[$j]['visibility'])
						{
								echo "<td ".$bl[$j][style].
								" colspan=".$bl[$j][colspan].
								" rowspan=".$bl[$j][rowspan].">".$bl[$j][text]."</td>";
						}
					}
					echo "</tr>";
				}
			?>
		</table>
	</body>
</html>