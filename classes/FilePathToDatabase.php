<?php

require __DIR__.'/../vendor/autoload.php';

class FilePathToDatabase extends DataConnection
{
    use FileFinder;

    public array $files;

    public int $errorCount;

    private FileFinder $fileFinder;

    public function __construct()
    {
        parent::__construct();
        echo "\n[+] Searching directories for .php files\n\n";
        $this->files = $this->fileFinder('C:/wamp64/www/repositories/');
        if (count($this->files) > 0)
        {
            $count = count($this->files);
            print("[+] ".$count." Files found.\n\n");
            $this->insertFilesToDatabase();
        }
        else
        {
            print("[-] No files found, exiting.");
            exit;
        }
    }

    private function insertFilesToDatabase()
    {
        print("[+] Inserting files into database.\n\n");
        $this->errorCount = 0;
        $rowCount = 0;
        $classNameCount = 0;
        foreach ($this->files as $file)
        {
            $fileContents = file_get_contents($file);
            $tempRowCount = $this->preparedInsertGetCount("INSERT INTO `php_files_complete` (`file_path`, `complete_file`) VALUES (?, ?)", array($file, $fileContents));  
            if ($tempRowCount === 0)
            {
                ++$this->errorCount;
                echo "[-] File inserted: ".$file."\n";
                echo "[-] Error count: ".$this->errorCount."\n";
            }
            else
            {
                $rowCount += $tempRowCount;
                echo "[+] File inserted: ".$file."\n";
                echo "[+] Row count: ".$rowCount."\n";
            }
            $this->getClassNameFromFile($file);
            ++$classNameCount;     
        }
        print("[+] ".$classNameCount."\n\n");
        print("[+] Script execution complete, exiting.");
    }

    public function getClassNameFromFile($file)
    {
        error_reporting(~E_NOTICE & ~E_WARNING); 
        $fp = fopen($file, 'r');
        $class = $namespace = $buffer = '';
        $i = 0;
        while (!$class)
        {
            if (feof($fp)) break;

            $buffer .= fread($fp, 512);
            $tokens = @token_get_all($buffer);

            if (strpos($buffer, '{') === FALSE) continue;

            for (;$i<count($tokens);$i++) {
                if ($tokens[$i][0] === T_NAMESPACE) {
                    for ($j=$i+1;$j<count($tokens); $j++) {
                        if ($tokens[$j][0] === T_STRING) {
                            $namespace .= '\\'.$tokens[$j][1];
                        } else if ($tokens[$j] === '{' || $tokens[$j] === ';') {
                            break;
                        }
                    }
                }

                if ($tokens[$i][0] === T_CLASS) {
                    for ($j=$i+1;$j<count($tokens);$j++) {
                        if ($tokens[$j] === '{') {
                            $class = $tokens[$i+2][1];
                        }
                    }
                }
            }
        }
        if (is_string($class))
        {
            $this->preparedInsertGetCount("UPDATE `php_files_complete` SET class_name = ? WHERE `file_path` = ?", array($class, $file));
            return;
        }
        return;
        error_reporting(-1);
    }
}
$test = new FilePathToDatabase;