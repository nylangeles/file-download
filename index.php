<?php
    // echo exec("sh -x git-pull.sh", $output);
    // echo implode('\n', $output);

    // $output = exec('git pull', $outputLines, $returnCode);

    // if ($returnCode === 0) {
    //     echo "Git pull successful!";
    // } else {
    //     echo "Git pull failed!";
    // }

    // echo implode(PHP_EOL, $outputLines);

    class Command {
        public function execute($cmd, $workdir = null) {

            if (is_null($workdir)) {
                $workdir = __DIR__;
            }
        
            $descriptorspec = array(
               0 => array("pipe", "r"),  // stdin
               1 => array("pipe", "w"),  // stdout
               2 => array("pipe", "w"),  // stderr
            );
        
            $process = proc_open($cmd, $descriptorspec, $pipes, $workdir, null);
        
            $stdout = stream_get_contents($pipes[1]);
            fclose($pipes[1]);
        
            $stderr = stream_get_contents($pipes[2]);
            fclose($pipes[2]);
        
            return [
                'code' => proc_close($process),
                'out' => trim($stdout),
                'err' => trim($stderr),
            ];
        }
    }

    if(array_key_exists('pull', $_POST)){
        $command = new Command();
        $result = $command->execute("git pull");
        print_r($result);
    }
?>

<!DOCTYPE html>
<html>
<head>
<title>GitHub Pull</title>
</head>
<body>
    <form method="post">
        <input type="submit" name="pull" id="pull" value="Update" /><br/>
    </form>
</body>
</html>
