<?php include "includes/header.php"; ?>

<?php include "includes/navigation.php"; ?>

<div id="gallery-page" class="content-container">
    <div class="page-content">
        <section id="albums" class="light">
            <h3>Cake Gallery</h3>

                <?php

                    $select_recent_albums = "SELECT * FROM gallery WHERE image_status = 'main' ORDER BY image_date DESC";
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
        </section>
    </div>
</div>


<?php include "includes/footer.php"; ?>