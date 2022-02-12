<?php
function getProducts($connection){
	$str = 'select * FROM `product`';
	$result = mysqli_query($connection,$str);
	return $result;
}
function getProductById($connection,$id){
	$str = 'select * FROM `product` where p_id=' . $id;
	$result = mysqli_fetch_assoc(mysqli_query($connection,$str));
	return $result;
}
