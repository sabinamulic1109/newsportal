<?php
  
function replace($string){
	$returns = str_replace("\\", '', $string);
	$returns = str_ireplace("'","\'", $returns);
	
	$returns = str_ireplace("or 1=1","", $returns);
	$returns = str_ireplace("OR 1=1","", $returns);	
	$returns = str_ireplace("or1=1","", $returns);	
	$returns = str_ireplace("OR1=1","", $returns);	
	$returns = str_ireplace("SELECT * FROM","", $returns);
	$returns = str_ireplace("select * from","", $returns);
	$returns = str_ireplace("DELETE FROM","", $returns);	
	$returns = str_ireplace("delete from","", $returns);	
	$returns = str_ireplace("DROP TABLE","", $returns);	
	$returns = str_ireplace("drop table","", $returns);	
	$returns = str_ireplace('" OR ""="',"", $returns);
	$returns = str_ireplace('" or ""="',"", $returns);
	$returns = str_ireplace("' OR ''='","", $returns);
	$returns = str_ireplace("' or ''='","", $returns);
	$returns = str_ireplace("'=' 'OR'","", $returns);
	$returns = str_ireplace("'=' 'or'","", $returns);
	$returns = str_ireplace('"=" "OR"',"", $returns);
	$returns = str_ireplace('"=" "or"',"", $returns);
	$returns = str_ireplace('"="',"", $returns);
	
	return $returns;
}
	
	
