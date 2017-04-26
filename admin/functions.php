<?php 

function displayAlbums(){

    global $connection;

    $query = "SELECT * FROM album";
    $select_categories = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_categories)){
        $album_id = $row['album_id'];
        $album_title = $row['album_title'];

        echo "<tr>";
        echo "<td><input class='checkboxes' type='checkbox' name='checkboxArray[]' value='{$album_id}'></td>";
        echo "<td>{$album_id}</td>";          
        echo "<td>{$album_title}</td>";
        echo "<td><a href='gallery.php?source=view_albums&delete={$album_id}'>Delete</a></td>";
        echo "<td><a href='gallery.php?source=view_albums&edit={$album_id}'>Update</a></td>";
        echo "</tr>";
    }
}

function insertAlbum(){

    global $connection;

    if(isset($_POST['submit'])){                                  
        $album_title = $_POST['album_title'];
        $album_category = $_POST['album_category'];

        if($album_title == "" || empty($album_title)){
            echo "You have not entered a title for the category";
        }else{
            $query = "INSERT INTO album(album_title, album_category_id) VALUE('{$album_title}', '{$album_category}') ";
            $create_category = mysqli_query($connection, $query);

            if(!$create_category){
                die('Query Failed' . mysqli_error($connection));
            }
        }
    }
}

function deleteAlbum(){

    global $connection;

    if(isset($_GET['delete'])){
        $album_id = $_GET['delete'];
        $query = "DELETE FROM album WHERE album_id = {$album_id}";
        $delete_query = mysqli_query($connection, $query);

        header("Location: gallery.php?source=view_albums");
    }

    if(isset($_POST['bulk_options'])){
        if(isset($_POST['checkboxArray'])){
            foreach($_POST['checkboxArray'] as $checkboxValue){
                
                $query = "DELETE FROM album WHERE album_id = '$checkboxValue'";
                $delete_query = mysqli_query($connection, $query);

                header("Location: gallery.php?source=view_albums");
            }
        }
    }

    
}

function displayCategories(){

    global $connection;

    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_categories)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td><input class='checkboxes' type='checkbox' name='checkboxArray[]' value='{$cat_id}'></td>";
        echo "<td>{$cat_id}</td>";          
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Update</a></td>";
        echo "</tr>";
    }
}

function insertCategories(){

    global $connection;

    if(isset($_POST['submit'])){                                  
        $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)){
            echo "You have not entered a title for the category";
        }else{
            $query = "INSERT INTO categories(cat_title) VALUE('{$cat_title}') ";
            $create_category = mysqli_query($connection, $query);

            if(!$create_category){
                die('Query Failed' . mysqli_error($connection));
            }
        }
    }
}

function deleteCategories(){

    global $connection;

    if(isset($_GET['delete'])){
        $cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$cat_id}";
        $delete_query = mysqli_query($connection, $query);

        header("Location: categories.php");
    }

    if(isset($_POST['bulk_options'])){
        if(isset($_POST['checkboxArray'])){
            foreach($_POST['checkboxArray'] as $checkboxValue){
                
                $query = "DELETE FROM categories WHERE cat_id = '$checkboxValue'";
                $delete_query = mysqli_query($connection, $query);

                header("Location: categories.php");
            }
        }
    }

    
}

function addPost(){

    global $connection;

    if(isset($_POST['create-post'])){
        $post_author = $_POST['author'];
        $post_title = $_POST['title'];
        $post_category_id = $_POST['post_category_id'];
        $post_status = $_POST['status'];
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        $post_tags = $_POST['tags'];
        $post_content = $_POST['content'];
        $post_date = date('y-m-d');
        $date = gmdate("y-m-d");
        $time = gmdate(" h:i:s");

        move_uploaded_file($post_image_temp, "../images/$post_image");

        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_time, post_image, post_content, post_tags, post_status) ";
        $query .= "VALUES('{$post_category_id}', '{$post_title}', '{$post_author}', '$date', '$time', '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";

        $create_post_query = mysqli_query($connection, $query);

        if(confirmQuery($create_post_query)){
            echo "<h4 class='bg-danger' style='padding: 5px'>Post could not be created</h4>";
        }else{
            echo "<h4 class='bg-success' style='padding: 5px'>Post successfully created</h4>";

            //header("refresh: 2; URL = posts.php");
        }
    }
}

