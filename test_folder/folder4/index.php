<?php

require_once("problem1.php");
require_once("problem2.php");
require_once("problem3.php");
require_once("problem4.php");
require_once("problem5.php");
require_once("problem6.php");
require_once("problem7.php");
require_once("question1.php");
require_once("question2.php");


function main(): void {

  /* $str = 'vkvdvzradarpokfepojneziohs';
  $palindrome = longest_palindrome_1($str);
  echo "The longest palindromic substring in the string \"$str\" is \"$palindrome\""; */

  // Example usage:
  $json_string_1 = '{"name": "John", "age": 30, "city": "New York"}';
  $json_string_2 = '{"fruits": ["apple", "orange", "banana"], "numbers": [1, 2, 3]}';
  $json_string_3 = '{"user": {"name": "Alice", "age": 25}, "languages": ["PHP", "JavaScript", "Python"]}';
  $json_string_4 = '';

  /* try {
    $result = json_to_array_recursive($json_string_4);
    print_r($result);
  } catch (InvalidArgumentException $e) {
    echo ''.$e->getMessage();
  } */

  $main_folder = 'test_folder';
  $max_files_per_folder = 4;

  move_files_to_subfolders_recursive($main_folder, $max_files_per_folder);
    
}

main();

// // Call the longest_substring() function.
// $max_len = longest_substring(2222222222222);

// // Print the result.
// echo "The length of the longest substring without repeating characters is: $max_len";
