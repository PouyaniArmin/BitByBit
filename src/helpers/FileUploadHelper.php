<?php

function uploadImage($fields)
{
    $imagename = $fields['name'];
    $tempname = $fields['tmp_name'];
    $folder = "uploads/" . $imagename;
    if (move_uploaded_file($tempname, $folder)) {
        echo "Upload <br>";
    }
    return $folder;
}

function uploadImagesFromContent($content)
{
    $content = html_entity_decode($content);
    $doc = new DOMDocument();
    libxml_use_internal_errors(true);
    $doc->loadHTML($content);
    $xpath = new DOMXPath($doc);
    $images = $xpath->query('//img');
    foreach ($images as $img) {
        $src = $img->getAttribute('src');
        if (preg_match('/^data:image\/(\w+);base64,/', $src, $matches)) {
            $image_data = substr($src, strpos($src, ',') + 1);
            $image_data = base64_decode($image_data);
            $filename = "uploads/" . uniqid() . '.' . $matches[1];
            file_put_contents($filename, $image_data);
            echo "Image uploaded to: " . $filename . "<br>";
        }
    }
    return $doc->saveHTML();
}
