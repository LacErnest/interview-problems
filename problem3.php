<?php

/**
 * Count the number of vowels in a string.
 *
 * @param string $string The string to count the vowels in.
 * @return int The number of vowels in the string.
 */
function count_vowels(string $string): int
{
  /**
   * Check if the string is empty.
   * If it is, return 0.
   */
  if (empty($string)) {
    return 0;
  }

  /**
   * Initialize a variable to store the number of vowels.
   */
  $number_of_vowels = 0;

  /**
   * Loop over the characters in the string.
   */
  for ($i = 0; $i < strlen($string); $i++) {
    /**
     * Check if the current character is a vowel.
     */
    if (preg_match('/[aeiou]/', $string[$i])) {
      /**
       * Increment the number of vowels.
       */
      $number_of_vowels++;
    }
  }

  /**
   * Return the number of vowels.
   */
  return $number_of_vowels;
}

/**
 * Example of implementation.
 */
// $string = "Hello, world!";
// $number_of_vowels = count_vowels($string);

// echo "The number of vowels in the string is: $number_of_vowels";
