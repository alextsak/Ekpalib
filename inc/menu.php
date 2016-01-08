<style>
 .borderline {
 	border-top: 3px solid #ddd
 }
 
 #bottom_borderline{
 	margin-bottom:30px;
 }
 
 #site-path{
 	height:40px;
 }
 
 #tabs{
 	background:beige;
 }
 
 #tabs a{
 	color:black;
 }

</style>

<div class="borderline"></div>
           <ul id="tabs"  class="nav nav-pills">
           	   <li>
           	   		<a href="">Αρχική</a>
           	   </li>
               <li class="dropdown">
               		<a href="#" data-toggle="dropdown" class="dropdown-toggle">Πληροφορίες <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="?page=about">Καλωσόρισμα Ββλιοθήκης</a></li>
                            <li><a href="#">Διοικητικό Προσωπικό</a></li>
                            <li><a href="#">Πολιτική Λειτουργίας</a></li>
                        </ul>
               </li>
               <li class="dropdown">
               		<a href="#" data-toggle="dropdown" class="dropdown-toggle">Επικοινωνία <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                        	<li><a href="#">Αποστολή Μηνύματος</a></li>
                            <li><a href="#">Παρατηρήσεις - Προτάσεις</a></li>
                        </ul>
               </li>

               <li class="dropdown">
               		<a href="?page=about" data-toggle="dropdown" class="dropdown-toggle">Βοήθεια <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="?page=about">Συχνές Ερωτήσεις</a></li>
                            <li><a href="#">Οδηγίες Αναζήτησης Υλικού</a></li>
                            <li><a href="#">Άμεση Βοήθεια</a></li>
                        </ul>
               </li>
               
              
          	</ul>
          	<div  id="bottom_borderline" class="borderline"></div>
          	<?php 
          	if(!empty($_SERVER['QUERY_STRING'])) {
          		
          	
          	?> 
		

		
			<div id="site-path">
			<?php
			
				$sitepath = sitepath_constructor();
				echo $sitepath;
				//echo var_dump($_SESSION['sitepath']);
			?>
			</div>
			
<?php 
          	} else {
          		init_sitepath();
          	}
?>
    	
    	
    	
    	
    	