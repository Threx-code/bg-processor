<?php
// Database connection parameters
$host = 'localhost';
$db = 'cve_database';
$user = 'your_username';
$pass = 'your_password';
$charset = 'utf8mb4';

// Data Source Name (DSN)
$dsn = "pgsql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// Create a PDO instance
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Decode JSON data
$data = json_decode("[]", true);

// Insert cve_metadata data
$cve_metadata = $data['cveMetadata'];
$sql = "INSERT INTO cve_metadata (cveId, assignerOrgId, state, assignerShortName, dateReserved, datePublished, dateUpdated, title)
        VALUES (:cveId, :assignerOrgId, :state, :assignerShortName, :dateReserved, :datePublished, :dateUpdated, :title)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'cveId' => $cve_metadata['cveId'],
    'assignerOrgId' => $cve_metadata['assignerOrgId'],
    'state' => $cve_metadata['state'],
    'assignerShortName' => $cve_metadata['assignerShortName'],
    'dateReserved' => $cve_metadata['dateReserved'],
    'datePublished' => $cve_metadata['datePublished'],
    'dateUpdated' => $cve_metadata['dateUpdated'],
    'title' => $cve_metadata['cveId']
]);

// Insert affected_products, platforms, product_versions, version_changes
$affected_products = $data['containers']['cna']['affected'];
foreach ($affected_products as $product) {
    $sql = "INSERT INTO affected_products (cveId, product, vendor, defaultStatus)
            VALUES (:cveId, :product, :vendor, :defaultStatus) RETURNING id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'cveId' => $cve_metadata['cveId'],
        'product' => $product['product'],
        'vendor' => $product['vendor'],
        'defaultStatus' => $product['defaultStatus']
    ]);
    $affected_product_id = $stmt->fetchColumn();

    if (isset($product['platforms'])) {
        foreach ($product['platforms'] as $platform) {
            $sql = "INSERT INTO platforms (affected_product_id, platform) VALUES (:affected_product_id, :platform)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['affected_product_id' => $affected_product_id, 'platform' => $platform]);
        }
    }

    foreach ($product['versions'] as $version) {
        $sql = "INSERT INTO product_versions (affected_product_id, version, lessThan, status, versionType)
                VALUES (:affected_product_id, :version, :lessThan, :status, :versionType) RETURNING id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'affected_product_id' => $affected_product_id,
            'version' => $version['version'],
            'lessThan' => isset($version['lessThan']) ? $version['lessThan'] : null,
            'status' => $version['status'],
            'versionType' => isset($version['versionType']) ? $version['versionType'] : null
        ]);
        $product_version_id = $stmt->fetchColumn();

        if (isset($version['changes'])) {
            foreach ($version['changes'] as $change) {
                $sql = "INSERT INTO version_changes (product_version_id, at, status) VALUES (:product_version_id, :at, :status)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['product_version_id' => $product_version_id, 'at' => $change['at'], 'status' => $change['status']]);
            }
        }
    }
}

// Insert credits
$credits = $data['containers']['cna']['credits'];
foreach ($credits as $credit) {
    $sql = "INSERT INTO credits (cveId, lang, type, value) VALUES (:cveId, :lang, :type, :value)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'cveId' => $cve_metadata['cveId'],
        'lang' => $credit['lang'],
        'type' => $credit['type'],
        'value' => $credit['value']
    ]);
}

// Insert descriptions and supporting_media
$descriptions = $data['containers']['cna']['descriptions'];
foreach ($descriptions as $description) {
    $sql = "INSERT INTO descriptions (cveId, lang, value) VALUES (:cveId, :lang, :value) RETURNING id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'cveId' => $cve_metadata['cveId'],
        'lang' => $description['lang'],
        'value' => $description['value']
    ]);
    $description_id = $stmt->fetchColumn();

    if (isset($description['supportingMedia'])) {
        foreach ($description['supportingMedia'] as $media) {
            $sql = "INSERT INTO supporting_media (description_id, base64, type, value) VALUES (:description_id, :base64, :type, :value)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'description_id' => $description_id,
                'base64' => $media['base64'],
                'type' => $media['type'],
                'value' => $media['value']
            ]);
        }
    }
}

// Insert exploits and supporting_media
$exploits = $data['containers']['cna']['exploits'];
foreach ($exploits as $exploit) {
    $sql = "INSERT INTO exploits (cveId, lang, value) VALUES (:cveId, :lang, :value) RETURNING id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'cveId' => $cve_metadata['cveId'],
        'lang' => $exploit['lang'],
        'value' => $exploit['value']
    ]);
    $exploit_id = $stmt->fetchColumn();

    if (isset($exploit['supportingMedia'])) {
        foreach ($exploit['supportingMedia'] as $media) {
            $sql = "INSERT INTO supporting_media (description_id, base64, type, value) VALUES (:description_id, :base64, :type, :value)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'description_id' => $exploit_id,
                'base64' => $media['base64'],
                'type' => $media['type'],
                'value' => $media['value']
            ]);
        }
    }
}

