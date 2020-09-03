<?php


namespace App\BookFilters;


class NameSearch
{
    public function handle($request, \Closure $next)
    {
        if (!request()->has('name')){
            return $next($request);
        }

        $builder = $next($request);

        return $builder->where('name', request('name'));
    }
}