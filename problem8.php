<?php
function canSegmentString(string $s, array $dictionary): bool {
    $n = strlen($s);
    $dp = array_fill(0, $n + 1, false);
    $dp[0] = true;

    for ($i = 1; $i <= $n; $i++) {
        for ($j = 0; $j < $i; $j++) {
            if ($dp[$j] && in_array(substr($s, $j, $i - $j), $dictionary)) {
                $dp[$i] = true;
                break;
            }
        }
    }

    return $dp[$n];
}

// Usage
$s = "applepenapple";
$dictionary = ["apple", "pen"];
var_dump(canSegmentString($s, $dictionary));  // Outputs: bool(true)


//--------------------------------------------------------------
function longestCommonPrefix(array $strs): string {
    if (count($strs) == 0) {
        return "";
    }

    $prefix = $strs[0];

    for ($i = 1; $i < count($strs); $i++) {
        while (strpos($strs[$i], $prefix) !== 0) {
            $prefix = substr($prefix, 0, -1);
            if (empty($prefix)) {
                return "";
            }
        }
    }

    return $prefix;
}

// Usage
$strs = ["flower", "flow", "flight"];
echo longestCommonPrefix($strs);  // Outputs: "fl"


//------------------------------------------------------------------
function firstNonRepeatingCharacter(string $str): string {
    $count = array_count_values(str_split($str));

    foreach ($count as $char => $num) {
        if ($num == 1) {
            return $char;
        }
    }

    return "";
}

// Usage
$str = "loveleetcode";
echo firstNonRepeatingCharacter($str);  // Outputs: "v"

//-------------------------------------------------------
function firstRepeatingCharacter(string $str): string {
    $count = array();
    $chars = str_split($str);

    foreach ($chars as $char) {
        if (isset($count[$char])) {
            return $char;
        }
        $count[$char] = 1;
    }

    return "";
}

// Usage
$str = "interviewquery";
echo firstRepeatingCharacter($str);  // Outputs: "i"

//-------------------------------------------------------
function firstUniqueCharacter(string $str): string {
    $count = array_count_values(str_split($str));

    foreach (str_split($str) as $char) {
        if ($count[$char] == 1) {
            return $char;
        }
    }

    return "";
}

// Usage
$str = "loveleetcode";
echo firstUniqueCharacter($str);  // Outputs: "l"


//----------------------------------------------
function firstUniqueCharacterIndex(string $str): int {
    $count = array_count_values(str_split($str));

    foreach (str_split($str) as $index => $char) {
        if ($count[$char] == 1) {
            return $index;
        }
    }

    return -1;
}

// Usage
$str = "loveleetcode";
echo firstUniqueCharacterIndex($str);  // Outputs: 0

//---------------------------------------------------------
function firstRepeatingCharacterIndex(string $str): int {
    $count = array();
    $chars = str_split($str);

    foreach ($chars as $index => $char) {
        if (isset($count[$char])) {
            return $index;
        }
        $count[$char] = 1;
    }

    return -1;
}

// Usage
$str = "interviewquery";
echo firstRepeatingCharacterIndex($str);  //