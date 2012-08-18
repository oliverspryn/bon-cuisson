<?php
//Fun!!! Pick a sad face to show!!!
	$random = rand(0, 2);
	$sadFaces = array("crying", "shocked", "surprised");
	$class = $sadFaces[$random];
?>
<h2>Not Found</h2>

<section class="notFound <?php echo $class; ?>">
<h3>Sorry, nothing yummy here!</h3>
<p>We couldn't find the page you are looking for. Perhaps the link has expired or it was entered incorrectly.</p>
<button class="goHome">Go Home</button>
</section>