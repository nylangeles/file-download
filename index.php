<?php
    // require __DIR__ . '/vendor/autoload.php';
    
    // class File {
    //     public function zipFile($path, $destination, $fileType = "*") {
    //         // List files inside specific directory
    //         // "*" Any file type listed
    //         // If you want to list specific file type just indicicate the type like "*.php", "*.png"
    //         $files = glob($path . $fileType);

    //         if(extension_loaded('zip')){
    //             if(count($files) > 0) {
    //                 $zip = new ZipArchive;

    //                 if($zip->open($destination, ZIPARCHIVE::CREATE | ZipArchive::OVERWRITE) !== TRUE){ 
    //                     echo "ZIP creation failed.";
                
    //                     return null;
    //                 }

    //                 foreach ($files as $file) {
    //                     $zip->addFile($file);
    //                 }

    //                 $zip->close();

    //                 return $destination;
    //             }
    //         }

    //         return null;
    //     }

    //     public function downloadFile($filesToDownload, $contentType) {
    //         header('Content-Type: ' . $contentType);
    //         header('Content-disposition: attachment; filename='.$filesToDownload);
    //         header('Content-Length: ' . filesize($filesToDownload));
    //         readfile($filesToDownload);
    //         exit();
    //     }
    // } 

    // $files = new File();
    // $zipFile = $files->zipFile("./files/", "download.zip");

    // if($zipFile) {
    //     $files->downloadFile($zipFile, 'application/zip');
    // }

    echo shell_exec("sh -x git-pull.sh");
    echo "test";

?>