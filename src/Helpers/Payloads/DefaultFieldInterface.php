<?php declare(strict_types=1);

namespace Domains\Helpers\Payloads;

interface DefaultFieldInterface
{
    const FIELD_DEFAULT_DATE = '1970-01-01T00:00:00Z';
    const FIELD_EMPTY_ARRAY = [];
    const FIELD_NULL = null;
    const FIELD_EMPTY_STRING = '';
}
