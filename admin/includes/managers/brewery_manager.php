<?php
require_once __DIR__.'/../models/brewery.php';

class BreweryManager{

	function __construct($con) {
		$this->con = $con;
	}

	function Save($brewery){

		// download the image so we have it locally
		if ($brewery->get_imageUrl() && filter_var($brewery->get_imageUrl(), FILTER_VALIDATE_URL) ) {
			$uniquename = uniqid("brewery-");
			$imagepath = "../data/images/" . $uniquename;
			copy($brewery->get_imageUrl(), $imagepath);
				if (file_exists($imagepath)) {
 				  $brewery->set_imageUrl("data/images/" . $uniquename);
  			}
		}

		$sql = "";
		if($brewery->get_id()){
			$sql = 	"UPDATE breweries " .
					"SET " .
						"name = '" . encode($brewery->get_name()) . "', " .
						"imageUrl = '" . encode($brewery->get_imageUrl()) . "' " .
					"WHERE id = " . $brewery->get_id();

		}else{
			$sql = 	"INSERT INTO breweries(name, imageUrl ) " .
					"VALUES(" .
					"'" . encode($brewery->get_name()) . "', " .
					"'" . encode($brewery->get_imageUrl()) . "')";
		}

    	mysqli_query($this->con,$sql);
	}

	function GetAll(){
		$sql="SELECT * FROM breweries ORDER BY name";
		$qry = mysqli_query($con,$sql);

		$breweries = array();
		while($i = mysqli_fetch_array($qry)){
			$brewery = new Brewery();
			$brewery->setFromArray($i);
			$breweries[$brewery->get_id()] = $brewery;
		}

		return $breweries;
	}

	function GetAllActive(){
		$sql="SELECT * FROM breweries WHERE active = 1 ORDER BY name";
		$qry = mysqli_query($this->con,$sql);

		$beers = array();
		while($i = mysqli_fetch_array($qry)){
			$beer = new Brewery();
			$beer->setFromArray($i);
			$beers[$beer->get_id()] = $beer;
		}

		return $beers;
	}

	function GetById($id){
		$sql="SELECT * FROM breweries WHERE id = $id";
		$qry = mysqli_query($this->con,$sql);

		if( $i = mysqli_fetch_array($qry) ){
			$brewery = new Brewery();
			$brewery->setFromArray($i);
			return $brewery;
		}

		return null;
	}

	function Inactivate($id){

		$sql="UPDATE breweries SET active = 0 WHERE id = $id";
		//echo $sql; exit();
		$qry = mysqli_query($this->con,$sql);

		$_SESSION['successMessage'] = "Brewery successfully deleted.";
	}
}
