<?php

declare(strict_types=1);

namespace Domains\Helpers\Payloads;

interface FieldInterface
{
    const FIELD_ID = 'id';
    const FIELD_KEY = 'key';
    const FIELD_CVE_ID = 'cveId';
    const FIELD_ADP_ID = 'adpId';
    const FIELD_ORG_ID = 'orgId';
    const ASSIGNER_ORD_ID = 'assignerOrgId';
    const FIELD_PROBLEM_TYPE_ID = 'problemTypeId';
    const FIELD_DESCRIPTION_ID = 'descriptionId';
    const FIELD_AFFECTED_PRODUCT_ID = 'affectedProductId';
    const FIELD_PRODUCT_VERSION_ID = 'productVersionId';
    const FIELD_TITLE = 'title';
    const FIELD_STATE = 'state';
    const FIELD_ASSIGNER_SHORT_NAME = 'assignerShortName';
    const FIELD_DATE_RESERVED = 'dateReserved';
    const FIELD_DATE_PUBLISHED = 'datePublished';
    const FIELD_DATE_UPDATED = 'dateUpdated';
    const FIELD_COMMIT_DATE = 'commitDate';
    const FIELD_FIELD_NAME = 'fileName';
    const FIELD_YEAR = 'year';
    const FIELD_TYPE = 'type';
    const FIELD_CONTENT_ID = 'contentId';
    const FIELD_SOLUTION_ID = 'solutionId';
    const FIELD_WORKAROUND_ID = 'workaroundId';
    const FIELD_ROLE = 'role';
    const FIELD_EXPLOITATION = 'exploitation';
    const FIELD_DATE = 'date';
    const FIELD_AUTOMATABLE = 'automatable';
    const FIELD_TECHNICAL_IMPACT = 'technicalImpact';
    const FIELD_DEFAULT_STATUS = 'defaultStatus';
    const FIELD_LESS_THAN = 'lessThan';
    const FIELD_STATUS = 'status';
    const FIELD_VERSION_TYPE = 'versionType';
    const FIELD_AT = 'at';
    const FIELD_LANG = 'lang';
    const FIELD_VALUE = 'value';
    const FIELD_BASE64 = 'base64';
    const FIELD_FORMAT = 'format';
    const FIELD_METRIC_ID = 'metricId';
    const FIELD_ATTACK_COMPLEXITY = 'attackComplexity';
    const FIELD_ATTACK_VECTOR = 'attackVector';
    const FIELD_AVAILABILITY_IMPACT = 'availabilityImpact';
    const FIELD_BASE_SCORE = 'baseScore';
    const FIELD_BASE_SEVERITY = 'baseSeverity';
    const FIELD_CONFIDENTIALITY_IMPACT = 'confidentialityImpact';
    const FIELD_INTEGRITY_IMPACT = 'integrityImpact';
    const FIELD_PRIVILEGES_REQUIRED = 'privilegesRequired';
    const FIELD_SCOPE = 'scope';
    const FIELD_USER_INTERACTION = 'userInteraction';
    const FIELD_VECTOR_STRING = 'vectorString';
    const FIELD_DESCRIPTION = 'description';
    const FIELD_URL = 'url';
    const FIELD_DEFECT = 'defect';
    const FIELD_DISCOVERY = 'discovery';
    const FIELD_TIME = 'time';
    const FIELD_ENGINE = 'engine';
    const FIELD_SHORT_NAME = 'shortName';
    const FIELD_CWE_ID = 'cweId';

    const FIELD_NULL = null;
    const FIELD_AFFECTED_PRODUCT = 'affectedProduct';
    const FIELD_CVE_META_DATA = 'cveMetadata';
    const FIELD_CONTAINERS = 'containers';
    const FIELD_CNA = 'cna';
    const FIELD_AFFECTED = 'affected';
    const FIELD_CVE = 'cve';
    const FIELD_PLATFORM = 'platform';
    const FIELD_PLATFORMS = 'platforms';
    const FIELD_VERSION = 'version';
    const FIELD_VERSIONS = 'versions';
    const FIELD_PRODUCT = 'product';
    const FIELD_PRODUCTS = 'products';
    const FIELD_VENDOR = 'vendor';
    const FIELD_CHANGES = 'changes';
    const FIELD_PRODUCT_VERSION = 'productVersion';
    const CVE_REJECTED = 'REJECTED';

}
