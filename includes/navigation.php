<?php 
        
    function classActive($requestUri){
        $current_file = basename($_SERVER['REQUEST_URI'], '.php');

        $str = explode('.', $current_file);

        for($i = 0; $i < sizeof($requestUri); $i++){

            for($j = 0; $j < sizeof($str); $j++){

                if($str[$j] == $requestUri[$i]){
                    echo 'class="active"';
                }

            }

        }
        
    }

    function displayBackBtn($requestUri){
        $current_file = basename($_SERVER['REQUEST_URI'], '.php');

        $str = explode('.', $current_file);

        global $connection;

        if(isset($_GET['image_id'])){

            $image_id = $_GET['image_id'];
        
            $get_album  = "SELECT * FROM gallery WHERE image_id = $image_id";
            $get_album_query = mysqli_query($connection, $get_album);
            
            $row = mysqli_fetch_assoc($get_album_query);

            $image_album_id = $row['image_album_id'];
            
        }

        for($i = 0; $i < sizeof($str); $i++){ 

                if($str[$i] == 'image_view'){
                    echo "<a href='album.php?album=$image_album_id' class='prev-page'>";
                    echo "<div class='fa fa-arrow-left'></div>";
                    echo "</a>";
                } else if($str[$i] == 'album'){
                    echo "<a href='gallery.php' class='prev-page'>";
                    echo "<div class='fa fa-arrow-left'></div>";
                    echo "</a>";
                }else if($str[$i] == 'post'){
                    echo "<a href='posts.php' class='prev-page'>";
                    echo "<div class='fa fa-arrow-left'></div>";
                    echo "</a>";
                }

        }
    }

?>

<nav class="nav-container">
    <div class="content-container">

        <?php 

            displayBackBtn(array('post', 'album', 'image_view'));

        ?>

        <div id="my-logo">
            <h1><a href="index.php">Cakes By ZoZo</a></h1>
        </div>

        <div id="open-nav" class="nav-btn">
            <div class="hamburger-container">
            </div>
        </div>

        <div class="nav-content-container">

            <div class="nav-items-container">
                <ul>
                    <li><a href="index.php" <?php classActive(array('index', 'NewCakesByZoZo'));?>>Home</a></li>
                    <li><a href="posts.php" <?php classActive(array('posts', 'post'));?>>Posts</a></li>
                    <li><a href="gallery.php" <?php classActive(array('gallery', 'album'));?>>Gallery</a></li>
                    <li><a href="about.php" <?php classActive(array('about'));?>>About Me</a></li>
                </ul>
            </div>


            <div class="social-nav-items-container">
                <ul>
                    <li><a href="#"><img src="images/facebook-logo-button.svg"></a></li>
                    <li><a href="#"><img src="images/twitter-logo-button.svg"></a></li>
                    <li><a href="#"><img src="images/pinterest.svg"></a></li>
                    <li><a href="#"><img src="images/instagram-logo.svg"></a></li>
                </ul>
            </div>

        </div>

    </div>
    

</nav>


