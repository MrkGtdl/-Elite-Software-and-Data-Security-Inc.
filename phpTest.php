SHORTEST WORD
<?php  
function shortestWord() {
	$str = "i am you";
	$words = explode(" ", $str);
	
	$shortest = strlen($words[0]);
	
	foreach($words as $word)
	{
		$length = strlen($word);
		if($length<$shortest)
		{
			$shortest = $length;
		}
	}
	
	echo "The length of the shortest word is ". $shortest;
}

 shortestWord();
?> 
==================================
WORD SEARCH
<?php
	$arr=["I","TWO","FORTY","THREE","JEN","TWO","tWo","TWo","FORTY","FORTY"];
	
	foreach ($arr as $key => $value) 
	{
	  if($value === "TWO")
	  {
	  	echo " INDEX " . $key ;
	  }
	}
?>
==================================
SQL TEST
1.  Display total number of albums sold per artist
	-SELECT Artist, count(Album) 
	FROM elitesdsdb.`data reference (album sales)` 
	group by Artist 
	order by count(*) desc ;

2.  Display combined album sales per artist
	-SELECT Artist, sum(2022_Sales)
	FROM elitesdsdb.`data reference (album sales)`
	group by Artist
	order by sum(2022_Sales) desc
	;

3.  Display the top 1 artist who sold most combined album sales
	-SELECT Artist,2022_Sales 
	FROM elitesdsdb.`data reference (album sales)`
	 order by 2022_Sales DESC 
	LIMIT 1;

4.  Display the top 10 albums per year based on their number of sales
5.  Display list of albums based on the searched artist
	-SELECT Artist, Album
	FROM elitesdsdb.`data reference (album sales)`
	where Artist = "Bolbbalgan4"
	;

