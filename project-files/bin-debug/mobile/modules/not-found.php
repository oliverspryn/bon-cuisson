<?php
//Fun!!! Pick a sad face to show!!!
	$random = rand(0, 2);
	$sadFaces = array("crying", "shocked", "surprised");
	$class = $sadFaces[$random];
?>

<section class="notFound <?php echo $class; ?>">
<h3>Sorry, nothing yummy here!</h3>
<p>We couldn't find the page you are looking for. Perhaps the link has expired or it was entered incorrectly.</p>
<a href="<?php echo ROOT; ?>" data-role="button">Go Home</a>
</section>