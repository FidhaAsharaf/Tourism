<?php
session_start();
include('includes/config.php');

if(isset($_GET['rating_id']) && is_numeric($_GET['rating_id'])) {
    $ratingId = $_GET['rating_id'];

    try {
        $sql = "DELETE FROM tblratings WHERE RatingId = :ratingid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':ratingid', $ratingId, PDO::PARAM_INT);
        $query->execute();

        if($query->rowCount() > 0) {
            $msg = "Review Deleted Successfully";
        } else {
            throw new Exception("Review not found or already deleted.");
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }

    // Redirect back to manage-reviews.php
    header('Location: manage-reviews.php');
    exit;
}
?>
