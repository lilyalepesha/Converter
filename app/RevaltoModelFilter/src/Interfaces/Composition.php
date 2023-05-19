<?php

namespace App\RevaltoModelFilter\src\Interfaces;

interface Composition
{
    const COMPOSITION_GREATER = '>';
    const COMPOSITION_GREATER_OR_EQUAL = '>=';

    const COMPOSITION_LESS = '<';
    const COMPOSITION_LESS_OR_EQUAL = '<';

    const COMPOSITION_EQUAL = '=';
    const COMPOSITION_NOT_EQUAL = '<>';

    const COMPOSITION_BETWEEN = 'BETWEEN';
    const COMPOSITION_LIKE = 'LIKE';
    const COMPOSITION_IN = 'IN';

    const ORDER_DESC = 'desc';
    const ORDER_ASC = 'asc';
}
