<?php
require_once "../Models/Product.php";

// Initialize the Product model
$product = new Product();
$id = $_REQUEST['id'];

// Get the product row by ID
$row = $product->getRow($id);

// Prepare the data for updating the product
$data = [
    'status' => $row['status'] == 1 ? 2 : 1, // Toggle status between 1 (active) and 2 (inactive)
    'updated_at' => date('Y-m-d H:i:s'), // Correct date format
    'updated_by' => 1, // Assuming '1' is the admin user ID
];

// Update the product with the new data
$product->update($data, $id);
if ($product->update($data, $id)) {
    header("Location: index.php?option=product&cat=index");
} else {
    echo "Failed to update status";
    header("Location: index.php?option=product&cat=index");
}
// Redirect to the product list page
// header("Location: index.php?option=product&cat=index");
// exit; // Ensure the script stops after the redirect
