<?php
    if(isset($_GET['p_id'])){
        $post_id = $_GET['p_id'];

        $query = "SELECT * FROM posts WHERE post_id = $post_id";

        $select_post = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_post)){

            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_status = $row['post_status'];
            $post_comment_count = $row['post_comment_count'];
            $post_content = $row['post_content'];

        }   
    }
?>
<h1 class="page-header">
    Update Post
</h1>

<?php editPost($post_id);?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $post_title;?>">
    </div>

    <div class="form-group">
        <select name="post_category_id" id="">
            <?php 
                $edit_query = "SELECT * FROM categories";

                $select_categories_id = mysqli_query($connection, $edit_query);

                while($row = mysqli_fetch_assoc($select_categories_id)){
                    
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    echo "<option value='$cat_id'>$cat_title</option>";

                }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="author" value="<?php echo $post_author;?>">
    </div>

    <div class="form-group">
        <select name="post_status" id="">
            <option value="<?php echo $post_status;?>"><?php echo $post_status;?></option>
            <?php 
                if($post_status == "Published"){
                    echo "<option value='Draft'>Draft</option>";
                }else{
                    echo "<option value='Published'>Publish</option>";
                }
            ?>
        </select>
    </div>

    

    <div class="form-group">
        <label for="image">Post Image</label><br>
        <img width="50px" height="50px" src="../images/<?php echo $post_image?>" alt="">
        <input type="file" class="form-control" name="image">
    </div>

    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" class="form-control" name="tags" value="<?php echo $post_tags;?>">
    </div>

    <div class="form-group">
        <label for="content">Post Content</label>
        <textarea class="form-control" name="content" id="" cols="30" rows="10"><?php echo $post_content;?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update-post" value="Update Post">
    </div>

    

</form>