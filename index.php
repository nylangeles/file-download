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

    // echo shell_exec("sh -x git-pull.sh");
    // echo "test";

    class Git {
        protected $token;
        protected $owner;
        protected $repo;

        public function __construct()
        {
            $this->token = "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";
            $this->owner = "umbra-byron-manalo";
            $this->repo = "file-download";
        }

        public function getBranch($branch = 'main') 
        {
            $ch = curl_init();

            $url = "https://api.github.com/repos/%s/%s/branches/%s";
            $url = sprintf($url, $this->owner, $this->repo, $branch);

            curl_setopt( $ch, CURLOPT_URL, $url );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, [
                'Accept: application/vnd.github+json',
                'Authorization: Bearer ' . $this->token,
                'X-GitHub-Api-Version: 2022-11-28',
                'User-Agent: ' . $this->repo 
            ]);

            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            $output = curl_exec( $ch );
            curl_close ($ch);

            return $output;
        }

        public function syncForkBranch($branch = 'main')
        {
            $ch = curl_init();

            $url = "https://api.github.com/repos/%s/%s/merge-upstream";
            $url = sprintf($url, $this->owner, $this->repo);

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"branch\":\"$branch\"}");

            $headers = array();
            $headers[] = 'Accept: application/vnd.github+json';
            $headers[] = 'Authorization: Bearer ' . $this->token;
            $headers[] = 'X-Github-Api-Version: 2022-11-28';
            $headers[] = 'Content-Type: application/x-www-form-urlencoded';
            $headers[] = 'User-Agent: ' . $this->repo;
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);

            return $result;
        }

        public function mergeBranch($base, $head = 'main')
        {
            $ch = curl_init();

            $url = "https://api.github.com/repos/%s/%s/merge-upstream";
            $url = sprintf($url, $this->owner, $this->repo);

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"base\":\"$base\",\"head\":\"$head\",\"commit_message\":\"Branch update!\"}");

            $headers = array();
            $headers[] = 'Accept: application/vnd.github+json';
            $headers[] = 'Authorization: Bearer ' . $this->token;
            $headers[] = 'X-Github-Api-Version: 2022-11-28';
            $headers[] = 'Content-Type: application/x-www-form-urlencoded';
            $headers[] = 'User-Agent: ' . $this->repo;
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);

            return $result;
        }
    }

    $git = new Git();

    $output = $git->mergeBranch('new-1', 'main');

    print_r($output);

    

?>