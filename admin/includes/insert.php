<?php
session_start();
if(!isset( $_SESSION['myusername'] )){
	//header("location:index.php");
}
require '../../data/config/conn.php';
require_once '../includes/functions.php';


$sql="INSERT INTO beers (name, style, notes, abv, srmEst, ibuEst, modifiedDate) VALUES ('$_POST[name]','$_POST[style]','$_POST[notes]','$_POST[abv]','$_POST[srmEst]','$_POST[ibuEst]', NOW())";

if (!mysqli_query($con,$sql)) {
die('Error: ' . mysqli_error($con));
}

	redirect('../beer_main.php');
