<!DOCTYPE html>
<html>
	<head>
		<title>Oorden prueba</title>
			<?php echo $this->tag->stylesheetLink('css/bootstrap.min.css'); ?>
			<?php echo $this->assets->outputCss(); ?>		
			
	</head>
	<body>
		
				<?php echo $this->getContent(); ?>

			<?php echo $this->tag->javascriptInclude('js/jquery-1.10.2.min.js'); ?>
			<?php echo $this->tag->javascriptInclude('js/bootstrap.min.js'); ?>
			<?php echo $this->tag->javascriptInclude('js/bootswatch.js'); ?>
			

			<?php echo $this->assets->outputJs(); ?>

	</body>
</html>