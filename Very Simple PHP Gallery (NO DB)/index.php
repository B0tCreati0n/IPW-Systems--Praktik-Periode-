<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="gallery">
    <?php 
    $images = glob("./images/*.{jpg,jpeg,gif,png,bmp,webp}", GLOB_BRACE);
    foreach ($images as $i) { echo "<img src='images/". rawurlencode(basename($i)) ."'>"; }
    ?>
    </div>
</body>
</html>