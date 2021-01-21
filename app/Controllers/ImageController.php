<?php


namespace App\Controllers;


use App\Models\Image;
use App\Models\Product;
use Core\Config;
use Core\Router;
use Core\Session;

/**
 * Class ImageController
 * @package App\Controllers
 */
class ImageController
{

    /**
     * @param int $productId
     * @return bool
     * Uploads image and connects it to a product id.
     */
    public function uploadImages(int $productId): bool
    {

        $errors = [];


        if (!empty($_FILES['images']['name'][0])) {

            foreach ($_FILES['images']['name'] as $index => $fileName) {
                $name = $fileName;
                $type = $_FILES['images']['type'][$index];
                $tmpName = $_FILES['images']['tmp_name'][$index];
                $error = $_FILES['images']['error'][$index];
                $size = $_FILES['images']['size'][$index];

                if ($error !== UPLOAD_ERR_OK) {
                    $errors[] = "Dateiupload fehlgeschlagen. (Fehler $error)";
                } elseif (strpos($type, 'image/') !== 0) {
                    $errors[] = "Unerlaubtes Dateiformat. Es sind nur Bilder erlaubt.";
                } else {
                    $storagePath = Config::get('app.storage-path', 'storage/');
                    $uploadPath = Config::get('app.upload-path', 'uploads/');

                    $destinationFolder = __DIR__ . "/../../{$storagePath}{$uploadPath}";
                    $destinationFileName = time() . "_" . $name;
                    $destination = $destinationFolder . $destinationFileName;

                    if (move_uploaded_file($tmpName, $destination)) {
                        $image = new Image();
                        $image->path = $storagePath . $uploadPath . $destinationFileName;

                        if($image->save()) {
                            $image->connectToProduct($productId);
                        } else {
                            $errors[] = 'Das Bild konnte nicht gespeichert werden.';
                        }
                    }
                }
            }

            if(!empty($errors)) {
                Session::set('errors', $errors);
                Router::redirectTo('admin/produkte/add');
            } else {
                return true;
            }
        }

        return true;
    }

    public function updateAndUploadImages(int $productId): bool
    {
        // delete images
        $product = Product::find($productId);
        $product->disconnectAndDeleteImages();

        // upload new images
        return $this->uploadImages($productId);
    }
}