<div class="navbar">
	<div class="navbar-inner">
    	<a class="brand" href="index.php">SPARTAGYM</a>
        <?php
            if(isset($_SESSION['admin_user'])){
                echo "<ul class='nav pull-right'>
                        <li><a href='logout.php'><i class='icon-user'></i> Logout</a></li>
                    </ul>";
            }
        ?>
    	
    </div>
</div>
