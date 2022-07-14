<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class UserBuilder extends Builder
{
    /**
     * Scope a query to filter users by given term
     *
     * @param  string  $term
     * @return void
     */
    public function search(string $term)
    {
        return $this->where('name', 'like', "%{$term}%")
            ->orWhere('email', 'like', "%{$term}%");
    }

    /**
     * Apply filters when nedded
     *
     * @param  array  $filters
     * @return void
     */
    public function filter(array $filters)
    {
        return $this->when($filters['search'] ?? null, function ($query, $term) {
            return $this->search($term);
        })->when($filters['type'] ?? null, function ($query, $type) {
            return match ($type) {
                default => $query
            };
        });
    }
}
