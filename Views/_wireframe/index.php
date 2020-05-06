<!DOCTYPE html>
<html>
<head>
  <title>Sanitam</title>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/vnd.microsoft.icon" href="../themes/lte/assets/dist/img/sanitam-icon.ico">
  <!-- Font Awesome -->
<!--  <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">-->
  <link rel="stylesheet" href="../themes/lte/assets/plugins/font-awesome/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../themes/lte/assets/dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../themes/lte/assets/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../themes/lte/assets/plugins/morris/morris.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../themes/lte/assets/plugins/datatables/dataTables.bootstrap4.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../themes/lte/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../themes/lte/assets/plugins/select2/select2.min.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../themes/lte/assets/plugins/datepicker/datepicker3.css">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="../themes/lte/assets/plugins/fullcalendar/fullcalendar.min.css">
  <link rel="stylesheet" href="../themes/lte/assets/plugins/fullcalendar/fullcalendar.print.css" media="print">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../themes/lte/assets/plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../themes/lte/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- AJAX live search -->
	<script>
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
		  xmlhttp.open("GET","Controllers/functions/ajax/livesearch.php?q="+str,true);
		  xmlhttp.send();
		}
	</script>
	
  <!-- SweetAlert 2 -->
  <link rel="stylesheet" type="text/css" href="../themes/lte/assets/plugins/SweetAlert2/dist/sweetalert2.min.css">
  	
  <!-- Custom Uploader -->
  <link rel="stylesheet" type="text/css" href="../themes/lte/assets/plugins/uploader/style.css">

  <!-- Custom Font-face -->
  <link rel="stylesheet" type="text/css" href="../themes/lte/assets/dist/font/font-face.css">

  <!-- Wizard -->
  <link rel="stylesheet" type="text/css" href="../themes/lte/assets/plugins/SmartWizard/dist/css/smart_wizard.min.css">
  <link rel="stylesheet" type="text/css" href="../themes/lte/assets/plugins/SmartWizard/dist/css/smart_wizard_theme_arrows.css">

  <!-- Inicializacion de plugins (PERSONALIZADO), me ahorro 300 lineas -->
  <link rel="stylesheet" type="text/css" href="../themes/lte/assets/custom_init.css">
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <!-- bg-white ... #343a40; -->
  <nav class="main-header navbar navbar-expand navbar-light border-bottom" style="background:#77cc33">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Inicio</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <!--<form  style="width:100%;" autocomplete="off">	<!--class="form-inline ml-3"-->
      <!--div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" onkeyup="showResult(this.value)" placeholder="Buscar..." name="q" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
	  <div id="livesearch"></div>
    </form>-->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
	
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu  dropdown-menu-right" style="width:400px !important;"><!-- dropdown-menu-lg -->
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-cubes mr-2"></i> El inventario se esta agotando
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-shipping-fast mr-2"></i> Recuerda recoger una renta
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>

      <!-- Notifications Dropdown Menu -->
	  <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
			<div class="image">
				<img src="../themes/lte/assets/dist/img/default-profile.png" class="img-circle elevation-2" width="28" alt="User Image">
			</div>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href="Controllers/functions/ChangeTheme.php?choice=altair" class="dropdown-item">
            <i class="fa fa-sign-out mr-2"></i> Cambiar de tema (a Altair)
          </a>
          <a href="Controllers/functions/ChangeTheme.php?choice=elisyam" class="dropdown-item">
            <i class="fa fa-sign-out mr-2"></i> Cambiar de tema (a Elisyam)
          </a>
          <a href="index.php?view=Session&action=sign_out" class="dropdown-item">
            <i class="fa fa-sign-out mr-2"></i> Salir
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background:#686767;">
    <!-- Brand Logo -->
	
    <a href="./" class="brand-link" style="background:686767;">
		   <div id="custom-brand-logo" style="background-image:url('../themes/lte/assets/dist/img/logo_0.png');
	background-repeat:no-repeat;
	background-size:contain;
	background-position:center; height:100px; margin-top: -10px; margin-bottom: -40px;">&nbsp;</div>
		   
      <span class="brand-text font-weight-light">&nbsp;</span>
    </a>

	<style>.main-sidebar { background-color: #1e1e1e !important }.</style>
    <!-- Sidebar -->
    <div class="sidebar">
    
	  
      <!-- Sidebar Menu -->
     <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="?view=inventario&action=index" class="nav-link">
              <i class="nav-icon fa fa-tachometer-alt"></i>
              <p>
                Inicio
              </p>
            </a>
          </li>
		  <!-- Usuarios -->
          <li class="nav-item has-treeview">
            <a href="?view=usuarios&action=index" class="nav-link">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Usuarios
               <!-- <i class="right fa fa-angle-left"></i>-->
              </p>
            </a>
		   </li>
		   
		   <!--Empleados-->
          <li class="nav-item has-treeview">
            <a href="?view=empleados&action=index" class="nav-link">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Empleados
              </p>
            </a>
		   </li>
          <li class="nav-item has-treeview">
            <a href="?view=clientes&action=index" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Clientes
              </p>
            </a>
		   </li>
          <li class="nav-item has-treeview">
            <a href="?view=inventario&action=index" class="nav-link">
			<i class="nav-icon fa fa-cubes"></i>
			<p>
			Inventario
			</p>
			</a>
		  </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-file-invoice-dollar"></i>
              <p>
                Cotizaciones
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?view=cotizaciones&action=rentas" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Rentas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?view=cotizaciones&action=servicios" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Servicios</p>
                </a>
              </li>
			</ul>
		   </li>
		   <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-clipboard-list"></i>
              <p>
                Nomina (pendiente)
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?view=Promociones&action=show" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Ver</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?view=Promociones&action=register" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Agregar</p>
                </a>
              </li>
			</ul>
		   </li>
		   <li class="nav-item has-treeview">
            <a href="?view=caja-chica&action=index" class="nav-link">
              <i class="nav-icon fa fa-toolbox"></i>
              <p>
                Caja chica
              </p>
            </a>
		   </li>
		   <li class="nav-item has-treeview">
		   <a href="#" class="nav-link">
              <i class="nav-icon fa fa-map-marker-alt"></i>
              <p>
                Rutas (pendiente)
              </p>
            </a>
		   </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <!--<div class="col-sm-6">
            <h1>Data Tables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Tables</li>
            </ol>
          </div> -->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">

		<?php
		if(isset($_GET["view"]) && isset($_GET["action"])){
			include($_GET["view"].'/'.$_GET["action"].'.html');
		} else { include('index.html'); } ?>
		
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.0-alpha
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../themes/lte/assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!--<script>
  $.widget.bridge('uibutton', $.ui.button)
</script> -->
<!-- Bootstrap 4 -->
<script src="../themes/lte/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="../themes/lte/assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="../themes/lte/assets/plugins/datatables/1.10.19/jquery.dataTables.min.js"></script><!-- v 1.10.19 -->
<script src="../themes/lte/assets/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- page script -->
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<!-- <script src="assets/plugins/morris/morris.min.js"></script> De momento no ocupp graficas -->
<!-- Sparkline -->
<script src="../themes/lte/assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../themes/lte/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../themes/lte/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="../themes/lte/assets/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="../themes/lte/assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../themes/lte/assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../themes/lte/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="../themes/lte/assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../themes/lte/assets/plugins/fastclick/fastclick.js"></script>
<!-- Select2 -->
<script src="../themes/lte/assets/plugins/select2/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="../themes/lte/assets/dist/js/adminlte.js"></script>
<!-- Custom Uploader -->
<script src="../themes/lte/assets/plugins/uploader/script.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) --
<script src="assets/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes --
<script src="assets/dist/js/demo.js"></script> [No se ocupan]	-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>

<!-- SweetAlert 2 -->
<script src="../themes/lte/assets/plugins/SweetAlert2/dist/sweetalert2.all.min.js"></script>

<!-- DataTable -->
<script>
  $(function () {
	  
 //   $(".datatable").DataTable();
    var oTable = $('#table-data').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false,
	  
	  dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Data export',
				className: 'btn btn-success btn-xs'
            },
            {
                extend: 'pdfHtml5',
                title: 'Data export',
				className: 'btn btn-danger btn-xs'
            }
        ],

	language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
<?php
	if(isset($_GET["view"]) && isset($_GET["action"])){
		if($_GET["view"]=="caja-chica" && $_GET["action"]=="index"){ ?>
				"search": "",
<?php	} else 
		if($_GET["view"]=="usuarios" || $_GET["view"]=="empleados" || $_GET["view"]=="inventario" && $_GET["action"]=="index"){ ?>
				"search": "",
<?php	} else
		if($_GET["view"]=="cotizaciones"){
			if($_GET["action"]=="rentas" || $_GET["action"]=="servicios"){ ?>
				"search": "",
<?php		}
		} else { ?>
        "search": "Buscar",
<?php	}
	}
?>
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
	}

    });
	
	
	//Rango de busqueda
  $("#min").datepicker({
    showOn: "button",
    buttonImage: "images/calendar.gif",
    buttonImageOnly: false,
    "onSelect": function(date) {
      minDateFilter = new Date(date).getTime();
      oTable.fnDraw();
    }
  }).keyup(function() {
    minDateFilter = new Date(this.value).getTime();
    oTable.fnDraw();
  });

  $("#max").datepicker({
    showOn: "button",
    buttonImage: "images/calendar.gif",
    buttonImageOnly: false,
    "onSelect": function(date) {
      maxDateFilter = new Date(date).getTime();
      oTable.fnDraw();
    }
  }).keyup(function() {
    maxDateFilter = new Date(this.value).getTime();
    oTable.fnDraw();
  });

	$('.select2').select2({ width: '100%' });
  
});

