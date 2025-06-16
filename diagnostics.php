<?php

// force-create-schema.php - Forcefully create tables

require_once 'config/bootstrap.php';

use Doctrine\ORM\Tools\SchemaTool;

try {
  $entityManager = require 'config/bootstrap.php';

  echo "Creating database schema...\n";

  // Get metadata for all entities
  $metadatas = $entityManager->getMetadataFactory()->getAllMetadata();

  if (empty($metadatas)) {
    echo "✗ No entities found!\n";
    exit(1);
  }

  // Create schema tool
  $schemaTool = new SchemaTool($entityManager);

  // Show what will be created
  $createSql = $schemaTool->getCreateSchemaSql($metadatas);
  echo "SQL that will be executed:\n";
  foreach ($createSql as $sql) {
    echo "  " . $sql . "\n";
  }

  // Ask for confirmation
  echo "\nProceed with creating tables? (y/N): ";
  $handle = fopen("php://stdin", "r");
  $line = fgets($handle);
  fclose($handle);

  if (trim(strtolower($line)) === 'y') {
    // Drop existing schema first (optional - be careful!)
    echo "Dropping existing schema...\n";
    $schemaTool->dropSchema($metadatas);

    // Create new schema
    echo "Creating new schema...\n";
    $schemaTool->createSchema($metadatas);

    echo "✓ Schema created successfully!\n";
  } else {
    echo "Cancelled.\n";
  }

} catch (\Exception $e) {
  echo "✗ Error: " . $e->getMessage() . "\n";
  echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}