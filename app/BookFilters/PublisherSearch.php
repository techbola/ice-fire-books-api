<?php


namespace App\BookFilters;


class PublisherSearch
{
    public function handle($request, \Closure $next)
    {
        if (!request()->has('publisher')){
            return $next($request);
        }

        $builder = $next($request);

        return $builder->where('publisher', request('publisher'));
    }
}