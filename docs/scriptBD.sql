-- MySQL dump 10.15  Distrib 10.0.13-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: odontoifma
-- ------------------------------------------------------
-- Server version 10.0.13-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `acesso`
--

-- -----------------------------------------------------
-- Schema odontoifma
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `odontoifma` DEFAULT CHARACTER SET utf8 ;
USE `odontoifma` ;

DROP TABLE IF EXISTS `acesso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acesso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `operador_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`operador_id`),
  KEY `fk_acesso_operador1_idx` (`operador_id`),
  CONSTRAINT `fk_acesso_operador1` FOREIGN KEY (`operador_id`) REFERENCES `operador` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acesso`
--

LOCK TABLES `acesso` WRITE;
/*!40000 ALTER TABLE `acesso` DISABLE KEYS */;
INSERT INTO `acesso` VALUES (3,'admin','ec517094b947c70a4c7bae092433c504',7);
/*!40000 ALTER TABLE `acesso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campus`
--

DROP TABLE IF EXISTS `campus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campus`
--

LOCK TABLES `campus` WRITE;
/*!40000 ALTER TABLE `campus` DISABLE KEYS */;
INSERT INTO `campus` VALUES (1,'MONTE CASTELLO');
/*!40000 ALTER TABLE `campus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doencas_preexistentes`
--

DROP TABLE IF EXISTS `doencas_preexistentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doencas_preexistentes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `familiar` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doencas_preexistentes`
--

LOCK TABLES `doencas_preexistentes` WRITE;
/*!40000 ALTER TABLE `doencas_preexistentes` DISABLE KEYS */;
INSERT INTO `doencas_preexistentes` VALUES (1,'DIABETES',1),(2,'HIPERTENSÃO',1),(3,'CARDIACO',1),(4,'HEPÁTICO',0),(5,'NEUROLÓGICO',0),(6,'RESPIRATÓRIO',0),(7,'DST',0),(8,'CIRURGIA',0),(9,'FAZ USO DE MEDICAMENTO',0),(10,'ALERGIA',0),(11,'GRAVIDEZ',0),(12,'COAGULAÇÃO',0),(13,'HEMORRAGIA',0),(14,'ANESTESIA',0),(15,'AIDS-HIV',0),(16,'FEBRE REUMÁTICA',0),(17,'EPLEPSIA',0),(18,'TIREOIDE',0),(19,'RENAL',0),(20,'FUMO',0),(21,'DROGAS',0),(22,'ÁLCOOL',0);
/*!40000 ALTER TABLE `doencas_preexistentes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `higiene`
--

DROP TABLE IF EXISTS `higiene`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `higiene` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente` int(11) NOT NULL,
  `escovacao` int(11) DEFAULT '0',
  `fio_dental` tinyint(1) DEFAULT '0',
  `bochecho` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`,`paciente`),
  KEY `fk_higiene_paciente_idx` (`paciente`),
  CONSTRAINT `fk_higiene_paciente` FOREIGN KEY (`paciente`) REFERENCES `paciente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `higiene`
--

LOCK TABLES `higiene` WRITE;
/*!40000 ALTER TABLE `higiene` DISABLE KEYS */;
/*!40000 ALTER TABLE `higiene` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historia_medica`
--

