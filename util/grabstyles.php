<?php

function last($array) {
if (!count($array)) return null;
return $array[count($array)-1];
}

$bjcp_url = "https://raw.githubusercontent.com/meanphil/bjcp-guidelines-2015/master/styleguide.xml";
$ch = curl_init($bjcp_url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$xml = curl_exec($ch);
curl_close($ch);

$bjcp = new SimpleXMLElement($xml);

$file = "";
$file .= "--\n";
$file .= "-- Dumping data for table `beerStyles` for BJCP 2015 beer styles\n";
$file .= "-- grabbed from $bjcp_url\n";
$file .= "--\n";

$file .= "INSERT INTO `beerStyles`( name, catNum, category, ogMin, ogMax, fgMin, fgMax, abvMin, abvMax, ibuMin, ibuMax, srmMin, srmMax, createdDate, modifiedDate ) VALUES\n";

$categories = $bjcp->xpath('//category');
$lastCatId = last($categories)['id'];
foreach ($categories as $category) {
    $subcategories = $category->subcategory;
    $lastSubCatId = last($subcategories)['id'];
    foreach ($subcategories as $subcategory) {
        $id = $subcategory['id'];
        $file .= "( ";
        $file .= "'" . $subcategory->name . "',";
        $file .= "'" . $id . "',";
        $file .= "'" . $category->name . "',";
        $file .= "'" . $subcategory->stats->og->low . "',";
        $file .= "'" . $subcategory->stats->og->high . "',";
        $file .= "'" . $subcategory->stats->fg->low . "',";
        $file .= "'" . $subcategory->stats->fg->high . "',";
        $file .= "'" . $subcategory->stats->abv->low . "',";
        $file .= "'" . $subcategory->stats->abv->high . "',";
        $file .= "'" . $subcategory->stats->ibu->low . "',";
        $file .= "'" . $subcategory->stats->ibu->high . "',";
        $file .= "'" . $subcategory->stats->srm->low . "',";
        $file .= "'" . $subcategory->stats->srm->high . "',";
        $file .= "NOW(),NOW()";
        $file .= " )";
        if ( $id == $lastSubCatId && $category['id'] == $lastCatId )  {
            $file .= ";";
        } else {
            $file .= ",";
        }
        $file .= "\n";
    }
}

// write file
echo $file;

?>