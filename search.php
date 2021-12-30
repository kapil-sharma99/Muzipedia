<?php 

include("includes/includedFiles.php");

if(isset($_GET['term'])){
  $term = urldecode($_GET['term']);
} else {
  $term = "";
}

?>

<div class="searchContainer">
  <h4>Search For an Artist, Album or Song</h4>
  <input type="text" class="searchInput" value="<?php echo $term; ?>" onfocus="this.value = this.value" placeholder="Start Typing...">
</div>

<script>
  $(".searchInput").focus();
  $(function() {
    var timer;
    $(".searchInput").keyup(function() {
      clearTimeout(timer);
      timer = setTimeout(function() {
        var val = $(".searchInput").val();
        openPage("search.php?term=" + val);
      }, 2000);
    })
  })
</script>