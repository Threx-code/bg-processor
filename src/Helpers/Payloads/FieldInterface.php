<?php

declare(strict_types=1);

namespace Domains\Helpers\Payloads;

interface FieldInterface
{
    const FIELD_CVE_ID = 'cveId';

    const FIELD_TITLE = 'title';

    const FIELD_STATE = 'state';

    const FIELD_ASSIGNER_SHORT_NAME = 'assignerShortName';

    const FIELD_DATE_RESERVED = 'dateReserved';

    const FIELD_DATE_PUBLISHED = 'datePublished';

    const FIELD_DATE_UPDATED = 'dateUpdated';
    const FIELD_COMMIT_DATE = 'commitDate';
}
