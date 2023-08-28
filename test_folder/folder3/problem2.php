<?php

/**
 * Find the missing number in an array.
 *
 * @param array $array The array of integers.
 * @return int The missing number.
 */
function find_missing_number(array $array): int
{
  /**
   * Check if the array has at least 2 elements.
   * If not, throw an exception.
   */
  if (count($array) < 2) {
    throw new ValueError("The array must have at least 2 elements");
  }

  /**
   * Get the sum of the numbers in the array.
   */
  $sum_of_numbers = array_sum($array);

  /**
   * Calculate the expected sum of the numbers (formula of 1 to N consecutives numbers).
   */
  $expected_sum_of_numbers = (int)(count($array) * (count($array) + 1)) / 2;

  /**
   * Calculate the missing number by subtracting the sum of the numbers in the array from the expected sum of the numbers.
   */
  return $expected_sum_of_numbers - $sum_of_numbers;
}

/**
 * Example of implementation.
 */
// $array = [1, 2, 3, 5, 6, 7];
// $missing_number = find_missing_number($array);

// echo "The missing number is: $missing_number";
