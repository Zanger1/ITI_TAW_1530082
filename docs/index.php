<!DOCTYPE html>
<html lang="en">
<head>
	<title>Blog Post - Start Bootstrap Template</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Bootstrap core CSS -->
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">-->
	<link rel="stylesheet" href="vendor/font-awesome/5.9.0/css/all.css">

	<!-- Custom styles for this template -->
	<link href="css/docs-page.css" rel="stylesheet">

	<!-- JsTree -->
	<link href="vendor/jstree/style.min.css" rel="stylesheet">
	<style>
		li.jstree-open > a .jstree-icon { background:url("vendor/icons/package_24.png") 0px 0px no-repeat !important; }
		li.jstree-closed > a .jstree-icon { background:url("vendor/icons/package_24.png") 0px 0px no-repeat !important; }
		li.jstree-leaf > a .jstree-icon { background:url("vendor/icons/php_24.png") 0px 0px no-repeat !important; }
	</style>

	<!-- SyntaxHihglighter -->
	<script type="text/javascript" src="vendor/SyntaxHihglighter/scripts/shCore.js"></script>
	<script type="text/javascript" src="vendor/SyntaxHihglighter/scripts/shBrushBash.js"></script>
	<script type="text/javascript" src="vendor/SyntaxHihglighter/scripts/shBrushCpp.js"></script>
	<script type="text/javascript" src="vendor/SyntaxHihglighter/scripts/shBrushCSharp.js"></script>
	<script type="text/javascript" src="vendor/SyntaxHihglighter/scripts/shBrushCss.js"></script>
	<script type="text/javascript" src="vendor/SyntaxHihglighter/scripts/shBrushDelphi.js"></script>
	<script type="text/javascript" src="vendor/SyntaxHihglighter/scripts/shBrushDiff.js"></script>
	<script type="text/javascript" src="vendor/SyntaxHihglighter/scripts/shBrushGroovy.js"></script>
	<script type="text/javascript" src="vendor/SyntaxHihglighter/scripts/shBrushJava.js"></script>
	<script type="text/javascript" src="vendor/SyntaxHihglighter/scripts/shBrushJScript.js"></script>
	<script type="text/javascript" src="vendor/SyntaxHihglighter/scripts/shBrushPhp.js"></script>
	<script type="text/javascript" src="vendor/SyntaxHihglighter/scripts/shBrushPlain.js"></script>
	<script type="text/javascript" src="vendor/SyntaxHihglighter/scripts/shBrushPython.js"></script>
	<script type="text/javascript" src="vendor/SyntaxHihglighter/scripts/shBrushRuby.js"></script>
	<script type="text/javascript" src="vendor/SyntaxHihglighter/scripts/shBrushScala.js"></script>
	<script type="text/javascript" src="vendor/SyntaxHihglighter/scripts/shBrushSql.js"></script>
	<script type="text/javascript" src="vendor/SyntaxHihglighter/scripts/shBrushVb.js"></script>
	<script type="text/javascript" src="vendor/SyntaxHihglighter/scripts/shBrushXml.js"></script>
	<link type="text/css" rel="stylesheet" href="vendor/SyntaxHihglighter/styles/shCore.css"/>
	<link type="text/css" rel="stylesheet" href="vendor/SyntaxHihglighter/styles/shThemeDefault.css"/>
	<script type="text/javascript">
		SyntaxHighlighter.config.clipboardSwf = 'scripts/clipboard.swf';
		SyntaxHighlighter.all();
	</script>

</head>

<body>

	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
		<div class="container">
			<a class="navbar-brand" href="#">Start Bootstrap</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active"><a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a></li>
					<li class="nav-item"><a class="nav-link" href="#">About</a></li>
					<li class="nav-item"><a class="nav-link" href="#">Services</a></li>
					<li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
				</ul>
			</div>
		</div>
	</nav>
	
	<!-- Page Content -->
	<div class="container">
		<div class="row">

			<!-- Sidebar Widgets Column -->
			<div class="col-md-4">
			
				<div class="sticky-top">
				
					<!-- Search Widget -->
					<div class="card my-4">
						<h5 class="card-header">Buscar</h5>
						<div class="card-body">
							<div class="input-group">
								<input type="text" size="30" onkeyup="showResult(this.value)" class="form-control" placeholder="Por nombre de clase...">
								<div id="livesearch" style="margin-top:10px; display:block; width: 100%; background:white;"></div>
								<!--<span class="input-group-btn"><button class="btn btn-secondary" type="button">Go!</button></span>-->
							</div>
						</div>
					</div>
					
					<!-- Categories Widget 
					<div class="card my-4">
						<h5 class="card-header">Categories</h5>
						<div class="card-body">
							<div class="row">
								<div class="col-lg-6">
									<ul class="list-unstyled mb-0">
										<li><a href="#">Web Design</a></li>
										<li><a href="#">HTML</a></li>
										<li><a href="#">Freebies</a></li>
									</ul>
								</div>
								<div class="col-lg-6">
									<ul class="list-unstyled mb-0">
										<li><a href="#">JavaScript</a></li>
										<li><a href="#">CSS</a></li>
										<li><a href="#">Tutorials</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div> -->
					
					<!-- Side Widget -->
					<div class="card my-4">
						<h5 class="card-header">Packages</h5>
						<div class="card-body">
							<div id="tree-container"><p style="height:500px;">&nbsp;</p></div>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Post Content Column -->
			<div class="col-lg-8">

				<?php
				if(isset($_GET["path"]) && isset($_GET["file"])){
					if(is_file($_GET["path"])){
					$ClassName = preg_replace('/\\.[^.\\s]{3,4}$/', '', $_GET["file"]);
				?>
						<!-- Title -->
						<h1 class="mt-4">Class <span style="color: purple;"><?php echo $ClassName ?></span></h1>
						
						<!-- Date/Time -->
						<p><b>Last modified: </b><?php echo  date ("F d Y H:i:s", filemtime($_GET["path"])); ?> <i class="fa fa-clock"></i></p><hr>
				<?php
						$file = file_get_contents($_GET["path"]);
						echo $file;
				
					}
				}
				?>
		
				<hr>
			</div>
			
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container -->


	<!-- Footer -->
	<footer class="py-5 bg-dark">
		<div class="container">
			<p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
		</div>
	<!-- /.container -->
	</footer>

	<!-- ... -->
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="vendor/jstree/jstree.min.js"></script>
	<script>
	$('#tree-container').jstree({
		'core' : {                  
			'data' : {
				'type' : "POST",
				'url' : 'sitemap.html',
				'data' : function (node) {
					return { 'id' : node["id"]};
				}
			},
			'dataType' : 'json'
		},
		'plugins' : ['state','contextmenu','wholerow','search']
	}).on("activate_node.jstree", function (e, data) {
		if(data.node) {
			var href = data.node.a_attr.href;
			window.location.href = href;
		}
	}); 

	function showResult(str) {
		if (str.length==0) {
			document.getElementById("livesearch").innerHTML="";
			document.getElementById("livesearch").style.border="0px";
			return;
		}
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		} else {  // code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function() {
			if (this.readyState==4 && this.status==200) {
				document.getElementById("livesearch").innerHTML=this.responseText;
				document.getElementById("livesearch").style.border="1px solid #A5ACB2";
			}
		}
		xmlhttp.open("GET","search.php?q="+str,true);
		xmlhttp.send();
	}
	</script>
</body>
</html>