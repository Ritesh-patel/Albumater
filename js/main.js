        var path_app="";        // define variable for arr root
        
        // This function gets all images of album by passing album id to it.
        function GetAlbumImages(albumid)
        {
            if(albumid=="")
                alert("Error in fetching album images.");
            else
            {
                // followinf code will show a "loading" gif
                $('.loading-div').css("display","block");
                $('.loading-img-contanier p').text("Loading Album. Please Wait...");
                $('.loading-div').height($(document).height()); 
                $('.loading-div').width($(document).width());           
                var img_height=($(window).height()-$('.loading-img-contanier').height())/2;
                var img_width=($(window).width()-$('.loading-img-contanier').width())/2;
                $('.loading-img-contanier').css("top",img_height+"px");
                $('.loading-img-contanier').css("left",img_width+"px");

                // make an ajax call to GetAlbumImages.php to get all the album images of given album id.
                $.post(path_app+"ajax/GetAlbumImages.php",
                {
                    albumid:albumid
                },
                function(data)
                {                      
                    data=JSON.parse(data);  // parse the return data into  json data.                
                    $.fn.prettyPhoto({
                        autoplay_slideshow: true,
                        animation_speed: 'fast',
                        autoplay: true,
                        slideshow: 3000
                    });
                    $('.loading-div').css("display","none");
                    $.prettyPhoto.open(data);   // start slide show of all the images of an album.
                });
            }
        }

        // this function will generate a zip contains all the images of given album id.
        function DownloadAlbum(albumid)
        {
            if(albumid=="")
                alert("Error in downloading album images.");
            else
            {                
                // followinf code will show a "loading" gif
                $('.loading-div').css("display","block");
                $('.loading-img-contanier p').text("Building the zip to download. Please Wait...");
                $('.loading-div').height($(document).height()); 
                $('.loading-div').width($(document).width());           
                var img_height=($(window).height()-$('.loading-img-contanier').height())/2;
                var img_width=($(window).width()-$('.loading-img-contanier').width())/2;
                $('.loading-img-contanier').css("top",img_height+"px");
                $('.loading-img-contanier').css("left",img_width+"px");

                //  make an ajax call to GenerateZip.php file to generate zip of all the images of given album id.
                $.post(path_app+"ajax/GenerateZip.php",
                {
                    albumid:albumid
                },
                function(data)
                {
                    var div_html="    <div class='alert alert-success'>    <button type='button' class='close' data-dismiss='alert'>&times;</button>    <strong>Hurray!</strong> Your zip has been created. Click <a href='"+path_app+"downloads/YourAlbum.zip'>here</a> to download your album.    </div>";
                    $('.loading-div').css("display","none");
                    if(data=="1")
                    {
                        $('.download-link-div').html(div_html);                        
                    }
                    else
                        alert('Error in generaing zip.');                    
                });
            }
        }  