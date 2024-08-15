<?php

namespace App\Services;

use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RecommendationService
{
    public function generateRecommendations()
    {
        $topSoldProducts = $this->getTopSoldProducts();
        $topAverageReviewProducts = $this->getTopAverageReviewProducts();

        $recommendedProducts = $topSoldProducts->merge($topAverageReviewProducts)->unique();

        return Product::whereIn('id', $recommendedProducts)->get();
    }

    private function getTopSoldProducts()
    {

        return OrderItem::select('product_id', DB::raw('COUNT(*) as count'))
            ->whereBetween('created_at', [now()->subDays(30), now()])
            ->groupBy('product_id')
            ->orderBy('count', 'desc')
            ->take(10)
            ->pluck('product_id');
    }

    private function getTopAverageReviewProducts()
    {
        return Review::select('product_id', DB::raw('AVG(ratings) as avg_rating'))
            ->whereBetween('created_at', [now()->subDays(30), now()])
            ->groupBy('product_id')
            ->orderBy('avg_rating', 'desc')
            ->take(10)
            ->pluck('product_id');
    }
}
