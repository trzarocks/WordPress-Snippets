<?php
// Load WordPress
require_once('wp-load.php');

// Path to your CSV file
$csv_file = 'path/to/your/csv/file.csv';

// Open and read the CSV file
if (($handle = fopen($csv_file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        // Assuming your CSV has columns for name, slug, and any additional data
        $term_name = $data[0];
        $term_slug = $data[1];
        $additional_data = $data[2]; // Additional data from CSV
        
        // Check if term already exists
        if (!term_exists($term_name, 'your_taxonomy')) {
            // Term doesn't exist, so create it
            $term = wp_insert_term($term_name, 'your_taxonomy', array(
                'slug' => $term_slug,
                // Additional arguments for the term (if any)
            ));

            // Check if term creation was successful
            if (!is_wp_error($term)) {
                // Term created successfully
                // You can do additional processing here if needed
            } else {
                // Error occurred while creating term
                echo "Error creating term: " . $term->get_error_message();
            }
        } else {
            // Term already exists, you may want to handle this case differently
            echo "Term already exists: " . $term_name;
        }
    }
    fclose($handle);
}
?>
