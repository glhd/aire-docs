<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="x-ua-compatible" content="ie=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	
	<title>
		@yield('page-title') - Aire (Laravel Form Builder)
	</title>
	
	<link rel="stylesheet" href="{{ asset('aire.css') }}?v={{ $css_version }}" />
	
	<link rel="stylesheet"
	      href="https://use.fontawesome.com/releases/v5.12.1/css/solid.css"
	      crossorigin="anonymous" />
	<link rel="stylesheet"
	      href="https://use.fontawesome.com/releases/v5.12.1/css/brands.css"
	      crossorigin="anonymous" />
	<link rel="stylesheet"
	      href="https://use.fontawesome.com/releases/v5.12.1/css/fontawesome.css"
	      crossorigin="anonymous" />
	<link rel="stylesheet" 
	      href="https://cdn.jsdelivr.net/npm/@docsearch/css@alpha"
	      crossorigin="anonymous" />
	
	@stack('head')
</head>

<body class="font-sans font-base leading-normal antialiased">

<div class="container mx-auto p-8">
	<div class="lg:hidden flex justify-between items-center mb-8">
		@include('_logo')
		<a class="bg-salmon p-4 text-white rounded-lg" href="#navigation">
			<i class="fas fa-fw fa-bars mr-2"></i>
			Menu
		</a>
	</div>
	<div class="lg:flex lg:flex-row-reverse">
		<div class="flex-auto lg:max-w-4/5">
			<div class="docs-content border-gray-300 text-gray-900 lg:ml-8 lg:pl-8 lg:border-l">
				@yield('content')
			</div>
		</div>
		<div id="navigation" class="flex-shrink-0 lg:max-w-1/5">
			@include('_sidebar')
		</div>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.15.0/prism.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.15.0/components/prism-markup.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.15.0/components/prism-markup-templating.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.15.0/components/prism-clike.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.15.0/components/prism-php.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.15.0/components/prism-php-extras.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.15.0/components/prism-javascript.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@docsearch/js@alpha"></script>
<script type="text/javascript">
docsearch({
	appId: 'BH4D9OD16A',
	apiKey: 'dba0799640cd22acaf60360ce3c39eac',
	indexName: 'airephp',
	container: '#docsearch',
	debug: false, 
});
</script>

<script>
(function(f, a, t, h, o, m){
	a[h]=a[h]||function(){
		(a[h].q=a[h].q||[]).push(arguments)
	};
	o=f.createElement('script'),
		m=f.getElementsByTagName('script')[0];
	o.async=1; o.src=t; o.id='fathom-script';
	m.parentNode.insertBefore(o,m)
})(document, window, 'https://cdn.usefathom.com/tracker.js', 'fathom');
fathom('set', 'siteId', 'CFRXAHNE');
fathom('trackPageview');
</script>

</body>

</html>
