<?php
$dir = 'app/public/songs/jazz';

$files = scandir($dir);
$files = array_splice($files, 2);
print_r($files);

foreach($files as $file)
{
  rename("$dir/$file", $dir . '/' . str_replace([' ', '\'', '/', '.', ','], '', $file));
}

print_r($files);