// Date range filter
minDateFilter = "";
maxDateFilter = "";
$.fn.dataTableExt.afnFiltering.push(
  function(oSettings, aData, iDataIndex) {
    if (typeof aData._date == 'undefined') {
      aData._date = new Date(aData[4]).getTime();
    }
    if (minDateFilter && !isNaN(minDateFilter)) {
      if (aData._date < minDateFilter) {
        return false;
      }
    }
    if (maxDateFilter && !isNaN(maxDateFilter)) {
      if (aData._date > maxDateFilter) {
        return false;
      }
    }
    return true;
  }
);	
</script>
<!-- fullCalendar -->
<script src="../themes/lte/assets/plugins/moment/moment.js"></script>
<script src="../themes/lte/assets/plugins/fullcalendar/fullcalendar.min.js"></script>


<!--Smart Wizard-->
<script src="../themes/lte/assets/plugins/SmartWizard/dist/js/jquery.smartWizard.min.js"></script>

<?php
//Esto ocurre cunado vienes del historial de cotizaciones y quieres agregar un registro via modaal
if(isset($_GET["open"]) && $_GET["open"]=="modal"){ ?>
<script type="text/javascript">
$(function() {
    $('#myModal).modal('show');
});
</script>
<?php }  /* NO SE USA - error mio, el link es directo */ ?>

<!-- Inicializacion de plugins (PERSONALIZADO), me ahorro 400 lineas -->
<script src="../themes/lte/assets/custom_init.js"></script>

</body>
</html>