<?php include "includes/header.php"; ?>

<?php include "includes/navigation.php"; ?>

<?php 

function createComment(){
    global $connection;

    if(isset($_POST['create_comment'])){
        
        $image_id = $_GET['image_id'];
        $comment_author = $_POST['comment_author'];
        $comment_content = $_POST['comment_content'];

        $insert_image_comment = "INSERT INTO image_comments(comment_image_id, comment_author, comment_content, comment_status, comment_date) ";
        $insert_image_comment .= "VALUES($image_id, '{$comment_author}', '{$comment_content}', 'approved', now())";

        if($insert_image_comment_query = mysqli_query($connection, $insert_image_comment)){
            echo "<h4 class='bg-danger text-danger' style='padding: 5px'>Comment could not be added</h4>";
            $update_comment_count_query = "UPDATE gallery SET image_comment_count = image_comment_count + 1 WHERE image_id = $image_id";
            $update_comment_count = mysqli_query($connection, $update_comment_count_query);
            header("Location: image_view.php?image_id=" . $image_id);
        }else{
            echo "<h4 class='bg-success text-success' style='padding: 5px'>Comment successfully added</h4>";
        }

        
        
    }
}

?>

<div id="image-page" class="content-container">
    <div class="page-content">
        <section id="albums" class="light">
            

                <?php

                    if(isset($_GET['image_id'])){

                        $image_id = $_GET['image_id'];
                    
                        $get_image  = "SELECT * FROM gallery WHERE image_id = $image_id";
                        $get_image_query = mysqli_query($connection, $get_image);
                        
                        $row = mysqli_fetch_assoc($get_image_query);

                        $image_one = $row['image_one'];

                        echo '<div class="grid">';
                        echo '<div class="item">';
                        echo '<div class="image-container">';
                        echo "<img src='images/$image_one'>";
                        echo '</div>';
                        echo '</div>';                             
                        echo '</div>';

                        echo '<hr class="section-split">';
                        
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

                    $query = "SELECT * FROM image_comments WHERE comment_image_id = $image_id AND comment_status = 'approved' ORDER BY comment_id DESC";


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