<?php
require_once __DIR__.'/../models/beer.php';

class BeerManager{

	function __construct($con) {
		$this->con = $con;
	}

	function Save($beer){
		$sql = "";
		if($beer->get_id()){
			$sql = 	"UPDATE beers " .
					"SET " .
						"name = '" . encode($beer->get_name()) . "', " .
						"beerStyleId = '" . encode($beer->get_beerStyleId()) . "', " .
						"breweryId = '" . encode($beer->get_breweryId()) . "', " .
						"notes = '" . encode($beer->get_notes()) . "', " .
						"abv = '" . $beer->get_abv() . "', " .
						"srmEst = '" . $beer->get_srm() . "', " .
						"ibuEst = '" . $beer->get_ibu() . "', " .
						"modifiedDate = NOW() ".
					"WHERE id = " . $beer->get_id();

		}else{
			$sql = 	"INSERT INTO beers(name, beerStyleId, breweryId, notes, abv, srmEst, ibuEst, createdDate, modifiedDate ) " .
					"VALUES(" .
					"'" . encode($beer->get_name()) . "', " .
					$beer->get_beerStyleId() . ", " .
					$beer->get_breweryId() . ", " .
					"'" . encode($beer->get_notes()) . "', " .
					"'" . $beer->get_abv() . "', " .
					"'" . $beer->get_srm() . "', " .
					"'" . $beer->get_ibu() . "' " .
					", NOW(), NOW())";
		}

		//echo $sql; exit();

		mysqli_query($this->con,$sql);
	}

	function GetAll(){
		$sql="SELECT * FROM beers ORDER BY name";
		$qry = mysqli_query($this->con,$sql);

		$beers = array();
		while($i = mysqli_fetch_array($qry)){
			$beer = new Beer();
			$beer->setFromArray($i);
			$beers[$beer->get_id()] = $beer;
		}

		return $beers;
	}

	function GetAllActive(){
		$sql="SELECT * FROM beers WHERE active = 1 ORDER BY name";
		$qry = mysqli_query($this->con, $sql);

		$beers = array();
		while($i = mysqli_fetch_array($qry)){
			$beer = new Beer();
			$beer->setFromArray($i);
			$beers[$beer->get_id()] = $beer;
		}

		return $beers;
	}

	function GetById($id){
		$sql="SELECT * FROM beers WHERE id = $id";
		$qry = mysqli_query($this->con,$sql);

		if( $i = mysqli_fetch_array($qry) ){
			$beer = new Beer();
			$beer->setFromArray($i);
			return $beer;
		}

		return null;
	}

	function Inactivate($id){
		$sql = "SELECT * FROM taps WHERE beerId = $id AND active = 1";
		$qry = mysqli_query($this->con,$sql);

		if( mysqli_fetch_array($qry) ){
			$_SESSION['errorMessage'] = "Beer is associated with an active tap and could not be deleted.";
			return;
		}

		$sql="UPDATE beers SET active = 0 WHERE id = $id";
		//echo $sql; exit();
		$qry = mysqli_query($this->con,$sql);

		$_SESSION['successMessage'] = "Beer successfully deleted.";
	}
}
