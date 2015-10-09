<?php 
session_start();

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Recipes</title>

<!-- css -->
<link href="includes/css/reset.css" rel="stylesheet" type="text/css">
<link href="includes/css/food-styles.css" rel="stylesheet" type="text/css">

<!-- fonts -->
<link href="https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css">
</head>

<body>
<!-- -------------------------------------------wrapper ------------------------------------------------ -->
<div id="wrapper">
<?php
  
// file_get_contents call instead
$data = file_get_contents('includes/data/list.json');

// decode JSON
$json = json_decode($data, true); // decode the JSON into an associative array


//To see arrays uncomment below:
//echo '<pre>' . print_r($json, true) . '</pre>';



if(isset($_GET['sortby'])):
    $_SESSION['sortOrder']=$_GET['sortby']; //set session variable
endif;

 if(isset($_GET['searchvalue'])):
    $_SESSION['searchval']=$_GET['searchvalue']; //set session variable
endif;
 


?>

<!-- -------------------------------------------header ------------------------------------------------ -->
<div id="header">

<h1><a href="index.php?sortby=Name">Recipes</a></h1>

<!-- ------------------------------------------search form -------------------------------------------- -->
<div class="search">
<form action="" method="GET">
<input value="Search recipes" name="searchvalue" id="s" onfocus="if (this.value == 'Search recipes') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search recipes';}" type="text">
</form>
</div>

<!-- ----------------------------------------end search form ------------------------------------------- -->


<div class="cookingTime">
<h3>

<!-- ----------------------------------------sort/order results------------------------------------------- -->
 <?php 

	if (!isset($_SESSION['sortOrder'])): //if no session set for cook
	 		echo '<a href="index.php?sortby=Asc">Order by cooking time</a>';


	elseif ($_SESSION['sortOrder'] == 'Asc'): // if session set to ascending order
			unset($_SESSION['rname']); //remove recipe name order
			echo '<a href="index.php?sortby=Desc">Order by cooking time ⬆</a>';
			foreach($json as $key => $value):   
				$sort[$key]  = $value['cookingTime'];
			endforeach;
			array_multisort($sort, SORT_ASC, $json); // sort cooking time in ascending order
	 
	elseif ($_SESSION['sortOrder'] == 'Desc'): //if session set to descending order
			unset($_SESSION['rname']); //remove recipe name order
			echo '<a href="index.php?sortby=Asc">Order by cooking time ⬇</a>';
			foreach($json as $key => $value):   
				$sort[$key]  = $value['cookingTime'];
			endforeach;
			array_multisort($sort, SORT_DESC, $json); // sort cooking time in descending order
			
	elseif ($_SESSION['sortOrder'] == 'Name'): //if session set to name order
			echo '<a href="index.php?sortby=Asc">Order by cooking time</a>';
			foreach($json as $key => $value):   
				$sort[$key]  = $value['name'];
			endforeach;
			array_multisort($sort, SORT_ASC, $json); // sort name in ascending order
	
	
	 endif;
	 
	  ?>
      
<!-- ----------------------------------------end sort/order results------------------------------------------- -->

</h3>
</div>
    <div class="clear"></div>
    
  </div>
    
    
<!-- -----------------------------------------end header ---------------------------------------------- -->
 
 
 <!-- ----------------------------------------Main content ---------------------------------------------- -->   
    <div class="mainWindow">
    
	<?php
	
		 //<!-- -----------------------------------------search results ---------------------------------------------- -->
		
		
		if (isset($_SESSION['searchval'])): //if search value entered
			$searchfound = false;
			$search_value = $_SESSION['searchval']; 
			echo '<div class="titleTxt">Results for "' . $search_value . '"</div>';
		
			foreach($json as $key => $value):  
				if(preg_match('/\b'.$search_value.'\b/i',$value['name'])): //if search value word is in name
				$searchfound = true;
				/*results*/
				echo '<div class="row">';
				 echo '<a href="recipe/index.php?recipe=' . $value['name']. '"><img src="' . $value['image'] . '"></a>';	
				 echo '<div class="name"><a href="recipe/index.php?recipe=' . $value['name']. '">' . $value['name']. '</a></div>';
				 echo '<div class="time">' . $value['cookingTime']. '</div>';
				 echo '</div>';
				  /*end results*/
				endif;
				foreach($value['ingredients'] as $k => $ingredients): 
					if(preg_match('/\b'.$search_value.'\b/i',$ingredients)): //if search value word is in ingredients
					 $searchfound = true;
					/*results*/
					 echo '<div class="row">';
					 echo '<a href="recipe/index.php?recipe=' . $value['name']. '"><img src="' . $value['image'] . '"></a>';	
					 echo '<div class="name"><a href="recipe/index.php?recipe=' . $value['name']. '">' . $value['name']. '</a></div>';
					 echo '<div class="time">' . $value['cookingTime']. '</div>';
					 echo '</div>';
					 /*end results*/
					 endif;
				endforeach;
		  endforeach;
		  
		  	if ($searchfound == false):
			  	echo '<br />Sorry, nothing matched your filter term.<br />  <div class="footer"><a href="index.php">Return to full recipe list.</a></div>';
			 else:
				echo '<br /><div class="footer"><a href="index.php">Return to full recipe list</a></div>';
			endif;
			
		// destroy the session.
		session_destroy();
		endif;
		 //<!-- -----------------------------------------end search results ---------------------------------------------- -->

	
	// use get variable to paging number
$page = !isset($_GET['page']) ? 1 : $_GET['page'];
$limit = 10; // ten rows per page
$offset = ($page - 1) * $limit; // offset
$total_items = count($json); // total items
$total_pages = ceil($total_items / $limit);
$final = array_splice($json, $offset, $limit);

 ?>
 


        <!-- -----------------------------------------Recipie list---------------------------------------------- -->
        
        <?php   
        
        if (!isset($_SESSION['searchval'])):  //if search value not entered show results based on limit of items on page
        
        foreach($final as $key => $value):  
          echo '<div class="row">';
            echo '<a href="recipe/index.php?recipe=' . $value['name']. '"><img src="' . $value['image'] . '"></a>';	
            echo '<div class="name"><a href="recipe/index.php?recipe=' . $value['name']. '">' . $value['name']. '</a></div>';
            echo '<div class="time">' . $value['cookingTime']. '</div>';
         echo '</div>';
          endforeach;
        
         // if no data
        if ($total_items == 0):
            echo "Sorry, we currently have no recipes for you";
            endif;
            
        
                //<!-- -----------------------------------------pagination ---------------------------------------------- -->
                
             
                echo '<div class="footer">'; 
				if ($page > 1):
					echo '<a href="index.php?page=' . ($page - 1) . '">Prev</a>&nbsp;';
				endif;
			
                    //print links
                    for($x = 1; $x <= $total_pages; $x++): 
                        echo '<a href="index.php?page=' . $x . '" class="';
						if($page == $x):
						echo 'currentPage';
						else:
						echo 'pages';
						endif;
						echo '">' . $x . '</a> ';
						
					
                    endfor;
			
				if ($page < $total_pages):
					echo '&nbsp;<a href="index.php?page=' . ($page + 1) . '">Next</a> ';
				endif;
			

                echo '</div>'; 
               
                 
                //<!-- ---------------------------------------end pagination --------------------------------------------- -->	
        
        endif;
         ?>
         
         <!-- -----------------------------------------end recipie list---------------------------------------------- -->
</div>
 <!-- ----------------------------------------end main content ---------------------------------------------- -->   
</div>
<!-- -------------------------------------------end wrapper ------------------------------------------------ -->

</body>
</html>