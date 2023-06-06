<?php
    class Git {
        protected $token;
        protected $owner;
        protected $repo;

        public function  __construct(string $repoName)
        {
            $this->token = "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";
            $this->owner = "umbra-byron-manalo";
            $this->repo = $repoName;
        }

        public function getBranches()
        {
            $ch = curl_init();

            $url = "https://api.github.com/repos/%s/%s/branches";
            $url = sprintf($url, $this->owner, $this->repo);

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

            $headers = array();
            $headers[] = 'Accept: application/vnd.github+json';
            $headers[] = 'Authorization: Bearer ' . $this->token;
            $headers[] = 'X-Github-Api-Version: 2022-11-28';
            $headers[] = 'User-Agent: ' . $this->repo;
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);

            return json_decode($result);
        }

        public function createPullRequest(string $remote, string $master = 'main')
        {
            $ch = curl_init();

            $url = "https://api.github.com/repos/%s/%s/pulls";
            $url = sprintf($url, $this->owner, $this->repo);

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"title\":\"Branch update from main branch.\",\"body\":\"Pull changes form main branch\",\"head\":\"$master\",\"base\":\"$remote\"}");

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

            return json_decode($result);
        }

        public function mergePullRequest(int $pullReferenceNumber)
        {
            $ch = curl_init();

            $url = "https://api.github.com/repos/%s/%s/pulls/$pullReferenceNumber/merge";
            $url = sprintf($url, $this->owner, $this->repo);

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');

            curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"commit_title\":\"Branch Update\",\"commit_message\":\"Branch Update\"}");

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

            return json_decode($result);
        }
    }

    // $git = new Git('file-download');
    
    
    
    // $pullRequest = $git->createPullRequest('test-1');

    // if(!!$pullRequest) {
    //     if(isset($pullRequest->message) && $pullRequest->message == 'Validation Failed') {
    //         echo $pullRequest->errors[0]->message;

    //         return;
    //     }

    //     if(isset($pullRequest->message) && $pullRequest->message == 'Bad credentials') {
    //         echo "GitHub personal token was expired, please generate a new one.";

    //         return;
    //     } 

    //     if(isset($pullRequest->number)) {
    //         $mergePullRequest = $git->mergePullRequest($pullRequest->number);

    //         if(isset($mergePullRequest->merged) && !!$mergePullRequest->merged) {
    //             if(isset($mergePullRequest->message)) {
    //                 echo $mergePullRequest->message;

    //                 return;
    //             }
    //         }
    //     } 
    // }   

    // $branches = $git->getBranches();
?>