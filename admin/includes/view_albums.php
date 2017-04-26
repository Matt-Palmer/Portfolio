

    


                


                        <h1 class="page-header">
                            Albums
                        </h1>
                        <hr>

                        <?php insertAlbum(); ?>

                        <form action="" method="post">
                            <div class="add-category-form">
                                <div class="row">
                                    <h6>Bulk options</h6>

                                    <div class="form-group col-sm-12">
                                        <label for="album_title">Add Album</label>
                                        <input class="form-control" type="text" name="album_title" placeholder="Insert album name...">
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label for="title">Image Category</label>
                                        <select class="form-control" name="album_category" id="category-filter">
                                            <option value="0">Select a category</option>
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

                                    <input id="add-category" class="btn btn-primary" type="submit" name="submit" value="Add Album">
                                    
                                    <input id="delete-categories" type="submit" class="btn btn-secondary" value="Delete Album" name="bulk_options">

                                    
                                </div>
                            </div>
                            

                            <?php if(isset($_GET['edit'])){ include "includes/update_album.php"; } ?>

                            

                            <div class="table-container">

                                

                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th><input id="select-all" type="checkbox"></th>
                                            <th>ID</th>
                                            <th>Album Title</th>
                                            <th>Delete</th>
                                            <th>Update</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <!--FIND AND DISPLAY ALL CATEGORIES QUERY-->
                                        <?php displayAlbums(); ?>

                                        <!--DELETE CATEGORIES-->
                                        <?php deleteAlbum(); ?>

                                    </tbody>
                                </table>
                            </div>
                        
                        </form>
    
