-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: localhost    Database: sistemacurso2
-- ------------------------------------------------------
-- Server version	8.0.29

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;




--
-- Table structure for table `personas`
--

DROP TABLE IF EXISTS `personas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personas` (
  `idpersona` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) DEFAULT NULL,
  `Apellidos` varchar(255) DEFAULT NULL,
  `Dni` varchar(255) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Salario` double DEFAULT NULL,
  `Correo` varchar(255) DEFAULT NULL,
  `Moneda` varchar(255) DEFAULT NULL,
  `Sexo` enum('Hombre','Mujer') DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `Estado` enum('Activo','Inactivo') NOT NULL,
  `EstadoCuenta` enum('Pagado','Deuda','Procesando...') NOT NULL,
  `fechaRegisto` datetime DEFAULT NULL,
  `Fotopersona` text,
  `observacion` text,
  `cvpersona` text,
  `entrevista` varchar(255) DEFAULT NULL,
  `resulentrevista` varchar(255) DEFAULT NULL,
  `statedinicio` enum('Off','On') NOT NULL,
  PRIMARY KEY (`idpersona`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personas`
--

LOCK TABLES `personas` WRITE;
/*!40000 ALTER TABLE `personas` DISABLE KEYS */;
INSERT INTO `personas` VALUES (1,'Juan','Pérez González','12345678A','123456789',5000,'juan@example.com','SOLES','Hombre','Calle Principal 123','Activo','Pagado','2023-07-05 10:00:00','','','','SI','Aprobado','On'),(2,'María','Gómez Rodríguez','98765432B','987654321',7000,'maria@example.com','SOLES','Mujer','Avenida Central 456','Activo','Pagado','2023-07-05 11:00:00','','','','NO','Rechazado','On'),(3,'Pedro','López Martínez','56789012C','567890123',4000,'pedro@example.com','SOLES','Hombre','Plaza Mayor 789','Activo','Pagado','2023-07-05 12:00:00','','','','SI','Aprobado','On'),(4,'Ana','Martínez González','34567890D','345678901',6000,'ana@example.com','SOLES','Mujer','Calle Secundaria 321','Activo','Pagado','2023-07-05 13:00:00','','','','SI','Aprobado','Off'),(5,'Luis','Fernández López','67890123E','678901234',5500,'luis@example.com','SOLES','Hombre','Avenida Principal 987','Activo','Pagado','2023-07-05 14:00:00','','','','SI','Rechazado','Off'),(6,'Marcela','Hernández Rodríguez','23456789F','234567890',4500,'marcela@example.com','SOLES','Mujer','Calle del Sol 456','Activo','Pagado','2023-07-05 15:00:00','','','','NO','Rechazado','Off'),(7,'Carlos','Gómez López','89012345G','890123456',4800,'carlos@example.com','SOLES','Hombre','Avenida Central 789','Activo','Pagado','2023-07-05 16:00:00','','','','SI','Aprobado','Off'),(8,'Laura','Pérez Martínez','45678901H','456789012',5200,'laura@example.com','SOLES','Mujer','Calle Principal 234','Activo','Pagado','2023-07-05 17:00:00','','','','SI','Aprobado','Off'),(9,'Diego','López González','90123456I','901234567',5900,'diego@example.com','SOLES','Hombre','Plaza Mayor 567','Activo','Pagado','2023-07-05 18:00:00','','','','NO','Rechazado','Off'),(10,'Sofía','Fernández Martínez','34567890J','3456789012',5200,'sofia@example.com','SOLES','Mujer','Avenida Central 890','Activo','Pagado','2023-07-05 19:00:00','','','','SI','Aprobado','Off'),(11,'Andrés','García López','67890123K','6789012345',5100,'andres@example.com','SOLES','Hombre','Calle Principal 345','Activo','Pagado','2023-07-05 20:00:00','','','','SI','Rechazado','Off'),(12,'Martha','Rodríguez González','23456789L','2345678901',6000,'martha@example.com','SOLES','Mujer','Avenida Principal 678','Activo','Pagado','2023-07-05 21:00:00','','','','SI','Aprobado','Off'),(13,'Roberto','Hernández López','89012345M','8901234567',4700,'roberto@example.com','SOLES','Hombre','Calle Secundaria 901','Activo','Pagado','2023-07-05 22:00:00','','','','SI','Rechazado','Off'),(14,'Carolina','Gómez Rodríguez','45678901N','4567890123',5300,'carolina@example.com','SOLES','Mujer','Plaza Mayor 123','Activo','Pagado','2023-07-05 23:00:00','','','','NO','Aprobado','Off'),(15,'Javier','Pérez Martínez','90123456O','9012345678',5900,'javier@example.com','SOLES','Hombre','Avenida Central 456','Activo','Pagado','2023-07-05 00:00:00','','','','SI','Rechazado','Off'),(16,'Lucía','López González','34567890P','34567890123',5400,'lucia@example.com','SOLES','Mujer','Calle Principal 789','Activo','Pagado','2023-07-05 01:00:00','','','','SI','Aprobado','Off'),(17,'Gabriel','Fernández López','67890123Q','67890123456',5100,'gabriel@example.com','SOLES','Hombre','Avenida Principal 012','Activo','Pagado','2023-07-05 02:00:00','','','','SI','Rechazado','Off'),(18,'Valentina','García Martínez','23456789R','23456789012',5700,'valentina@example.com','SOLES','Mujer','Calle Secundaria 345','Activo','Pagado','2023-07-05 03:00:00','','','','NO','Aprobado','Off'),(19,'Alejandro','Rodríguez González','89012345S','89012345678',6200,'alejandro@example.com','SOLES','Hombre','Plaza Mayor 678','Activo','Pagado','2023-07-05 04:00:00','','','','SI','Rechazado','Off'),(20,'Camila','Hernández López','45678901T','45678901234',5300,'camila@example.com','SOLES','Mujer','Avenida Central 901','Activo','Pagado','2023-07-05 05:00:00','','','','SI','Aprobado','Off'),(21,'Daniel','Gómez Rodríguez','90123456U','90123456789',4800,'daniel@example.com','SOLES','Hombre','Calle Principal 234','Activo','Pagado','2023-07-05 06:00:00','','','','NO','Rechazado','Off'),(22,'Fernanda','Pérez Martínez','34567890V','34567890123',5600,'fernanda@example.com','SOLES','Mujer','Avenida Central 567','Activo','Pagado','2023-07-05 07:00:00','','','','SI','Aprobado','Off'),(23,'Isabella','Gómez López','56789012W','56789012345',5200,'isabella@example.com','SOLES','Mujer','Calle Principal 678','Activo','Pagado','2023-07-06 10:00:00','','','','SI','Aprobado','Off'),(24,'Miguel','Hernández Rodríguez','90123456X','90123456789',5900,'miguel@example.com','SOLES','Hombre','Avenida Central 901','Activo','Pagado','2023-07-06 11:00:00','','','','SI','Rechazado','Off'),(25,'Valeria','López Martínez','23456789Y','23456789012',5400,'valeria@example.com','SOLES','Mujer','Plaza Mayor 234','Activo','Pagado','2023-07-06 12:00:00','','','','NO','Aprobado','Off'),(26,'Luis','García González','89012345Z','89012345678',6100,'luis@example.com','SOLES','Hombre','Calle Secundaria 567','Activo','Pagado','2023-07-06 13:00:00','','','','SI','Aprobado','Off'),(27,'Luciana','Rodríguez Martínez','45678901AA','45678901234',5300,'luciana@example.com','SOLES','Mujer','Avenida Principal 901','Activo','Pagado','2023-07-06 14:00:00','','','','SI','Rechazado','Off'),(28,'Carlos','Hernández López','90123456BB','90123456789',4800,'carlos@example.com','SOLES','Hombre','Calle Principal 234','Activo','Pagado','2023-07-06 15:00:00','','','','NO','Aprobado','Off'),(29,'Daniela','Gómez Martínez','34567890CC','34567890123',5600,'daniela@example.com','SOLES','Mujer','Avenida Central 567','Activo','Pagado','2023-07-06 16:00:00','','','','SI','Rechazado','Off'),(30,'Sebastián','Pérez González','78901234DD','78901234567',5300,'sebastian@example.com','SOLES','Hombre','Plaza Mayor 901','Activo','Pagado','2023-07-06 17:00:00','','','','SI','Aprobado','Off'),(31,'Sofía','González López','12345678EE','12345678901',5900,'sofia@example.com','SOLES','Mujer','Calle Principal 234','Activo','Pagado','2023-07-06 18:00:00','','','','NO','Aprobado','Off'),(32,'Diego','Martínez Rodríguez','56789012FF','56789012345',5200,'diego@example.com','SOLES','Hombre','Avenida Principal 567','Activo','Pagado','2023-07-06 19:00:00','','','','SI','Rechazado','Off'),(33,'Valentina','Hernández Martínez','90123456GG','90123456789',5700,'valentina@example.com','SOLES','Mujer','Calle Secundaria 789','Activo','Pagado','2023-07-06 20:00:00','','','','NO','Aprobado','Off'),(34,'Mateo','Gómez López','23456789HH','23456789012',5300,'mateo@example.com','SOLES','Hombre','Plaza Mayor 012','Activo','Pagado','2023-07-06 21:00:00','','','','SI','Aprobado','Off'),(35,'Emma','Rodríguez Martínez','89012345II','89012345678',4800,'emma@example.com','SOLES','Mujer','Calle Principal 345','Activo','Pagado','2023-07-06 22:00:00','','','','NO','Rechazado','Off'),(36,'Joaquín','Hernández González','45678901JJ','45678901234',5500,'joaquin@example.com','SOLES','Hombre','Avenida Central 678','Activo','Pagado','2023-07-06 23:00:00','','','','SI','Aprobado','Off'),(37,'Valeria','García Martínez','90123456KK','90123456789',5900,'valeria@example.com','SOLES','Mujer','Plaza Mayor 901','Activo','Pagado','2023-07-07 00:00:00','','','','SI','Aprobado','Off'),(38,'Santiago','Rodríguez López','34567890LL','34567890123',5200,'santiago@example.com','SOLES','Hombre','Calle Principal 234','Activo','Pagado','2023-07-07 01:00:00','','','','SI','Rechazado','Off'),(39,'Catalina','Hernández Martínez','78901234MM','78901234567',5900,'catalina@example.com','SOLES','Mujer','Avenida Principal 567','Activo','Pagado','2023-07-07 02:00:00','','','','NO','Aprobado','Off'),(40,'Matías','Gómez González','12345678NN','12345678901',5200,'matias@example.com','SOLES','Hombre','Calle Secundaria 789','Activo','Pagado','2023-07-07 03:00:00','','','','SI','Aprobado','Off'),(41,'Valentina','Martínez López','56789012OO','56789012345',5800,'valentina@example.com','SOLES','Mujer','Plaza Mayor 012','Activo','Pagado','2023-07-07 04:00:00','','','','NO','Rechazado','Off'),(42,'Alejandro','Hernández Martínez','90123456PP','90123456789',5400,'alejandro@example.com','SOLES','Hombre','Calle Principal 345','Activo','Deuda','2023-07-07 05:00:00','','','','SI','Aprobado','On'),(43,'Lucía','García Rodríguez','23456789QQ','23456789012',5700,'lucia@example.com','SOLES','Mujer','Avenida Central 678','Activo','Deuda','2023-07-07 06:00:00','','','','SI','Aprobado','On'),(44,'Gabriel','Rodríguez López','89012345RR','89012345678',5200,'gabriel@example.com','SOLES','Hombre','Plaza Mayor 901','Activo','Procesando...','2023-07-07 07:00:00','','','','SI','Rechazado','On'),(45,'HUAMNI SALAS','ZEBALLOS MENDOZA','52896478','965874',4500,'huamni@gmail.com','SOLES','Hombre','mexico','Activo','Pagado','2023-07-05 20:35:24','',NULL,'CV_HUAMNI SALAS_52896478_05-Seguridad Basica Aplicaciones-2022-v1.0.pdf','Pendiente','Pendiente','Off');
/*!40000 ALTER TABLE `personas` ENABLE KEYS */;
UNLOCK TABLES;
--
-- Table structure for table `adelantos`
--

