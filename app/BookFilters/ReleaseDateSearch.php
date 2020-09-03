<?php


namespace App\BookFilters;


class ReleaseDateSearch
{
    public function handle($request, \Closure $next)
    {
        if (!request()->has('release_date')){
            return $next($request);
        }

        $builder = $next($request);

        return $builder->where('release_date', 'LIKE', request('release_date').'%');
    }
}