<?php
if(isset($_GET['menu'])){
$menu=$_GET['menu'];
}
else{
	$menu="";
}
if($menu=="produk"){
	include"produk.php";
}
else if ($menu=="staff"){
	include"staff.php";
}
else if ($menu=="edit_produk"){
	include"edit_produk.php";
}
else if ($menu=="staff"){
	include "staff.php";
}
else if ($menu=="tambah_staff"){
	include "tambah_staff.php";
}
else if ($menu=="edit_staff"){
	include "edit_staff.php";
}

else{
	include"home.php";
}
?>