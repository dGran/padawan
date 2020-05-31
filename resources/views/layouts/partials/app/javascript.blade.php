<script type="text/javascript">
	function animateCSS_add(element, animationName, callback) {
	    const node = document.querySelector(element)
	    node.classList.add('animated', animationName)

	    function handleAnimationEnd() {
	        node.classList.remove('animated', animationName)
	        node.removeEventListener('animationend', handleAnimationEnd)

	        if (typeof callback === 'function') callback()
	    }

	    node.addEventListener('animationend', handleAnimationEnd)
	}

	function animateCSS_remove(element, animationName, callback) {
	    const node = document.querySelector(element)
	    node.classList.remove('animated', animationName)

	    function handleAnimationEnd() {
	        node.classList.remove('animated', animationName)
	        node.removeEventListener('animationend', handleAnimationEnd)

	        if (typeof callback === 'function') callback()
	    }

	    node.addEventListener('animationend', handleAnimationEnd)
	}
</script>