<?php

/**
 * Reverse a string.
 *
 * @param string $string The string to reverse.
 * @return string The reversed string.
 */
function reverse_string(string $string): string
{
  /**
   * Returns the reversed string using the mb_strrev() function.
   */
  return mb_strrev($string);
}

/**
 * Reverse a string using the mb_strrev() function.
 *
 * @param string $string The string to reverse.
 * @param string $encoding The character encoding of the string.
 * @return string The reversed string.
 */
function mb_strrev(string $string, string $encoding = null)
{

  /**
   * Check if the string parameter is a string.
   * If it is not, throw a TypeError.
   */
  if (!is_string($string)) {
    throw new TypeError("The input must be a string");
  }

  /**
   * Check if the encoding parameter is null.
   * If it is, detect the character encoding of the string.
   */
  if ($encoding === null) {
    $encoding = mb_detect_encoding($string);
  }

  /**
   * Get the length of the string.
   */
  $length = mb_strlen($string, $encoding);

  /**
   * Initialize a variable to store the reversed string.
   */
  $reversed = '';

  /**
   * Iterate over the string from the end to the beginning.
   * Extract a substring from the string and append it to the reversed string.
   */
  while ($length-- > 0) {
    $reversed .= mb_substr($string, $length, 1, $encoding);
  }

  /**
   * Return the reversed string.
   */
  return $reversed;
}


/**
 * Example of implementation.
 */
// $string = "Sharingan";
// $reversed = reverse_string($string);

// echo "The reversed string is: $reversed";
