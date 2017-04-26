<?php include "includes/header.php"; ?>

<?php include "includes/navigation.php"; ?>

<div id="home" class="content-container">

    <div class="page-content">

        <section id="welcome" class="light">

            <div class="image-container">
                <img src="images/banner.jpg" alt="Image of computer code">
            </div>            

            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                Proin lacinia suscipit maximus. In fringilla sem leo, at tempor augue vestibulum ac. 
                Pellentesque in efficitur sapien. Proin nec cursus magna. 
                Suspendisse facilisis purus ac dapibus fermentum. 
                Suspendisse ante erat, placerat non massa sit amet, venenatis viverra eros. 
                Sed sed metus tortor. Pellentesque a luctus tellus, non vestibulum magna. 
                Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; 
                Morbi dapibus suscipit tellus eu porta. Nam nec tincidunt diam. 
                Nulla vitae euismod erat, eget iaculis nunc. 
                Proin dapibus, ipsum in pretium bibendum, mi sem pulvinar dolor, ut mattis est metus in mauris. 
                Donec in augue vitae dui interdum feugiat.
            </p>

        </section>

        <hr class="section-split">

        <section id="gallery-preview" class="light">
            <h3>Gallery</h3>

                <?php

                    $select_recent_albums = "SELECT * FROM gallery WHERE image_status = 'main' ORDER BY image_date DESC LIMIT 3";
                    $select_recent_albums_query = mysqli_query($connection, $select_recent_albums);
                    
                    echo "<div class='card-deck'>";

                    while($album = mysqli_fetch_assoc($select_recent_albums_query)){

                        $image_id = $album['image_id'];
                        $image_album_id = $album['image_album_id'];

                        $select_album_title = "SELECT album_title FROM album WHERE album_id = $image_album_id";
                        $select_album_title_query = mysqli_query($connection, $select_album_title);

                        $albumRow = mysqli_fetch_assoc($select_album_title_query);
                        $album_title = $albumRow['album_title'];
                ?>

                <div class="col-xs-12 col-md-6 col-lg-4 col-xl-3">
                
                    <?php 

                        $image_one = $album['image_one'];
                        $image_date = $album['image_date'];
                        
                        echo "<a href='album.php?album=$image_album_id' class='card'>";
                        echo '<div class="image-container">';
                        echo "<img src='images/$image_one'>";
                        echo '</div>';
                        echo "<span class='album-title secondary-btn'>$album_title</span>";
                        echo '</a>';
                    
                    ?>

                </div>

                <hr class="post-split">
                    
                <?php     

                    }

                    echo "</div>";



                ?>

            <div class="btn-container">
                <a href="gallery.php" class="button main-btn">View All Albums</a>
            </div>
        </section>

        <hr class="section-split">

        <section id="posts-preview" class="dark">
            <h3>Posts</h3>

            <div class='card-deck'>

                <?php 

                    $get_recent_posts = "SELECT * FROM posts ORDER BY post_date DESC LIMIT 3";
                    $get_recent_posts_query = mysqli_query($connection, $get_recent_posts);

                    while($post = mysqli_fetch_assoc($get_recent_posts_query)){

                        $post_id = $post['post_id'];
                        $post_title = $post['post_title'];
                        $post_content = $post['post_content'];
                        $post_date = $post['post_date'];
                        $post_tags = $post['post_tags'];
                        $post_image = $post['post_image'];
                        $uk_date = date("d-m-y", strtotime($post_date));
                        
                ?>

                    <div class="col-xs-12 col-md-6 col-lg-4 col-xl-3 no-rl-padding">
                        <div class="card">
                            <a href="">
                                <img class="card-img-top" src="images/<?php echo $post_image; ?>" alt="#">
                            </a>

                            <div class="card-block no-rl-padding">
                                <h4 class="card-title"><?php echo $post_title;?></h4>
                                
                                
                                <p class="card-text"><?php echo $post_content;?></p> 
                                <p class="date-and-time"><small class="fa fa-calendar"><?php echo ' ' . $uk_date; ?></small></p>
                                <p class="link"><a href=""><?php echo $post_tags;?></a></p>
                                
                                <div class="btn-container">
                                    <a href="post.php?post_id=<?php echo $post_id; ?>" class="button secondary-btn">View Post</a>
                                </div>
                            </div>       
                        </div>          
                    </div>

                    <hr class="post-split">

                <?php

                    }


                ?>
                
            </div>

            <div class="btn-container">
                <a href="posts.php" class="button main-btn">View More Posts Here</a>
            </div>
        </section>

        <hr class="section-split">

        <section id="about-me-preview" class="dark">

            <div class="profile-image-container">
                <img id="profile-img" src="images/profile-image.png" alt="Image of computer code">
            </div>

            <h3>About Me</h3>

            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                Proin lacinia suscipit maximus. In fringilla sem leo, at tempor augue vestibulum ac. 
                Pellentesque in efficitur sapien. Proin nec cursus magna. 
                Suspendisse facilisis purus ac dapibus fermentum. 
                Suspendisse ante erat, placerat non massa sit amet, venenatis viverra eros. 
                Sed sed metus tortor. Pellentesque a luctus tellus, non vestibulum magna. 
                Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; 
                Morbi dapibus suscipit tellus eu porta. Nam nec tincidunt diam. 
                Nulla vitae euismod erat, eget iaculis nunc. 
                Proin dapibus, ipsum in pretium bibendum, mi sem pulvinar dolor, ut mattis est metus in mauris. 
                Donec in augue vitae dui interdum feugiat.
            </p>

            <div class="btn-container">
                <a href="about.php" class="button main-btn">Read More</a>
            </div>
        </section>
    </div>
</div>


<?php include "includes/footer.php"; ?>