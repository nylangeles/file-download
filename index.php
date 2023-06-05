<?php
    // echo exec("sh -x git-pull.sh", $output);
    // echo implode('\n', $output);

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

        public function createPullRequest(string $remote, string $master = 'main')
        {
            $ch = curl_init();

            $url = "https://api.github.com/repos/%s/%s/pulls";
            $url = sprintf($url, $this->owner, $this->repo);

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"title\":\"Amazing new feature\",\"body\":\"Please pull these awesome changes in!\",\"head\":\"$master\",\"base\":\"$remote\"}");

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

        public function mergePullRequest()
        {

        }
    }

    $git = new Git('file-download');
    
    
    $git->createPullRequest('test-1');
    

?>