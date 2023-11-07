<?php
session_start();

if (!isset($_SESSION["SessionUser"])) {
    echo "403<br /><br /><br />Hello Stranger! <br /> I don't think you should be here. <br /><br /> Please click the login button to gain access<br />";
    
    exit();
}

function cmp($a, $b) {
    $sizeA = getimagesize($a);
    $sizeB = getimagesize($b);
    $heightA = $sizeA[1];
    $heightB = $sizeB[1];
    return $heightB - $heightA;
}

$images = glob("./images/*.{jpg,jpeg,gif,png,bmp,webp}", GLOB_BRACE);
usort($images, "cmp");

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div>';

foreach ($images as $index => $image) {
    $size = getimagesize($image);
    $width = $size[0];
    $height = $size[1];

    // Resize the image while maintaining the aspect ratio
    $maxSize = 512;
    if ($width > $maxSize || $height > $maxSize) {
        if ($width > $height) {
            $newWidth = $maxSize;
            $newHeight = $maxSize * $height / $width;
        } else {
            $newWidth = $maxSize * $width / $height;
            $newHeight = $maxSize;
        }
    } else {
        $newWidth = $width;
        $newHeight = $height;
    }

    echo "<img src='images/" . rawurlencode(basename($image)) . "' width='" . $newWidth . "' height='" . $newHeight . "' alt='Image " . ($index + 1) . "'>";
}

echo '</div>
</body>
</html>';
?>
