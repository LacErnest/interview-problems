<?php

/**
 * Find the length of the longest substring without repeating characters.
 *
 * @param string $str The string to find the longest substring from.
 * @return int The length of the longest substring.
 */
function longest_substring(string $str): int {

  /**
   * Check if the string parameter is a string.
   * If it is not, throw a TypeError.
   */
  if (!is_string($str)) {
    throw new TypeError("The input must be a string");
  }


  /**
   * Check if the string is empty.
   * If it is, return 0.
   */
  if (empty($str)) {
    // The string is empty, so the longest substring is 0 characters long.
    return 0;
  }

  /**
   * Initialize the variables.
   */
  $n = strlen($str);
  if ($n <= 1) {
    return $n;
  }
  // The current length of the longest substring without repeating characters.
  $cur_len = 1;
  // The maximum length of the longest substring without repeating characters.
  $max_len = 1;
  // The previous index of the current character in the sliding window.
  $prev_index = -1;
  // A visited array to track the previous indices of the characters in the string.
  $visited = array_fill(0, 256, -1);
  // Mark the first character as visited.
  $visited[ord($str[0])] = 0;

  /**
   * Recursively find the longest substring without repeating characters.
   *
   * @param string $str The string to find the longest substring from.
   * @param array &$visited A visited array to track the previous indices of the characters in the string.
   * @param int &$cur_len The current length of the longest substring without repeating characters.
   * @param int &$max_len The maximum length of the longest substring without repeating characters.
   * @param int &$prev_index The previous index of the current character in the sliding window.
   * @param int $i The current index in the string.
   */
  function longest_substring_helper(string $str, array &$visited, int &$cur_len, int &$max_len, int &$prev_index, int $i): void {

    /**
     * Base case: if the current index is equal to the length of the string, return.
     */
    if ($i == strlen($str)) {
      return;
    }

    /**
     * Get the previous index of the current character.
     */
    $prev_index = $visited[ord($str[$i])];

    /**
     * Check if the current character is already in the sliding window.
     */
    // The `||` operator is used to check if the previous index is -1 or if the current index minus the current length is greater than the previous index.
    // This is because a character can only be repeated if it is the first character in the sliding window.
    if ($prev_index == -1 || ($i - $cur_len > $prev_index)) {
      // The current character is not in the sliding window, so increment the current length.
      $cur_len++;
    } else {
      /**
       * Update the maximum length if the current length is greater than the maximum length.
       */
      if ($cur_len > $max_len) {
        // The current substring is the longest substring so far.
        $max_len = $cur_len;
      }
      // The current character is in the sliding window, so reset the current length to the current index minus the previous index.
      $cur_len = $i - $prev_index;
    }

    /**
     * Update the visited array.
     */
    $visited[ord($str[$i])] = $i;

    /**
     * Recursively find the longest substring starting from the next character.
     */
    longest_substring_helper($str, $visited, $cur_len, $max_len, $prev_index, ++$i);
  }

  /**
   * Call the recursive function to find the longest substring.
   */
  longest_substring_helper($str, $visited, $cur_len, $max_len, $prev_index, 1);

  if ($cur_len > $max_len) {
    $max_len = $cur_len;
  }

  /**
   * Return the maximum length.
   */
  return $max_len;
}


