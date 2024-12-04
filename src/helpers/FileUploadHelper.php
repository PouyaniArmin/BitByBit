<?php
/**
 * Uploads a single image file to the server.
 * 
 * @param array $fields The $_FILES array containing image file data.
 * @return string The path of the uploaded file.
 */
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
/**
 * Uploads images embedded in the HTML content (base64 encoded) to the server.
 * 
 * @param string $content The HTML content containing base64-encoded images.
 * @return string The modified HTML content with image src paths updated.
 */
function uploadImagesFromContent($content)
{
    $content = html_entity_decode($content);
    $doc = new DOMDocument();
    libxml_use_internal_errors(true);
    $doc->loadHTML($content);
    $xpath = new DOMXPath($doc);
    $images = $xpath->query('//img');
    foreach ($images as $img) {
        if ($img instanceof DOMElement) {
            $src = $img->getAttribute('src');
        if (preg_match('/^data:image\/(\w+);base64,/', $src, $matches)) {
            $image_data = substr($src, strpos($src, ',') + 1);
            $image_data = base64_decode($image_data);
            $filename = "uploads/" . uniqid() . '.' . $matches[1];
            file_put_contents($filename, $image_data);
            echo "Image uploaded to: " . $filename . "<br>";
        }
        }
    }
    return $doc->saveHTML();
}
