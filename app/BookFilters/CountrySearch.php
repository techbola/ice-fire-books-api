<?php


namespace App\BookFilters;


class CountrySearch
{
    public function handle($request, \Closure $next)
    {
        if (!request()->has('country')){
            return $next($request);
        }

        $builder = $next($request);

        return $builder->where('country', request('country'));
    }
}