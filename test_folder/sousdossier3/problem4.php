<?php

/**
 * Print the FizzBuzz numbers from 1 to N using recursion.
 *
 * @param int $n The maximum number to print.
 */
function fizz_buzz_recursive(int $n): void
{
  /**
   * Check if the number is valid.
   * If not, throw an exception.
   */
  if ($n < 1) {
    throw new ValueError("The number must be greater than or equal to 1");
  }

  /**
   * Base case: if the number is 1, print the number and return.
   */
  if ($n == 1) {
    echo $n;
    return;
  }

  /**
   * Recursive case: print "Fizz" if the number is a multiple of three, "Buzz" if the number is a multiple of five, or the number itself if it is not a multiple of three or five.
   */
  if ($n % 3 == 0) {
    echo "Fizz";
  } else if ($n % 5 == 0) {
    echo "Buzz";
  } else {
    echo $n;
  }

  /**
   * Recursively print the FizzBuzz numbers from 1 to N - 1.
   */
  fizz_buzz_recursive($n - 1);
}

/**
 * Example of implementation.
 */
// fizz_buzz_recursive(10);