DROP TABLE IF EXISTS `historia_medica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historia_medica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doenca_preexistente` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `paciente` int(11) NOT NULL,
  `ant_familiar` int(11) DEFAULT '0',
  PRIMARY KEY (`id`,`doenca_preexistente`,`paciente`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_historia_medica_doencas_preexistentes_idx` (`doenca_preexistente`),
  KEY `fk_historia_medica_paciente_idx` (`paciente`),
  CONSTRAINT `fk_historia_medica_doencas_preexistentes` FOREIGN KEY (`doenca_preexistente`) REFERENCES `doencas_preexistentes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_historia_medica_paciente` FOREIGN KEY (`paciente`) REFERENCES `paciente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historia_medica`
--

LOCK TABLES `historia_medica` WRITE;
/*!40000 ALTER TABLE `historia_medica` DISABLE KEYS */;
/*!40000 ALTER TABLE `historia_medica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operador`
--

DROP TABLE IF EXISTS `operador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `documento` varchar(255) DEFAULT NULL,
  `tipo_operador` int(11) NOT NULL,
  PRIMARY KEY (`id`,`tipo_operador`),
  UNIQUE KEY `idoperador_UNIQUE` (`id`),
  KEY `fk_operador_tipo_operador1_idx` (`tipo_operador`),
  CONSTRAINT `fk_operador_tipo_operador1` FOREIGN KEY (`tipo_operador`) REFERENCES `tipo_operador` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operador`
--

LOCK TABLES `operador` WRITE;
/*!40000 ALTER TABLE `operador` DISABLE KEYS */;
INSERT INTO `operador` VALUES (7,'Administrador','',1);
/*!40000 ALTER TABLE `operador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paciente`
--

DROP TABLE IF EXISTS `paciente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paciente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `data_nasc` date NOT NULL,
  `turma` varchar(255) NOT NULL,
  `naturalidade` varchar(255) NOT NULL,
  `telefone` varchar(255) NOT NULL,
  `sexo` varchar(255) NOT NULL,
  `raca` varchar(255) NOT NULL,
  `matricula` varchar(255) DEFAULT NULL,
  `campus_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`campus_id`),
  UNIQUE KEY `idpaciente_UNIQUE` (`id`),
  KEY `fk_paciente_campus1_idx` (`campus_id`),
  CONSTRAINT `fk_paciente_campus1` FOREIGN KEY (`campus_id`) REFERENCES `campus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paciente`
--

LOCK TABLES `paciente` WRITE;
/*!40000 ALTER TABLE `paciente` DISABLE KEYS */;
/*!40000 ALTER TABLE `paciente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parafuncionais`
--

DROP TABLE IF EXISTS `parafuncionais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parafuncionais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `habito` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `paciente` int(11) NOT NULL,
  PRIMARY KEY (`id`,`paciente`,`habito`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_parafuncionais_tipo_habito_idx` (`habito`),
  KEY `fk_parafuncionais_paciente_idx` (`paciente`),
  CONSTRAINT `fk_parafuncionais_paciente` FOREIGN KEY (`paciente`) REFERENCES `paciente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_parafuncionais_tipo_habito` FOREIGN KEY (`habito`) REFERENCES `tipo_habito` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parafuncionais`
--

LOCK TABLES `parafuncionais` WRITE;
/*!40000 ALTER TABLE `parafuncionais` DISABLE KEYS */;
/*!40000 ALTER TABLE `parafuncionais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `queixa_principal`
--

DROP TABLE IF EXISTS `queixa_principal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `queixa_principal` (
  `idqueixa_principal` int(11) NOT NULL AUTO_INCREMENT,
  `queixa` varchar(255) NOT NULL,
  `paciente` int(11) NOT NULL,
  PRIMARY KEY (`idqueixa_principal`,`paciente`),
  KEY `fk_queixa_principal_paciente_idx` (`paciente`),
  CONSTRAINT `fk_queixa_principal_paciente` FOREIGN KEY (`paciente`) REFERENCES `paciente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `queixa_principal`
--

LOCK TABLES `queixa_principal` WRITE;
/*!40000 ALTER TABLE `queixa_principal` DISABLE KEYS */;
/*!40000 ALTER TABLE `queixa_principal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_habito`
--

DROP TABLE IF EXISTS `tipo_habito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_habito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_habito`
--

LOCK TABLES `tipo_habito` WRITE;
/*!40000 ALTER TABLE `tipo_habito` DISABLE KEYS */;
INSERT INTO `tipo_habito` VALUES (1,'ROI UNHA'),(2,'RESPIRADOR BUCAL'),(3,'CHUPAR DEDO'),(4,'RANGER OS DENTES'),(5,'INTERPOR OBJETOS');
/*!40000 ALTER TABLE `tipo_habito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_operador`
--

DROP TABLE IF EXISTS `tipo_operador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_operador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_operador`
--

LOCK TABLES `tipo_operador` WRITE;
/*!40000 ALTER TABLE `tipo_operador` DISABLE KEYS */;
INSERT INTO `tipo_operador` VALUES (1,'ADMINISTRADOR'),(2,'ATENDENTE'),(3,'DENTISTA');
/*!40000 ALTER TABLE `tipo_operador` ENABLE KEYS */;
UNLOCK TABLES;

-- -----------------------------------------------------
-- Table `mydb`.`atendimentos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `atendimentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atendimentos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(100) NOT NULL,
  `data_agendamento` TIMESTAMP NOT NULL,
  `data_atendimento` TIMESTAMP,
  `paciente_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `paciente_id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_atendimentos_paciente_idx` (`paciente_id` ASC),
  CONSTRAINT `fk_atendimentos_paciente`
    FOREIGN KEY (`paciente_id`)
    REFERENCES `odontoifma`.`paciente` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_operador`
--

LOCK TABLES `atendimentos` WRITE;
/*!40000 ALTER TABLE `atendimentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `atendimentos` ENABLE KEYS */;
UNLOCK TABLES;

USE `odontoifma`;
CREATE  OR REPLACE VIEW `getAgendamentos` AS
  SELECT agendamento.id, agendamento.obs, agendamento.status,
    DATE_FORMAT(agendamento.data_agendamento,'%d/%m/%Y %H:%i') AS dataAgendamento,
    DATE_FORMAT(agendamento.data_atendimento,'%d/%m/%Y %H:%i') AS dataAtendimento,
    DATE_FORMAT(agendamento.criado_em,'%d/%m/%Y %H:%i') AS criadoEm,
    DATE_FORMAT(agendamento.alterado_em,'%d/%m/%Y %H:%i') AS alteradoEm,
    agendamento.data_agendamento,agendamento.data_atendimento,agendamento.criado_em,agendamento.alterado_em,
    paciente.id AS pacienteId, paciente.nome AS pacienteNome,
    operador.id AS dentistaId,operador.nome AS dentistaNome
  FROM agendamento
    JOIN paciente ON paciente.id = agendamento.paciente
    JOIN operador ON operador.id = agendamento.dentista ;



/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-06-19 15:27:38
