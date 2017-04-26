<?php include "includes/header.php"; ?>

<?php include "includes/navigation.php"; ?>

<div id="posts-page" class="content-container">
    <div class="page-content">
        <section id="posts" class="light">
            <h3>Posts</h3>

            <div class='card-deck'>

                <?php 

                    $get_recent_posts = "SELECT * FROM posts ORDER BY post_date DESC";
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
                            <a href="post.php?post_id=<?php echo $post_id; ?>">
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
        </section>
    </div>
</div>


<?php include "includes/footer.php"; ?>