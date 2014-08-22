<!DOCTYPE html>

<html lang="en">
<head>
	
	<meta charset="utf-8" />

	<?php 
	foreach($css_files as $file): ?>
		<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
	<?php endforeach; ?>
	<?php foreach($js_files as $file): ?>
		<script src="<?php echo $file; ?>"></script>
	<?php endforeach; ?>
	
	<link href="/assets/grocery_crud/css/style.css" type="text/css" rel="stylesheet" />
	<link href="/assets/grocery_crud/css/rtl.css" type="text/css" rel="stylesheet" />
	
	<script src="/js/general.js"></script>

</head>
<body>

	<div style='height:20px;'></div>  
    <div>
		<?php echo $output; ?>
    </div>
</body>
</html>