DROP TABLE IF EXISTS `adelantos`;
CREATE TABLE `adelantos` (
  `iddelantos` int NOT NULL AUTO_INCREMENT,
  `idpersona` int NOT NULL,
  `Moneda` varchar(45) DEFAULT NULL,
  `Monto` int DEFAULT NULL,
  `Fecharegisto` date DEFAULT NULL,
  `Estado` enum('Activo','Inactivo') NOT NULL,
  `yearactual` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`iddelantos`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adelantos`
--

LOCK TABLES `adelantos` WRITE;
/*!40000 ALTER TABLE `adelantos` DISABLE KEYS */;
INSERT INTO `adelantos` VALUES (1,42,NULL,78,'2023-07-05','Activo','2023'),(2,44,NULL,0,'2023-07-05','Activo','2023');
/*!40000 ALTER TABLE `adelantos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asistencia`
--

DROP TABLE IF EXISTS `asistencia`;

CREATE TABLE `asistencia` (
  `idasisten` int unsigned NOT NULL AUTO_INCREMENT,
  `personaid` int NOT NULL,
  `Fechas` date NOT NULL,
  `stated` tinyint(1) NOT NULL,
  `yearid` int DEFAULT NULL,
  PRIMARY KEY (`idasisten`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asistencia`
--

LOCK TABLES `asistencia` WRITE;
/*!40000 ALTER TABLE `asistencia` DISABLE KEYS */;
INSERT INTO `asistencia` VALUES (1,1,'2023-07-05',1,2023),(2,3,'2023-07-05',1,2023),(3,43,'2023-07-05',1,2023);
/*!40000 ALTER TABLE `asistencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horaextra`
--

DROP TABLE IF EXISTS `horaextra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `horaextra` (
  `idhextra` int NOT NULL AUTO_INCREMENT,
  `idepersona` int DEFAULT NULL,
  `hextra` int DEFAULT NULL,
  `total` double DEFAULT NULL,
  `fecharegistro` date DEFAULT NULL,
  `year` varchar(45) DEFAULT NULL,
  `stadohoral` enum('Pagado','Pendiente','Procesando...') DEFAULT NULL,
  PRIMARY KEY (`idhextra`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horaextra`
--

LOCK TABLES `horaextra` WRITE;
/*!40000 ALTER TABLE `horaextra` DISABLE KEYS */;
INSERT INTO `horaextra` VALUES (1,44,15,409.15,'2023-07-05','2023','Pendiente');
/*!40000 ALTER TABLE `horaextra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jornada`
--

DROP TABLE IF EXISTS `jornada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jornada` (
  `idinicio` int NOT NULL AUTO_INCREMENT,
  `personaid` int NOT NULL,
  `fechaRegisto` datetime DEFAULT NULL,
  `FechaInicio` date DEFAULT NULL,
  `fechapago` date DEFAULT NULL,
  `diasvacacionale` int DEFAULT NULL,
  `stadovaciones` enum('Vacaciones','Presente') DEFAULT NULL,
  `empresa` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idinicio`)
) ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jornada`
--

LOCK TABLES `jornada` WRITE;
/*!40000 ALTER TABLE `jornada` DISABLE KEYS */;
INSERT INTO `jornada` VALUES (1,44,'2023-07-05 20:18:52','2023-04-05','2023-05-05',8,'Vacaciones','?'),
(2,43,'2023-07-05 20:18:52','2023-02-05','2023-03-05',14,'Presente','?'),
(3,42,'2023-07-05 20:18:52','2023-02-05','2023-03-05',14,'Presente','?'),
(4,1,'2023-07-05 20:37:23','2023-07-05','2023-08-05',14,'Presente','?'),
(5,2,'2023-07-05 20:37:23','2023-07-05','2023-08-05',14,'Presente','?'),
(6,3,'2023-07-05 20:37:23','2023-07-05','2023-08-05',14,'Presente','?');
/*!40000 ALTER TABLE `jornada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagoshextra`
--

DROP TABLE IF EXISTS `pagoshextra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pagoshextra` (
  `idpagoshextra` int NOT NULL AUTO_INCREMENT,
  `idhextra` int DEFAULT NULL,
  `fechas` date DEFAULT NULL,
  `horas` int DEFAULT NULL,
  `monto` double DEFAULT NULL,
  `idpersona` int DEFAULT NULL,
  `datecreated` date DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `stated` enum('Pagado','Anulado') DEFAULT NULL,
  PRIMARY KEY (`idpagoshextra`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagoshextra`
--

LOCK TABLES `pagoshextra` WRITE;
/*!40000 ALTER TABLE `pagoshextra` DISABLE KEYS */;
INSERT INTO `pagoshextra` VALUES (1,2,'2023-07-05',5,163.66,44,'2023-07-05','Concept.H.EXTRA','Pagado');
/*!40000 ALTER TABLE `pagoshextra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagosjornada`
--

DROP TABLE IF EXISTS `pagosjornada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pagosjornada` (
  `idpago` int unsigned NOT NULL AUTO_INCREMENT,
  `idpersona` int NOT NULL,
  `montoP` double DEFAULT NULL,
  `Description` text,
  `fechasPagados` date DEFAULT NULL,
  `fechaoperacion` date DEFAULT NULL,
  `adelantos` double DEFAULT NULL,
  `montoextra` double DEFAULT NULL,
  `stado` enum('PAGADO','DEUDA') NOT NULL,
  PRIMARY KEY (`idpago`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagosjornada`
--

LOCK TABLES `pagosjornada` WRITE;
/*!40000 ALTER TABLE `pagosjornada` DISABLE KEYS */;
INSERT INTO `pagosjornada` VALUES (1,44,2000,'Pago Jornada mensuale','2023-03-05','2023-07-05',0,0,'PAGADO'),
(2,44,2000,'Pago Jornada mensuale','2023-04-05','2023-07-05',0,0,'PAGADO'),
(3,44,0,'pago adelantos personales','2023-07-05','2023-07-05',400,NULL,'PAGADO'),
(4,44,0,'Pago horas extras','2023-07-05','2023-07-05',NULL,327.32,'PAGADO');
/*!40000 ALTER TABLE `pagosjornada` ENABLE KEYS */;
UNLOCK TABLES;



--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `idususario` int NOT NULL AUTO_INCREMENT,
  `Nombres` varchar(255) DEFAULT NULL,
  `Apellidos` varchar(255) DEFAULT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `usu_estatus` enum('Activo','Inactivo') NOT NULL,
  `passwordprincipal` char(255) DEFAULT NULL,
  `passwordalterno` char(255) DEFAULT NULL,
  `passwordrespaldo` char(255) DEFAULT NULL,
  `rolusuario` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idususario`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'DANIEL','CHAVEZ TORRIEL','DANIEL','Activo','$argon2i$v=19$m=65536,t=4,p=1$WUllTUR1L2xSWmFDbUNXMg$nid7jBStkE//fqj/haOy5vMNEwqt///2kInjga38df0','$2y$10$bdaLgJ4nMznqHpud2FzFVO6rj.1rJliF2pvjOT47T3YYEj3U/1Uzq','$2y$10$Yudkk2bnv6ALqJ8m1xFWhO24PQiE8wn7r.c0Sk51qZSMTGjvXYEaa','ADMINISTRADOR'),(2,'usuario02','USUARIO2  APELLIDOS','USUARIO02','Activo','$argon2i$v=19$m=65536,t=4,p=1$R3lySlNFaDlGYnBmcHRVMA$XzIjEpQTS3hbT8VlLFeFLOo93gtcOJj2bk5+dXK3FpI','$2y$10$.JvzHr0T3zP8gsusaizMVePbZuOHVHWCLNEvPddEo3fTbvzr0Swa.','$2y$10$IsXukbI8YY8UgT83YsaOje49A0XLH0qmHiSXMSsQnoL9lRNRfzL0O','NOMBRADO');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vacaciones`
--

DROP TABLE IF EXISTS `vacaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vacaciones` (
  `idvacaciones` int NOT NULL AUTO_INCREMENT,
  `idempleado` int DEFAULT NULL,
  `fechinicio` date DEFAULT NULL,
  `fechafinal` date DEFAULT NULL,
  `motivo` varchar(255) DEFAULT NULL,
  `diasvacaciones` int DEFAULT NULL,
  `descripcion` text,
  `datecreate` date DEFAULT NULL,
  PRIMARY KEY (`idvacaciones`)
) ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vacaciones`
--

LOCK TABLES `vacaciones` WRITE;
/*!40000 ALTER TABLE `vacaciones` DISABLE KEYS */;
INSERT INTO `vacaciones` VALUES (1,44,'2023-07-05','2023-07-12','VACACIONES',6,'7777','2023-07-05');
/*!40000 ALTER TABLE `vacaciones` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-07-05 21:17:48
