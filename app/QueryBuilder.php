<?php

namespace App;

class QueryBuilder
{
    public static function from($query)
    {
        $query = self::handleSort($query);
        return $query;
    }

    private static function handleSort($query)
    {
        if (empty(request('sort'))) {
            return $query;
        }

        $sortArgs = explode('|', request('sort'));
        $query->orderBy($sortArgs[0], $sortArgs[1]);
        return $query;
    }
}
