<?php
Trait FileFinder
{
    public string $directoryFilter = '/smarty|vendor|node_modules|deepscripts|blackeye|phpBrute|phpChart_light|parallel/i';

    public string $fileFilter = '/\.(?:php)$/';

    public function fileFinder(string $path, string $fileFilter=NULL, string $directoryFilter=NULL) : array
    {
        if (!is_null($fileFilter))
        {
            $this->fileFilter = $fileFilter;
        }
        if (!is_null($directoryFilter))
        {
            $this->directoryFilter = $directoryFilter;
        }
        return $this->recursiveRegexIterator($path);
    }

    public function recursiveRegexIterator(string $path) : array
    {
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
        $phpFile = new RegexIterator($iterator, $this->fileFilter);
        
        $files = array();
        
        foreach ($phpFile as $info)
        {
            if(!preg_match($this->directoryFilter, $info))
            {
                $files[] = $info->getPathname();
            }
        }
        if (!empty($files))
        {
            return $files;
        }
        else
        {
            $files[] = 'No files discovered within search parameters.';
            return $files;
        }
    }
}