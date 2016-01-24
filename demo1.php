

<?php
include "clusterdev.flipkart-api.php";
$flipkart = new \clusterdev\Flipkart("tejeswarc", "0a53dd69ce684803adb9d6a5ad822985", "json");
$search=$_POST['search'];
$s=str_replace(" ","+",$search);
$product_url = 'https://affiliate-api.flipkart.net/affiliate/search/json?query='.$s.'&resultCount=8';
	 
		//Call the API using the URL.
		$details = $flipkart->call_url($product_url);
		if(!$details){
			echo 'Error: Could not retrieve Top Offers.';
			exit();
		}
		//The response is expected to be JSON. Decode it into associative arrays.
		$details = json_decode($details, TRUE);
		$list = $details['productInfoList'];
		
		echo"<center><table border=1><br><br><br><br><br><br><br><br><br>";
	
		if(count($list) > 0){
				$i=0;
			foreach ($list as $item) {
						//$productBaseInfo=$item['productBaseInfo'];
				//$productIdentifier=$item['productIdentifier'];
				$productId=$item['productBaseInfo']['productIdentifier']['productId'];
				$categoryPaths=$item['productBaseInfo']['productIdentifier']['categoryPaths'];
				$categoryPath=$item['productBaseInfo']['productIdentifier']['categoryPaths']['categoryPath'];
				//The API returns these values
			//	$title = $item['productBaseInfo']['productIdentifier']['categoryPaths']['categoryPath']['item']['title'];
				$productAttributes = $item['productBaseInfo']['productAttributes'];
				
				$title = $item['productBaseInfo']['productAttributes']['title'];
			$maximumRetailPrice=$item['productBaseInfo']['productAttributes']['sellingPrice'];
				
			$amount=$item['productBaseInfo']['productAttributes']['maximumRetailPrice']['amount'];
//$currency=$item['productBaseInfo']['productAttributes']['maximumRetailPrice']['currency'];
$temp_link['$i']=$productUrl=$item['productBaseInfo']['productAttributes']['productUrl'];
	echo"<tr><td>";echo"<a href=".$temp_link['$i'].">Buy Now</a>";
	//var_dump($productBaseInfo);		
	echo"</td><td>";	
	//echo"".$temp_amount['$i'];
	
	$temp_amount['$i']=intval($maximumRetailPrice['amount']);
	echo"".$temp_amount['$i'];
	$p[$i]=$temp_amount['$i'];
	echo"</td></tr>";
	$i++;
				//$imageUrl = $item['imageUrls'][0]['productUrl'];
				//$availability = $item['availability'];
				//Setting up the table rows/columns for a 3x3 view.
			
				
				//echo '<a target="_blank" href="'.$url.'"><img src="'.$imageUrl.'" style="max-width:200px; max-height:200px;"/><br>'.$title."</a><br>".$description;
				
			}
		
		
	
			
		}
		echo"</center></table>";
		for($k=0;$k<count($p);$k++)
			echo"<br/>";
		echo"minimum value is ".min($p);
		exit();


$home = $flipkart->api_home();
//Make sure there is a response.
if($home==false){
	echo 'Error: Could not retrieve API homepage';
	exit();
}

$home = json_decode($home, TRUE);
$list = $home['apiGroups']['affiliate']['apiListings'];

?>
