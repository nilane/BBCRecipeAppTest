<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<?php 
$recipe = $_GET['recipe'];


function clean($recipe) {
		$recipe = str_replace(' ', '-', $recipe); // Replaces all spaces with hyphens.
		$recipe = preg_replace('/[^A-Za-z0-9\-]/', '', $recipe); // Removes special chars.
		$recipe = strtolower($recipe); // Convert to lowercase
 
		return $recipe;
	}
$datalink = clean($recipe);



 ?>
<title><?php echo $recipe;?></title>

<!-- css -->
<link href="../includes/css/reset.css" rel="stylesheet" type="text/css">
<link href="../includes/css/food-styles.css" rel="stylesheet" type="text/css">


</head>

<body>
<div id="wrapper">

<?php

// get recipe from url id
$link = '../includes/data/'. $datalink .'.json';

// file_get_contents call instead
$data = file_get_contents($link);

 echo $pagetitle;
// decode JSON
$json = json_decode($data, true); // decode the JSON into an associative array

if (empty($json)): //if can not find link to recipe
echo"Sorry, this recipe doesn't exist or may have been removed";

else:


	echo '<div class="section"><h1>' . $json['name'] . '</h1></div>';
	echo '<div class="sectionImg"><img src="' . $json['image'] . '"><br /></div><div class="section"><p class="summary">' . $json['summary'] . '</p><br />';
	echo 'Cooking time: ' . $json['cookingTime'] . ' minutes<br /></div>';
	echo '<div class="section"><h2>Ingredients</h2>';
	
	foreach($json['ingredients'] as $key=>$value):
	
		if (!empty($value['ingredients'])): //if ingredients are split in to group arrays, array is not empty
				$groups = array_keys($value); //find group names
				echo '<br /><h4>' . $value[$groups[0]] . '</h4>';// the first element of your array is:

				foreach($value['ingredients'] as $key=>$ingredients): //find ingredients in groups
					echo '<p>' . $ingredients . '</p><br />';
				endforeach;
			
		else:
	   		echo '<p>' . $value . '</p><br />'; //if ingredients are not split into groups show list
	   	endif;
		
		
	endforeach;
	
	echo '</div>';
	echo '<div class="section"><h2>Preparation method </h2><ol>';
	foreach($json['method'] as $key=>$method):
	   echo '<li>' . $method . '</li><br />'; //show method
	endforeach;
	 
	echo '</ol></div>';

endif;	
	
	
	
 ?>

<div class="section btm"><a href="../">< Back</a></div>
</div>
</body>
</html>