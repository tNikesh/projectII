<?php

declare(strict_types=1);

namespace App;

class Similarity
{
    public static function hamming(string $string1, string $string2, bool $returnDistance = false): float
    {
        $a        = str_pad($string1, strlen($string2) - strlen($string1), ' ');
        $b        = str_pad($string2, strlen($string1) - strlen($string2), ' ');
        $distance = count(array_diff_assoc(str_split($a), str_split($b)));

        if ($returnDistance) {
            return $distance;
        }
        return (strlen($a) - $distance) / strlen($a);
    }
    public static function euclidean(array $array1, array $array2): float
    {
        $distance = sqrt(array_sum(array_map(function ($x, $y) {
            return pow($x - $y, 2);
        }, $array1, $array2)));
    
        // Convert distance to similarity
        return 1 / (1 + $distance); // This will ensure similarity is between 0 and 1
    }

    public static function jaccard(array $p1Categories, array $p2Categories, string $separator = ','): float
    {
       // Calculate the intersection and union of both category arrays
    $intersection = array_intersect($p1Categories, $p2Categories);
    $union = array_unique(array_merge($p1Categories, $p2Categories));
    // Calculate and return the Jaccard similarity
    return count($union) === 0 ? 0 : count($intersection) / count($union);
    }

    public static function minMaxNorm(array $values, $min = null, $max = null): array
    {
        $norm = [];
        $min = $min ?? min($values);
        $max = $max ?? max($values);

        // If min and max are equal, all values are identical; avoid division by zero
        if ($min === $max) {
            // Returning an array filled with zeros or a default value, since all values are the same
            return array_fill(0, count($values), 0); // You could also use `1` if you prefer
        }

        foreach ($values as $value) {
            $numerator   = $value - $min;
            $denominator = $max - $min;
            // Prevent division by zero
            if ($denominator == 0) {
                $norm[] = 0; // or 1, depending on what behavior you want
            } else {
                $minMaxNorm = $numerator / $denominator;
                $norm[] = $minMaxNorm;
            }
        }

        return $norm;
    }
}
