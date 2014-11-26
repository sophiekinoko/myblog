<?php 




if($_SESSION) 
		{
			if($_SESSION["statut"] == "author") 
			{
				echo '<ul><li><a href="admin.php" class="red" >✎ ADMINISTRATION</a></li>
				<li><a href="admin.php?connexion=true" class="red" >⚡ DÉCONNEXION</a></li></ul>';
			}
			elseif($_SESSION["statut"] == "visitor") 
			{
				echo '<a href="admin.php?connexion=true" class="red" >⚡ DÉCONNEXION</a>' ;
			}
		}
		else 
		{
			echo '<ul><li><a href="register.php" class="red" >⛁ INSCRIPTION</a></li>
			<li><a href="login.php" class="red" >⚡ CONNEXION</a></li></ul>' ;
		}
		?>