//Called by the Flex project to resize the <object> container
	function setSize(size) {
		$('object#Main').css({
			'height' : size + 'px',
			'minHeight' : '100%'
		});
	}