// Insert metrics, cvss_v3_1, and scenarios
$metrics = $data['containers']['cna']['metrics'];
foreach ($metrics as $metric) {
    $sql = "INSERT INTO metrics (cveId, format) VALUES (:cveId, :format) RETURNING id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'cveId' => $cve_metadata['cveId'],
        'format' => $metric['format']
    ]);
    $metric_id = $stmt->fetchColumn();

    if (isset($metric['cvssV3_1'])) {
        $cvss = $metric['cvssV3_1'];
        $sql = "INSERT INTO cvss_v3_1 (metric_id, attackComplexity, attackVector, availabilityImpact, baseScore, baseSeverity, confidentialityImpact, integrityImpact, privilegesRequired, scope, userInteraction, vectorString, version)
                VALUES (:metric_id, :attackComplexity, :attackVector, :availabilityImpact, :baseScore, :baseSeverity, :confidentialityImpact, :integrityImpact, :privilegesRequired, :scope, :userInteraction, :vectorString, :version)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'metric_id' => $metric_id,
            'attackComplexity' => $cvss['attackComplexity'],
            'attackVector' => $cvss['attackVector'],
            'availabilityImpact' => $cvss['availabilityImpact'],
            'baseScore' => $cvss['baseScore'],
            'baseSeverity' => $cvss['baseSeverity'],
            'confidentialityImpact' => $cvss['confidentialityImpact'],
            'integrityImpact' => $cvss['integrityImpact'],
            'privilegesRequired' => $cvss['privilegesRequired'],
            'scope' => $cvss['scope'],
            'userInteraction' => $cvss['userInteraction'],
            'vectorString' => $cvss['vectorString'],
            'version' => $cvss['version']
        ]);
    }

    if (isset($metric['scenarios'])) {
        foreach ($metric['scenarios'] as $scenario) {
            $sql = "INSERT INTO scenarios (metric_id, lang, value) VALUES (:metric_id, :lang, :value)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'metric_id' => $metric_id,
                'lang' => $scenario['lang'],
                'value' => $scenario['value']
            ]);
        }
    }
}

// Insert problem_types and problem_type_descriptions
$problem_types = $data['containers']['cna']['problemTypes'];
foreach ($problem_types as $problem_type) {
    foreach ($problem_type['descriptions'] as $description) {
        $sql = "INSERT INTO problem_types (cveId, cweId, description, lang, type)
                VALUES (:cveId, :cweId, :description, :lang, :type)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'cveId' => $cve_metadata['cveId'],
            'cweId' => $description['cweId'],
            'description' => $description['description'],
            'lang' => $description['lang'],
            'type' => $description['type']
        ]);
    }
}

// Insert provider_metadata
$provider_metadata = $data['containers']['cna']['providerMetadata'];
$sql = "INSERT INTO provider_metadata (cveId, orgId, shortName, dateUpdated)
        VALUES (:cveId, :orgId, :shortName, :dateUpdated)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'cveId' => $cve_metadata['cveId'],
    'orgId' => $provider_metadata['orgId'],
    'shortName' => $provider_metadata['shortName'],
    'dateUpdated' => $provider_metadata['dateUpdated']
]);

// Insert references
$references = $data['containers']['cna']['references'];
foreach ($references as $reference) {
    $sql = "INSERT INTO references (cveId, url) VALUES (:cveId, :url)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['cveId' => $cve_metadata['cveId'], 'url' => $reference['url']]);
}

// Insert solutions and supporting_media
$solutions = $data['containers']['cna']['solutions'];
foreach ($solutions as $solution) {
    $sql = "INSERT INTO solutions (cveId, lang, value) VALUES (:cveId, :lang, :value) RETURNING id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'cveId' => $cve_metadata['cveId'],
        'lang' => $solution['lang'],
        'value' => $solution['value']
    ]);
    $solution_id = $stmt->fetchColumn();

    if (isset($solution['supportingMedia'])) {
        foreach ($solution['supportingMedia'] as $media) {
            $sql = "INSERT INTO supporting_media (description_id, base64, type, value) VALUES (:description_id, :base64, :type, :value)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'description_id' => $solution_id,
                'base64' => $media['base64'],
                'type' => $media['type'],
                'value' => $media['value']
            ]);
        }
    }
}

// Insert source
$source = $data['containers']['cna']['source'];
foreach ($source['defect'] as $defect) {
    $sql = "INSERT INTO source (cveId, defect, discovery) VALUES (:cveId, :defect, :discovery)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'cveId' => $cve_metadata['cveId'],
        'defect' => $defect,
        'discovery' => $source['discovery']
    ]);
}

// Insert timeline
$timeline = $data['containers']['cna']['timeline'];
foreach ($timeline as $event) {
    $sql = "INSERT INTO timeline (cveId, lang, time, value) VALUES (:cveId, :lang, :time, :value)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'cveId' => $cve_metadata['cveId'],
        'lang' => $event['lang'],
        'time' => $event['time'],
        'value' => $event['value']
    ]);
}

// Insert workarounds
$workarounds = $data['containers']['cna']['workarounds'];
foreach ($workarounds as $workaround) {
    $sql = "INSERT INTO workarounds (cveId, lang, value) VALUES (:cveId, :lang, :value)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'cveId' => $cve_metadata['cveId'],
        'lang' => $workaround['lang'],
        'value' => $workaround['value']
    ]);
}

// Insert x_generator
$x_generator = $data['containers']['cna']['x_generator'];
$sql = "INSERT INTO x_generator (cveId, engine) VALUES (:cveId, :engine)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'cveId' => $cve_metadata['cveId'],
    'engine' => $x_generator['engine']
]);

echo "Data inserted successfully!";

