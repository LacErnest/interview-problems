<?php

function move_files_to_subfolders_recursive(string $main_folder, int $max_files_per_folder)
{

  // Check if the main folder exists.
  if (!file_exists($main_folder)) {
    throw new Exception('The main folder does not exist.');
  }

  // Get all of the files in the main folder.
  $files = get_files_in_directory($main_folder);

  $countFiles = 0;
  $countFiles = count($files);
  echo "counFiles : ". $countFiles. "\r\n";
  // If there are no files, return.
  if ($countFiles === 0) {
    return;
  }

  //get the number of folder to create.
  $max_folder_index = intdiv($countFiles, $max_files_per_folder);
  $max_folder_index = ($countFiles % $max_files_per_folder) > 0 ? $max_folder_index + 1 : $max_folder_index;

  echo "max_folder_index : ". $max_folder_index . "\r\n";
  // Get the first file.
  $file = $files[0];

  // If the subfolder does not exist, create it.
  $subfolder = $main_folder . '/' . 'folder' . $max_folder_index;
  echo "current subfolder : " . $subfolder . "\r\n";
  if (!file_exists($subfolder)) {
    mkdir($subfolder);
  }

  echo "current file : " . $file . "\r\n";
  // Open the file.
  $handle = fopen($main_folder . '/' . $file, 'r+');

  // Lock the file.
  flock($handle, LOCK_EX);

  // Move the file to the subfolder.
  rename($main_folder . '/' . $file, $subfolder . '/' . $file);

  // Unlock the file.
  flock($handle, LOCK_UN);

  // Recursively move the remaining files to subfolders.
  move_files_to_subfolders_recursive($main_folder, $max_files_per_folder);
}


function get_files_in_directory(string $directory)
{
  // Get all of the files in the directory.
  $files = scandir($directory);

  // Filter out any subdirectories.
  $filtered_files = [];
  foreach ($files as $file) {
    if (!is_dir($directory . '/' . $file)) {
      $filtered_files[] = $file;
    }
  }

  // Return the filtered files.
  return $filtered_files;
}
