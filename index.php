<?php

require_once("problem1.php");
require_once("problem2.php");
require_once("problem3.php");
require_once("problem4.php");
require_once("problem5.php");
require_once("problem6.php");
require_once("problem7.php");


function main(): void {

  /* $str = 'vkvdvzradarpokfepojneziohs';
  $palindrome = longest_palindrome_1($str);
  echo "The longest palindromic substring in the string \"$str\" is \"$palindrome\""; */

  // Example usage:
  $nums = array(2, 7, 11, 15);
  $target = 9;
  $result = twoSum($nums, $target);
  print_r($result);
}

main();

// // Call the longest_substring() function.
// $max_len = longest_substring(2222222222222);

// // Print the result.
// echo "The length of the longest substring without repeating characters is: $max_len";
