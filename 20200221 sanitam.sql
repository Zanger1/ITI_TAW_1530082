-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-02-2020 a las 21:11:51
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sanitam`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ACTUALIZAR_NOMINA` (IN `p_idDetalleNominaSucursal` INT, IN `p_idNominaSucursal` INT, IN `p_NoDiasTrabajados` INT, IN `p_SeptimoDia` DECIMAL(12,2), IN `p_SueldoBase` DECIMAL(12,2), IN `p_Sueldo` DECIMAL(12,2), IN `p_TotalExtras` DECIMAL(12,2), IN `p_Infonavit` DECIMAL(12,2), IN `p_Prestamo` DECIMAL(12,2), IN `p_SaldoAnterior` DECIMAL(12,2), IN `p_Abono` DECIMAL(12,2), IN `p_SueldoActual` DECIMAL(12,2), IN `p_SueldoNeto` DECIMAL(12,2), IN `p_ComentariosSucursal` TEXT, IN `p_ComentariosMatriz` TEXT)  BEGIN

	DECLARE v_id INT(1);
    
	UPDATE detallenominasucursal dns SET dns.NoDiasTrabajados=p_NoDiasTrabajados, dns.SeptimoDia=p_SeptimoDia, 
	dns.SueldoBase=p_SueldoBase, dns.Sueldo=p_Sueldo, dns.TotalExtras=p_TotalExtras, dns.Infonavit=p_Infonavit, 
	dns.Prestamo=p_Prestamo, dns.SaldoAnterior=p_SaldoAnterior, dns.Abono=p_Abono, dns.SueldoActual=p_SueldoActual, 
	dns.SueldoNeto=p_SueldoNeto, dns.ComentariosSucursal=p_ComentariosSucursal, dns.ComentariosMatriz=p_ComentariosMatriz 
	WHERE dns.idDetalleNominaSucursal=p_idDetalleNominaSucursal;
    
    SET v_id:= p_idNominaSucursal;
    
    CALL CALCULAR_TOTALES(v_id);
END$$

CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `add_cajachica` (IN `idsucursal_` INT, IN `idTipoMov_` INT, IN `descripcion_` VARCHAR(500), IN `monto_` DECIMAL(12,2), IN `idempleado_` INT, IN `fecha_` DATETIME)  NO SQL
begin
    insert into caja_chica(IdSucursal, IdTipoMovimiento, Descripcion, Monto, IdEmpleado, Fecha)
values(idsucursal_,idTipoMov_,descripcion_,monto_,idempleado_,fecha_ );
end$$

CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `add_clientes` (IN `nombre_` VARCHAR(100), IN `RFC_` VARCHAR(50), IN `calle_` VARCHAR(200), IN `colonia_` VARCHAR(200), IN `codigoP_` INT, IN `num_` INT, IN `idciudad_` INT, IN `correoelec_` VARCHAR(300), IN `telefono_` VARCHAR(50))  NO SQL
begin
    insert into clientes (Nombre, RFC, Calle, Colonia, CodigoPostal, Num, IdCiudad, CorreoElectronico, Telefono)
values(nombre_,RFC_,calle_,colonia_,codigoP_,num_,idciudad_,correoelec_,telefono_);
end$$

CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `add_empleados` (IN `nombree_` VARCHAR(50), IN `appaterno_` VARCHAR(50), IN `apmaterno_` VARCHAR(50), IN `sexo_` VARCHAR(1), IN `correoelec_` VARCHAR(50), IN `telefono_` INT, IN `RFC_` VARCHAR(50), IN `NSS_` VARCHAR(20), IN `fechaing_` DATE, IN `idsucursal_` INT, IN `idCatEmple_` INT, IN `salarioDia_` DECIMAL(12,2), IN `PorcentajeComp_` DECIMAL(12,2), IN `idSitEmp_` INT, IN `es_usuario_` INT)  NO SQL
begin
    insert into empleados(
        NombreEmpleado,
        ApellidoPat,
        Apellidomat,
        Sexo,
        CorreoElectronico,
        Telefono,
        RFC, NSS,
        Fecha_ingreso,
        IdSucursal, 
        IdCategoriaEmpleado, 
        SalarioDiario, 
        PorcentajeCompensacion, 
        IdSituacionEmpleado, 
        es_usuario)
values(
        nombree_,
    appaterno_,apmaterno_,sexo_, correoelec_, telefono_, RFC_,NSS_,fechaing_,idsucursal_,idCatEmple_,salarioDia_,PorcentajeComp_,idSitEmp_,es_usuario_);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_inventario` (IN `precio_` INT, IN `descripcion_` VARCHAR(500), IN `incluye_` VARCHAR(500), IN `cantidad_` INT, IN `idunidadR_` INT, IN `idsucursal_` INT, IN `idtipounidad_` INT, IN `foto_` VARCHAR(300))  NO SQL
begin
    insert into inventario_unidades_renta(Precio, Descripcion, Incluye, cantidad, IdUnidadRenta, IdSucursal, IdTipoUnidades, foto)
values(precio_,descripcion_,incluye_,cantidad_,idunidadR_,idsucursal_,idtipounidad_,foto_);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_usuarios` (IN `idempleado_` INT, IN `usuario_` VARCHAR(50), IN `cotrasena_` VARCHAR(50), IN `idrol_` INT, IN `idsucursal_` INT, IN `estatus_` INT)  NO SQL
begin
    insert into usuarios(IdEmpleado,usuario,contrasena,IdRol,IdSucursal,estatus)
values(idempleado_,usuario_,cotrasena_,idrol_,idsucursal_,estatus_);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CALCULAR_TOTALES` (IN `p_idNominaSucursal` INT)  BEGIN
    UPDATE nominasucursal n INNER JOIN 
    (SELECT idNominaSucursal, SUM(SeptimoDia) sumSD, SUM(SueldoBase) sumSB, SUM(Sueldo) sumS, SUM(TotalExtras) sumE, SUM(Infonavit) sumI, SUM(Prestamo)  sumP, SUM(SaldoAnterior) sumA, SUM(Abono) sumAb, SUM(SueldoActual) sumSAc, SUM(SueldoNeto) sumSN
        FROM detallenominasucursal
        WHERE idNominaSucursal=p_idNominaSucursal) AS d 
    ON n.idNominaSucursal=d.idNominaSucursal
    SET n.TotalSeptimoDia=d.sumSD, n.TotalSueldoBase=d.sumSB,  n.TotalSueldo=d.sumS, n.TotalExtras=d.sumE,  n.TotalInfonavit=d.sumI,  n.TotalPrestamos=d.sumP, n.TotalSaldoAnterior=d.sumA, n.TotalAbono=d.sumAb, n.TotalSueldoActual=d.sumSAc, n.TotalSueldoNeto=d.sumSN;
END$$

CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `delete_cajachica` (IN `Idajachica_` INT)  NO SQL
begin
	delete from caja_chica where IdCajaChica=Idajachica_;
end$$

CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `delete_clientes` (IN `idcliente_` INT)  NO SQL
begin
	-- delete from clientes  where IdCliente=idcliente_ ;
    UPDATE clientes SET eliminado = 1 WHERE IdCliente=idcliente_;
end$$

CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `delete_empleado` (IN `idempleado_` INT)  NO SQL
begin
	-- delete from empleados where IdEmpleado=idempleado_;
    update empleados SET eliminado=1 where IdEmpleado=idempleado_;
    delete from usuarios where usuarios.IdEmpleado = idempleado_;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_inventario` (IN `IdInventarioU_` INT)  NO SQL
begin
	-- delete from inventario_unidades_renta where IdInventarioUnidadesRenta=IdInventarioU_;
    updatE inventario_unidades_renta SET eliminado = 1 WHERE IdInventarioUnidadesRenta = IdInventarioU_;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_servicio` (IN `IdServicio_` INT(11))  NO SQL
begin
	  update c_servicios set  eliminado = 1
       where IdServicio=IdServicio_;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_sucursal` (IN `IdSucursal_` INT(11))  NO SQL
update sucursales set  eliminado = 1 where IdSucursal=IdSucursal_$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_unidad_renta` (IN `IdUnidadRenta_` INT(11))  NO SQL
UPDATE unidades_renta SET eliminado = 1 WHERE IdUnidadRenta=IdUnidadRenta_$$

CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `delete_usuarios` (IN `idUsuario_` INT)  NO SQL
begin
	delete from usuarios where IdUsuario=idUsuario_;
end$$

CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `edit_cajachica` (IN `Idcajachica_` INT, IN `idsucursal_` INT, IN `idTipoMov_` INT, IN `descripcion_` VARCHAR(500), IN `monto_` DECIMAL(12,2))  NO SQL
begin
    update caja_chica set
     IdSucursal=idsucursal_, IdTipoMovimiento=idTipoMov_, Descripcion=descripcion_, Monto=monto_
    where IdCajaChica=Idcajachica_;
end$$

CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `edit_clientes` (IN `idcliente_` INT, IN `nombrec_` VARCHAR(50), IN `RFC_` VARCHAR(50), IN `calle_` VARCHAR(100), IN `colonia_` VARCHAR(100), IN `codigoP_` INT, IN `num_` INT, IN `idciudad_` INT, IN `correoelec_` VARCHAR(300), IN `telefono_` VARCHAR(50))  NO SQL
begin
    update clientes set  Nombre=nombrec_,RFC=RFC_,Calle=calle_,Colonia=colonia_,CodigoPostal=codigoP_, 
    Num=num_,IdCiudad=idciudad_,CorreoElectronico=correoelec_, Telefono=telefono_
    where IdCliente=idcliente_;
end$$

CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `edit_empleados` (IN `idempleado_` INT, IN `nombree_` VARCHAR(50), IN `appaterno_` VARCHAR(50), IN `apmaterno_` VARCHAR(50), IN `sexo_` VARCHAR(1), IN `correoelec_` VARCHAR(50), IN `telefono_` VARCHAR(25), IN `RFC_` VARCHAR(50), IN `NSS_` VARCHAR(20), IN `fechaing_` DATE, IN `idsucursal_` INT, IN `idCatEmple_` INT, IN `salarioDia_` DECIMAL(12,2), IN `PorcentajeComp_` DECIMAL(12,2), IN `idSitEmp_` INT, IN `es_usuario_` INT(1))  NO SQL
begin
    update empleados set NombreEmpleado=nombree_,ApellidoPat=appaterno_,Apellidomat=apmaterno_,
    Sexo=sexo_,
    CorreoElectronico=correoelec_, Telefono=telefono_,
    RFC=RFC_,NSS=NSS_,Fecha_ingreso=fechaing_,
idSucursal=idsucursal_,IdCategoriaEmpleado=idCatEmple_,SalarioDiario=salarioDia_,PorcentajeCompensacion=PorcentajeComp_,IdSituacionEmpleado=idSitEmp_,
es_usuario=es_usuario_
    where IdEmpleado=idempleado_;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_inventario` (IN `IdInventarioU_` INT, IN `precio_` INT, IN `descripcion_` VARCHAR(500), IN `incluye_` VARCHAR(500), IN `cantidad_` INT, IN `idunidadR_` INT, IN `idsucursal_` INT, IN `idtipounidad_` INT, IN `foto_` VARCHAR(300))  NO SQL
begin
    update inventario_unidades_renta set Precio=precio_,Descripcion=descripcion_, Incluye=incluye_, cantidad=cantidad_, IdUnidadRenta=idunidadR_, IdSucursal=idsucursal_,IdTipoUnidades=idtipounidad_, foto=foto_
    where IdInventarioUnidadesRenta=IdInventarioU_;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_servicio` (IN `IdServicio_` INT(11), IN `NombreServicio_` VARCHAR(50))  NO SQL
begin
    update c_servicios set  NombreServicio=NombreServicio_
    where IdServicio=IdServicio_;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_unidades_renta` (IN `IdUnidadRenta_` INT(11), IN `DesUnidad_` VARCHAR(500))  NO SQL
update unidades_renta set DesUnidad=DesUnidad_
    where IdUnidadRenta=IdUnidadRenta_$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_usuarios` (IN `idUsuario_` INT, IN `idempleado_` INT, IN `usuario_` VARCHAR(50), IN `cotrasena_` VARCHAR(50), IN `idrol_` INT, IN `idsucursal_` INT, IN `estatus_` INT)  NO SQL
begin
    update usuarios set IdEmpleado=idempleado_,usuario=usuario_,contrasena=cotrasena_,IdRol=idrol_,IdSucursal=idsucursal_,estatus=estatus_
where IdUsuario=idUsuario_;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_cajachica` (IN `buscar` VARCHAR(500), IN `sucursal` VARCHAR(100), IN `fechainicio` DATE, IN `fechatermino` DATE)  NO SQL
begin 
 if buscar ='' and sucursal= ''and fechainicio='' and fechatermino='' then 
	select * from caja_chica;
	
-- si buscar, sucursal y fecha inicio estan llenos, y fecha termino vacio.----
 else if buscar !=''and  sucursal != ''and  fechainicio !='' and fechatermino =''  then
        select * from caja_chica   where   Descripcion like concat('%', buscar, '%') and IdSucursal = sucursal
        -- IdSucursal like concat('%', sucursal, '%')
        
        and Fecha= fechainicio;
    
-- si buscar, fecha inicio, fecha termino estan llenos, y fecha inicio vacio--- 	
 else if buscar != ''and  sucursal != ''and  fechainicio ='' and fechatermino !=''  then
	select * from caja_chica   where   Descripcion like concat('%', buscar, '%') and IdSucursal = sucursal
    -- IdSucursal  like concat('%', sucursal, '%')
    and Fecha <= fechatermino;

-- si buscar, fecha inicio, fecha termino estan llenos, y sucursal vacios------	
 else if buscar != ''and sucursal = '' and  fechainicio !='' and fechatermino !=''  then
	select * from caja_chica   where   Descripcion like concat('%', buscar, '%')
    and Fecha = fechainicio and Fecha <= fechatermino;

-- si buscar esta lleno, y  sucursal fecha termino y fecha inicio estan vacios ----------
 else if buscar != ''and sucursal = '' and fechainicio ='' and fechatermino ='' then 
	select * from caja_chica   where   Descripcion like concat('%', buscar, '%');
	
-- si buscar esta vacio, y sucursal, fecha inicio, fecha termino estan llenos.----
 else if buscar ='' and  sucursal != '' and fechainicio !='' and fechatermino !=''  then
	select * from caja_chica where 
    IdSucursal = sucursal
 --   IdSucursal like concat('%', sucursal, '%')
    and Fecha BETWEEN fechainicio and  -- Fecha -- <= 
    fechatermino;

-- Manuel was here

-- si buscar y sucursal estan llenos,  y fecha inicio y fecha termino estan vacios.-- 
 else if buscar !=''and  sucursal != ''and fechainicio ='' and fechatermino =''  then
	select * from caja_chica   where   Descripcion like concat('%', buscar, '%') and IdSucursal = sucursal;
    -- IdSucursal  like concat('%', sucursal, '%');

-- si buscar y sucursal estan vacios y fecha inicio y fecha termino estan llenos.-- 
 else if buscar =''and  sucursal = ''and  fechainicio !='' and fechatermino !=''  then
        select * from caja_chica   where   Fecha  BETWEEN fechainicio and fechatermino;
        
-- si fecha termino llena y todo lo demas vacio----
 else if buscar =''and  sucursal = ''and  fechainicio ='' and fechatermino !=''  then
        select * from caja_chica   where   Fecha  <= fechatermino;
        
        -- si fecha inicio llena y todo lo demas vacio----
 else if buscar =''and  sucursal = ''and  fechainicio !='' and fechatermino =''  then
        select * from caja_chica   where   Fecha  = fechainicio;
        
-- si solo sucursal esta llena y todo lo demas vacio ---
        else if buscar =''and  sucursal != ''and  fechainicio ='' and fechatermino =''  then
        select * from caja_chica   where IdSucursal = sucursal;
        -- IdSucursal  like concat('%', sucursal, '%');
        
-- si todos los campos estan llenos ----
else if buscar !=''and  sucursal != ''and  fechainicio !='' and fechatermino !=''  then	
  select * from caja_chica   where   Descripcion like concat('%', buscar, '%') and IdSucursal = sucursal
--  IdSucursal  like concat('%', sucursal, '%')
  and Fecha BETWEEN fechainicio and fechatermino;

end if;
end if;
end if;
end if;
end if;	
end if;
end if;	
end if; 
end if;	
end if; 
end if;
end if;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_cajachica_id` (IN `idcaja_` INT(11))  NO SQL
begin
	select * from caja_chica WHERE IdCajaChica=idcaja_;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_clientes` (IN `buscar` VARCHAR(500))  NO SQL
if buscar = ''  then 
		select * from clientes WHERE eliminado=0;
    else if buscar != '' then 
		select * from clientes  WHERE Nombre like concat('%',buscar,'%' ) AND eliminado=0;
    end if;
    end If$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_cliente_id` (IN `idcliente_` INT(11))  NO SQL
begin
	select * from clientes WHERE IdCliente=idcliente_;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_empleados` (IN `PSearcha` VARCHAR(500), IN `PidSucursal` VARCHAR(100))  NO SQL
begin 
	if PSearcha = '' and PidSucursal = '' then 
		select * from empleados  WHERE eliminado=0;
	end if;
	if PSearcha !='' and PidSucursal= '' then
		select * from empleados  where NombreEmpleado LIKE CONCAT('%', PSearcha , '%') OR ApellidoPat LIKE CONCAT('%', PSearcha , '%') OR Apellidomat LIKE CONCAT('%', PSearcha , '%')  AND eliminado=0;
	end if;
	if PSearcha = '' and PidSucursal != '' then
		select * from empleados where IdSucursal = PidSucursal  AND eliminado=0;
	end if;
	if PSearcha != '' and PidSucursal >0 then 
		select * from empleados WHERE IdSucursal = PidSucursal AND NombreEmpleado LIKE CONCAT('%', PSearcha , '%') OR ApellidoPat LIKE CONCAT('%', PSearcha , '%') OR Apellidomat LIKE CONCAT('%', PSearcha , '%') AND eliminado=0;
	end if;
end$$

CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `get_empleado_id` (IN `idempleado_` INT)  NO SQL
begin
	select * from empleados WHERE IdEmpleado=idempleado_;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_IdOrden_cotizacion_ByDateAndSuc` (IN `FechaCaptura_` DATE, IN `IdSucursal_` INT(11), IN `for_operation` VARCHAR(50), IN `estatus` INT(1))  NO SQL
begin 

-- estatus: 0=cotizaciones / 1=orden

if for_operation = 'rentas' then

	if estatus = 0 then
		SELECT max(IdOrden) as IdOrden, Folio_cotizacion, FechaCaptura, IdSucursal FROM orden_rentas WHERE FechaCaptura = FechaCaptura_ AND IdSucursal=IdSucursal_
		GROUP BY Folio_cotizacion;
	if estatus = 1 then
		SELECT max(IdOrden) as IdOrden, Folio_orden, FechaOrden, IdSucursal FROM orden_rentas WHERE FechaOrden = FechaCaptura_ AND IdSucursal=IdSucursal_
		GROUP BY Folio_orden;

if for_operation = 'servicios' then

	if estatus = 0 then
			SELECT max(IdOrden) as IdOrden, Folio_cotizacion, FechaCaptura, IdSucursal FROM orden_servicios WHERE FechaCaptura = FechaCaptura_ AND IdSucursal=IdSucursal_
			GROUP BY Folio_orden;
	if estatus = 1 then
			SELECT max(IdOrden) as IdOrden, Folio_cotizacion, FechaOrden, IdSucursal FROM orden_servicios WHERE FechaOrden = FechaCaptura_ AND IdSucursal=IdSucursal_
			GROUP BY Folio_orden;

end if;
end if;
end if;
end if;
end if;
end if;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_inventarios` (IN `buscar` VARCHAR(500), IN `sucursal` VARCHAR(100))  NO SQL
begin 
	if buscar = '' and sucursal = '' then 

		SELECT * FROM 
			inventario_unidades_renta as inventario, 
			unidades_renta as unidades, 
			c_tipo_unidades as tipos 
    	WHERE
    		inventario.IdUnidadRenta = unidades.IdUnidadRenta AND 
        	inventario.IdTipoUnidades = tipos.IdTipoUnidades
            AND inventario.eliminado = 0
            ;-- AND inventario.IdSucursal=sucursal;

	else if buscar !='' and sucursal= '' then

		SELECT * FROM 
			inventario_unidades_renta as inventario, 
			unidades_renta as unidades, 
			c_tipo_unidades as tipos 
    	WHERE
    		inventario.IdUnidadRenta = unidades.IdUnidadRenta AND 
        	inventario.IdTipoUnidades = tipos.IdTipoUnidades AND 
        	-- inventario.IdSucursal=sucursal AND
            unidades.DesUnidad LIKE CONCAT('%', buscar, '%')
				AND inventario.eliminado = 0;
	else if buscar = '' and sucursal != '' then

		SELECT * FROM 
			inventario_unidades_renta as inventario, 
			unidades_renta as unidades, 
			c_tipo_unidades as tipos 
    	WHERE
    		inventario.IdUnidadRenta = unidades.IdUnidadRenta AND 
        	inventario.IdTipoUnidades = tipos.IdTipoUnidades AND 
            inventario.IdSucursal = sucursal 
        	-- inventario.IdSucursal  LIKE CONCAT('%', sucursal, '%') 
            AND inventario.IdSucursal=sucursal
            AND inventario.eliminado = 0;
 -- =sucursal 
            -- AND unidades.DesUnidad;

	else if buscar != '' and sucursal != '' then

		SELECT * FROM 
			inventario_unidades_renta as inventario, 
			unidades_renta as unidades, 
			c_tipo_unidades as tipos 
    	WHERE
    		inventario.IdUnidadRenta = unidades.IdUnidadRenta AND 
        	inventario.IdTipoUnidades = tipos.IdTipoUnidades AND 
        	inventario.IdSucursal=sucursal AND unidades.DesUnidad LIKE CONCAT('%', buscar, '%') AND inventario.eliminado = 0;

	end if ;
	end if ; 
	end if ; 
	end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_inventario_id` (IN `IdInventarioUnidadesRenta_` INT)  NO SQL
begin
	select * from 
    	inventario_unidades_renta as inventario, 
        unidades_renta as unidades, 
        c_tipo_unidades as tipos 
	WHERE
    	inventario.IdUnidadRenta = unidades.IdUnidadRenta AND 
        inventario.IdTipoUnidades = tipos.IdTipoUnidades
        -- AND inventario.IdSucursal=
    	AND IdInventarioUnidadesRenta=IdInventarioUnidadesRenta_;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_servicios` (IN `buscar` VARCHAR(500))  NO SQL
if buscar = ''  then 
		select * from c_servicios WHERE eliminado=0;
    else if buscar != '' then 
		select * from c_servicios  WHERE NombreServicio like concat('%',buscar,'%' ) AND eliminado=0;
    end if;
    end If$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_servicios_id` (IN `IdSucursalServicio_` INT)  NO SQL
begin
	SELECT * FROM 
    	sucursal_servicio, 
        c_servicios, 
        tamano_servicios
	WHERE 
    	c_servicios.IdServicio = sucursal_servicio.IdServicio
        AND sucursal_servicio.IdSucursalServicio = IdSucursalServicio_ 
        -- sucursal_servicio.IdServicio
        AND tamano_servicios.id=sucursal_servicio.IdTamano;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_servicio_id` (IN `IdServicio_` INT(11))  NO SQL
begin
	select * from c_servicios WHERE IdServicio=IdServicio_;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_unidades_renta` (IN `buscar` VARCHAR(500))  NO SQL
if buscar = ''  then 
		select * from unidades_renta WHERE eliminado=0;
    else if buscar != '' then 
		select * from unidades_renta  WHERE DesUnidad like concat('%',buscar,'%' ) AND eliminado=0;
    end if;
    end If$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_unidades_renta_Id` (IN `IdUnidadRenta_` INT(11))  NO SQL
select * from unidades_renta WHERE IdUnidadRenta=IdUnidadRenta_$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_usuarios` (IN `buscar` VARCHAR(500), IN `sucursal` VARCHAR(100))  NO SQL
begin 
if buscar = '' and sucursal = '' then 
select * from usuarios;
else if buscar !='' and  sucursal= '' then
select * from usuarios where usuario LIKE CONCAT('%', buscar , '%');
else if buscar = '' and sucursal != '' then 
select * from usuarios where  IdSucursal = sucursal;
else if buscar != '' and sucursal != '' then 
select * from usuarios  WHERE  usuario LIKE CONCAT('%', buscar , '%') and IdSucursal = sucursal;

end if ;
end if ; 
end if ; 
end if;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_usuario_id` (IN `IdUsuario_` INT(11))  NO SQL
begin
	select * from usuarios WHERE IdUsuario=IdUsuario_;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERTAR_NOMINA` (IN `p_idSucursal` INT, IN `p_NoSemana` INT, IN `p_FechaInicio` DATE, IN `p_FechaTermino` DATE)  BEGIN 

	DECLARE v_idNomina INT(1);

    INSERT INTO nominasucursal(idSucursal, NoSemana, FechaInicio, FechaTermino)
    VALUES (p_IdSucursal, p_NoSemana, p_FechaInicio, p_FechaTermino);

    INSERT INTO detallenominasucursal (idNominaSucursal,idEmpleado, idCategoriaEmpleado, NoDiasTrabajados, SeptimoDia, SueldoBase, Sueldo, TotalExtras, Infonavit, Prestamo, SaldoAnterior, Abono, SueldoActual, SueldoNeto)
    SELECT 
        (SELECT MAX(idNominaSucursal) FROM nominasucursal),
        emp.IdEmpleado,
        emp.IdCategoriaEmpleado,
        6,
        emp.SalarioDiario,
        emp.SalarioDiario,
        ((emp.SalarioDiario*6)+emp.SalarioDiario),
        (SELECT subtotal FROM detalleprenominaextras WHERE idEmpleado=emp.IdEmpleado LIMIT 1),
        (SELECT inf.MontoRetener FROM empleadoInfonavit inf WHERE inf.IdEmpleado = emp.IdEmpleado AND inf.Liquido = 0 AND inf.Status=0 LIMIT 1),
        (SELECT MontoPrestamo FROM empleadoprestamo pres WHERE pres.IdEmpleado=emp.IdEmpleado AND Liquido=0 AND Status=0 LIMIT 1),
        (SELECT MontoRestante FROM empleadoprestamo pres WHERE pres.IdEmpleado=emp.IdEmpleado AND Liquido=0 AND Status=0 LIMIT 1),
        (SELECT AbonoBase FROM empleadoprestamo pres WHERE pres.IdEmpleado=emp.IdEmpleado AND Liquido=0 AND Status=0 LIMIT 1),
        ((SELECT MontoRestante FROM empleadoprestamo pres WHERE pres.IdEmpleado=emp.IdEmpleado AND Liquido=0 AND Status=0 LIMIT 1)-(SELECT AbonoBase FROM empleadoprestamo pres WHERE pres.IdEmpleado=emp.IdEmpleado AND Liquido=0 AND Status=0 LIMIT 1)),
        ((((emp.SalarioDiario*6)+emp.SalarioDiario)+(SELECT EXISTS_EXTRAS(emp.IdEmpleado)))-((SELECT EXISTS_INFONAVIT(emp.IdEmpleado))+(SELECT EXISTS_PRESTAMO(emp.IdEmpleado))))
    FROM empleados emp WHERE IdSucursal=p_idSucursal;
    
    SET v_idNomina := (SELECT MAX(idNominaSucursal) FROM nominasucursal);
    
    CALL CALCULAR_TOTALES(v_idNomina);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PROC_ADD_EXTRAS` (IN `p_NomExtra` VARCHAR(100), IN `p_MontoSugerido` DECIMAL(12,2))  NO SQL
BEGIN INSERT INTO extras VALUES (NULL, p_NomExtra, p_MontoSugerido, 0); CALL PROC_ADD_EXTRAS_SUCURSAL(last_insert_id()); END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PROC_ADD_EXTRAS_SUCURSAL` (IN `p_idExtra` INT)  NO SQL
BEGIN INSERT INTO extrasucursal (idExtra,idSucursal,MontoSugerido,Status) SELECT (SELECT IdExtra FROM extras WHERE IdExtra=p_idExtra), s.IdSucursal, (SELECT MontoSugerido FROM extras WHERE IdExtra=p_idExtra), (SELECT Status FROM extras WHERE IdExtra=p_idExtra) FROM sucursales s; END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Proc_Calc_SubTotal` (IN `id` INT)  NO SQL
BEGIN DECLARE v_subtotal DECIMAL(12,2); SELECT (monto * cantiad) INTO v_subtotal
FROM detalleprenominaextras WHERE idDetallePrenominaExtras = id; CALL Proc_Update_SubTotal(v_subtotal);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Proc_Update_SubTotal` (IN `MontoCantidad` DECIMAL(12,2))  NO SQL
BEGIN 
UPDATE detalleprenominaextras dpe SET dpe.subtotal = MontoCantidad;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sign_in` (IN `usuario_` VARCHAR(50), IN `contrasena_` VARCHAR(300))  NO SQL
begin
	select * from usuarios where usuario=usuario_ and contrasena=contrasena_;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `track` (IN `id_` INT)  NO SQL
SELECT * FROM 
				inventario_unidades_renta as inventario,
				unidades_renta as unidades,
				c_tipo_unidades as tipos,
				_cotizaciones_cart_rentas as carrito, 
				orden_rentas as ordenes,
				municipio, 
				clientes 
			WHERE 
					inventario.IdUnidadRenta = unidades.IdUnidadRenta AND 
					inventario.IdTipoUnidades = tipos.IdTipoUnidades AND
	carrito.IdInventarioUnidadesRenta = id_ AND inventario.IdInventarioUnidadesRenta = id_ AND
				municipio.idm=ordenes.IdCiudad AND 
				ordenes.IdCliente = clientes.IdCliente
				AND carrito.recuperado=0 AND ordenes.clave_unica = carrito.clave_unica AND carrito.es_orden = 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_ACTUALIZAR_NOMINA` (IN `p_idDetalleNominaSucursal` INT, IN `p_idNominaSucursal` INT, IN `p_NoDiasTrabajados` INT, IN `p_SeptimoDia` DECIMAL(12,2), IN `p_SueldoBase` DECIMAL(12,2), IN `p_Sueldo` DECIMAL(12,2), IN `p_TotalExtras` DECIMAL(12,2), IN `p_Infonavit` DECIMAL(12,2), IN `p_Prestamo` DECIMAL(12,2), IN `p_SaldoAnterior` DECIMAL(12,2), IN `p_Abono` DECIMAL(12,2), IN `p_SueldoActual` DECIMAL(12,2), IN `p_SueldoNeto` DECIMAL(12,2), IN `p_ComentariosSucursal` TEXT, IN `p_ComentariosMatriz` TEXT)  BEGIN

	DECLARE v_id INT(1);
    
	UPDATE detallenominasucursal dns SET dns.NoDiasTrabajados=p_NoDiasTrabajados, dns.SeptimoDia=p_SeptimoDia, 
	dns.SueldoBase=p_SueldoBase, dns.Sueldo=p_Sueldo, dns.TotalExtras=p_TotalExtras, dns.Infonavit=p_Infonavit, 
	dns.Prestamo=p_Prestamo, dns.SaldoAnterior=p_SaldoAnterior, dns.Abono=p_Abono, dns.SueldoActual=p_SueldoActual, 
	dns.SueldoNeto=p_SueldoNeto, dns.ComentariosSucursal=p_ComentariosSucursal, dns.ComentariosMatriz=p_ComentariosMatriz 
	WHERE dns.idDetalleNominaSucursal=p_idDetalleNominaSucursal;
    
    SET v_id:= p_idNominaSucursal;
    
    CALL CALCULAR_TOTALES(v_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_CALCULAR_TOTALES` (IN `p_idNominaSucursal` INT)  BEGIN
    UPDATE nominasucursal n INNER JOIN 
    (SELECT idNominaSucursal, SUM(SeptimoDia) sumSD, SUM(SueldoBase) sumSB, SUM(Sueldo) sumS, SUM(TotalExtras) sumE, SUM(Infonavit) sumI, SUM(Prestamo)  sumP, SUM(SaldoAnterior) sumA, SUM(Abono) sumAb, SUM(SueldoActual) sumSAc, SUM(SueldoNeto) sumSN
        FROM detallenominasucursal
        WHERE idNominaSucursal=p_idNominaSucursal) AS d 
    ON n.idNominaSucursal=d.idNominaSucursal
    SET n.TotalSeptimoDia=d.sumSD, n.TotalSueldoBase=d.sumSB,  n.TotalSueldo=d.sumS, n.TotalExtras=d.sumE,  n.TotalInfonavit=d.sumI,  n.TotalPrestamos=d.sumP, n.TotalSaldoAnterior=d.sumA, n.TotalAbono=d.sumAb, n.TotalSueldoActual=d.sumSAc, n.TotalSueldoNeto=d.sumSN;
END$$

--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `EXISTS_EXTRAS` (`Empleado` INT) RETURNS DECIMAL(12,2) BEGIN
    DECLARE v_extras DECIMAL(12,2) DEFAULT 0;
    
    IF EXISTS (SELECT subtotal FROM detalleprenominaextras WHERE idEmpleado=Empleado LIMIT 1) THEN 
        SELECT subtotal INTO v_extras FROM detalleprenominaextras WHERE idEmpleado=Empleado LIMIT 1; 
    END IF;
    
    RETURN v_extras;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `EXISTS_INFONAVIT` (`Empleado` INT) RETURNS DECIMAL(12,2) BEGIN
    DECLARE v_infonavit DECIMAL DEFAULT 0;
    
    IF EXISTS(SELECT MontoRetener FROM empleadoinfonavit WHERE IdEmpleado=Empleado AND Liquido = 0 AND Status = 0) THEN
        SELECT MontoRetener INTO v_infonavit FROM empleadoinfonavit WHERE IdEmpleado=Empleado AND Liquido = 0 AND Status = 0;
    END IF;
    
    RETURN v_infonavit;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `EXISTS_PRESTAMO` (`Empleado` INT) RETURNS DECIMAL(12,2) BEGIN
    DECLARE v_prestamo DECIMAL(12,2) DEFAULT 0;
    
    IF EXISTS(SELECT AbonoBase FROM empleadoprestamo WHERE IdEmpleado=Empleado AND Liquido=0 AND Status=0) THEN
        SELECT AbonoBase INTO v_prestamo FROM empleadoprestamo WHERE IdEmpleado=Empleado AND Liquido=0 AND Status=0;
    END IF;
    
    RETURN v_prestamo;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `Nombre_Empleado` (`idempleado` INT(11), `idsucursal` INT(11)) RETURNS VARCHAR(40) CHARSET latin1 COLLATE latin1_bin NO SQL
BEGIN 

DECLARE
nombre varchar(40);
SELECT (e.NombreEmpleado||' '||e.ApellidoPat||' '||e.Apellidomat) 
	INTO nombre
    FROM empleados e
    where e.IdEmpleado = idempleado AND e.IdSucursal = idsucursal;

RETURN nombre;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_chica`
--

CREATE TABLE `caja_chica` (
  `IdCajaChica` int(11) NOT NULL,
  `IdSucursal` int(11) DEFAULT NULL,
  `IdTipoMovimiento` int(11) DEFAULT NULL,
  `Descripcion` varchar(255) NOT NULL,
  `Monto` decimal(12,2) NOT NULL,
  `IdEmpleado` int(11) DEFAULT NULL,
  `Fecha` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `choferes_entregan`
--

CREATE TABLE `choferes_entregan` (
  `id` int(11) NOT NULL,
  `clave_unica` varchar(50) NOT NULL,
  `id_chofer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `choferes_recuperan`
--

CREATE TABLE `choferes_recuperan` (
  `id` int(11) NOT NULL,
  `clave_unica` varchar(50) NOT NULL,
  `id_chofer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `IdCliente` int(11) NOT NULL,
  `Nombre` varchar(40) NOT NULL,
  `RFC` varchar(18) NOT NULL,
  `Calle` varchar(50) NOT NULL,
  `Colonia` varchar(50) NOT NULL,
  `CodigoPostal` varchar(5) NOT NULL,
  `Num` int(11) DEFAULT NULL,
  `IdCiudad` int(11) DEFAULT NULL,
  `CorreoElectronico` varchar(300) NOT NULL,
  `Telefono` varchar(13) NOT NULL,
  `eliminado` int(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`IdCliente`, `Nombre`, `RFC`, `Calle`, `Colonia`, `CodigoPostal`, `Num`, `IdCiudad`, `CorreoElectronico`, `Telefono`, `eliminado`) VALUES
(1, 'Juan Enrrique Garcia Ortiz', 'jego892564qy0', 'Francisco  I madero', 'zona centro', '36970', 7500, 27, 'jfllpruebas@gmail.com', '6253221478', 0),
(2, 'Maria Guadalupe Martinez Zavala', 'MAZM980902MTS', 'Gonzalitos', 'Colonia Villas', '95440', 12587, 155, 'karenia_pca@hotmail.com', '8342156970', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_categoria_empleado`
--

CREATE TABLE `c_categoria_empleado` (
  `IdCategoriaEmpleado` int(11) NOT NULL,
  `DesCategoriaEmpleado` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `c_categoria_empleado`
--

INSERT INTO `c_categoria_empleado` (`IdCategoriaEmpleado`, `DesCategoriaEmpleado`) VALUES
(1, 'Administrador general'),
(2, 'Administrador de sucursal'),
(3, 'Aux de administrador de sucursal'),
(4, 'Operativo'),
(5, 'Contable');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_roles`
--

CREATE TABLE `c_roles` (
  `IdRol` int(11) NOT NULL,
  `Rol` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `c_roles`
--

INSERT INTO `c_roles` (`IdRol`, `Rol`) VALUES
(1, 'Administrador general'),
(2, 'Administrador de sucursal'),
(3, 'Aux de administrador de sucursal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_servicios`
--

CREATE TABLE `c_servicios` (
  `IdServicio` int(11) NOT NULL,
  `NombreServicio` varchar(50) NOT NULL,
  `eliminado` int(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `c_servicios`
--

INSERT INTO `c_servicios` (`IdServicio`, `NombreServicio`, `eliminado`) VALUES
(1, 'DESAZOLVE DE FOSA SéPTICA  (Chica)', 0),
(2, 'DESAZOLVE DE FOSA SéPTICA  (Grande)', 0),
(3, 'LIMPIEZA (CHICA)', 0),
(4, 'LIMPIEZA (GRANDE)', 0),
(5, 'LIMPIEZA DE TUBERIA A ALTA PRESION', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_situacion_monetaria`
--

CREATE TABLE `c_situacion_monetaria` (
  `id_situacion_monetaria` int(11) NOT NULL,
  `Descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `c_situacion_monetaria`
--

INSERT INTO `c_situacion_monetaria` (`id_situacion_monetaria`, `Descripcion`) VALUES
(1, 'Por cobrar'),
(2, 'Cobrada (sin factura)'),
(3, 'Cobrada (con factura)'),
(4, 'Facturado (sin cobrar)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_situacion_nominas`
--

CREATE TABLE `c_situacion_nominas` (
  `idSituacion_nomina` int(11) NOT NULL,
  `DesSituacionNomina` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `c_situacion_nominas`
--

INSERT INTO `c_situacion_nominas` (`idSituacion_nomina`, `DesSituacionNomina`) VALUES
(0, 'Aceptada'),
(1, 'Rechazada'),
(2, 'Propuesta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_situacion_ubicacion`
--

CREATE TABLE `c_situacion_ubicacion` (
  `id_situacion_ubicacion` int(11) NOT NULL,
  `Descripcion` varchar(50) DEFAULT NULL,
  `id_c_situacion_ubicacion_actividades` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `c_situacion_ubicacion`
--

INSERT INTO `c_situacion_ubicacion` (`id_situacion_ubicacion`, `Descripcion`, `id_c_situacion_ubicacion_actividades`) VALUES
(1, 'Por entregar', 1),
(2, 'Entregado', 1),
(3, 'Recuperado', 1),
(4, 'Por realizar', 2),
(5, 'Realizado', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_situacion_ubicacion_actividades`
--

CREATE TABLE `c_situacion_ubicacion_actividades` (
  `id_c_situacion_ubicacion_actividades` int(11) NOT NULL,
  `tipo_actividad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `c_situacion_ubicacion_actividades`
--

INSERT INTO `c_situacion_ubicacion_actividades` (`id_c_situacion_ubicacion_actividades`, `tipo_actividad`) VALUES
(1, 'Rentas'),
(2, 'Servicios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_tipo_movimiento`
--

CREATE TABLE `c_tipo_movimiento` (
  `IdTipoMovimiento` int(11) NOT NULL,
  `DesTipoMovimiento` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `c_tipo_movimiento`
--

INSERT INTO `c_tipo_movimiento` (`IdTipoMovimiento`, `DesTipoMovimiento`) VALUES
(1, 'DEPOSITO'),
(2, 'RETIRO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_tipo_sucursal`
--

CREATE TABLE `c_tipo_sucursal` (
  `IdTipoSucursal` int(11) NOT NULL,
  `TipoSucursal` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `c_tipo_sucursal`
--

INSERT INTO `c_tipo_sucursal` (`IdTipoSucursal`, `TipoSucursal`) VALUES
(1, 'SUCURSAL'),
(2, 'MATRIZ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_tipo_unidades`
--

CREATE TABLE `c_tipo_unidades` (
  `IdTipoUnidades` int(11) NOT NULL,
  `DescTipoUnidad` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `c_tipo_unidades`
--

INSERT INTO `c_tipo_unidades` (`IdTipoUnidades`, `DescTipoUnidad`) VALUES
(1, 'SENCILLO'),
(2, 'DOBLE'),
(3, '4 X 5'),
(4, 'Sin tipo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallenominasucursal`
--

CREATE TABLE `detallenominasucursal` (
  `idDetalleNominaSucursal` int(11) NOT NULL,
  `idNominaSucursal` int(11) DEFAULT NULL,
  `idEmpleado` int(11) DEFAULT NULL,
  `idCategoriaEmpleado` int(11) DEFAULT NULL,
  `NoDiasTrabajados` int(11) DEFAULT NULL,
  `SeptimoDia` decimal(12,2) DEFAULT NULL,
  `SueldoBase` decimal(12,2) DEFAULT NULL,
  `Sueldo` decimal(12,2) DEFAULT NULL,
  `TotalExtras` decimal(12,2) DEFAULT NULL,
  `Infonavit` decimal(12,2) DEFAULT NULL,
  `Prestamo` decimal(12,2) DEFAULT NULL,
  `SaldoAnterior` decimal(12,2) DEFAULT NULL,
  `Abono` decimal(12,2) DEFAULT NULL,
  `SueldoActual` decimal(12,2) DEFAULT NULL,
  `SueldoNeto` decimal(12,2) DEFAULT NULL,
  `ComentariosSucursal` text,
  `ComentariosMatriz` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleprenominaextras`
--

CREATE TABLE `detalleprenominaextras` (
  `idDetallePrenominaExtras` int(11) NOT NULL,
  `idPrenominaExtra` int(11) DEFAULT NULL,
  `idEmpleado` int(11) DEFAULT NULL,
  `idExtraSucursal` int(11) DEFAULT NULL,
  `monto` decimal(12,2) DEFAULT NULL,
  `cantiad` int(11) DEFAULT NULL,
  `comentarios` varchar(255) DEFAULT NULL,
  `idSituacionPrenomina` int(11) DEFAULT NULL,
  `subtotal` decimal(12,2) DEFAULT '0.00',
  `ComentarioMatriz` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleadoinfonavit`
--

CREATE TABLE `empleadoinfonavit` (
  `IdEmpleadoInfonavit` int(11) NOT NULL,
  `IdEmpleado` int(11) DEFAULT NULL,
  `MontoCreditoInfonavit` decimal(12,2) DEFAULT NULL,
  `MontoRetener` decimal(12,2) DEFAULT NULL,
  `MontoRestanteRetener` decimal(12,2) DEFAULT NULL,
  `FechaCaptura` datetime DEFAULT NULL,
  `IdEmpleadoCaptura` int(11) DEFAULT NULL,
  `IdEmpleadoElimina` int(11) DEFAULT NULL,
  `FechaElimina` datetime DEFAULT NULL,
  `Liquido` int(1) DEFAULT NULL,
  `Comentario` text,
  `Status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleadoprestamo`
--

CREATE TABLE `empleadoprestamo` (
  `IdEmpleadoPrestamo` int(11) NOT NULL,
  `IdEmpleado` int(11) NOT NULL,
  `MontoPrestamo` decimal(12,2) NOT NULL,
  `NoSemanasAPagar` int(11) NOT NULL,
  `AbonoBase` decimal(12,2) NOT NULL,
  `MontoRestante` decimal(12,2) NOT NULL,
  `FechaInicio` date NOT NULL,
  `IdEmpleadoCaptura` int(11) NOT NULL,
  `FechaCaptura` datetime NOT NULL,
  `IdEmpleadoElimina` int(11) DEFAULT NULL,
  `FechaElimina` datetime DEFAULT NULL,
  `Liquido` int(1) NOT NULL,
  `Comentarios` text,
  `Status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `IdEmpleado` int(11) NOT NULL,
  `NombreEmpleado` varchar(50) NOT NULL,
  `ApellidoPat` varchar(50) NOT NULL,
  `Apellidomat` varchar(50) NOT NULL,
  `Sexo` varchar(1) NOT NULL,
  `CorreoElectronico` varchar(50) NOT NULL,
  `Telefono` varchar(25) NOT NULL,
  `RFC` varchar(15) NOT NULL,
  `NSS` varchar(20) DEFAULT NULL,
  `Fecha_ingreso` date NOT NULL,
  `IdSucursal` int(11) DEFAULT NULL,
  `IdCategoriaEmpleado` int(11) DEFAULT NULL,
  `SalarioDiario` decimal(12,2) DEFAULT '0.00',
  `PorcentajeCompensacion` decimal(12,2) DEFAULT NULL,
  `IdSituacionEmpleado` int(11) DEFAULT NULL,
  `es_usuario` int(1) NOT NULL,
  `eliminado` int(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`IdEmpleado`, `NombreEmpleado`, `ApellidoPat`, `Apellidomat`, `Sexo`, `CorreoElectronico`, `Telefono`, `RFC`, `NSS`, `Fecha_ingreso`, `IdSucursal`, `IdCategoriaEmpleado`, `SalarioDiario`, `PorcentajeCompensacion`, `IdSituacionEmpleado`, `es_usuario`, `eliminado`) VALUES
(1, 'Victoria Administrador General', 'Ramirez', 'Salinas', 'M', '1@host.com', '8342557895', 'RFC1111111111', '1-0-3', '2019-12-31', 1, 1, '1001.00', '50.25', 1, 0, 0),
(21, 'Administrador Orizaba ', 'Castro Lejos', 'Castro Alejos', 'F', 'ASO@GMAIL.COM', '2147483647', 'CAAK980509MT', '781698892644', '2020-01-01', 11, 2, '300.00', '30.00', 1, 1, 0),
(27, 'Chofer Victoria', 'Zavala ', 'Hernanadez', 'M', 'chofervictoria@gmail.com', '2147483647', 'CVtr768598y9o', '222222222222', '2020-02-03', 1, 4, '70.00', '10.00', 1, 0, 0),
(26, 'Chofer Orizaba', 'Dominguez', 'Lara', 'M', 'choferorizaba@gmail.com', '2147483647', 'DOLC890902MTS', '15615210894561', '2020-02-06', 11, 4, '70.00', '10.00', 1, 0, 0),
(25, 'Auxiliar Orizaba', 'Carmona', 'Rivera', 'M', 'aaso@gmail.com', '2147483647', 'CARU908765MLS', '2218485151878515', '2020-02-15', 11, 3, '100.00', '10.00', 1, 1, 0),
(24, 'Auiliar Victoria', 'Trejo', 'Valladares', 'M', 'av@gmail.com', '2147483647', 'lolf456789qy9', '14141414141414', '2020-02-03', 1, 3, '100.00', '10.00', 1, 1, 0),
(22, 'Administrador Valles', ' Garcia ', 'Luna', 'M', 'asva@gmail.com', '2147483647', 'lolf780521ty0', '121212121212', '2020-02-03', 12, 2, '300.00', '30.00', 1, 1, 0),
(23, 'Administrador victoria', 'sosa ', 'luna', 'M', 'asvic@gmail.com', '2147483647', 'lolf780521qy0', '131313131313', '2020-02-03', 1, 2, '300.00', '30.00', 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entidad`
--

CREATE TABLE `entidad` (
  `cve_ent` varchar(2) NOT NULL,
  `nom_ent` varchar(50) NOT NULL,
  `nom_abr` varchar(10) NOT NULL,
  `fechaModificacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_pais` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entidad`
--

INSERT INTO `entidad` (`cve_ent`, `nom_ent`, `nom_abr`, `fechaModificacion`, `id_pais`) VALUES
('01', 'Aguascalientes', 'Ags.', '2019-07-16 09:23:36', 'MX'),
('02', 'Baja California', 'BC', '2019-07-16 09:23:37', 'MX'),
('03', 'Baja California Sur', 'BCS', '2019-07-16 09:23:37', 'MX'),
('04', 'Campeche', 'Camp.', '2019-07-16 09:23:37', 'MX'),
('05', 'Coahuila de Zaragoza', 'Coah.', '2019-07-16 09:23:37', 'MX'),
('06', 'Colima', 'Col.', '2019-07-16 09:23:37', 'MX'),
('07', 'Chiapas', 'Chis.', '2019-07-16 09:23:37', 'MX'),
('08', 'Chihuahua', 'Chih.', '2019-07-16 09:23:37', 'MX'),
('09', 'Distrito Federal', 'DF', '2019-07-16 09:23:37', 'MX'),
('10', 'Durango', 'Dgo.', '2019-07-16 09:23:37', 'MX'),
('11', 'Guanajuato', 'Gto.', '2019-07-16 09:23:37', 'MX'),
('12', 'Guerrero', 'Gro.', '2019-07-16 09:23:37', 'MX'),
('13', 'Hidalgo', 'Hgo.', '2019-07-16 09:23:38', 'MX'),
('14', 'Jalisco', 'Jal.', '2019-07-16 09:23:38', 'MX'),
('15', 'México', 'Mex.', '2019-07-16 09:23:38', 'MX'),
('16', 'Michoacán de Ocampo', 'Mich.', '2019-07-16 09:23:38', 'MX'),
('17', 'Morelos', 'Mor.', '2019-07-16 09:23:38', 'MX'),
('18', 'Nayarit', 'Nay.', '2019-07-16 09:23:38', 'MX'),
('19', 'Nuevo León', 'NL', '2019-07-16 09:23:38', 'MX'),
('20', 'Oaxaca', 'Oax.', '2019-07-16 09:23:38', 'MX'),
('21', 'Puebla', 'Pue.', '2019-07-16 09:23:38', 'MX'),
('22', 'Querétaro', 'Qro.', '2019-07-16 09:23:38', 'MX'),
('23', 'Quintana Roo', 'Q. Roo', '2019-07-16 09:23:38', 'MX'),
('24', 'San Luis Potosí', 'SLP', '2019-07-16 09:23:38', 'MX'),
('25', 'Sinaloa', 'Sin.', '2019-07-16 09:23:38', 'MX'),
('26', 'Sonora', 'Son.', '2019-07-16 09:23:39', 'MX'),
('27', 'Tabasco', 'Tab.', '2019-07-16 09:23:39', 'MX'),
('28', 'Tamaulipas', 'Tamps.', '2019-07-16 09:23:39', 'MX'),
('29', 'Tlaxcala', 'Tlax.', '2019-07-16 09:23:39', 'MX'),
('30', 'Veracruz de Ignacio de la Llave', 'Ver.', '2019-07-16 09:23:39', 'MX'),
('31', 'Yucatán', 'Yuc.', '2019-07-16 09:23:39', 'MX'),
('32', 'Zacatecas', 'Zac.', '2019-07-16 09:23:39', 'MX');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `extras`
--

CREATE TABLE `extras` (
  `IdExtra` int(11) NOT NULL,
  `NomExtra` varchar(100) DEFAULT NULL,
  `MontoSugerido` decimal(12,2) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `extras`
--

INSERT INTO `extras` (`IdExtra`, `NomExtra`, `MontoSugerido`, `Status`) VALUES
(1, 'Fosa casera', '150.00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `extrasucursal`
--

CREATE TABLE `extrasucursal` (
  `idExtraSucursal` int(11) NOT NULL,
  `idExtra` int(11) DEFAULT NULL,
  `idSucursal` int(11) DEFAULT NULL,
  `MontoSugerido` decimal(12,2) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `extrasucursal`
--

INSERT INTO `extrasucursal` (`idExtraSucursal`, `idExtra`, `idSucursal`, `MontoSugerido`, `Status`) VALUES
(1, 1, 1, '150.00', 0),
(2, 1, 11, '150.00', 0),
(3, 1, 12, '150.00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_unidades_renta`
--

CREATE TABLE `inventario_unidades_renta` (
  `IdInventarioUnidadesRenta` int(11) NOT NULL,
  `Precio` decimal(12,2) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `Incluye` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `IdUnidadRenta` int(11) NOT NULL,
  `IdSucursal` int(11) NOT NULL,
  `IdTipoUnidades` int(11) DEFAULT NULL,
  `foto` varchar(300) NOT NULL DEFAULT 'themes/lte/assets/dist/img/no-photo.jpg',
  `eliminado` int(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `inventario_unidades_renta`
--

INSERT INTO `inventario_unidades_renta` (`IdInventarioUnidadesRenta`, `Precio`, `Descripcion`, `Incluye`, `cantidad`, `IdUnidadRenta`, `IdSucursal`, `IdTipoUnidades`, `foto`, `eliminado`) VALUES
(1, '100.00', 'SD', 'PAPEL\r\nGEL\r\nTRANSPORTE\r\n', 101, 1, 1, 4, 'themes/lte/assets/dist/img/no-photo.jpg', 0),
(2, '150.00', '*', 'Limpieza\r\nPapel', 61, 1, 11, 1, 'themes/lte/assets/dist/img/no-photo.jpg', 0),
(3, '75.00', 'SDES', 'PAPEL', 99, 3, 1, 4, 'themes/lte/assets/dist/img/no-photo.jpg', 0),
(4, '100.00', '*', 'Papel', 51, 3, 11, 4, 'themes/lte/assets/dist/img/no-photo.jpg', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE `municipio` (
  `idm` int(11) NOT NULL,
  `cve_mun` varchar(3) NOT NULL,
  `nom_mun` varchar(50) NOT NULL,
  `cve_cab` varchar(4) NOT NULL,
  `nom_cab` varchar(50) NOT NULL,
  `fechaModificacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cve_ent` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`idm`, `cve_mun`, `nom_mun`, `cve_cab`, `nom_cab`, `fechaModificacion`, `cve_ent`) VALUES
(1, '001', 'Aguascalientes', '0001', 'Aguascalientes', '2019-07-16 09:28:24', '01'),
(2, '001', 'Ensenada', '0001', 'Ensenada', '2019-07-16 09:28:25', '02'),
(3, '001', 'Comondú', '0001', 'Ciudad Constitución', '2019-07-16 09:28:25', '03'),
(4, '001', 'Calkiní', '0001', 'Calkiní', '2019-07-16 09:28:25', '04'),
(5, '001', 'Abasolo', '0001', 'Abasolo', '2019-07-16 09:28:26', '05'),
(6, '001', 'Armería', '0001', 'Ciudad de Armería', '2019-07-16 09:28:27', '06'),
(7, '001', 'Acacoyagua', '0001', 'Acacoyagua', '2019-07-16 09:28:28', '07'),
(8, '001', 'Ahumada', '0001', 'Miguel Ahumada', '2019-07-16 09:28:32', '08'),
(9, '001', 'Canatlán', '0001', 'Canatlán', '2019-07-16 09:28:36', '10'),
(10, '001', 'Abasolo', '0001', 'Abasolo', '2019-07-16 09:28:37', '11'),
(11, '001', 'Acapulco de Juárez', '0001', 'Acapulco de Juárez', '2019-07-16 09:28:39', '12'),
(12, '001', 'Acatlán', '0001', 'Acatlán', '2019-07-16 09:28:42', '13'),
(13, '001', 'Acatic', '0001', 'Acatic', '2019-07-16 09:28:46', '14'),
(14, '001', 'Acambay de Ruíz Castañeda', '0001', 'Villa de Acambay de Ruíz Castañeda', '2019-07-16 09:28:51', '15'),
(15, '001', 'Acuitzio', '0001', 'Acuitzio del Canje', '2019-07-16 09:28:56', '16'),
(16, '001', 'Amacuzac', '0001', 'Amacuzac', '2019-07-16 09:29:01', '17'),
(17, '001', 'Acaponeta', '0001', 'Acaponeta', '2019-07-16 09:29:02', '18'),
(18, '001', 'Abasolo', '0001', 'Abasolo', '2019-07-16 09:29:03', '19'),
(19, '001', 'Abejones', '0001', 'Abejones', '2019-07-16 09:29:05', '20'),
(20, '001', 'Acajete', '0001', 'Acajete', '2019-07-16 09:29:30', '21'),
(21, '001', 'Amealco de Bonfil', '0001', 'Amealco de Bonfil', '2019-07-16 09:29:40', '22'),
(22, '001', 'Cozumel', '0001', 'Cozumel', '2019-07-16 09:29:40', '23'),
(23, '001', 'Ahualulco', '0001', 'Ahualulco del Sonido 13', '2019-07-16 09:29:41', '24'),
(24, '001', 'Ahome', '0001', 'Los Mochis', '2019-07-16 09:29:43', '25'),
(25, '001', 'Aconchi', '0001', 'Aconchi', '2019-07-16 09:29:44', '26'),
(26, '001', 'Balancán', '0001', 'Balancán', '2019-07-16 09:29:48', '27'),
(27, '001', 'Abasolo', '0001', 'Abasolo', '2019-07-16 09:29:48', '28'),
(28, '001', 'Amaxac de Guerrero', '0001', 'Amaxac de Guerrero', '2019-07-16 09:29:50', '29'),
(29, '001', 'Acajete', '0001', 'Acajete', '2019-07-16 09:29:52', '30'),
(30, '001', 'Abalá', '0001', 'Abalá', '2019-07-16 09:30:01', '31'),
(31, '001', 'Apozol', '0001', 'Apozol', '2019-07-16 09:30:06', '32'),
(32, '002', 'Asientos', '0001', 'Asientos', '2019-07-16 09:28:24', '01'),
(33, '002', 'Mexicali', '0001', 'Mexicali', '2019-07-16 09:28:25', '02'),
(34, '002', 'Mulegé', '0001', 'Santa Rosalía', '2019-07-16 09:28:25', '03'),
(35, '002', 'Campeche', '0001', 'San Francisco de Campeche', '2019-07-16 09:28:25', '04'),
(36, '002', 'Acuña', '0001', 'Ciudad Acuña', '2019-07-16 09:28:26', '05'),
(37, '002', 'Colima', '0001', 'Colima', '2019-07-16 09:28:28', '06'),
(38, '002', 'Acala', '0001', 'Acala', '2019-07-16 09:28:28', '07'),
(39, '002', 'Aldama', '0001', 'Juan Aldama', '2019-07-16 09:28:32', '08'),
(40, '002', 'Azcapotzalco', '----', '', '2019-07-16 09:28:35', '09'),
(41, '002', 'Canelas', '0001', 'Canelas', '2019-07-16 09:28:36', '10'),
(42, '002', 'Acámbaro', '0001', 'Acámbaro', '2019-07-16 09:28:37', '11'),
(43, '002', 'Ahuacuotzingo', '0001', 'Ahuacuotzingo', '2019-07-16 09:28:39', '12'),
(44, '002', 'Acaxochitlán', '0001', 'Acaxochitlán', '2019-07-16 09:28:42', '13'),
(45, '002', 'Acatlán de Juárez', '0001', 'Acatlán de Juárez', '2019-07-16 09:28:46', '14'),
(46, '002', 'Acolman', '0001', 'Acolman de Nezahualcóyotl', '2019-07-16 09:28:51', '15'),
(47, '002', 'Aguililla', '0001', 'Aguililla', '2019-07-16 09:28:56', '16'),
(48, '002', 'Atlatlahucan', '0001', 'Atlatlahucan', '2019-07-16 09:29:01', '17'),
(49, '002', 'Ahuacatlán', '0001', 'Ahuacatlán', '2019-07-16 09:29:02', '18'),
(50, '002', 'Agualeguas', '0001', 'Agualeguas', '2019-07-16 09:29:03', '19'),
(51, '002', 'Acatlán de Pérez Figueroa', '0001', 'Acatlán de Pérez Figueroa', '2019-07-16 09:29:05', '20'),
(52, '002', 'Acateno', '0001', 'San José Acateno', '2019-07-16 09:29:30', '21'),
(53, '002', 'Pinal de Amoles', '0001', 'Pinal de Amoles', '2019-07-16 09:29:40', '22'),
(54, '002', 'Felipe Carrillo Puerto', '0001', 'Felipe Carrillo Puerto', '2019-07-16 09:29:40', '23'),
(55, '002', 'Alaquines', '0001', 'Alaquines', '2019-07-16 09:29:41', '24'),
(56, '002', 'Angostura', '0001', 'Angostura', '2019-07-16 09:29:43', '25'),
(57, '002', 'Agua Prieta', '0001', 'Agua Prieta', '2019-07-16 09:29:44', '26'),
(58, '002', 'Cárdenas', '0001', 'Cárdenas', '2019-07-16 09:29:48', '27'),
(59, '002', 'Aldama', '0001', 'Aldama', '2019-07-16 09:29:48', '28'),
(60, '002', 'Apetatitlán de Antonio Carvajal', '0001', 'Apetatitlán', '2019-07-16 09:29:50', '29'),
(61, '002', 'Acatlán', '0001', 'Acatlán', '2019-07-16 09:29:52', '30'),
(62, '002', 'Acanceh', '0001', 'Acanceh', '2019-07-16 09:30:01', '31'),
(63, '002', 'Apulco', '0001', 'Apulco', '2019-07-16 09:30:06', '32'),
(64, '003', 'Calvillo', '0001', 'Calvillo', '2019-07-16 09:28:24', '01'),
(65, '003', 'Tecate', '0001', 'Tecate', '2019-07-16 09:28:25', '02'),
(66, '003', 'La Paz', '0001', 'La Paz', '2019-07-16 09:28:25', '03'),
(67, '003', 'Carmen', '0001', 'Ciudad del Carmen', '2019-07-16 09:28:25', '04'),
(68, '003', 'Allende', '0001', 'Allende', '2019-07-16 09:28:26', '05'),
(69, '003', 'Comala', '0001', 'Comala', '2019-07-16 09:28:28', '06'),
(70, '003', 'Acapetahua', '0001', 'Acapetahua', '2019-07-16 09:28:28', '07'),
(71, '003', 'Allende', '0001', 'Valle de Ignacio Allende', '2019-07-16 09:28:32', '08'),
(72, '003', 'Coyoacán', '----', '', '2019-07-16 09:28:35', '09'),
(73, '003', 'Coneto de Comonfort', '0001', 'Coneto de Comonfort', '2019-07-16 09:28:36', '10'),
(74, '003', 'San Miguel de Allende', '0001', 'San Miguel de Allende', '2019-07-16 09:28:37', '11'),
(75, '003', 'Ajuchitlán del Progreso', '0001', 'Ajuchitlán del Progreso', '2019-07-16 09:28:39', '12'),
(76, '003', 'Actopan', '0001', 'Actopan', '2019-07-16 09:28:43', '13'),
(77, '003', 'Ahualulco de Mercado', '0001', 'Ahualulco de Mercado', '2019-07-16 09:28:46', '14'),
(78, '003', 'Aculco', '0001', 'Aculco de Espinoza', '2019-07-16 09:28:51', '15'),
(79, '003', 'Álvaro Obregón', '0001', 'Álvaro Obregón', '2019-07-16 09:28:56', '16'),
(80, '003', 'Axochiapan', '0001', 'Axochiapan', '2019-07-16 09:29:01', '17'),
(81, '003', 'Amatlán de Cañas', '0001', 'Amatlán de Cañas', '2019-07-16 09:29:02', '18'),
(82, '003', 'Los Aldamas', '0001', 'Los Aldamas', '2019-07-16 09:29:03', '19'),
(83, '003', 'Asunción Cacalotepec', '0001', 'Asunción Cacalotepec', '2019-07-16 09:29:05', '20'),
(84, '003', 'Acatlán', '0001', 'Acatlán de Osorio', '2019-07-16 09:29:30', '21'),
(85, '003', 'Arroyo Seco', '0001', 'Arroyo Seco', '2019-07-16 09:29:40', '22'),
(86, '003', 'Isla Mujeres', '0001', 'Isla Mujeres', '2019-07-16 09:29:40', '23'),
(87, '003', 'Aquismón', '0001', 'Aquismón', '2019-07-16 09:29:41', '24'),
(88, '003', 'Badiraguato', '0001', 'Badiraguato', '2019-07-16 09:29:43', '25'),
(89, '003', 'Alamos', '0001', 'Alamos', '2019-07-16 09:29:44', '26'),
(90, '003', 'Centla', '0001', 'Frontera', '2019-07-16 09:29:48', '27'),
(91, '003', 'Altamira', '0001', 'Altamira', '2019-07-16 09:29:48', '28'),
(92, '003', 'Atlangatepec', '0001', 'Atlangatepec', '2019-07-16 09:29:50', '29'),
(93, '003', 'Acayucan', '0001', 'Acayucan', '2019-07-16 09:29:53', '30'),
(94, '003', 'Akil', '0001', 'Akil', '2019-07-16 09:30:01', '31'),
(95, '003', 'Atolinga', '0001', 'Atolinga', '2019-07-16 09:30:06', '32'),
(96, '004', 'Cosío', '0001', 'Cosío', '2019-07-16 09:28:24', '01'),
(97, '004', 'Tijuana', '0001', 'Tijuana', '2019-07-16 09:28:25', '02'),
(98, '004', 'Champotón', '0001', 'Champotón', '2019-07-16 09:28:25', '04'),
(99, '004', 'Arteaga', '0001', 'Arteaga', '2019-07-16 09:28:26', '05'),
(100, '004', 'Coquimatlán', '0001', 'Coquimatlán', '2019-07-16 09:28:28', '06'),
(101, '004', 'Altamirano', '0001', 'Altamirano', '2019-07-16 09:28:28', '07'),
(102, '004', 'Aquiles Serdán', '0001', 'Santa Eulalia', '2019-07-16 09:28:33', '08'),
(103, '004', 'Cuajimalpa de Morelos', '----', '', '2019-07-16 09:28:35', '09'),
(104, '004', 'Cuencamé', '0001', 'Cuencamé de Ceniceros', '2019-07-16 09:28:36', '10'),
(105, '004', 'Apaseo el Alto', '0001', 'Apaseo el Alto', '2019-07-16 09:28:37', '11'),
(106, '004', 'Alcozauca de Guerrero', '0001', 'Alcozauca de Guerrero', '2019-07-16 09:28:39', '12'),
(107, '004', 'Agua Blanca de Iturbide', '0001', 'Agua Blanca Iturbide', '2019-07-16 09:28:43', '13'),
(108, '004', 'Amacueca', '0001', 'Amacueca', '2019-07-16 09:28:46', '14'),
(109, '004', 'Almoloya de Alquisiras', '0001', 'Almoloya de Alquisiras', '2019-07-16 09:28:51', '15'),
(110, '004', 'Angamacutiro', '0001', 'Angamacutiro de la Unión', '2019-07-16 09:28:56', '16'),
(111, '004', 'Ayala', '0001', 'Ciudad Ayala', '2019-07-16 09:29:01', '17'),
(112, '004', 'Compostela', '0001', 'Compostela', '2019-07-16 09:29:02', '18'),
(113, '004', 'Allende', '0001', 'Ciudad de Allende', '2019-07-16 09:29:03', '19'),
(114, '004', 'Asunción Cuyotepeji', '0001', 'Asunción Cuyotepeji', '2019-07-16 09:29:05', '20'),
(115, '004', 'Acatzingo', '0001', 'Acatzingo de Hidalgo', '2019-07-16 09:29:30', '21'),
(116, '004', 'Cadereyta de Montes', '0001', 'Cadereyta de Montes', '2019-07-16 09:29:40', '22'),
(117, '004', 'Othón P. Blanco', '0001', 'Chetumal', '2019-07-16 09:29:40', '23'),
(118, '004', 'Armadillo de los Infante', '0001', 'Armadillo de los Infante', '2019-07-16 09:29:41', '24'),
(119, '004', 'Concordia', '0001', 'Concordia', '2019-07-16 09:29:43', '25'),
(120, '004', 'Altar', '0001', 'Altar', '2019-07-16 09:29:44', '26'),
(121, '004', 'Centro', '0001', 'Villahermosa', '2019-07-16 09:29:48', '27'),
(122, '004', 'Antiguo Morelos', '0001', 'Antiguo Morelos', '2019-07-16 09:29:48', '28'),
(123, '004', 'Atltzayanca', '0001', 'Atlzayanca', '2019-07-16 09:29:50', '29'),
(124, '004', 'Actopan', '0001', 'Actopan', '2019-07-16 09:29:53', '30'),
(125, '004', 'Baca', '0001', 'Baca', '2019-07-16 09:30:01', '31'),
(126, '004', 'Benito Juárez', '0001', 'Florencia', '2019-07-16 09:30:06', '32'),
(127, '005', 'Jesús María', '0001', 'Jesús María', '2019-07-16 09:28:24', '01'),
(128, '005', 'Playas de Rosarito', '0001', 'Playas de Rosarito', '2019-07-16 09:28:25', '02'),
(129, '005', 'Hecelchakán', '0001', 'Hecelchakán', '2019-07-16 09:28:25', '04'),
(130, '005', 'Candela', '0001', 'Candela', '2019-07-16 09:28:26', '05'),
(131, '005', 'Cuauhtémoc', '0001', 'Cuauhtémoc', '2019-07-16 09:28:28', '06'),
(132, '005', 'Amatán', '0001', 'Amatán', '2019-07-16 09:28:28', '07'),
(133, '005', 'Ascensión', '0001', 'Ascensión', '2019-07-16 09:28:33', '08'),
(134, '005', 'Gustavo A. Madero', '----', '', '2019-07-16 09:28:35', '09'),
(135, '005', 'Durango', '0001', 'Victoria de Durango', '2019-07-16 09:28:36', '10'),
(136, '005', 'Apaseo el Grande', '0001', 'Apaseo el Grande', '2019-07-16 09:28:37', '11'),
(137, '005', 'Alpoyeca', '0001', 'Alpoyeca', '2019-07-16 09:28:39', '12'),
(138, '005', 'Ajacuba', '0001', 'Ajacuba', '2019-07-16 09:28:43', '13'),
(139, '005', 'Amatitán', '0001', 'Amatitán', '2019-07-16 09:28:46', '14'),
(140, '005', 'Almoloya de Juárez', '0001', 'Villa de Almoloya de Juárez', '2019-07-16 09:28:51', '15'),
(141, '005', 'Angangueo', '0001', 'Mineral de Angangueo', '2019-07-16 09:28:56', '16'),
(142, '005', 'Coatlán del Río', '0001', 'Coatlán del Río', '2019-07-16 09:29:01', '17'),
(143, '005', 'Huajicori', '0001', 'Huajicori', '2019-07-16 09:29:03', '18'),
(144, '005', 'Anáhuac', '0001', 'Anáhuac', '2019-07-16 09:29:03', '19'),
(145, '005', 'Asunción Ixtaltepec', '0001', 'Asunción Ixtaltepec', '2019-07-16 09:29:05', '20'),
(146, '005', 'Acteopan', '0001', 'Acteopan', '2019-07-16 09:29:30', '21'),
(147, '005', 'Colón', '0001', 'Colón', '2019-07-16 09:29:40', '22'),
(148, '005', 'Benito Juárez', '0001', 'Cancún', '2019-07-16 09:29:40', '23'),
(149, '005', 'Cárdenas', '0001', 'Cárdenas', '2019-07-16 09:29:41', '24'),
(150, '005', 'Cosalá', '0001', 'Cosalá', '2019-07-16 09:29:43', '25'),
(151, '005', 'Arivechi', '0001', 'Arivechi', '2019-07-16 09:29:44', '26'),
(152, '005', 'Comalcalco', '0001', 'Comalcalco', '2019-07-16 09:29:48', '27'),
(153, '005', 'Burgos', '0001', 'Burgos', '2019-07-16 09:29:48', '28'),
(154, '005', 'Apizaco', '0001', 'Ciudad de Apizaco', '2019-07-16 09:29:50', '29'),
(155, '005', 'Acula', '0001', 'Acula', '2019-07-16 09:29:53', '30'),
(156, '005', 'Bokobá', '0001', 'Bokobá', '2019-07-16 09:30:01', '31'),
(157, '005', 'Calera', '0001', 'Víctor Rosales', '2019-07-16 09:30:06', '32'),
(158, '006', 'Pabellón de Arteaga', '0001', 'Pabellón de Arteaga', '2019-07-16 09:28:24', '01'),
(159, '006', 'Hopelchén', '0001', 'Hopelchén', '2019-07-16 09:28:26', '04'),
(160, '006', 'Castaños', '0001', 'Castaños', '2019-07-16 09:28:26', '05'),
(161, '006', 'Ixtlahuacán', '0001', 'Ixtlahuacán', '2019-07-16 09:28:28', '06'),
(162, '006', 'Amatenango de la Frontera', '0001', 'Amatenango de la Frontera', '2019-07-16 09:28:28', '07'),
(163, '006', 'Bachíniva', '0001', 'Bachíniva', '2019-07-16 09:28:33', '08'),
(164, '006', 'Iztacalco', '----', '', '2019-07-16 09:28:35', '09'),
(165, '006', 'General Simón Bolívar', '0001', 'General Simón Bolívar', '2019-07-16 09:28:36', '10'),
(166, '006', 'Atarjea', '0001', 'Atarjea', '2019-07-16 09:28:37', '11'),
(167, '006', 'Apaxtla', '0001', 'Ciudad Apaxtla de Castrejón', '2019-07-16 09:28:39', '12'),
(168, '006', 'Alfajayucan', '0001', 'Alfajayucan', '2019-07-16 09:28:43', '13'),
(169, '006', 'Ameca', '0001', 'Ameca', '2019-07-16 09:28:46', '14'),
(170, '006', 'Almoloya del Río', '0001', 'Almoloya del Río', '2019-07-16 09:28:51', '15'),
(171, '006', 'Apatzingán', '0001', 'Apatzingán de la Constitución', '2019-07-16 09:28:56', '16'),
(172, '006', 'Cuautla', '0001', 'Cuautla', '2019-07-16 09:29:01', '17'),
(173, '006', 'Ixtlán del Río', '0001', 'Ixtlán del Río', '2019-07-16 09:29:03', '18'),
(174, '006', 'Apodaca', '0001', 'Ciudad Apodaca', '2019-07-16 09:29:03', '19'),
(175, '006', 'Asunción Nochixtlán', '0001', 'Asunción Nochixtlán', '2019-07-16 09:29:05', '20'),
(176, '006', 'Ahuacatlán', '0001', 'Ahuacatlán', '2019-07-16 09:29:30', '21'),
(177, '006', 'Corregidora', '0001', 'El Pueblito', '2019-07-16 09:29:40', '22'),
(178, '006', 'José María Morelos', '0069', 'José María Morelos', '2019-07-16 09:29:40', '23'),
(179, '006', 'Catorce', '0001', 'Real de Catorce', '2019-07-16 09:29:41', '24'),
(180, '006', 'Culiacán', '0001', 'Culiacán Rosales', '2019-07-16 09:29:43', '25'),
(181, '006', 'Arizpe', '0001', 'Arizpe', '2019-07-16 09:29:44', '26'),
(182, '006', 'Cunduacán', '0001', 'Cunduacán', '2019-07-16 09:29:48', '27'),
(183, '006', 'Bustamante', '0001', 'Bustamante', '2019-07-16 09:29:48', '28'),
(184, '006', 'Calpulalpan', '0001', 'Calpulalpan', '2019-07-16 09:29:50', '29'),
(185, '006', 'Acultzingo', '0001', 'Acultzingo', '2019-07-16 09:29:53', '30'),
(186, '006', 'Buctzotz', '0001', 'Buctzotz', '2019-07-16 09:30:01', '31'),
(187, '006', 'Cañitas de Felipe Pescador', '0001', 'Cañitas de Felipe Pescador', '2019-07-16 09:30:06', '32'),
(188, '007', 'Rincón de Romos', '0001', 'Rincón de Romos', '2019-07-16 09:28:24', '01'),
(189, '007', 'Palizada', '0001', 'Palizada', '2019-07-16 09:28:26', '04'),
(190, '007', 'Cuatro Ciénegas', '0001', 'Cuatro Ciénegas de Carranza', '2019-07-16 09:28:26', '05'),
(191, '007', 'Manzanillo', '0001', 'Manzanillo', '2019-07-16 09:28:28', '06'),
(192, '007', 'Amatenango del Valle', '0001', 'Amatenango del Valle', '2019-07-16 09:28:28', '07'),
(193, '007', 'Balleza', '0001', 'Mariano Balleza', '2019-07-16 09:28:33', '08'),
(194, '007', 'Iztapalapa', '----', '', '2019-07-16 09:28:35', '09'),
(195, '007', 'Gómez Palacio', '0001', 'Gómez Palacio', '2019-07-16 09:28:36', '10'),
(196, '007', 'Celaya', '0001', 'Celaya', '2019-07-16 09:28:37', '11'),
(197, '007', 'Arcelia', '0001', 'Arcelia', '2019-07-16 09:28:39', '12'),
(198, '007', 'Almoloya', '0001', 'Almoloya', '2019-07-16 09:28:43', '13'),
(199, '007', 'San Juanito de Escobedo', '0001', 'San Juanito de Escobedo', '2019-07-16 09:28:46', '14'),
(200, '007', 'Amanalco', '0001', 'Amanalco de Becerra', '2019-07-16 09:28:51', '15'),
(201, '007', 'Aporo', '0001', 'Aporo', '2019-07-16 09:28:56', '16'),
(202, '007', 'Cuernavaca', '0001', 'Cuernavaca', '2019-07-16 09:29:01', '17'),
(203, '007', 'Jala', '0001', 'Jala', '2019-07-16 09:29:03', '18'),
(204, '007', 'Aramberri', '0001', 'Aramberri', '2019-07-16 09:29:03', '19'),
(205, '007', 'Asunción Ocotlán', '0001', 'Asunción Ocotlán', '2019-07-16 09:29:05', '20'),
(206, '007', 'Ahuatlán', '0001', 'Ahuatlán', '2019-07-16 09:29:30', '21'),
(207, '007', 'Ezequiel Montes', '0001', 'Ezequiel Montes', '2019-07-16 09:29:40', '22'),
(208, '007', 'Lázaro Cárdenas', '0001', 'Kantunilkín', '2019-07-16 09:29:41', '23'),
(209, '007', 'Cedral', '0001', 'Cedral', '2019-07-16 09:29:41', '24'),
(210, '007', 'Choix', '0001', 'Choix', '2019-07-16 09:29:43', '25'),
(211, '007', 'Atil', '0001', 'Atil', '2019-07-16 09:29:44', '26'),
(212, '007', 'Emiliano Zapata', '0001', 'Emiliano Zapata', '2019-07-16 09:29:48', '27'),
(213, '007', 'Camargo', '0001', 'Ciudad Camargo', '2019-07-16 09:29:49', '28'),
(214, '007', 'El Carmen Tequexquitla', '0001', 'Villa de El Carmen Tequexquitla', '2019-07-16 09:29:50', '29'),
(215, '007', 'Camarón de Tejeda', '0001', 'Camarón de Tejeda', '2019-07-16 09:29:53', '30'),
(216, '007', 'Cacalchén', '0001', 'Cacalchén', '2019-07-16 09:30:01', '31'),
(217, '007', 'Concepción del Oro', '0001', 'Concepción del Oro', '2019-07-16 09:30:06', '32'),
(218, '008', 'San José de Gracia', '0001', 'San José de Gracia', '2019-07-16 09:28:25', '01'),
(219, '008', 'Los Cabos', '0001', 'San José del Cabo', '2019-07-16 09:28:25', '03'),
(220, '008', 'Tenabo', '0001', 'Tenabo', '2019-07-16 09:28:26', '04'),
(221, '008', 'Escobedo', '0001', 'Escobedo', '2019-07-16 09:28:26', '05'),
(222, '008', 'Minatitlán', '0001', 'Minatitlán', '2019-07-16 09:28:28', '06'),
(223, '008', 'Angel Albino Corzo', '0001', 'Jaltenango de la Paz (Angel Albino Corzo)', '2019-07-16 09:28:28', '07'),
(224, '008', 'Batopilas', '0001', 'Batopilas', '2019-07-16 09:28:33', '08'),
(225, '008', 'La Magdalena Contreras', '----', '', '2019-07-16 09:28:35', '09'),
(226, '008', 'Guadalupe Victoria', '0001', 'Guadalupe Victoria', '2019-07-16 09:28:36', '10'),
(227, '008', 'Manuel Doblado', '0001', 'Ciudad Manuel Doblado', '2019-07-16 09:28:38', '11'),
(228, '008', 'Atenango del Río', '0001', 'Atenango del Río', '2019-07-16 09:28:39', '12'),
(229, '008', 'Apan', '0001', 'Apan', '2019-07-16 09:28:43', '13'),
(230, '008', 'Arandas', '0001', 'Arandas', '2019-07-16 09:28:46', '14'),
(231, '008', 'Amatepec', '0001', 'Amatepec', '2019-07-16 09:28:51', '15'),
(232, '008', 'Aquila', '0001', 'Aquila', '2019-07-16 09:28:56', '16'),
(233, '008', 'Emiliano Zapata', '0001', 'Emiliano Zapata', '2019-07-16 09:29:01', '17'),
(234, '008', 'Xalisco', '0001', 'Xalisco', '2019-07-16 09:29:03', '18'),
(235, '008', 'Bustamante', '0001', 'Bustamante', '2019-07-16 09:29:03', '19'),
(236, '008', 'Asunción Tlacolulita', '0001', 'Asunción Tlacolulita', '2019-07-16 09:29:05', '20'),
(237, '008', 'Ahuazotepec', '0001', 'Ahuazotepec', '2019-07-16 09:29:30', '21'),
(238, '008', 'Huimilpan', '0001', 'Huimilpan', '2019-07-16 09:29:40', '22'),
(239, '008', 'Solidaridad', '0001', 'Playa del Carmen', '2019-07-16 09:29:41', '23'),
(240, '008', 'Cerritos', '0001', 'Cerritos', '2019-07-16 09:29:41', '24'),
(241, '008', 'Elota', '0001', 'La Cruz', '2019-07-16 09:29:43', '25'),
(242, '008', 'Bacadéhuachi', '0001', 'Bacadéhuachi', '2019-07-16 09:29:44', '26'),
(243, '008', 'Huimanguillo', '0001', 'Huimanguillo', '2019-07-16 09:29:48', '27'),
(244, '008', 'Casas', '0001', 'Casas', '2019-07-16 09:29:49', '28'),
(245, '008', 'Cuapiaxtla', '0001', 'Cuapiaxtla', '2019-07-16 09:29:50', '29'),
(246, '008', 'Alpatláhuac', '0001', 'Alpatláhuac', '2019-07-16 09:29:53', '30'),
(247, '008', 'Calotmul', '0001', 'Calotmul', '2019-07-16 09:30:01', '31'),
(248, '008', 'Cuauhtémoc', '0001', 'San Pedro Piedra Gorda', '2019-07-16 09:30:06', '32'),
(249, '009', 'Tepezalá', '0001', 'Tepezalá', '2019-07-16 09:28:25', '01'),
(250, '009', 'Loreto', '0001', 'Loreto', '2019-07-16 09:28:25', '03'),
(251, '009', 'Escárcega', '0001', 'Escárcega', '2019-07-16 09:28:26', '04'),
(252, '009', 'Francisco I. Madero', '0001', 'Francisco I. Madero (Chávez)', '2019-07-16 09:28:26', '05'),
(253, '009', 'Tecomán', '0001', 'Tecomán', '2019-07-16 09:28:28', '06'),
(254, '009', 'Arriaga', '0001', 'Arriaga', '2019-07-16 09:28:28', '07'),
(255, '009', 'Bocoyna', '0001', 'Bocoyna', '2019-07-16 09:28:33', '08'),
(256, '009', 'Milpa Alta', '----', '', '2019-07-16 09:28:35', '09'),
(257, '009', 'Guanaceví', '0001', 'Guanaceví', '2019-07-16 09:28:36', '10'),
(258, '009', 'Comonfort', '0001', 'Comonfort', '2019-07-16 09:28:38', '11'),
(259, '009', 'Atlamajalcingo del Monte', '0001', 'Atlamajalcingo del Monte', '2019-07-16 09:28:39', '12'),
(260, '009', 'El Arenal', '0001', 'El Arenal', '2019-07-16 09:28:43', '13'),
(261, '009', 'El Arenal', '0001', 'El Arenal', '2019-07-16 09:28:46', '14'),
(262, '009', 'Amecameca', '0001', 'Amecameca de Juárez', '2019-07-16 09:28:51', '15'),
(263, '009', 'Ario', '0001', 'Ario de Rosales', '2019-07-16 09:28:56', '16'),
(264, '009', 'Huitzilac', '0001', 'Huitzilac', '2019-07-16 09:29:01', '17'),
(265, '009', 'Del Nayar', '0001', 'Jesús María', '2019-07-16 09:29:03', '18'),
(266, '009', 'Cadereyta Jiménez', '0001', 'Cadereyta Jiménez', '2019-07-16 09:29:03', '19'),
(267, '009', 'Ayotzintepec', '0001', 'Ayotzintepec', '2019-07-16 09:29:05', '20'),
(268, '009', 'Ahuehuetitla', '0001', 'Ahuehuetitla', '2019-07-16 09:29:30', '21'),
(269, '009', 'Jalpan de Serra', '0001', 'Jalpan de Serra', '2019-07-16 09:29:40', '22'),
(270, '009', 'Tulum', '0001', 'Tulum', '2019-07-16 09:29:41', '23'),
(271, '009', 'Cerro de San Pedro', '0001', 'Cerro de San Pedro', '2019-07-16 09:29:41', '24'),
(272, '009', 'Escuinapa', '0001', 'Escuinapa de Hidalgo', '2019-07-16 09:29:43', '25'),
(273, '009', 'Bacanora', '0001', 'Bacanora', '2019-07-16 09:29:44', '26'),
(274, '009', 'Jalapa', '0001', 'Jalapa', '2019-07-16 09:29:48', '27'),
(275, '009', 'Ciudad Madero', '0001', 'Ciudad Madero', '2019-07-16 09:29:49', '28'),
(276, '009', 'Cuaxomulco', '0001', 'Cuaxomulco', '2019-07-16 09:29:50', '29'),
(277, '009', 'Alto Lucero de Gutiérrez Barrios', '0001', 'Alto Lucero', '2019-07-16 09:29:53', '30'),
(278, '009', 'Cansahcab', '0001', 'Cansahcab', '2019-07-16 09:30:01', '31'),
(279, '009', 'Chalchihuites', '0001', 'Chalchihuites', '2019-07-16 09:30:06', '32'),
(280, '010', 'El Llano', '0001', 'Palo Alto', '2019-07-16 09:28:25', '01'),
(281, '010', 'Calakmul', '0001', 'Xpujil', '2019-07-16 09:28:26', '04'),
(282, '010', 'Frontera', '0001', 'Frontera', '2019-07-16 09:28:26', '05'),
(283, '010', 'Villa de Álvarez', '0001', 'Ciudad de Villa de Álvarez', '2019-07-16 09:28:28', '06'),
(284, '010', 'Bejucal de Ocampo', '0001', 'Bejucal de Ocampo', '2019-07-16 09:28:28', '07'),
(285, '010', 'Buenaventura', '0001', 'San Buenaventura', '2019-07-16 09:28:33', '08'),
(286, '010', 'Álvaro Obregón', '----', '', '2019-07-16 09:28:35', '09'),
(287, '010', 'Hidalgo', '0001', 'Villa Hidalgo', '2019-07-16 09:28:36', '10'),
(288, '010', 'Coroneo', '0001', 'Coroneo', '2019-07-16 09:28:38', '11'),
(289, '010', 'Atlixtac', '0001', 'Atlixtac', '2019-07-16 09:28:39', '12'),
(290, '010', 'Atitalaquia', '0001', 'Atitalaquia', '2019-07-16 09:28:43', '13'),
(291, '010', 'Atemajac de Brizuela', '0001', 'Atemajac de Brizuela', '2019-07-16 09:28:46', '14'),
(292, '010', 'Apaxco', '0001', 'Apaxco de Ocampo', '2019-07-16 09:28:51', '15'),
(293, '010', 'Arteaga', '0001', 'Arteaga', '2019-07-16 09:28:56', '16'),
(294, '010', 'Jantetelco', '0001', 'Jantetelco', '2019-07-16 09:29:01', '17'),
(295, '010', 'Rosamorada', '0001', 'Rosamorada', '2019-07-16 09:29:03', '18'),
(296, '010', 'El Carmen', '0001', 'Carmen', '2019-07-16 09:29:03', '19'),
(297, '010', 'El Barrio de la Soledad', '0001', 'El Barrio de la Soledad', '2019-07-16 09:29:05', '20'),
(298, '010', 'Ajalpan', '0001', 'Ciudad de Ajalpan', '2019-07-16 09:29:30', '21'),
(299, '010', 'Landa de Matamoros', '0001', 'Landa de Matamoros', '2019-07-16 09:29:40', '22'),
(300, '010', 'Bacalar', '0001', 'Bacalar', '2019-07-16 09:29:41', '23'),
(301, '010', 'Ciudad del Maíz', '0001', 'Ciudad del Maíz', '2019-07-16 09:29:41', '24'),
(302, '010', 'El Fuerte', '0001', 'El Fuerte', '2019-07-16 09:29:43', '25'),
(303, '010', 'Bacerac', '0001', 'Bacerac', '2019-07-16 09:29:44', '26'),
(304, '010', 'Jalpa de Méndez', '0001', 'Jalpa de Méndez', '2019-07-16 09:29:48', '27'),
(305, '010', 'Cruillas', '0001', 'Cruillas', '2019-07-16 09:29:49', '28'),
(306, '010', 'Chiautempan', '0001', 'Santa Ana Chiautempan', '2019-07-16 09:29:50', '29'),
(307, '010', 'Altotonga', '0001', 'Altotonga', '2019-07-16 09:29:53', '30'),
(308, '010', 'Cantamayec', '0001', 'Cantamayec', '2019-07-16 09:30:01', '31'),
(309, '010', 'Fresnillo', '0001', 'Fresnillo', '2019-07-16 09:30:06', '32'),
(310, '011', 'San Francisco de los Romo', '0001', 'San Francisco de los Romo', '2019-07-16 09:28:25', '01'),
(311, '011', 'Candelaria', '0001', 'Candelaria', '2019-07-16 09:28:26', '04'),
(312, '011', 'General Cepeda', '0001', 'General Cepeda', '2019-07-16 09:28:26', '05'),
(313, '011', 'Bella Vista', '0001', 'Bella Vista', '2019-07-16 09:28:28', '07'),
(314, '011', 'Camargo', '0001', 'Santa Rosalía de Camargo', '2019-07-16 09:28:33', '08'),
(315, '011', 'Tláhuac', '----', '', '2019-07-16 09:28:36', '09'),
(316, '011', 'Indé', '0001', 'Indé', '2019-07-16 09:28:36', '10'),
(317, '011', 'Cortazar', '0001', 'Cortazar', '2019-07-16 09:28:38', '11'),
(318, '011', 'Atoyac de Álvarez', '0001', 'Atoyac de Álvarez', '2019-07-16 09:28:39', '12'),
(319, '011', 'Atlapexco', '0001', 'Atlapexco', '2019-07-16 09:28:43', '13'),
(320, '011', 'Atengo', '0001', 'Atengo', '2019-07-16 09:28:46', '14'),
(321, '011', 'Atenco', '0001', 'San Salvador Atenco', '2019-07-16 09:28:51', '15'),
(322, '011', 'Briseñas', '0001', 'Briseñas de Matamoros', '2019-07-16 09:28:57', '16'),
(323, '011', 'Jiutepec', '0001', 'Jiutepec', '2019-07-16 09:29:01', '17'),
(324, '011', 'Ruíz', '0001', 'Ruíz', '2019-07-16 09:29:03', '18'),
(325, '011', 'Cerralvo', '0001', 'Ciudad Cerralvo', '2019-07-16 09:29:03', '19'),
(326, '011', 'Calihualá', '0001', 'Calihualá', '2019-07-16 09:29:05', '20'),
(327, '011', 'Albino Zertuche', '0001', 'Acaxtlahuacán de Albino Zertuche', '2019-07-16 09:29:30', '21'),
(328, '011', 'El Marqués', '0001', 'La Cañada', '2019-07-16 09:29:40', '22'),
(329, '011', 'Ciudad Fernández', '0001', 'Ciudad Fernández', '2019-07-16 09:29:41', '24'),
(330, '011', 'Guasave', '0001', 'Guasave', '2019-07-16 09:29:43', '25'),
(331, '011', 'Bacoachi', '0001', 'Bacoachi', '2019-07-16 09:29:44', '26'),
(332, '011', 'Jonuta', '0001', 'Jonuta', '2019-07-16 09:29:48', '27'),
(333, '011', 'Gómez Farías', '0036', 'Gómez Farías', '2019-07-16 09:29:49', '28'),
(334, '011', 'Muñoz de Domingo Arenas', '0001', 'Muñoz', '2019-07-16 09:29:50', '29'),
(335, '011', 'Alvarado', '0001', 'Alvarado', '2019-07-16 09:29:53', '30'),
(336, '011', 'Celestún', '0001', 'Celestún', '2019-07-16 09:30:01', '31'),
(337, '011', 'Trinidad García de la Cadena', '0001', 'Trinidad García de la Cadena', '2019-07-16 09:30:06', '32'),
(338, '012', 'Guerrero', '0001', 'Guerrero', '2019-07-16 09:28:26', '05'),
(339, '012', 'Berriozábal', '0001', 'Berriozábal', '2019-07-16 09:28:28', '07'),
(340, '012', 'Carichí', '0001', 'Carichí', '2019-07-16 09:28:33', '08'),
(341, '012', 'Tlalpan', '----', '', '2019-07-16 09:28:36', '09'),
(342, '012', 'Lerdo', '0001', 'Lerdo', '2019-07-16 09:28:36', '10'),
(343, '012', 'Cuerámaro', '0001', 'Cuerámaro', '2019-07-16 09:28:38', '11'),
(344, '012', 'Ayutla de los Libres', '0001', 'Ayutla de los Libres', '2019-07-16 09:28:39', '12'),
(345, '012', 'Atotonilco el Grande', '0001', 'Atotonilco el Grande', '2019-07-16 09:28:43', '13'),
(346, '012', 'Atenguillo', '0001', 'Atenguillo', '2019-07-16 09:28:46', '14'),
(347, '012', 'Atizapán', '0001', 'Santa Cruz Atizapán', '2019-07-16 09:28:51', '15'),
(348, '012', 'Buenavista', '0001', 'Buenavista Tomatlán', '2019-07-16 09:28:57', '16'),
(349, '012', 'Jojutla', '0001', 'Jojutla', '2019-07-16 09:29:01', '17'),
(350, '012', 'San Blas', '0001', 'San Blas', '2019-07-16 09:29:03', '18'),
(351, '012', 'Ciénega de Flores', '0001', 'Ciénega de Flores', '2019-07-16 09:29:04', '19'),
(352, '012', 'Candelaria Loxicha', '0001', 'Candelaria Loxicha', '2019-07-16 09:29:06', '20'),
(353, '012', 'Aljojuca', '0001', 'Aljojuca', '2019-07-16 09:29:30', '21'),
(354, '012', 'Pedro Escobedo', '0001', 'Pedro Escobedo', '2019-07-16 09:29:40', '22'),
(355, '012', 'Tancanhuitz', '0001', 'Tancanhuitz', '2019-07-16 09:29:41', '24'),
(356, '012', 'Mazatlán', '0001', 'Mazatlán', '2019-07-16 09:29:43', '25'),
(357, '012', 'Bácum', '0001', 'Bácum', '2019-07-16 09:29:44', '26'),
(358, '012', 'Macuspana', '0001', 'Macuspana', '2019-07-16 09:29:48', '27'),
(359, '012', 'González', '0001', 'González', '2019-07-16 09:29:49', '28'),
(360, '012', 'Españita', '0001', 'Españita', '2019-07-16 09:29:50', '29'),
(361, '012', 'Amatitlán', '0001', 'Amatitlán', '2019-07-16 09:29:53', '30'),
(362, '012', 'Cenotillo', '0001', 'Cenotillo', '2019-07-16 09:30:01', '31'),
(363, '012', 'Genaro Codina', '0001', 'Genaro Codina', '2019-07-16 09:30:06', '32'),
(364, '013', 'Hidalgo', '0001', 'Hidalgo', '2019-07-16 09:28:26', '05'),
(365, '013', 'Bochil', '0001', 'Bochil', '2019-07-16 09:28:28', '07'),
(366, '013', 'Casas Grandes', '0001', 'Casas Grandes', '2019-07-16 09:28:33', '08'),
(367, '013', 'Xochimilco', '----', '', '2019-07-16 09:28:36', '09'),
(368, '013', 'Mapimí', '0001', 'Mapimí', '2019-07-16 09:28:36', '10'),
(369, '013', 'Doctor Mora', '0001', 'Doctor Mora', '2019-07-16 09:28:38', '11'),
(370, '013', 'Azoyú', '0001', 'Azoyú', '2019-07-16 09:28:40', '12'),
(371, '013', 'Atotonilco de Tula', '0001', 'Atotonilco de Tula', '2019-07-16 09:28:43', '13'),
(372, '013', 'Atotonilco el Alto', '0001', 'Atotonilco el Alto', '2019-07-16 09:28:46', '14'),
(373, '013', 'Atizapán de Zaragoza', '0001', 'Ciudad López Mateos', '2019-07-16 09:28:52', '15'),
(374, '013', 'Carácuaro', '0001', 'Carácuaro de Morelos', '2019-07-16 09:28:57', '16'),
(375, '013', 'Jonacatepec', '0001', 'Jonacatepec', '2019-07-16 09:29:02', '17'),
(376, '013', 'San Pedro Lagunillas', '0001', 'San Pedro Lagunillas', '2019-07-16 09:29:03', '18'),
(377, '013', 'China', '0001', 'China', '2019-07-16 09:29:04', '19'),
(378, '013', 'Ciénega de Zimatlán', '0001', 'Ciénega de Zimatlán', '2019-07-16 09:29:06', '20'),
(379, '013', 'Altepexi', '0001', 'Altepexi', '2019-07-16 09:29:30', '21'),
(380, '013', 'Peñamiller', '0001', 'Peñamiller', '2019-07-16 09:29:40', '22'),
(381, '013', 'Ciudad Valles', '0001', 'Ciudad Valles', '2019-07-16 09:29:41', '24'),
(382, '013', 'Mocorito', '0001', 'Mocorito', '2019-07-16 09:29:43', '25'),
(383, '013', 'Banámichi', '0001', 'Banámichi', '2019-07-16 09:29:44', '26'),
(384, '013', 'Nacajuca', '0001', 'Nacajuca', '2019-07-16 09:29:48', '27'),
(385, '013', 'Güémez', '0001', 'Güémez', '2019-07-16 09:29:49', '28'),
(386, '013', 'Huamantla', '0001', 'Huamantla', '2019-07-16 09:29:51', '29'),
(387, '013', 'Naranjos Amatlán', '0001', 'Naranjos', '2019-07-16 09:29:53', '30'),
(388, '013', 'Conkal', '0001', 'Conkal', '2019-07-16 09:30:01', '31'),
(389, '013', 'General Enrique Estrada', '0001', 'General Enrique Estrada', '2019-07-16 09:30:06', '32'),
(390, '014', 'Jiménez', '0001', 'Jiménez', '2019-07-16 09:28:26', '05'),
(391, '014', 'El Bosque', '0001', 'El Bosque', '2019-07-16 09:28:29', '07'),
(392, '014', 'Coronado', '0001', 'José Esteban Coronado', '2019-07-16 09:28:33', '08'),
(393, '014', 'Benito Juárez', '----', '', '2019-07-16 09:28:36', '09'),
(394, '014', 'Mezquital', '0001', 'San Francisco del Mezquital', '2019-07-16 09:28:36', '10'),
(395, '014', 'Dolores Hidalgo Cuna de la Independencia Nacional', '0001', 'Dolores Hidalgo Cuna de la Independencia Nacional', '2019-07-16 09:28:38', '11'),
(396, '014', 'Benito Juárez', '0001', 'San Jerónimo de Juárez', '2019-07-16 09:28:40', '12'),
(397, '014', 'Calnali', '0001', 'Calnali', '2019-07-16 09:28:43', '13'),
(398, '014', 'Atoyac', '0001', 'Atoyac', '2019-07-16 09:28:46', '14'),
(399, '014', 'Atlacomulco', '0001', 'Atlacomulco de Fabela', '2019-07-16 09:28:52', '15'),
(400, '014', 'Coahuayana', '0001', 'Coahuayana de Hidalgo', '2019-07-16 09:28:57', '16'),
(401, '014', 'Mazatepec', '0001', 'Mazatepec', '2019-07-16 09:29:02', '17'),
(402, '014', 'Santa María del Oro', '0001', 'Santa María del Oro', '2019-07-16 09:29:03', '18'),
(403, '014', 'Doctor Arroyo', '0001', 'Doctor Arroyo', '2019-07-16 09:29:04', '19'),
(404, '014', 'Ciudad Ixtepec', '0001', 'Ciudad Ixtepec', '2019-07-16 09:29:06', '20'),
(405, '014', 'Amixtlán', '0001', 'Amixtlán', '2019-07-16 09:29:30', '21'),
(406, '014', 'Querétaro', '0001', 'Santiago de Querétaro', '2019-07-16 09:29:40', '22'),
(407, '014', 'Coxcatlán', '0001', 'Coxcatlán', '2019-07-16 09:29:41', '24'),
(408, '014', 'Rosario', '0001', 'El Rosario', '2019-07-16 09:29:44', '25'),
(409, '014', 'Baviácora', '0001', 'Baviácora', '2019-07-16 09:29:44', '26'),
(410, '014', 'Paraíso', '0001', 'Paraíso', '2019-07-16 09:29:48', '27'),
(411, '014', 'Guerrero', '0001', 'Nueva Ciudad Guerrero', '2019-07-16 09:29:49', '28'),
(412, '014', 'Hueyotlipan', '0001', 'Hueyotlipan', '2019-07-16 09:29:51', '29'),
(413, '014', 'Amatlán de los Reyes', '0001', 'Amatlán de los Reyes', '2019-07-16 09:29:53', '30'),
(414, '014', 'Cuncunul', '0001', 'Cuncunul', '2019-07-16 09:30:02', '31'),
(415, '014', 'General Francisco R. Murguía', '0001', 'Nieves', '2019-07-16 09:30:06', '32'),
(416, '015', 'Juárez', '0001', 'Juárez', '2019-07-16 09:28:27', '05'),
(417, '015', 'Cacahoatán', '0001', 'Cacahoatán', '2019-07-16 09:28:29', '07'),
(418, '015', 'Coyame del Sotol', '0001', 'Santiago de Coyame', '2019-07-16 09:28:33', '08'),
(419, '015', 'Cuauhtémoc', '----', '', '2019-07-16 09:28:36', '09'),
(420, '015', 'Nazas', '0001', 'Nazas', '2019-07-16 09:28:36', '10'),
(421, '015', 'Guanajuato', '0001', 'Guanajuato', '2019-07-16 09:28:38', '11'),
(422, '015', 'Buenavista de Cuéllar', '0001', 'Buenavista de Cuéllar', '2019-07-16 09:28:40', '12'),
(423, '015', 'Cardonal', '0001', 'Cardonal', '2019-07-16 09:28:43', '13'),
(424, '015', 'Autlán de Navarro', '0001', 'Autlán de Navarro', '2019-07-16 09:28:46', '14'),
(425, '015', 'Atlautla', '0001', 'Atlautla de Victoria', '2019-07-16 09:28:52', '15'),
(426, '015', 'Coalcomán de Vázquez Pallares', '0001', 'Coalcomán de Vázquez Pallares', '2019-07-16 09:28:57', '16'),
(427, '015', 'Miacatlán', '0001', 'Miacatlán', '2019-07-16 09:29:02', '17'),
(428, '015', 'Santiago Ixcuintla', '0001', 'Santiago Ixcuintla', '2019-07-16 09:29:03', '18'),
(429, '015', 'Doctor Coss', '0001', 'Doctor Coss', '2019-07-16 09:29:04', '19'),
(430, '015', 'Coatecas Altas', '0001', 'Coatecas Altas', '2019-07-16 09:29:06', '20'),
(431, '015', 'Amozoc', '0001', 'Amozoc de Mota', '2019-07-16 09:29:30', '21'),
(432, '015', 'San Joaquín', '0001', 'San Joaquín', '2019-07-16 09:29:40', '22'),
(433, '015', 'Charcas', '0001', 'Charcas', '2019-07-16 09:29:41', '24'),
(434, '015', 'Salvador Alvarado', '0001', 'Guamúchil', '2019-07-16 09:29:44', '25'),
(435, '015', 'Bavispe', '0001', 'Bavispe', '2019-07-16 09:29:44', '26'),
(436, '015', 'Tacotalpa', '0001', 'Tacotalpa', '2019-07-16 09:29:48', '27'),
(437, '015', 'Gustavo Díaz Ordaz', '0001', 'Ciudad Gustavo Díaz Ordaz', '2019-07-16 09:29:49', '28'),
(438, '015', 'Ixtacuixtla de Mariano Matamoros', '0001', 'Villa Mariano Matamoros', '2019-07-16 09:29:51', '29'),
(439, '015', 'Angel R. Cabada', '0001', 'Ángel R. Cabada', '2019-07-16 09:29:53', '30'),
(440, '015', 'Cuzamá', '0001', 'Cuzamá', '2019-07-16 09:30:02', '31'),
(441, '015', 'El Plateado de Joaquín Amaro', '0001', 'El Plateado de Joaquín Amaro', '2019-07-16 09:30:06', '32'),
(442, '016', 'Lamadrid', '0001', 'Lamadrid', '2019-07-16 09:28:27', '05'),
(443, '016', 'Catazajá', '0001', 'Catazajá', '2019-07-16 09:28:29', '07'),
(444, '016', 'La Cruz', '0001', 'La Cruz', '2019-07-16 09:28:33', '08'),
(445, '016', 'Miguel Hidalgo', '----', '', '2019-07-16 09:28:36', '09'),
(446, '016', 'Nombre de Dios', '0001', 'Nombre de Dios', '2019-07-16 09:28:36', '10'),
(447, '016', 'Huanímaro', '0001', 'Huanímaro', '2019-07-16 09:28:38', '11'),
(448, '016', 'Coahuayutla de José María Izazaga', '0001', 'Coahuayutla de Guerrero', '2019-07-16 09:28:40', '12'),
(449, '016', 'Cuautepec de Hinojosa', '0001', 'Cuautepec de Hinojosa', '2019-07-16 09:28:43', '13'),
(450, '016', 'Ayotlán', '0001', 'Ayotlán', '2019-07-16 09:28:46', '14'),
(451, '016', 'Axapusco', '0001', 'Axapusco', '2019-07-16 09:28:52', '15'),
(452, '016', 'Coeneo', '0001', 'Coeneo de la Libertad', '2019-07-16 09:28:57', '16'),
(453, '016', 'Ocuituco', '0001', 'Ocuituco', '2019-07-16 09:29:02', '17'),
(454, '016', 'Tecuala', '0001', 'Tecuala', '2019-07-16 09:29:03', '18'),
(455, '016', 'Doctor González', '0001', 'Doctor González', '2019-07-16 09:29:04', '19'),
(456, '016', 'Coicoyán de las Flores', '0001', 'Coicoyán de las Flores', '2019-07-16 09:29:06', '20'),
(457, '016', 'Aquixtla', '0001', 'Aquixtla', '2019-07-16 09:29:31', '21'),
(458, '016', 'San Juan del Río', '0001', 'San Juan del Río', '2019-07-16 09:29:40', '22'),
(459, '016', 'Ebano', '0001', 'Ebano', '2019-07-16 09:29:41', '24'),
(460, '016', 'San Ignacio', '0001', 'San Ignacio', '2019-07-16 09:29:44', '25'),
(461, '016', 'Benjamín Hill', '0001', 'Benjamín Hill', '2019-07-16 09:29:44', '26'),
(462, '016', 'Teapa', '0001', 'Teapa', '2019-07-16 09:29:48', '27'),
(463, '016', 'Hidalgo', '0001', 'Hidalgo', '2019-07-16 09:29:49', '28'),
(464, '016', 'Ixtenco', '0001', 'Ixtenco', '2019-07-16 09:29:51', '29'),
(465, '016', 'La Antigua', '0001', 'José Cardel', '2019-07-16 09:29:53', '30'),
(466, '016', 'Chacsinkín', '0001', 'Chacsinkín', '2019-07-16 09:30:02', '31'),
(467, '016', 'General Pánfilo Natera', '0001', 'General Pánfilo Natera', '2019-07-16 09:30:06', '32'),
(468, '017', 'Matamoros', '0001', 'Matamoros', '2019-07-16 09:28:27', '05'),
(469, '017', 'Cintalapa', '0001', 'Cintalapa de Figueroa', '2019-07-16 09:28:29', '07'),
(470, '017', 'Cuauhtémoc', '0001', 'Cuauhtémoc', '2019-07-16 09:28:33', '08'),
(471, '017', 'Venustiano Carranza', '----', '', '2019-07-16 09:28:36', '09'),
(472, '017', 'Ocampo', '0001', 'Villa Ocampo', '2019-07-16 09:28:36', '10'),
(473, '017', 'Irapuato', '0001', 'Irapuato', '2019-07-16 09:28:38', '11'),
(474, '017', 'Cocula', '0001', 'Cocula', '2019-07-16 09:28:40', '12'),
(475, '017', 'Chapantongo', '0001', 'Chapantongo', '2019-07-16 09:28:43', '13'),
(476, '017', 'Ayutla', '0001', 'Ayutla', '2019-07-16 09:28:46', '14'),
(477, '017', 'Ayapango', '0001', 'Ayapango de Gabriel Ramos M.', '2019-07-16 09:28:52', '15'),
(478, '017', 'Contepec', '0001', 'Contepec', '2019-07-16 09:28:57', '16'),
(479, '017', 'Puente de Ixtla', '0001', 'Puente de Ixtla', '2019-07-16 09:29:02', '17'),
(480, '017', 'Tepic', '0001', 'Tepic', '2019-07-16 09:29:03', '18'),
(481, '017', 'Galeana', '0001', 'Galeana', '2019-07-16 09:29:04', '19'),
(482, '017', 'La Compañía', '0001', 'La Compañía', '2019-07-16 09:29:06', '20'),
(483, '017', 'Atempan', '0001', 'Atempan', '2019-07-16 09:29:31', '21'),
(484, '017', 'Tequisquiapan', '0001', 'Tequisquiapan', '2019-07-16 09:29:40', '22'),
(485, '017', 'Guadalcázar', '0001', 'Guadalcázar', '2019-07-16 09:29:41', '24'),
(486, '017', 'Sinaloa', '0001', 'Sinaloa de Leyva', '2019-07-16 09:29:44', '25'),
(487, '017', 'Caborca', '0001', 'Heroica Caborca', '2019-07-16 09:29:44', '26'),
(488, '017', 'Tenosique', '0001', 'Tenosique de Pino Suárez', '2019-07-16 09:29:48', '27'),
(489, '017', 'Jaumave', '0001', 'Jaumave', '2019-07-16 09:29:49', '28'),
(490, '017', 'Mazatecochco de José María Morelos', '0001', 'Mazatecochco', '2019-07-16 09:29:51', '29'),
(491, '017', 'Apazapan', '0001', 'Apazapan', '2019-07-16 09:29:53', '30'),
(492, '017', 'Chankom', '0001', 'Chankom', '2019-07-16 09:30:02', '31'),
(493, '017', 'Guadalupe', '0001', 'Guadalupe', '2019-07-16 09:30:07', '32'),
(494, '018', 'Monclova', '0001', 'Monclova', '2019-07-16 09:28:27', '05'),
(495, '018', 'Coapilla', '0001', 'Coapilla', '2019-07-16 09:28:29', '07'),
(496, '018', 'Cusihuiriachi', '0001', 'Cusihuiriachi', '2019-07-16 09:28:33', '08'),
(497, '018', 'El Oro', '0001', 'Santa María del Oro', '2019-07-16 09:28:36', '10'),
(498, '018', 'Jaral del Progreso', '0001', 'Jaral del Progreso', '2019-07-16 09:28:38', '11'),
(499, '018', 'Copala', '0001', 'Copala', '2019-07-16 09:28:40', '12'),
(500, '018', 'Chapulhuacán', '0001', 'Chapulhuacán', '2019-07-16 09:28:43', '13'),
(501, '018', 'La Barca', '0001', 'La Barca', '2019-07-16 09:28:47', '14'),
(502, '018', 'Calimaya', '0001', 'Calimaya de Díaz González', '2019-07-16 09:28:52', '15'),
(503, '018', 'Copándaro', '0001', 'Copándaro de Galeana', '2019-07-16 09:28:57', '16'),
(504, '018', 'Temixco', '0001', 'Temixco', '2019-07-16 09:29:02', '17'),
(505, '018', 'Tuxpan', '0001', 'Tuxpan', '2019-07-16 09:29:03', '18'),
(506, '018', 'García', '0001', 'García', '2019-07-16 09:29:04', '19'),
(507, '018', 'Concepción Buenavista', '0001', 'Concepción Buenavista', '2019-07-16 09:29:06', '20'),
(508, '018', 'Atexcal', '0001', 'San Martín Atexcal', '2019-07-16 09:29:31', '21'),
(509, '018', 'Tolimán', '0001', 'Tolimán', '2019-07-16 09:29:40', '22'),
(510, '018', 'Huehuetlán', '0001', 'Huehuetlán', '2019-07-16 09:29:41', '24'),
(511, '018', 'Navolato', '0001', 'Navolato', '2019-07-16 09:29:44', '25'),
(512, '018', 'Cajeme', '0001', 'Ciudad Obregón', '2019-07-16 09:29:44', '26'),
(513, '018', 'Jiménez', '0001', 'Santander Jiménez', '2019-07-16 09:29:49', '28'),
(514, '018', 'Contla de Juan Cuamatzi', '0001', 'Contla', '2019-07-16 09:29:51', '29'),
(515, '018', 'Aquila', '0001', 'Aquila', '2019-07-16 09:29:53', '30'),
(516, '018', 'Chapab', '0001', 'Chapab', '2019-07-16 09:30:02', '31'),
(517, '018', 'Huanusco', '0001', 'Huanusco', '2019-07-16 09:30:07', '32'),
(518, '019', 'Morelos', '0001', 'Morelos', '2019-07-16 09:28:27', '05'),
(519, '019', 'Comitán de Domínguez', '0001', 'Comitán de Domínguez', '2019-07-16 09:28:29', '07'),
(520, '019', 'Chihuahua', '0001', 'Chihuahua', '2019-07-16 09:28:33', '08'),
(521, '019', 'Otáez', '0001', 'Otáez', '2019-07-16 09:28:36', '10'),
(522, '019', 'Jerécuaro', '0001', 'Jerécuaro', '2019-07-16 09:28:38', '11'),
(523, '019', 'Copalillo', '0001', 'Copalillo', '2019-07-16 09:28:40', '12'),
(524, '019', 'Chilcuautla', '0001', 'Chilcuautla', '2019-07-16 09:28:43', '13'),
(525, '019', 'Bolaños', '0001', 'Bolaños', '2019-07-16 09:28:47', '14'),
(526, '019', 'Capulhuac', '0001', 'Capulhuac de Mirafuentes', '2019-07-16 09:28:52', '15'),
(527, '019', 'Cotija', '0001', 'Cotija de la Paz', '2019-07-16 09:28:57', '16'),
(528, '019', 'Tepalcingo', '0001', 'Tepalcingo', '2019-07-16 09:29:02', '17'),
(529, '019', 'La Yesca', '0001', 'La Yesca', '2019-07-16 09:29:03', '18'),
(530, '019', 'San Pedro Garza García', '0001', 'San Pedro Garza García', '2019-07-16 09:29:04', '19'),
(531, '019', 'Concepción Pápalo', '0001', 'Concepción Pápalo', '2019-07-16 09:29:06', '20'),
(532, '019', 'Atlixco', '0001', 'Atlixco', '2019-07-16 09:29:31', '21'),
(533, '019', 'Lagunillas', '0001', 'Lagunillas', '2019-07-16 09:29:41', '24'),
(534, '019', 'Cananea', '0001', 'Heroica Ciudad de Cananea', '2019-07-16 09:29:44', '26'),
(535, '019', 'Llera', '0001', 'Llera de Canales', '2019-07-16 09:29:49', '28'),
(536, '019', 'Tepetitla de Lardizábal', '0001', 'Tepetitla', '2019-07-16 09:29:51', '29'),
(537, '019', 'Astacinga', '0001', 'Astacinga', '2019-07-16 09:29:53', '30'),
(538, '019', 'Chemax', '0001', 'Chemax', '2019-07-16 09:30:02', '31'),
(539, '019', 'Jalpa', '0001', 'Jalpa', '2019-07-16 09:30:07', '32'),
(540, '020', 'Múzquiz', '0001', 'Ciudad Melchor Múzquiz', '2019-07-16 09:28:27', '05'),
(541, '020', 'La Concordia', '0001', 'La Concordia', '2019-07-16 09:28:29', '07'),
(542, '020', 'Chínipas', '0001', 'Chínipas de Almada', '2019-07-16 09:28:33', '08'),
(543, '020', 'Pánuco de Coronado', '0001', 'Francisco I. Madero', '2019-07-16 09:28:37', '10'),
(544, '020', 'León', '0001', 'León de los Aldama', '2019-07-16 09:28:38', '11'),
(545, '020', 'Copanatoyac', '0001', 'Copanatoyac', '2019-07-16 09:28:40', '12'),
(546, '020', 'Eloxochitlán', '0001', 'Eloxochitlán', '2019-07-16 09:28:43', '13'),
(547, '020', 'Cabo Corrientes', '0001', 'El Tuito', '2019-07-16 09:28:47', '14'),
(548, '020', 'Coacalco de Berriozábal', '0001', 'San Francisco Coacalco', '2019-07-16 09:28:52', '15'),
(549, '020', 'Cuitzeo', '0001', 'Cuitzeo del Porvenir', '2019-07-16 09:28:57', '16'),
(550, '020', 'Tepoztlán', '0001', 'Tepoztlán', '2019-07-16 09:29:02', '17'),
(551, '020', 'Bahía de Banderas', '0001', 'Valle de Banderas', '2019-07-16 09:29:03', '18'),
(552, '020', 'General Bravo', '0001', 'General Bravo', '2019-07-16 09:29:04', '19'),
(553, '020', 'Constancia del Rosario', '0001', 'Constancia del Rosario', '2019-07-16 09:29:06', '20'),
(554, '020', 'Atoyatempan', '0001', 'Atoyatempan', '2019-07-16 09:29:31', '21'),
(555, '020', 'Matehuala', '0001', 'Matehuala', '2019-07-16 09:29:41', '24'),
(556, '020', 'Carbó', '0001', 'Carbó', '2019-07-16 09:29:44', '26'),
(557, '020', 'Mainero', '0001', 'Villa Mainero', '2019-07-16 09:29:49', '28'),
(558, '020', 'Sanctórum de Lázaro Cárdenas', '0001', 'Sanctórum', '2019-07-16 09:29:51', '29'),
(559, '020', 'Atlahuilco', '0001', 'Atlahuilco', '2019-07-16 09:29:53', '30'),
(560, '020', 'Chicxulub Pueblo', '0001', 'Chicxulub Pueblo', '2019-07-16 09:30:02', '31'),
(561, '020', 'Jerez', '0001', 'Jerez de García Salinas', '2019-07-16 09:30:07', '32'),
(562, '021', 'Nadadores', '0001', 'Nadadores', '2019-07-16 09:28:27', '05'),
(563, '021', 'Copainalá', '0001', 'Copainalá', '2019-07-16 09:28:29', '07'),
(564, '021', 'Delicias', '0001', 'Delicias', '2019-07-16 09:28:33', '08'),
(565, '021', 'Peñón Blanco', '0001', 'Peñón Blanco', '2019-07-16 09:28:37', '10'),
(566, '021', 'Moroleón', '0001', 'Moroleón', '2019-07-16 09:28:38', '11'),
(567, '021', 'Coyuca de Benítez', '0001', 'Coyuca de Benítez', '2019-07-16 09:28:40', '12'),
(568, '021', 'Emiliano Zapata', '0001', 'Emiliano Zapata', '2019-07-16 09:28:43', '13'),
(569, '021', 'Casimiro Castillo', '0001', 'La Resolana', '2019-07-16 09:28:47', '14'),
(570, '021', 'Coatepec Harinas', '0001', 'Coatepec Harinas', '2019-07-16 09:28:52', '15'),
(571, '021', 'Charapan', '0001', 'Charapan', '2019-07-16 09:28:57', '16'),
(572, '021', 'Tetecala', '0001', 'Tetecala', '2019-07-16 09:29:02', '17'),
(573, '021', 'General Escobedo', '0001', 'Ciudad General Escobedo', '2019-07-16 09:29:04', '19'),
(574, '021', 'Cosolapa', '0001', 'Cosolapa', '2019-07-16 09:29:06', '20'),
(575, '021', 'Atzala', '0001', 'Atzala', '2019-07-16 09:29:31', '21'),
(576, '021', 'Mexquitic de Carmona', '0001', 'Mexquitic de Carmona', '2019-07-16 09:29:41', '24'),
(577, '021', 'La Colorada', '0001', 'La Colorada', '2019-07-16 09:29:44', '26'),
(578, '021', 'El Mante', '0001', 'Ciudad Mante', '2019-07-16 09:29:49', '28'),
(579, '021', 'Nanacamilpa de Mariano Arista', '0001', 'Ciudad de Nanacamilpa', '2019-07-16 09:29:51', '29'),
(580, '021', 'Atoyac', '0001', 'Atoyac', '2019-07-16 09:29:53', '30'),
(581, '021', 'Chichimilá', '0001', 'Chichimilá', '2019-07-16 09:30:02', '31'),
(582, '021', 'Jiménez del Teul', '0001', 'Jiménez del Teul', '2019-07-16 09:30:07', '32'),
(583, '022', 'Nava', '0001', 'Nava', '2019-07-16 09:28:27', '05'),
(584, '022', 'Chalchihuitán', '0001', 'Chalchihuitán', '2019-07-16 09:28:29', '07'),
(585, '022', 'Dr. Belisario Domínguez', '0001', 'San Lorenzo', '2019-07-16 09:28:33', '08'),
(586, '022', 'Poanas', '0001', 'Villa Unión', '2019-07-16 09:28:37', '10'),
(587, '022', 'Ocampo', '0001', 'Ocampo', '2019-07-16 09:28:38', '11'),
(588, '022', 'Coyuca de Catalán', '0001', 'Coyuca de Catalán', '2019-07-16 09:28:40', '12'),
(589, '022', 'Epazoyucan', '0001', 'Epazoyucan', '2019-07-16 09:28:43', '13'),
(590, '022', 'Cihuatlán', '0001', 'Cihuatlán', '2019-07-16 09:28:47', '14'),
(591, '022', 'Cocotitlán', '0001', 'Cocotitlán', '2019-07-16 09:28:52', '15'),
(592, '022', 'Charo', '0001', 'Charo', '2019-07-16 09:28:57', '16'),
(593, '022', 'Tetela del Volcán', '0001', 'Tetela del Volcán', '2019-07-16 09:29:02', '17'),
(594, '022', 'General Terán', '0001', 'Ciudad General Terán', '2019-07-16 09:29:04', '19'),
(595, '022', 'Cosoltepec', '0001', 'Cosoltepec', '2019-07-16 09:29:06', '20'),
(596, '022', 'Atzitzihuacán', '0001', 'Santiago Atzitzihuacán', '2019-07-16 09:29:31', '21'),
(597, '022', 'Moctezuma', '0001', 'Moctezuma', '2019-07-16 09:29:41', '24'),
(598, '022', 'Cucurpe', '0001', 'Cucurpe', '2019-07-16 09:29:44', '26'),
(599, '022', 'Matamoros', '0001', 'Heroica Matamoros', '2019-07-16 09:29:49', '28'),
(600, '022', 'Acuamanala de Miguel Hidalgo', '0001', 'Acuamanala', '2019-07-16 09:29:51', '29'),
(601, '022', 'Atzacan', '0001', 'Atzacan', '2019-07-16 09:29:53', '30'),
(602, '022', 'Chikindzonot', '0001', 'Chikindzonot', '2019-07-16 09:30:02', '31'),
(603, '022', 'Juan Aldama', '0001', 'Juan Aldama', '2019-07-16 09:30:07', '32'),
(604, '023', 'Ocampo', '0001', 'Ocampo', '2019-07-16 09:28:27', '05'),
(605, '023', 'Chamula', '0001', 'Chamula', '2019-07-16 09:28:29', '07'),
(606, '023', 'Galeana', '0001', 'Hermenegildo Galeana', '2019-07-16 09:28:33', '08'),
(607, '023', 'Pueblo Nuevo', '0001', 'El Salto', '2019-07-16 09:28:37', '10'),
(608, '023', 'Pénjamo', '0001', 'Pénjamo', '2019-07-16 09:28:38', '11'),
(609, '023', 'Cuajinicuilapa', '0001', 'Cuajinicuilapa', '2019-07-16 09:28:40', '12'),
(610, '023', 'Francisco I. Madero', '0001', 'Tepatepec', '2019-07-16 09:28:43', '13'),
(611, '023', 'Zapotlán el Grande', '0001', 'Ciudad Guzmán', '2019-07-16 09:28:47', '14'),
(612, '023', 'Coyotepec', '0001', 'Coyotepec', '2019-07-16 09:28:52', '15'),
(613, '023', 'Chavinda', '0001', 'Chavinda', '2019-07-16 09:28:57', '16'),
(614, '023', 'Tlalnepantla', '0001', 'Tlalnepantla', '2019-07-16 09:29:02', '17'),
(615, '023', 'General Treviño', '0001', 'General Treviño', '2019-07-16 09:29:04', '19'),
(616, '023', 'Cuilápam de Guerrero', '0001', 'Cuilápam de Guerrero', '2019-07-16 09:29:06', '20'),
(617, '023', 'Atzitzintla', '0001', 'Atzitzintla', '2019-07-16 09:29:31', '21'),
(618, '023', 'Rayón', '0001', 'Rayón', '2019-07-16 09:29:42', '24'),
(619, '023', 'Cumpas', '0001', 'Cumpas', '2019-07-16 09:29:45', '26'),
(620, '023', 'Méndez', '0001', 'Méndez', '2019-07-16 09:29:49', '28'),
(621, '023', 'Natívitas', '0001', 'Natívitas', '2019-07-16 09:29:51', '29'),
(622, '023', 'Atzalan', '0001', 'Atzalan', '2019-07-16 09:29:53', '30'),
(623, '023', 'Chocholá', '0001', 'Chocholá', '2019-07-16 09:30:02', '31'),
(624, '023', 'Juchipila', '0001', 'Juchipila', '2019-07-16 09:30:07', '32'),
(625, '024', 'Parras', '0001', 'Parras de la Fuente', '2019-07-16 09:28:27', '05'),
(626, '024', 'Chanal', '0001', 'Chanal', '2019-07-16 09:28:29', '07');
INSERT INTO `municipio` (`idm`, `cve_mun`, `nom_mun`, `cve_cab`, `nom_cab`, `fechaModificacion`, `cve_ent`) VALUES
(627, '024', 'Santa Isabel', '0001', 'Santa Isabel', '2019-07-16 09:28:33', '08'),
(628, '024', 'Rodeo', '0001', 'Rodeo', '2019-07-16 09:28:37', '10'),
(629, '024', 'Pueblo Nuevo', '0001', 'Pueblo Nuevo', '2019-07-16 09:28:38', '11'),
(630, '024', 'Cualác', '0001', 'Cualác', '2019-07-16 09:28:40', '12'),
(631, '024', 'Huasca de Ocampo', '0001', 'Huasca de Ocampo', '2019-07-16 09:28:43', '13'),
(632, '024', 'Cocula', '0001', 'Cocula', '2019-07-16 09:28:47', '14'),
(633, '024', 'Cuautitlán', '0001', 'Cuautitlán', '2019-07-16 09:28:52', '15'),
(634, '024', 'Cherán', '0001', 'Cherán', '2019-07-16 09:28:57', '16'),
(635, '024', 'Tlaltizapán de Zapata', '0001', 'Tlaltizapán', '2019-07-16 09:29:02', '17'),
(636, '024', 'General Zaragoza', '0001', 'General Zaragoza', '2019-07-16 09:29:04', '19'),
(637, '024', 'Cuyamecalco Villa de Zaragoza', '0001', 'Cuyamecalco Villa de Zaragoza', '2019-07-16 09:29:06', '20'),
(638, '024', 'Axutla', '0001', 'Axutla', '2019-07-16 09:29:31', '21'),
(639, '024', 'Rioverde', '0001', 'Rioverde', '2019-07-16 09:29:42', '24'),
(640, '024', 'Divisaderos', '0001', 'Divisaderos', '2019-07-16 09:29:45', '26'),
(641, '024', 'Mier', '0001', 'Mier', '2019-07-16 09:29:49', '28'),
(642, '024', 'Panotla', '0001', 'Panotla', '2019-07-16 09:29:51', '29'),
(643, '024', 'Tlaltetela', '0001', 'Tlaltetela', '2019-07-16 09:29:53', '30'),
(644, '024', 'Chumayel', '0001', 'Chumayel', '2019-07-16 09:30:02', '31'),
(645, '024', 'Loreto', '0001', 'Loreto', '2019-07-16 09:30:07', '32'),
(646, '025', 'Piedras Negras', '0001', 'Piedras Negras', '2019-07-16 09:28:27', '05'),
(647, '025', 'Chapultenango', '0001', 'Chapultenango', '2019-07-16 09:28:29', '07'),
(648, '025', 'Gómez Farías', '0001', 'Valentín Gómez Farías', '2019-07-16 09:28:33', '08'),
(649, '025', 'San Bernardo', '0001', 'San Bernardo', '2019-07-16 09:28:37', '10'),
(650, '025', 'Purísima del Rincón', '0001', 'Purísima de Bustos', '2019-07-16 09:28:38', '11'),
(651, '025', 'Cuautepec', '0001', 'Cuautepec', '2019-07-16 09:28:40', '12'),
(652, '025', 'Huautla', '0001', 'Huautla', '2019-07-16 09:28:43', '13'),
(653, '025', 'Colotlán', '0001', 'Colotlán', '2019-07-16 09:28:47', '14'),
(654, '025', 'Chalco', '0001', 'Chalco de Díaz Covarrubias', '2019-07-16 09:28:52', '15'),
(655, '025', 'Chilchota', '0001', 'Chilchota', '2019-07-16 09:28:57', '16'),
(656, '025', 'Tlaquiltenango', '0001', 'Tlaquiltenango', '2019-07-16 09:29:02', '17'),
(657, '025', 'General Zuazua', '0001', 'General Zuazua', '2019-07-16 09:29:04', '19'),
(658, '025', 'Chahuites', '0001', 'Chahuites', '2019-07-16 09:29:06', '20'),
(659, '025', 'Ayotoxco de Guerrero', '0001', 'Ayotoxco de Guerrero', '2019-07-16 09:29:31', '21'),
(660, '025', 'Salinas', '0001', 'Salinas de Hidalgo', '2019-07-16 09:29:42', '24'),
(661, '025', 'Empalme', '0001', 'Empalme', '2019-07-16 09:29:45', '26'),
(662, '025', 'Miguel Alemán', '0001', 'Ciudad Miguel Alemán', '2019-07-16 09:29:49', '28'),
(663, '025', 'San Pablo del Monte', '0001', 'Villa Vicente Guerrero', '2019-07-16 09:29:51', '29'),
(664, '025', 'Ayahualulco', '0001', 'Ayahualulco', '2019-07-16 09:29:53', '30'),
(665, '025', 'Dzán', '0001', 'Dzán', '2019-07-16 09:30:02', '31'),
(666, '025', 'Luis Moya', '0001', 'Luis Moya', '2019-07-16 09:30:07', '32'),
(667, '026', 'Progreso', '0001', 'Progreso', '2019-07-16 09:28:27', '05'),
(668, '026', 'Chenalhó', '0001', 'Chenalhó', '2019-07-16 09:28:29', '07'),
(669, '026', 'Gran Morelos', '0001', 'San Nicolás de Carretas', '2019-07-16 09:28:33', '08'),
(670, '026', 'San Dimas', '0001', 'Tayoltita', '2019-07-16 09:28:37', '10'),
(671, '026', 'Romita', '0001', 'Romita', '2019-07-16 09:28:38', '11'),
(672, '026', 'Cuetzala del Progreso', '0001', 'Cuetzala del Progreso', '2019-07-16 09:28:40', '12'),
(673, '026', 'Huazalingo', '0001', 'Huazalingo', '2019-07-16 09:28:43', '13'),
(674, '026', 'Concepción de Buenos Aires', '0001', 'Concepción de Buenos Aires', '2019-07-16 09:28:47', '14'),
(675, '026', 'Chapa de Mota', '0001', 'Chapa de Mota', '2019-07-16 09:28:52', '15'),
(676, '026', 'Chinicuila', '0001', 'Villa Victoria', '2019-07-16 09:28:57', '16'),
(677, '026', 'Tlayacapan', '0001', 'Tlayacapan', '2019-07-16 09:29:02', '17'),
(678, '026', 'Guadalupe', '0001', 'Guadalupe', '2019-07-16 09:29:04', '19'),
(679, '026', 'Chalcatongo de Hidalgo', '0001', 'Chalcatongo de Hidalgo', '2019-07-16 09:29:06', '20'),
(680, '026', 'Calpan', '0001', 'San Andrés Calpan', '2019-07-16 09:29:31', '21'),
(681, '026', 'San Antonio', '0001', 'San Antonio', '2019-07-16 09:29:42', '24'),
(682, '026', 'Etchojoa', '0001', 'Etchojoa', '2019-07-16 09:29:45', '26'),
(683, '026', 'Miquihuana', '0001', 'Miquihuana', '2019-07-16 09:29:49', '28'),
(684, '026', 'Santa Cruz Tlaxcala', '0001', 'Santa Cruz Tlaxcala', '2019-07-16 09:29:51', '29'),
(685, '026', 'Banderilla', '0001', 'Banderilla', '2019-07-16 09:29:53', '30'),
(686, '026', 'Dzemul', '0001', 'Dzemul', '2019-07-16 09:30:02', '31'),
(687, '026', 'Mazapil', '0001', 'Mazapil', '2019-07-16 09:30:07', '32'),
(688, '027', 'Ramos Arizpe', '0001', 'Ramos Arizpe', '2019-07-16 09:28:27', '05'),
(689, '027', 'Chiapa de Corzo', '0001', 'Chiapa de Corzo', '2019-07-16 09:28:29', '07'),
(690, '027', 'Guachochi', '0001', 'Guachochi', '2019-07-16 09:28:33', '08'),
(691, '027', 'San Juan de Guadalupe', '0001', 'San Juan de Guadalupe', '2019-07-16 09:28:37', '10'),
(692, '027', 'Salamanca', '0001', 'Salamanca', '2019-07-16 09:28:38', '11'),
(693, '027', 'Cutzamala de Pinzón', '0001', 'Cutzamala de Pinzón', '2019-07-16 09:28:40', '12'),
(694, '027', 'Huehuetla', '0001', 'Huehuetla', '2019-07-16 09:28:43', '13'),
(695, '027', 'Cuautitlán de García Barragán', '0001', 'Cuautitlán de García Barragán', '2019-07-16 09:28:47', '14'),
(696, '027', 'Chapultepec', '0001', 'Chapultepec', '2019-07-16 09:28:52', '15'),
(697, '027', 'Chucándiro', '0001', 'Chucándiro', '2019-07-16 09:28:57', '16'),
(698, '027', 'Totolapan', '0001', 'Totolapan', '2019-07-16 09:29:02', '17'),
(699, '027', 'Los Herreras', '0001', 'Los Herreras', '2019-07-16 09:29:04', '19'),
(700, '027', 'Chiquihuitlán de Benito Juárez', '0001', 'Chiquihuitlán de Benito Juárez', '2019-07-16 09:29:06', '20'),
(701, '027', 'Caltepec', '0001', 'Caltepec', '2019-07-16 09:29:31', '21'),
(702, '027', 'San Ciro de Acosta', '0001', 'San Ciro de Acosta', '2019-07-16 09:29:42', '24'),
(703, '027', 'Fronteras', '0001', 'Fronteras', '2019-07-16 09:29:45', '26'),
(704, '027', 'Nuevo Laredo', '0001', 'Nuevo Laredo', '2019-07-16 09:29:49', '28'),
(705, '027', 'Tenancingo', '0001', 'Tenancingo', '2019-07-16 09:29:51', '29'),
(706, '027', 'Benito Juárez', '0001', 'Benito Juárez', '2019-07-16 09:29:54', '30'),
(707, '027', 'Dzidzantún', '0001', 'Dzidzantún', '2019-07-16 09:30:02', '31'),
(708, '027', 'Melchor Ocampo', '0001', 'Melchor Ocampo', '2019-07-16 09:30:07', '32'),
(709, '028', 'Sabinas', '0001', 'Sabinas', '2019-07-16 09:28:27', '05'),
(710, '028', 'Chiapilla', '0001', 'Chiapilla', '2019-07-16 09:28:29', '07'),
(711, '028', 'Guadalupe', '0001', 'Guadalupe', '2019-07-16 09:28:33', '08'),
(712, '028', 'San Juan del Río', '0001', 'San Juan del Río del Centauro del Norte', '2019-07-16 09:28:37', '10'),
(713, '028', 'Salvatierra', '0001', 'Salvatierra', '2019-07-16 09:28:38', '11'),
(714, '028', 'Chilapa de Álvarez', '0001', 'Chilapa de Álvarez', '2019-07-16 09:28:40', '12'),
(715, '028', 'Huejutla de Reyes', '0001', 'Huejutla de Reyes', '2019-07-16 09:28:43', '13'),
(716, '028', 'Cuautla', '0001', 'Cuautla', '2019-07-16 09:28:47', '14'),
(717, '028', 'Chiautla', '0001', 'Chiautla', '2019-07-16 09:28:52', '15'),
(718, '028', 'Churintzio', '0001', 'Churintzio', '2019-07-16 09:28:57', '16'),
(719, '028', 'Xochitepec', '0001', 'Xochitepec', '2019-07-16 09:29:02', '17'),
(720, '028', 'Higueras', '0001', 'Higueras', '2019-07-16 09:29:04', '19'),
(721, '028', 'Heroica Ciudad de Ejutla de Crespo', '0001', 'Heroica Ciudad de Ejutla de Crespo', '2019-07-16 09:29:06', '20'),
(722, '028', 'Camocuautla', '0001', 'Camocuautla', '2019-07-16 09:29:31', '21'),
(723, '028', 'San Luis Potosí', '0001', 'San Luis Potosí', '2019-07-16 09:29:42', '24'),
(724, '028', 'Granados', '0001', 'Granados', '2019-07-16 09:29:45', '26'),
(725, '028', 'Nuevo Morelos', '0001', 'Nuevo Morelos', '2019-07-16 09:29:49', '28'),
(726, '028', 'Teolocholco', '0001', 'Teolocholco', '2019-07-16 09:29:51', '29'),
(727, '028', 'Boca del Río', '0001', 'Boca del Río', '2019-07-16 09:29:54', '30'),
(728, '028', 'Dzilam de Bravo', '0001', 'Dzilam de Bravo', '2019-07-16 09:30:02', '31'),
(729, '028', 'Mezquital del Oro', '0001', 'Mezquital del Oro', '2019-07-16 09:30:07', '32'),
(730, '029', 'Sacramento', '0001', 'Sacramento', '2019-07-16 09:28:27', '05'),
(731, '029', 'Chicoasén', '0001', 'Chicoasén', '2019-07-16 09:28:29', '07'),
(732, '029', 'Guadalupe y Calvo', '0001', 'Guadalupe y Calvo', '2019-07-16 09:28:33', '08'),
(733, '029', 'San Luis del Cordero', '0001', 'San Luis del Cordero', '2019-07-16 09:28:37', '10'),
(734, '029', 'San Diego de la Unión', '0001', 'San Diego de la Unión', '2019-07-16 09:28:38', '11'),
(735, '029', 'Chilpancingo de los Bravo', '0001', 'Chilpancingo de los Bravo', '2019-07-16 09:28:40', '12'),
(736, '029', 'Huichapan', '0001', 'Huichapan', '2019-07-16 09:28:43', '13'),
(737, '029', 'Cuquío', '0001', 'Cuquío', '2019-07-16 09:28:47', '14'),
(738, '029', 'Chicoloapan', '0001', 'Chicoloapan de Juárez', '2019-07-16 09:28:52', '15'),
(739, '029', 'Churumuco', '0001', 'Churumuco de Morelos', '2019-07-16 09:28:57', '16'),
(740, '029', 'Yautepec', '0001', 'Yautepec de Zaragoza', '2019-07-16 09:29:02', '17'),
(741, '029', 'Hualahuises', '0001', 'Hualahuises', '2019-07-16 09:29:04', '19'),
(742, '029', 'Eloxochitlán de Flores Magón', '0001', 'Eloxochitlán de Flores Magón', '2019-07-16 09:29:06', '20'),
(743, '029', 'Caxhuacan', '0001', 'Caxhuacan', '2019-07-16 09:29:31', '21'),
(744, '029', 'San Martín Chalchicuautla', '0001', 'San Martín Chalchicuautla', '2019-07-16 09:29:42', '24'),
(745, '029', 'Guaymas', '0001', 'Heroica Guaymas', '2019-07-16 09:29:45', '26'),
(746, '029', 'Ocampo', '0001', 'Ocampo', '2019-07-16 09:29:49', '28'),
(747, '029', 'Tepeyanco', '0001', 'Tepeyanco', '2019-07-16 09:29:51', '29'),
(748, '029', 'Calcahualco', '0001', 'Calcahualco', '2019-07-16 09:29:54', '30'),
(749, '029', 'Dzilam González', '0001', 'Dzilam González', '2019-07-16 09:30:02', '31'),
(750, '029', 'Miguel Auza', '0001', 'Miguel Auza', '2019-07-16 09:30:07', '32'),
(751, '030', 'Saltillo', '0001', 'Saltillo', '2019-07-16 09:28:27', '05'),
(752, '030', 'Chicomuselo', '0001', 'Chicomuselo', '2019-07-16 09:28:29', '07'),
(753, '030', 'Guazapares', '0001', 'Témoris', '2019-07-16 09:28:34', '08'),
(754, '030', 'San Pedro del Gallo', '0001', 'San Pedro del Gallo', '2019-07-16 09:28:37', '10'),
(755, '030', 'San Felipe', '0001', 'San Felipe', '2019-07-16 09:28:38', '11'),
(756, '030', 'Florencio Villarreal', '0001', 'Cruz Grande', '2019-07-16 09:28:40', '12'),
(757, '030', 'Ixmiquilpan', '0001', 'Ixmiquilpan', '2019-07-16 09:28:44', '13'),
(758, '030', 'Chapala', '0001', 'Chapala', '2019-07-16 09:28:47', '14'),
(759, '030', 'Chiconcuac', '0001', 'Chiconcuac de Juárez', '2019-07-16 09:28:52', '15'),
(760, '030', 'Ecuandureo', '0001', 'Ecuandureo', '2019-07-16 09:28:57', '16'),
(761, '030', 'Yecapixtla', '0001', 'Yecapixtla', '2019-07-16 09:29:02', '17'),
(762, '030', 'Iturbide', '0001', 'Iturbide', '2019-07-16 09:29:04', '19'),
(763, '030', 'El Espinal', '0001', 'El Espinal', '2019-07-16 09:29:06', '20'),
(764, '030', 'Coatepec', '0001', 'Coatepec', '2019-07-16 09:29:31', '21'),
(765, '030', 'San Nicolás Tolentino', '0001', 'San Nicolás Tolentino', '2019-07-16 09:29:42', '24'),
(766, '030', 'Hermosillo', '0001', 'Hermosillo', '2019-07-16 09:29:45', '26'),
(767, '030', 'Padilla', '0001', 'Nueva Villa de Padilla', '2019-07-16 09:29:50', '28'),
(768, '030', 'Terrenate', '0001', 'Terrenate', '2019-07-16 09:29:51', '29'),
(769, '030', 'Camerino Z. Mendoza', '0001', 'Ciudad Mendoza', '2019-07-16 09:29:54', '30'),
(770, '030', 'Dzitás', '0001', 'Dzitás', '2019-07-16 09:30:02', '31'),
(771, '030', 'Momax', '0001', 'Momax', '2019-07-16 09:30:07', '32'),
(772, '031', 'San Buenaventura', '0001', 'San Buenaventura', '2019-07-16 09:28:27', '05'),
(773, '031', 'Chilón', '0001', 'Chilón', '2019-07-16 09:28:29', '07'),
(774, '031', 'Guerrero', '0001', 'Vicente Guerrero', '2019-07-16 09:28:34', '08'),
(775, '031', 'Santa Clara', '0001', 'Santa Clara', '2019-07-16 09:28:37', '10'),
(776, '031', 'San Francisco del Rincón', '0001', 'San Francisco del Rincón', '2019-07-16 09:28:39', '11'),
(777, '031', 'General Canuto A. Neri', '0001', 'Acapetlahuaya', '2019-07-16 09:28:40', '12'),
(778, '031', 'Jacala de Ledezma', '0001', 'Jacala', '2019-07-16 09:28:44', '13'),
(779, '031', 'Chimaltitán', '0001', 'Chimaltitán', '2019-07-16 09:28:47', '14'),
(780, '031', 'Chimalhuacán', '0001', 'Chimalhuacán', '2019-07-16 09:28:52', '15'),
(781, '031', 'Epitacio Huerta', '0001', 'Epitacio Huerta', '2019-07-16 09:28:57', '16'),
(782, '031', 'Zacatepec', '0001', 'Zacatepec de Hidalgo', '2019-07-16 09:29:02', '17'),
(783, '031', 'Juárez', '0001', 'Ciudad Benito Juárez', '2019-07-16 09:29:04', '19'),
(784, '031', 'Tamazulápam del Espíritu Santo', '0001', 'Tamazulápam del Espíritu Santo', '2019-07-16 09:29:06', '20'),
(785, '031', 'Coatzingo', '0001', 'Coatzingo', '2019-07-16 09:29:31', '21'),
(786, '031', 'Santa Catarina', '0001', 'Santa Catarina', '2019-07-16 09:29:42', '24'),
(787, '031', 'Huachinera', '0001', 'Huachinera', '2019-07-16 09:29:45', '26'),
(788, '031', 'Palmillas', '0001', 'Palmillas', '2019-07-16 09:29:50', '28'),
(789, '031', 'Tetla de la Solidaridad', '0001', 'Tetla', '2019-07-16 09:29:51', '29'),
(790, '031', 'Carrillo Puerto', '0001', 'Tamarindo', '2019-07-16 09:29:54', '30'),
(791, '031', 'Dzoncauich', '0001', 'Dzoncauich', '2019-07-16 09:30:02', '31'),
(792, '031', 'Monte Escobedo', '0001', 'Monte Escobedo', '2019-07-16 09:30:07', '32'),
(793, '032', 'San Juan de Sabinas', '0014', 'Nueva Rosita', '2019-07-16 09:28:27', '05'),
(794, '032', 'Escuintla', '0001', 'Escuintla', '2019-07-16 09:28:29', '07'),
(795, '032', 'Hidalgo del Parral', '0001', 'Hidalgo del Parral', '2019-07-16 09:28:34', '08'),
(796, '032', 'Santiago Papasquiaro', '0001', 'Santiago Papasquiaro', '2019-07-16 09:28:37', '10'),
(797, '032', 'San José Iturbide', '0001', 'San José Iturbide', '2019-07-16 09:28:39', '11'),
(798, '032', 'General Heliodoro Castillo', '0001', 'Tlacotepec', '2019-07-16 09:28:40', '12'),
(799, '032', 'Jaltocán', '0001', 'Jaltocán', '2019-07-16 09:28:44', '13'),
(800, '032', 'Chiquilistlán', '0001', 'Chiquilistlán', '2019-07-16 09:28:47', '14'),
(801, '032', 'Donato Guerra', '0001', 'Villa Donato Guerra', '2019-07-16 09:28:52', '15'),
(802, '032', 'Erongarícuaro', '0001', 'Erongarícuaro', '2019-07-16 09:28:58', '16'),
(803, '032', 'Zacualpan de Amilpas', '0001', 'Zacualpan de Amilpas', '2019-07-16 09:29:02', '17'),
(804, '032', 'Lampazos de Naranjo', '0001', 'Lampazos de Naranjo', '2019-07-16 09:29:04', '19'),
(805, '032', 'Fresnillo de Trujano', '0001', 'Fresnillo de Trujano', '2019-07-16 09:29:06', '20'),
(806, '032', 'Cohetzala', '0001', 'Santa María Cohetzala', '2019-07-16 09:29:31', '21'),
(807, '032', 'Santa María del Río', '0001', 'Santa María del Río', '2019-07-16 09:29:42', '24'),
(808, '032', 'Huásabas', '0001', 'Huásabas', '2019-07-16 09:29:45', '26'),
(809, '032', 'Reynosa', '0001', 'Reynosa', '2019-07-16 09:29:50', '28'),
(810, '032', 'Tetlatlahuca', '0001', 'Tetlatlahuca', '2019-07-16 09:29:51', '29'),
(811, '032', 'Catemaco', '0001', 'Catemaco', '2019-07-16 09:29:54', '30'),
(812, '032', 'Espita', '0001', 'Espita', '2019-07-16 09:30:02', '31'),
(813, '032', 'Morelos', '0001', 'Morelos', '2019-07-16 09:30:07', '32'),
(814, '033', 'San Pedro', '0001', 'San Pedro', '2019-07-16 09:28:27', '05'),
(815, '033', 'Francisco León', '0042', 'Rivera el Viejo Carmen', '2019-07-16 09:28:29', '07'),
(816, '033', 'Huejotitán', '0001', 'Huejotitán', '2019-07-16 09:28:34', '08'),
(817, '033', 'Súchil', '0001', 'Súchil', '2019-07-16 09:28:37', '10'),
(818, '033', 'San Luis de la Paz', '0001', 'San Luis de la Paz', '2019-07-16 09:28:39', '11'),
(819, '033', 'Huamuxtitlán', '0001', 'Huamuxtitlán', '2019-07-16 09:28:40', '12'),
(820, '033', 'Juárez Hidalgo', '0001', 'Juárez', '2019-07-16 09:28:44', '13'),
(821, '033', 'Degollado', '0001', 'Degollado', '2019-07-16 09:28:47', '14'),
(822, '033', 'Ecatepec de Morelos', '0001', 'Ecatepec de Morelos', '2019-07-16 09:28:52', '15'),
(823, '033', 'Gabriel Zamora', '0001', 'Lombardía', '2019-07-16 09:28:58', '16'),
(824, '033', 'Temoac', '0001', 'Temoac', '2019-07-16 09:29:02', '17'),
(825, '033', 'Linares', '0001', 'Linares', '2019-07-16 09:29:04', '19'),
(826, '033', 'Guadalupe Etla', '0001', 'Guadalupe Etla', '2019-07-16 09:29:06', '20'),
(827, '033', 'Cohuecan', '0001', 'Cohuecan', '2019-07-16 09:29:31', '21'),
(828, '033', 'Santo Domingo', '0001', 'Santo Domingo', '2019-07-16 09:29:42', '24'),
(829, '033', 'Huatabampo', '0001', 'Huatabampo', '2019-07-16 09:29:45', '26'),
(830, '033', 'Río Bravo', '0001', 'Ciudad Río Bravo', '2019-07-16 09:29:50', '28'),
(831, '033', 'Tlaxcala', '0001', 'Tlaxcala de Xicohténcatl', '2019-07-16 09:29:51', '29'),
(832, '033', 'Cazones de Herrera', '0001', 'Cazones de Herrera', '2019-07-16 09:29:54', '30'),
(833, '033', 'Halachó', '0001', 'Halachó', '2019-07-16 09:30:02', '31'),
(834, '033', 'Moyahua de Estrada', '0001', 'Moyahua de Estrada', '2019-07-16 09:30:07', '32'),
(835, '034', 'Sierra Mojada', '0001', 'Sierra Mojada', '2019-07-16 09:28:27', '05'),
(836, '034', 'Frontera Comalapa', '0001', 'Frontera Comalapa', '2019-07-16 09:28:29', '07'),
(837, '034', 'Ignacio Zaragoza', '0001', 'Ignacio Zaragoza', '2019-07-16 09:28:34', '08'),
(838, '034', 'Tamazula', '0001', 'Tamazula de Victoria', '2019-07-16 09:28:37', '10'),
(839, '034', 'Santa Catarina', '0001', 'Santa Catarina', '2019-07-16 09:28:39', '11'),
(840, '034', 'Huitzuco de los Figueroa', '0001', 'Ciudad de Huitzuco', '2019-07-16 09:28:40', '12'),
(841, '034', 'Lolotla', '0001', 'Lolotla', '2019-07-16 09:28:44', '13'),
(842, '034', 'Ejutla', '0001', 'Ejutla', '2019-07-16 09:28:47', '14'),
(843, '034', 'Ecatzingo', '0001', 'Ecatzingo de Hidalgo', '2019-07-16 09:28:52', '15'),
(844, '034', 'Hidalgo', '0001', 'Ciudad Hidalgo', '2019-07-16 09:28:58', '16'),
(845, '034', 'Marín', '0001', 'Marín', '2019-07-16 09:29:04', '19'),
(846, '034', 'Guadalupe de Ramírez', '0001', 'Guadalupe de Ramírez', '2019-07-16 09:29:06', '20'),
(847, '034', 'Coronango', '0001', 'Santa María Coronango', '2019-07-16 09:29:31', '21'),
(848, '034', 'San Vicente Tancuayalab', '0001', 'San Vicente Tancuayalab', '2019-07-16 09:29:42', '24'),
(849, '034', 'Huépac', '0001', 'Huépac', '2019-07-16 09:29:45', '26'),
(850, '034', 'San Carlos', '0001', 'San Carlos', '2019-07-16 09:29:50', '28'),
(851, '034', 'Tlaxco', '0001', 'Tlaxco', '2019-07-16 09:29:51', '29'),
(852, '034', 'Cerro Azul', '0001', 'Cerro Azul', '2019-07-16 09:29:54', '30'),
(853, '034', 'Hocabá', '0001', 'Hocabá', '2019-07-16 09:30:02', '31'),
(854, '034', 'Nochistlán de Mejía', '0001', 'Nochistlán de Mejía', '2019-07-16 09:30:07', '32'),
(855, '035', 'Torreón', '0001', 'Torreón', '2019-07-16 09:28:27', '05'),
(856, '035', 'Frontera Hidalgo', '0001', 'Frontera Hidalgo', '2019-07-16 09:28:29', '07'),
(857, '035', 'Janos', '0001', 'Janos', '2019-07-16 09:28:34', '08'),
(858, '035', 'Tepehuanes', '0001', 'Santa Catarina de Tepehuanes', '2019-07-16 09:28:37', '10'),
(859, '035', 'Santa Cruz de Juventino Rosas', '0001', 'Juventino Rosas', '2019-07-16 09:28:39', '11'),
(860, '035', 'Iguala de la Independencia', '0001', 'Iguala de la Independencia', '2019-07-16 09:28:40', '12'),
(861, '035', 'Metepec', '0001', 'Metepec', '2019-07-16 09:28:44', '13'),
(862, '035', 'Encarnación de Díaz', '0001', 'Encarnación de Díaz', '2019-07-16 09:28:47', '14'),
(863, '035', 'Huehuetoca', '0001', 'Huehuetoca', '2019-07-16 09:28:52', '15'),
(864, '035', 'La Huacana', '0001', 'La Huacana', '2019-07-16 09:28:58', '16'),
(865, '035', 'Melchor Ocampo', '0001', 'Melchor Ocampo', '2019-07-16 09:29:04', '19'),
(866, '035', 'Guelatao de Juárez', '0001', 'Guelatao de Juárez', '2019-07-16 09:29:06', '20'),
(867, '035', 'Coxcatlán', '0001', 'Coxcatlán', '2019-07-16 09:29:31', '21'),
(868, '035', 'Soledad de Graciano Sánchez', '0001', 'Soledad de Graciano Sánchez', '2019-07-16 09:29:42', '24'),
(869, '035', 'Imuris', '0001', 'Imuris', '2019-07-16 09:29:45', '26'),
(870, '035', 'San Fernando', '0001', 'San Fernando', '2019-07-16 09:29:50', '28'),
(871, '035', 'Tocatlán', '0001', 'Tocatlán', '2019-07-16 09:29:51', '29'),
(872, '035', 'Citlaltépetl', '0001', 'Citlaltépec', '2019-07-16 09:29:54', '30'),
(873, '035', 'Hoctún', '0001', 'Hoctún', '2019-07-16 09:30:02', '31'),
(874, '035', 'Noria de Ángeles', '0001', 'Noria de Ángeles', '2019-07-16 09:30:07', '32'),
(875, '036', 'Viesca', '0001', 'Viesca', '2019-07-16 09:28:27', '05'),
(876, '036', 'La Grandeza', '0001', 'La Grandeza', '2019-07-16 09:28:29', '07'),
(877, '036', 'Jiménez', '0001', 'José Mariano Jiménez', '2019-07-16 09:28:34', '08'),
(878, '036', 'Tlahualilo', '0001', 'Tlahualilo de Zaragoza', '2019-07-16 09:28:37', '10'),
(879, '036', 'Santiago Maravatío', '0001', 'Santiago Maravatío', '2019-07-16 09:28:39', '11'),
(880, '036', 'Igualapa', '0001', 'Igualapa', '2019-07-16 09:28:40', '12'),
(881, '036', 'San Agustín Metzquititlán', '0001', 'Mezquititlán', '2019-07-16 09:28:44', '13'),
(882, '036', 'Etzatlán', '0001', 'Etzatlán', '2019-07-16 09:28:47', '14'),
(883, '036', 'Hueypoxtla', '0001', 'Hueypoxtla', '2019-07-16 09:28:52', '15'),
(884, '036', 'Huandacareo', '0001', 'Huandacareo', '2019-07-16 09:28:58', '16'),
(885, '036', 'Mier y Noriega', '0001', 'Mier y Noriega', '2019-07-16 09:29:04', '19'),
(886, '036', 'Guevea de Humboldt', '0001', 'Guevea de Humboldt', '2019-07-16 09:29:06', '20'),
(887, '036', 'Coyomeapan', '0001', 'Santa María Coyomeapan', '2019-07-16 09:29:31', '21'),
(888, '036', 'Tamasopo', '0001', 'Tamasopo', '2019-07-16 09:29:42', '24'),
(889, '036', 'Magdalena', '0001', 'Magdalena de Kino', '2019-07-16 09:29:45', '26'),
(890, '036', 'San Nicolás', '0001', 'San Nicolás', '2019-07-16 09:29:50', '28'),
(891, '036', 'Totolac', '0001', 'San Juan Totolac', '2019-07-16 09:29:51', '29'),
(892, '036', 'Coacoatzintla', '0001', 'Coacoatzintla', '2019-07-16 09:29:54', '30'),
(893, '036', 'Homún', '0001', 'Homún', '2019-07-16 09:30:02', '31'),
(894, '036', 'Ojocaliente', '0001', 'Ojocaliente', '2019-07-16 09:30:07', '32'),
(895, '037', 'Villa Unión', '0001', 'Villa Unión', '2019-07-16 09:28:27', '05'),
(896, '037', 'Huehuetán', '0001', 'Huehuetán', '2019-07-16 09:28:29', '07'),
(897, '037', 'Juárez', '0001', 'Juárez', '2019-07-16 09:28:34', '08'),
(898, '037', 'Topia', '0001', 'Topia', '2019-07-16 09:28:37', '10'),
(899, '037', 'Silao de la Victoria', '0001', 'Silao de la Victoria', '2019-07-16 09:28:39', '11'),
(900, '037', 'Ixcateopan de Cuauhtémoc', '0001', 'Ixcateopan de Cuauhtémoc', '2019-07-16 09:28:40', '12'),
(901, '037', 'Metztitlán', '0001', 'Metztitlán', '2019-07-16 09:28:44', '13'),
(902, '037', 'El Grullo', '0001', 'El Grullo', '2019-07-16 09:28:47', '14'),
(903, '037', 'Huixquilucan', '0001', 'Huixquilucan de Degollado', '2019-07-16 09:28:52', '15'),
(904, '037', 'Huaniqueo', '0001', 'Huaniqueo de Morales', '2019-07-16 09:28:58', '16'),
(905, '037', 'Mina', '0001', 'Mina', '2019-07-16 09:29:04', '19'),
(906, '037', 'Mesones Hidalgo', '0001', 'Mesones Hidalgo', '2019-07-16 09:29:06', '20'),
(907, '037', 'Coyotepec', '0001', 'San Vicente Coyotepec', '2019-07-16 09:29:31', '21'),
(908, '037', 'Tamazunchale', '0001', 'Tamazunchale', '2019-07-16 09:29:42', '24'),
(909, '037', 'Mazatán', '0001', 'Mazatán', '2019-07-16 09:29:45', '26'),
(910, '037', 'Soto la Marina', '0001', 'Soto la Marina', '2019-07-16 09:29:50', '28'),
(911, '037', 'Ziltlaltépec de Trinidad Sánchez Santos', '0001', 'Zitlaltépec', '2019-07-16 09:29:51', '29'),
(912, '037', 'Coahuitlán', '0001', 'Progreso de Zaragoza', '2019-07-16 09:29:54', '30'),
(913, '037', 'Huhí', '0001', 'Huhí', '2019-07-16 09:30:03', '31'),
(914, '037', 'Pánuco', '0001', 'Pánuco', '2019-07-16 09:30:07', '32'),
(915, '038', 'Zaragoza', '0001', 'Zaragoza', '2019-07-16 09:28:27', '05'),
(916, '038', 'Huixtán', '0001', 'Huixtán', '2019-07-16 09:28:29', '07'),
(917, '038', 'Julimes', '0001', 'Julimes', '2019-07-16 09:28:34', '08'),
(918, '038', 'Vicente Guerrero', '0001', 'Vicente Guerrero', '2019-07-16 09:28:37', '10'),
(919, '038', 'Tarandacuao', '0001', 'Tarandacuao', '2019-07-16 09:28:39', '11'),
(920, '038', 'Zihuatanejo de Azueta', '0001', 'Zihuatanejo', '2019-07-16 09:28:41', '12'),
(921, '038', 'Mineral del Chico', '0001', 'Mineral del Chico', '2019-07-16 09:28:44', '13'),
(922, '038', 'Guachinango', '0001', 'Guachinango', '2019-07-16 09:28:47', '14'),
(923, '038', 'Isidro Fabela', '0001', 'Tlazala de Fabela', '2019-07-16 09:28:52', '15'),
(924, '038', 'Huetamo', '0001', 'Huetamo de Núñez', '2019-07-16 09:28:58', '16'),
(925, '038', 'Montemorelos', '0001', 'Montemorelos', '2019-07-16 09:29:04', '19'),
(926, '038', 'Villa Hidalgo', '0001', 'Villa Hidalgo', '2019-07-16 09:29:06', '20'),
(927, '038', 'Cuapiaxtla de Madero', '0001', 'Cuapiaxtla de Madero', '2019-07-16 09:29:31', '21'),
(928, '038', 'Tampacán', '0001', 'Tampacán', '2019-07-16 09:29:42', '24'),
(929, '038', 'Moctezuma', '0001', 'Moctezuma', '2019-07-16 09:29:45', '26'),
(930, '038', 'Tampico', '0001', 'Tampico', '2019-07-16 09:29:50', '28'),
(931, '038', 'Tzompantepec', '0001', 'Tzompantepec', '2019-07-16 09:29:52', '29'),
(932, '038', 'Coatepec', '0001', 'Coatepec', '2019-07-16 09:29:54', '30'),
(933, '038', 'Hunucmá', '0001', 'Hunucmá', '2019-07-16 09:30:03', '31'),
(934, '038', 'Pinos', '0001', 'Pinos', '2019-07-16 09:30:07', '32'),
(935, '039', 'Huitiupán', '0001', 'Huitiupán', '2019-07-16 09:28:29', '07'),
(936, '039', 'López', '0001', 'Octaviano López', '2019-07-16 09:28:34', '08'),
(937, '039', 'Nuevo Ideal', '0001', 'Nuevo Ideal', '2019-07-16 09:28:37', '10'),
(938, '039', 'Tarimoro', '0001', 'Tarimoro', '2019-07-16 09:28:39', '11'),
(939, '039', 'Juan R. Escudero', '0001', 'Tierra Colorada', '2019-07-16 09:28:41', '12'),
(940, '039', 'Mineral del Monte', '0001', 'Mineral del Monte', '2019-07-16 09:28:44', '13'),
(941, '039', 'Guadalajara', '0001', 'Guadalajara', '2019-07-16 09:28:47', '14'),
(942, '039', 'Ixtapaluca', '0001', 'Ixtapaluca', '2019-07-16 09:28:53', '15'),
(943, '039', 'Huiramba', '0001', 'Huiramba', '2019-07-16 09:28:58', '16'),
(944, '039', 'Monterrey', '0001', 'Monterrey', '2019-07-16 09:29:05', '19'),
(945, '039', 'Heroica Ciudad de Huajuapan de León', '0001', 'Heroica Ciudad de Huajuapan de León', '2019-07-16 09:29:07', '20'),
(946, '039', 'Cuautempan', '0001', 'San Esteban Cuautempan', '2019-07-16 09:29:31', '21'),
(947, '039', 'Tampamolón Corona', '0001', 'Tampamolón Corona', '2019-07-16 09:29:42', '24'),
(948, '039', 'Naco', '0001', 'Naco', '2019-07-16 09:29:45', '26'),
(949, '039', 'Tula', '0001', 'Ciudad Tula', '2019-07-16 09:29:50', '28'),
(950, '039', 'Xaloztoc', '0001', 'Xaloztoc', '2019-07-16 09:29:52', '29'),
(951, '039', 'Coatzacoalcos', '0001', 'Coatzacoalcos', '2019-07-16 09:29:54', '30'),
(952, '039', 'Ixil', '0001', 'Ixil', '2019-07-16 09:30:03', '31'),
(953, '039', 'Río Grande', '0001', 'Río Grande', '2019-07-16 09:30:07', '32'),
(954, '040', 'Huixtla', '0001', 'Huixtla', '2019-07-16 09:28:29', '07'),
(955, '040', 'Madera', '0001', 'Madera', '2019-07-16 09:28:34', '08'),
(956, '040', 'Tierra Blanca', '0001', 'Tierra Blanca', '2019-07-16 09:28:39', '11'),
(957, '040', 'Leonardo Bravo', '0001', 'Chichihualco', '2019-07-16 09:28:41', '12'),
(958, '040', 'La Misión', '0001', 'La Misión', '2019-07-16 09:28:44', '13'),
(959, '040', 'Hostotipaquillo', '0001', 'Hostotipaquillo', '2019-07-16 09:28:47', '14'),
(960, '040', 'Ixtapan de la Sal', '0001', 'Ixtapan de la Sal', '2019-07-16 09:28:53', '15'),
(961, '040', 'Indaparapeo', '0001', 'Indaparapeo', '2019-07-16 09:28:58', '16'),
(962, '040', 'Parás', '0001', 'Parás', '2019-07-16 09:29:05', '19'),
(963, '040', 'Huautepec', '0001', 'Huautepec', '2019-07-16 09:29:07', '20'),
(964, '040', 'Cuautinchán', '0001', 'Cuautinchán', '2019-07-16 09:29:32', '21'),
(965, '040', 'Tamuín', '0001', 'Tamuín', '2019-07-16 09:29:42', '24'),
(966, '040', 'Nácori Chico', '0001', 'Nácori Chico', '2019-07-16 09:29:45', '26'),
(967, '040', 'Valle Hermoso', '0001', 'Valle Hermoso', '2019-07-16 09:29:50', '28'),
(968, '040', 'Xaltocan', '0001', 'Xaltocan', '2019-07-16 09:29:52', '29'),
(969, '040', 'Coatzintla', '0001', 'Coatzintla', '2019-07-16 09:29:54', '30'),
(970, '040', 'Izamal', '0001', 'Izamal', '2019-07-16 09:30:03', '31'),
(971, '040', 'Sain Alto', '0001', 'Sain Alto', '2019-07-16 09:30:07', '32'),
(972, '041', 'La Independencia', '0001', 'La Independencia', '2019-07-16 09:28:30', '07'),
(973, '041', 'Maguarichi', '0001', 'Maguarichi', '2019-07-16 09:28:34', '08'),
(974, '041', 'Uriangato', '0001', 'Uriangato', '2019-07-16 09:28:39', '11'),
(975, '041', 'Malinaltepec', '0001', 'Malinaltepec', '2019-07-16 09:28:41', '12'),
(976, '041', 'Mixquiahuala de Juárez', '0001', 'Mixquiahuala', '2019-07-16 09:28:44', '13'),
(977, '041', 'Huejúcar', '0001', 'Huejúcar', '2019-07-16 09:28:48', '14'),
(978, '041', 'Ixtapan del Oro', '0001', 'Ixtapan del Oro', '2019-07-16 09:28:53', '15'),
(979, '041', 'Irimbo', '0001', 'Irimbo', '2019-07-16 09:28:58', '16'),
(980, '041', 'Pesquería', '0001', 'Pesquería', '2019-07-16 09:29:05', '19'),
(981, '041', 'Huautla de Jiménez', '0001', 'Huautla de Jiménez', '2019-07-16 09:29:07', '20'),
(982, '041', 'Cuautlancingo', '0001', 'San Juan Cuautlancingo', '2019-07-16 09:29:32', '21'),
(983, '041', 'Tanlajás', '0001', 'Tanlajás', '2019-07-16 09:29:42', '24'),
(984, '041', 'Nacozari de García', '0001', 'Nacozari de García', '2019-07-16 09:29:45', '26'),
(985, '041', 'Victoria', '0001', 'Ciudad Victoria', '2019-07-16 09:29:50', '28'),
(986, '041', 'Papalotla de Xicohténcatl', '0001', 'Papalotla', '2019-07-16 09:29:52', '29'),
(987, '041', 'Coetzala', '0001', 'Coetzala', '2019-07-16 09:29:54', '30'),
(988, '041', 'Kanasín', '0001', 'Kanasín', '2019-07-16 09:30:03', '31'),
(989, '041', 'El Salvador', '0001', 'El Salvador', '2019-07-16 09:30:08', '32'),
(990, '042', 'Ixhuatán', '0001', 'Ixhuatán', '2019-07-16 09:28:30', '07'),
(991, '042', 'Manuel Benavides', '0001', 'Manuel Benavides', '2019-07-16 09:28:34', '08'),
(992, '042', 'Valle de Santiago', '0001', 'Valle de Santiago', '2019-07-16 09:28:39', '11'),
(993, '042', 'Mártir de Cuilapan', '0001', 'Apango', '2019-07-16 09:28:41', '12'),
(994, '042', 'Molango de Escamilla', '0001', 'Molango', '2019-07-16 09:28:44', '13'),
(995, '042', 'Huejuquilla el Alto', '0001', 'Huejuquilla el Alto', '2019-07-16 09:28:48', '14'),
(996, '042', 'Ixtlahuaca', '0001', 'Ixtlahuaca de Rayón', '2019-07-16 09:28:53', '15'),
(997, '042', 'Ixtlán', '0001', 'Ixtlán de los Hervores', '2019-07-16 09:28:58', '16'),
(998, '042', 'Los Ramones', '0001', 'Los Ramones', '2019-07-16 09:29:05', '19'),
(999, '042', 'Ixtlán de Juárez', '0001', 'Ixtlán de Juárez', '2019-07-16 09:29:07', '20'),
(1000, '042', 'Cuayuca de Andrade', '0001', 'San Pedro Cuayuca', '2019-07-16 09:29:32', '21'),
(1001, '042', 'Tanquián de Escobedo', '0001', 'Tanquián de Escobedo', '2019-07-16 09:29:42', '24'),
(1002, '042', 'Navojoa', '0001', 'Navojoa', '2019-07-16 09:29:45', '26'),
(1003, '042', 'Villagrán', '0001', 'Villagrán', '2019-07-16 09:29:50', '28'),
(1004, '042', 'Xicohtzinco', '0001', 'Xicohtzinco', '2019-07-16 09:29:52', '29'),
(1005, '042', 'Colipa', '0001', 'Colipa', '2019-07-16 09:29:54', '30'),
(1006, '042', 'Kantunil', '0001', 'Kantunil', '2019-07-16 09:30:03', '31'),
(1007, '042', 'Sombrerete', '0001', 'Sombrerete', '2019-07-16 09:30:08', '32'),
(1008, '043', 'Ixtacomitán', '0001', 'Ixtacomitán', '2019-07-16 09:28:30', '07'),
(1009, '043', 'Matachí', '0001', 'Matachí', '2019-07-16 09:28:34', '08'),
(1010, '043', 'Victoria', '0001', 'Victoria', '2019-07-16 09:28:39', '11'),
(1011, '043', 'Metlatónoc', '0001', 'Metlatónoc', '2019-07-16 09:28:41', '12'),
(1012, '043', 'Nicolás Flores', '0001', 'Nicolás Flores', '2019-07-16 09:28:44', '13'),
(1013, '043', 'La Huerta', '0001', 'La Huerta', '2019-07-16 09:28:48', '14'),
(1014, '043', 'Xalatlaco', '0001', 'Xalatlaco', '2019-07-16 09:28:53', '15'),
(1015, '043', 'Jacona', '0001', 'Jacona de Plancarte', '2019-07-16 09:28:58', '16'),
(1016, '043', 'Rayones', '0001', 'Rayones', '2019-07-16 09:29:05', '19'),
(1017, '043', 'Heroica Ciudad de Juchitán de Zaragoza', '0001', 'Heroica Ciudad de Juchitán de Zaragoza', '2019-07-16 09:29:07', '20'),
(1018, '043', 'Cuetzalan del Progreso', '0001', 'Ciudad de Cuetzalan', '2019-07-16 09:29:32', '21'),
(1019, '043', 'Tierra Nueva', '0001', 'Tierra Nueva', '2019-07-16 09:29:42', '24'),
(1020, '043', 'Nogales', '0001', 'Heroica Nogales', '2019-07-16 09:29:45', '26'),
(1021, '043', 'Xicoténcatl', '0001', 'Xicoténcatl', '2019-07-16 09:29:50', '28'),
(1022, '043', 'Yauhquemehcan', '0001', 'San Dionisio Yauhquemehcan', '2019-07-16 09:29:52', '29'),
(1023, '043', 'Comapa', '0001', 'Comapa', '2019-07-16 09:29:54', '30'),
(1024, '043', 'Kaua', '0001', 'Kaua', '2019-07-16 09:30:03', '31'),
(1025, '043', 'Susticacán', '0001', 'Susticacán', '2019-07-16 09:30:08', '32'),
(1026, '044', 'Ixtapa', '0001', 'Ixtapa', '2019-07-16 09:28:30', '07'),
(1027, '044', 'Matamoros', '0001', 'Mariano Matamoros', '2019-07-16 09:28:34', '08'),
(1028, '044', 'Villagrán', '0001', 'Villagrán', '2019-07-16 09:28:39', '11'),
(1029, '044', 'Mochitlán', '0001', 'Mochitlán', '2019-07-16 09:28:41', '12'),
(1030, '044', 'Nopala de Villagrán', '0001', 'Nopala', '2019-07-16 09:28:44', '13'),
(1031, '044', 'Ixtlahuacán de los Membrillos', '0001', 'Ixtlahuacán de los Membrillos', '2019-07-16 09:28:48', '14'),
(1032, '044', 'Jaltenco', '0001', 'Jaltenco', '2019-07-16 09:28:53', '15'),
(1033, '044', 'Jiménez', '0001', 'Villa Jiménez', '2019-07-16 09:28:58', '16'),
(1034, '044', 'Sabinas Hidalgo', '0001', 'Ciudad Sabinas Hidalgo', '2019-07-16 09:29:05', '19'),
(1035, '044', 'Loma Bonita', '0001', 'Loma Bonita', '2019-07-16 09:29:07', '20'),
(1036, '044', 'Cuyoaco', '0001', 'Cuyoaco', '2019-07-16 09:29:32', '21'),
(1037, '044', 'Vanegas', '0001', 'Vanegas', '2019-07-16 09:29:42', '24'),
(1038, '044', 'Onavas', '0001', 'Onavas', '2019-07-16 09:29:45', '26'),
(1039, '044', 'Zacatelco', '0001', 'Zacatelco', '2019-07-16 09:29:52', '29'),
(1040, '044', 'Córdoba', '0001', 'Córdoba', '2019-07-16 09:29:54', '30'),
(1041, '044', 'Kinchil', '0001', 'Kinchil', '2019-07-16 09:30:03', '31'),
(1042, '044', 'Tabasco', '0001', 'Tabasco', '2019-07-16 09:30:08', '32'),
(1043, '045', 'Ixtapangajoya', '0001', 'Ixtapangajoya', '2019-07-16 09:28:30', '07'),
(1044, '045', 'Meoqui', '0001', 'Pedro Meoqui', '2019-07-16 09:28:34', '08'),
(1045, '045', 'Xichú', '0001', 'Xichú', '2019-07-16 09:28:39', '11'),
(1046, '045', 'Olinalá', '0001', 'Olinalá', '2019-07-16 09:28:41', '12'),
(1047, '045', 'Omitlán de Juárez', '0001', 'Omitlán de Juárez', '2019-07-16 09:28:44', '13'),
(1048, '045', 'Ixtlahuacán del Río', '0001', 'Ixtlahuacán del Río', '2019-07-16 09:28:48', '14'),
(1049, '045', 'Jilotepec', '0001', 'Jilotepec de Molina Enríquez', '2019-07-16 09:28:53', '15'),
(1050, '045', 'Jiquilpan', '0001', 'Jiquilpan de Juárez', '2019-07-16 09:28:58', '16'),
(1051, '045', 'Salinas Victoria', '0001', 'Salinas Victoria', '2019-07-16 09:29:05', '19'),
(1052, '045', 'Magdalena Apasco', '0001', 'Magdalena Apasco', '2019-07-16 09:29:07', '20'),
(1053, '045', 'Chalchicomula de Sesma', '0001', 'Ciudad Serdán', '2019-07-16 09:29:32', '21'),
(1054, '045', 'Venado', '0001', 'Venado', '2019-07-16 09:29:42', '24'),
(1055, '045', 'Opodepe', '0001', 'Opodepe', '2019-07-16 09:29:45', '26'),
(1056, '045', 'Benito Juárez', '0001', 'Benito Juárez', '2019-07-16 09:29:52', '29'),
(1057, '045', 'Cosamaloapan de Carpio', '0001', 'Cosamaloapan', '2019-07-16 09:29:54', '30'),
(1058, '045', 'Kopomá', '0001', 'Kopomá', '2019-07-16 09:30:03', '31'),
(1059, '045', 'Tepechitlán', '0001', 'Tepechitlán', '2019-07-16 09:30:08', '32'),
(1060, '046', 'Jiquipilas', '0001', 'Jiquipilas', '2019-07-16 09:28:30', '07'),
(1061, '046', 'Morelos', '0001', 'Morelos', '2019-07-16 09:28:34', '08'),
(1062, '046', 'Yuriria', '0001', 'Yuriria', '2019-07-16 09:28:39', '11'),
(1063, '046', 'Ometepec', '0001', 'Ometepec', '2019-07-16 09:28:41', '12'),
(1064, '046', 'San Felipe Orizatlán', '0001', 'Orizatlán', '2019-07-16 09:28:44', '13'),
(1065, '046', 'Jalostotitlán', '0001', 'Jalostotitlán', '2019-07-16 09:28:48', '14'),
(1066, '046', 'Jilotzingo', '0001', 'Santa Ana Jilotzingo', '2019-07-16 09:28:53', '15'),
(1067, '046', 'Juárez', '0001', 'Benito Juárez', '2019-07-16 09:28:58', '16'),
(1068, '046', 'San Nicolás de los Garza', '0001', 'San Nicolás de los Garza', '2019-07-16 09:29:05', '19'),
(1069, '046', 'Magdalena Jaltepec', '0001', 'Magdalena Jaltepec', '2019-07-16 09:29:07', '20'),
(1070, '046', 'Chapulco', '0001', 'Chapulco', '2019-07-16 09:29:32', '21'),
(1071, '046', 'Villa de Arriaga', '0001', 'Villa de Arriaga', '2019-07-16 09:29:43', '24'),
(1072, '046', 'Oquitoa', '0001', 'Oquitoa', '2019-07-16 09:29:45', '26'),
(1073, '046', 'Emiliano Zapata', '0001', 'Emiliano Zapata', '2019-07-16 09:29:52', '29'),
(1074, '046', 'Cosautlán de Carvajal', '0001', 'Cosautlán de Carvajal', '2019-07-16 09:29:54', '30'),
(1075, '046', 'Mama', '0001', 'Mama', '2019-07-16 09:30:03', '31'),
(1076, '046', 'Tepetongo', '0001', 'Tepetongo', '2019-07-16 09:30:08', '32'),
(1077, '047', 'Jitotol', '0001', 'Jitotol', '2019-07-16 09:28:30', '07'),
(1078, '047', 'Moris', '0001', 'Moris', '2019-07-16 09:28:34', '08'),
(1079, '047', 'Pedro Ascencio Alquisiras', '0001', 'Ixcapuzalco', '2019-07-16 09:28:41', '12'),
(1080, '047', 'Pacula', '0001', 'Pacula', '2019-07-16 09:28:44', '13'),
(1081, '047', 'Jamay', '0001', 'Jamay', '2019-07-16 09:28:48', '14'),
(1082, '047', 'Jiquipilco', '0001', 'Jiquipilco', '2019-07-16 09:28:53', '15'),
(1083, '047', 'Jungapeo', '0001', 'Jungapeo de Juárez', '2019-07-16 09:28:58', '16'),
(1084, '047', 'Hidalgo', '0001', 'Hidalgo', '2019-07-16 09:29:05', '19'),
(1085, '047', 'Santa Magdalena Jicotlán', '0001', 'Santa Magdalena Jicotlán', '2019-07-16 09:29:07', '20'),
(1086, '047', 'Chiautla', '0001', 'Ciudad de Chiautla de Tapia', '2019-07-16 09:29:32', '21'),
(1087, '047', 'Villa de Guadalupe', '0001', 'Villa de Guadalupe', '2019-07-16 09:29:43', '24'),
(1088, '047', 'Pitiquito', '0001', 'Pitiquito', '2019-07-16 09:29:46', '26'),
(1089, '047', 'Lázaro Cárdenas', '0001', 'Lázaro Cárdenas', '2019-07-16 09:29:52', '29'),
(1090, '047', 'Coscomatepec', '0001', 'Coscomatepec de Bravo', '2019-07-16 09:29:54', '30'),
(1091, '047', 'Maní', '0001', 'Maní', '2019-07-16 09:30:03', '31'),
(1092, '047', 'Teúl de González Ortega', '0001', 'Teúl de González Ortega', '2019-07-16 09:30:08', '32'),
(1093, '048', 'Juárez', '0001', 'Juárez', '2019-07-16 09:28:30', '07'),
(1094, '048', 'Namiquipa', '0001', 'Namiquipa', '2019-07-16 09:28:34', '08'),
(1095, '048', 'Petatlán', '0001', 'Petatlán', '2019-07-16 09:28:41', '12'),
(1096, '048', 'Pachuca de Soto', '0001', 'Pachuca de Soto', '2019-07-16 09:28:44', '13'),
(1097, '048', 'Jesús María', '0001', 'Jesús María', '2019-07-16 09:28:48', '14'),
(1098, '048', 'Jocotitlán', '0001', 'Ciudad de Jocotitlán', '2019-07-16 09:28:53', '15'),
(1099, '048', 'Lagunillas', '0001', 'Lagunillas', '2019-07-16 09:28:58', '16'),
(1100, '048', 'Santa Catarina', '0001', 'Ciudad Santa Catarina', '2019-07-16 09:29:05', '19'),
(1101, '048', 'Magdalena Mixtepec', '0001', 'Magdalena Mixtepec', '2019-07-16 09:29:07', '20'),
(1102, '048', 'Chiautzingo', '0001', 'San Lorenzo Chiautzingo', '2019-07-16 09:29:32', '21'),
(1103, '048', 'Villa de la Paz', '0001', 'Villa de la Paz', '2019-07-16 09:29:43', '24'),
(1104, '048', 'Puerto Peñasco', '0001', 'Puerto Peñasco', '2019-07-16 09:29:46', '26'),
(1105, '048', 'La Magdalena Tlaltelulco', '0001', 'La Magdalena Tlaltelulco', '2019-07-16 09:29:52', '29'),
(1106, '048', 'Cosoleacaque', '0001', 'Cosoleacaque', '2019-07-16 09:29:54', '30'),
(1107, '048', 'Maxcanú', '0001', 'Maxcanú', '2019-07-16 09:30:03', '31'),
(1108, '048', 'Tlaltenango de Sánchez Román', '0001', 'Tlaltenango de Sánchez Román', '2019-07-16 09:30:08', '32'),
(1109, '049', 'Larráinzar', '0001', 'Larráinzar', '2019-07-16 09:28:30', '07'),
(1110, '049', 'Nonoava', '0001', 'Nonoava', '2019-07-16 09:28:34', '08'),
(1111, '049', 'Pilcaya', '0001', 'Pilcaya', '2019-07-16 09:28:41', '12'),
(1112, '049', 'Pisaflores', '0001', 'Pisaflores', '2019-07-16 09:28:44', '13'),
(1113, '049', 'Jilotlán de los Dolores', '0001', 'Jilotlán de los Dolores', '2019-07-16 09:28:48', '14'),
(1114, '049', 'Joquicingo', '0001', 'Joquicingo de León Guzmán', '2019-07-16 09:28:53', '15'),
(1115, '049', 'Madero', '0001', 'Villa Madero', '2019-07-16 09:28:58', '16'),
(1116, '049', 'Santiago', '0001', 'Santiago', '2019-07-16 09:29:05', '19'),
(1117, '049', 'Magdalena Ocotlán', '0001', 'Magdalena Ocotlán', '2019-07-16 09:29:07', '20'),
(1118, '049', 'Chiconcuautla', '0001', 'Chiconcuautla', '2019-07-16 09:29:32', '21'),
(1119, '049', 'Villa de Ramos', '0001', 'Villa de Ramos', '2019-07-16 09:29:43', '24'),
(1120, '049', 'Quiriego', '0001', 'Quiriego', '2019-07-16 09:29:46', '26'),
(1121, '049', 'San Damián Texóloc', '0001', 'San Damián Texóloc', '2019-07-16 09:29:52', '29'),
(1122, '049', 'Cotaxtla', '0001', 'Cotaxtla', '2019-07-16 09:29:54', '30'),
(1123, '049', 'Mayapán', '0001', 'Mayapán', '2019-07-16 09:30:03', '31'),
(1124, '049', 'Valparaíso', '0001', 'Valparaíso', '2019-07-16 09:30:08', '32'),
(1125, '050', 'La Libertad', '0001', 'La Libertad', '2019-07-16 09:28:30', '07'),
(1126, '050', 'Nuevo Casas Grandes', '0001', 'Nuevo Casas Grandes', '2019-07-16 09:28:34', '08'),
(1127, '050', 'Pungarabato', '0001', 'Ciudad Altamirano', '2019-07-16 09:28:41', '12'),
(1128, '050', 'Progreso de Obregón', '0001', 'Progreso', '2019-07-16 09:28:44', '13'),
(1129, '050', 'Jocotepec', '0001', 'Jocotepec', '2019-07-16 09:28:48', '14'),
(1130, '050', 'Juchitepec', '0001', 'Juchitepec de Mariano Rivapalacio', '2019-07-16 09:28:53', '15'),
(1131, '050', 'Maravatío', '0001', 'Maravatío de Ocampo', '2019-07-16 09:28:58', '16'),
(1132, '050', 'Vallecillo', '0001', 'Vallecillo', '2019-07-16 09:29:05', '19'),
(1133, '050', 'Magdalena Peñasco', '0001', 'Magdalena Peñasco', '2019-07-16 09:29:07', '20'),
(1134, '050', 'Chichiquila', '0001', 'Chichiquila', '2019-07-16 09:29:32', '21'),
(1135, '050', 'Villa de Reyes', '0001', 'Villa de Reyes', '2019-07-16 09:29:43', '24'),
(1136, '050', 'Rayón', '0001', 'Rayón', '2019-07-16 09:29:46', '26'),
(1137, '050', 'San Francisco Tetlanohcan', '0001', 'San Francisco Tetlanohcan', '2019-07-16 09:29:52', '29'),
(1138, '050', 'Coxquihui', '0001', 'Coxquihui', '2019-07-16 09:29:54', '30'),
(1139, '050', 'Mérida', '0001', 'Mérida', '2019-07-16 09:30:03', '31'),
(1140, '050', 'Vetagrande', '0001', 'Vetagrande', '2019-07-16 09:30:08', '32'),
(1141, '051', 'Mapastepec', '0001', 'Mapastepec', '2019-07-16 09:28:30', '07'),
(1142, '051', 'Ocampo', '0001', 'Melchor Ocampo', '2019-07-16 09:28:34', '08'),
(1143, '051', 'Quechultenango', '0001', 'Quechultenango', '2019-07-16 09:28:41', '12'),
(1144, '051', 'Mineral de la Reforma', '0001', 'Pachuquilla', '2019-07-16 09:28:44', '13'),
(1145, '051', 'Juanacatlán', '0001', 'Juanacatlán', '2019-07-16 09:28:48', '14'),
(1146, '051', 'Lerma', '0001', 'Lerma de Villada', '2019-07-16 09:28:53', '15'),
(1147, '051', 'Marcos Castellanos', '0001', 'San José de Gracia', '2019-07-16 09:28:58', '16'),
(1148, '051', 'Villaldama', '0001', 'Ciudad de Villaldama', '2019-07-16 09:29:05', '19'),
(1149, '051', 'Magdalena Teitipac', '0001', 'Magdalena Teitipac', '2019-07-16 09:29:07', '20'),
(1150, '051', 'Chietla', '0001', 'Chietla', '2019-07-16 09:29:32', '21'),
(1151, '051', 'Villa Hidalgo', '0001', 'Villa Hidalgo', '2019-07-16 09:29:43', '24'),
(1152, '051', 'Rosario', '0001', 'Rosario', '2019-07-16 09:29:46', '26'),
(1153, '051', 'San Jerónimo Zacualpan', '0001', 'San Jerónimo Zacualpan', '2019-07-16 09:29:52', '29'),
(1154, '051', 'Coyutla', '0001', 'Coyutla', '2019-07-16 09:29:54', '30'),
(1155, '051', 'Mocochá', '0001', 'Mocochá', '2019-07-16 09:30:03', '31'),
(1156, '051', 'Villa de Cos', '0001', 'Villa de Cos', '2019-07-16 09:30:08', '32'),
(1157, '052', 'Las Margaritas', '0001', 'Las Margaritas', '2019-07-16 09:28:30', '07'),
(1158, '052', 'Ojinaga', '0001', 'Manuel Ojinaga', '2019-07-16 09:28:35', '08'),
(1159, '052', 'San Luis Acatlán', '0001', 'San Luis Acatlán', '2019-07-16 09:28:41', '12'),
(1160, '052', 'San Agustín Tlaxiaca', '0001', 'San Agustín Tlaxiaca', '2019-07-16 09:28:44', '13'),
(1161, '052', 'Juchitlán', '0001', 'Juchitlán', '2019-07-16 09:28:48', '14'),
(1162, '052', 'Malinalco', '0001', 'Malinalco', '2019-07-16 09:28:53', '15'),
(1163, '052', 'Lázaro Cárdenas', '0001', 'Ciudad Lázaro Cárdenas', '2019-07-16 09:28:58', '16'),
(1164, '052', 'Magdalena Tequisistlán', '0001', 'Magdalena Tequisistlán', '2019-07-16 09:29:07', '20'),
(1165, '052', 'Chigmecatitlán', '0001', 'Chigmecatitlán', '2019-07-16 09:29:32', '21'),
(1166, '052', 'Villa Juárez', '0001', 'Villa Juárez', '2019-07-16 09:29:43', '24'),
(1167, '052', 'Sahuaripa', '0001', 'Sahuaripa', '2019-07-16 09:29:46', '26'),
(1168, '052', 'San José Teacalco', '0001', 'San José Teacalco', '2019-07-16 09:29:52', '29'),
(1169, '052', 'Cuichapa', '0001', 'Cuichapa', '2019-07-16 09:29:54', '30'),
(1170, '052', 'Motul', '0001', 'Motul de Carrillo Puerto', '2019-07-16 09:30:03', '31'),
(1171, '052', 'Villa García', '0001', 'Villa García', '2019-07-16 09:30:08', '32'),
(1172, '053', 'Mazapa de Madero', '0001', 'Mazapa de Madero', '2019-07-16 09:28:30', '07'),
(1173, '053', 'Praxedis G. Guerrero', '0001', 'Praxedis G. Guerrero', '2019-07-16 09:28:35', '08'),
(1174, '053', 'San Marcos', '0001', 'San Marcos', '2019-07-16 09:28:41', '12'),
(1175, '053', 'San Bartolo Tutotepec', '0001', 'San Bartolo Tutotepec', '2019-07-16 09:28:44', '13'),
(1176, '053', 'Lagos de Moreno', '0001', 'Lagos de Moreno', '2019-07-16 09:28:48', '14'),
(1177, '053', 'Melchor Ocampo', '0001', 'Melchor Ocampo', '2019-07-16 09:28:53', '15'),
(1178, '053', 'Morelia', '0001', 'Morelia', '2019-07-16 09:28:58', '16'),
(1179, '053', 'Magdalena Tlacotepec', '0001', 'Magdalena Tlacotepec', '2019-07-16 09:29:07', '20'),
(1180, '053', 'Chignahuapan', '0001', 'Ciudad de Chignahuapan', '2019-07-16 09:29:32', '21'),
(1181, '053', 'Axtla de Terrazas', '0001', 'Axtla de Terrazas', '2019-07-16 09:29:43', '24'),
(1182, '053', 'San Felipe de Jesús', '0001', 'San Felipe de Jesús', '2019-07-16 09:29:46', '26'),
(1183, '053', 'San Juan Huactzinco', '0001', 'San Juan Huactzinco', '2019-07-16 09:29:52', '29'),
(1184, '053', 'Cuitláhuac', '0001', 'Cuitláhuac', '2019-07-16 09:29:55', '30'),
(1185, '053', 'Muna', '0001', 'Muna', '2019-07-16 09:30:03', '31'),
(1186, '053', 'Villa González Ortega', '0001', 'Villa González Ortega', '2019-07-16 09:30:08', '32'),
(1187, '054', 'Mazatán', '0001', 'Mazatán', '2019-07-16 09:28:30', '07'),
(1188, '054', 'Riva Palacio', '0001', 'San Andrés', '2019-07-16 09:28:35', '08'),
(1189, '054', 'San Miguel Totolapan', '0001', 'San Miguel Totolapan', '2019-07-16 09:28:41', '12'),
(1190, '054', 'San Salvador', '0001', 'San Salvador', '2019-07-16 09:28:44', '13'),
(1191, '054', 'El Limón', '0001', 'El Limón', '2019-07-16 09:28:48', '14'),
(1192, '054', 'Metepec', '0001', 'Metepec', '2019-07-16 09:28:53', '15'),
(1193, '054', 'Morelos', '0001', 'Villa Morelos', '2019-07-16 09:28:58', '16'),
(1194, '054', 'Magdalena Zahuatlán', '0001', 'Magdalena Zahuatlán', '2019-07-16 09:29:07', '20'),
(1195, '054', 'Chignautla', '0001', 'Chignautla', '2019-07-16 09:29:32', '21'),
(1196, '054', 'Xilitla', '0001', 'Xilitla', '2019-07-16 09:29:43', '24'),
(1197, '054', 'San Javier', '0001', 'San Javier', '2019-07-16 09:29:46', '26'),
(1198, '054', 'San Lorenzo Axocomanitla', '0001', 'San Lorenzo Axocomanitla', '2019-07-16 09:29:52', '29'),
(1199, '054', 'Chacaltianguis', '0001', 'Chacaltianguis', '2019-07-16 09:29:55', '30'),
(1200, '054', 'Muxupip', '0001', 'Muxupip', '2019-07-16 09:30:03', '31'),
(1201, '054', 'Villa Hidalgo', '0001', 'Villa Hidalgo', '2019-07-16 09:30:08', '32'),
(1202, '055', 'Metapa', '0001', 'Metapa de Domínguez', '2019-07-16 09:28:30', '07'),
(1203, '055', 'Rosales', '0001', 'Santa Cruz de Rosales', '2019-07-16 09:28:35', '08'),
(1204, '055', 'Taxco de Alarcón', '0001', 'Taxco de Alarcón', '2019-07-16 09:28:41', '12'),
(1205, '055', 'Santiago de Anaya', '0001', 'Santiago de Anaya', '2019-07-16 09:28:44', '13'),
(1206, '055', 'Magdalena', '0001', 'Magdalena', '2019-07-16 09:28:48', '14'),
(1207, '055', 'Mexicaltzingo', '0001', 'San Mateo Mexicaltzingo', '2019-07-16 09:28:53', '15'),
(1208, '055', 'Múgica', '0001', 'Nueva Italia de Ruiz', '2019-07-16 09:28:59', '16'),
(1209, '055', 'Mariscala de Juárez', '0001', 'Mariscala de Juárez', '2019-07-16 09:29:07', '20'),
(1210, '055', 'Chila', '0001', 'Chila', '2019-07-16 09:29:32', '21'),
(1211, '055', 'Zaragoza', '0001', 'Villa de Zaragoza', '2019-07-16 09:29:43', '24'),
(1212, '055', 'San Luis Río Colorado', '0001', 'San Luis Río Colorado', '2019-07-16 09:29:46', '26'),
(1213, '055', 'San Lucas Tecopilco', '0001', 'San Lucas Tecopilco', '2019-07-16 09:29:52', '29'),
(1214, '055', 'Chalma', '0001', 'Chalma', '2019-07-16 09:29:55', '30'),
(1215, '055', 'Opichén', '0001', 'Opichén', '2019-07-16 09:30:03', '31'),
(1216, '055', 'Villanueva', '0001', 'Villanueva', '2019-07-16 09:30:08', '32'),
(1217, '056', 'Mitontic', '0001', 'Mitontic', '2019-07-16 09:28:30', '07'),
(1218, '056', 'Rosario', '0001', 'Valle del Rosario', '2019-07-16 09:28:35', '08'),
(1219, '056', 'Tecoanapa', '0001', 'Tecoanapa', '2019-07-16 09:28:41', '12'),
(1220, '056', 'Santiago Tulantepec de Lugo Guerrero', '0001', 'Santiago Tulantepec', '2019-07-16 09:28:44', '13'),
(1221, '056', 'Santa María del Oro', '0001', 'Santa María del Oro', '2019-07-16 09:28:48', '14'),
(1222, '056', 'Morelos', '0001', 'San Bartolo Morelos', '2019-07-16 09:28:53', '15'),
(1223, '056', 'Nahuatzen', '0001', 'Nahuatzen', '2019-07-16 09:28:59', '16'),
(1224, '056', 'Mártires de Tacubaya', '0001', 'Mártires de Tacubaya', '2019-07-16 09:29:07', '20'),
(1225, '056', 'Chila de la Sal', '0001', 'Chila de la Sal', '2019-07-16 09:29:32', '21'),
(1226, '056', 'Villa de Arista', '0002', 'Villa de Arista', '2019-07-16 09:29:43', '24'),
(1227, '056', 'San Miguel de Horcasitas', '0001', 'San Miguel de Horcasitas', '2019-07-16 09:29:46', '26'),
(1228, '056', 'Santa Ana Nopalucan', '0001', 'Santa Ana Nopalucan', '2019-07-16 09:29:52', '29'),
(1229, '056', 'Chiconamel', '0001', 'Chiconamel', '2019-07-16 09:29:55', '30'),
(1230, '056', 'Oxkutzcab', '0001', 'Oxkutzcab', '2019-07-16 09:30:03', '31'),
(1231, '056', 'Zacatecas', '0001', 'Zacatecas', '2019-07-16 09:30:08', '32');
INSERT INTO `municipio` (`idm`, `cve_mun`, `nom_mun`, `cve_cab`, `nom_cab`, `fechaModificacion`, `cve_ent`) VALUES
(1232, '057', 'Motozintla', '0001', 'Motozintla de Mendoza', '2019-07-16 09:28:30', '07'),
(1233, '057', 'San Francisco de Borja', '0001', 'San Francisco de Borja', '2019-07-16 09:28:35', '08'),
(1234, '057', 'Técpan de Galeana', '0001', 'Técpan de Galeana', '2019-07-16 09:28:41', '12'),
(1235, '057', 'Singuilucan', '0001', 'Singuilucan', '2019-07-16 09:28:45', '13'),
(1236, '057', 'La Manzanilla de la Paz', '0001', 'La Manzanilla de la Paz', '2019-07-16 09:28:48', '14'),
(1237, '057', 'Naucalpan de Juárez', '0001', 'Naucalpan de Juárez', '2019-07-16 09:28:53', '15'),
(1238, '057', 'Nocupétaro', '0001', 'Nocupétaro de Morelos', '2019-07-16 09:28:59', '16'),
(1239, '057', 'Matías Romero Avendaño', '0001', 'Matías Romero Avendaño', '2019-07-16 09:29:07', '20'),
(1240, '057', 'Honey', '0001', 'Honey', '2019-07-16 09:29:32', '21'),
(1241, '057', 'Matlapa', '0001', 'Matlapa', '2019-07-16 09:29:43', '24'),
(1242, '057', 'San Pedro de la Cueva', '0001', 'San Pedro de la Cueva', '2019-07-16 09:29:46', '26'),
(1243, '057', 'Santa Apolonia Teacalco', '0001', 'Santa Apolonia Teacalco', '2019-07-16 09:29:52', '29'),
(1244, '057', 'Chiconquiaco', '0001', 'Chiconquiaco', '2019-07-16 09:29:55', '30'),
(1245, '057', 'Panabá', '0001', 'Panabá', '2019-07-16 09:30:03', '31'),
(1246, '057', 'Trancoso', '0001', 'Trancoso', '2019-07-16 09:30:08', '32'),
(1247, '058', 'Nicolás Ruíz', '0001', 'Nicolás Ruíz', '2019-07-16 09:28:30', '07'),
(1248, '058', 'San Francisco de Conchos', '0001', 'San Francisco de Conchos', '2019-07-16 09:28:35', '08'),
(1249, '058', 'Teloloapan', '0001', 'Teloloapan', '2019-07-16 09:28:41', '12'),
(1250, '058', 'Tasquillo', '0001', 'Tasquillo', '2019-07-16 09:28:45', '13'),
(1251, '058', 'Mascota', '0001', 'Mascota', '2019-07-16 09:28:48', '14'),
(1252, '058', 'Nezahualcóyotl', '0001', 'Ciudad Nezahualcóyotl', '2019-07-16 09:28:53', '15'),
(1253, '058', 'Nuevo Parangaricutiro', '0001', 'Nuevo San Juan Parangaricutiro', '2019-07-16 09:28:59', '16'),
(1254, '058', 'Mazatlán Villa de Flores', '0001', 'Mazatlán Villa de Flores', '2019-07-16 09:29:07', '20'),
(1255, '058', 'Chilchotla', '0001', 'Rafael J. García', '2019-07-16 09:29:32', '21'),
(1256, '058', 'El Naranjo', '0001', 'El Naranjo', '2019-07-16 09:29:43', '24'),
(1257, '058', 'Santa Ana', '0001', 'Santa Ana', '2019-07-16 09:29:46', '26'),
(1258, '058', 'Santa Catarina Ayometla', '0001', 'Santa Catarina Ayometla', '2019-07-16 09:29:52', '29'),
(1259, '058', 'Chicontepec', '0001', 'Chicontepec de Tejeda', '2019-07-16 09:29:55', '30'),
(1260, '058', 'Peto', '0001', 'Peto', '2019-07-16 09:30:04', '31'),
(1261, '058', 'Santa María de la Paz', '0001', 'Santa María de la Paz', '2019-07-16 09:30:08', '32'),
(1262, '059', 'Ocosingo', '0001', 'Ocosingo', '2019-07-16 09:28:30', '07'),
(1263, '059', 'San Francisco del Oro', '0001', 'San Francisco del Oro', '2019-07-16 09:28:35', '08'),
(1264, '059', 'Tepecoacuilco de Trujano', '0001', 'Tepecoacuilco de Trujano', '2019-07-16 09:28:41', '12'),
(1265, '059', 'Tecozautla', '0001', 'Tecozautla', '2019-07-16 09:28:45', '13'),
(1266, '059', 'Mazamitla', '0001', 'Mazamitla', '2019-07-16 09:28:48', '14'),
(1267, '059', 'Nextlalpan', '0001', 'Santa Ana Nextlalpan', '2019-07-16 09:28:53', '15'),
(1268, '059', 'Nuevo Urecho', '0001', 'Nuevo Urecho', '2019-07-16 09:28:59', '16'),
(1269, '059', 'Miahuatlán de Porfirio Díaz', '0001', 'Miahuatlán de Porfirio Díaz', '2019-07-16 09:29:08', '20'),
(1270, '059', 'Chinantla', '0001', 'Chinantla', '2019-07-16 09:29:32', '21'),
(1271, '059', 'Santa Cruz', '0001', 'Santa Cruz', '2019-07-16 09:29:46', '26'),
(1272, '059', 'Santa Cruz Quilehtla', '0001', 'Santa Cruz Quilehtla', '2019-07-16 09:29:52', '29'),
(1273, '059', 'Chinameca', '0001', 'Chinameca', '2019-07-16 09:29:55', '30'),
(1274, '059', 'Progreso', '0001', 'Progreso', '2019-07-16 09:30:04', '31'),
(1275, '060', 'Ocotepec', '0001', 'Ocotepec', '2019-07-16 09:28:30', '07'),
(1276, '060', 'Santa Bárbara', '0001', 'Santa Bárbara', '2019-07-16 09:28:35', '08'),
(1277, '060', 'Tetipac', '0001', 'Tetipac', '2019-07-16 09:28:42', '12'),
(1278, '060', 'Tenango de Doria', '0001', 'Tenango de Doria', '2019-07-16 09:28:45', '13'),
(1279, '060', 'Mexticacán', '0001', 'Mexticacán', '2019-07-16 09:28:48', '14'),
(1280, '060', 'Nicolás Romero', '0001', 'Ciudad Nicolás Romero', '2019-07-16 09:28:53', '15'),
(1281, '060', 'Numarán', '0001', 'Numarán', '2019-07-16 09:28:59', '16'),
(1282, '060', 'Mixistlán de la Reforma', '0001', 'Mixistlán de la Reforma', '2019-07-16 09:29:08', '20'),
(1283, '060', 'Domingo Arenas', '0001', 'Domingo Arenas', '2019-07-16 09:29:32', '21'),
(1284, '060', 'Sáric', '0001', 'Sáric', '2019-07-16 09:29:46', '26'),
(1285, '060', 'Santa Isabel Xiloxoxtla', '0001', 'Santa Isabel Xiloxoxtla', '2019-07-16 09:29:52', '29'),
(1286, '060', 'Chinampa de Gorostiza', '0001', 'Chinampa de Gorostiza', '2019-07-16 09:29:55', '30'),
(1287, '060', 'Quintana Roo', '0001', 'Quintana Roo', '2019-07-16 09:30:04', '31'),
(1288, '061', 'Ocozocoautla de Espinosa', '0001', 'Ocozocoautla de Espinosa', '2019-07-16 09:28:30', '07'),
(1289, '061', 'Satevó', '0001', 'San Francisco Javier de Satevó', '2019-07-16 09:28:35', '08'),
(1290, '061', 'Tixtla de Guerrero', '0001', 'Tixtla de Guerrero', '2019-07-16 09:28:42', '12'),
(1291, '061', 'Tepeapulco', '0001', 'Tepeapulco', '2019-07-16 09:28:45', '13'),
(1292, '061', 'Mezquitic', '0001', 'Mezquitic', '2019-07-16 09:28:48', '14'),
(1293, '061', 'Nopaltepec', '0001', 'Nopaltepec', '2019-07-16 09:28:53', '15'),
(1294, '061', 'Ocampo', '0001', 'Ocampo', '2019-07-16 09:28:59', '16'),
(1295, '061', 'Monjas', '0001', 'Monjas', '2019-07-16 09:29:08', '20'),
(1296, '061', 'Eloxochitlán', '0001', 'Eloxochitlán', '2019-07-16 09:29:32', '21'),
(1297, '061', 'Soyopa', '0001', 'Soyopa', '2019-07-16 09:29:46', '26'),
(1298, '061', 'Las Choapas', '0001', 'Las Choapas', '2019-07-16 09:29:55', '30'),
(1299, '061', 'Río Lagartos', '0001', 'Río Lagartos', '2019-07-16 09:30:04', '31'),
(1300, '062', 'Ostuacán', '0001', 'Ostuacán', '2019-07-16 09:28:30', '07'),
(1301, '062', 'Saucillo', '0001', 'Saucillo', '2019-07-16 09:28:35', '08'),
(1302, '062', 'Tlacoachistlahuaca', '0001', 'Tlacoachistlahuaca', '2019-07-16 09:28:42', '12'),
(1303, '062', 'Tepehuacán de Guerrero', '0001', 'Tepehuacán de Guerrero', '2019-07-16 09:28:45', '13'),
(1304, '062', 'Mixtlán', '0001', 'Mixtlán', '2019-07-16 09:28:48', '14'),
(1305, '062', 'Ocoyoacac', '0001', 'Ocoyoacac', '2019-07-16 09:28:53', '15'),
(1306, '062', 'Pajacuarán', '0001', 'Pajacuarán', '2019-07-16 09:28:59', '16'),
(1307, '062', 'Natividad', '0001', 'Natividad', '2019-07-16 09:29:08', '20'),
(1308, '062', 'Epatlán', '0001', 'San Juan Epatlán', '2019-07-16 09:29:32', '21'),
(1309, '062', 'Suaqui Grande', '0001', 'Suaqui Grande', '2019-07-16 09:29:47', '26'),
(1310, '062', 'Chocamán', '0001', 'Chocamán', '2019-07-16 09:29:55', '30'),
(1311, '062', 'Sacalum', '0001', 'Sacalum', '2019-07-16 09:30:04', '31'),
(1312, '063', 'Osumacinta', '0001', 'Osumacinta', '2019-07-16 09:28:30', '07'),
(1313, '063', 'Temósachic', '0001', 'Temósachic', '2019-07-16 09:28:35', '08'),
(1314, '063', 'Tlacoapa', '0001', 'Tlacoapa', '2019-07-16 09:28:42', '12'),
(1315, '063', 'Tepeji del Río de Ocampo', '0001', 'Tepeji del Río de Ocampo', '2019-07-16 09:28:45', '13'),
(1316, '063', 'Ocotlán', '0001', 'Ocotlán', '2019-07-16 09:28:48', '14'),
(1317, '063', 'Ocuilan', '0001', 'Ocuilan de Arteaga', '2019-07-16 09:28:54', '15'),
(1318, '063', 'Panindícuaro', '0001', 'Panindícuaro', '2019-07-16 09:28:59', '16'),
(1319, '063', 'Nazareno Etla', '0001', 'Nazareno Etla', '2019-07-16 09:29:08', '20'),
(1320, '063', 'Esperanza', '0001', 'Esperanza', '2019-07-16 09:29:32', '21'),
(1321, '063', 'Tepache', '0001', 'Tepache', '2019-07-16 09:29:47', '26'),
(1322, '063', 'Chontla', '0001', 'Chontla', '2019-07-16 09:29:55', '30'),
(1323, '063', 'Samahil', '0001', 'Samahil', '2019-07-16 09:30:04', '31'),
(1324, '064', 'Oxchuc', '0001', 'Oxchuc', '2019-07-16 09:28:31', '07'),
(1325, '064', 'El Tule', '0001', 'El Tule', '2019-07-16 09:28:35', '08'),
(1326, '064', 'Tlalchapa', '0001', 'Tlalchapa', '2019-07-16 09:28:42', '12'),
(1327, '064', 'Tepetitlán', '0001', 'Tepetitlán', '2019-07-16 09:28:45', '13'),
(1328, '064', 'Ojuelos de Jalisco', '0001', 'Ojuelos de Jalisco', '2019-07-16 09:28:48', '14'),
(1329, '064', 'El Oro', '0001', 'El Oro de Hidalgo', '2019-07-16 09:28:54', '15'),
(1330, '064', 'Parácuaro', '0001', 'Parácuaro', '2019-07-16 09:28:59', '16'),
(1331, '064', 'Nejapa de Madero', '0001', 'Nejapa de Madero', '2019-07-16 09:29:08', '20'),
(1332, '064', 'Francisco Z. Mena', '0001', 'Metlaltoyuca', '2019-07-16 09:29:32', '21'),
(1333, '064', 'Trincheras', '0001', 'Trincheras', '2019-07-16 09:29:47', '26'),
(1334, '064', 'Chumatlán', '0001', 'Chumatlán', '2019-07-16 09:29:55', '30'),
(1335, '064', 'Sanahcat', '0001', 'Sanahcat', '2019-07-16 09:30:04', '31'),
(1336, '065', 'Palenque', '0001', 'Palenque', '2019-07-16 09:28:31', '07'),
(1337, '065', 'Urique', '0001', 'Urique', '2019-07-16 09:28:35', '08'),
(1338, '065', 'Tlalixtaquilla de Maldonado', '0001', 'Tlalixtaquilla', '2019-07-16 09:28:42', '12'),
(1339, '065', 'Tetepango', '0001', 'Tetepango', '2019-07-16 09:28:45', '13'),
(1340, '065', 'Pihuamo', '0001', 'Pihuamo', '2019-07-16 09:28:48', '14'),
(1341, '065', 'Otumba', '0001', 'Otumba de Gómez Farías', '2019-07-16 09:28:54', '15'),
(1342, '065', 'Paracho', '0001', 'Paracho de Verduzco', '2019-07-16 09:28:59', '16'),
(1343, '065', 'Ixpantepec Nieves', '0001', 'Ixpantepec Nieves', '2019-07-16 09:29:08', '20'),
(1344, '065', 'General Felipe Ángeles', '0001', 'San Pablo de las Tunas', '2019-07-16 09:29:33', '21'),
(1345, '065', 'Tubutama', '0001', 'Tubutama', '2019-07-16 09:29:47', '26'),
(1346, '065', 'Emiliano Zapata', '0001', 'Dos Ríos', '2019-07-16 09:29:55', '30'),
(1347, '065', 'San Felipe', '0001', 'San Felipe', '2019-07-16 09:30:04', '31'),
(1348, '066', 'Pantelhó', '0001', 'Pantelhó', '2019-07-16 09:28:31', '07'),
(1349, '066', 'Uruachi', '0001', 'Uruachi', '2019-07-16 09:28:35', '08'),
(1350, '066', 'Tlapa de Comonfort', '0001', 'Tlapa de Comonfort', '2019-07-16 09:28:42', '12'),
(1351, '066', 'Villa de Tezontepec', '0001', 'Tezontepec', '2019-07-16 09:28:45', '13'),
(1352, '066', 'Poncitlán', '0001', 'Poncitlán', '2019-07-16 09:28:48', '14'),
(1353, '066', 'Otzoloapan', '0001', 'Otzoloapan', '2019-07-16 09:28:54', '15'),
(1354, '066', 'Pátzcuaro', '0001', 'Pátzcuaro', '2019-07-16 09:28:59', '16'),
(1355, '066', 'Santiago Niltepec', '0001', 'Santiago Niltepec', '2019-07-16 09:29:08', '20'),
(1356, '066', 'Guadalupe', '0001', 'Guadalupe', '2019-07-16 09:29:33', '21'),
(1357, '066', 'Ures', '0001', 'Heroica Ciudad de Ures', '2019-07-16 09:29:47', '26'),
(1358, '066', 'Espinal', '0001', 'Espinal', '2019-07-16 09:29:55', '30'),
(1359, '066', 'Santa Elena', '0001', 'Santa Elena', '2019-07-16 09:30:04', '31'),
(1360, '067', 'Pantepec', '0001', 'Pantepec', '2019-07-16 09:28:31', '07'),
(1361, '067', 'Valle de Zaragoza', '0001', 'Valle de Zaragoza', '2019-07-16 09:28:35', '08'),
(1362, '067', 'Tlapehuala', '0001', 'Tlapehuala', '2019-07-16 09:28:42', '12'),
(1363, '067', 'Tezontepec de Aldama', '0001', 'Tezontepec de Aldama', '2019-07-16 09:28:45', '13'),
(1364, '067', 'Puerto Vallarta', '0001', 'Puerto Vallarta', '2019-07-16 09:28:48', '14'),
(1365, '067', 'Otzolotepec', '0001', 'Villa Cuauhtémoc', '2019-07-16 09:28:54', '15'),
(1366, '067', 'Penjamillo', '0001', 'Penjamillo de Degollado', '2019-07-16 09:28:59', '16'),
(1367, '067', 'Oaxaca de Juárez', '0001', 'Oaxaca de Juárez', '2019-07-16 09:29:08', '20'),
(1368, '067', 'Guadalupe Victoria', '0001', 'Guadalupe Victoria', '2019-07-16 09:29:33', '21'),
(1369, '067', 'Villa Hidalgo', '0001', 'Villa Hidalgo', '2019-07-16 09:29:47', '26'),
(1370, '067', 'Filomeno Mata', '0001', 'Filomeno Mata', '2019-07-16 09:29:55', '30'),
(1371, '067', 'Seyé', '0001', 'Seyé', '2019-07-16 09:30:04', '31'),
(1372, '068', 'Pichucalco', '0001', 'Pichucalco', '2019-07-16 09:28:31', '07'),
(1373, '068', 'La Unión de Isidoro Montes de Oca', '0001', 'La Unión', '2019-07-16 09:28:42', '12'),
(1374, '068', 'Tianguistengo', '0001', 'Tianguistengo', '2019-07-16 09:28:45', '13'),
(1375, '068', 'Villa Purificación', '0001', 'Villa Purificación', '2019-07-16 09:28:49', '14'),
(1376, '068', 'Ozumba', '0001', 'Ozumba de Alzate', '2019-07-16 09:28:54', '15'),
(1377, '068', 'Peribán', '0001', 'Peribán de Ramos', '2019-07-16 09:28:59', '16'),
(1378, '068', 'Ocotlán de Morelos', '0001', 'Ocotlán de Morelos', '2019-07-16 09:29:08', '20'),
(1379, '068', 'Hermenegildo Galeana', '0001', 'Bienvenido', '2019-07-16 09:29:33', '21'),
(1380, '068', 'Villa Pesqueira', '0001', 'Villa Pesqueira (Mátape)', '2019-07-16 09:29:47', '26'),
(1381, '068', 'Fortín', '0001', 'Fortín de las Flores', '2019-07-16 09:29:55', '30'),
(1382, '068', 'Sinanché', '0001', 'Sinanché', '2019-07-16 09:30:04', '31'),
(1383, '069', 'Pijijiapan', '0001', 'Pijijiapan', '2019-07-16 09:28:31', '07'),
(1384, '069', 'Xalpatláhuac', '0001', 'Xalpatláhuac', '2019-07-16 09:28:42', '12'),
(1385, '069', 'Tizayuca', '0001', 'Tizayuca', '2019-07-16 09:28:45', '13'),
(1386, '069', 'Quitupan', '0001', 'Quitupan', '2019-07-16 09:28:49', '14'),
(1387, '069', 'Papalotla', '0001', 'Papalotla', '2019-07-16 09:28:54', '15'),
(1388, '069', 'La Piedad', '0001', 'La Piedad de Cabadas', '2019-07-16 09:28:59', '16'),
(1389, '069', 'La Pe', '0001', 'La Pe', '2019-07-16 09:29:08', '20'),
(1390, '069', 'Huaquechula', '0001', 'Huaquechula', '2019-07-16 09:29:33', '21'),
(1391, '069', 'Yécora', '0001', 'Yécora', '2019-07-16 09:29:47', '26'),
(1392, '069', 'Gutiérrez Zamora', '0001', 'Gutiérrez Zamora', '2019-07-16 09:29:55', '30'),
(1393, '069', 'Sotuta', '0001', 'Sotuta', '2019-07-16 09:30:04', '31'),
(1394, '070', 'El Porvenir', '0001', 'El Porvenir de Velasco Suárez', '2019-07-16 09:28:31', '07'),
(1395, '070', 'Xochihuehuetlán', '0001', 'Xochihuehuetlán', '2019-07-16 09:28:42', '12'),
(1396, '070', 'Tlahuelilpan', '0001', 'Tlahuelilpan', '2019-07-16 09:28:45', '13'),
(1397, '070', 'El Salto', '0001', 'El Salto', '2019-07-16 09:28:49', '14'),
(1398, '070', 'La Paz', '0001', 'Los Reyes Acaquilpan', '2019-07-16 09:28:54', '15'),
(1399, '070', 'Purépero', '0001', 'Purépero de Echáiz', '2019-07-16 09:28:59', '16'),
(1400, '070', 'Pinotepa de Don Luis', '0001', 'Pinotepa de Don Luis', '2019-07-16 09:29:08', '20'),
(1401, '070', 'Huatlatlauca', '0001', 'Huatlatlauca', '2019-07-16 09:29:33', '21'),
(1402, '070', 'General Plutarco Elías Calles', '0001', 'Sonoita', '2019-07-16 09:29:47', '26'),
(1403, '070', 'Hidalgotitlán', '0001', 'Hidalgotitlán', '2019-07-16 09:29:55', '30'),
(1404, '070', 'Sucilá', '0001', 'Sucilá', '2019-07-16 09:30:04', '31'),
(1405, '071', 'Villa Comaltitlán', '0001', 'Villa Comaltitlán', '2019-07-16 09:28:31', '07'),
(1406, '071', 'Xochistlahuaca', '0001', 'Xochistlahuaca', '2019-07-16 09:28:42', '12'),
(1407, '071', 'Tlahuiltepa', '0001', 'Tlahuiltepa', '2019-07-16 09:28:45', '13'),
(1408, '071', 'San Cristóbal de la Barranca', '0001', 'San Cristóbal de la Barranca', '2019-07-16 09:28:49', '14'),
(1409, '071', 'Polotitlán', '0001', 'Polotitlán de la Ilustración', '2019-07-16 09:28:54', '15'),
(1410, '071', 'Puruándiro', '0001', 'Puruándiro', '2019-07-16 09:28:59', '16'),
(1411, '071', 'Pluma Hidalgo', '0001', 'Pluma Hidalgo', '2019-07-16 09:29:08', '20'),
(1412, '071', 'Huauchinango', '0001', 'Huauchinango', '2019-07-16 09:29:33', '21'),
(1413, '071', 'Benito Juárez', '0001', 'Villa Juárez', '2019-07-16 09:29:47', '26'),
(1414, '071', 'Huatusco', '0001', 'Huatusco de Chicuellar', '2019-07-16 09:29:55', '30'),
(1415, '071', 'Sudzal', '0001', 'Sudzal', '2019-07-16 09:30:04', '31'),
(1416, '072', 'Pueblo Nuevo Solistahuacán', '0001', 'Pueblo Nuevo Solistahuacán', '2019-07-16 09:28:31', '07'),
(1417, '072', 'Zapotitlán Tablas', '0001', 'Zapotitlán Tablas', '2019-07-16 09:28:42', '12'),
(1418, '072', 'Tlanalapa', '0001', 'Tlanalapa', '2019-07-16 09:28:45', '13'),
(1419, '072', 'San Diego de Alejandría', '0001', 'San Diego de Alejandría', '2019-07-16 09:28:49', '14'),
(1420, '072', 'Rayón', '0001', 'Santa María Rayón', '2019-07-16 09:28:54', '15'),
(1421, '072', 'Queréndaro', '0001', 'Queréndaro', '2019-07-16 09:28:59', '16'),
(1422, '072', 'San José del Progreso', '0001', 'San José del Progreso', '2019-07-16 09:29:08', '20'),
(1423, '072', 'Huehuetla', '0001', 'Huehuetla', '2019-07-16 09:29:33', '21'),
(1424, '072', 'San Ignacio Río Muerto', '0001', 'San Ignacio Río Muerto', '2019-07-16 09:29:48', '26'),
(1425, '072', 'Huayacocotla', '0001', 'Huayacocotla', '2019-07-16 09:29:55', '30'),
(1426, '072', 'Suma', '0001', 'Suma', '2019-07-16 09:30:04', '31'),
(1427, '073', 'Rayón', '0001', 'Rayón', '2019-07-16 09:28:31', '07'),
(1428, '073', 'Zirándaro', '0001', 'Zirándaro de los Chávez', '2019-07-16 09:28:42', '12'),
(1429, '073', 'Tlanchinol', '0001', 'Tlanchinol', '2019-07-16 09:28:45', '13'),
(1430, '073', 'San Juan de los Lagos', '0001', 'San Juan de los Lagos', '2019-07-16 09:28:49', '14'),
(1431, '073', 'San Antonio la Isla', '0001', 'San Antonio la Isla', '2019-07-16 09:28:54', '15'),
(1432, '073', 'Quiroga', '0001', 'Quiroga', '2019-07-16 09:28:59', '16'),
(1433, '073', 'Putla Villa de Guerrero', '0001', 'Putla Villa de Guerrero', '2019-07-16 09:29:08', '20'),
(1434, '073', 'Huehuetlán el Chico', '0001', 'Huehuetlán el Chico', '2019-07-16 09:29:33', '21'),
(1435, '073', 'Hueyapan de Ocampo', '0001', 'Hueyapan de Ocampo', '2019-07-16 09:29:55', '30'),
(1436, '073', 'Tahdziú', '0001', 'Tahdziú', '2019-07-16 09:30:04', '31'),
(1437, '074', 'Reforma', '0001', 'Reforma', '2019-07-16 09:28:31', '07'),
(1438, '074', 'Zitlala', '0001', 'Zitlala', '2019-07-16 09:28:42', '12'),
(1439, '074', 'Tlaxcoapan', '0001', 'Tlaxcoapan', '2019-07-16 09:28:45', '13'),
(1440, '074', 'San Julián', '0001', 'San Julián', '2019-07-16 09:28:49', '14'),
(1441, '074', 'San Felipe del Progreso', '0001', 'San Felipe del Progreso', '2019-07-16 09:28:54', '15'),
(1442, '074', 'Cojumatlán de Régules', '0001', 'Cojumatlán de Régules', '2019-07-16 09:28:59', '16'),
(1443, '074', 'Santa Catarina Quioquitani', '0001', 'Santa Catarina Quioquitani', '2019-07-16 09:29:08', '20'),
(1444, '074', 'Huejotzingo', '0001', 'Huejotzingo', '2019-07-16 09:29:33', '21'),
(1445, '074', 'Huiloapan de Cuauhtémoc', '0001', 'Huiloapan de Cuauhtémoc', '2019-07-16 09:29:55', '30'),
(1446, '074', 'Tahmek', '0001', 'Tahmek', '2019-07-16 09:30:04', '31'),
(1447, '075', 'Las Rosas', '0001', 'Las Rosas', '2019-07-16 09:28:31', '07'),
(1448, '075', 'Eduardo Neri', '0001', 'Zumpango del Río', '2019-07-16 09:28:42', '12'),
(1449, '075', 'Tolcayuca', '0001', 'Tolcayuca', '2019-07-16 09:28:45', '13'),
(1450, '075', 'San Marcos', '0001', 'San Marcos', '2019-07-16 09:28:49', '14'),
(1451, '075', 'San Martín de las Pirámides', '0001', 'San Martín de las Pirámides', '2019-07-16 09:28:54', '15'),
(1452, '075', 'Los Reyes', '0001', 'Los Reyes de Salgado', '2019-07-16 09:28:59', '16'),
(1453, '075', 'Reforma de Pineda', '0001', 'Reforma de Pineda', '2019-07-16 09:29:08', '20'),
(1454, '075', 'Hueyapan', '0001', 'Hueyapan', '2019-07-16 09:29:33', '21'),
(1455, '075', 'Ignacio de la Llave', '0001', 'Ignacio de la Llave', '2019-07-16 09:29:55', '30'),
(1456, '075', 'Teabo', '0001', 'Teabo', '2019-07-16 09:30:04', '31'),
(1457, '076', 'Sabanilla', '0001', 'Sabanilla', '2019-07-16 09:28:31', '07'),
(1458, '076', 'Acatepec', '0001', 'Acatepec', '2019-07-16 09:28:42', '12'),
(1459, '076', 'Tula de Allende', '0001', 'Tula de Allende', '2019-07-16 09:28:45', '13'),
(1460, '076', 'San Martín de Bolaños', '0001', 'San Martín de Bolaños', '2019-07-16 09:28:49', '14'),
(1461, '076', 'San Mateo Atenco', '0001', 'San Mateo Atenco', '2019-07-16 09:28:54', '15'),
(1462, '076', 'Sahuayo', '0001', 'Sahuayo de Morelos', '2019-07-16 09:28:59', '16'),
(1463, '076', 'La Reforma', '0001', 'La Reforma', '2019-07-16 09:29:08', '20'),
(1464, '076', 'Hueytamalco', '0001', 'Hueytamalco', '2019-07-16 09:29:33', '21'),
(1465, '076', 'Ilamatlán', '0001', 'Ilamatlán', '2019-07-16 09:29:55', '30'),
(1466, '076', 'Tecoh', '0001', 'Tecoh', '2019-07-16 09:30:04', '31'),
(1467, '077', 'Salto de Agua', '0001', 'Salto de Agua', '2019-07-16 09:28:31', '07'),
(1468, '077', 'Marquelia', '0001', 'Marquelia', '2019-07-16 09:28:42', '12'),
(1469, '077', 'Tulancingo de Bravo', '0001', 'Tulancingo', '2019-07-16 09:28:45', '13'),
(1470, '077', 'San Martín Hidalgo', '0001', 'San Martín Hidalgo', '2019-07-16 09:28:49', '14'),
(1471, '077', 'San Simón de Guerrero', '0001', 'San Simón de Guerrero', '2019-07-16 09:28:54', '15'),
(1472, '077', 'San Lucas', '0001', 'San Lucas', '2019-07-16 09:28:59', '16'),
(1473, '077', 'Reyes Etla', '0001', 'Reyes Etla', '2019-07-16 09:29:08', '20'),
(1474, '077', 'Hueytlalpan', '0001', 'Hueytlalpan', '2019-07-16 09:29:33', '21'),
(1475, '077', 'Isla', '0001', 'Isla', '2019-07-16 09:29:55', '30'),
(1476, '077', 'Tekal de Venegas', '0001', 'Tekal de Venegas', '2019-07-16 09:30:04', '31'),
(1477, '078', 'San Cristóbal de las Casas', '0001', 'San Cristóbal de las Casas', '2019-07-16 09:28:31', '07'),
(1478, '078', 'Cochoapa el Grande', '0001', 'Cochoapa el Grande', '2019-07-16 09:28:42', '12'),
(1479, '078', 'Xochiatipan', '0001', 'Xochiatipan', '2019-07-16 09:28:45', '13'),
(1480, '078', 'San Miguel el Alto', '0001', 'San Miguel el Alto', '2019-07-16 09:28:49', '14'),
(1481, '078', 'Santo Tomás', '0001', 'Santo Tomás de los Plátanos', '2019-07-16 09:28:54', '15'),
(1482, '078', 'Santa Ana Maya', '0001', 'Santa Ana Maya', '2019-07-16 09:28:59', '16'),
(1483, '078', 'Rojas de Cuauhtémoc', '0001', 'Rojas de Cuauhtémoc', '2019-07-16 09:29:08', '20'),
(1484, '078', 'Huitzilan de Serdán', '0001', 'Huitzilan', '2019-07-16 09:29:33', '21'),
(1485, '078', 'Ixcatepec', '0001', 'Ixcatepec', '2019-07-16 09:29:56', '30'),
(1486, '078', 'Tekantó', '0001', 'Tekantó', '2019-07-16 09:30:04', '31'),
(1487, '079', 'San Fernando', '0001', 'San Fernando', '2019-07-16 09:28:31', '07'),
(1488, '079', 'José Joaquín de Herrera', '0001', 'Hueycantenango', '2019-07-16 09:28:42', '12'),
(1489, '079', 'Xochicoatlán', '0001', 'Xochicoatlán', '2019-07-16 09:28:45', '13'),
(1490, '079', 'Gómez Farías', '0001', 'San Sebastián del Sur', '2019-07-16 09:28:49', '14'),
(1491, '079', 'Soyaniquilpan de Juárez', '0001', 'San Francisco Soyaniquilpan', '2019-07-16 09:28:54', '15'),
(1492, '079', 'Salvador Escalante', '0001', 'Santa Clara del Cobre', '2019-07-16 09:29:00', '16'),
(1493, '079', 'Salina Cruz', '0001', 'Salina Cruz', '2019-07-16 09:29:08', '20'),
(1494, '079', 'Huitziltepec', '0001', 'Santa Clara Huitziltepec', '2019-07-16 09:29:33', '21'),
(1495, '079', 'Ixhuacán de los Reyes', '0001', 'Ixhuacán de los Reyes', '2019-07-16 09:29:56', '30'),
(1496, '079', 'Tekax', '0001', 'Tekax de Álvaro Obregón', '2019-07-16 09:30:05', '31'),
(1497, '080', 'Siltepec', '0001', 'Siltepec', '2019-07-16 09:28:31', '07'),
(1498, '080', 'Juchitán', '0001', 'Juchitán', '2019-07-16 09:28:42', '12'),
(1499, '080', 'Yahualica', '0001', 'Yahualica', '2019-07-16 09:28:45', '13'),
(1500, '080', 'San Sebastián del Oeste', '0001', 'San Sebastián del Oeste', '2019-07-16 09:28:49', '14'),
(1501, '080', 'Sultepec', '0001', 'Sultepec de Pedro Ascencio de Alquisiras', '2019-07-16 09:28:54', '15'),
(1502, '080', 'Senguio', '0001', 'Senguio', '2019-07-16 09:29:00', '16'),
(1503, '080', 'San Agustín Amatengo', '0001', 'San Agustín Amatengo', '2019-07-16 09:29:08', '20'),
(1504, '080', 'Atlequizayan', '0001', 'Atlequizayan', '2019-07-16 09:29:33', '21'),
(1505, '080', 'Ixhuatlán del Café', '0001', 'Ixhuatlán del Café', '2019-07-16 09:29:56', '30'),
(1506, '080', 'Tekit', '0001', 'Tekit', '2019-07-16 09:30:05', '31'),
(1507, '081', 'Simojovel', '0001', 'Simojovel de Allende', '2019-07-16 09:28:31', '07'),
(1508, '081', 'Iliatenco', '0001', 'Iliatenco', '2019-07-16 09:28:42', '12'),
(1509, '081', 'Zacualtipán de Ángeles', '0001', 'Zacualtipán', '2019-07-16 09:28:45', '13'),
(1510, '081', 'Santa María de los Ángeles', '0001', 'Santa María de los Ángeles', '2019-07-16 09:28:49', '14'),
(1511, '081', 'Tecámac', '0001', 'Tecámac de Felipe Villanueva', '2019-07-16 09:28:54', '15'),
(1512, '081', 'Susupuato', '0001', 'Susupuato de Guerrero', '2019-07-16 09:29:00', '16'),
(1513, '081', 'San Agustín Atenango', '0001', 'San Agustín Atenango', '2019-07-16 09:29:08', '20'),
(1514, '081', 'Ixcamilpa de Guerrero', '0001', 'Ixcamilpa', '2019-07-16 09:29:33', '21'),
(1515, '081', 'Ixhuatlancillo', '0001', 'Ixhuatlancillo', '2019-07-16 09:29:56', '30'),
(1516, '081', 'Tekom', '0001', 'Tekom', '2019-07-16 09:30:05', '31'),
(1517, '082', 'Sitalá', '0001', 'Sitalá', '2019-07-16 09:28:31', '07'),
(1518, '082', 'Zapotlán de Juárez', '0001', 'Zapotlán de Juárez', '2019-07-16 09:28:46', '13'),
(1519, '082', 'Sayula', '0001', 'Sayula', '2019-07-16 09:28:49', '14'),
(1520, '082', 'Tejupilco', '0001', 'Tejupilco de Hidalgo', '2019-07-16 09:28:54', '15'),
(1521, '082', 'Tacámbaro', '0001', 'Tacámbaro de Codallos', '2019-07-16 09:29:00', '16'),
(1522, '082', 'San Agustín Chayuco', '0001', 'San Agustín Chayuco', '2019-07-16 09:29:08', '20'),
(1523, '082', 'Ixcaquixtla', '0001', 'San Juan Ixcaquixtla', '2019-07-16 09:29:33', '21'),
(1524, '082', 'Ixhuatlán del Sureste', '0001', 'Ixhuatlán del Sureste', '2019-07-16 09:29:56', '30'),
(1525, '082', 'Telchac Pueblo', '0001', 'Telchac', '2019-07-16 09:30:05', '31'),
(1526, '083', 'Socoltenango', '0001', 'Socoltenango', '2019-07-16 09:28:31', '07'),
(1527, '083', 'Zempoala', '0001', 'Zempoala', '2019-07-16 09:28:46', '13'),
(1528, '083', 'Tala', '0001', 'Tala', '2019-07-16 09:28:49', '14'),
(1529, '083', 'Temamatla', '0001', 'Temamatla', '2019-07-16 09:28:54', '15'),
(1530, '083', 'Tancítaro', '0001', 'Tancítaro', '2019-07-16 09:29:00', '16'),
(1531, '083', 'San Agustín de las Juntas', '0001', 'San Agustín de las Juntas', '2019-07-16 09:29:08', '20'),
(1532, '083', 'Ixtacamaxtitlán', '0001', 'Ixtacamaxtitlán', '2019-07-16 09:29:33', '21'),
(1533, '083', 'Ixhuatlán de Madero', '0001', 'Ixhuatlán de Madero', '2019-07-16 09:29:56', '30'),
(1534, '083', 'Telchac Puerto', '0001', 'Telchac Puerto', '2019-07-16 09:30:05', '31'),
(1535, '084', 'Solosuchiapa', '0001', 'Solosuchiapa', '2019-07-16 09:28:31', '07'),
(1536, '084', 'Zimapán', '0001', 'Zimapán', '2019-07-16 09:28:46', '13'),
(1537, '084', 'Talpa de Allende', '0001', 'Talpa de Allende', '2019-07-16 09:28:49', '14'),
(1538, '084', 'Temascalapa', '0001', 'Temascalapa', '2019-07-16 09:28:54', '15'),
(1539, '084', 'Tangamandapio', '0001', 'Santiago Tangamandapio', '2019-07-16 09:29:00', '16'),
(1540, '084', 'San Agustín Etla', '0001', 'San Agustín Etla', '2019-07-16 09:29:09', '20'),
(1541, '084', 'Ixtepec', '0001', 'Ixtepec', '2019-07-16 09:29:33', '21'),
(1542, '084', 'Ixmatlahuacan', '0001', 'Ixmatlahuacan', '2019-07-16 09:29:56', '30'),
(1543, '084', 'Temax', '0001', 'Temax', '2019-07-16 09:30:05', '31'),
(1544, '085', 'Soyaló', '0001', 'Soyaló', '2019-07-16 09:28:31', '07'),
(1545, '085', 'Tamazula de Gordiano', '0001', 'Tamazula de Gordiano', '2019-07-16 09:28:49', '14'),
(1546, '085', 'Temascalcingo', '0001', 'Temascalcingo de José María Velasco', '2019-07-16 09:28:54', '15'),
(1547, '085', 'Tangancícuaro', '0001', 'Tangancícuaro de Arista', '2019-07-16 09:29:00', '16'),
(1548, '085', 'San Agustín Loxicha', '0001', 'San Agustín Loxicha', '2019-07-16 09:29:09', '20'),
(1549, '085', 'Izúcar de Matamoros', '0001', 'Izúcar de Matamoros', '2019-07-16 09:29:33', '21'),
(1550, '085', 'Ixtaczoquitlán', '0001', 'Ixtaczoquitlán', '2019-07-16 09:29:56', '30'),
(1551, '085', 'Temozón', '0001', 'Temozón', '2019-07-16 09:30:05', '31'),
(1552, '086', 'Suchiapa', '0001', 'Suchiapa', '2019-07-16 09:28:31', '07'),
(1553, '086', 'Tapalpa', '0001', 'Tapalpa', '2019-07-16 09:28:49', '14'),
(1554, '086', 'Temascaltepec', '0001', 'Temascaltepec de González', '2019-07-16 09:28:55', '15'),
(1555, '086', 'Tanhuato', '0001', 'Tanhuato de Guerrero', '2019-07-16 09:29:00', '16'),
(1556, '086', 'San Agustín Tlacotepec', '0001', 'San Agustín Tlacotepec', '2019-07-16 09:29:09', '20'),
(1557, '086', 'Jalpan', '0001', 'Jalpan', '2019-07-16 09:29:33', '21'),
(1558, '086', 'Jalacingo', '0001', 'Jalacingo', '2019-07-16 09:29:56', '30'),
(1559, '086', 'Tepakán', '0001', 'Tepakán', '2019-07-16 09:30:05', '31'),
(1560, '087', 'Suchiate', '0001', 'Ciudad Hidalgo', '2019-07-16 09:28:31', '07'),
(1561, '087', 'Tecalitlán', '0001', 'Tecalitlán', '2019-07-16 09:28:49', '14'),
(1562, '087', 'Temoaya', '0001', 'Temoaya', '2019-07-16 09:28:55', '15'),
(1563, '087', 'Taretan', '0001', 'Taretan', '2019-07-16 09:29:00', '16'),
(1564, '087', 'San Agustín Yatareni', '0001', 'San Agustín Yatareni', '2019-07-16 09:29:09', '20'),
(1565, '087', 'Jolalpan', '0001', 'Jolalpan', '2019-07-16 09:29:33', '21'),
(1566, '087', 'Xalapa', '0001', 'Xalapa-Enríquez', '2019-07-16 09:29:56', '30'),
(1567, '087', 'Tetiz', '0001', 'Tetiz', '2019-07-16 09:30:05', '31'),
(1568, '088', 'Sunuapa', '0001', 'Sunuapa', '2019-07-16 09:28:31', '07'),
(1569, '088', 'Tecolotlán', '0001', 'Tecolotlán', '2019-07-16 09:28:50', '14'),
(1570, '088', 'Tenancingo', '0001', 'Tenancingo de Degollado', '2019-07-16 09:28:55', '15'),
(1571, '088', 'Tarímbaro', '0001', 'Tarímbaro', '2019-07-16 09:29:00', '16'),
(1572, '088', 'San Andrés Cabecera Nueva', '0001', 'San Andrés Cabecera Nueva', '2019-07-16 09:29:09', '20'),
(1573, '088', 'Jonotla', '0001', 'Jonotla', '2019-07-16 09:29:33', '21'),
(1574, '088', 'Jalcomulco', '0001', 'Jalcomulco', '2019-07-16 09:29:56', '30'),
(1575, '088', 'Teya', '0001', 'Teya', '2019-07-16 09:30:05', '31'),
(1576, '089', 'Tapachula', '0001', 'Tapachula de Córdova y Ordóñez', '2019-07-16 09:28:31', '07'),
(1577, '089', 'Techaluta de Montenegro', '0001', 'Techaluta de Montenegro', '2019-07-16 09:28:50', '14'),
(1578, '089', 'Tenango del Aire', '0001', 'Tenango del Aire', '2019-07-16 09:28:55', '15'),
(1579, '089', 'Tepalcatepec', '0001', 'Tepalcatepec', '2019-07-16 09:29:00', '16'),
(1580, '089', 'San Andrés Dinicuiti', '0001', 'San Andrés Dinicuiti', '2019-07-16 09:29:09', '20'),
(1581, '089', 'Jopala', '0001', 'Jopala', '2019-07-16 09:29:34', '21'),
(1582, '089', 'Jáltipan', '0001', 'Jáltipan de Morelos', '2019-07-16 09:29:56', '30'),
(1583, '089', 'Ticul', '0001', 'Ticul', '2019-07-16 09:30:05', '31'),
(1584, '090', 'Tapalapa', '0001', 'Tapalapa', '2019-07-16 09:28:31', '07'),
(1585, '090', 'Tenamaxtlán', '0001', 'Tenamaxtlán', '2019-07-16 09:28:50', '14'),
(1586, '090', 'Tenango del Valle', '0001', 'Tenango de Arista', '2019-07-16 09:28:55', '15'),
(1587, '090', 'Tingambato', '0001', 'Tingambato', '2019-07-16 09:29:00', '16'),
(1588, '090', 'San Andrés Huaxpaltepec', '0001', 'San Andrés Huaxpaltepec', '2019-07-16 09:29:09', '20'),
(1589, '090', 'Juan C. Bonilla', '0001', 'Cuanalá', '2019-07-16 09:29:34', '21'),
(1590, '090', 'Jamapa', '0001', 'Jamapa', '2019-07-16 09:29:56', '30'),
(1591, '090', 'Timucuy', '0001', 'Timucuy', '2019-07-16 09:30:05', '31'),
(1592, '091', 'Tapilula', '0001', 'Tapilula', '2019-07-16 09:28:31', '07'),
(1593, '091', 'Teocaltiche', '0001', 'Teocaltiche', '2019-07-16 09:28:50', '14'),
(1594, '091', 'Teoloyucan', '0001', 'Teoloyucan', '2019-07-16 09:28:55', '15'),
(1595, '091', 'Tingüindín', '0001', 'Tingüindín', '2019-07-16 09:29:00', '16'),
(1596, '091', 'San Andrés Huayápam', '0001', 'San Andrés Huayápam', '2019-07-16 09:29:09', '20'),
(1597, '091', 'Juan Galindo', '0001', 'Nuevo Necaxa', '2019-07-16 09:29:34', '21'),
(1598, '091', 'Jesús Carranza', '0001', 'Jesús Carranza', '2019-07-16 09:29:56', '30'),
(1599, '091', 'Tinum', '0001', 'Tinum', '2019-07-16 09:30:05', '31'),
(1600, '092', 'Tecpatán', '0001', 'Tecpatán', '2019-07-16 09:28:32', '07'),
(1601, '092', 'Teocuitatlán de Corona', '0001', 'Teocuitatlán de Corona', '2019-07-16 09:28:50', '14'),
(1602, '092', 'Teotihuacán', '0001', 'Teotihuacán de Arista', '2019-07-16 09:28:55', '15'),
(1603, '092', 'Tiquicheo de Nicolás Romero', '0001', 'Tiquicheo', '2019-07-16 09:29:00', '16'),
(1604, '092', 'San Andrés Ixtlahuaca', '0001', 'San Andrés Ixtlahuaca', '2019-07-16 09:29:09', '20'),
(1605, '092', 'Juan N. Méndez', '0001', 'Atenayuca', '2019-07-16 09:29:34', '21'),
(1606, '092', 'Xico', '0001', 'Xico', '2019-07-16 09:29:56', '30'),
(1607, '092', 'Tixcacalcupul', '0001', 'Tixcacalcupul', '2019-07-16 09:30:05', '31'),
(1608, '093', 'Tenejapa', '0001', 'Tenejapa', '2019-07-16 09:28:32', '07'),
(1609, '093', 'Tepatitlán de Morelos', '0001', 'Tepatitlán de Morelos', '2019-07-16 09:28:50', '14'),
(1610, '093', 'Tepetlaoxtoc', '0001', 'Tepetlaoxtoc de Hidalgo', '2019-07-16 09:28:55', '15'),
(1611, '093', 'Tlalpujahua', '0001', 'Tlalpujahua de Rayón', '2019-07-16 09:29:00', '16'),
(1612, '093', 'San Andrés Lagunas', '0001', 'San Andrés Lagunas', '2019-07-16 09:29:09', '20'),
(1613, '093', 'Lafragua', '0001', 'Saltillo', '2019-07-16 09:29:34', '21'),
(1614, '093', 'Jilotepec', '0001', 'Jilotepec', '2019-07-16 09:29:56', '30'),
(1615, '093', 'Tixkokob', '0001', 'Tixkokob', '2019-07-16 09:30:05', '31'),
(1616, '094', 'Teopisca', '0001', 'Teopisca', '2019-07-16 09:28:32', '07'),
(1617, '094', 'Tequila', '0001', 'Tequila', '2019-07-16 09:28:50', '14'),
(1618, '094', 'Tepetlixpa', '0001', 'Tepetlixpa', '2019-07-16 09:28:55', '15'),
(1619, '094', 'Tlazazalca', '0001', 'Tlazazalca', '2019-07-16 09:29:00', '16'),
(1620, '094', 'San Andrés Nuxiño', '0001', 'San Andrés Nuxiño', '2019-07-16 09:29:09', '20'),
(1621, '094', 'Libres', '0001', 'Ciudad de Libres', '2019-07-16 09:29:34', '21'),
(1622, '094', 'Juan Rodríguez Clara', '0001', 'Juan Rodríguez Clara', '2019-07-16 09:29:56', '30'),
(1623, '094', 'Tixmehuac', '0001', 'Tixmehuac', '2019-07-16 09:30:05', '31'),
(1624, '095', 'Teuchitlán', '0001', 'Teuchitlán', '2019-07-16 09:28:50', '14'),
(1625, '095', 'Tepotzotlán', '0001', 'Tepotzotlán', '2019-07-16 09:28:55', '15'),
(1626, '095', 'Tocumbo', '0001', 'Tocumbo', '2019-07-16 09:29:00', '16'),
(1627, '095', 'San Andrés Paxtlán', '0001', 'San Andrés Paxtlán', '2019-07-16 09:29:09', '20'),
(1628, '095', 'La Magdalena Tlatlauquitepec', '0001', 'La Magdalena Tlatlauquitepec', '2019-07-16 09:29:34', '21'),
(1629, '095', 'Juchique de Ferrer', '0001', 'Juchique de Ferrer', '2019-07-16 09:29:56', '30'),
(1630, '095', 'Tixpéhual', '0001', 'Tixpéhual', '2019-07-16 09:30:05', '31'),
(1631, '096', 'Tila', '0001', 'Tila', '2019-07-16 09:28:32', '07'),
(1632, '096', 'Tizapán el Alto', '0001', 'Tizapán el Alto', '2019-07-16 09:28:50', '14'),
(1633, '096', 'Tequixquiac', '0001', 'Tequixquiac', '2019-07-16 09:28:55', '15'),
(1634, '096', 'Tumbiscatío', '0001', 'Tumbiscatío de Ruiz', '2019-07-16 09:29:00', '16'),
(1635, '096', 'San Andrés Sinaxtla', '0001', 'San Andrés Sinaxtla', '2019-07-16 09:29:09', '20'),
(1636, '096', 'Mazapiltepec de Juárez', '0001', 'Mazapiltepec de Juárez', '2019-07-16 09:29:34', '21'),
(1637, '096', 'Landero y Coss', '0001', 'Landero y Coss', '2019-07-16 09:29:56', '30'),
(1638, '096', 'Tizimín', '0001', 'Tizimín', '2019-07-16 09:30:05', '31'),
(1639, '097', 'Tonalá', '0001', 'Tonalá', '2019-07-16 09:28:32', '07'),
(1640, '097', 'Tlajomulco de Zúñiga', '0001', 'Tlajomulco de Zúñiga', '2019-07-16 09:28:50', '14'),
(1641, '097', 'Texcaltitlán', '0001', 'Texcaltitlán', '2019-07-16 09:28:55', '15'),
(1642, '097', 'Turicato', '0001', 'Turicato', '2019-07-16 09:29:00', '16'),
(1643, '097', 'San Andrés Solaga', '0001', 'San Andrés Solaga', '2019-07-16 09:29:09', '20'),
(1644, '097', 'Mixtla', '0001', 'San Francisco Mixtla', '2019-07-16 09:29:34', '21'),
(1645, '097', 'Lerdo de Tejada', '0001', 'Lerdo de Tejada', '2019-07-16 09:29:56', '30'),
(1646, '097', 'Tunkás', '0001', 'Tunkás', '2019-07-16 09:30:05', '31'),
(1647, '098', 'Totolapa', '0001', 'Totolapa', '2019-07-16 09:28:32', '07'),
(1648, '098', 'San Pedro Tlaquepaque', '0001', 'Tlaquepaque', '2019-07-16 09:28:50', '14'),
(1649, '098', 'Texcalyacac', '0001', 'San Mateo Texcalyacac', '2019-07-16 09:28:55', '15'),
(1650, '098', 'Tuxpan', '0001', 'Tuxpan', '2019-07-16 09:29:00', '16'),
(1651, '098', 'San Andrés Teotilálpam', '0001', 'San Andrés Teotilálpam', '2019-07-16 09:29:09', '20'),
(1652, '098', 'Molcaxac', '0001', 'Molcaxac', '2019-07-16 09:29:34', '21'),
(1653, '098', 'Magdalena', '0001', 'Magdalena', '2019-07-16 09:29:56', '30'),
(1654, '098', 'Tzucacab', '0001', 'Tzucacab', '2019-07-16 09:30:05', '31'),
(1655, '099', 'La Trinitaria', '0001', 'La Trinitaria', '2019-07-16 09:28:32', '07'),
(1656, '099', 'Tolimán', '0001', 'Tolimán', '2019-07-16 09:28:50', '14'),
(1657, '099', 'Texcoco', '0001', 'Texcoco de Mora', '2019-07-16 09:28:55', '15'),
(1658, '099', 'Tuzantla', '0001', 'Tuzantla', '2019-07-16 09:29:00', '16'),
(1659, '099', 'San Andrés Tepetlapa', '0001', 'San Andrés Tepetlapa', '2019-07-16 09:29:09', '20'),
(1660, '099', 'Cañada Morelos', '0001', 'Morelos Cañada', '2019-07-16 09:29:34', '21'),
(1661, '099', 'Maltrata', '0001', 'Maltrata', '2019-07-16 09:29:56', '30'),
(1662, '099', 'Uayma', '0001', 'Uayma', '2019-07-16 09:30:05', '31'),
(1663, '100', 'Tumbalá', '0001', 'Tumbalá', '2019-07-16 09:28:32', '07'),
(1664, '100', 'Tomatlán', '0001', 'Tomatlán', '2019-07-16 09:28:50', '14'),
(1665, '100', 'Tezoyuca', '0001', 'Tezoyuca', '2019-07-16 09:28:55', '15'),
(1666, '100', 'Tzintzuntzan', '0001', 'Tzintzuntzan', '2019-07-16 09:29:00', '16'),
(1667, '100', 'San Andrés Yaá', '0001', 'San Andrés Yaá', '2019-07-16 09:29:09', '20'),
(1668, '100', 'Naupan', '0001', 'Naupan', '2019-07-16 09:29:34', '21'),
(1669, '100', 'Manlio Fabio Altamirano', '0001', 'Manlio Fabio Altamirano', '2019-07-16 09:29:57', '30'),
(1670, '100', 'Ucú', '0001', 'Ucú', '2019-07-16 09:30:05', '31'),
(1671, '101', 'Tuxtla Gutiérrez', '0001', 'Tuxtla Gutiérrez', '2019-07-16 09:28:32', '07'),
(1672, '101', 'Tonalá', '0001', 'Tonalá', '2019-07-16 09:28:50', '14'),
(1673, '101', 'Tianguistenco', '0001', 'Santiago Tianguistenco de Galeana', '2019-07-16 09:28:55', '15'),
(1674, '101', 'Tzitzio', '0001', 'Tzitzio', '2019-07-16 09:29:00', '16'),
(1675, '101', 'San Andrés Zabache', '0001', 'San Andrés Zabache', '2019-07-16 09:29:09', '20'),
(1676, '101', 'Nauzontla', '0001', 'Nauzontla', '2019-07-16 09:29:34', '21'),
(1677, '101', 'Mariano Escobedo', '0001', 'Mariano Escobedo', '2019-07-16 09:29:57', '30'),
(1678, '101', 'Umán', '0001', 'Umán', '2019-07-16 09:30:05', '31'),
(1679, '102', 'Tuxtla Chico', '0001', 'Tuxtla Chico', '2019-07-16 09:28:32', '07'),
(1680, '102', 'Tonaya', '0001', 'Tonaya', '2019-07-16 09:28:50', '14'),
(1681, '102', 'Timilpan', '0001', 'San Andrés Timilpan', '2019-07-16 09:28:55', '15'),
(1682, '102', 'Uruapan', '0001', 'Uruapan', '2019-07-16 09:29:01', '16'),
(1683, '102', 'San Andrés Zautla', '0001', 'San Andrés Zautla', '2019-07-16 09:29:09', '20'),
(1684, '102', 'Nealtican', '0001', 'San Buenaventura Nealtican', '2019-07-16 09:29:34', '21'),
(1685, '102', 'Martínez de la Torre', '0001', 'Martínez de la Torre', '2019-07-16 09:29:57', '30'),
(1686, '102', 'Valladolid', '0001', 'Valladolid', '2019-07-16 09:30:06', '31'),
(1687, '103', 'Tuzantán', '0001', 'Tuzantán', '2019-07-16 09:28:32', '07'),
(1688, '103', 'Tonila', '0001', 'Tonila', '2019-07-16 09:28:50', '14'),
(1689, '103', 'Tlalmanalco', '0001', 'Tlalmanalco de Velázquez', '2019-07-16 09:28:55', '15'),
(1690, '103', 'Venustiano Carranza', '0001', 'Venustiano Carranza', '2019-07-16 09:29:01', '16'),
(1691, '103', 'San Antonino Castillo Velasco', '0001', 'San Antonino Castillo Velasco', '2019-07-16 09:29:09', '20'),
(1692, '103', 'Nicolás Bravo', '0001', 'Nicolás Bravo', '2019-07-16 09:29:34', '21'),
(1693, '103', 'Mecatlán', '0001', 'Mecatlán', '2019-07-16 09:29:57', '30'),
(1694, '103', 'Xocchel', '0001', 'Xocchel', '2019-07-16 09:30:06', '31'),
(1695, '104', 'Tzimol', '0001', 'Tzimol', '2019-07-16 09:28:32', '07'),
(1696, '104', 'Totatiche', '0001', 'Totatiche', '2019-07-16 09:28:50', '14'),
(1697, '104', 'Tlalnepantla de Baz', '0001', 'Tlalnepantla', '2019-07-16 09:28:55', '15'),
(1698, '104', 'Villamar', '0001', 'Villamar', '2019-07-16 09:29:01', '16'),
(1699, '104', 'San Antonino el Alto', '0001', 'San Antonino el Alto', '2019-07-16 09:29:09', '20'),
(1700, '104', 'Nopalucan', '0001', 'Nopalucan de la Granja', '2019-07-16 09:29:35', '21'),
(1701, '104', 'Mecayapan', '0001', 'Mecayapan', '2019-07-16 09:29:57', '30'),
(1702, '104', 'Yaxcabá', '0001', 'Yaxcabá', '2019-07-16 09:30:06', '31'),
(1703, '105', 'Unión Juárez', '0001', 'Unión Juárez', '2019-07-16 09:28:32', '07'),
(1704, '105', 'Tototlán', '0001', 'Tototlán', '2019-07-16 09:28:50', '14'),
(1705, '105', 'Tlatlaya', '0001', 'Tlatlaya', '2019-07-16 09:28:55', '15'),
(1706, '105', 'Vista Hermosa', '0001', 'Vista Hermosa de Negrete', '2019-07-16 09:29:01', '16'),
(1707, '105', 'San Antonino Monte Verde', '0001', 'San Antonino Monte Verde', '2019-07-16 09:29:09', '20'),
(1708, '105', 'Ocotepec', '0001', 'Ocotepec', '2019-07-16 09:29:35', '21'),
(1709, '105', 'Medellín de Bravo', '0001', 'Medellín', '2019-07-16 09:29:57', '30'),
(1710, '105', 'Yaxkukul', '0001', 'Yaxkukul', '2019-07-16 09:30:06', '31'),
(1711, '106', 'Venustiano Carranza', '0001', 'Venustiano Carranza', '2019-07-16 09:28:32', '07'),
(1712, '106', 'Tuxcacuesco', '0001', 'Tuxcacuesco', '2019-07-16 09:28:50', '14'),
(1713, '106', 'Toluca', '0001', 'Toluca de Lerdo', '2019-07-16 09:28:55', '15'),
(1714, '106', 'Yurécuaro', '0001', 'Yurécuaro', '2019-07-16 09:29:01', '16'),
(1715, '106', 'San Antonio Acutla', '0001', 'San Antonio Acutla', '2019-07-16 09:29:10', '20'),
(1716, '106', 'Ocoyucan', '0001', 'Santa Clara Ocoyucan', '2019-07-16 09:29:35', '21'),
(1717, '106', 'Miahuatlán', '0001', 'Miahuatlán', '2019-07-16 09:29:57', '30'),
(1718, '106', 'Yobaín', '0001', 'Yobaín', '2019-07-16 09:30:06', '31'),
(1719, '107', 'Villa Corzo', '0001', 'Villa Corzo', '2019-07-16 09:28:32', '07'),
(1720, '107', 'Tuxcueca', '0001', 'Tuxcueca', '2019-07-16 09:28:50', '14'),
(1721, '107', 'Tonatico', '0001', 'Tonatico', '2019-07-16 09:28:55', '15'),
(1722, '107', 'Zacapu', '0001', 'Zacapu', '2019-07-16 09:29:01', '16'),
(1723, '107', 'San Antonio de la Cal', '0001', 'San Antonio de la Cal', '2019-07-16 09:29:10', '20'),
(1724, '107', 'Olintla', '0001', 'Olintla', '2019-07-16 09:29:35', '21'),
(1725, '107', 'Las Minas', '0001', 'Las Minas', '2019-07-16 09:29:57', '30'),
(1726, '108', 'Villaflores', '0001', 'Villaflores', '2019-07-16 09:28:32', '07'),
(1727, '108', 'Tuxpan', '0001', 'Tuxpan', '2019-07-16 09:28:50', '14'),
(1728, '108', 'Tultepec', '0001', 'Tultepec', '2019-07-16 09:28:55', '15'),
(1729, '108', 'Zamora', '0001', 'Zamora de Hidalgo', '2019-07-16 09:29:01', '16'),
(1730, '108', 'San Antonio Huitepec', '0001', 'San Antonio Huitepec', '2019-07-16 09:29:10', '20'),
(1731, '108', 'Oriental', '0001', 'Oriental', '2019-07-16 09:29:35', '21'),
(1732, '108', 'Minatitlán', '0001', 'Minatitlán', '2019-07-16 09:29:57', '30'),
(1733, '109', 'Yajalón', '0001', 'Yajalón', '2019-07-16 09:28:32', '07'),
(1734, '109', 'Unión de San Antonio', '0001', 'Unión de San Antonio', '2019-07-16 09:28:50', '14'),
(1735, '109', 'Tultitlán', '0001', 'Tultitlán de Mariano Escobedo', '2019-07-16 09:28:55', '15'),
(1736, '109', 'Zináparo', '0001', 'Zináparo', '2019-07-16 09:29:01', '16'),
(1737, '109', 'San Antonio Nanahuatípam', '0001', 'San Antonio Nanahuatípam', '2019-07-16 09:29:10', '20'),
(1738, '109', 'Pahuatlán', '0001', 'Ciudad de Pahuatlán de Valle', '2019-07-16 09:29:35', '21'),
(1739, '109', 'Misantla', '0001', 'Misantla', '2019-07-16 09:29:57', '30'),
(1740, '110', 'San Lucas', '0001', 'San Lucas', '2019-07-16 09:28:32', '07'),
(1741, '110', 'Unión de Tula', '0001', 'Unión de Tula', '2019-07-16 09:28:50', '14'),
(1742, '110', 'Valle de Bravo', '0001', 'Valle de Bravo', '2019-07-16 09:28:55', '15'),
(1743, '110', 'Zinapécuaro', '0001', 'Zinapécuaro de Figueroa', '2019-07-16 09:29:01', '16'),
(1744, '110', 'San Antonio Sinicahua', '0001', 'San Antonio Sinicahua', '2019-07-16 09:29:10', '20'),
(1745, '110', 'Palmar de Bravo', '0001', 'Palmar de Bravo', '2019-07-16 09:29:35', '21'),
(1746, '110', 'Mixtla de Altamirano', '0001', 'Mixtla de Altamirano', '2019-07-16 09:29:57', '30'),
(1747, '111', 'Zinacantán', '0001', 'Zinacantán', '2019-07-16 09:28:32', '07'),
(1748, '111', 'Valle de Guadalupe', '0001', 'Valle de Guadalupe', '2019-07-16 09:28:50', '14'),
(1749, '111', 'Villa de Allende', '0001', 'San José Villa de Allende', '2019-07-16 09:28:56', '15'),
(1750, '111', 'Ziracuaretiro', '0001', 'Ziracuaretiro', '2019-07-16 09:29:01', '16'),
(1751, '111', 'San Antonio Tepetlapa', '0001', 'San Antonio Tepetlapa', '2019-07-16 09:29:10', '20'),
(1752, '111', 'Pantepec', '0001', 'Pantepec', '2019-07-16 09:29:35', '21'),
(1753, '111', 'Moloacán', '0001', 'Moloacán', '2019-07-16 09:29:57', '30'),
(1754, '112', 'San Juan Cancuc', '0001', 'San Juan Cancuc', '2019-07-16 09:28:32', '07'),
(1755, '112', 'Valle de Juárez', '0001', 'Valle de Juárez', '2019-07-16 09:28:50', '14'),
(1756, '112', 'Villa del Carbón', '0001', 'Villa del Carbón', '2019-07-16 09:28:56', '15'),
(1757, '112', 'Zitácuaro', '0001', 'Heróica Zitácuaro', '2019-07-16 09:29:01', '16'),
(1758, '112', 'San Baltazar Chichicápam', '0001', 'San Baltazar Chichicápam', '2019-07-16 09:29:10', '20'),
(1759, '112', 'Petlalcingo', '0001', 'Petlalcingo', '2019-07-16 09:29:35', '21'),
(1760, '112', 'Naolinco', '0001', 'Naolinco de Victoria', '2019-07-16 09:29:57', '30'),
(1761, '113', 'Aldama', '0001', 'Aldama', '2019-07-16 09:28:32', '07'),
(1762, '113', 'San Gabriel', '0001', 'San Gabriel', '2019-07-16 09:28:51', '14'),
(1763, '113', 'Villa Guerrero', '0001', 'Villa Guerrero', '2019-07-16 09:28:56', '15'),
(1764, '113', 'José Sixto Verduzco', '0001', 'Pastor Ortiz', '2019-07-16 09:29:01', '16'),
(1765, '113', 'San Baltazar Loxicha', '0001', 'San Baltazar Loxicha', '2019-07-16 09:29:10', '20'),
(1766, '113', 'Piaxtla', '0001', 'Piaxtla', '2019-07-16 09:29:35', '21'),
(1767, '113', 'Naranjal', '0001', 'Naranjal', '2019-07-16 09:29:57', '30'),
(1768, '114', 'Benemérito de las Américas', '0001', 'Benemérito de las Américas', '2019-07-16 09:28:32', '07'),
(1769, '114', 'Villa Corona', '0001', 'Villa Corona', '2019-07-16 09:28:51', '14'),
(1770, '114', 'Villa Victoria', '0001', 'Villa Victoria', '2019-07-16 09:28:56', '15'),
(1771, '114', 'San Baltazar Yatzachi el Bajo', '0001', 'San Baltazar Yatzachi el Bajo', '2019-07-16 09:29:10', '20'),
(1772, '114', 'Puebla', '0001', 'Heróica Puebla de Zaragoza', '2019-07-16 09:29:35', '21'),
(1773, '114', 'Nautla', '0001', 'Nautla', '2019-07-16 09:29:57', '30'),
(1774, '115', 'Maravilla Tenejapa', '0001', 'Maravilla Tenejapa', '2019-07-16 09:28:32', '07'),
(1775, '115', 'Villa Guerrero', '0001', 'Villa Guerrero', '2019-07-16 09:28:51', '14'),
(1776, '115', 'Xonacatlán', '0001', 'Xonacatlán', '2019-07-16 09:28:56', '15'),
(1777, '115', 'San Bartolo Coyotepec', '0001', 'San Bartolo Coyotepec', '2019-07-16 09:29:10', '20'),
(1778, '115', 'Quecholac', '0001', 'Quecholac', '2019-07-16 09:29:35', '21'),
(1779, '115', 'Nogales', '0001', 'Nogales', '2019-07-16 09:29:57', '30'),
(1780, '116', 'Marqués de Comillas', '0001', 'Zamora Pico de Oro', '2019-07-16 09:28:32', '07'),
(1781, '116', 'Villa Hidalgo', '0001', 'Villa Hidalgo', '2019-07-16 09:28:51', '14'),
(1782, '116', 'Zacazonapan', '0001', 'Zacazonapan', '2019-07-16 09:28:56', '15'),
(1783, '116', 'San Bartolomé Ayautla', '0001', 'San Bartolomé Ayautla', '2019-07-16 09:29:10', '20'),
(1784, '116', 'Quimixtlán', '0001', 'Quimixtlán', '2019-07-16 09:29:35', '21'),
(1785, '116', 'Oluta', '0001', 'Oluta', '2019-07-16 09:29:57', '30'),
(1786, '117', 'Montecristo de Guerrero', '0001', 'Montecristo de Guerrero', '2019-07-16 09:28:32', '07'),
(1787, '117', 'Cañadas de Obregón', '0001', 'Cañadas de Obregón', '2019-07-16 09:28:51', '14'),
(1788, '117', 'Zacualpan', '0001', 'Zacualpan', '2019-07-16 09:28:56', '15'),
(1789, '117', 'San Bartolomé Loxicha', '0001', 'San Bartolomé Loxicha', '2019-07-16 09:29:10', '20'),
(1790, '117', 'Rafael Lara Grajales', '0001', 'Ciudad de Rafael Lara Grajales', '2019-07-16 09:29:35', '21'),
(1791, '117', 'Omealca', '0001', 'Omealca', '2019-07-16 09:29:57', '30'),
(1792, '118', 'San Andrés Duraznal', '0001', 'San Andrés Duraznal', '2019-07-16 09:28:32', '07'),
(1793, '118', 'Yahualica de González Gallo', '0001', 'Yahualica de González Gallo', '2019-07-16 09:28:51', '14'),
(1794, '118', 'Zinacantepec', '0001', 'San Miguel Zinacantepec', '2019-07-16 09:28:56', '15'),
(1795, '118', 'San Bartolomé Quialana', '0001', 'San Bartolomé Quialana', '2019-07-16 09:29:10', '20'),
(1796, '118', 'Los Reyes de Juárez', '0001', 'Los Reyes de Juárez', '2019-07-16 09:29:35', '21'),
(1797, '118', 'Orizaba', '0001', 'Orizaba', '2019-07-16 09:29:57', '30'),
(1798, '119', 'Santiago el Pinar', '0001', 'Santiago el Pinar', '2019-07-16 09:28:32', '07'),
(1799, '119', 'Zacoalco de Torres', '0001', 'Zacoalco de Torres', '2019-07-16 09:28:51', '14'),
(1800, '119', 'Zumpahuacán', '0001', 'Zumpahuacán', '2019-07-16 09:28:56', '15'),
(1801, '119', 'San Bartolomé Yucuañe', '0001', 'San Bartolomé Yucuañe', '2019-07-16 09:29:10', '20'),
(1802, '119', 'San Andrés Cholula', '0001', 'San Andrés Cholula', '2019-07-16 09:29:35', '21'),
(1803, '119', 'Otatitlán', '0001', 'Otatitlán', '2019-07-16 09:29:57', '30'),
(1804, '120', 'Zapopan', '0001', 'Zapopan', '2019-07-16 09:28:51', '14'),
(1805, '120', 'Zumpango', '0001', 'Zumpango de Ocampo', '2019-07-16 09:28:56', '15'),
(1806, '120', 'San Bartolomé Zoogocho', '0001', 'San Bartolomé Zoogocho', '2019-07-16 09:29:10', '20'),
(1807, '120', 'San Antonio Cañada', '0001', 'San Antonio Cañada', '2019-07-16 09:29:35', '21'),
(1808, '120', 'Oteapan', '0001', 'Oteapan', '2019-07-16 09:29:57', '30'),
(1809, '121', 'Zapotiltic', '0001', 'Zapotiltic', '2019-07-16 09:28:51', '14'),
(1810, '121', 'Cuautitlán Izcalli', '0001', 'Cuautitlán Izcalli', '2019-07-16 09:28:56', '15'),
(1811, '121', 'San Bartolo Soyaltepec', '0001', 'San Bartolo Soyaltepec', '2019-07-16 09:29:10', '20'),
(1812, '121', 'San Diego la Mesa Tochimiltzingo', '0001', 'Tochimiltzingo', '2019-07-16 09:29:36', '21'),
(1813, '121', 'Ozuluama de Mascareñas', '0001', 'Ozuluama de Mascareñas', '2019-07-16 09:29:57', '30'),
(1814, '122', 'Zapotitlán de Vadillo', '0001', 'Zapotitlán de Vadillo', '2019-07-16 09:28:51', '14'),
(1815, '122', 'Valle de Chalco Solidaridad', '0001', 'Xico', '2019-07-16 09:28:56', '15'),
(1816, '122', 'San Bartolo Yautepec', '0001', 'San Bartolo Yautepec', '2019-07-16 09:29:10', '20'),
(1817, '122', 'San Felipe Teotlalcingo', '0001', 'San Felipe Teotlalcingo', '2019-07-16 09:29:36', '21'),
(1818, '122', 'Pajapan', '0001', 'Pajapan', '2019-07-16 09:29:57', '30'),
(1819, '123', 'Zapotlán del Rey', '0001', 'Zapotlán del Rey', '2019-07-16 09:28:51', '14'),
(1820, '123', 'Luvianos', '0001', 'Villa Luvianos', '2019-07-16 09:28:56', '15'),
(1821, '123', 'San Bernardo Mixtepec', '0001', 'San Bernardo Mixtepec', '2019-07-16 09:29:10', '20');
INSERT INTO `municipio` (`idm`, `cve_mun`, `nom_mun`, `cve_cab`, `nom_cab`, `fechaModificacion`, `cve_ent`) VALUES
(1822, '123', 'San Felipe Tepatlán', '0001', 'San Felipe Tepatlán', '2019-07-16 09:29:36', '21'),
(1823, '123', 'Pánuco', '0001', 'Pánuco', '2019-07-16 09:29:57', '30'),
(1824, '124', 'Zapotlanejo', '0001', 'Zapotlanejo', '2019-07-16 09:28:51', '14'),
(1825, '124', 'San José del Rincón', '0001', 'San José del Rincón Centro', '2019-07-16 09:28:56', '15'),
(1826, '124', 'San Blas Atempa', '0001', 'San Blas Atempa', '2019-07-16 09:29:10', '20'),
(1827, '124', 'San Gabriel Chilac', '0001', 'San Gabriel Chilac', '2019-07-16 09:29:36', '21'),
(1828, '124', 'Papantla', '0001', 'Papantla de Olarte', '2019-07-16 09:29:57', '30'),
(1829, '125', 'San Ignacio Cerro Gordo', '0001', 'San Ignacio Cerro Gordo', '2019-07-16 09:28:51', '14'),
(1830, '125', 'Tonanitla', '0001', 'Santa María Tonanitla', '2019-07-16 09:28:56', '15'),
(1831, '125', 'San Carlos Yautepec', '0001', 'San Carlos Yautepec', '2019-07-16 09:29:10', '20'),
(1832, '125', 'San Gregorio Atzompa', '0001', 'San Gregorio Atzompa', '2019-07-16 09:29:36', '21'),
(1833, '125', 'Paso del Macho', '0001', 'Paso del Macho', '2019-07-16 09:29:58', '30'),
(1834, '126', 'San Cristóbal Amatlán', '0001', 'San Cristóbal Amatlán', '2019-07-16 09:29:10', '20'),
(1835, '126', 'San Jerónimo Tecuanipan', '0001', 'San Jerónimo Tecuanipan', '2019-07-16 09:29:36', '21'),
(1836, '126', 'Paso de Ovejas', '0001', 'Paso de Ovejas', '2019-07-16 09:29:58', '30'),
(1837, '127', 'San Cristóbal Amoltepec', '0001', 'San Cristóbal Amoltepec', '2019-07-16 09:29:10', '20'),
(1838, '127', 'San Jerónimo Xayacatlán', '0001', 'San Jerónimo Xayacatlán', '2019-07-16 09:29:36', '21'),
(1839, '127', 'La Perla', '0001', 'La Perla', '2019-07-16 09:29:58', '30'),
(1840, '128', 'San Cristóbal Lachirioag', '0001', 'San Cristóbal Lachirioag', '2019-07-16 09:29:10', '20'),
(1841, '128', 'San José Chiapa', '0001', 'San José Chiapa', '2019-07-16 09:29:36', '21'),
(1842, '128', 'Perote', '0001', 'Perote', '2019-07-16 09:29:58', '30'),
(1843, '129', 'San Cristóbal Suchixtlahuaca', '0001', 'San Cristóbal Suchixtlahuaca', '2019-07-16 09:29:10', '20'),
(1844, '129', 'San José Miahuatlán', '0001', 'San José Miahuatlán', '2019-07-16 09:29:36', '21'),
(1845, '129', 'Platón Sánchez', '0001', 'Platón Sánchez', '2019-07-16 09:29:58', '30'),
(1846, '130', 'San Dionisio del Mar', '0001', 'San Dionisio del Mar', '2019-07-16 09:29:11', '20'),
(1847, '130', 'San Juan Atenco', '0001', 'San Juan Atenco', '2019-07-16 09:29:36', '21'),
(1848, '130', 'Playa Vicente', '0001', 'Playa Vicente', '2019-07-16 09:29:58', '30'),
(1849, '131', 'San Dionisio Ocotepec', '0001', 'San Dionisio Ocotepec', '2019-07-16 09:29:11', '20'),
(1850, '131', 'San Juan Atzompa', '0001', 'San Juan Atzompa', '2019-07-16 09:29:36', '21'),
(1851, '131', 'Poza Rica de Hidalgo', '0001', 'Poza Rica de Hidalgo', '2019-07-16 09:29:58', '30'),
(1852, '132', 'San Dionisio Ocotlán', '0001', 'San Dionisio Ocotlán', '2019-07-16 09:29:11', '20'),
(1853, '132', 'San Martín Texmelucan', '0001', 'San Martín Texmelucan de Labastida', '2019-07-16 09:29:36', '21'),
(1854, '132', 'Las Vigas de Ramírez', '0001', 'Las Vigas de Ramírez', '2019-07-16 09:29:58', '30'),
(1855, '133', 'San Esteban Atatlahuca', '0001', 'San Esteban Atatlahuca', '2019-07-16 09:29:11', '20'),
(1856, '133', 'San Martín Totoltepec', '0001', 'San Martín Totoltepec', '2019-07-16 09:29:36', '21'),
(1857, '133', 'Pueblo Viejo', '0001', 'Cd. Cuauhtémoc', '2019-07-16 09:29:58', '30'),
(1858, '134', 'San Felipe Jalapa de Díaz', '0001', 'San Felipe Jalapa de Díaz', '2019-07-16 09:29:11', '20'),
(1859, '134', 'San Matías Tlalancaleca', '0001', 'San Matías Tlalancaleca', '2019-07-16 09:29:36', '21'),
(1860, '134', 'Puente Nacional', '0001', 'Puente Nacional', '2019-07-16 09:29:58', '30'),
(1861, '135', 'San Felipe Tejalápam', '0001', 'San Felipe Tejalápam', '2019-07-16 09:29:11', '20'),
(1862, '135', 'San Miguel Ixitlán', '0001', 'San Miguel Ixitlán', '2019-07-16 09:29:36', '21'),
(1863, '135', 'Rafael Delgado', '0001', 'Rafael Delgado', '2019-07-16 09:29:58', '30'),
(1864, '136', 'San Felipe Usila', '0001', 'San Felipe Usila', '2019-07-16 09:29:11', '20'),
(1865, '136', 'San Miguel Xoxtla', '0001', 'San Miguel Xoxtla', '2019-07-16 09:29:36', '21'),
(1866, '136', 'Rafael Lucio', '0001', 'Rafael Lucio', '2019-07-16 09:29:58', '30'),
(1867, '137', 'San Francisco Cahuacuá', '0001', 'San Francisco Cahuacuá', '2019-07-16 09:29:11', '20'),
(1868, '137', 'San Nicolás Buenos Aires', '0001', 'San Nicolás Buenos Aires', '2019-07-16 09:29:36', '21'),
(1869, '137', 'Los Reyes', '0001', 'Los Reyes', '2019-07-16 09:29:58', '30'),
(1870, '138', 'San Francisco Cajonos', '0001', 'San Francisco Cajonos', '2019-07-16 09:29:11', '20'),
(1871, '138', 'San Nicolás de los Ranchos', '0001', 'San Nicolás de los Ranchos', '2019-07-16 09:29:36', '21'),
(1872, '138', 'Río Blanco', '0001', 'Río Blanco', '2019-07-16 09:29:58', '30'),
(1873, '139', 'San Francisco Chapulapa', '0001', 'San Francisco Chapulapa', '2019-07-16 09:29:11', '20'),
(1874, '139', 'San Pablo Anicano', '0001', 'San Pablo Anicano', '2019-07-16 09:29:36', '21'),
(1875, '139', 'Saltabarranca', '0001', 'Saltabarranca', '2019-07-16 09:29:58', '30'),
(1876, '140', 'San Francisco Chindúa', '0001', 'San Francisco Chindúa', '2019-07-16 09:29:11', '20'),
(1877, '140', 'San Pedro Cholula', '0001', 'Cholula de Rivadavia', '2019-07-16 09:29:36', '21'),
(1878, '140', 'San Andrés Tenejapan', '0001', 'San Andrés Tenejapan', '2019-07-16 09:29:58', '30'),
(1879, '141', 'San Francisco del Mar', '0036', 'San Francisco del Mar', '2019-07-16 09:29:11', '20'),
(1880, '141', 'San Pedro Yeloixtlahuaca', '0001', 'San Pedro Yeloixtlahuaca', '2019-07-16 09:29:37', '21'),
(1881, '141', 'San Andrés Tuxtla', '0001', 'San Andrés Tuxtla', '2019-07-16 09:29:58', '30'),
(1882, '142', 'San Francisco Huehuetlán', '0001', 'San Francisco Huehuetlán', '2019-07-16 09:29:11', '20'),
(1883, '142', 'San Salvador el Seco', '0001', 'San Salvador el Seco', '2019-07-16 09:29:37', '21'),
(1884, '142', 'San Juan Evangelista', '0001', 'San Juan Evangelista', '2019-07-16 09:29:58', '30'),
(1885, '143', 'San Francisco Ixhuatán', '0001', 'San Francisco Ixhuatán', '2019-07-16 09:29:11', '20'),
(1886, '143', 'San Salvador el Verde', '0001', 'San Salvador el Verde', '2019-07-16 09:29:37', '21'),
(1887, '143', 'Santiago Tuxtla', '0001', 'Santiago Tuxtla', '2019-07-16 09:29:58', '30'),
(1888, '144', 'San Francisco Jaltepetongo', '0001', 'San Francisco Jaltepetongo', '2019-07-16 09:29:11', '20'),
(1889, '144', 'San Salvador Huixcolotla', '0001', 'San Salvador Huixcolotla', '2019-07-16 09:29:37', '21'),
(1890, '144', 'Sayula de Alemán', '0001', 'Sayula de Alemán', '2019-07-16 09:29:58', '30'),
(1891, '145', 'San Francisco Lachigoló', '0001', 'San Francisco Lachigoló', '2019-07-16 09:29:11', '20'),
(1892, '145', 'San Sebastián Tlacotepec', '0001', 'Tlacotepec de Porfirio Díaz', '2019-07-16 09:29:37', '21'),
(1893, '145', 'Soconusco', '0001', 'Soconusco', '2019-07-16 09:29:58', '30'),
(1894, '146', 'San Francisco Logueche', '0001', 'San Francisco Logueche', '2019-07-16 09:29:11', '20'),
(1895, '146', 'Santa Catarina Tlaltempan', '0001', 'Santa Catarina Tlaltempan', '2019-07-16 09:29:37', '21'),
(1896, '146', 'Sochiapa', '0001', 'Sochiapa', '2019-07-16 09:29:58', '30'),
(1897, '147', 'San Francisco Nuxaño', '0001', 'San Francisco Nuxaño', '2019-07-16 09:29:11', '20'),
(1898, '147', 'Santa Inés Ahuatempan', '0001', 'Santa Inés Ahuatempan', '2019-07-16 09:29:37', '21'),
(1899, '147', 'Soledad Atzompa', '0001', 'Soledad Atzompa', '2019-07-16 09:29:58', '30'),
(1900, '148', 'San Francisco Ozolotepec', '0001', 'San Francisco Ozolotepec', '2019-07-16 09:29:11', '20'),
(1901, '148', 'Santa Isabel Cholula', '0001', 'Santa Isabel Cholula', '2019-07-16 09:29:37', '21'),
(1902, '148', 'Soledad de Doblado', '0001', 'Soledad de Doblado', '2019-07-16 09:29:58', '30'),
(1903, '149', 'San Francisco Sola', '0001', 'San Francisco Sola', '2019-07-16 09:29:11', '20'),
(1904, '149', 'Santiago Miahuatlán', '0001', 'Santiago Miahuatlán', '2019-07-16 09:29:37', '21'),
(1905, '149', 'Soteapan', '0001', 'Soteapan', '2019-07-16 09:29:58', '30'),
(1906, '150', 'San Francisco Telixtlahuaca', '0001', 'San Francisco Telixtlahuaca', '2019-07-16 09:29:11', '20'),
(1907, '150', 'Huehuetlán el Grande', '0001', 'Santo Domingo Huehuetlán', '2019-07-16 09:29:37', '21'),
(1908, '150', 'Tamalín', '0001', 'Tamalín', '2019-07-16 09:29:58', '30'),
(1909, '151', 'San Francisco Teopan', '0001', 'San Francisco Teopan', '2019-07-16 09:29:11', '20'),
(1910, '151', 'Santo Tomás Hueyotlipan', '0001', 'Santo Tomás Hueyotlipan', '2019-07-16 09:29:37', '21'),
(1911, '151', 'Tamiahua', '0001', 'Tamiahua', '2019-07-16 09:29:59', '30'),
(1912, '152', 'San Francisco Tlapancingo', '0001', 'San Francisco Tlapancingo', '2019-07-16 09:29:11', '20'),
(1913, '152', 'Soltepec', '0001', 'Soltepec', '2019-07-16 09:29:37', '21'),
(1914, '152', 'Tampico Alto', '0001', 'Tampico Alto', '2019-07-16 09:29:59', '30'),
(1915, '153', 'San Gabriel Mixtepec', '0001', 'San Gabriel Mixtepec', '2019-07-16 09:29:11', '20'),
(1916, '153', 'Tecali de Herrera', '0001', 'Tecali de Herrera', '2019-07-16 09:29:37', '21'),
(1917, '153', 'Tancoco', '0001', 'Tancoco', '2019-07-16 09:29:59', '30'),
(1918, '154', 'San Ildefonso Amatlán', '0001', 'San Ildefonso Amatlán', '2019-07-16 09:29:12', '20'),
(1919, '154', 'Tecamachalco', '0001', 'Tecamachalco', '2019-07-16 09:29:37', '21'),
(1920, '154', 'Tantima', '0001', 'Tantima', '2019-07-16 09:29:59', '30'),
(1921, '155', 'San Ildefonso Sola', '0001', 'San Ildefonso Sola', '2019-07-16 09:29:12', '20'),
(1922, '155', 'Tecomatlán', '0001', 'Tecomatlán', '2019-07-16 09:29:37', '21'),
(1923, '155', 'Tantoyuca', '0001', 'Tantoyuca', '2019-07-16 09:29:59', '30'),
(1924, '156', 'San Ildefonso Villa Alta', '0001', 'San Ildefonso Villa Alta', '2019-07-16 09:29:12', '20'),
(1925, '156', 'Tehuacán', '0001', 'Tehuacán', '2019-07-16 09:29:37', '21'),
(1926, '156', 'Tatatila', '0001', 'Tatatila', '2019-07-16 09:29:59', '30'),
(1927, '157', 'San Jacinto Amilpas', '0001', 'San Jacinto Amilpas', '2019-07-16 09:29:12', '20'),
(1928, '157', 'Tehuitzingo', '0001', 'Tehuitzingo', '2019-07-16 09:29:37', '21'),
(1929, '157', 'Castillo de Teayo', '0001', 'Castillo de Teayo', '2019-07-16 09:29:59', '30'),
(1930, '158', 'San Jacinto Tlacotepec', '0001', 'San Jacinto Tlacotepec', '2019-07-16 09:29:12', '20'),
(1931, '158', 'Tenampulco', '0001', 'Tenampulco', '2019-07-16 09:29:37', '21'),
(1932, '158', 'Tecolutla', '0001', 'Tecolutla', '2019-07-16 09:29:59', '30'),
(1933, '159', 'San Jerónimo Coatlán', '0001', 'San Jerónimo Coatlán', '2019-07-16 09:29:12', '20'),
(1934, '159', 'Teopantlán', '0001', 'Teopantlán', '2019-07-16 09:29:37', '21'),
(1935, '159', 'Tehuipango', '0001', 'Tehuipango', '2019-07-16 09:29:59', '30'),
(1936, '160', 'San Jerónimo Silacayoapilla', '0001', 'San Jerónimo Silacayoapilla', '2019-07-16 09:29:12', '20'),
(1937, '160', 'Teotlalco', '0001', 'Teotlalco', '2019-07-16 09:29:37', '21'),
(1938, '160', 'Álamo Temapache', '0001', 'Álamo', '2019-07-16 09:29:59', '30'),
(1939, '161', 'San Jerónimo Sosola', '0001', 'San Jerónimo Sosola', '2019-07-16 09:29:12', '20'),
(1940, '161', 'Tepanco de López', '0001', 'Tepanco de López', '2019-07-16 09:29:37', '21'),
(1941, '161', 'Tempoal', '0001', 'Tempoal de Sánchez', '2019-07-16 09:29:59', '30'),
(1942, '162', 'San Jerónimo Taviche', '0001', 'San Jerónimo Taviche', '2019-07-16 09:29:12', '20'),
(1943, '162', 'Tepango de Rodríguez', '0001', 'Tepango de Rodríguez', '2019-07-16 09:29:37', '21'),
(1944, '162', 'Tenampa', '0001', 'Tenampa', '2019-07-16 09:29:59', '30'),
(1945, '163', 'San Jerónimo Tecóatl', '0001', 'San Jerónimo Tecóatl', '2019-07-16 09:29:12', '20'),
(1946, '163', 'Tepatlaxco de Hidalgo', '0001', 'Tepatlaxco de Hidalgo', '2019-07-16 09:29:37', '21'),
(1947, '163', 'Tenochtitlán', '0001', 'Tenochtitlán', '2019-07-16 09:29:59', '30'),
(1948, '164', 'San Jorge Nuchita', '0001', 'San Jorge Nuchita', '2019-07-16 09:29:12', '20'),
(1949, '164', 'Tepeaca', '0001', 'Tepeaca', '2019-07-16 09:29:37', '21'),
(1950, '164', 'Teocelo', '0001', 'Teocelo', '2019-07-16 09:29:59', '30'),
(1951, '165', 'San José Ayuquila', '0001', 'San José Ayuquila', '2019-07-16 09:29:12', '20'),
(1952, '165', 'Tepemaxalco', '0001', 'San Felipe Tepemaxalco', '2019-07-16 09:29:38', '21'),
(1953, '165', 'Tepatlaxco', '0001', 'Tepatlaxco', '2019-07-16 09:29:59', '30'),
(1954, '166', 'San José Chiltepec', '0001', 'San José Chiltepec', '2019-07-16 09:29:12', '20'),
(1955, '166', 'Tepeojuma', '0001', 'Tepeojuma', '2019-07-16 09:29:38', '21'),
(1956, '166', 'Tepetlán', '0001', 'Tepetlán', '2019-07-16 09:29:59', '30'),
(1957, '167', 'San José del Peñasco', '0001', 'San José del Peñasco', '2019-07-16 09:29:12', '20'),
(1958, '167', 'Tepetzintla', '0001', 'Tepetzintla', '2019-07-16 09:29:38', '21'),
(1959, '167', 'Tepetzintla', '0001', 'Tepetzintla', '2019-07-16 09:29:59', '30'),
(1960, '168', 'San José Estancia Grande', '0001', 'San José Estancia Grande', '2019-07-16 09:29:12', '20'),
(1961, '168', 'Tepexco', '0001', 'Tepexco', '2019-07-16 09:29:38', '21'),
(1962, '168', 'Tequila', '0001', 'Tequila', '2019-07-16 09:29:59', '30'),
(1963, '169', 'San José Independencia', '0001', 'San José Independencia', '2019-07-16 09:29:12', '20'),
(1964, '169', 'Tepexi de Rodríguez', '0001', 'Tepexi de Rodríguez', '2019-07-16 09:29:38', '21'),
(1965, '169', 'José Azueta', '0001', 'Villa Azueta', '2019-07-16 09:29:59', '30'),
(1966, '170', 'San José Lachiguiri', '0001', 'San José Lachiguiri', '2019-07-16 09:29:12', '20'),
(1967, '170', 'Tepeyahualco', '0001', 'Tepeyahualco', '2019-07-16 09:29:38', '21'),
(1968, '170', 'Texcatepec', '0001', 'Texcatepec', '2019-07-16 09:29:59', '30'),
(1969, '171', 'San José Tenango', '0001', 'San José Tenango', '2019-07-16 09:29:12', '20'),
(1970, '171', 'Tepeyahualco de Cuauhtémoc', '0001', 'Tepeyahualco de Cuauhtémoc', '2019-07-16 09:29:38', '21'),
(1971, '171', 'Texhuacán', '0001', 'Texhuacán', '2019-07-16 09:29:59', '30'),
(1972, '172', 'San Juan Achiutla', '0001', 'San Juan Achiutla', '2019-07-16 09:29:12', '20'),
(1973, '172', 'Tetela de Ocampo', '0001', 'Ciudad de Tetela de Ocampo', '2019-07-16 09:29:38', '21'),
(1974, '172', 'Texistepec', '0001', 'Texistepec', '2019-07-16 09:29:59', '30'),
(1975, '173', 'San Juan Atepec', '0001', 'San Juan Atepec', '2019-07-16 09:29:12', '20'),
(1976, '173', 'Teteles de Avila Castillo', '0001', 'Teteles de Avila Castillo', '2019-07-16 09:29:38', '21'),
(1977, '173', 'Tezonapa', '0001', 'Tezonapa', '2019-07-16 09:29:59', '30'),
(1978, '174', 'Ánimas Trujano', '0001', 'Ánimas Trujano', '2019-07-16 09:29:12', '20'),
(1979, '174', 'Teziutlán', '0001', 'Teziutlán', '2019-07-16 09:29:38', '21'),
(1980, '174', 'Tierra Blanca', '0001', 'Tierra Blanca', '2019-07-16 09:29:59', '30'),
(1981, '175', 'San Juan Bautista Atatlahuca', '0001', 'San Juan Bautista Atatlahuca', '2019-07-16 09:29:12', '20'),
(1982, '175', 'Tianguismanalco', '0001', 'Tianguismanalco', '2019-07-16 09:29:38', '21'),
(1983, '175', 'Tihuatlán', '0001', 'Tihuatlán', '2019-07-16 09:29:59', '30'),
(1984, '176', 'San Juan Bautista Coixtlahuaca', '0001', 'San Juan Bautista Coixtlahuaca', '2019-07-16 09:29:13', '20'),
(1985, '176', 'Tilapa', '0001', 'Tilapa', '2019-07-16 09:29:38', '21'),
(1986, '176', 'Tlacojalpan', '0001', 'Tlacojalpan', '2019-07-16 09:30:00', '30'),
(1987, '177', 'San Juan Bautista Cuicatlán', '0001', 'San Juan Bautista Cuicatlán', '2019-07-16 09:29:13', '20'),
(1988, '177', 'Tlacotepec de Benito Juárez', '0001', 'Tlacotepec de Benito Juárez', '2019-07-16 09:29:38', '21'),
(1989, '177', 'Tlacolulan', '0001', 'Tlacolulan', '2019-07-16 09:30:00', '30'),
(1990, '178', 'San Juan Bautista Guelache', '0001', 'San Juan Bautista Guelache', '2019-07-16 09:29:13', '20'),
(1991, '178', 'Tlacuilotepec', '0001', 'Tlacuilotepec', '2019-07-16 09:29:38', '21'),
(1992, '178', 'Tlacotalpan', '0001', 'Tlacotalpan', '2019-07-16 09:30:00', '30'),
(1993, '179', 'San Juan Bautista Jayacatlán', '0001', 'San Juan Bautista Jayacatlán', '2019-07-16 09:29:13', '20'),
(1994, '179', 'Tlachichuca', '0001', 'Tlachichuca', '2019-07-16 09:29:38', '21'),
(1995, '179', 'Tlacotepec de Mejía', '0001', 'Tlacotepec de Mejía', '2019-07-16 09:30:00', '30'),
(1996, '180', 'San Juan Bautista Lo de Soto', '0001', 'San Juan Bautista Lo de Soto', '2019-07-16 09:29:13', '20'),
(1997, '180', 'Tlahuapan', '0001', 'Santa Rita Tlahuapan', '2019-07-16 09:29:38', '21'),
(1998, '180', 'Tlachichilco', '0001', 'Tlachichilco', '2019-07-16 09:30:00', '30'),
(1999, '181', 'San Juan Bautista Suchitepec', '0001', 'San Juan Bautista Suchitepec', '2019-07-16 09:29:13', '20'),
(2000, '181', 'Tlaltenango', '0001', 'Tlaltenango', '2019-07-16 09:29:38', '21'),
(2001, '181', 'Tlalixcoyan', '0001', 'Tlalixcoyan', '2019-07-16 09:30:00', '30'),
(2002, '182', 'San Juan Bautista Tlacoatzintepec', '0001', 'San Juan Bautista Tlacoatzintepec', '2019-07-16 09:29:13', '20'),
(2003, '182', 'Tlanepantla', '0001', 'Tlanepantla', '2019-07-16 09:29:38', '21'),
(2004, '182', 'Tlalnelhuayocan', '0001', 'Tlalnelhuayocan', '2019-07-16 09:30:00', '30'),
(2005, '183', 'San Juan Bautista Tlachichilco', '0001', 'San Juan Bautista Tlachichilco', '2019-07-16 09:29:13', '20'),
(2006, '183', 'Tlaola', '0001', 'Tlaola', '2019-07-16 09:29:38', '21'),
(2007, '183', 'Tlapacoyan', '0001', 'Tlapacoyan', '2019-07-16 09:30:00', '30'),
(2008, '184', 'San Juan Bautista Tuxtepec', '0001', 'San Juan Bautista Tuxtepec', '2019-07-16 09:29:13', '20'),
(2009, '184', 'Tlapacoya', '0001', 'Tlapacoya', '2019-07-16 09:29:38', '21'),
(2010, '184', 'Tlaquilpa', '0001', 'Tlaquilpa', '2019-07-16 09:30:00', '30'),
(2011, '185', 'San Juan Cacahuatepec', '0001', 'San Juan Cacahuatepec', '2019-07-16 09:29:13', '20'),
(2012, '185', 'Tlapanalá', '0001', 'Tlapanalá', '2019-07-16 09:29:38', '21'),
(2013, '185', 'Tlilapan', '0001', 'Tlilapan', '2019-07-16 09:30:00', '30'),
(2014, '186', 'San Juan Cieneguilla', '0001', 'San Juan Cieneguilla', '2019-07-16 09:29:13', '20'),
(2015, '186', 'Tlatlauquitepec', '0001', 'Ciudad de Tlatlauquitepec', '2019-07-16 09:29:38', '21'),
(2016, '186', 'Tomatlán', '0001', 'Tomatlán', '2019-07-16 09:30:00', '30'),
(2017, '187', 'San Juan Coatzóspam', '0001', 'San Juan Coatzóspam', '2019-07-16 09:29:13', '20'),
(2018, '187', 'Tlaxco', '0001', 'Tlaxco', '2019-07-16 09:29:38', '21'),
(2019, '187', 'Tonayán', '0001', 'Tonayán', '2019-07-16 09:30:00', '30'),
(2020, '188', 'San Juan Colorado', '0001', 'San Juan Colorado', '2019-07-16 09:29:13', '20'),
(2021, '188', 'Tochimilco', '0001', 'Tochimilco', '2019-07-16 09:29:38', '21'),
(2022, '188', 'Totutla', '0001', 'Totutla', '2019-07-16 09:30:00', '30'),
(2023, '189', 'San Juan Comaltepec', '0001', 'San Juan Comaltepec', '2019-07-16 09:29:13', '20'),
(2024, '189', 'Tochtepec', '0001', 'Tochtepec', '2019-07-16 09:29:38', '21'),
(2025, '189', 'Tuxpan', '0001', 'Túxpam de Rodríguez Cano', '2019-07-16 09:30:00', '30'),
(2026, '190', 'San Juan Cotzocón', '0001', 'San Juan Cotzocón', '2019-07-16 09:29:13', '20'),
(2027, '190', 'Totoltepec de Guerrero', '0001', 'Totoltepec de Guerrero', '2019-07-16 09:29:38', '21'),
(2028, '190', 'Tuxtilla', '0001', 'Tuxtilla', '2019-07-16 09:30:00', '30'),
(2029, '191', 'San Juan Chicomezúchil', '0001', 'San Juan Chicomezúchil', '2019-07-16 09:29:13', '20'),
(2030, '191', 'Tulcingo', '0001', 'Tulcingo de Valle', '2019-07-16 09:29:39', '21'),
(2031, '191', 'Ursulo Galván', '0001', 'Ursulo Galván', '2019-07-16 09:30:00', '30'),
(2032, '192', 'San Juan Chilateca', '0001', 'San Juan Chilateca', '2019-07-16 09:29:13', '20'),
(2033, '192', 'Tuzamapan de Galeana', '0001', 'Tuzamapan de Galeana', '2019-07-16 09:29:39', '21'),
(2034, '192', 'Vega de Alatorre', '0001', 'Vega de Alatorre', '2019-07-16 09:30:00', '30'),
(2035, '193', 'San Juan del Estado', '0001', 'San Juan del Estado', '2019-07-16 09:29:13', '20'),
(2036, '193', 'Tzicatlacoyan', '0001', 'Tzicatlacoyan', '2019-07-16 09:29:39', '21'),
(2037, '193', 'Veracruz', '0001', 'Veracruz', '2019-07-16 09:30:00', '30'),
(2038, '194', 'San Juan del Río', '0001', 'San Juan del Río', '2019-07-16 09:29:13', '20'),
(2039, '194', 'Venustiano Carranza', '0001', 'Venustiano Carranza', '2019-07-16 09:29:39', '21'),
(2040, '194', 'Villa Aldama', '0001', 'Villa Aldama', '2019-07-16 09:30:00', '30'),
(2041, '195', 'San Juan Diuxi', '0001', 'San Juan Diuxi', '2019-07-16 09:29:13', '20'),
(2042, '195', 'Vicente Guerrero', '0001', 'Santa María del Monte', '2019-07-16 09:29:39', '21'),
(2043, '195', 'Xoxocotla', '0001', 'Xoxocotla', '2019-07-16 09:30:00', '30'),
(2044, '196', 'San Juan Evangelista Analco', '0001', 'San Juan Evangelista Analco', '2019-07-16 09:29:13', '20'),
(2045, '196', 'Xayacatlán de Bravo', '0001', 'Xayacatlán de Bravo', '2019-07-16 09:29:39', '21'),
(2046, '196', 'Yanga', '0001', 'Yanga', '2019-07-16 09:30:00', '30'),
(2047, '197', 'San Juan Guelavía', '0001', 'San Juan Guelavía', '2019-07-16 09:29:14', '20'),
(2048, '197', 'Xicotepec', '0001', 'Xicotepec de Juárez', '2019-07-16 09:29:39', '21'),
(2049, '197', 'Yecuatla', '0001', 'Yecuatla', '2019-07-16 09:30:00', '30'),
(2050, '198', 'San Juan Guichicovi', '0001', 'San Juan Guichicovi', '2019-07-16 09:29:14', '20'),
(2051, '198', 'Xicotlán', '0001', 'Xicotlán', '2019-07-16 09:29:39', '21'),
(2052, '198', 'Zacualpan', '0001', 'Zacualpan', '2019-07-16 09:30:00', '30'),
(2053, '199', 'San Juan Ihualtepec', '0001', 'San Juan Ihualtepec', '2019-07-16 09:29:14', '20'),
(2054, '199', 'Xiutetelco', '0001', 'San Juan Xiutetelco', '2019-07-16 09:29:39', '21'),
(2055, '199', 'Zaragoza', '0001', 'Zaragoza', '2019-07-16 09:30:00', '30'),
(2056, '200', 'San Juan Juquila Mixes', '0001', 'San Juan Juquila Mixes', '2019-07-16 09:29:14', '20'),
(2057, '200', 'Xochiapulco', '0001', 'Cinco de Mayo', '2019-07-16 09:29:39', '21'),
(2058, '200', 'Zentla', '0001', 'Colonia Manuel González', '2019-07-16 09:30:00', '30'),
(2059, '201', 'San Juan Juquila Vijanos', '0001', 'San Juan Juquila Vijanos', '2019-07-16 09:29:14', '20'),
(2060, '201', 'Xochiltepec', '0001', 'Xochiltepec', '2019-07-16 09:29:39', '21'),
(2061, '201', 'Zongolica', '0001', 'Zongolica', '2019-07-16 09:30:00', '30'),
(2062, '202', 'San Juan Lachao', '0001', 'San Juan Lachao', '2019-07-16 09:29:14', '20'),
(2063, '202', 'Xochitlán de Vicente Suárez', '0001', 'Xochitlán de Vicente Suárez', '2019-07-16 09:29:39', '21'),
(2064, '202', 'Zontecomatlán de López y Fuentes', '0001', 'Zontecomatlán de López y Fuentes', '2019-07-16 09:30:00', '30'),
(2065, '203', 'San Juan Lachigalla', '0001', 'San Juan Lachigalla', '2019-07-16 09:29:14', '20'),
(2066, '203', 'Xochitlán Todos Santos', '0001', 'Xochitlán', '2019-07-16 09:29:39', '21'),
(2067, '203', 'Zozocolco de Hidalgo', '0001', 'Zozocolco de Hidalgo', '2019-07-16 09:30:01', '30'),
(2068, '204', 'San Juan Lajarcia', '0001', 'San Juan Lajarcia', '2019-07-16 09:29:14', '20'),
(2069, '204', 'Yaonáhuac', '0001', 'Yaonáhuac', '2019-07-16 09:29:39', '21'),
(2070, '204', 'Agua Dulce', '0001', 'Agua Dulce', '2019-07-16 09:30:01', '30'),
(2071, '205', 'San Juan Lalana', '0001', 'San Juan Lalana', '2019-07-16 09:29:14', '20'),
(2072, '205', 'Yehualtepec', '0001', 'Yehualtepec', '2019-07-16 09:29:39', '21'),
(2073, '205', 'El Higo', '0001', 'El Higo', '2019-07-16 09:30:01', '30'),
(2074, '206', 'San Juan de los Cués', '0001', 'San Juan de los Cués', '2019-07-16 09:29:14', '20'),
(2075, '206', 'Zacapala', '0001', 'Zacapala', '2019-07-16 09:29:39', '21'),
(2076, '206', 'Nanchital de Lázaro Cárdenas del Río', '0001', 'Nanchital de Lázaro Cárdenas del Río', '2019-07-16 09:30:01', '30'),
(2077, '207', 'San Juan Mazatlán', '0001', 'San Juan Mazatlán', '2019-07-16 09:29:14', '20'),
(2078, '207', 'Zacapoaxtla', '0001', 'Zacapoaxtla', '2019-07-16 09:29:39', '21'),
(2079, '207', 'Tres Valles', '0001', 'Tres Valles', '2019-07-16 09:30:01', '30'),
(2080, '208', 'San Juan Mixtepec', '0001', 'San Juan Mixtepec Distrito 08', '2019-07-16 09:29:14', '20'),
(2081, '208', 'Zacatlán', '0001', 'Zacatlán', '2019-07-16 09:29:39', '21'),
(2082, '208', 'Carlos A. Carrillo', '0001', 'Carlos A. Carrillo', '2019-07-16 09:30:01', '30'),
(2083, '209', 'San Juan Mixtepec', '0001', 'San Juan Mixtepec Distrito 26', '2019-07-16 09:29:14', '20'),
(2084, '209', 'Zapotitlán', '0001', 'Zapotitlán Salinas', '2019-07-16 09:29:39', '21'),
(2085, '209', 'Tatahuicapan de Juárez', '0001', 'Tatahuicapan', '2019-07-16 09:30:01', '30'),
(2086, '210', 'San Juan Ñumí', '0001', 'San Juan Ñumí', '2019-07-16 09:29:14', '20'),
(2087, '210', 'Zapotitlán de Méndez', '0001', 'Zapotitlán de Méndez', '2019-07-16 09:29:39', '21'),
(2088, '210', 'Uxpanapa', '0001', 'Poblado 10', '2019-07-16 09:30:01', '30'),
(2089, '211', 'San Juan Ozolotepec', '0001', 'San Juan Ozolotepec', '2019-07-16 09:29:14', '20'),
(2090, '211', 'Zaragoza', '0001', 'Zaragoza', '2019-07-16 09:29:39', '21'),
(2091, '211', 'San Rafael', '0001', 'San Rafael', '2019-07-16 09:30:01', '30'),
(2092, '212', 'San Juan Petlapa', '0001', 'San Juan Petlapa', '2019-07-16 09:29:14', '20'),
(2093, '212', 'Zautla', '0001', 'Santiago Zautla', '2019-07-16 09:29:39', '21'),
(2094, '212', 'Santiago Sochiapan', '0001', 'Xochiapa', '2019-07-16 09:30:01', '30'),
(2095, '213', 'San Juan Quiahije', '0001', 'San Juan Quiahije', '2019-07-16 09:29:14', '20'),
(2096, '213', 'Zihuateutla', '0001', 'Zihuateutla', '2019-07-16 09:29:39', '21'),
(2097, '214', 'San Juan Quiotepec', '0001', 'San Juan Quiotepec', '2019-07-16 09:29:14', '20'),
(2098, '214', 'Zinacatepec', '0001', 'San Sebastián Zinacatepec', '2019-07-16 09:29:39', '21'),
(2099, '215', 'San Juan Sayultepec', '0001', 'San Juan Sayultepec', '2019-07-16 09:29:14', '20'),
(2100, '215', 'Zongozotla', '0001', 'Zongozotla', '2019-07-16 09:29:39', '21'),
(2101, '216', 'San Juan Tabaá', '0001', 'San Juan Tabaá', '2019-07-16 09:29:14', '20'),
(2102, '216', 'Zoquiapan', '0001', 'Zoquiapan', '2019-07-16 09:29:40', '21'),
(2103, '217', 'San Juan Tamazola', '0001', 'San Juan Tamazola', '2019-07-16 09:29:14', '20'),
(2104, '217', 'Zoquitlán', '0001', 'Zoquitlán', '2019-07-16 09:29:40', '21'),
(2105, '218', 'San Juan Teita', '0001', 'San Juan Teita', '2019-07-16 09:29:15', '20'),
(2106, '219', 'San Juan Teitipac', '0001', 'San Juan Teitipac', '2019-07-16 09:29:15', '20'),
(2107, '220', 'San Juan Tepeuxila', '0001', 'San Juan Tepeuxila', '2019-07-16 09:29:15', '20'),
(2108, '221', 'San Juan Teposcolula', '0001', 'San Juan Teposcolula', '2019-07-16 09:29:15', '20'),
(2109, '222', 'San Juan Yaeé', '0001', 'San Juan Yaeé', '2019-07-16 09:29:15', '20'),
(2110, '223', 'San Juan Yatzona', '0001', 'San Juan Yatzona', '2019-07-16 09:29:15', '20'),
(2111, '224', 'San Juan Yucuita', '0001', 'San Juan Yucuita', '2019-07-16 09:29:15', '20'),
(2112, '225', 'San Lorenzo', '0001', 'San Lorenzo', '2019-07-16 09:29:15', '20'),
(2113, '226', 'San Lorenzo Albarradas', '0001', 'San Lorenzo Albarradas', '2019-07-16 09:29:15', '20'),
(2114, '227', 'San Lorenzo Cacaotepec', '0001', 'San Lorenzo Cacaotepec', '2019-07-16 09:29:15', '20'),
(2115, '228', 'San Lorenzo Cuaunecuiltitla', '0001', 'San Lorenzo Cuaunecuiltitla', '2019-07-16 09:29:15', '20'),
(2116, '229', 'San Lorenzo Texmelúcan', '0001', 'San Lorenzo Texmelúcan', '2019-07-16 09:29:15', '20'),
(2117, '230', 'San Lorenzo Victoria', '0001', 'San Lorenzo Victoria', '2019-07-16 09:29:15', '20'),
(2118, '231', 'San Lucas Camotlán', '0001', 'San Lucas Camotlán', '2019-07-16 09:29:15', '20'),
(2119, '232', 'San Lucas Ojitlán', '0001', 'San Lucas Ojitlán', '2019-07-16 09:29:15', '20'),
(2120, '233', 'San Lucas Quiaviní', '0001', 'San Lucas Quiaviní', '2019-07-16 09:29:15', '20'),
(2121, '234', 'San Lucas Zoquiápam', '0001', 'San Lucas Zoquiápam', '2019-07-16 09:29:15', '20'),
(2122, '235', 'San Luis Amatlán', '0001', 'San Luis Amatlán', '2019-07-16 09:29:15', '20'),
(2123, '236', 'San Marcial Ozolotepec', '0001', 'San Marcial Ozolotepec', '2019-07-16 09:29:15', '20'),
(2124, '237', 'San Marcos Arteaga', '0001', 'San Marcos Arteaga', '2019-07-16 09:29:15', '20'),
(2125, '238', 'San Martín de los Cansecos', '0001', 'San Martín de los Cansecos', '2019-07-16 09:29:15', '20'),
(2126, '239', 'San Martín Huamelúlpam', '0001', 'San Martín Huamelúlpam', '2019-07-16 09:29:15', '20'),
(2127, '240', 'San Martín Itunyoso', '0001', 'San Martín Itunyoso', '2019-07-16 09:29:15', '20'),
(2128, '241', 'San Martín Lachilá', '0001', 'San Martín Lachilá', '2019-07-16 09:29:16', '20'),
(2129, '242', 'San Martín Peras', '0001', 'San Martín Peras', '2019-07-16 09:29:16', '20'),
(2130, '243', 'San Martín Tilcajete', '0001', 'San Martín Tilcajete', '2019-07-16 09:29:16', '20'),
(2131, '244', 'San Martín Toxpalan', '0001', 'San Martín Toxpalan', '2019-07-16 09:29:16', '20'),
(2132, '245', 'San Martín Zacatepec', '0001', 'San Martín Zacatepec', '2019-07-16 09:29:16', '20'),
(2133, '246', 'San Mateo Cajonos', '0001', 'San Mateo Cajonos', '2019-07-16 09:29:16', '20'),
(2134, '247', 'Capulálpam de Méndez', '0001', 'Capulálpam de Méndez', '2019-07-16 09:29:16', '20'),
(2135, '248', 'San Mateo del Mar', '0001', 'San Mateo del Mar', '2019-07-16 09:29:16', '20'),
(2136, '249', 'San Mateo Yoloxochitlán', '0001', 'San Mateo Yoloxochitlán', '2019-07-16 09:29:16', '20'),
(2137, '250', 'San Mateo Etlatongo', '0001', 'San Mateo Etlatongo', '2019-07-16 09:29:16', '20'),
(2138, '251', 'San Mateo Nejápam', '0001', 'San Mateo Nejápam', '2019-07-16 09:29:16', '20'),
(2139, '252', 'San Mateo Peñasco', '0001', 'San Mateo Peñasco', '2019-07-16 09:29:16', '20'),
(2140, '253', 'San Mateo Piñas', '0001', 'San Mateo Piñas', '2019-07-16 09:29:16', '20'),
(2141, '254', 'San Mateo Río Hondo', '0001', 'San Mateo Río Hondo', '2019-07-16 09:29:16', '20'),
(2142, '255', 'San Mateo Sindihui', '0001', 'San Mateo Sindihui', '2019-07-16 09:29:16', '20'),
(2143, '256', 'San Mateo Tlapiltepec', '0001', 'San Mateo Tlapiltepec', '2019-07-16 09:29:16', '20'),
(2144, '257', 'San Melchor Betaza', '0001', 'San Melchor Betaza', '2019-07-16 09:29:16', '20'),
(2145, '258', 'San Miguel Achiutla', '0001', 'San Miguel Achiutla', '2019-07-16 09:29:16', '20'),
(2146, '259', 'San Miguel Ahuehuetitlán', '0001', 'San Miguel Ahuehuetitlán', '2019-07-16 09:29:16', '20'),
(2147, '260', 'San Miguel Aloápam', '0001', 'San Miguel Aloápam', '2019-07-16 09:29:16', '20'),
(2148, '261', 'San Miguel Amatitlán', '0001', 'San Miguel Amatitlán', '2019-07-16 09:29:16', '20'),
(2149, '262', 'San Miguel Amatlán', '0001', 'San Miguel Amatlán', '2019-07-16 09:29:16', '20'),
(2150, '263', 'San Miguel Coatlán', '0001', 'San Miguel Coatlán', '2019-07-16 09:29:16', '20'),
(2151, '264', 'San Miguel Chicahua', '0001', 'San Miguel Chicahua', '2019-07-16 09:29:16', '20'),
(2152, '265', 'San Miguel Chimalapa', '0001', 'San Miguel Chimalapa', '2019-07-16 09:29:16', '20'),
(2153, '266', 'San Miguel del Puerto', '0001', 'San Miguel del Puerto', '2019-07-16 09:29:17', '20'),
(2154, '267', 'San Miguel del Río', '0001', 'San Miguel del Río', '2019-07-16 09:29:17', '20'),
(2155, '268', 'San Miguel Ejutla', '0001', 'San Miguel Ejutla', '2019-07-16 09:29:17', '20'),
(2156, '269', 'San Miguel el Grande', '0001', 'San Miguel el Grande', '2019-07-16 09:29:17', '20'),
(2157, '270', 'San Miguel Huautla', '0001', 'San Miguel Huautla', '2019-07-16 09:29:17', '20'),
(2158, '271', 'San Miguel Mixtepec', '0001', 'San Miguel Mixtepec', '2019-07-16 09:29:17', '20'),
(2159, '272', 'San Miguel Panixtlahuaca', '0001', 'San Miguel Panixtlahuaca', '2019-07-16 09:29:17', '20'),
(2160, '273', 'San Miguel Peras', '0001', 'San Miguel Peras', '2019-07-16 09:29:17', '20'),
(2161, '274', 'San Miguel Piedras', '0001', 'San Miguel Piedras', '2019-07-16 09:29:17', '20'),
(2162, '275', 'San Miguel Quetzaltepec', '0001', 'San Miguel Quetzaltepec', '2019-07-16 09:29:17', '20'),
(2163, '276', 'San Miguel Santa Flor', '0001', 'San Miguel Santa Flor', '2019-07-16 09:29:17', '20'),
(2164, '277', 'Villa Sola de Vega', '0001', 'Villa Sola de Vega', '2019-07-16 09:29:17', '20'),
(2165, '278', 'San Miguel Soyaltepec', '0001', 'Temascal', '2019-07-16 09:29:17', '20'),
(2166, '279', 'San Miguel Suchixtepec', '0001', 'San Miguel Suchixtepec', '2019-07-16 09:29:17', '20'),
(2167, '280', 'Villa Talea de Castro', '0001', 'Villa Talea de Castro', '2019-07-16 09:29:17', '20'),
(2168, '281', 'San Miguel Tecomatlán', '0001', 'San Miguel Tecomatlán', '2019-07-16 09:29:17', '20'),
(2169, '282', 'San Miguel Tenango', '0001', 'San Miguel Tenango', '2019-07-16 09:29:17', '20'),
(2170, '283', 'San Miguel Tequixtepec', '0001', 'San Miguel Tequixtepec', '2019-07-16 09:29:17', '20'),
(2171, '284', 'San Miguel Tilquiápam', '0001', 'San Miguel Tilquiápam', '2019-07-16 09:29:17', '20'),
(2172, '285', 'San Miguel Tlacamama', '0001', 'San Miguel Tlacamama', '2019-07-16 09:29:17', '20'),
(2173, '286', 'San Miguel Tlacotepec', '0001', 'San Miguel Tlacotepec', '2019-07-16 09:29:17', '20'),
(2174, '287', 'San Miguel Tulancingo', '0001', 'San Miguel Tulancingo', '2019-07-16 09:29:17', '20'),
(2175, '288', 'San Miguel Yotao', '0001', 'San Miguel Yotao', '2019-07-16 09:29:17', '20'),
(2176, '289', 'San Nicolás', '0001', 'San Nicolás', '2019-07-16 09:29:17', '20'),
(2177, '290', 'San Nicolás Hidalgo', '0001', 'San Nicolás Hidalgo', '2019-07-16 09:29:18', '20'),
(2178, '291', 'San Pablo Coatlán', '0001', 'San Pablo Coatlán', '2019-07-16 09:29:18', '20'),
(2179, '292', 'San Pablo Cuatro Venados', '0001', 'San Pablo Cuatro Venados', '2019-07-16 09:29:18', '20'),
(2180, '293', 'San Pablo Etla', '0001', 'San Pablo Etla', '2019-07-16 09:29:18', '20'),
(2181, '294', 'San Pablo Huitzo', '0001', 'San Pablo Huitzo', '2019-07-16 09:29:18', '20'),
(2182, '295', 'San Pablo Huixtepec', '0001', 'San Pablo Huixtepec', '2019-07-16 09:29:18', '20'),
(2183, '296', 'San Pablo Macuiltianguis', '0001', 'San Pablo Macuiltianguis', '2019-07-16 09:29:18', '20'),
(2184, '297', 'San Pablo Tijaltepec', '0001', 'San Pablo Tijaltepec', '2019-07-16 09:29:18', '20'),
(2185, '298', 'San Pablo Villa de Mitla', '0001', 'San Pablo Villa de Mitla', '2019-07-16 09:29:18', '20'),
(2186, '299', 'San Pablo Yaganiza', '0001', 'San Pablo Yaganiza', '2019-07-16 09:29:18', '20'),
(2187, '300', 'San Pedro Amuzgos', '0001', 'San Pedro Amuzgos', '2019-07-16 09:29:18', '20'),
(2188, '301', 'San Pedro Apóstol', '0001', 'San Pedro Apóstol', '2019-07-16 09:29:18', '20'),
(2189, '302', 'San Pedro Atoyac', '0001', 'San Pedro Atoyac', '2019-07-16 09:29:18', '20'),
(2190, '303', 'San Pedro Cajonos', '0001', 'San Pedro Cajonos', '2019-07-16 09:29:18', '20'),
(2191, '304', 'San Pedro Coxcaltepec Cántaros', '0001', 'San Pedro Coxcaltepec Cántaros', '2019-07-16 09:29:18', '20'),
(2192, '305', 'San Pedro Comitancillo', '0001', 'San Pedro Comitancillo', '2019-07-16 09:29:18', '20'),
(2193, '306', 'San Pedro el Alto', '0001', 'San Pedro el Alto', '2019-07-16 09:29:18', '20'),
(2194, '307', 'San Pedro Huamelula', '0001', 'San Pedro Huamelula', '2019-07-16 09:29:18', '20'),
(2195, '308', 'San Pedro Huilotepec', '0001', 'San Pedro Huilotepec', '2019-07-16 09:29:18', '20'),
(2196, '309', 'San Pedro Ixcatlán', '0001', 'San Pedro Ixcatlán', '2019-07-16 09:29:18', '20'),
(2197, '310', 'San Pedro Ixtlahuaca', '0001', 'San Pedro Ixtlahuaca', '2019-07-16 09:29:18', '20'),
(2198, '311', 'San Pedro Jaltepetongo', '0001', 'San Pedro Jaltepetongo', '2019-07-16 09:29:18', '20'),
(2199, '312', 'San Pedro Jicayán', '0001', 'San Pedro Jicayán', '2019-07-16 09:29:18', '20'),
(2200, '313', 'San Pedro Jocotipac', '0001', 'San Pedro Jocotipac', '2019-07-16 09:29:18', '20'),
(2201, '314', 'San Pedro Juchatengo', '0001', 'San Pedro Juchatengo', '2019-07-16 09:29:18', '20'),
(2202, '315', 'San Pedro Mártir', '0001', 'San Pedro Mártir', '2019-07-16 09:29:18', '20'),
(2203, '316', 'San Pedro Mártir Quiechapa', '0001', 'San Pedro Mártir Quiechapa', '2019-07-16 09:29:19', '20'),
(2204, '317', 'San Pedro Mártir Yucuxaco', '0001', 'San Pedro Mártir Yucuxaco', '2019-07-16 09:29:19', '20'),
(2205, '318', 'San Pedro Mixtepec', '0001', 'San Pedro Mixtepec Distrito 22', '2019-07-16 09:29:19', '20'),
(2206, '319', 'San Pedro Mixtepec', '0001', 'San Pedro Mixtepec Distrito 26', '2019-07-16 09:29:19', '20'),
(2207, '320', 'San Pedro Molinos', '0001', 'San Pedro Molinos', '2019-07-16 09:29:19', '20'),
(2208, '321', 'San Pedro Nopala', '0001', 'San Pedro Nopala', '2019-07-16 09:29:19', '20'),
(2209, '322', 'San Pedro Ocopetatillo', '0001', 'San Pedro Ocopetatillo', '2019-07-16 09:29:19', '20'),
(2210, '323', 'San Pedro Ocotepec', '0001', 'San Pedro Ocotepec', '2019-07-16 09:29:19', '20'),
(2211, '324', 'San Pedro Pochutla', '0001', 'San Pedro Pochutla', '2019-07-16 09:29:19', '20'),
(2212, '325', 'San Pedro Quiatoni', '0001', 'San Pedro Quiatoni', '2019-07-16 09:29:19', '20'),
(2213, '326', 'San Pedro Sochiápam', '0001', 'San Pedro Sochiápam', '2019-07-16 09:29:19', '20'),
(2214, '327', 'San Pedro Tapanatepec', '0001', 'San Pedro Tapanatepec', '2019-07-16 09:29:19', '20'),
(2215, '328', 'San Pedro Taviche', '0001', 'San Pedro Taviche', '2019-07-16 09:29:19', '20'),
(2216, '329', 'San Pedro Teozacoalco', '0001', 'San Pedro Teozacoalco', '2019-07-16 09:29:19', '20'),
(2217, '330', 'San Pedro Teutila', '0001', 'San Pedro Teutila', '2019-07-16 09:29:19', '20'),
(2218, '331', 'San Pedro Tidaá', '0001', 'San Pedro Tidaá', '2019-07-16 09:29:19', '20'),
(2219, '332', 'San Pedro Topiltepec', '0001', 'San Pedro Topiltepec', '2019-07-16 09:29:19', '20'),
(2220, '333', 'San Pedro Totolápam', '0001', 'San Pedro Totolápam', '2019-07-16 09:29:19', '20'),
(2221, '334', 'Villa de Tututepec de Melchor Ocampo', '0001', 'Villa de Tututepec de Melchor Ocampo', '2019-07-16 09:29:19', '20'),
(2222, '335', 'San Pedro Yaneri', '0001', 'San Pedro Yaneri', '2019-07-16 09:29:19', '20'),
(2223, '336', 'San Pedro Yólox', '0001', 'San Pedro Yólox', '2019-07-16 09:29:19', '20'),
(2224, '337', 'San Pedro y San Pablo Ayutla', '0001', 'San Pedro y San Pablo Ayutla', '2019-07-16 09:29:19', '20'),
(2225, '338', 'Villa de Etla', '0001', 'Villa de Etla', '2019-07-16 09:29:19', '20'),
(2226, '339', 'San Pedro y San Pablo Teposcolula', '0001', 'San Pedro y San Pablo Teposcolula', '2019-07-16 09:29:19', '20'),
(2227, '340', 'San Pedro y San Pablo Tequixtepec', '0001', 'San Pedro y San Pablo Tequixtepec', '2019-07-16 09:29:19', '20'),
(2228, '341', 'San Pedro Yucunama', '0001', 'San Pedro Yucunama', '2019-07-16 09:29:20', '20'),
(2229, '342', 'San Raymundo Jalpan', '0001', 'San Raymundo Jalpan', '2019-07-16 09:29:20', '20'),
(2230, '343', 'San Sebastián Abasolo', '0001', 'San Sebastián Abasolo', '2019-07-16 09:29:20', '20'),
(2231, '344', 'San Sebastián Coatlán', '0001', 'San Sebastián Coatlán', '2019-07-16 09:29:20', '20'),
(2232, '345', 'San Sebastián Ixcapa', '0001', 'San Sebastián Ixcapa', '2019-07-16 09:29:20', '20'),
(2233, '346', 'San Sebastián Nicananduta', '0001', 'San Sebastián Nicananduta', '2019-07-16 09:29:20', '20'),
(2234, '347', 'San Sebastián Río Hondo', '0001', 'San Sebastián Río Hondo', '2019-07-16 09:29:20', '20'),
(2235, '348', 'San Sebastián Tecomaxtlahuaca', '0001', 'San Sebastián Tecomaxtlahuaca', '2019-07-16 09:29:20', '20'),
(2236, '349', 'San Sebastián Teitipac', '0001', 'San Sebastián Teitipac', '2019-07-16 09:29:20', '20'),
(2237, '350', 'San Sebastián Tutla', '0001', 'San Sebastián Tutla', '2019-07-16 09:29:20', '20'),
(2238, '351', 'San Simón Almolongas', '0001', 'San Simón Almolongas', '2019-07-16 09:29:20', '20'),
(2239, '352', 'San Simón Zahuatlán', '0001', 'San Simón Zahuatlán', '2019-07-16 09:29:20', '20'),
(2240, '353', 'Santa Ana', '0001', 'Santa Ana', '2019-07-16 09:29:20', '20'),
(2241, '354', 'Santa Ana Ateixtlahuaca', '0001', 'Santa Ana Ateixtlahuaca', '2019-07-16 09:29:20', '20'),
(2242, '355', 'Santa Ana Cuauhtémoc', '0001', 'Santa Ana Cuauhtémoc', '2019-07-16 09:29:20', '20'),
(2243, '356', 'Santa Ana del Valle', '0001', 'Santa Ana del Valle', '2019-07-16 09:29:20', '20'),
(2244, '357', 'Santa Ana Tavela', '0001', 'Santa Ana Tavela', '2019-07-16 09:29:20', '20'),
(2245, '358', 'Santa Ana Tlapacoyan', '0001', 'Santa Ana Tlapacoyan', '2019-07-16 09:29:20', '20'),
(2246, '359', 'Santa Ana Yareni', '0001', 'Santa Ana Yareni', '2019-07-16 09:29:20', '20'),
(2247, '360', 'Santa Ana Zegache', '0001', 'Santa Ana Zegache', '2019-07-16 09:29:20', '20'),
(2248, '361', 'Santa Catalina Quierí', '0001', 'Santa Catalina Quierí', '2019-07-16 09:29:20', '20'),
(2249, '362', 'Santa Catarina Cuixtla', '0001', 'Santa Catarina Cuixtla', '2019-07-16 09:29:21', '20'),
(2250, '363', 'Santa Catarina Ixtepeji', '0001', 'Santa Catarina Ixtepeji', '2019-07-16 09:29:21', '20'),
(2251, '364', 'Santa Catarina Juquila', '0001', 'Santa Catarina Juquila', '2019-07-16 09:29:21', '20'),
(2252, '365', 'Santa Catarina Lachatao', '0001', 'Santa Catarina Lachatao', '2019-07-16 09:29:21', '20'),
(2253, '366', 'Santa Catarina Loxicha', '0001', 'Santa Catarina Loxicha', '2019-07-16 09:29:21', '20'),
(2254, '367', 'Santa Catarina Mechoacán', '0001', 'Santa Catarina Mechoacán', '2019-07-16 09:29:21', '20'),
(2255, '368', 'Santa Catarina Minas', '0001', 'Santa Catarina Minas', '2019-07-16 09:29:21', '20'),
(2256, '369', 'Santa Catarina Quiané', '0001', 'Santa Catarina Quiané', '2019-07-16 09:29:21', '20'),
(2257, '370', 'Santa Catarina Tayata', '0001', 'Santa Catarina Tayata', '2019-07-16 09:29:21', '20'),
(2258, '371', 'Santa Catarina Ticuá', '0001', 'Santa Catarina Ticuá', '2019-07-16 09:29:21', '20'),
(2259, '372', 'Santa Catarina Yosonotú', '0001', 'Santa Catarina Yosonotú', '2019-07-16 09:29:21', '20'),
(2260, '373', 'Santa Catarina Zapoquila', '0001', 'Santa Catarina Zapoquila', '2019-07-16 09:29:21', '20'),
(2261, '374', 'Santa Cruz Acatepec', '0001', 'Santa Cruz Acatepec', '2019-07-16 09:29:21', '20'),
(2262, '375', 'Santa Cruz Amilpas', '0001', 'Santa Cruz Amilpas', '2019-07-16 09:29:21', '20'),
(2263, '376', 'Santa Cruz de Bravo', '0001', 'Santa Cruz de Bravo', '2019-07-16 09:29:21', '20'),
(2264, '377', 'Santa Cruz Itundujia', '0001', 'Santa Cruz Itundujia', '2019-07-16 09:29:21', '20'),
(2265, '378', 'Santa Cruz Mixtepec', '0001', 'Santa Cruz Mixtepec', '2019-07-16 09:29:21', '20'),
(2266, '379', 'Santa Cruz Nundaco', '0001', 'Santa Cruz Nundaco', '2019-07-16 09:29:21', '20'),
(2267, '380', 'Santa Cruz Papalutla', '0001', 'Santa Cruz Papalutla', '2019-07-16 09:29:21', '20'),
(2268, '381', 'Santa Cruz Tacache de Mina', '0001', 'Santa Cruz Tacache de Mina', '2019-07-16 09:29:21', '20'),
(2269, '382', 'Santa Cruz Tacahua', '0001', 'Santa Cruz Tacahua', '2019-07-16 09:29:21', '20'),
(2270, '383', 'Santa Cruz Tayata', '0001', 'Santa Cruz Tayata', '2019-07-16 09:29:21', '20'),
(2271, '384', 'Santa Cruz Xitla', '0001', 'Santa Cruz Xitla', '2019-07-16 09:29:21', '20'),
(2272, '385', 'Santa Cruz Xoxocotlán', '0001', 'Santa Cruz Xoxocotlán', '2019-07-16 09:29:21', '20'),
(2273, '386', 'Santa Cruz Zenzontepec', '0001', 'Santa Cruz Zenzontepec', '2019-07-16 09:29:21', '20'),
(2274, '387', 'Santa Gertrudis', '0001', 'Santa Gertrudis', '2019-07-16 09:29:22', '20'),
(2275, '388', 'Santa Inés del Monte', '0001', 'Santa Inés del Monte', '2019-07-16 09:29:22', '20'),
(2276, '389', 'Santa Inés Yatzeche', '0001', 'Santa Inés Yatzeche', '2019-07-16 09:29:22', '20'),
(2277, '390', 'Santa Lucía del Camino', '0001', 'Santa Lucía del Camino', '2019-07-16 09:29:22', '20'),
(2278, '391', 'Santa Lucía Miahuatlán', '0001', 'Santa Lucía Miahuatlán', '2019-07-16 09:29:22', '20'),
(2279, '392', 'Santa Lucía Monteverde', '0001', 'Santa Lucía Monteverde', '2019-07-16 09:29:22', '20'),
(2280, '393', 'Santa Lucía Ocotlán', '0001', 'Santa Lucía Ocotlán', '2019-07-16 09:29:22', '20'),
(2281, '394', 'Santa María Alotepec', '0001', 'Santa María Alotepec', '2019-07-16 09:29:22', '20'),
(2282, '395', 'Santa María Apazco', '0001', 'Santa María Apazco', '2019-07-16 09:29:22', '20'),
(2283, '396', 'Santa María la Asunción', '0001', 'Santa María la Asunción', '2019-07-16 09:29:22', '20'),
(2284, '397', 'Heroica Ciudad de Tlaxiaco', '0001', 'Heroica Ciudad de Tlaxiaco', '2019-07-16 09:29:22', '20'),
(2285, '398', 'Ayoquezco de Aldama', '0001', 'Ayoquezco de Aldama', '2019-07-16 09:29:22', '20'),
(2286, '399', 'Santa María Atzompa', '0001', 'Santa María Atzompa', '2019-07-16 09:29:22', '20'),
(2287, '400', 'Santa María Camotlán', '0001', 'Santa María Camotlán', '2019-07-16 09:29:22', '20'),
(2288, '401', 'Santa María Colotepec', '0001', 'Santa María Colotepec', '2019-07-16 09:29:22', '20'),
(2289, '402', 'Santa María Cortijo', '0001', 'Santa María Cortijo', '2019-07-16 09:29:22', '20'),
(2290, '403', 'Santa María Coyotepec', '0001', 'Santa María Coyotepec', '2019-07-16 09:29:22', '20'),
(2291, '404', 'Santa María Chachoápam', '0001', 'Santa María Chachoápam', '2019-07-16 09:29:22', '20'),
(2292, '405', 'Villa de Chilapa de Díaz', '0001', 'Villa de Chilapa de Díaz', '2019-07-16 09:29:22', '20'),
(2293, '406', 'Santa María Chilchotla', '0001', 'Santa María Chilchotla', '2019-07-16 09:29:22', '20'),
(2294, '407', 'Santa María Chimalapa', '0001', 'Santa María Chimalapa', '2019-07-16 09:29:22', '20'),
(2295, '408', 'Santa María del Rosario', '0001', 'Santa María del Rosario', '2019-07-16 09:29:22', '20'),
(2296, '409', 'Santa María del Tule', '0001', 'Santa María del Tule', '2019-07-16 09:29:22', '20'),
(2297, '410', 'Santa María Ecatepec', '0001', 'Santa María Ecatepec', '2019-07-16 09:29:22', '20'),
(2298, '411', 'Santa María Guelacé', '0001', 'Santa María Guelacé', '2019-07-16 09:29:23', '20'),
(2299, '412', 'Santa María Guienagati', '0001', 'Santa María Guienagati', '2019-07-16 09:29:23', '20'),
(2300, '413', 'Santa María Huatulco', '0001', 'Santa María Huatulco', '2019-07-16 09:29:23', '20'),
(2301, '414', 'Santa María Huazolotitlán', '0001', 'Santa María Huazolotitlán', '2019-07-16 09:29:23', '20'),
(2302, '415', 'Santa María Ipalapa', '0001', 'Santa María Ipalapa', '2019-07-16 09:29:23', '20'),
(2303, '416', 'Santa María Ixcatlán', '0001', 'Santa María Ixcatlán', '2019-07-16 09:29:23', '20'),
(2304, '417', 'Santa María Jacatepec', '0001', 'Santa María Jacatepec', '2019-07-16 09:29:23', '20'),
(2305, '418', 'Santa María Jalapa del Marqués', '0001', 'Santa María Jalapa del Marqués', '2019-07-16 09:29:23', '20'),
(2306, '419', 'Santa María Jaltianguis', '0001', 'Santa María Jaltianguis', '2019-07-16 09:29:24', '20'),
(2307, '420', 'Santa María Lachixío', '0001', 'Santa María Lachixío', '2019-07-16 09:29:24', '20'),
(2308, '421', 'Santa María Mixtequilla', '0001', 'Santa María Mixtequilla', '2019-07-16 09:29:24', '20'),
(2309, '422', 'Santa María Nativitas', '0001', 'Santa María Nativitas', '2019-07-16 09:29:24', '20'),
(2310, '423', 'Santa María Nduayaco', '0001', 'Santa María Nduayaco', '2019-07-16 09:29:24', '20'),
(2311, '424', 'Santa María Ozolotepec', '0001', 'Santa María Ozolotepec', '2019-07-16 09:29:24', '20'),
(2312, '425', 'Santa María Pápalo', '0001', 'Santa María Pápalo', '2019-07-16 09:29:24', '20'),
(2313, '426', 'Santa María Peñoles', '0001', 'Santa María Peñoles', '2019-07-16 09:29:24', '20'),
(2314, '427', 'Santa María Petapa', '0001', 'Santa María Petapa', '2019-07-16 09:29:24', '20'),
(2315, '428', 'Santa María Quiegolani', '0001', 'Santa María Quiegolani', '2019-07-16 09:29:24', '20'),
(2316, '429', 'Santa María Sola', '0001', 'Santa María Sola', '2019-07-16 09:29:24', '20'),
(2317, '430', 'Santa María Tataltepec', '0001', 'Santa María Tataltepec', '2019-07-16 09:29:24', '20'),
(2318, '431', 'Santa María Tecomavaca', '0001', 'Santa María Tecomavaca', '2019-07-16 09:29:24', '20'),
(2319, '432', 'Santa María Temaxcalapa', '0001', 'Santa María Temaxcalapa', '2019-07-16 09:29:24', '20'),
(2320, '433', 'Santa María Temaxcaltepec', '0001', 'Santa María Temaxcaltepec', '2019-07-16 09:29:24', '20'),
(2321, '434', 'Santa María Teopoxco', '0001', 'Santa María Teopoxco', '2019-07-16 09:29:24', '20'),
(2322, '435', 'Santa María Tepantlali', '0001', 'Santa María Tepantlali', '2019-07-16 09:29:24', '20'),
(2323, '436', 'Santa María Texcatitlán', '0001', 'Santa María Texcatitlán', '2019-07-16 09:29:24', '20'),
(2324, '437', 'Santa María Tlahuitoltepec', '0001', 'Santa María Tlahuitoltepec', '2019-07-16 09:29:24', '20'),
(2325, '438', 'Santa María Tlalixtac', '0001', 'Santa María Tlalixtac', '2019-07-16 09:29:24', '20'),
(2326, '439', 'Santa María Tonameca', '0001', 'Santa María Tonameca', '2019-07-16 09:29:24', '20'),
(2327, '440', 'Santa María Totolapilla', '0001', 'Santa María Totolapilla', '2019-07-16 09:29:24', '20'),
(2328, '441', 'Santa María Xadani', '0001', 'Santa María Xadani', '2019-07-16 09:29:25', '20'),
(2329, '442', 'Santa María Yalina', '0001', 'Santa María Yalina', '2019-07-16 09:29:25', '20'),
(2330, '443', 'Santa María Yavesía', '0001', 'Santa María Yavesía', '2019-07-16 09:29:25', '20'),
(2331, '444', 'Santa María Yolotepec', '0001', 'Santa María Yolotepec', '2019-07-16 09:29:25', '20'),
(2332, '445', 'Santa María Yosoyúa', '0001', 'Santa María Yosoyúa', '2019-07-16 09:29:25', '20'),
(2333, '446', 'Santa María Yucuhiti', '0001', 'Santa María Yucuhiti', '2019-07-16 09:29:25', '20'),
(2334, '447', 'Santa María Zacatepec', '0001', 'Santa María Zacatepec', '2019-07-16 09:29:25', '20'),
(2335, '448', 'Santa María Zaniza', '0001', 'Santa María Zaniza', '2019-07-16 09:29:25', '20'),
(2336, '449', 'Santa María Zoquitlán', '0001', 'Santa María Zoquitlán', '2019-07-16 09:29:25', '20'),
(2337, '450', 'Santiago Amoltepec', '0001', 'Santiago Amoltepec', '2019-07-16 09:29:25', '20'),
(2338, '451', 'Santiago Apoala', '0001', 'Santiago Apoala', '2019-07-16 09:29:25', '20'),
(2339, '452', 'Santiago Apóstol', '0001', 'Santiago Apóstol', '2019-07-16 09:29:25', '20'),
(2340, '453', 'Santiago Astata', '0001', 'Santiago Astata', '2019-07-16 09:29:25', '20'),
(2341, '454', 'Santiago Atitlán', '0001', 'Santiago Atitlán', '2019-07-16 09:29:25', '20'),
(2342, '455', 'Santiago Ayuquililla', '0001', 'Santiago Ayuquililla', '2019-07-16 09:29:25', '20'),
(2343, '456', 'Santiago Cacaloxtepec', '0001', 'Santiago Cacaloxtepec', '2019-07-16 09:29:25', '20'),
(2344, '457', 'Santiago Camotlán', '0001', 'Santiago Camotlán', '2019-07-16 09:29:25', '20'),
(2345, '458', 'Santiago Comaltepec', '0001', 'Santiago Comaltepec', '2019-07-16 09:29:25', '20'),
(2346, '459', 'Santiago Chazumba', '0001', 'Santiago Chazumba', '2019-07-16 09:29:25', '20'),
(2347, '460', 'Santiago Choápam', '0001', 'Santiago Choápam', '2019-07-16 09:29:25', '20'),
(2348, '461', 'Santiago del Río', '0001', 'Santiago del Río', '2019-07-16 09:29:25', '20'),
(2349, '462', 'Santiago Huajolotitlán', '0001', 'Santiago Huajolotitlán', '2019-07-16 09:29:25', '20'),
(2350, '463', 'Santiago Huauclilla', '0001', 'Santiago Huauclilla', '2019-07-16 09:29:25', '20'),
(2351, '464', 'Santiago Ihuitlán Plumas', '0001', 'Santiago Ihuitlán Plumas', '2019-07-16 09:29:25', '20'),
(2352, '465', 'Santiago Ixcuintepec', '0001', 'Santiago Ixcuintepec', '2019-07-16 09:29:26', '20');
INSERT INTO `municipio` (`idm`, `cve_mun`, `nom_mun`, `cve_cab`, `nom_cab`, `fechaModificacion`, `cve_ent`) VALUES
(2353, '466', 'Santiago Ixtayutla', '0001', 'Santiago Ixtayutla', '2019-07-16 09:29:26', '20'),
(2354, '467', 'Santiago Jamiltepec', '0001', 'Santiago Jamiltepec', '2019-07-16 09:29:26', '20'),
(2355, '468', 'Santiago Jocotepec', '0019', 'Monte Negro', '2019-07-16 09:29:26', '20'),
(2356, '469', 'Santiago Juxtlahuaca', '0001', 'Santiago Juxtlahuaca', '2019-07-16 09:29:26', '20'),
(2357, '470', 'Santiago Lachiguiri', '0001', 'Santiago Lachiguiri', '2019-07-16 09:29:26', '20'),
(2358, '471', 'Santiago Lalopa', '0001', 'Santiago Lalopa', '2019-07-16 09:29:26', '20'),
(2359, '472', 'Santiago Laollaga', '0001', 'Santiago Laollaga', '2019-07-16 09:29:26', '20'),
(2360, '473', 'Santiago Laxopa', '0001', 'Santiago Laxopa', '2019-07-16 09:29:26', '20'),
(2361, '474', 'Santiago Llano Grande', '0001', 'Santiago Llano Grande', '2019-07-16 09:29:26', '20'),
(2362, '475', 'Santiago Matatlán', '0001', 'Santiago Matatlán', '2019-07-16 09:29:26', '20'),
(2363, '476', 'Santiago Miltepec', '0001', 'Santiago Miltepec', '2019-07-16 09:29:26', '20'),
(2364, '477', 'Santiago Minas', '0001', 'Santiago Minas', '2019-07-16 09:29:26', '20'),
(2365, '478', 'Santiago Nacaltepec', '0001', 'Santiago Nacaltepec', '2019-07-16 09:29:26', '20'),
(2366, '479', 'Santiago Nejapilla', '0001', 'Santiago Nejapilla', '2019-07-16 09:29:26', '20'),
(2367, '480', 'Santiago Nundiche', '0001', 'Santiago Nundiche', '2019-07-16 09:29:26', '20'),
(2368, '481', 'Santiago Nuyoó', '0001', 'Santiago Nuyoó', '2019-07-16 09:29:26', '20'),
(2369, '482', 'Santiago Pinotepa Nacional', '0001', 'Santiago Pinotepa Nacional', '2019-07-16 09:29:26', '20'),
(2370, '483', 'Santiago Suchilquitongo', '0001', 'Santiago Suchilquitongo', '2019-07-16 09:29:26', '20'),
(2371, '484', 'Santiago Tamazola', '0001', 'Santiago Tamazola', '2019-07-16 09:29:26', '20'),
(2372, '485', 'Santiago Tapextla', '0001', 'Santiago Tapextla', '2019-07-16 09:29:26', '20'),
(2373, '486', 'Villa Tejúpam de la Unión', '0001', 'Villa Tejúpam de la Unión', '2019-07-16 09:29:26', '20'),
(2374, '487', 'Santiago Tenango', '0001', 'Santiago Tenango', '2019-07-16 09:29:26', '20'),
(2375, '488', 'Santiago Tepetlapa', '0001', 'Santiago Tepetlapa', '2019-07-16 09:29:26', '20'),
(2376, '489', 'Santiago Tetepec', '0001', 'Santiago Tetepec', '2019-07-16 09:29:26', '20'),
(2377, '490', 'Santiago Texcalcingo', '0001', 'Santiago Texcalcingo', '2019-07-16 09:29:26', '20'),
(2378, '491', 'Santiago Textitlán', '0001', 'Santiago Textitlán', '2019-07-16 09:29:26', '20'),
(2379, '492', 'Santiago Tilantongo', '0001', 'Santiago Tilantongo', '2019-07-16 09:29:27', '20'),
(2380, '493', 'Santiago Tillo', '0001', 'Santiago Tillo', '2019-07-16 09:29:27', '20'),
(2381, '494', 'Santiago Tlazoyaltepec', '0001', 'Santiago Tlazoyaltepec', '2019-07-16 09:29:27', '20'),
(2382, '495', 'Santiago Xanica', '0001', 'Santiago Xanica', '2019-07-16 09:29:27', '20'),
(2383, '496', 'Santiago Xiacuí', '0001', 'Santiago Xiacuí', '2019-07-16 09:29:27', '20'),
(2384, '497', 'Santiago Yaitepec', '0001', 'Santiago Yaitepec', '2019-07-16 09:29:27', '20'),
(2385, '498', 'Santiago Yaveo', '0001', 'Santiago Yaveo', '2019-07-16 09:29:27', '20'),
(2386, '499', 'Santiago Yolomécatl', '0001', 'Santiago Yolomécatl', '2019-07-16 09:29:27', '20'),
(2387, '500', 'Santiago Yosondúa', '0001', 'Santiago Yosondúa', '2019-07-16 09:29:27', '20'),
(2388, '501', 'Santiago Yucuyachi', '0001', 'Santiago Yucuyachi', '2019-07-16 09:29:27', '20'),
(2389, '502', 'Santiago Zacatepec', '0001', 'Santiago Zacatepec', '2019-07-16 09:29:27', '20'),
(2390, '503', 'Santiago Zoochila', '0001', 'Santiago Zoochila', '2019-07-16 09:29:27', '20'),
(2391, '504', 'Nuevo Zoquiápam', '0001', 'Nuevo Zoquiápam', '2019-07-16 09:29:27', '20'),
(2392, '505', 'Santo Domingo Ingenio', '0001', 'Santo Domingo Ingenio', '2019-07-16 09:29:27', '20'),
(2393, '506', 'Santo Domingo Albarradas', '0001', 'Santo Domingo Albarradas', '2019-07-16 09:29:27', '20'),
(2394, '507', 'Santo Domingo Armenta', '0001', 'Santo Domingo Armenta', '2019-07-16 09:29:27', '20'),
(2395, '508', 'Santo Domingo Chihuitán', '0001', 'Santo Domingo Chihuitán', '2019-07-16 09:29:27', '20'),
(2396, '509', 'Santo Domingo de Morelos', '0001', 'Santo Domingo de Morelos', '2019-07-16 09:29:27', '20'),
(2397, '510', 'Santo Domingo Ixcatlán', '0001', 'Santo Domingo Ixcatlán', '2019-07-16 09:29:27', '20'),
(2398, '511', 'Santo Domingo Nuxaá', '0001', 'Santo Domingo Nuxaá', '2019-07-16 09:29:27', '20'),
(2399, '512', 'Santo Domingo Ozolotepec', '0001', 'Santo Domingo Ozolotepec', '2019-07-16 09:29:27', '20'),
(2400, '513', 'Santo Domingo Petapa', '0001', 'Santo Domingo Petapa', '2019-07-16 09:29:27', '20'),
(2401, '514', 'Santo Domingo Roayaga', '0001', 'Santo Domingo Roayaga', '2019-07-16 09:29:27', '20'),
(2402, '515', 'Santo Domingo Tehuantepec', '0001', 'Santo Domingo Tehuantepec', '2019-07-16 09:29:27', '20'),
(2403, '516', 'Santo Domingo Teojomulco', '0001', 'Santo Domingo Teojomulco', '2019-07-16 09:29:27', '20'),
(2404, '517', 'Santo Domingo Tepuxtepec', '0001', 'Santo Domingo Tepuxtepec', '2019-07-16 09:29:28', '20'),
(2405, '518', 'Santo Domingo Tlatayápam', '0001', 'Santo Domingo Tlatayápam', '2019-07-16 09:29:28', '20'),
(2406, '519', 'Santo Domingo Tomaltepec', '0001', 'Santo Domingo Tomaltepec', '2019-07-16 09:29:28', '20'),
(2407, '520', 'Santo Domingo Tonalá', '0001', 'Santo Domingo Tonalá', '2019-07-16 09:29:28', '20'),
(2408, '521', 'Santo Domingo Tonaltepec', '0001', 'Santo Domingo Tonaltepec', '2019-07-16 09:29:28', '20'),
(2409, '522', 'Santo Domingo Xagacía', '0001', 'Santo Domingo Xagacía', '2019-07-16 09:29:28', '20'),
(2410, '523', 'Santo Domingo Yanhuitlán', '0001', 'Santo Domingo Yanhuitlán', '2019-07-16 09:29:28', '20'),
(2411, '524', 'Santo Domingo Yodohino', '0001', 'Santo Domingo Yodohino', '2019-07-16 09:29:28', '20'),
(2412, '525', 'Santo Domingo Zanatepec', '0001', 'Santo Domingo Zanatepec', '2019-07-16 09:29:28', '20'),
(2413, '526', 'Santos Reyes Nopala', '0001', 'Santos Reyes Nopala', '2019-07-16 09:29:28', '20'),
(2414, '527', 'Santos Reyes Pápalo', '0001', 'Santos Reyes Pápalo', '2019-07-16 09:29:28', '20'),
(2415, '528', 'Santos Reyes Tepejillo', '0001', 'Santos Reyes Tepejillo', '2019-07-16 09:29:28', '20'),
(2416, '529', 'Santos Reyes Yucuná', '0001', 'Santos Reyes Yucuná', '2019-07-16 09:29:28', '20'),
(2417, '530', 'Santo Tomás Jalieza', '0001', 'Santo Tomás Jalieza', '2019-07-16 09:29:28', '20'),
(2418, '531', 'Santo Tomás Mazaltepec', '0001', 'Santo Tomás Mazaltepec', '2019-07-16 09:29:28', '20'),
(2419, '532', 'Santo Tomás Ocotepec', '0001', 'Santo Tomás Ocotepec', '2019-07-16 09:29:28', '20'),
(2420, '533', 'Santo Tomás Tamazulapan', '0001', 'Santo Tomás Tamazulapan', '2019-07-16 09:29:28', '20'),
(2421, '534', 'San Vicente Coatlán', '0001', 'San Vicente Coatlán', '2019-07-16 09:29:28', '20'),
(2422, '535', 'San Vicente Lachixío', '0001', 'San Vicente Lachixío', '2019-07-16 09:29:28', '20'),
(2423, '536', 'San Vicente Nuñú', '0001', 'San Vicente Nuñú', '2019-07-16 09:29:28', '20'),
(2424, '537', 'Silacayoápam', '0001', 'Silacayoápam', '2019-07-16 09:29:28', '20'),
(2425, '538', 'Sitio de Xitlapehua', '0001', 'Sitio de Xitlapehua', '2019-07-16 09:29:28', '20'),
(2426, '539', 'Soledad Etla', '0001', 'Soledad Etla', '2019-07-16 09:29:28', '20'),
(2427, '540', 'Villa de Tamazulápam del Progreso', '0001', 'Villa de Tamazulápam del Progreso', '2019-07-16 09:29:29', '20'),
(2428, '541', 'Tanetze de Zaragoza', '0001', 'Tanetze de Zaragoza', '2019-07-16 09:29:29', '20'),
(2429, '542', 'Taniche', '0001', 'Taniche', '2019-07-16 09:29:29', '20'),
(2430, '543', 'Tataltepec de Valdés', '0001', 'Tataltepec de Valdés', '2019-07-16 09:29:29', '20'),
(2431, '544', 'Teococuilco de Marcos Pérez', '0001', 'Teococuilco de Marcos Pérez', '2019-07-16 09:29:29', '20'),
(2432, '545', 'Teotitlán de Flores Magón', '0001', 'Teotitlán de Flores Magón', '2019-07-16 09:29:29', '20'),
(2433, '546', 'Teotitlán del Valle', '0001', 'Teotitlán del Valle', '2019-07-16 09:29:29', '20'),
(2434, '547', 'Teotongo', '0001', 'Teotongo', '2019-07-16 09:29:29', '20'),
(2435, '548', 'Tepelmeme Villa de Morelos', '0001', 'Tepelmeme Villa de Morelos', '2019-07-16 09:29:29', '20'),
(2436, '549', 'Heroica Villa Tezoatlán de Segura y Luna, Cuna de ', '0001', 'Heroica Villa Tezoatlán de Segura y Luna, Cuna de ', '2019-07-16 09:29:29', '20'),
(2437, '550', 'San Jerónimo Tlacochahuaya', '0001', 'San Jerónimo Tlacochahuaya', '2019-07-16 09:29:29', '20'),
(2438, '551', 'Tlacolula de Matamoros', '0001', 'Tlacolula de Matamoros', '2019-07-16 09:29:29', '20'),
(2439, '552', 'Tlacotepec Plumas', '0001', 'Tlacotepec Plumas', '2019-07-16 09:29:29', '20'),
(2440, '553', 'Tlalixtac de Cabrera', '0001', 'Tlalixtac de Cabrera', '2019-07-16 09:29:29', '20'),
(2441, '554', 'Totontepec Villa de Morelos', '0001', 'Totontepec Villa de Morelos', '2019-07-16 09:29:29', '20'),
(2442, '555', 'Trinidad Zaachila', '0001', 'Trinidad Zaachila', '2019-07-16 09:29:29', '20'),
(2443, '556', 'La Trinidad Vista Hermosa', '0001', 'La Trinidad Vista Hermosa', '2019-07-16 09:29:29', '20'),
(2444, '557', 'Unión Hidalgo', '0001', 'Unión Hidalgo', '2019-07-16 09:29:29', '20'),
(2445, '558', 'Valerio Trujano', '0001', 'Valerio Trujano', '2019-07-16 09:29:29', '20'),
(2446, '559', 'San Juan Bautista Valle Nacional', '0001', 'San Juan Bautista Valle Nacional', '2019-07-16 09:29:29', '20'),
(2447, '560', 'Villa Díaz Ordaz', '0001', 'Villa Díaz Ordaz', '2019-07-16 09:29:29', '20'),
(2448, '561', 'Yaxe', '0001', 'Yaxe', '2019-07-16 09:29:29', '20'),
(2449, '562', 'Magdalena Yodocono de Porfirio Díaz', '0001', 'Magdalena Yodocono de Porfirio Díaz', '2019-07-16 09:29:29', '20'),
(2450, '563', 'Yogana', '0001', 'Yogana', '2019-07-16 09:29:29', '20'),
(2451, '564', 'Yutanduchi de Guerrero', '0001', 'Yutanduchi de Guerrero', '2019-07-16 09:29:30', '20'),
(2452, '565', 'Villa de Zaachila', '0001', 'Villa de Zaachila', '2019-07-16 09:29:30', '20'),
(2453, '566', 'San Mateo Yucutindoo', '0009', 'San Mateo Yucutindoo', '2019-07-16 09:29:30', '20'),
(2454, '567', 'Zapotitlán Lagunas', '0001', 'Zapotitlán Lagunas', '2019-07-16 09:29:30', '20'),
(2455, '568', 'Zapotitlán Palmas', '0001', 'Zapotitlán Palmas', '2019-07-16 09:29:30', '20'),
(2456, '569', 'Santa Inés de Zaragoza', '0001', 'Santa Inés de Zaragoza', '2019-07-16 09:29:30', '20'),
(2457, '570', 'Zimatlán de Álvarez', '0001', 'Zimatlán de Álvarez', '2019-07-16 09:29:30', '20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nominasucursal`
--

CREATE TABLE `nominasucursal` (
  `idNominaSucursal` int(11) NOT NULL,
  `idSucursal` int(11) DEFAULT NULL,
  `NoSemana` int(11) DEFAULT NULL,
  `FechaInicio` date DEFAULT NULL,
  `FechaTermino` date DEFAULT NULL,
  `TotalSeptimoDia` decimal(12,2) DEFAULT NULL,
  `TotalSueldoBase` decimal(12,2) DEFAULT NULL,
  `TotalSueldo` decimal(12,2) DEFAULT NULL,
  `TotalExtras` decimal(12,2) DEFAULT NULL,
  `TotalInfonavit` decimal(12,2) DEFAULT NULL,
  `TotalPrestamos` decimal(12,2) DEFAULT NULL,
  `TotalSaldoAnterior` decimal(12,2) DEFAULT NULL,
  `TotalAbono` decimal(12,2) DEFAULT NULL,
  `TotalSueldoActual` decimal(12,2) DEFAULT NULL,
  `TotalSueldoNeto` decimal(12,2) DEFAULT NULL,
  `idEmpleadoCaptura` int(11) DEFAULT NULL,
  `FechaCaptura` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_rentas`
--

CREATE TABLE `orden_rentas` (
  `IdOrden` int(11) NOT NULL,
  `clave_unica` varchar(25) NOT NULL,
  `Folio_cotizacion` varchar(50) DEFAULT NULL,
  `Folio_orden` varchar(50) DEFAULT NULL,
  `Folio_factura` varchar(50) DEFAULT NULL,
  `id_situacion_ubicacion` int(11) DEFAULT NULL,
  `id_situacion_monetaria` int(11) DEFAULT NULL,
  `IdCliente` int(11) DEFAULT NULL,
  `IdCiudad` int(11) DEFAULT NULL,
  `CodigoPostalEntrega` int(11) NOT NULL,
  `ColoniaEntrega` varchar(50) NOT NULL,
  `CalleEntrega` varchar(50) NOT NULL,
  `NombrePersonaEntrega` varchar(50) NOT NULL,
  `TelefonoPersonaEntrega` varchar(50) NOT NULL,
  `CorreoPersonaEntrega` varchar(50) NOT NULL,
  `RequiereFactura` int(1) DEFAULT '0',
  `correo_enviado` int(1) DEFAULT '0',
  `es_orden` int(1) DEFAULT '0',
  `finalizado` int(1) DEFAULT '0',
  `FechaCaptura` date NOT NULL,
  `HoraCaptura` time NOT NULL,
  `FechaInicio` date NOT NULL,
  `FechaTermino` date NOT NULL,
  `FechaEntrega` date NOT NULL,
  `HoraEntrega` time NOT NULL,
  `FechaOrden` date DEFAULT NULL,
  `HoraOrden` time DEFAULT NULL,
  `FechaFinalizacion` date DEFAULT NULL,
  `HoraFinalizacion` time DEFAULT NULL,
  `IdSucursal` int(11) NOT NULL,
  `IdEmpleado_cotizacion` int(11) NOT NULL,
  `IdEmpleado_orden` int(11) DEFAULT NULL,
  `IdEmpleado_finalizacion` int(11) DEFAULT NULL,
  `eliminado` int(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_servicios`
--

CREATE TABLE `orden_servicios` (
  `IdOrden` int(11) NOT NULL,
  `clave_unica` varchar(25) NOT NULL,
  `Folio_cotizacion` varchar(50) DEFAULT NULL,
  `Folio_orden` varchar(50) DEFAULT NULL,
  `Folio_factura` varchar(50) DEFAULT NULL,
  `id_situacion_ubicacion` int(11) DEFAULT NULL,
  `id_situacion_monetaria` int(11) DEFAULT NULL,
  `IdCliente` int(11) DEFAULT NULL,
  `IdCiudad` int(11) DEFAULT NULL,
  `CodigoPostalEntrega` int(11) NOT NULL,
  `ColoniaEntrega` varchar(50) NOT NULL,
  `CalleEntrega` varchar(50) NOT NULL,
  `NombrePersonaEntrega` varchar(50) NOT NULL,
  `TelefonoPersonaEntrega` varchar(50) NOT NULL,
  `CorreoPersonaEntrega` varchar(50) NOT NULL,
  `RequiereFactura` int(1) DEFAULT '0',
  `correo_enviado` int(1) DEFAULT '0',
  `es_orden` int(1) DEFAULT '0',
  `finalizado` int(1) DEFAULT '0',
  `FechaCaptura` date NOT NULL,
  `HoraCaptura` time NOT NULL,
  `FechaInicio` date NOT NULL,
  `FechaTermino` date NOT NULL,
  `FechaEntrega` date NOT NULL,
  `HoraEntrega` time NOT NULL,
  `FechaOrden` date DEFAULT NULL,
  `HoraOrden` time DEFAULT NULL,
  `FechaFinalizacion` date DEFAULT NULL,
  `HoraFinalizacion` time DEFAULT NULL,
  `IdSucursal` int(11) NOT NULL DEFAULT '0',
  `IdEmpleado_cotizacion` int(11) NOT NULL,
  `IdEmpleado_orden` int(11) DEFAULT NULL,
  `IdEmpleado_finalizacion` int(11) DEFAULT NULL,
  `eliminado` int(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prenominaextra`
--

CREATE TABLE `prenominaextra` (
  `idPrenominaExtra` int(11) NOT NULL,
  `idSucursal` int(11) DEFAULT NULL,
  `NoSemana` int(11) DEFAULT NULL,
  `FechaInicio` date DEFAULT NULL,
  `FechaTermino` date DEFAULT NULL,
  `ComentarioSucursal` varchar(255) DEFAULT NULL,
  `idSituacionPrenominaExtra` int(11) DEFAULT NULL,
  `idEmpleadoCaptura` int(11) DEFAULT NULL,
  `FechaCaptura` datetime DEFAULT NULL,
  `ComentarioMatriz` varchar(255) DEFAULT NULL,
  `Total` decimal(12,2) DEFAULT '0.00',
  `Eliminado` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

CREATE TABLE `rutas` (
  `IdRuta` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Empresas` varchar(100) DEFAULT NULL,
  `Comentarios` text,
  `IdSucursal` int(1) NOT NULL,
  `IdEmpleadoCaptura` int(11) NOT NULL,
  `FechaCaptura` datetime NOT NULL,
  `IdEmpleadoCierre` int(11) DEFAULT NULL,
  `FechaCierre` datetime DEFAULT NULL,
  `Status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rutas`
--

INSERT INTO `rutas` (`IdRuta`, `Nombre`, `Empresas`, `Comentarios`, `IdSucursal`, `IdEmpleadoCaptura`, `FechaCaptura`, `IdEmpleadoCierre`, `FechaCierre`, `Status`) VALUES
(1, 'Ruta Norte', 'Liverpool y chevrolet', 'Dar prioridad a estas empresas\r\n', 1, 1, '2020-02-21 12:35:00', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `situacion_empleado`
--

CREATE TABLE `situacion_empleado` (
  `IdSituacionEmpleado` int(11) NOT NULL,
  `DescSitEmpleado` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `situacion_empleado`
--

INSERT INTO `situacion_empleado` (`IdSituacionEmpleado`, `DescSitEmpleado`) VALUES
(1, 'ACTIVO'),
(2, 'BAJA'),
(3, 'ENFERMO'),
(4, 'PERMISO '),
(5, 'VACACIONES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `IdSucursal` int(11) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `NombreContacto` varchar(50) DEFAULT NULL,
  `CorreoContacto` varchar(50) DEFAULT NULL,
  `IdCiudad` int(11) DEFAULT NULL,
  `Direccion` varchar(50) DEFAULT NULL,
  `Telefono` varchar(10) DEFAULT NULL,
  `IdTipoSucursal` int(11) DEFAULT NULL,
  `LetraFolio` varchar(10) DEFAULT NULL,
  `TotalEnCaja` decimal(12,2) DEFAULT '0.00',
  `eliminado` int(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`IdSucursal`, `Nombre`, `NombreContacto`, `CorreoContacto`, `IdCiudad`, `Direccion`, `Telefono`, `IdTipoSucursal`, `LetraFolio`, `TotalEnCaja`, `eliminado`) VALUES
(1, 'VICTORIA', 'ADMINISTRADOR VICTORIA LOPEZ LUNA', 'CONTACTO-VICTORIA@SANITAM', 985, 'Lomas Del Real 351 87018 Lomas de Calamaco Ciudad ', '8341351784', 2, 'A', '0.00', 0),
(11, 'ORIZABA', 'Administrador Orizaba Castro Alejos', 'aso@gmail.com', 1797, 'Calla 23 Zona Centro ', '8351245854', 1, 'O', '0.00', 0),
(12, 'VALLES', 'Administrador Valles Garcia Luna', 'asva@gmail.com', 381, 'Francisco I Madero 458 zona oriente', '3659875245', 1, 'V', '0.00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal_servicio`
--

CREATE TABLE `sucursal_servicio` (
  `IdSucursalServicio` int(11) NOT NULL,
  `IdSucursal` int(11) DEFAULT NULL,
  `IdServicio` int(11) DEFAULT NULL,
  `IdTamano` int(11) NOT NULL,
  `precio` decimal(12,2) NOT NULL,
  `descripcion` text NOT NULL,
  `incluye` text NOT NULL,
  `ELIMINADO` int(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sucursal_servicio`
--

INSERT INTO `sucursal_servicio` (`IdSucursalServicio`, `IdSucursal`, `IdServicio`, `IdTamano`, `precio`, `descripcion`, `incluye`, `ELIMINADO`) VALUES
(1, 1, 3, 1, '1500.00', '*', 'utensilios de limpieza', 0),
(2, 11, 4, 3, '250.00', '*', 'Utensilios de limpieza \r\nsecado', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tamano_servicios`
--

CREATE TABLE `tamano_servicios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tamano_servicios`
--

INSERT INTO `tamano_servicios` (`id`, `nombre`) VALUES
(1, 'Chico'),
(2, 'Mediano'),
(3, 'Grande');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades_renta`
--

CREATE TABLE `unidades_renta` (
  `IdUnidadRenta` int(11) NOT NULL,
  `DesUnidad` varchar(50) DEFAULT NULL,
  `eliminado` int(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `unidades_renta`
--

INSERT INTO `unidades_renta` (`IdUnidadRenta`, `DesUnidad`, `eliminado`) VALUES
(1, 'SANITARIO PORTATIL STANDARD', 0),
(2, 'wc doble', 1),
(3, 'wc de lujo', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `IdUsuario` int(11) NOT NULL,
  `IdEmpleado` int(11) DEFAULT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `IdRol` int(11) DEFAULT NULL,
  `IdSucursal` int(11) NOT NULL,
  `estatus` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`IdUsuario`, `IdEmpleado`, `usuario`, `contrasena`, `IdRol`, `IdSucursal`, `estatus`) VALUES
(1, 1, 'admin', '202cb962ac59075b964b07152d234b70', 1, 1, 1),
(502, 21, 'aso', '202cb962ac59075b964b07152d234b70', 2, 11, 1),
(503, 23, 'asv', '202cb962ac59075b964b07152d234b70', 2, 1, 1),
(504, 22, 'asva', '202cb962ac59075b964b07152d234b70', 2, 12, 1),
(505, 25, 'aaso', '202cb962ac59075b964b07152d234b70', 3, 11, 1),
(506, 24, 'aasv', '202cb962ac59075b964b07152d234b70', 3, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_cotizaciones_cart_rentas`
--

CREATE TABLE `_cotizaciones_cart_rentas` (
  `id` int(11) NOT NULL,
  `IdInventarioUnidadesRenta` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(12,2) NOT NULL,
  `clave_unica` varchar(25) NOT NULL,
  `es_orden` int(1) DEFAULT NULL,
  `recuperado` int(1) DEFAULT '0',
  `recuperar_cantidad_SucOrigen` int(11) DEFAULT '0',
  `recuperar_restante_a_IdSucursal` int(11) DEFAULT NULL,
  `ComentariodeUnidadRecuperada` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_cotizaciones_cart_servicios`
--

CREATE TABLE `_cotizaciones_cart_servicios` (
  `id` int(11) NOT NULL,
  `IdSucursalServicio` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(12,2) NOT NULL,
  `clave_unica` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_obsoleto_c_ciudades`
--

CREATE TABLE `_obsoleto_c_ciudades` (
  `Id_ciudad` int(11) NOT NULL,
  `Ciudad` varchar(30) NOT NULL,
  `IdEstado` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `_obsoleto_c_ciudades`
--

INSERT INTO `_obsoleto_c_ciudades` (`Id_ciudad`, `Ciudad`, `IdEstado`) VALUES
(1, 'CD. VICTORIA', 1),
(2, 'TAMPICO', 1),
(3, 'VALLES', 2),
(4, 'SAN LUIS POTOSI', 2),
(5, 'CORDOBA', 3),
(6, 'ORIZABA', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_obsoleto_c_estados`
--

CREATE TABLE `_obsoleto_c_estados` (
  `IdEstado` int(11) NOT NULL,
  `Estado` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `_obsoleto_c_estados`
--

INSERT INTO `_obsoleto_c_estados` (`IdEstado`, `Estado`) VALUES
(1, 'TAMAULIPAS'),
(2, 'SAN LUIS POTOSI'),
(3, 'VERACRUZ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_obsoleto_detalle_orden_cierre`
--

CREATE TABLE `_obsoleto_detalle_orden_cierre` (
  `IdDetalleOrdenCierre` int(11) NOT NULL,
  `IdOrdenCierreRenta` int(11) DEFAULT NULL,
  `IdEmpleado` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_obsoleto_detalle_orden_rentas`
--

CREATE TABLE `_obsoleto_detalle_orden_rentas` (
  `IdDetalleOrdenRentas` int(11) NOT NULL,
  `IdOrdenRenta` int(11) DEFAULT NULL,
  `FolioCotizacion` varchar(200) NOT NULL,
  `FolioRenta` varchar(200) NOT NULL,
  `IdInventarioUnidadesRenta` int(11) DEFAULT NULL,
  `Incluye` varchar(255) NOT NULL,
  `Precio` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_obsoleto_detalle_orden_servicio`
--

CREATE TABLE `_obsoleto_detalle_orden_servicio` (
  `IdDetalleOrdenServicio` int(11) NOT NULL,
  `IdOrdenServicio` int(11) DEFAULT NULL,
  `IdServicio` int(11) DEFAULT NULL,
  `Precio` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_obsoleto_empleados_orden_salida_renta`
--

CREATE TABLE `_obsoleto_empleados_orden_salida_renta` (
  `IdEmpleadosOrdenSalida` int(11) NOT NULL,
  `IdOrdenSalidaRenta` int(11) DEFAULT NULL,
  `IdEmpleado` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_obsoleto_orden_cierre_renta`
--

CREATE TABLE `_obsoleto_orden_cierre_renta` (
  `IdOrdenCierreRenta` int(11) NOT NULL,
  `IdOrdenRenta` int(11) DEFAULT NULL,
  `Fecha` date NOT NULL,
  `Hora` datetime NOT NULL,
  `IdEmpleadoCaptura` int(11) DEFAULT NULL,
  `IdSucursalEntrega` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_obsoleto_orden_salida_renta`
--

CREATE TABLE `_obsoleto_orden_salida_renta` (
  `IdOrdenSalidaRenta` int(11) NOT NULL,
  `IdOrdenRenta` int(11) DEFAULT NULL,
  `Fecha` date NOT NULL,
  `Hora` datetime NOT NULL,
  `IdEmpleado` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_obsoleto_reportes_servicios`
--

CREATE TABLE `_obsoleto_reportes_servicios` (
  `IdReporteServicio` int(11) NOT NULL,
  `IdSucursalServicio` int(11) DEFAULT NULL,
  `Folio` int(11) DEFAULT NULL,
  `Documento` varchar(50) DEFAULT NULL,
  `Fecha_Creacion` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `_pending_mail_queue`
--

CREATE TABLE `_pending_mail_queue` (
  `id` int(255) NOT NULL,
  `for_operation` varchar(50) NOT NULL,
  `uk` varchar(50) NOT NULL,
  `folio` varchar(50) NOT NULL,
  `from_email` varchar(300) NOT NULL,
  `from_fullname` varchar(300) NOT NULL,
  `to_email` varchar(300) NOT NULL,
  `to_fullname` varchar(300) NOT NULL,
  `subject` varchar(300) NOT NULL,
  `msg` text NOT NULL,
  `attachment_path` varchar(500) NOT NULL,
  `date_requested` datetime NOT NULL,
  `sent` int(1) NOT NULL,
  `error` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `__obsoleto_c_materiales_renta`
--

CREATE TABLE `__obsoleto_c_materiales_renta` (
  `IdMaterialesRentas` int(11) NOT NULL,
  `NomMaterial` varchar(40) NOT NULL,
  `PrecioMaterial` int(11) NOT NULL,
  `UnidadMaterial` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `__obsoleto_c_materiales_servicios`
--

CREATE TABLE `__obsoleto_c_materiales_servicios` (
  `IdMaterialesServicio` int(11) NOT NULL,
  `NomMaterial` varchar(50) NOT NULL,
  `PrecioMaterial` double NOT NULL,
  `UnidadMaterial` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `__obsoleto_c_materiales_servicios`
--

INSERT INTO `__obsoleto_c_materiales_servicios` (`IdMaterialesServicio`, `NomMaterial`, `PrecioMaterial`, `UnidadMaterial`) VALUES
(1, 'EQUIPO DE ALTA PRESION', 200, 'EQUIPO'),
(2, 'SONDEO', 200, 'SERVICIO'),
(3, 'TRASLADO DEL RESIDUO A PUNTO DE DESCARGUE', 200, 'TRASLADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `__obsoleto_detallenominasucursal`
--

CREATE TABLE `__obsoleto_detallenominasucursal` (
  `idDetalleNominaSucursal` int(11) NOT NULL,
  `idNominaSucursal` int(11) DEFAULT NULL,
  `idEmpleado` int(11) DEFAULT NULL,
  `idCategoriaEmpleado` int(11) DEFAULT NULL,
  `NoDiasTrabajados` int(11) DEFAULT NULL,
  `SeptimoDia` decimal(12,2) DEFAULT NULL,
  `SueldoBase` decimal(12,2) DEFAULT NULL,
  `Sueldo` decimal(12,2) DEFAULT NULL,
  `TotalExtras` decimal(12,2) DEFAULT NULL,
  `Infonavit` decimal(12,2) DEFAULT NULL,
  `Prestamo` decimal(12,2) DEFAULT NULL,
  `SaldoAnterior` decimal(12,2) DEFAULT NULL,
  `Abono` decimal(12,2) DEFAULT NULL,
  `SueldoActual` decimal(12,2) DEFAULT NULL,
  `SueldoNeto` decimal(12,2) DEFAULT NULL,
  `Comentarios` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `__obsoleto_detallenominasucursal`
--

INSERT INTO `__obsoleto_detallenominasucursal` (`idDetalleNominaSucursal`, `idNominaSucursal`, `idEmpleado`, `idCategoriaEmpleado`, `NoDiasTrabajados`, `SeptimoDia`, `SueldoBase`, `Sueldo`, `TotalExtras`, `Infonavit`, `Prestamo`, `SaldoAnterior`, `Abono`, `SueldoActual`, `SueldoNeto`, `Comentarios`) VALUES
(1, 1, 6, 1, 4, '123.00', '123.00', '123.00', '123.00', '123.00', '123.00', '123.00', '123.00', '123.00', '123.00', 'Comentario prueba'),
(1, 1, 6, 1, 4, '123.00', '123.00', '123.00', '123.00', '123.00', '123.00', '123.00', '123.00', '123.00', '123.00', 'Comentario prueba'),
(1, 1, 6, 1, 4, '123.00', '123.00', '123.00', '123.00', '123.00', '123.00', '123.00', '123.00', '123.00', '123.00', 'Comentario prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `__obsoleto_materiales_detalle_orden_rentas`
--

CREATE TABLE `__obsoleto_materiales_detalle_orden_rentas` (
  `IdMaterialesDetalleOrdenRentas` int(11) NOT NULL,
  `IdDetalleOrdenRentas` int(11) DEFAULT NULL,
  `IdMaterialesRentas` int(11) DEFAULT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `__obsoleto_materiales_detalle_orden_servicio`
--

CREATE TABLE `__obsoleto_materiales_detalle_orden_servicio` (
  `IdMaterialesDetalleServicio` int(11) NOT NULL,
  `IdDetalleOrdenServicio` int(11) NOT NULL,
  `IdMaterialesServicio` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `__obsoleto_nominasucursal`
--

CREATE TABLE `__obsoleto_nominasucursal` (
  `idNominaSucursal` int(11) NOT NULL,
  `idSucursal` int(11) DEFAULT NULL,
  `NoSemana` int(11) DEFAULT NULL,
  `FechaInicio` date DEFAULT NULL,
  `FechaTermino` date DEFAULT NULL,
  `TotalSeptimoDia` decimal(12,2) DEFAULT NULL,
  `TotalSueldoBase` decimal(12,2) DEFAULT NULL,
  `TotalSueldo` decimal(12,2) DEFAULT NULL,
  `TotalExtras` decimal(12,2) DEFAULT NULL,
  `TotalInfonavit` decimal(12,2) DEFAULT NULL,
  `TotalPrestamos` decimal(12,2) DEFAULT NULL,
  `TotalSaldoAnterior` decimal(12,2) DEFAULT NULL,
  `TotalAbono` decimal(12,2) DEFAULT NULL,
  `TotalSueldoActual` decimal(12,2) DEFAULT NULL,
  `TotalSueldoNeto` decimal(12,2) DEFAULT NULL,
  `idEmpleadoCaptura` int(11) DEFAULT NULL,
  `FechaCaptura` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `__obsoleto_rentas_materiales`
--

CREATE TABLE `__obsoleto_rentas_materiales` (
  `IdRentasMateriales` int(11) NOT NULL,
  `IdUnidadRenta` int(11) DEFAULT NULL,
  `IdMaterialesRentas` int(11) DEFAULT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `__obsoleto_servicios_materiales`
--

CREATE TABLE `__obsoleto_servicios_materiales` (
  `IdServicioMateriales` int(11) NOT NULL,
  `IdServicio` int(11) DEFAULT NULL,
  `IdMaterialesServicio` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `__obsoleto_servicios_materiales`
--

INSERT INTO `__obsoleto_servicios_materiales` (`IdServicioMateriales`, `IdServicio`, `IdMaterialesServicio`, `Cantidad`) VALUES
(1, 1, 3, 25),
(2, 2, 3, 20),
(3, 3, 2, 15),
(4, 4, 2, 10),
(5, 5, 1, 15);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caja_chica`
--
ALTER TABLE `caja_chica`
  ADD PRIMARY KEY (`IdCajaChica`),
  ADD KEY `FK_CCH_IdSucursal` (`IdSucursal`),
  ADD KEY `FK_CCH_IdTipoMovimiento` (`IdTipoMovimiento`),
  ADD KEY `FK_CCH_IdEmpleado` (`IdEmpleado`);

--
-- Indices de la tabla `choferes_entregan`
--
ALTER TABLE `choferes_entregan`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `choferes_recuperan`
--
ALTER TABLE `choferes_recuperan`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`IdCliente`),
  ADD KEY `FK_C_IdCiudad` (`IdCiudad`);

--
-- Indices de la tabla `c_categoria_empleado`
--
ALTER TABLE `c_categoria_empleado`
  ADD PRIMARY KEY (`IdCategoriaEmpleado`);

--
-- Indices de la tabla `c_roles`
--
ALTER TABLE `c_roles`
  ADD PRIMARY KEY (`IdRol`);

--
-- Indices de la tabla `c_servicios`
--
ALTER TABLE `c_servicios`
  ADD PRIMARY KEY (`IdServicio`);

--
-- Indices de la tabla `c_situacion_monetaria`
--
ALTER TABLE `c_situacion_monetaria`
  ADD PRIMARY KEY (`id_situacion_monetaria`);

--
-- Indices de la tabla `c_situacion_nominas`
--
ALTER TABLE `c_situacion_nominas`
  ADD PRIMARY KEY (`idSituacion_nomina`);

--
-- Indices de la tabla `c_situacion_ubicacion`
--
ALTER TABLE `c_situacion_ubicacion`
  ADD PRIMARY KEY (`id_situacion_ubicacion`);

--
-- Indices de la tabla `c_situacion_ubicacion_actividades`
--
ALTER TABLE `c_situacion_ubicacion_actividades`
  ADD PRIMARY KEY (`id_c_situacion_ubicacion_actividades`);

--
-- Indices de la tabla `c_tipo_movimiento`
--
ALTER TABLE `c_tipo_movimiento`
  ADD PRIMARY KEY (`IdTipoMovimiento`);

--
-- Indices de la tabla `c_tipo_sucursal`
--
ALTER TABLE `c_tipo_sucursal`
  ADD PRIMARY KEY (`IdTipoSucursal`);

--
-- Indices de la tabla `c_tipo_unidades`
--
ALTER TABLE `c_tipo_unidades`
  ADD PRIMARY KEY (`IdTipoUnidades`);

--
-- Indices de la tabla `detallenominasucursal`
--
ALTER TABLE `detallenominasucursal`
  ADD PRIMARY KEY (`idDetalleNominaSucursal`),
  ADD KEY `fk_nominaSucursal` (`idNominaSucursal`),
  ADD KEY `fk_empleado` (`idEmpleado`);

--
-- Indices de la tabla `detalleprenominaextras`
--
ALTER TABLE `detalleprenominaextras`
  ADD PRIMARY KEY (`idDetallePrenominaExtras`),
  ADD KEY `fk_idPrenominaExtras` (`idPrenominaExtra`),
  ADD KEY `fk_id_extra_sucursal` (`idExtraSucursal`),
  ADD KEY `fk_id_situacionExtra` (`idSituacionPrenomina`),
  ADD KEY `fk_id_empleado` (`idEmpleado`);

--
-- Indices de la tabla `empleadoinfonavit`
--
ALTER TABLE `empleadoinfonavit`
  ADD PRIMARY KEY (`IdEmpleadoInfonavit`),
  ADD KEY `FK_Infonavit_Empleado` (`IdEmpleado`);

--
-- Indices de la tabla `empleadoprestamo`
--
ALTER TABLE `empleadoprestamo`
  ADD PRIMARY KEY (`IdEmpleadoPrestamo`),
  ADD KEY `FK_Prestamo_Empleado` (`IdEmpleado`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`IdEmpleado`),
  ADD KEY `FK_E_IdSucursal` (`IdSucursal`),
  ADD KEY `FK_E_IdCategoriaEmpleado` (`IdCategoriaEmpleado`),
  ADD KEY `FK_E_IdSituacionEmpleado` (`IdSituacionEmpleado`);

--
-- Indices de la tabla `entidad`
--
ALTER TABLE `entidad`
  ADD PRIMARY KEY (`cve_ent`);

--
-- Indices de la tabla `extras`
--
ALTER TABLE `extras`
  ADD PRIMARY KEY (`IdExtra`);

--
-- Indices de la tabla `extrasucursal`
--
ALTER TABLE `extrasucursal`
  ADD PRIMARY KEY (`idExtraSucursal`),
  ADD KEY `fk_idExtra` (`idExtra`);

--
-- Indices de la tabla `inventario_unidades_renta`
--
ALTER TABLE `inventario_unidades_renta`
  ADD PRIMARY KEY (`IdInventarioUnidadesRenta`),
  ADD KEY `IdUnidadRenta` (`IdUnidadRenta`),
  ADD KEY `IdSucursal` (`IdSucursal`),
  ADD KEY `IdTipoUnidades` (`IdTipoUnidades`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`idm`),
  ADD UNIQUE KEY `idm_2` (`idm`),
  ADD KEY `cve_ent` (`cve_ent`),
  ADD KEY `idm` (`idm`);

--
-- Indices de la tabla `nominasucursal`
--
ALTER TABLE `nominasucursal`
  ADD PRIMARY KEY (`idNominaSucursal`),
  ADD KEY `fk_sucursal` (`idSucursal`);

--
-- Indices de la tabla `orden_rentas`
--
ALTER TABLE `orden_rentas`
  ADD PRIMARY KEY (`IdOrden`),
  ADD KEY `FK_OR_IdEmpleado` (`IdEmpleado_cotizacion`),
  ADD KEY `FK_OR_IdSucursal` (`IdSucursal`),
  ADD KEY `FK_OR_IdCliente` (`IdCliente`),
  ADD KEY `FK_OR_IdCiudad` (`IdCiudad`);

--
-- Indices de la tabla `orden_servicios`
--
ALTER TABLE `orden_servicios`
  ADD PRIMARY KEY (`IdOrden`),
  ADD KEY `FK_OS_IdEmpleado` (`IdEmpleado_cotizacion`),
  ADD KEY `FK_OS_IdCliente` (`IdCliente`),
  ADD KEY `FK_OS_Ord_IdCiudad` (`IdCiudad`);

--
-- Indices de la tabla `prenominaextra`
--
ALTER TABLE `prenominaextra`
  ADD PRIMARY KEY (`idPrenominaExtra`),
  ADD KEY `fk_situacionPreNominaExtra` (`idSituacionPrenominaExtra`),
  ADD KEY `fk_suc` (`idSucursal`);

--
-- Indices de la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD PRIMARY KEY (`IdRuta`);

--
-- Indices de la tabla `situacion_empleado`
--
ALTER TABLE `situacion_empleado`
  ADD PRIMARY KEY (`IdSituacionEmpleado`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`IdSucursal`),
  ADD KEY `FK_SUC_IdCiudad` (`IdCiudad`),
  ADD KEY `FK_SUC_IdTipoSucursal` (`IdTipoSucursal`);

--
-- Indices de la tabla `sucursal_servicio`
--
ALTER TABLE `sucursal_servicio`
  ADD PRIMARY KEY (`IdSucursalServicio`),
  ADD KEY `FK_SS_IdSucursal` (`IdSucursal`),
  ADD KEY `FK_SS_IdServicio` (`IdServicio`);

--
-- Indices de la tabla `tamano_servicios`
--
ALTER TABLE `tamano_servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `unidades_renta`
--
ALTER TABLE `unidades_renta`
  ADD PRIMARY KEY (`IdUnidadRenta`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD KEY `FK_US_IdEmpleado` (`IdEmpleado`),
  ADD KEY `FK_US_IdRol` (`IdRol`);

--
-- Indices de la tabla `_cotizaciones_cart_rentas`
--
ALTER TABLE `_cotizaciones_cart_rentas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `_cotizaciones_cart_servicios`
--
ALTER TABLE `_cotizaciones_cart_servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `_obsoleto_c_ciudades`
--
ALTER TABLE `_obsoleto_c_ciudades`
  ADD PRIMARY KEY (`Id_ciudad`),
  ADD KEY `IdEstado` (`IdEstado`);

--
-- Indices de la tabla `_obsoleto_c_estados`
--
ALTER TABLE `_obsoleto_c_estados`
  ADD PRIMARY KEY (`IdEstado`);

--
-- Indices de la tabla `_obsoleto_detalle_orden_cierre`
--
ALTER TABLE `_obsoleto_detalle_orden_cierre`
  ADD PRIMARY KEY (`IdDetalleOrdenCierre`),
  ADD KEY `FK_DOC_IdOrdenCierreRenta` (`IdOrdenCierreRenta`),
  ADD KEY `FK_DOC_IdEmpleado` (`IdEmpleado`);

--
-- Indices de la tabla `_obsoleto_detalle_orden_rentas`
--
ALTER TABLE `_obsoleto_detalle_orden_rentas`
  ADD PRIMARY KEY (`IdDetalleOrdenRentas`),
  ADD KEY `FK_DO_IdOrdenRenta` (`IdOrdenRenta`),
  ADD KEY `FK_DO_IdInventarioUnidadesRenta` (`IdInventarioUnidadesRenta`);

--
-- Indices de la tabla `_obsoleto_detalle_orden_servicio`
--
ALTER TABLE `_obsoleto_detalle_orden_servicio`
  ADD PRIMARY KEY (`IdDetalleOrdenServicio`),
  ADD KEY `FK_DOS_IdOrdenServicio` (`IdOrdenServicio`),
  ADD KEY `FK_DOS_IdServicio` (`IdServicio`);

--
-- Indices de la tabla `_obsoleto_empleados_orden_salida_renta`
--
ALTER TABLE `_obsoleto_empleados_orden_salida_renta`
  ADD PRIMARY KEY (`IdEmpleadosOrdenSalida`),
  ADD KEY `FK_EOSR_IdOrdenSalidaRenta` (`IdOrdenSalidaRenta`),
  ADD KEY `FK_EOSR_IdEmpleado` (`IdEmpleado`);

--
-- Indices de la tabla `_obsoleto_orden_cierre_renta`
--
ALTER TABLE `_obsoleto_orden_cierre_renta`
  ADD PRIMARY KEY (`IdOrdenCierreRenta`),
  ADD KEY `FK_OCR_IdOrdenRenta` (`IdOrdenRenta`),
  ADD KEY `FK_OCR_IdEmpleado` (`IdEmpleadoCaptura`),
  ADD KEY `FK_OCR_IdSucursal` (`IdSucursalEntrega`);

--
-- Indices de la tabla `_obsoleto_orden_salida_renta`
--
ALTER TABLE `_obsoleto_orden_salida_renta`
  ADD PRIMARY KEY (`IdOrdenSalidaRenta`),
  ADD KEY `FK_OSR_IdOrdenRenta` (`IdOrdenRenta`),
  ADD KEY `FK_OSR_IdEmpleado` (`IdEmpleado`);

--
-- Indices de la tabla `_obsoleto_reportes_servicios`
--
ALTER TABLE `_obsoleto_reportes_servicios`
  ADD PRIMARY KEY (`IdReporteServicio`),
  ADD KEY `FK_RS_IdSucursalServicio` (`IdSucursalServicio`);

--
-- Indices de la tabla `_pending_mail_queue`
--
ALTER TABLE `_pending_mail_queue`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `__obsoleto_c_materiales_renta`
--
ALTER TABLE `__obsoleto_c_materiales_renta`
  ADD PRIMARY KEY (`IdMaterialesRentas`);

--
-- Indices de la tabla `__obsoleto_c_materiales_servicios`
--
ALTER TABLE `__obsoleto_c_materiales_servicios`
  ADD PRIMARY KEY (`IdMaterialesServicio`);

--
-- Indices de la tabla `__obsoleto_detallenominasucursal`
--
ALTER TABLE `__obsoleto_detallenominasucursal`
  ADD KEY `idDetalleNominaSucursal` (`idDetalleNominaSucursal`);

--
-- Indices de la tabla `__obsoleto_materiales_detalle_orden_rentas`
--
ALTER TABLE `__obsoleto_materiales_detalle_orden_rentas`
  ADD PRIMARY KEY (`IdMaterialesDetalleOrdenRentas`),
  ADD KEY `FK__MDO_IdDetalleOrdenRentas` (`IdDetalleOrdenRentas`),
  ADD KEY `FK_MDO_IdMaterialesRentas` (`IdMaterialesRentas`);

--
-- Indices de la tabla `__obsoleto_materiales_detalle_orden_servicio`
--
ALTER TABLE `__obsoleto_materiales_detalle_orden_servicio`
  ADD PRIMARY KEY (`IdMaterialesDetalleServicio`),
  ADD KEY `FK_MDOS_IdDetalleOrdenServicio` (`IdDetalleOrdenServicio`),
  ADD KEY `FK_MDOS_IdMaterialesServicio` (`IdMaterialesServicio`);

--
-- Indices de la tabla `__obsoleto_nominasucursal`
--
ALTER TABLE `__obsoleto_nominasucursal`
  ADD PRIMARY KEY (`idNominaSucursal`),
  ADD KEY `fk_sucursal` (`idSucursal`);

--
-- Indices de la tabla `__obsoleto_rentas_materiales`
--
ALTER TABLE `__obsoleto_rentas_materiales`
  ADD PRIMARY KEY (`IdRentasMateriales`),
  ADD KEY `FK_RM_IdUnidadRenta` (`IdUnidadRenta`),
  ADD KEY `FK_RM_IdMaterialesRentas` (`IdMaterialesRentas`);

--
-- Indices de la tabla `__obsoleto_servicios_materiales`
--
ALTER TABLE `__obsoleto_servicios_materiales`
  ADD PRIMARY KEY (`IdServicioMateriales`),
  ADD KEY `FK_SM_IdServicio` (`IdServicio`),
  ADD KEY `fk_SM_IdMaterialesServicio` (`IdMaterialesServicio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caja_chica`
--
ALTER TABLE `caja_chica`
  MODIFY `IdCajaChica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `choferes_entregan`
--
ALTER TABLE `choferes_entregan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `choferes_recuperan`
--
ALTER TABLE `choferes_recuperan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `IdCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `c_categoria_empleado`
--
ALTER TABLE `c_categoria_empleado`
  MODIFY `IdCategoriaEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `c_roles`
--
ALTER TABLE `c_roles`
  MODIFY `IdRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `c_servicios`
--
ALTER TABLE `c_servicios`
  MODIFY `IdServicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `c_situacion_monetaria`
--
ALTER TABLE `c_situacion_monetaria`
  MODIFY `id_situacion_monetaria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `c_situacion_ubicacion`
--
ALTER TABLE `c_situacion_ubicacion`
  MODIFY `id_situacion_ubicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `c_situacion_ubicacion_actividades`
--
ALTER TABLE `c_situacion_ubicacion_actividades`
  MODIFY `id_c_situacion_ubicacion_actividades` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `c_tipo_movimiento`
--
ALTER TABLE `c_tipo_movimiento`
  MODIFY `IdTipoMovimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `c_tipo_sucursal`
--
ALTER TABLE `c_tipo_sucursal`
  MODIFY `IdTipoSucursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `c_tipo_unidades`
--
ALTER TABLE `c_tipo_unidades`
  MODIFY `IdTipoUnidades` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `detallenominasucursal`
--
ALTER TABLE `detallenominasucursal`
  MODIFY `idDetalleNominaSucursal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalleprenominaextras`
--
ALTER TABLE `detalleprenominaextras`
  MODIFY `idDetallePrenominaExtras` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleadoinfonavit`
--
ALTER TABLE `empleadoinfonavit`
  MODIFY `IdEmpleadoInfonavit` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleadoprestamo`
--
ALTER TABLE `empleadoprestamo`
  MODIFY `IdEmpleadoPrestamo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `IdEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `extras`
--
ALTER TABLE `extras`
  MODIFY `IdExtra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `extrasucursal`
--
ALTER TABLE `extrasucursal`
  MODIFY `idExtraSucursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `inventario_unidades_renta`
--
ALTER TABLE `inventario_unidades_renta`
  MODIFY `IdInventarioUnidadesRenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `municipio`
--
ALTER TABLE `municipio`
  MODIFY `idm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2458;

--
-- AUTO_INCREMENT de la tabla `nominasucursal`
--
ALTER TABLE `nominasucursal`
  MODIFY `idNominaSucursal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orden_rentas`
--
ALTER TABLE `orden_rentas`
  MODIFY `IdOrden` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orden_servicios`
--
ALTER TABLE `orden_servicios`
  MODIFY `IdOrden` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `prenominaextra`
--
ALTER TABLE `prenominaextra`
  MODIFY `idPrenominaExtra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rutas`
--
ALTER TABLE `rutas`
  MODIFY `IdRuta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `situacion_empleado`
--
ALTER TABLE `situacion_empleado`
  MODIFY `IdSituacionEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `IdSucursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `sucursal_servicio`
--
ALTER TABLE `sucursal_servicio`
  MODIFY `IdSucursalServicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tamano_servicios`
--
ALTER TABLE `tamano_servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `unidades_renta`
--
ALTER TABLE `unidades_renta`
  MODIFY `IdUnidadRenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=507;

--
-- AUTO_INCREMENT de la tabla `_cotizaciones_cart_rentas`
--
ALTER TABLE `_cotizaciones_cart_rentas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `_cotizaciones_cart_servicios`
--
ALTER TABLE `_cotizaciones_cart_servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `_obsoleto_c_ciudades`
--
ALTER TABLE `_obsoleto_c_ciudades`
  MODIFY `Id_ciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `_obsoleto_c_estados`
--
ALTER TABLE `_obsoleto_c_estados`
  MODIFY `IdEstado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `_obsoleto_detalle_orden_cierre`
--
ALTER TABLE `_obsoleto_detalle_orden_cierre`
  MODIFY `IdDetalleOrdenCierre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `_obsoleto_detalle_orden_rentas`
--
ALTER TABLE `_obsoleto_detalle_orden_rentas`
  MODIFY `IdDetalleOrdenRentas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `_obsoleto_detalle_orden_servicio`
--
ALTER TABLE `_obsoleto_detalle_orden_servicio`
  MODIFY `IdDetalleOrdenServicio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `_obsoleto_empleados_orden_salida_renta`
--
ALTER TABLE `_obsoleto_empleados_orden_salida_renta`
  MODIFY `IdEmpleadosOrdenSalida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `_obsoleto_orden_cierre_renta`
--
ALTER TABLE `_obsoleto_orden_cierre_renta`
  MODIFY `IdOrdenCierreRenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `_obsoleto_orden_salida_renta`
--
ALTER TABLE `_obsoleto_orden_salida_renta`
  MODIFY `IdOrdenSalidaRenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `_obsoleto_reportes_servicios`
--
ALTER TABLE `_obsoleto_reportes_servicios`
  MODIFY `IdReporteServicio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `_pending_mail_queue`
--
ALTER TABLE `_pending_mail_queue`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `__obsoleto_c_materiales_renta`
--
ALTER TABLE `__obsoleto_c_materiales_renta`
  MODIFY `IdMaterialesRentas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `__obsoleto_c_materiales_servicios`
--
ALTER TABLE `__obsoleto_c_materiales_servicios`
  MODIFY `IdMaterialesServicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `__obsoleto_detallenominasucursal`
--
ALTER TABLE `__obsoleto_detallenominasucursal`
  MODIFY `idDetalleNominaSucursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `__obsoleto_materiales_detalle_orden_rentas`
--
ALTER TABLE `__obsoleto_materiales_detalle_orden_rentas`
  MODIFY `IdMaterialesDetalleOrdenRentas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `__obsoleto_materiales_detalle_orden_servicio`
--
ALTER TABLE `__obsoleto_materiales_detalle_orden_servicio`
  MODIFY `IdMaterialesDetalleServicio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `__obsoleto_rentas_materiales`
--
ALTER TABLE `__obsoleto_rentas_materiales`
  MODIFY `IdRentasMateriales` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `__obsoleto_servicios_materiales`
--
ALTER TABLE `__obsoleto_servicios_materiales`
  MODIFY `IdServicioMateriales` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD CONSTRAINT `municipio_ibfk_1` FOREIGN KEY (`cve_ent`) REFERENCES `entidad` (`cve_ent`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
