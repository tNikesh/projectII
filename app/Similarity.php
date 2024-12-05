<?php

declare(strict_types=1);

namespace App;

class Similarity
{
   
    public static function euclidean(array $array1, array $array2): float
    {
        // Calculate the Euclidean distance
    $distance = sqrt(array_sum(array_map(function ($x, $y) {
        return pow($x - $y, 2);
    }, $array1, $array2)));

    // Convert the distance to a similarity score (between 0 and 1)
    if ($distance == 0) {
        return 1;  // Identical arrays, maximum similarity
    }

    return 1 / (1 + $distance); 
    }

    public static function jaccard(array $p1Categories, array $p2Categories, string $separator = ','): float
    {
         // Normalize categories to lowercase and trim whitespace
    $p1Categories = array_map('trim', array_map('strtolower', $p1Categories));
    $p2Categories = array_map('trim', array_map('strtolower', $p2Categories));

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