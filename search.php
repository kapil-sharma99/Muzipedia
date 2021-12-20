<?php 

include("includes/includedFiles.php");

if(isset($_GET['term'])){
  $term = urldecode($_GET['term']);
} else {
  $term = "";
}

?>

<div class="searchContainer">
  <h4>Search For an Artist, album or Song</h4>
  <input type="text" class="searchInput" value="<?php echo $term; ?>" placeholder="Start Typing...">
</div>