<form action="" method="post">
                                <div class="form-group">
                                    <label for="album_title">Edit Category</label>

                                    <?php

                                        if(isset($_GET['edit'])){

                                            $album_id = $_GET['edit'];
                                        
                                            $edit_query = "SELECT * FROM album WHERE album_id = $album_id";

                                            $select_categories_id = mysqli_query($connection, $edit_query);

                                            while($row = mysqli_fetch_assoc($select_categories_id)){
                                                $album_id = $row['album_id'];
                                                $album_title = $row['album_title'];

                                                ?>

                                                <input value="<?php if(isset($album_title)){echo $album_title;}?>" class="form-control" type="text" name="album_title">
                                            

                                        <?php }} ?>

                                        <?php
                                        
                                        
                                            if(isset($_POST['update_album'])){
                                                $album_title = $_POST['album_title'];

                                                $query = "UPDATE album SET album_title = '{$album_title}' WHERE album_id = {$album_id} ";

                                                $update_query = mysqli_query($connection, $query);
                                                
                                                if(!$update_query){
                                                    die("Query Failed" . mysqli_error($connection));
                                                }else{
                                                    header("Location: gallery.php?source=view_albums");
                                                }
                                            }
                                        
                                        
                                        ?>

                                    
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="update_album" value="Update Category">
                                </div>
                            </form>