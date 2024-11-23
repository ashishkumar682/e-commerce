<?php
if (isset($_POST['submit'])) {
    include 'Config.php'; // Include your database connection file

    // Get product details from the form
    $product_name = $_POST['Pname'];
    $product_price = $_POST['Pprice'];
    $product_category = $_POST['Pages'];
    $product_image = $_FILES['Pimage'];

    // Handle image upload
    $image_loc = $_FILES['Pimage']['tmp_name'];
    $image_name = $_FILES['Pimage']['name'];
    
    // Sanitize the image file name to prevent issues with spaces or special characters
    $image_name = preg_replace('/[^a-zA-Z0-9\-_\.]/', '_', $image_name);
    $img_des = "Uploadimage/" . $image_name; // Correct folder name (Uploadimage)

    // Ensure the target directory exists
    if (!is_dir('Uploadimage')) {
        mkdir('Uploadimage', 0755, true); // Create the directory with appropriate permissions if it doesn't exist
    }

    // Move uploaded image to the desired folder
    if (move_uploaded_file($image_loc, $img_des)) {
        // Insert product details into the database
        $sql = "INSERT INTO tblproduct (PName, PPrice, PImage, PCategory) 
                VALUES ('$product_name', '$product_price', '$img_des', '$product_category')";

        // Execute query and check if it was successful
        if (mysqli_query($con, $sql)) {
            echo "<script>
                    alert('Product added successfully.');
                    window.location.href = 'index.php'; // Redirect to the main page
                  </script>";
        } else {
            echo "<script>
                    alert('Error: Could not add the product.');
                  </script>";
        }
    } else {
        echo "<script>
                alert('Error uploading the image.');
              </script>";
    }
}
?>
