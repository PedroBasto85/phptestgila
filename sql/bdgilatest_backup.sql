/*
BACKUP
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`phptestgila` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `phptestgila`;

/*Table structure for table `cat_categoria` */

DROP TABLE IF EXISTS `cat_categoria`;

CREATE TABLE `cat_categoria` (
  `CategoriaID` tinyint(3) unsigned NOT NULL,
  `CategoriaDescripcion` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `Vigente` tinyint(1) NOT NULL,
  `FechaUM` datetime NOT NULL,
  PRIMARY KEY (`CategoriaID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `cat_categoria` */

insert  into `cat_categoria`(`CategoriaID`,`CategoriaDescripcion`,`Vigente`,`FechaUM`) values (1,'Sedán',1,'2022-02-14 11:05:50');
insert  into `cat_categoria`(`CategoriaID`,`CategoriaDescripcion`,`Vigente`,`FechaUM`) values (2,'Motocicleta',1,'2022-02-14 11:06:09');

/*Table structure for table `cat_marca` */

DROP TABLE IF EXISTS `cat_marca`;

CREATE TABLE `cat_marca` (
  `MarcaID` int(10) unsigned NOT NULL,
  `CategoriaID` tinyint(3) unsigned NOT NULL,
  `MarcaDescripcion` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Vigente` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`MarcaID`),
  KEY `fk_categoria` (`CategoriaID`),
  CONSTRAINT `fk_categoria` FOREIGN KEY (`CategoriaID`) REFERENCES `cat_categoria` (`CategoriaID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `cat_marca` */

insert  into `cat_marca`(`MarcaID`,`CategoriaID`,`MarcaDescripcion`,`Vigente`) values (1,1,'Volkswagen',1);
insert  into `cat_marca`(`MarcaID`,`CategoriaID`,`MarcaDescripcion`,`Vigente`) values (2,1,'Nissan',1);
insert  into `cat_marca`(`MarcaID`,`CategoriaID`,`MarcaDescripcion`,`Vigente`) values (3,1,'Chevrolet',1);
insert  into `cat_marca`(`MarcaID`,`CategoriaID`,`MarcaDescripcion`,`Vigente`) values (4,2,'Italika',1);
insert  into `cat_marca`(`MarcaID`,`CategoriaID`,`MarcaDescripcion`,`Vigente`) values (5,2,'Bajaj',1);

/*Table structure for table `cat_modelo` */

DROP TABLE IF EXISTS `cat_modelo`;

CREATE TABLE `cat_modelo` (
  `ModeloID` int(10) unsigned NOT NULL,
  `MarcaID` int(10) unsigned NOT NULL,
  `ModeloDescripcion` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Vigente` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ModeloID`),
  KEY `fk_marca` (`MarcaID`),
  CONSTRAINT `fk_marca` FOREIGN KEY (`MarcaID`) REFERENCES `cat_marca` (`MarcaID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `cat_modelo` */

insert  into `cat_modelo`(`ModeloID`,`MarcaID`,`ModeloDescripcion`,`Vigente`) values (1,1,'Jetta',1);
insert  into `cat_modelo`(`ModeloID`,`MarcaID`,`ModeloDescripcion`,`Vigente`) values (2,1,'Gol',1);
insert  into `cat_modelo`(`ModeloID`,`MarcaID`,`ModeloDescripcion`,`Vigente`) values (3,2,'Versa',1);
insert  into `cat_modelo`(`ModeloID`,`MarcaID`,`ModeloDescripcion`,`Vigente`) values (4,2,'March',1);
insert  into `cat_modelo`(`ModeloID`,`MarcaID`,`ModeloDescripcion`,`Vigente`) values (5,3,'Aveo',1);
insert  into `cat_modelo`(`ModeloID`,`MarcaID`,`ModeloDescripcion`,`Vigente`) values (6,3,'Onix',1);
insert  into `cat_modelo`(`ModeloID`,`MarcaID`,`ModeloDescripcion`,`Vigente`) values (7,4,'D125',1);
insert  into `cat_modelo`(`ModeloID`,`MarcaID`,`ModeloDescripcion`,`Vigente`) values (8,4,'D150',1);
insert  into `cat_modelo`(`ModeloID`,`MarcaID`,`ModeloDescripcion`,`Vigente`) values (9,5,'Pulsar',1);

/*Table structure for table `sys_usuario` */

DROP TABLE IF EXISTS `sys_usuario`;

CREATE TABLE `sys_usuario` (
  `UsuarioID` smallint(5) unsigned NOT NULL,
  `UsuarioNombre` varchar(150) COLLATE latin1_spanish_ci NOT NULL,
  `UsuarioAlias` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  `Contrasenia` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `Vigente` tinyint(1) NOT NULL,
  `FechaUM` datetime NOT NULL,
  PRIMARY KEY (`UsuarioID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `sys_usuario` */

insert  into `sys_usuario`(`UsuarioID`,`UsuarioNombre`,`UsuarioAlias`,`Contrasenia`,`Vigente`,`FechaUM`) values (1,'Pedro Basto','Super','Super',1,'2022-02-13 18:15:41');

/*Table structure for table `tbl_vehiculo` */

DROP TABLE IF EXISTS `tbl_vehiculo`;

CREATE TABLE `tbl_vehiculo` (
  `VehiculoID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CategoriaID` tinyint(4) NOT NULL,
  `MarcaID` smallint(6) NOT NULL,
  `ModeloID` smallint(6) NOT NULL,
  `Anio` varchar(4) COLLATE latin1_spanish_ci NOT NULL,
  `NoLlantas` tinyint(2) NOT NULL,
  `PotenciaMotor` smallint(4) unsigned NOT NULL,
  `Vigente` tinyint(1) NOT NULL,
  `FechaAlta` datetime NOT NULL,
  `FechaUM` datetime NOT NULL,
  `UsuarioUM` smallint(6) NOT NULL,
  PRIMARY KEY (`VehiculoID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

/*Data for the table `tbl_vehiculo` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
