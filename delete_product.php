<?php
// Include the database configuration file
include 'Config.php';

// Check if the delete button was clicked
if (isset($_POST['delete_btn'])) {
    $product_id = $_POST['product_id'];

    // Prepare the delete query
    $delete_query = "DELETE FROM tblproduct WHERE id = '$product_id'";

    // Execute the delete query
    if (mysqli_query($con, $delete_query)) {
        // If deletion is successful, redirect to the main page or show success message
        echo "<script>
                alert('Product deleted successfully.');
                window.location.href = 'index.php'; // Redirect to your main page after deletion
              </script>";
    } else {
        
        echo "<script>
                alert('Error deleting product.');
                window.location.href = 'your_main_page.php'; // Redirect back if deletion fails
              </script>";
    }
}
?>
