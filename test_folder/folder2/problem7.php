<?php

function twoSum($nums, $target)
{
  $map = array();
  for ($i = 0; $i < count($nums); $i++) {
    $complement = $target - $nums[$i];
    if (array_key_exists($complement, $map)) {
      return array($map[$complement], $i);
    }
    $map[$nums[$i]] = $i;
  }
}

function two_sum(array $array, int $target_sum, int $i = 0, array $seen_numbers = []): array {
  // Base case: if we have iterated over the entire array, then the two numbers were not found.
  if ($i >= count($array)) {
    return [];
  }

  // Check if the complement of the current number is present in the seen numbers array.
  $complement = $target_sum - $array[$i];
  if (in_array($complement, $seen_numbers)) {
    // The complement is present in the seen numbers array, so the two numbers are $array[$i] and $complement.
    return [$seen_numbers[$complement], $i];
  }

  // The complement is not present in the seen numbers array, so add the current number to the seen numbers array and recurse.
  $seen_numbers[$array[$i]] = $i;
  return two_sum($array, $target_sum, $i + 1, $seen_numbers);
}

// $array = [1, 2, 3, 4, 5];
// $target_sum = 6;

// $indices = two_sum($array, $target_sum);

// if (empty($indices)) {
//   echo "The two numbers were not found.";
// } else {
//   echo "The two numbers are at indices " . implode(", ", $indices) . ".";
// }



