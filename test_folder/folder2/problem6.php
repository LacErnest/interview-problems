<?php

/**
 * Finds the longest substring that is a palindrome.
 *
 * @param string $string The string to search.
 * @return string The longest substring that is a palindrome.
 */
function longest_palindrome(string $string): string # naive approach O(n^3)
{
  $n = strlen($string);
  $index = -1;
  $max_length = 0;
  // looping over the string for substrings
  for ($i = 0; $i < $n; $i++) {
    for ($j = $i; $j < $n; $j++) {
      $isPalindrome = 1;
      // checking if string is palindrome
      for ($k = $i; $k <= $j; $k++) {
        if ($string[$k] != $string[$j - ($k - $i)]) {
          $isPalindrome = 0;
        }
      }
      if ($isPalindrome == 1 && $j - $i + 1 > $max_length) {
        $index = $i;
        $max_length = $j - $i + 1;
      }
    }
  }

  // return the substring from updated index till length maxlength
  $ans = "";
  for ($i = $index; $i < $index + $max_length; $i++) {
    $ans .= $string[$i];
  }
  return $ans;
}


  /**
   * Finds the longest palindromic substring in a string.
   *
   * @param string $string The string to search.
   * @return string The longest palindromic substring in the string.
   */
  function longest_palindrome_1(string $string): string # Manachar approach O(n)
  { 
  // The length of the string after inserting special characters.
  $str_len = 2 * strlen($string) + 3;

  // The character array to store the string with special characters.
  $s_chars = str_repeat("#", $str_len);

  // Inserting special characters to ignore special cases at the beginning and end of the array.
  $s_chars[0] = "@";
  $s_chars[$str_len - 1] = "$";
  $t = 1;
  for($c = 0; $c < strlen($string); $c++) {
    $s_chars[$t++] = "#";
    $s_chars[$t++] = $string[$c];
  }
  $s_chars[$t] = "#";

  // The maximum length of the palindrome substring.
  $max_len = 0;
  // The start index of the palindrome substring.
  $start = 0;
  // The rightmost end of the palindrome substring centered at i.
  $max_right = 0;
  // The center of the palindrome substring.
  $center = 0;
  // The radius of the palindrome substring centered at i, which doesn't include i.
  $p = array_fill(0, $str_len, 0);

  for ($i = 1; $i < $str_len - 1; $i++) {
    // If i is within the range of the palindrome substring centered at 2 * center - i.
    if ($i < $max_right) {
      // The radius of the palindrome substring centered at i is the minimum of the radius of the palindrome substring centered at 2 * center - i and max_right - i.
      $p[$i] = min($max_right - $i, $p[2 * $center - $i]);
    }

    // Expanding along the center.
    while ($s_chars[$i + $p[$i] + 1] == $s_chars[$i - $p[$i] - 1]) {
      $p[$i]++;
    }

    // Updating the center and its bound.
    if ($i + $p[$i] > $max_right) {
      $center = $i;
      $max_right = $i + $p[$i];
    }

    // Updating the maximum length and start index of the palindrome substring.
    if ($p[$i] > $max_len) {
      $start = ($i - $p[$i] - 1) / 2;
      $max_len = $p[$i];
    }
  }

  // Returning the longest palindromic substring.
  return substr($string, $start, $max_len);
}


// echo 'expected: "abcba", got: ';
// var_dump(longest_palindrome("abcba"));
// echo 'expected: "aa", got: ';
// var_dump(longest_palindrome("aa"));
// echo 'expected: "aaaaaa", got: ';
// var_dump(longest_palindrome("aaaaaa"));
// echo 'expected: "ccc", got: ';
// var_dump(longest_palindrome("ccc"));
// echo 'expected: "bbbb", got: ';
// var_dump(longest_palindrome("bbbb"));
// echo 'expected: "aaaaa", got: ';
// var_dump(longest_palindrome("axvfdaaaaagdgre"));
// echo 'expected: "bcgeeegcb", got: ';
// var_dump(longest_palindrome("adsasdabcgeeegcbgtrhtyjtj"));