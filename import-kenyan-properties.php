<?php
// Import Kenyan Properties from BuyRentKenya data
require_once 'config/database.php';

$pdo = getDBConnection();

try {
    // Read the SQL file
    $sql = file_get_contents('database/kenyan_properties_seed.sql');
    
    // Split the SQL into individual statements
    $statements = explode(';', $sql);
    
    $successCount = 0;
    $errorCount = 0;
    
    foreach ($statements as $statement) {
        $statement = trim($statement);
        if (empty($statement)) {
            continue;
        }
        
        try {
            $pdo->exec($statement);
            $successCount++;
        } catch (PDOException $e) {
            $errorCount++;
            echo "Error executing statement: " . $e->getMessage() . "\n";
            echo "Statement: " . substr($statement, 0, 100) . "...\n\n";
        }
    }
    
    echo "Import completed!\n";
    echo "Successful statements: $successCount\n";
    echo "Failed statements: $errorCount\n";
    
    // Verify the import
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM properties");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Total properties in database: " . $result['count'] . "\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