function displayPostData(){

    global $connection;

    $query = "SELECT * FROM posts";
    $select_posts = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_posts)){
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_content = $row['post_content'];
        $post_category_id = $row['post_category_id'];
        $post_date = $row['post_date'];
        $post_time = $row['post_time'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_status = $row['post_status'];
        $post_comment_count = $row['post_comment_count'];

        $uk_date = date("d-m-y", strtotime($post_date));

        echo "<tr>";
        echo "<td><input class='checkboxes' type='checkbox' name='checkboxArray[]' value='{$post_id}'></td>";
        echo "<td>{$post_id}</td>";
        echo "<td>{$post_author}</td>";
        echo "<td>{$post_title}</td>";
        echo "<td>{$post_content}</td>";

        $query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
        $select_categories_id = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_categories_id)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            echo "<td>{$cat_title}</td>";
        }

        echo "<td>{$post_status}</td>";
        echo "<td><img src='../images/{$post_image}' width='50px' height='50px'></td>";
        echo "<td>{$post_tags}</td>";
        echo "<td>{$post_comment_count}</td>";
        echo "<td>{$uk_date}</td>";
        echo "<td>{$post_time}</td>";
        echo "<td><a href='../post.php?p_id=$post_id'>View</a></td>";
        echo "<td><a href='posts.php?source=edit_post&p_id=$post_id'>Edit</a></td>";
        echo "<td><a href='posts.php?delete=$post_id'>Delete</a></td>";
        echo "</tr>";
    }
}

function editPost($post_id){

    global $connection;

    if(isset($_POST['update-post'])){
            
        $post_author = $_POST['author'];
        $post_title = $_POST['title'];
        $post_category_id = $_POST['post_category_id'];
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        $post_tags = $_POST['tags'];
        $post_status = $_POST['post_status'];
        $post_content = $_POST['content'];

        move_uploaded_file($post_image_temp, "../images/$post_image");

        if(empty($post_image)){
            $query = "SELECT * FROM posts WHERE post_id = $post_id";

            $select_current_image = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_current_image)){
                $post_image = $row['post_image'];
            }
        }

        $query = "UPDATE posts SET post_date = now(), post_title = '{$post_title}', ";
        $query .= "post_author = '{$post_author}', post_category_id = '{$post_category_id}', ";
        $query .= "post_image = '{$post_image}', post_tags = '{$post_tags}', ";
        $query .= "post_status = '{$post_status}', post_content = '{$post_content}' ";
        $query .= "WHERE post_id = {$post_id}";
        $update_query = mysqli_query($connection, $query);
                                            
        if(confirmQuery($update_query)){
            echo "<h4 class='bg-danger text-danger' style='padding: 5px'>Post could not be updated</h4>";
        }else{
            echo "<h4 class='bg-success text-success' style='padding: 5px'>Post successfully updated</h4>";

            header("refresh: 2; URL = posts.php");
        }
    }
}

function deletePost(){

    global $connection;

    if(isset($_GET['delete'])){
        $post_id = $_GET['delete'];//delete refers to the href in the link 'posts.php?delete'
        $query = "DELETE FROM posts WHERE post_id = {$post_id}";
        $delete_query = mysqli_query($connection, $query);

        header("Location: posts.php");
    }
}

function addUser(){

    global $connection;

    if(isset($_POST['create_user'])){
        $username = $_POST['username'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_role = $_POST['user_role'];
        $user_password = $_POST['user_password'];
        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];

        move_uploaded_file($user_image_temp, "../images/$user_image");

        $query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_image, user_role) ";
        $query .= "VALUES('{$username}', '{$user_password}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_image}', '{$user_role}')";

        $create_user_query = mysqli_query($connection, $query);

        if(confirmQuery($create_user_query)){
            echo "<h4 class='bg-danger text-danger' style='padding: 5px'>User could not be created</h4>";
        }else{
            echo "<h4 class='bg-success text-success' style='padding: 5px'>User successfully created</h4>";

            header("refresh: 2; URL = users.php");
        }
    }
}

function displayUserData(){

    global $connection;

    $query = "SELECT * FROM users";
    $select_users = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_users)){
        $user_id = $row['user_id'];
        $user_image = $row['user_image'];
        $username = $row['username'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];

        echo "<tr>";
        echo "<td>{$user_id}</td>";       
        echo "<td><img src='../images/{$user_image}' width='50px' height='50px'></td>";          
        echo "<td>{$username}</td>";            
        echo "<td>{$user_firstname}</td>";
        echo "<td>{$user_lastname}</td>";
        echo "<td>{$user_email}</td>"; 
        echo "<td>{$user_role}</td>";           
        echo "<td><a href='users.php?delete=$user_id'>Delete</a></td>";           
        echo "<td><a href='users.php?source=edit_user&p_id=$user_id'>Edit</a></td>";            
        echo "</tr>";
    }
}

