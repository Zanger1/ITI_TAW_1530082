<?php
#SessionController::require_session(); //Debera comprobar si existe una session
?><?php function view_head(){ ?>
<!DOCTYPE html>
<html>
<head>
  <title>Sanitam</title>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/vnd.microsoft.icon" href="themes/lte/assets/dist/img/sanitam-icon.ico">
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">-->
  <link rel="stylesheet" href="themes/lte/assets/plugins/font-awesome/5.9.0/css/all.css">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="themes/lte/assets/dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="themes/lte/assets/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="themes/lte/assets/plugins/morris/morris.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="themes/lte/assets/plugins/datatables/dataTables.bootstrap4.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="themes/lte/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="themes/lte/assets/plugins/select2/select2.min.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="themes/lte/assets/plugins/datepicker/datepicker3.css">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="themes/lte/assets/plugins/fullcalendar/fullcalendar.min.css">
  <link rel="stylesheet" href="themes/lte/assets/plugins/fullcalendar/fullcalendar.print.css" media="print">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="themes/lte/assets/plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="themes/lte/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font: Source Sans Pro -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
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
  <link rel="stylesheet" type="text/css" href="themes/lte/assets/plugins/SweetAlert2/dist/sweetalert2.min.css">
  	
  <!-- Custom Uploader -->
  <link rel="stylesheet" type="text/css" href="themes/lte/assets/plugins/uploader/style.css">

  <!-- Custom Font-face -->
  <link rel="stylesheet" type="text/css" href="themes/lte/assets/dist/font/font-face.css">

  <!-- Wizard -->
  <link rel="stylesheet" type="text/css" href="themes/lte/assets/plugins/SmartWizard/dist/css/smart_wizard.min.css">
  <link rel="stylesheet" type="text/css" href="themes/lte/assets/plugins/SmartWizard/dist/css/smart_wizard_theme_arrows.css">

  <!-- Inicializacion de plugins (PERSONALIZADO), me ahorro 300 lineas -->
  <link rel="stylesheet" type="text/css" href="themes/lte/assets/custom_init.css">
  <link rel="stylesheet" type="text/css" href="themes/lte/assets/plugins/spoiler/spoiler.css">
</head>

<?php } function view_main(){ ?>

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
      <!--<li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Inicio</a>
      </li>-->
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
			<div class="image">
				<?php 
        if(isset($_SESSION["username"])) 
          { 
            echo '@'.$_SESSION["username"].' | '.$_SESSION["role"].' &nbsp;'; 
          } 
        ?>
				<img src="themes/lte/assets/dist/img/default-profile.png" class="img-circle elevation-2" width="28" alt="User Image">
			</div>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href="index.php?view=Usuarios&action=sign_out" class="dropdown-item">
            <i class="fa fa-sign-out mr-2"></i> Salir
          </a>
        </div>
      </li>

      <!-- Notifications Dropdown Menu --><!--
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-bell fa-2x"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu  dropdown-menu-right" style="width:400px !important;"><!-- dropdown-menu-lg --><!--
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
      </li> -->
	  
<!--      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fa fa-th-large"></i></a>
      </li> -->
	  
    </ul>
  </nav>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background:#686767;">
    <!-- Brand Logo -->
	
    <div class="brand-link" style="background:686767;"><!-- si quieres recuperar el link a inicio -->
		   <div id="custom-brand-logo" style="background-image:url('themes/lte/assets/dist/img/logo.png');
	background-repeat:no-repeat;
	background-size:contain;
	background-position:center; height:100px; margin-top: -10px; margin-bottom: -40px;">&nbsp;</div>
		   
	  <span class="badge badge-success" style="font-size:10px; z-index:1; float: right; right: -120px; margin-top:-55px;">
      <?php 
        if(isset($_SESSION["id_sucursal"]))
          { 
            echo SucursalesModel::getOnlyName($_SESSION["id_sucursal"]); 
          } 
          else 
          { 
            echo 'Sucursal'; 
          } 
          ?>
          
      </span>
      <span class="brand-text font-weight-light">&nbsp;</span>
    </div>

	<style>.main-sidebar { background-color: #1e1e1e !important }.</style>
    <!-- Sidebar -->
    <div class="sidebar">
    
<!-- ---------------------- INICIO DEL MENU PRINCIPAL --------------------------------------------------------------- -->	  
      <!-- Sidebar Menu -->
     <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
		  
		   <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-user"></i>
              <p>Personal <i class="right fa fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?view=Empleados&action=index" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Empleados</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?view=Usuarios&action=index" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Usuarios</p>
                </a>
              </li>
			</ul>
		   </li>
		  
          <li class="nav-item has-treeview">
            <a href="?view=Clientes&action=index" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>Clientes</p>
            </a>
		   </li>
<!--************************ MENU - APARTADO DE CATALOGOS ******************-->
			<!-- ** MODEO DE PRUEBA POR PAULINA: REALIZAR PRUEBA POR ROL DE USUARIO 
			PARA PODER MOSTRAR O NO ALGUNOS USUARIOS - 
			PERMITIDO PARA LOS ADMINISTRADORES EL USU DE CATALOGOS ** -->
		<!--*** INICIO DE CATALOGOS *** -->


     
     <?php
          //jlopezl
         //Si es administrador de general tiene acceso a los catalogos.
         if($_SESSION["id_role"]==1)
         { 
        ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-book-open"></i>
              <p>Catalogos <i class="right fa fa-angle-left"></i></p>
            </a>				
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?view=Sucursales&action=index" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Sucursales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?view=UnidadesRenta&action=index" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Unidades</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?view=Servicios&action=index" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Servicios</p>
                </a>
              </li>
             
			</ul>
		   </li>
      <?php 
        } 
      ?>
		<!-- *** FINAL DE CATALOGOS *** -->

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-cubes"></i>
              <p>Inventarios <i class="right fa fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?view=Inventario&action=index" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Unidades</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?view=SucursalServicio&action=index" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Servicios</p>
                </a>
              </li>
			</ul>
		   </li>

		   <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-file-invoice-dollar"></i>
              <p>Cotizaciones<i class="right fa fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?view=Ventas&action=index&for=rentas&is_archived=false" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Rentas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?view=Ventas&action=index&for=servicios&is_archived=false" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Servicios</p>
                </a>
              </li>
			</ul>
		   </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-file-invoice-dollar"></i>
              <p>Ordenes<i class="right fa fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?view=Ventas&action=index&for=rentas&is_archived=true" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Rentas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?view=Ventas&action=index&for=servicios&is_archived=true" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Servicios</p>
                </a>
              </li>
           <!--
              <li class="nav-item">
                <a href="?view=Ventas&action=rutas" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Rutas</p>
                </a>
              </li>
           -->
			</ul>
		   </li>

		   <li class="nav-item has-treeview">
            <a href="?view=CajaChica&action=index" class="nav-link">
              <i class="nav-icon fa fa-toolbox"></i>
              <p>
                Caja chica
              </p>
            </a>
		   </li>
		   <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-clipboard-list"></i>
              <p>
                Nomina
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
             <li class="nav-item">              
                <a href="index.php?view=Rutas&action=index" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Rutas</p>
                </a>
              </li>
              <?php if(isset($_SESSION["id_role"]) && $_SESSION["id_role"]==1)
              {
                  $viewExtra = 'Matriz';
              } 
              else if($_SESSION["id_role"]==2 || $_SESSION["id_role"]==3) 
              { 
                  $viewExtra = 'Sucursal'; 
              } ?>



              <!-- 
               JLOPEZL 
               COMENTADO TEMPORALMENTE 
               PARA PUBLICAR HASTA QUE SE TERMINE   
			   -->           
              <li class="nav-item">
                <a href="index.php?view=Extras<?php echo $viewExtra; ?>&action=index" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Extras</p>
                </a>
              </li>
             
              <li class="nav-item">
                <a href="index.php?view=Prenomina&action=index" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Prenomina (Extras)</p>
                </a>
              </li>
               
              <li class="nav-item">
                <a href="index.php?view=EmpleadoInfonavit&action=index" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Infonavit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?view=Prestamos&action=index" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Prestamos</p>
                </a>
              </li> 


              <!-- 
               JLOPEZL 
               COMENTADO TEMPORALMENTE 
               PARA PUBLICAR HASTA QUE SE TERMINE  
-->
              <li class="nav-item">
                <a href="index.php?view=Nomina&action=index" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Generar Nomina (local)</p>
                </a>
              </li>

               <li class="nav-item">
                <a href="index.php?view=Historial&action=index" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Historial Nomina (local)</p>
                </a>
              </li>
               


              <!--
              <li class="nav-item">
                <a href="index.php?view=ExtrasMatriz&action=index" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Extras</p>
                </a>
              </li>
            -->
<!-- ------------------------ FINAL DEL MENU ---------------------------------------------------- -->

           <!--
            <li class="nav-item">
                <a href="index.php?view=Extras<?php echo $viewExtra; ?>&action=index" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Extras</p>
                </a>
              </li>
            -->

			</ul>
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


<?php router(); ?>

		
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <!--
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.0-alpha
    </div>
  -->
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php } function view_foot(){ ?>

<!-- jQuery -->
<script src="themes/lte/assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI De 1.11.4 A 1.12.1 -->
<script src="themes/lte/assets/plugins/jQueryUI/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!--<script>
  $.widget.bridge('uibutton', $.ui.button)
</script> -->
<!-- Bootstrap 4 -->
<script src="themes/lte/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Morris.js charts -->
<script src="themes/lte/assets/plugins/Raphael/2.1.0/raphael-min.js"></script>
<script src="themes/lte/assets/plugins/morris/morris.min.js"></script> <!-- De momento no ocupo graficas -->
<!-- Sparkline -->
<script src="themes/lte/assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="themes/lte/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="themes/lte/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="themes/lte/assets/plugins/knob/jquery.knob.js"></script>
<!-- fullCalendar -->
<script src="themes/lte/assets/plugins/moment/moment.js"></script>
<script src="themes/lte/assets/plugins/fullcalendar/fullcalendar.min.js"></script>
<!-- daterangepicker -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>-->
<!--<script src="themes/lte/assets/plugins/moment/moment.js"></script>-->
<script src="themes/lte/assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="themes/lte/assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="themes/lte/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="themes/lte/assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="themes/lte/assets/plugins/fastclick/fastclick.js"></script>
<!-- Select2 -->
<script src="themes/lte/assets/plugins/select2/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="themes/lte/assets/dist/js/adminlte.js"></script>
<!-- Custom Uploader -->
<script src="themes/lte/assets/plugins/uploader/script.js"></script>
<!-- Validate Form -->
<script src="themes/lte/assets/plugins/validate-form/check-prices.js"></script><!-- Este es aparte, solo sirve para precios -->
<script src="themes/lte/assets/plugins/validate-form/init_inside_modals.js"></script><!-- Este Inicializa "check-prices.js" y aparte sirve para validar otros tipos de campos -->
<script src="themes/lte/assets/plugins/validate-form/init_outside_modals.js"></script><!-- Este Inicializa "check-prices.js" y aparte sirve para validar otros tipos de campos -->
<!--Smart Wizard-->
<script src="themes/lte/assets/plugins/SmartWizard/dist/js/jquery.smartWizard.min.js"></script>
<!-- SweetAlert 2 -->
<script src="themes/lte/assets/plugins/SweetAlert2/dist/sweetalert2.all.min.js"></script>
<!-- DataTables -->
<script src="themes/lte/assets/plugins/datatables/jquery.dataTables.js"></script>
<!--<script src="themes/lte/assets/plugins/datatables/1.10.19/jquery.dataTables.min.js"></script><!-- v 1.10.19 -->
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="themes/lte/assets/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- DataTables Buttons -->
<script src="themes/lte/assets/plugins/datatables/jszip/3.1.3/jszip.min.js"></script>

<script src="themes/lte/assets/plugins/datatables/pdfmake/0.1.36/pdfmake.min.js"></script>

<script src="themes/lte/assets/plugins/datatables/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="themes/lte/assets/plugins/datatables/buttons/1.5.2/dataTables.buttons.min.js"></script>
<script src="themes/lte/assets/plugins/datatables/buttons/1.5.2/buttons.html5.min.js"></script>

<?php if(isset($_GET["view"])){ ?>
<!-- DataTable -->
<script>
$(document).ready(function () {
	
//Para caja chica ver si el dinero que quiere retirar supera la cantidad que hay disponible
<?php
$id_sucursal="";
$total_caja_actualmente = "";
if(isset($_SESSION["id_user"])){
	$id_sucursal = $_SESSION["id_sucursal"];
	$total_caja_actualmente = SucursalesModel::getTotalEnCajaActual($id_sucursal);
	if($total_caja_actualmente == ""){ $total_caja_actualmente = 0.00; }
}
?>
$("#registrar-monto").change(function(){
//     if(this.value > <?php echo $total_caja_actualmente; ?>){		//parseInt(this.value)
     if($("#registrar-monto").val() > <?php echo $total_caja_actualmente; ?>){		//parseInt(this.value)
        alert("No hay dinero suficiente para retirar esta cantidad");
     }
})


//  $(function () {
	
	var url_ajax = "index.php?view=<?php echo $_GET["view"]; ?>&action=all_json<?php if(isset($_GET["for"]) && isset($_GET["is_archived"])){ echo '&for='.$_GET["for"].'&is_archived='.$_GET["is_archived"]; } else {} ?>";
	
    var data_table = $('#table-data').DataTable({
		"destroy": true,
		"processing":true,
		"serverSide":true,
		"paging": true,
		"lengthChange": true,
		"searching": true,
		"ordering": false,
		"info": true,//true,
	//	"scrollX":true,
		"autoWidth": false,	//Falso para que la tabla se expanda a un ancho de 100%
		dom: 'Bfrtip',
		
		"order":[],
		
//		"data":{ IdSucursal:IdSucursal },
		"ajax":{
			url: url_ajax,	//&IdSucursal="+IdSucursal +filtros de fechas (estos ultimos en la seccion de filtros mas abajo)
			type:"POST"
		},
		"columnDefs":[
			{
				"targets":[0, 3, 4],
				"orderable":false,
			},
		],
				//lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
		buttons: [ {
			extend: 'collection',
//			init: (api, node, config) => $(node).removeClass('btn-secondary'),
			className: 'btn btn-outline-success',
			text: '<i class="nav-icon fa fa-arrow-down"></i> Exportar',
			buttons: [
////////////////////////
			/* Empieza: todos los botones */
			//buttons: [

//Referencias
	//https://datatables.net/forums/discussion/52348/bootstrap4-dropdown-toggles-border-radius
	//https://datatables.net/extensions/buttons/examples/print/customisation.html
			
				{
				  extend: 'copyHtml5',
				  text: '<i class="nav-icon fa fa-clipboard"></i> Copiar',
				  titleAttr: 'Copiar al portapapeles',
				  className: 'btn btn-info btn-xs',
				  title: '<?php echo date("Y-m-d").'-'; ?><?php if(isset($_GET["view"])){ echo $_GET["view"]; } ?>',
				  exportOptions: {
					columns: ':not(:last-child)',
				  }
				},
				{
				  extend: 'csvHtml5',
				  text: '<i class="fa fa-file-csv"></i> CSV',
				  titleAttr: 'Valores Separado por Commas',
				  title: '<?php echo date("Y-m-d").'-'; ?><?php if(isset($_GET["view"])){ echo $_GET["view"]; } ?>',
				  className: 'btn btn-success btn-xs',
				  exportOptions: {
					columns: ':not(:last-child)',
				  }
				},
				{
					extend: 'excelHtml5',
					text: '<i class="nav-icon fa fa-file-excel"></i> Excel',
					title: '<?php echo date("Y-m-d").'-'; ?><?php if(isset($_GET["view"])){ echo $_GET["view"]; } ?>',
					className: 'btn btn-success btn-xs',
					exportOptions: {
						columns: ':not(:last-child)',
					}
				},
				{
					extend: 'pdfHtml5',
					text: '<i class="nav-icon fa fa-file-pdf"></i> PDF',
					title: '<?php echo date("Y-m-d").'-'; ?><?php if(isset($_GET["view"])){ echo $_GET["view"]; } ?>',
					className: 'btn btn-danger btn-xs',
					pageSize: 'letter',//A0 is the largest A5 smallest(A0,A1,A2,A3,legal,A4,A5,letter))
					customize: function ( doc ) {
						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
						doc.content.splice( 1, 0, {
							margin: [ -14, -50, 0, -12 ],
							alignment: 'left',	//el atributo image debe ser una imagen convertida en base 64
							image: 'data:image/png;base64,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'
						} ); /* CODIGO DE IMAGEN*/
	/*							 doc.styles.title = {
								   color: 'red',
								   fontSize: '40',
								   background: 'blue',
								   alignment: 'left'
								 } 
								 doc.styles.tableHeader = {
								   color: 'red',
								   background: 'blue',
								   alignment: 'right'
								 }
								 doc.styles.tableBodyEven = {
								   background: 'yellow',
								   alignment: 'right'
								 }
								 doc.styles.tableBodyOdd = {
								   background: 'blue',
								   alignment: 'right'
								 }
								doc.styles.tableFooter = {
								   background: 'blue',
								   alignment: 'right'
								 }
								doc.styles['td:nth-child(2)'] = { 
								   width: '100px',
								   'max-width': '100px'
								 } */
							doc['footer']=(function(page, pages) {
								return {
									columns: [
										{
											alignment: 'left',
											text: [ /* 'Created on: ', { text: jsDate.toString()  */  ]
										},
										{
											alignment: 'right',
											text: ['page ', { text: page.toString() },	' of ',	{ text: pages.toString() }]
										}
									],
									margin: 20
								}
							});
					},
					exportOptions: {
						columns: ':not(:last-child)',
					}
				}
			//]			/* Terminan: todos los botones */
////////////////////////
			]		
		}],

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
   //se elimina la palabra buscar de cada una de las vistas donde se usa
	if(isset($_GET["view"]) && isset($_GET["action"]))
  {
		if($_GET["view"]=="CajaChica" && $_GET["action"]=="index")
      { ?>
			"search": "",
      <?php	} else 
		if($_GET["view"]=="Usuarios" || $_GET["view"]=="Empleados" || $_GET["view"]=="Inventario" && $_GET["action"]=="index"){ ?>
			"search": "",
<?php	} else
		if($_GET["view"]=="Ventas" && $_GET["for"]){
			if($_GET["for"]=="rentas" || $_GET["for"]=="servicios"){ ?>
			"search": "",
<?php		}
		} 
		
		

		else 

     if($_GET["view"]=="SucursalServicio" && $_GET["action"]=="index")
      { ?>
      "search": "",
	  <?php }
	  
	  else 

	  if($_GET["view"]=="Rutas" && $_GET["action"]=="index")
	   { ?>
	   "search": "",
	   <?php }



      else 
       if($_GET["view"]=="EmpleadoInfonavit" && $_GET["action"]=="index")
      { ?>
      "search": "",
      <?php }

       else 
       if($_GET["view"]=="Prestamos" && $_GET["action"]=="index")
      { ?>
      "search": "",
      <?php }

      else 
       if($_GET["view"]=="Prenomina" && $_GET["action"]=="index")
      { ?>
      "search": "",
      <?php 
      }

      else 
       if($_GET["view"]=="PrenominaDetalles" && $_GET["action"]=="index")
      { ?>
      "search": "",
      <?php 
      }

 	else 
 	if($_GET["view"]=="ExtrasMatriz" && $_GET["action"]=="index")
	{ ?>
"search": "",
<?php }

    else { ?>
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

	//EMPIEZAN LOS FILTROS
//	var IdSucursal = $('#IdSucursal option:selected').val(); //$(this).val();
//	var IdSucursal = $('#IdSucursal').val(); //$(this).val();

	$(document).on('change', '#IdSucursal, #start_date, #end_date, #id_situacion_ubicacion, #id_situacion_monetaria', function(){

		//var IdSucursal = $(this).val();
		var for_operation = "<?php if(isset($_GET["for"])){ echo $_GET["for"]; } else { echo 'null'; } ?>";
		var is_archived = "<?php if(isset($_GET["is_archived"])){ echo $_GET["is_archived"]; } else { echo 'null'; } ?>";
		var IdSucursal = $('#IdSucursal option:selected').val();
		var start_date = $('#start_date').val();
		var end_date = $('#end_date').val();
		var id_situacion_ubicacion = $('#id_situacion_ubicacion').val();
		var id_situacion_monetaria = $('#id_situacion_monetaria').val();
		var new_url= url_ajax+"&IdSucursal="+IdSucursal+"&fecha_inicial="+start_date+"&fecha_final="+end_date+'&id_situacion_ubicacion='+id_situacion_ubicacion+'&id_situacion_monetaria='+id_situacion_monetaria;		

		$('#table-data').DataTable().ajax.url(new_url);
		data_table.ajax.reload();
		//console.log(new_url);


<?php if(isset($_GET["view"]) && $_GET["view"]=='CajaChica'){ ?>	
		if(IdSucursal != ''){
			$('#total-en-caja').load( "index.php?view=CajaChica&action=total_caja&with_modal=opened&IdSucursal="+IdSucursal+"#total-en-caja" );
		} else {
			$('#total-en-caja').load( "index.php?view=CajaChica&action=total_caja&with_modal=opened&IdSucursal="+IdSucursal+"#total-en-caja" );
		}
<?php } ?>


<?php if(isset($_GET["view"]) && $_GET["view"]=='Ventas'){	// se refiere a cotizaciones/ordenes pero al final se quedo con el nombre ventas, anets TF  ?>
		if(IdSucursal != ''){
			$('#sumatorias-subtotal').load( "index.php?view=Ventas&action=sumatorias_subtotal&with_modal=opened&for="+for_operation+"&is_archived="+is_archived+"&IdSucursal="+IdSucursal+"#sumatorias-subtotal" );
		} else {
			$('#sumatorias-subtotal').load( "index.php?view=Ventas&action=sumatorias_subtotal&with_modal=opened&for="+for_operation+"&is_archived="+is_archived+"&IdSucursal="+IdSucursal+"#sumatorias-subtotal" );
		}
<?php } ?>
		
	});
	
<?php  if(isset($_GET["view"]) && $_GET["view"]=='CajaChica'){ ?>
		//Total por default en CajaChica
		function reload_total_cajachica(){
			//$('#total-en-caja').load( "index.php?view=CajaChica&action=total_caja&with_modal=opened&IdSucursal="+IdSucursal+"#total-en-caja" );
			$('#total-en-caja').load( "index.php?view=CajaChica&action=total_caja&with_modal=opened&IdSucursal=<?php if(isset($_SESSION["id_sucursal"])){ echo $_SESSION["id_sucursal"]; } ?>&for=<?php if(isset($_GET["for"])){ echo $_GET["for"]; } ?>#total-en-caja" );
		}
		reload_total_cajachica();
<?php } ?>

<?php  if(isset($_GET["view"]) && $_GET["view"]=='Ventas'){ ?>
		//Total de la suma de Subtotales en cotizaciones/ordenes
		function reload_sumatorias_subtotal(){
			$('#sumatorias-subtotal').load( "index.php?view=Ventas&action=sumatorias_subtotal&with_modal=opened&IdSucursal=<?php if(isset($_SESSION["id_sucursal"])){ echo $_SESSION["id_sucursal"]; } ?>&for=<?php if(isset($_GET["for"])){ echo $_GET["for"]; } ?>&is_archived=<?php if(isset($_GET["is_archived"])){ echo $_GET["is_archived"]; } ?>#sumatorias-subtotal" );
		}
		//console.log(new_url);
		reload_sumatorias_subtotal();

<?php } ?>

<?php  if(isset($_GET["view"]) && $_GET["view"]=='Ventas'){ ?>
	$(document).on('shown.bs.modal', '.modal', function() {
		/*$(document).on('change', '#ajax-content-view', function(){*/
			var mail;
			//alert('entra');
			$.get( "index.php?view=Ventas&action=correos&with_modal=opened&clave_unica=<?php if(isset($_SESSION["idclaveUnica"])){ echo $_SESSION["idclaveUnica"]; } ?>&for=<?php if(isset($_GET["for"])){ echo $_GET["for"]; }?>", function(data){
				mail = data;
				$('#email-cliente').val(mail);
			});
			
		});

		//console.log(new_url);
		//reload_correos();
	/*});*/
<?php } ?>

/*
	$(document).on('change', '#start_date',function(){
		var start_date = $('#start_date').val();
		var end_date = $('#end_date').val();
		//if(start_date != ''){
			$('#table-data').DataTable().ajax.url(url_ajax+"&fecha_inicial="+start_date+"&fecha_final="+end_date);
			data_table.ajax.reload();
			//alert(start_date);
		//}
	});

	$(document).on('change', '#end_date',function(){
		var start_date = $('#start_date').val();
		var end_date = $('#end_date').val();

		//if(start_date != ''){
			$('#table-data').DataTable().ajax.url(url_ajax+"&fecha_inicial="+start_date+"&fecha_final="+end_date);
			data_table.ajax.reload();
			//alert(end_date);
		//}
	}); */
	
	//TERMINAN LOS FILTROS

<?php if(isset($_GET["view"]) && $_GET["view"]=='CajaChica'){ ?>
	//FILTRO EXTRA PARA CAJA CHICA - DENTRO DEL MODAL: TOTALES
	$('body').on('shown.bs.modal', '.modal', function() {
		var cantidad_ingresada; var cajaToatal; var tipoMovimiento;
		$(document).on('change', '#SucursalCaja, #registrar-monto, #tipoMovimiento', function(){
			//var IdSucursal = $(this).val();
			var IdSucursal = $('#SucursalCaja option:selected').val();	//option:selected
			var tipoMovimiento = $('#tipoMovimiento option:selected').val();
			//if(IdSucursal != ''){
			//var cajaToatal;
				$.get("index.php?view=CajaChica&action=total_caja&with_modal=opened&IdSucursal="+IdSucursal, function (data) {
					cajaToatal = data;	//lo que devuelva es el total en caja seleccionada
					$('#CantidadTotalCajaSucursal').val(cajaToatal);
				});
			//}
			var cantidad_ingresada = $('#registrar-monto').val();	//Cuando ponen datos nuevos
			var tipoMovimiento = $('#tipoMovimiento').val();
		});

		//Default
		var IdSucursal = $('#SucursalCaja option:selected').val();
		var tipoMovimiento = $('#tipoMovimiento option:selected').val();
		$.get("index.php?view=CajaChica&action=total_caja&with_modal=opened&IdSucursal="+IdSucursal, function (data) {
			cajaToatal = data;	//lo que devuelva es el total en caja seleccionada
			$('#CantidadTotalCajaSucursal').val(cajaToatal);
			
			var cantidad_ingresada = $('#registrar-monto').val();	//el que esta en ese momento al abrir el modal
		});
			
		$(document).on('change', '#SucursalCaja, #registrar-monto, #tipoMovimiento', function(){
			//cajaToatal = 
			tipoMovimiento = $('#registrar-monto').val();
			cantidad_ingresada = $('#registrar-monto').val();
			//alert("tipoMovimiento: "+tipoMovimiento);
			if(tipoMovimiento=='1'){
				alert("deposito");
			} else 
			if(tipoMovimiento=='2'){
				alert("retiro");
				if(cantidad_ingresada > cajaToatal){
					alert("No hay suficiente dinero para retirar");
					//$(".btn-primary").attr("disabled", true);
				}
			}
		});

	});
	$(".modal").on("hidden.bs.modal", function(){
		$(this).removeData('bs.modal');
		//console.log(id_estado);
	});
<?php } ?>
	
	//EMPIEZAN LOS MODALES

	var global_id_persona = 0;
	//exclusivo para ver el PDF en ventas... O boton amarillo en cotizaciones/ordenes para generar la orden
	//Sin embargo el siguiente modal "modal-status-order" es exclusivo de "cotizaciones/ordenes" para el boton amarilo (engrane)
	$(document).on('click', '.status', function(){
		
		var id_cotizacion = $(this).attr("id");
		
		var for_operation = '<?php if(isset($_GET["for"])){ echo $_GET["for"]; } ?>';
		var is_archived = '<?php if(isset($_GET["is_archived"])){ echo $_GET["is_archived"]; } ?>';
		var clave_unica = '<?php if(isset($_GET["clave_unica"])){ echo $_GET["clave_unica"]; } ?>';
		var clave = '<?php if(isset($_GET)) ?>'
			//Para ver doc en pestana nueva
			//var oldUrl = $(this).attr("href"); // Get current url
            //var newUrl = oldUrl.replace("#", "themes/lte/assets/plugins/PDF/invoicr/example/index.php?uk="+id_cotizacion+"&for=<?php if(isset($_GET["for"])){ echo $_GET["for"]; } ?>);
			/*"&info=<?php //if(isset($_GET["info"])){ echo $_GET["info"]; } ?>);*/
			//$('#link_document').attr("href", newUrl);

		$('#ajax-content-status-order').load('index.php?view=Ventas&action=manage_order&with_modal=opened&id='+id_cotizacion+'&for='+for_operation+'&is_archived='+is_archived,function(){
			
			    //Cargar el PDF de vista previa
				$('#ajax-content-view-pdf-on-spoiler').load('index.php?view=<?php echo $_GET["view"]; ?>&action=updateshow&with_modal=opened&edit=false&id='+id_cotizacion+'&for='+for_operation);
			
 
			$('#modal-status-order').modal({show:true});
		});

		

	});
	/*pdf para envio y recuperacion ---Prueba creado por # Paulina*/
	$(document).ready(function(){
		$(document).on('click', '.archivo', function(){
			
			var for_operation = '<?php if(isset($_GET["for"])){ echo $_GET["for"]; } ?>';
			//var is_archived = '<?php if(isset($_GET["is_archived"])){ echo $_GET["is_archived"]; } ?>';
			var cla_unica = '<?php if(isset($_GET["clave_unica"])){ echo $_GET["clave_unica"]; } ?>';
			var info = '<?php if(isset($_GET["action"])){ echo $_GET["action"]; } ?>';
			var clave = '<?php if(isset($_GET)) ?>'
				//Para ver doc en pestana nueva
				//var oldUrl = $(this).attr("href"); // Get current url
				//var newUrl = oldUrl.replace("#", "themes/lte/assets/plugins/PDF/invoicr/example/index.php?uk="+cla_unica+"&for=<?php if(isset($_GET["for"])){ echo $_GET["for"]; } ?>"&info="<?php if(isset($_GET["action"])){ echo $_GET["action"]; } ?>);
				//$('#link_document').attr("href", newUrl);
				
				//Mandar a llamar y cargar el enlace del pdf 
				$('#ajax-content-archivo').load('index.php?view=<?php echo $_GET["view"]; ?>&action=updateshow&with_modal=opened&edit=false&id='+cla_unica+'&for='+for_operation, function(){

						$('#ajax-content-view-pdf-on-spoiler').load('index.php?view=<?php echo $_GET["view"]; ?>&action=updateshow&with_modal=opened&edit=false&id='+cla_unica+'&for='+for_operation+'&info='+info);
					$('#ajax-content-archivo').toggle();
				});

		});
	});

	/*/////Ver modal para archivo pdf del envio*/
	$(document).ready(function(){
		$('#button-envio').on('click', function(e) {
      		e.preventDefault();
			  var for_operation = '<?php if(isset($_GET["for"])){ echo $_GET["for"]; } ?>';
			//var is_archived = '<?php if(isset($_GET["is_archived"])){ echo $_GET["is_archived"]; } ?>';
			var cla_unica = '<?php if(isset($_GET["clave_unica"])){ echo $_GET["clave_unica"]; } ?>';
			var info = '<?php if(isset($_GET["action"])){ echo $_GET["action"]; } ?>';

			var clave = '<?php if(isset($_GET)) ?>'
				//Para ver doc en pestana nueva
				//var oldUrl = $(this).attr("href"); // Get current url
				//var newUrl = oldUrl.replace("#", "themes/lte/assets/plugins/PDF/invoicr/example/envioPDF.php?uk="+cla_unica+"&for=<?php if(isset($_GET["for"])){ echo $_GET["for"]; } ?>"&info=<?php if(isset($_GET["action"])){ echo $_GET["action"]; } ?>);
				//$('#link_document').attr("href", newUrl);
				
				//Mandar a llamar y cargar el enlace del pdf 
				$('#ajax-content').load('index.php?view=<?php echo $_GET["view"]; ?>&action=updateshow&with_modal=opened&edit=false&clave_unica='+cla_unica+'&for='+for_operation+'&info='+info, function(){

						
					$('#myModal').modal({show:true});
						
				

				});
				
     		
    	});
	});




	//Ver
	$(document).on('click', '.view', function(){


		var id_persona = $(this).attr("id");

    	//alert (id_persona);
		var for_operation = '<?php if(isset($_GET["for"])){ echo $_GET["for"]; } ?>';

		$('#ajax-content-view').load('index.php?view=<?php echo $_GET["view"]; ?>&action=updateshow&with_modal=opened&edit=false&id='+id_persona+'&for='+for_operation,function(){
			
			$('#modal-view').modal({show:true});	//Quite data-target, ahora se abre desde aqui luego de cargar
			/*
			$('.email-cliente').val();
*/

		});

		global_id_persona = id_persona;//Este enviar al boton para correo, no se si pueda causar confusiones en las demas acciones. Por el momento no he encontrado ningun error al respecto.
		status_mail(for_operation,id_persona); //Solo para ver PDF
	});




	
	
	//Boton para mandar correo de una cotizacion
	function status_mail(for_operation,clave_unica){
		$('#ajax-content-button-send-mail').load('index.php?view=Ventas&action=mail_button&with_modal=opened&for_operation='+for_operation+'&clave_unica='+clave_unica);
		//console.log(for_operation,' - ',clave_unica); 
   
	}
	//status_mail();

	$(document).on('click', '#button-send-mail', function(){
		var for_operation = '<?php if(isset($_GET["for"])){ echo $_GET["for"]; } ?>';
		var id_cotizacion = global_id_persona;

    var email_cliente = $('#email-cliente2').val();
    var email_contacto = $('#email-contacto2').val();
	var email_otro = $('#email-otro2').val();
    
    
//alert(email_contacto); 
		$.get("../../../themes/lte/assets/plugins/PDF/invoicr/example/index.php?uk="+id_cotizacion+"&for="+for_operation+"&save=true", {"for":for_operation, "uk":id_cotizacion}, function(data) {  });	//aqui crea el pdf

		$.get("index.php?view=Ventas&action=mail_sent&with_modal=opened&for_operation="+for_operation+"&clave_unica="+id_cotizacion+"email_cliente="+email_cliente+"email_contacto="+email_contacto+"email_otro="+email_otro, {"for_operation":for_operation, "clave_unica":id_cotizacion, "email_cliente":email_cliente,"email_contacto":email_contacto,"email_otro":email_otro}, function(data) {  }); 
    //Actualiza la BD (Agrega a envios pendientes)
        //alert("listo"); 
		$.ajax({	//Animacion del boton
			url:"index.php?view=Ventas&action=mail_button&with_modal=opened&for_operation="+for_operation+"&clave_unica="+id_cotizacion,
			method:"GET",
			data:{"for_operation":for_operation, "clave_unica":id_cotizacion, "sent":'true'},
			success:function(data){
				$('#ajax-content-button-send-mail').html($(data).fadeIn('slow'));
			}

		})
	});
	//Fin boton email

	//Agregar
	$('.button-open-modal-add').on('click',function(){
		$('#ajax-content-add').load('index.php?view=<?php echo $_GET["view"]; ?>&action=updateshow&with_modal=opened&edit=true&id=0',function(){
			$("#response-for-select-ciudad").load("index.php?view=Layout&action=ciudades&with_modal=opened&id=0");	//de momento: para clientes
			$('#modal-add').modal({show:true});	//Quite data-target, ahora se abre desde aqui luego de cargar
		});
	});


//Agregar Nomina modalA
  $('.button-open-modal-addA').on('click',function(){
    $('#ajax-content-add').load('index.php?view=<?php echo $_GET["view"]; ?>&action=addshow&with_modal=opened&edit=true&id=0',function(){
      $("#response-for-select-ciudad").load("index.php?view=Layout&action=ciudades&with_modal=opened&id=0");  //de momento: para clientes
      $('#modal-add').modal({show:true}); //Quite data-target, ahora se abre desde aqui luego de cargar
    });
  });

	
	<?php if(isset($_GET["view"]) && $_GET["view"]=='Ventas'){ ?>
	//Este es para editar cotizaciones/Ordenes
	$("#response-for-select-ciudad").load("index.php?view=Layout&action=ciudades&with_modal=opened&id=0");

	
	//Para generar una orden
	$(document).on('submit', '#modal-form-convert', function(e) {	//$(document)   "#button-save"
		$.ajax({
			url: $(this).attr('action'),
			type: $(this).attr('method'),
			data: $(this).serialize(),
			success: function(data) {
			   $('#modal-status-order').modal('hide');
				data_table.ajax.reload();			
			}
		}).done(function(data){
			swal("Guardado", "Se ha generado la orden.", "success");
		}).fail(function(){
			swal("Error", "Algo salio mal", "error");
		});

				e.preventDefault();
				e.stopPropagation();
	});
	<?php } ?>
	
			$("#modal-add").on("hidden.bs.modal", function(){
				 $(this).removeData('bs.modal');
				 //console.log(id_estado);
			});

	
  var msg_error_header = ' ';
  //var msg_error_header =  $_GET["view"];
	$(document).on('submit', '#modal-form-add', function(e) {	//$(document)   "#button-save"
		$.ajax({
			url: $(this).attr('action'),
			type: $(this).attr('method'),
			data: $(this).serialize(),
			success: function(data) {
			   $('#modal-add').modal('hide');
				data_table.ajax.reload();
				<?php 
        if(isset($_GET["view"]) && $_GET["view"]=='CajaChica') 
        { ?> 
          reload_total_cajachica(); <?php 
        } ?>
					//Poner IF para caja chica
					if(data.status == 'error')
          {
						msg_error_header = 'No hay suficiente cantidad para retirar.';
					}	
			}
		}).done(function(data)
    {
			swal("Guardado", "Se ha agregado un nuevo registro con exito.", "success");
		}).fail(function()
    {
			
        <?php 
        if(isset($_GET["view"]) && $_GET["view"]=='CajaChica') 
        { ?> 
           swal("Error", "No puede retirar un monto mayor al que se tiene disponible."+msg_error_header, "error");
        <?php 
        } else { ?>
        swal("Error", "Posiblemente estas repitiendo alg&uacute;n dato ya registrado anteriormente, los datos que jam&aacute;s deber&aacute;n duplicarse son correo, rfc, usuario. "+msg_error_header, "error");
         <?php
        }
         ?>

      //swal("Error", "Posiblemente estas repitiendo alg&uacute;n dato ya registrado anteriormente, los datos que jam&aacute;s //deber&aacute;n duplicarse son correo, rfc, usuario. En caja chica el error m&aacute;s com&uacute;n es intentar retirar un monto mayor del que se tiene disponible."+msg_error_header, "error");
      

      //Colocar aqui los if de cada vista para filtar los posibles errores.
      //swal("Error", msg_error_header, "error");
		});

				e.preventDefault();
				e.stopPropagation();
	});

	//Editar
	$(document).on('click', '.update', function(){//$('.button-open-modal-edit').on('click',function(){
		var id_persona = $(this).attr("id"); //$(this).data("id-persona");
		$('#ajax-content-edit').load('index.php?view=<?php echo $_GET["view"]; ?>&action=updateshow&with_modal=opened&edit=true&id='+id_persona,function(){
			$('#modal-edit').modal({show:true});
		});
	});
	$(document).on('submit', '#modal-form-edit', function(e){ //$(document)   "#button-save"
		$.ajax({
			url: $(this).attr('action'),
			type: $(this).attr('method'),
			data: $(this).serialize(),
			success: function(html) {
				$('#modal-edit').modal('hide');
				data_table.ajax.reload();
				<?php if(isset($_GET["view"]) && $_GET["view"]=='CajaChica'){ ?> reload_total_cajachica(); <?php } ?>

			}
		}).done(function(data){
			swal("Editado", "Se han guardado los cambios con exito.", "success");
		}).fail(function(){
			swal("Error", "Posiblemente estas repitiendo alg&uacute;n dato ya registrado anteriormente, los datos que jam&aacute;s deber&aacute;n duplicarse son correo, rfc, usuario. En caja chica el error m&aacute;s com&uacute;n es intentar retirar un monto mayor del que se tiene disponible.", "error");
		});

				e.preventDefault();
				e.stopPropagation();
	});

	//Eliminar
	$(document).on('click', '.delete', function(){
		var id_persona = $(this).attr("id");
		global_id_persona = id_persona;
		$('#ajax-content-delete').load('index.php?view=<?php echo $_GET["view"]; ?>&action=updateshow&with_modal=opened&edit=false&id='+id_persona,function(){
			$('#modal-delete').modal({show:true});
		});
		$("#button-delete").click(function(e){
		var id_persona = global_id_persona;
			$.ajax({
				url:"index.php?view=<?php echo $_GET["view"]; ?>&action=delete<?php if(isset($_GET["for"])){ echo '_quotation&for='.$_GET["for"]; } ?>",
				method:"GET",
				data:{id:id_persona},
				success:function(data){
					$('#modal-delete').modal('hide');
					data_table.ajax.reload();
					<?php if(isset($_GET["view"]) && $_GET["view"]=='CajaChica'){ ?> reload_total_cajachica(); <?php } ?>
					

				}
			}).done(function(data){
				swal("Eliminado", "Se ha eliminado el registro con exito.", "success");
			}).fail(function(){
				swal("Error", "Error mientras se intentaba borrar.", "error");
			});
				e.preventDefault();
				e.stopPropagation();
		});
	});
	
	//Otros modales
	//Rastreador "Tracker"
	$(document).on('click', '.track', function(){
		var id_inventario = $(this).attr("id");
		$('#ajax-content-track').load('index.php?view=Inventario&action=track&with_modal=opened&id='+id_inventario,function(){
			$('#modal-track').modal({show:true});
		});
	});
	
	//TERMINAN LOS MODALES

	//Estados & Ciudades
	//Mas arriba en la seccion de modal agregar hay una linea extra para mostrar la validacion: "seleccione un estado primero"
	//$("#select-ciudad").attr("disabled",true);	//No reacciona porque debe iniciarse justo antes de abrir el modal

//Para Modal: Agregar 
	$(document).on('change', '#select-estado_Add', function(e){
		//alert("intento de cambio");
		//$("#select-ciudad").attr("disabled",false);
		//$("#select-ciudad").remove();	//removemos el select ese que por default traia todas las ciudades
		var id_estado = $('#select-estado_Add').val();	//fue declarado mas arriba, dentro de la config para modal "agreagar"
		//Esto carga dentro de modales
		$.get("index.php?view=Layout&action=ciudades&with_modal=opened", { id: id_estado },
		function(getresult){
//			if(id_estado == ""){ id_estado=0}
			//Sin importar si se esta agregando, o el resto de acciones (ver, editar, eliminar), deben cargar los municipios correspondientes a una entidad
			$("#response-for-select-ciudad").html(getresult);
			$("#select-ciudad").html(getresult);

//			alert(id_estado);
			e.preventDefault();
			e.stopPropagation();
		});
		//Fin de modal
	});
	
//Para Modales: Ver, Editar, Eliminar 
	$(document).on('change', '#select-estado_ViewEditDelete', function(e){
		//alert("intento de cambio");
		//$("#select-ciudad").attr("disabled",false);
		//$("#select-ciudad").remove();	//removemos el select ese que por default traia todas las ciudades
		var id_estado =  $('#select-estado_ViewEditDelete').val();	//fue declarado mas arriba, dentro de la config para modal "agreagar"
		//Esto carga dentro de modales
		$.get("index.php?view=Layout&action=ciudades&with_modal=opened", { id: id_estado },
		function(getresult){
//			if(id_estado == ""){ id_estado=0}
			//Sin importar si se esta agregando, o el resto de acciones (ver, editar, eliminar), deben cargar los municipios correspondientes a una entidad
			$("#response-for-select-ciudad").html(getresult);
			$("#select-ciudad").html(getresult);

//			alert(id_estado);
			e.preventDefault();
			e.stopPropagation();
		});
		//Fin de modal
	});

//Lo anterior lo duplique para que no sobre escriba el id_estado del modal de agreagar, con el valor de id_estado del modal ver, editar, eliminar.
//En el paso #2 de cotizaciones/ordenes no es necesario usar ambos (#select-estado_Add / #select-estado_ViewEditDelete), el problema en la vista de clientes (por ej), es que ambos modales se interfieren por estar dentro de la misma vista

	//Check for avaliable user name
	var x_timer;
	var check_user_name;
	$(document).on('change', '#username', function(){
		var check_user_name = $('#username').val();
		clearTimeout(x_timer);
		x_timer = setTimeout(function(){
			//check_username_ajax(check_user_name);
			$("#user-result").html('<img src="themes/lte/assets/dist/img/ajax-loader.gif" />');
			$.get('index.php?view=Usuarios&action=check_username&with_modal=opened', {'usuario':check_user_name}, function(data) {
				return $("#user-result").html(data);
			});
		}, 1000);
	});
	
<?php if(isset($_GET["action"]) && $_GET["action"]=="nueva_orden"){ ?>
	//Deshabilitar tecla "enter" (Si no se usa el boton de busqueda retorna error por no rellenar los campos)
	$(document).on('keyup keypress', 'form input', function(e) {
		if(e.keyCode == 13) {
			e.preventDefault();
			swal("No permitido", "La tecla ENTER no debe ser usada en este momento. Presione el boton Finalizar una vez que esten completados los pasos de #1 a #3", "error")
			//alert("La tecla ENTER no debe ser usada en este momento. Presione el boton Finalizar una vez que esten completados los pasos de #1 a #3");
			return false;
		} 
	});
<?php } ?>


//Trunca los valores decimale a 2 digitos.
  function trunc(n) {
    let t=n.toString();
    let regex=/(\d*.\d{0,2})/;
    return t.match(regex)[0];
  }

  //Calculos en el modal de prestamos
  $(document).on("change keyup",'#prestamo_Agregar, #semanas_Agregar', function(e) {
	//alert("bbb");
    var prestamo_Agregar = parseFloat($('#prestamo_Agregar').val());
    var semanas_Agregar = parseInt($('#semanas_Agregar').val());
    var abono_Agregar = $('#abono_Agregar').val();
    if (isNaN(prestamo_Agregar)) {
      //$('#prestamo_Agregar').val(0);
      prestamo_Agregar=0;
    }
    if(isNaN(semanas_Agregar)){
      //$('#semanas_Agregar').val(1);
      semanas_Agregar=1;
    }
    $('#abono_Agregar').val(trunc(prestamo_Agregar/semanas_Agregar));
    //prestamo = '';
    //semanas = '';
    e.preventDefault();
    e.stopPropagation();
  })

  //Calculos en el modal de prestamos
  $(document).on("change keyup",'#prestamo_VerEditarEliminar, #semanas_VerEditarEliminar', function(e) {
    var prestamo_VerEditarEliminar = parseFloat($('#prestamo_VerEditarEliminar').val());
    var semanas_VerEditarEliminar = parseInt($('#semanas_VerEditarEliminar').val());
    //var abono_VerEditarEliminar = $('#abono_VerEditarEliminar').val();
    if (isNaN(prestamo_VerEditarEliminar)) {
      //$('#prestamo_VerEditarEliminar').val(0);
      prestamo_VerEditarEliminar=0;
    }
    if(isNaN(semanas_VerEditarEliminar)){
      //$('#semanas_VerEditarEliminar').val(1);
      semanas_VerEditarEliminar=1;
    }
    $('#abono_VerEditarEliminar').val(trunc(prestamo_VerEditarEliminar/semanas_VerEditarEliminar));
    e.preventDefault();
    e.stopPropagation();
  })



 //Calculos en el modal de Generar Nomina (local)
  $(document).on("change, keyup",'#dias, #infonavit, #abonoNomina', function() {
    //Calcula el monto del día 7
    var dias = parseFloat($('#dias').val());
    if (isNaN(dias)) {
      //$('#dias').val(0);
      dias=0;
    }else if (dias>6){
      $('#dias').val(6);
      dias=6;
    }
    var sueldoBase = parseFloat($('#sueldoBase').val());
    $('#dia_7').val(trunc((sueldoBase/6)*dias));

    //Calcula el sueldo sin extras, infonavit y prestamos
    var dia_7 = parseFloat($('#dia_7').val());
    $('#sueldo').val(trunc((sueldoBase*dias)+dia_7));

    //Calcular el saldo restante de acuerdo al saldo anterior y el abono
    /*if (isNaN($('#prestamo').val())) {
      $('#prestamo').val(0);
    }*/
    var saldoAnterior = parseFloat($('#saldoAnterior').val());
    if (isNaN(saldoAnterior)) {
      //$('#saldoAnterior').val(0);
      saldoAnterior=0;
    }
    var abonoNomina = parseFloat($('#abonoNomina').val());
    if (isNaN(abonoNomina)) {
      //$('#abonoNomina').val(0);
      abonoNomina=0;
    }
    $('#saldoActual').val(saldoAnterior - abonoNomina);

    //Calcular el sueldo neto
    var sueldo = parseFloat($('#sueldo').val());
    var extras = parseFloat($('#extras').val());
    if (isNaN(extras)) {
      //$('#extras').val(0);
      extras=0;
    }
    var infonavit = parseFloat($('#infonavit').val());
    if (isNaN(infonavit)) {
      //$('#infonavit').val(0);
      infonavit=0;
    }
    /*if ((infonavit+abonoNomina)>(sueldo+extras)) {
      alert("No cuenta con el sueldo necesario para realizar el pago");
    }*/
    $('#sueldoNeto').val(trunc((sueldo+extras)-(infonavit+abonoNomina)));
  })




//Init Select2
<?php if(isset($_GET["view"]) && $_GET["view"]=='Ventas' && isset($_GET["action"]) && $_GET["action"]=='index'){ /* Solo la pantlalla de cotizaciones/ordenes, este es para activar select2 dentro de un modal que carga en un ID, contenido externo de otra vista dinamica dentro de un DIV */ ?>
$('body').on('shown.bs.modal', '.modal', function() {
	$(this).find('select').each(function() {
		var dropdownParent = $(document.body);
		if ($(this).parents('.modal.in:first').length !== 0)
		dropdownParent = $(this).parents('.modal.in:first');
		$(this).select2({
			//tags: true,
			dropdownParent: dropdownParent, //$("#modal-status-order"), //dropdownParent //$("#modal-status-order"), //Por mientras solo en ese	/* dropdownParent, */ 
			width: '100%'
		});
	});

});

<?php } else { /* Todas las demas vistas*/ ?>

//Select2
$('body').ready(function () {
	$('.select2').select2({ width: '100%' });
});
//$('.select2').select2({ width: '100%' });

<?php } ?>


});
</script>
<?php } ?>

<!-- Inicializacion de plugins (PERSONALIZADO), me ahorro 400 lineas -->
<script src="themes/lte/assets/custom_init.js"></script>

<script src="themes/lte/assets/plugins/spoiler/spoiler.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) --
<script src="themes/lte/assets/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes --
<script src="themes/lte/assets/dist/js/demo.js"></script> -->

</body>
</html>
<?php } function view_login(){ ?>
<style>
.input-group-prepend span{
width: 40px;
background-color: #4ac71c;
color: black;
border:0 !important;
}
input:focus{
outline: 0 0 0 0  !important;
box-shadow: 0 0 0 0 !important;

}
</style>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo" style="margin-top:-30px;">
    <a href="#"><img src="themes/lte/assets/dist/img/logo.png" alt="logo" width="200"></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <!--<p class="login-box-msg">Sign in to start your session</p>-->

      <form action="?view=Usuarios&action=sign_in" autocomplete="off" method="post">
        <div class="input-group form-group">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="fas fa-user"></i></span>
			</div>
			<input type="text" class="form-control" name="username" placeholder="Nombre de usuario" required="">
        </div>
        <div class="input-group form-group">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="fas fa-key"></i></span>
			</div>
			<input type="password" class="form-control" name="password" placeholder="Contrase&ntilde;a" required="">
        </div>
        <div class="row">
          <!--<div class="col-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox"> Mantener sesi&oacute;n
              </label>
            </div> 
          </div>-->
          <!-- /.col -->
          <div class="col-4">
            <input type="submit" class="btn btn-primary btn-block btn-flat" name="enter" value="Iniciar">
          </div>
		  
          <!-- /.col -->
        </div>
		<div class="col-4" id="error">
	  		
	 	</div>
      </form>
	 
	  
<!--
      <p class="mb-1">
        <a href="#">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p>-->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<?php } ?>