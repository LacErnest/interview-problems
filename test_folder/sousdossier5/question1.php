<?php

/**
 * Converts a JSON string to an array.
 *
 * @param string $json The JSON string to convert.
 *
 * @return array The converted array.
 */
function json_to_array_recursive(string $json): array
{

  // Check if the input is a valid JSON string.
  if (!is_string($json) || !json_decode($json)) {
    throw new InvalidArgumentException('The input is not a valid JSON string.');
  }
  
  $array = [];
  $decoded = json_decode($json, true);

  foreach ($decoded as $key => $value) {
    if (is_array($value) || is_object($value)) {
      $array[$key] = json_to_array_recursive(json_encode($value));
    } else {
      $array[$key] = $value;
    }
  }

  return $array;
}

