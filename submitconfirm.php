<!DOCTYPE html>

<html lang="en">
  <head>
    <!-- Force latest IE rendering engine or ChromeFrame if installed -->
    <!--[if IE]>
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <![endif]-->
    <meta charset="utf-8" />
    <title>함안 딥러닝 병해충</title>
    <meta
      name="description"
      content="File Upload widget with multiple file selection, drag&amp;drop support, progress bars, validation and preview images, audio and video for jQuery. Supports cross-domain, chunked and resumable file uploads and client-side image resizing. Works with any server-side platform (PHP, Python, Ruby on Rails, Java, Node.js, Go etc.) that supports standard HTML form file uploads."
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap styles -->
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
      crossorigin="anonymous"
    />
    <!-- Generic page styles -->
    <style>
      body,
      html {
        margin: 0;
        padding: 0;
        height: 100%;
      }
      #picture {
        background-image: url('./tomatoes.png');
        min-height: 100%;
        background-size: cover;
        background-position: center;
      }
      #navigation {
        margin: 10px 0;
      }
      @media (max-width: 767px) {
        #title,
        #description {
          display: none;
        }
      }
    </style>
    <!-- blueimp Gallery styles -->
    <link
      rel="stylesheet"
      href="https://blueimp.github.io/Gallery/css/blueimp-gallery.min.css"
    />
    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <link rel="stylesheet" href="css/jquery.fileupload.css" />
    <link rel="stylesheet" href="css/jquery.fileupload-ui.css" />
    <!-- CSS adjustments for browsers with JavaScript disabled -->
    <noscript
      ><link rel="stylesheet" href="css/jquery.fileupload-noscript.css"
    /></noscript>
    <noscript
      ><link rel="stylesheet" href="css/jquery.fileupload-ui-noscript.css"
    /></noscript>
  </head>
  <body id="picture">
    <div class="container">
      <ul class="nav nav-tabs" id="navigation">
        <li class="active">
          <a href="#">토마토 잎 병해</a>
        </li>
        <li>
          <a href="#">해충</a>
        </li>
      </ul>
      <h1 id="title" style="color:white">결과 이미지</h1>
      <blockquote id="description">
        <p style="color:white">
          설명설명<br />
        </p>
      
        <?php
        $filename = "./pictures/".$_FILES["input_img"]["name"];

        $result = opendir("./Storage");
        while($file = readdir($result)){
            $file_count = $file_count +1;
        }

        if($_FILES["input_img"]["size"]!=0){
          
          if(move_uploaded_file($_FILES["input_img"]["tmp_name"],$filename) == true){
            exec('python3 ResNet50RetinaNet.py');
            echo "<img src = './result/retinanet.jpg' width='600'>";
            
            $directory = "/var/www/html/result";
            $handle = opendir($directory);
            while($file=readdir($handle)){
              @unlink($directory.$file);
            }
            closedir($handle);
          }
        }

        function compress($source, $destination, $quality){
          $info=getimagesize($source);
          if($info['mime']=='image/jpeg'){
            $image= imagecreatefromjpeg($source);
          }elseif ($info['mime']=='image/png'){
            $image= imagecreatefrompng($source);
          }
          imagejpeg($image, $destination, $quality);
          return $destination;
        }
        ?>
      </blockquote>
      
      
    </div>
    <!-- The blueimp Gallery widget -->
    <div
      id="blueimp-gallery"
      class="blueimp-gallery blueimp-gallery-controls"
      data-filter=":even"
    >
      <div class="slides"></div>
      <h3 class="title"></h3>
      <a class="prev">‹</a>
      <a class="next">›</a>
      <a class="close">×</a>
      <a class="play-pause"></a>
      <ol class="indicator"></ol>
    </div>
    <!-- The template to display files available for upload -->
    
    <script
      src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"
      integrity="sha384-vk5WoKIaW/vJyUAd9n/wmopsmNhiy+L2Z+SBxGYnUkunIxVxAv/UtMOhba/xskxh"
      crossorigin="anonymous"
    ></script>
    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    <script src="js/vendor/jquery.ui.widget.js"></script>
    <!-- The Templates plugin is included to render the upload/download listings -->
    <script src="https://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
    <!-- blueimp Gallery script -->
    <script src="https://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="js/jquery.iframe-transport.js"></script>
    <!-- The basic File Upload plugin -->
    <script src="js/jquery.fileupload.js"></script>
    <!-- The File Upload processing plugin -->
    <script src="js/jquery.fileupload-process.js"></script>
    <!-- The File Upload image preview & resize plugin -->
    <script src="js/jquery.fileupload-image.js"></script>
    <!-- The File Upload audio preview plugin -->
    <script src="js/jquery.fileupload-audio.js"></script>
    <!-- The File Upload video preview plugin -->
    <script src="js/jquery.fileupload-video.js"></script>
    <!-- The File Upload validation plugin -->
    <script src="js/jquery.fileupload-validate.js"></script>
    <!-- The File Upload user interface plugin -->
    <script src="js/jquery.fileupload-ui.js"></script>
    <!-- The main application script -->
    <script src="js/demo.js"></script>
    <!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
    <!--[if (gte IE 8)&(lt IE 10)]>
      <script src="js/cors/jquery.xdr-transport.js"></script>
    <![endif]-->
  </body>
</html>
