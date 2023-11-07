<?php
            // (A) GET IMAGE INFO
            $file = __DIR__ . DIRECTORY_SEPARATOR . "images/images.jpg";
            $fileData = exif_read_data($file);
            
            // (B) READ & OUTPUT IMAGE
            ob_start();
            header("Content-Type: " . $fileData["MimeType"]);
            header("Content-Length: " . $fileData["FileSize"]);
            readfile($file);
            ob_end_flush();
        ?>