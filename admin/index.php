<?php include "includes/admin_header.php";?>


        <!-- Navigation -->
        <?php include "includes/admin_navigation.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Administration
                            <small>Subheading</small>
                        </h1>
                    </div>
                </div>

                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-3 padding">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-9 text-right">
                                    

                                    <?php 
                                    
                                        $posts_query = "SELECT * FROM posts";
                                        $select_all_posts = mysqli_query($connection, $posts_query);

                                        $post_count = mysqli_num_rows($select_all_posts);
                                        

                                        echo "<div class='huge'>{$post_count}</div>";
                                    ?>



                                
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-3 padding">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-9 text-right">

                                     <?php 

                                        $comment_query = "SELECT * FROM comments";
                                        $select_all_comments = mysqli_query($connection, $comment_query);

                                        $comment_count = mysqli_num_rows($select_all_comments);
                                        
                                        echo "<div class='huge'><span class='commentCount'>{$comment_count}</span></div>"
                                    ?>

                                    <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-3 padding">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-9 text-right">
                                        <?php 
                                        
                                           $category_query = "SELECT * FROM categories";
                                            $select_all_categories = mysqli_query($connection, $category_query);

                                            $category_count = mysqli_num_rows($select_all_categories);
                                            

                                            echo "<div class='huge'>{$category_count}</div>"
                                        
                                        ?>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-3 padding">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-9 text-right">
                                        <?php 
                                        
                                           $album_query = "SELECT * FROM album";
                                            $select_all_albums = mysqli_query($connection, $album_query);

                                            $album_count = mysqli_num_rows($select_all_albums);
                                            

                                            echo "<div class='huge'>{$album_count}</div>"
                                        
                                        ?>
                                        <div>Albums</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <?php

                    $post_active_query = "SELECT * FROM posts WHERE post_status = 'published'";
                    $select_all_active_posts = mysqli_query($connection, $post_active_query);
                    $post_active_count = mysqli_num_rows($select_all_active_posts);
                
                    $post_draft_query = "SELECT * FROM posts WHERE post_status = 'draft'";
                    $select_all_draft_posts = mysqli_query($connection, $post_draft_query);
                    $post_draft_count = mysqli_num_rows($select_all_draft_posts);

                    $approved_comments_query = "SELECT * FROM comments WHERE comment_status = 'approved'";
                    $select_all_approved_comments = mysqli_query($connection, $approved_comments_query);
                    $approved_comment_count = mysqli_num_rows($select_all_approved_comments);

                    $unapproved_comments_query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
                    $select_all_unapproved_comments = mysqli_query($connection, $unapproved_comments_query);
                    $unapproved_comment_count = mysqli_num_rows($select_all_unapproved_comments);

                    $declined_comments_query = "SELECT * FROM comments WHERE comment_status = 'declined'";
                    $select_all_declined_comments = mysqli_query($connection, $declined_comments_query);
                    $declined_comment_count = mysqli_num_rows($select_all_declined_comments);

                    $total_categories_query = "SELECT * FROM categories";
                    $select_all_categories = mysqli_query($connection, $total_categories_query);
                    $number_of_categories = mysqli_num_rows($select_all_categories);

                    $total_images_query = "SELECT * FROM gallery";
                    $select_all_images = mysqli_query($connection, $total_images_query);
                    $number_of_images = mysqli_num_rows($select_all_images);
                ?>
                <hr>
                <div class="row padding-top">

                    <div class="col-lg-6">
                        <script type="text/javascript">
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                            ['', ''],

                            <?php 
                            
                                $element_text = ['Posts' ,'Published Posts', 'Draft Posts'];
                                $element_count = [$post_count, $post_active_count, $post_draft_count];

                                for($i = 0; $i < sizeof($element_text); $i++){
                                   echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                                }
                            
                            ?>

                            //['Posts', 1000]
                            ]);

                            var options = {
                            chart: {
                                title: 'Posts', 
                            },                            
                            colors: ['#337ab7']
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, options);
                        }
                        </script>

                        <div id="columnchart_material" class="chart"></div>
                    </div>


                    <div class="col-lg-6 second_graph_padding_top">
                        <script type="text/javascript">
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                            ['', ''],

                            <?php 
                            
                                $element_text = ['Comments', 'Approved Comments', 'Unapproved Comments', 'Declined Comments'];
                                $element_count = [$comment_count, $approved_comment_count, $unapproved_comment_count, $declined_comment_count];

                                for($i = 0; $i < sizeof($element_text); $i++){
                                    echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                                }
                            
                            ?>

                            //['Posts', 1000]
                            ]);

                            var options = {
                            chart: {
                                title: 'Comments',
                            },
                            colors: ['#5cb85c']
                            };
                            

                            var chart = new google.charts.Bar(document.getElementById('comment_chart'));

                            chart.draw(data, options);
                        }
                        </script>

                        <div id="comment_chart" class="chart"></div>
                    </div>

                    

                </div>
                <hr>
                <div class="row padding-top">
                    <div class="col-lg-6">
                        <script type="text/javascript">
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                            ['', ''],

                            <?php 
                            
                                $element_text = ['Categories'];
                                $element_count = [$category_count];

                                for($i = 0; $i < sizeof($element_text); $i++){
                                    echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                                }
                            
                            ?>

                            //['Posts', 1000]
                            ]);

                            var options = {
                            chart: {
                                title: 'Categories',
                            },
                            colors: ['#d9534f']
                            };

                            var chart = new google.charts.Bar(document.getElementById('category_chart'));

                            chart.draw(data, options);
                        }
                        </script>

                        <div id="category_chart" class="chart"></div>
                    </div>
                    <div class="col-lg-6 second_graph_padding_top">
                        <script type="text/javascript">
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                            ['', ''],

                            <?php 
                            
                                $element_text = ['Albums', 'Images'];
                                $element_count = [$album_count, $number_of_images];

                                for($i = 0; $i < sizeof($element_text); $i++){
                                    echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                                }
                            
                            ?>

                            //['Posts', 1000]
                            ]);

                            var options = {
                            chart: {
                                title: 'Albums/Images',
                            },
                            colors: ['#f0ad4e']
                            };

                            var chart = new google.charts.Bar(document.getElementById('user_chart'));

                            chart.draw(data, options);
                        }
                        </script>

                        <div id="user_chart" class="chart"></div>
                    </div>
                </div>
                
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    
<?php include "includes/admin_footer.php";?>
