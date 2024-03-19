<?php
include '../database.php';
if (isset($_POST['addpost'])) {
    $ptitle = mysqli_real_escape_string($conn, $_POST['post_title']);
    $pcontent = mysqli_real_escape_string($conn, $_POST['post_content']);
    $cid = $_POST['post_category']; 

    $query = "INSERT INTO post (title, post_description, category_id) VALUES (?, ?, ?)";

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "ssi", $ptitle, $pcontent, $cid);

        if (mysqli_stmt_execute($stmt)) {
            echo "Post added successfully.";
            $post_id = mysqli_insert_id($conn);

            if (isset($_FILES['image'])) {
                $images = $_FILES['image'];

                // Debugging: Print the $_FILES array
                print_r($_FILES);

                // Loop through uploaded files
                foreach ($images['name'] as $key => $name) {
                    // Check if a file was uploaded successfully
                    if ($images['error'][$key] == UPLOAD_ERR_OK) {
                        // File details
                        $tmp_name = $images['tmp_name'][$key];
                        $size = $images['size'][$key];
                
                        // Process the file
                        $destination = 'path/to/upload/directory' . $name;
                        $destination = '../images' . $name;

                        if (move_uploaded_file($tmp_name, $destination)) {
                            // Insert file details into database
                            $insert_query = "INSERT INTO image (post_id, image_name) VALUES (?, ?)";
                            if ($insert_stmt = mysqli_prepare($conn, $insert_query)) {
                                mysqli_stmt_bind_param($insert_stmt, "is", $post_id, $name);
                                if (mysqli_stmt_execute($insert_stmt)) {
                                    echo "Image added successfully.";
                                } else {
                                    echo "Error inserting image into database: " . mysqli_error($conn);
                                }
                                mysqli_stmt_close($insert_stmt);
                            } else {
                                echo "Error preparing image insertion statement: " . mysqli_error($conn);
                            }
                        } else {
                            echo "Error moving uploaded file: " . $name;
                        }
                    } else {
                        echo "File upload error: " . $images['error'][$key];
                    }
                }
                
            } else {
                echo "No images uploaded.";
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
header('Location:../admin/index.php');

?>
