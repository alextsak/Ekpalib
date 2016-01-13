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
 	background-color: #992B00;
 }
 
 #tabs a{
 	color:black;
 }

</style>


	<div class="borderline" >
           <ul id="tabs"  class="nav nav-pills" data-toggle="collapse">
           	   <li>
           	   		<a href="<?php echo 'http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . '/Ekpalib/';?>" style="color:#FFFAF0;">Αρχική</a>
           	   </li>
               <li class="dropdown">
               		<a style="color:#FFFAF0;"href="#" data-toggle="dropdown" class="dropdown-toggle">Πληροφορίες <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a style="color:#FFFAF0;" href="?page=about">Καλωσόρισμα Ββλιοθήκης</a></li>
                            <li><a style="color:#FFFAF0;" href="#">Διοικητικό Προσωπικό</a></li>
                            <li><a style="color:#FFFAF0;" href="#">Πολιτική Λειτουργίας</a></li>
                        </ul>
               </li>
               <li class="dropdown">
               		<a href="#" data-toggle="dropdown" class="dropdown-toggle" style="color:#FFFAF0;">Επικοινωνία <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                        	<li><a href="#" style="color:#FFFAF0;">Αποστολή Μηνύματος</a></li>
                            <li><a href="#" style="color:#FFFAF0;">Παρατηρήσεις - Προτάσεις</a></li>
                        </ul>
               </li>

               <li class="dropdown">
               		<a href="?page=about" data-toggle="dropdown" class="dropdown-toggle" style="color:#FFFAF0;">Βοήθεια <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="?page=about" style="color:#FFFAF0;">Συχνές Ερωτήσεις</a></li>
                            <li><a href="#" style="color:#FFFAF0;">Οδηγίες Αναζήτησης Υλικού</a></li>
                            <li><a href="#" style="color:#FFFAF0;">Άμεση Βοήθεια</a></li>
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
				echo $_SERVER['DOCUMENT_ROOT'];
			?>
			</div>
			
<?php 
          	} else {
          		init_sitepath();
          	}
?>
  </div>
    	
    	
    	
    	