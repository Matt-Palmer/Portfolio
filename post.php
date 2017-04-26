<?php include "includes/header.php"; ?>

<?php include "includes/navigation.php"; ?>

<?php 

function createComment(){
    global $connection;

    if(isset($_POST['create_comment'])){
        
        $post_id = $_GET['post_id'];
        $comment_author = $_POST['comment_author'];
        $comment_content = $_POST['comment_content'];

        $query = "INSERT INTO comments(comment_post_id, comment_author, comment_content, comment_status, comment_date) ";
        $query .= "VALUES($post_id, '{$comment_author}', '{$comment_content}', 'approved', now())";

        if($create_comment_query = mysqli_query($connection, $query)){
            echo "<h4 class='bg-danger text-danger' style='padding: 5px'>Comment could not be added</h4>";
            $update_comment_count_query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_id";
            $update_comment_count = mysqli_query($connection, $update_comment_count_query);
            header("Location: post.php?post_id=" . $post_id);
        }else{
            echo "<h4 class='bg-success text-success' style='padding: 5px'>Comment successfully added</h4>";
        }

        
        
    }
}

?>

<div id="post-page" class="content-container">
    <div class="page-content">
        <section id="post">
            <?php 

                if(isset($_GET['post_id'])){

                    $post_id = $_GET['post_id'];

                    $increase_views = "UPDATE posts SET post_views = post_views + 1 WHERE post_id = $post_id";
                    $increase_views_query = mysqli_query($connection, $increase_views);

                    $get_post = "SELECT * FROM posts WHERE post_id = $post_id";

                    $get_post_query = mysqli_query($connection, $get_post);

                    $post = mysqli_fetch_assoc($get_post_query);

                    $post_title = $post['post_title'];
                    $post_date = $post['post_date'];
                    $post_image = $post['post_image'];
                    $post_content = $post['post_content'];
                    $uk_date = date("d-m-y", strtotime($post_date));

            ?>

                <!-- First Blog Post -->
                <div class="post-container">
                    <h3><?php echo $post_title; ?></h3>

                    <div class="image-container">
                        <img src="images/<?php echo $post_image; ?>" alt="">
                    </div>

                    <p id="post-content"><?php echo $post_content;?></p>

                    <p class="date-and-time text-small"><span class="fa fa-calendar"></span><?php echo ' ' . $uk_date; ?></p>

                    
                </div>

                <hr class="section-split">

            <?php

                }else{
                    header("Location: index.php");
                }

            ?>


            <!--Form Validation-->
                <?php

                    if(isset($_POST['create_comment'])){

                        $error = '';

                        $name = $_POST['comment_author'];
                        $comment = $_POST['comment_content'];

                        if(empty($name)){
                            $error .= "Your name is required.<br>" ;
                        }

                        if(empty($comment)){
                            $error .= "Your have left the comment empty.<br>";
                        }

                        if($error){
                            echo "<div class='alert alert-danger' role='alert'>";
                            echo $error ;
                            echo "</div>";
                        }else{
                            createComment();
                        }

                    }


                ?>



                <div id="accordion" role="tablist" aria-multiselectable="true">
                  <div class="card">
                    <div class="card-header" role="tab" id="headingOne">
                      <h5 class="mb-0">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                          Click here to leave a comment
                        </a>
                      </h5>
                    </div>

                    <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                        <form id="add-comment-form" action="" method="post" role="form">
                            <div id="comment-name-input" class="form-group col-sm-12">
                                <label for="comment_author">Name</label>
                                <input type="text" name="comment_author" class="form-control" value="<?php if(isset($_POST['comment_author'])){ echo $name; }?>" placeholder="Enter your name...">
                            </div>

                            <div class="form-group col-sm-12">
                                <label for="comment_content">Comment</label>
                                <textarea class="form-control" name="comment_content" rows="10"><?php if(isset($_POST['comment_content'])){ echo $comment; }?></textarea>
                            </div>

                            <div class="btn-container">
                                <button id="add-comment" type="submit" name="create_comment" class="button secondary-btn">Submit</button>
                            </div>
                        
                        </form>
                    </div>
                  </div>
                </div>
                

                <hr class="section-split">
                

                <!-- Posted Comments -->

                <?php 

                    $query = "SELECT * FROM comments WHERE comment_post_id = $post_id AND comment_status = 'approved' ORDER BY comment_id DESC";


                    $select_comment_query = mysqli_query($connection, $query);

                    //confirmQuery($select_comment_query);

                    while($row = mysqli_fetch_assoc($select_comment_query)){
                        
                        $comment_date = $row['comment_date'];
                        $comment_content = $row['comment_content'];
                        $comment_author = $row['comment_author'];
                        $uk_date = date("d-m-y", strtotime($comment_date));

                ?>

                

                <!-- Comment -->
                <div class="media">
                    <div class="row">
                        
                        <h4 class="col-sm-12"><?php echo $comment_author; ?></h4>

                        
                        <div class="comment-container col-sm-12">
                            <?php echo $comment_content; ?>
                        </div>

                        <p class="date-and-time col-sm-12"><small class="fa fa-calendar"><?php echo ' ' . $uk_date; ?></small></p>

                    </div>


                        
                </div>

                <hr class="post-split">

                <?php 
                    }
                ?>
        </section>
    </div>
</div>


<?php include "includes/footer.php"; ?>