function editUser($user_id){

    global $connection;

    if(isset($_POST['create_user'])){   
        $username = $_POST['username'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_role = $_POST['user_role'];
        $user_password = $_POST['user_password'];
        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];

        move_uploaded_file($user_image_temp, "../images/$user_image");

        if(empty($user_image)){
            $query = "SELECT * FROM users WHERE user_id = $user_id";
            $select_current_image = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_current_image)){
                $user_image = $row['user_image'];
            }
        }

        $query = "UPDATE users SET user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', user_email = '{$user_email}', ";
        $query .= "username = '{$username}', user_password = '{$user_password}', ";
        $query .= "user_image = '{$user_image}', user_role = '{$user_role}' WHERE user_id = {$user_id} ";

        $update_query = mysqli_query($connection, $query);
                                            
        if(!$update_query){
            die("Query Failed" . mysqli_error($connection));
        }else{
            echo "<h4 class='bg-success text-success' style='padding: 5px'>User successfully updated</h4>";

            header("refresh: 2; URL = users.php");
        }
    }
}

function deleteUser(){

    global $connection;

    if(isset($_GET['delete'])){
        $user_id = $_GET['delete'];//delete refers to the href in the link 'posts.php?delete'
        $query = "DELETE FROM users WHERE user_id = {$user_id}";
        $delete_query = mysqli_query($connection, $query);

        header("Location: users.php");
    }
}

function displayImageCommentTable(){

    global $connection;

    $get_comments = "SELECT * FROM image_comments";
    $get_comments_query = mysqli_query($connection, $get_comments);

    while($comment = mysqli_fetch_assoc($get_comments_query)){
        $comment_id = $comment['comment_id'];
        $comment_image_id = $comment['comment_image_id'];
        $comment_author = $comment['comment_author'];
        $comment_content = $comment['comment_content'];
        $comment_status = $comment['comment_status'];
        $comment_date = $comment['comment_date'];
        

        echo "<tr>";
        echo "<td>{$comment_id}</td>";       
        echo "<td>{$comment_author}</td>";            
        echo "<td>{$comment_content}</td>";   
        echo "<td>{$comment_status}</td>";

        $get_image = "SELECT * FROM gallery WHERE image_id = $comment_image_id";
        $get_image_query = mysqli_query($connection, $get_image);

        while($image = mysqli_fetch_assoc($get_image_query)){
            $image_id = $image['image_id'];
            $selected_image = $image['image_one'];
            echo "<td><img src='../images/$selected_image' width='100px'></td>"; 
        }

        echo "<td>{$comment_date}</td>";            
        echo "<td><a href='image_comments.php?approve=$comment_id'>Approve</a></td>";            
        echo "<td><a href='image_comments.php?decline=$comment_id'>Decline</a></td>";            
        echo "<td><a href='image_comments.php?delete=$comment_id'>Delete</a></td>";           
        echo "</tr>";
    }
}

function displayCommentTable(){

    global $connection;

    $query = "SELECT * FROM comments";
    $select_comments = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_comments)){
        $comment_id = $row['comment_id'];
        $comment_category_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_content = $row['comment_content'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];
        

        echo "<tr>";
        echo "<td>{$comment_id}</td>";       
        echo "<td>{$comment_author}</td>";            
        echo "<td>{$comment_content}</td>";   
        echo "<td>{$comment_status}</td>";

        $query = "SELECT * FROM posts WHERE post_id = $comment_category_id";
        $select_post_id_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_post_id_query)){
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            echo "<td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>"; 
        }

        echo "<td>{$comment_date}</td>";            
        echo "<td><a href='post_comments.php?approve=$comment_id'>Approve</a></td>";            
        echo "<td><a href='post_comments.php?decline=$comment_id'>Decline</a></td>";            
        echo "<td><a href='post_comments.php?delete=$comment_id'>Delete</a></td>";           
        echo "</tr>";
    }
}

