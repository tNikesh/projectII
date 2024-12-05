<?php declare(strict_types=1);

namespace App;

use Exception;

class ProductSimilarity
{
    protected $products;
    protected $discountWeight  = 1;
    protected $priceWeight    = 1;
    protected $categoryWeight = 1;
    protected $priceHighRange;

    public function __construct($products)
    {
        $this->products = $products;
        $this->priceHighRange = $products->pluck('base_price')->max();
    }

    public function setDiscountWeight(float $weight): void
    {
        $this->discountWeight = $weight;
    }

    public function setPriceWeight(float $weight): void
    {
        $this->priceWeight = $weight;
    }

    public function setCategoryWeight(float $weight): void
    {
        $this->categoryWeight = $weight;
    }

    public function calculateSimilarityMatrix(): array
    {
        $matrix = [];

        foreach ($this->products as $product) {
            $similarityScores = [];

            foreach ($this->products as $_product) {
                if ($product->id === $_product->id) {
                    continue;
                }
                $similarityScores['product_id_' . $_product->id] = $this->calculateSimilarityScore($product, $_product);
            }
            $matrix['product_id_' . $product->id] = $similarityScores;
        }
        return $matrix;
    }

    public function getProductsSortedBySimularity(int $productId, array $matrix): array
    {
        $similarities = $matrix['product_id_' . $productId] ?? null;
        $sortedProducts = [];
        $threshold = 0.5; // Example threshold for similarity
        $limit = 5; // Example limit for number of products
        arsort($similarities);

        foreach ($similarities as $productIdKey => $similarity) {
            if ($similarity < $threshold) {
                continue; // Skip products below the threshold
            }
    
            $id = intval(str_replace('product_id_', '', $productIdKey));
            $product = collect($this->products)->firstWhere('id', $id);
    
            if ($product) {
                $product->similarity = $similarity; // Optionally store similarity score in the product object
                $sortedProducts[] = $product;
            }
    
            // Break the loop if we have reached the limit
            if (count($sortedProducts) >= $limit) {
                break;
            }
        }
        return $sortedProducts;
    }

    protected function calculateSimilarityScore($productA, $productB)
    {
        // Ensure categories are non-null and convert to string (or handle as needed)
        $productACategories = $productA->category->pluck('id')->toArray(); // Assuming category_id is a single ID
        $productBCategories = $productB->category->pluck('id')->toArray();
        // Handle potential null or missing discount values
        $productADiscount = $productA->discount ?? 0; // Default to 0 if discount is null
        $productBDiscount = $productB->discount ?? 0; // Default to 0 if discount is null

        $normalizedPriceA = Similarity::minMaxNorm([$productA->base_price], 0, $this->priceHighRange);
        $normalizedPriceB = Similarity::minMaxNorm([$productB->base_price], 0, $this->priceHighRange);
        return array_sum([
            (Similarity::euclidean($normalizedPriceA, $normalizedPriceB) * $this->priceWeight),
    
            // Category similarity using Jaccard index
            (Similarity::jaccard($productACategories, $productBCategories) * $this->categoryWeight),
    
            // Discount similarity using Euclidean distance
            (Similarity::euclidean([$productADiscount], [$productBDiscount]) * $this->discountWeight)
        ]) / ($this->priceWeight + $this->categoryWeight + $this->discountWeight);
    }
    
}
