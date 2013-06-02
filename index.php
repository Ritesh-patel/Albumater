<?php
    $path_app="";   //defing path from app's root folder
    require_once($path_app."lib/fb-config.php");   //include facebook configuration
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Albumater</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">        
        <?php
            include_once($path_app.'include_files_css.php');   //include all the required css files
        ?>        
    </head>
    <body>
        <!-- header -->
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">                   
                    <a class="brand" href="#">Albumater</a> 
            <?php
                if($user)
                {
            ?>    
                    <span class="header-right">
                        <img class="profile-pic" src="https://graph.facebook.com/<?php echo $user; ?>/picture?type=large" alt="<?php echo $user_profile['name'];?>">
                        <a class="brand logout"  href="<?php echo $path_app;?>logout.php">Logout</a>
                    </span>
            <?php
                }
            ?>
                </div>
            </div>
        </div>
        <!-- End of header -->
        <div class="clearfix"></div>
        <!-- container -->
        <div class="container">            
            <div align="center">                                
                <?php
                    if($user)       //$user defined in fb-config.php file
                    {
                ?>
                        <script type="text/javascript">
                            var user=1;     // define javascript varible if user is logged in and set to 1.
                        </script>                        

                        <p class="user-name">Hi, <?php echo $user_profile['name'];?></p> <!--  User name -->

                        <div id="profile_div" align="center"> </div> <!-- Here comes the cover image of user -->
                        <div class="download-link-div"> </div>  <!-- Here comes the download link for album -->
                        <!-- main div which contains all the albums -->
                        <div class="span12 album-container">   
                <?php      
                        // iterate the album array to fetch all album cover url                  
                        foreach ($user_albums['data'] as $album) 
                        {
                            // generate src for album cover image
                            $img_src="https://graph.facebook.com/".$album['id']."/picture?type=album&amp;access_token=".$facebook->getAccessToken();                                                                                
                ?>
                            <!-- Album contaner -->
                            <div class="span3 span2-3 album-cover-div" align="center">    
                                <div class="album-cover-img" align="center">
                                    <img src='<?php echo $img_src;?>' class="album-cover" onclick="GetAlbumImages('<?php echo $album['id'];?>','<?php echo $album['count'];?>');" alt="albumimage" />
                                </div>
                                <p class="album-name">
                                    <a onclick="GetAlbumImages('<?php echo $album['id'];?>','<?php echo $album['count'];?>');"><?php echo $album['name'];?></a>
                                </p>
                                <button id="btn_<?php echo $album['id'];?>" onclick="DownloadAlbum('<?php echo $album['id'];?>','<?php echo $album['count'];?>');" class="btn btn-primary"><i class="icon-download icon-white"></i> Download </button>
                            </div>   
                            <!-- End of Album contaner -->                                                  
                <?php          
                            
                        }
                ?>
                        </div>
                <?php
                    }
                    else
                    {
                ?>
                        <script type="text/javascript">
                            var user=0;     // define javascript varible if user is logged in and set to 0.
                        </script>
                        <!-- Following div contains the content when user is not logged in -->
                        <div class="not-connected">   
                            <p>
                                Browse all your facebook albums here. They are just one click away. :D
                            </p>                         
                            <p>
                               Click <a href="<?php echo $loginUrl; ?>">here</a> to connect your <b>Facebook</b> account.
                            </p>                            
                        </div>                         

                <?php
                    }
                ?>  
                <div class="clearfix"></div>
                <hr>
            </div>        
            <!-- Followinf div contains the "loading" content -->
            <div class="loading-div">
                <div class="loading-img-contanier" align="center">
                    <img src="<?php echo $path_app;?>images/loading.gif" alt="Loading" />            
                    <p class="laoding-text">
                        Loading Album. Please Wait...
                    </p>
                </div>
            </div>  
        </div> 
        <!-- /container -->      
         <?php
            include_once($path_app.'include_files_js.php');    //include all the required js files
        ?>
        <script type="text/javascript">
            $(document).ready(function()
            {
                if(user==1)
                {
                    // get the cover image of user.
                    $.get('https://graph.facebook.com/<?php echo $user;?>?fields=cover&amp;access_token=<?php echo$facebook->getAccessToken();?>',
                    function(data)
                    {                                           
                        if (!data.hasOwnProperty('cover')) 
                            $('#profile_div').css('background-color','#000');
                        else  
                            $('#profile_div').css('background-image','url('+data['cover']['source']+')');
                    });
                }
            });
        </script>
    </body>    
</html>