function deleteComments($commentType){

    global $connection;

    if($commentType == 'image'){

        if(isset($_GET['delete'])){
            $comment_id = $_GET['delete'];//delete refers to the href in the link 'posts.php?delete'

            $get_comment_image_id = "SELECT comment_image_id FROM image_comments WHERE comment_id = $comment_id";
            $get_comment_image_id_query = mysqli_query($connection, $get_comment_image_id);
            $comment = mysqli_fetch_assoc($get_comment_image_id_query);
            $comment_image_id = $comment['comment_image_id'];

            $delete_comment = "DELETE FROM image_comments WHERE comment_id = {$comment_id}";
            $delete_comment_query = mysqli_query($connection, $delete_comment);

            $update_comment_count_query = "UPDATE gallery SET image_comment_count = image_comment_count - 1 WHERE image_id = $comment_image_id";
            $update_comment_count = mysqli_query($connection, $update_comment_count_query);

            header("Location: image_comments.php");
        }

    }else{

        if(isset($_GET['delete'])){
            $comment_id = $_GET['delete'];//delete refers to the href in the link 'posts.php?delete'

            $get_comment_post_id = "SELECT comment_post_id FROM comments WHERE comment_id = $comment_id";
            $get_comment_post_id_query = mysqli_query($connection, $get_comment_post_id);
            $row = mysqli_fetch_assoc($get_comment_post_id_query);
            $comment_post_id = $row['comment_post_id'];

            $query = "DELETE FROM comments WHERE comment_id = {$comment_id}";
            $delete_query = mysqli_query($connection, $query);

            $update_comment_count_query = "UPDATE posts SET post_comment_count = post_comment_count - 1 WHERE post_id = $comment_post_id";
            $update_comment_count = mysqli_query($connection, $update_comment_count_query);

            header("Location: post_comments.php");
        }

    }
    
}

function approveComment($commentType){
    global $connection;

    if($commentType == 'image'){

        if(isset($_GET['approve'])){
            $comment_id = $_GET['approve'];//delete refers to the href in the link 'posts.php?delete'

            $decline_comment = "UPDATE image_comments SET comment_status = 'approved' WHERE comment_id = $comment_id";

            $decline_comment_query = mysqli_query($connection, $decline_comment);

            header("Location: image_comments.php");
        }

    }else{

        if(isset($_GET['approve'])){
            $comment_id = $_GET['approve'];//delete refers to the href in the link 'posts.php?delete'

            $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $comment_id";

            $decline_query = mysqli_query($connection, $query);

            header("Location: post_comments.php");
        }

    }

}

function rejectComment($commentType){

    global $connection;

    if($commentType == 'image'){

        if(isset($_GET['decline'])){
            $comment_id = $_GET['decline'];//delete refers to the href in the link 'posts.php?delete'

            $decline_comment = "UPDATE image_comments SET comment_status = 'declined' WHERE comment_id = $comment_id";

            $decline_comment_query = mysqli_query($connection, $decline_comment);

            header("Location: image_comments.php");
        }

    }else{

        if(isset($_GET['decline'])){
            $comment_id = $_GET['decline'];//delete refers to the href in the link 'posts.php?delete'

            $query = "UPDATE comments SET comment_status = 'declined' WHERE comment_id = $comment_id";

            $decline_query = mysqli_query($connection, $query);

            header("Location: post_comments.php");
        }

    }
    
}

function confirmQuery($query){

    global $connection;

    if(!$query){
        die("Query Failed" . mysqli_error($connection));
    }
}

function insertGalleryImagesForTemplateTwo(){
   
    if(isset($_POST['submit-images'])){
        
        global $connection;

        $imageOne = $_FILES['image1']['name'];
        $imageOne_temp = $_FILES['image1']['tmp_name'];

        $image_tags = $_POST['image_tags'];
        $image_album_id = $_POST['image_album_id'];
        $image_status = $_POST['image_status'];

        move_uploaded_file($imageOne_temp, "../images/$imageOne");

        $date = gmdate("y-m-d h:i:s");

        $query = "INSERT INTO gallery(image_album_id, image_status, image_tags, image_added, image_date, image_one) ";
        $query .= "VALUES('$image_album_id', '$image_status', '$image_tags', '$date', '$date', '{$imageOne}')";

        

        if($insert_image_query = mysqli_query($connection, $query)){

            //$update_query = "UPDATE gallery SET image_date = '$date' WHERE image_album_id = $image_album_id";

            $update_query = "UPDATE album SET album_updated = '$date' WHERE album_id = $image_album_id";
            
            if($update_date_query = mysqli_query($connection, $update_query)){
                echo "success";
            }else{
                echo "date query failed";
            }

            
        }else{
            echo "failed";
        }

    }

}




?>