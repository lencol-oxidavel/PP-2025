  -- MySQL Script corrigido
  -- Data: 2025-06-03
  
  SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
  SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
  SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
  
  -- -----------------------------------------------------
  -- Schema bancolink
  -- -----------------------------------------------------
  CREATE SCHEMA IF NOT EXISTS `bancolink` DEFAULT CHARACTER SET utf8 ;
  USE `bancolink` ;
  
  -- -----------------------------------------------------
  -- Table `Equipes`
  -- -----------------------------------------------------
  CREATE TABLE IF NOT EXISTS `Equipes` (
    `equipeID` INT NOT NULL AUTO_INCREMENT,
    `telefone` VARCHAR(15) NOT NULL,
    `Nome` VARCHAR(45) NOT NULL,
    `Cargo` VARCHAR(45) NOT NULL,
    `email` VARCHAR(45) NOT NULL,
    `cpf` VARCHAR(14) NOT NULL,
    `sexo` CHAR(1) NOT NULL,
    PRIMARY KEY (`equipeID`),
    UNIQUE INDEX `telefone_UNIQUE` (`telefone` ASC),
    UNIQUE INDEX `Email_UNIQUE` (`email` ASC),
    UNIQUE INDEX `cpf_UNIQUE` (`cpf` ASC)
  ) ENGINE = InnoDB;
  
  -- -----------------------------------------------------
  -- Table `Usuarios`
  -- -----------------------------------------------------
  CREATE TABLE IF NOT EXISTS `Usuarios` (
    `usuarioID` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(45) NOT NULL,
    `email` VARCHAR(45) NOT NULL,
    `senha` VARCHAR(45) NOT NULL,
    `sexo` CHAR(1) NOT NULL,
    `telefone` VARCHAR(15) NOT NULL,
    `jornalista` TINYINT NOT NULL,
    PRIMARY KEY (`usuarioID`),
    UNIQUE INDEX `email_UNIQUE` (`email` ASC),
    UNIQUE INDEX `telefone_UNIQUE` (`telefone` ASC)
  ) ENGINE = InnoDB;
  
  -- -----------------------------------------------------
  -- Table `Jornalistas`
  -- -----------------------------------------------------
  CREATE TABLE IF NOT EXISTS `Jornalistas` (
    `jornalistaID` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(45) NOT NULL,
    `email` VARCHAR(45) NOT NULL,
    `senha` VARCHAR(45) NOT NULL,
    `telefone` VARCHAR(15) NOT NULL,
    `Usuarios_usuarioID` INT NOT NULL,
    PRIMARY KEY (`jornalistaID`),
    UNIQUE INDEX `email_UNIQUE` (`email` ASC),
    UNIQUE INDEX `telefone_UNIQUE` (`telefone` ASC),
    INDEX `fk_Jornalistas_Usuarios1_idx` (`Usuarios_usuarioID` ASC),
    CONSTRAINT `fk_Jornalistas_Usuarios1`
      FOREIGN KEY (`Usuarios_usuarioID`)
      REFERENCES `Usuarios` (`usuarioID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
  ) ENGINE = InnoDB;
  
  -- -----------------------------------------------------
  -- Table `Noticias`
  -- -----------------------------------------------------
  CREATE TABLE IF NOT EXISTS `Noticias` (
    `noticiaID` INT NOT NULL AUTO_INCREMENT,
    `texto` TEXT NOT NULL,
    `titulo` VARCHAR(100) NOT NULL,
    `foto` VARCHAR(100) NOT NULL,
    `descricao` VARCHAR(255) NOT NULL,
    `data_liberacao` DATETIME NOT NULL,
    `liberacao` TINYINT NOT NULL,
    `data_revisao` DATETIME NOT NULL,
    `revisao` TINYINT NOT NULL,
    `Equipes_equipeID` INT NOT NULL,
    `Jornalistas_jornalistaID` INT NOT NULL,
    PRIMARY KEY (`noticiaID`),
    INDEX `fk_Noticias_Equipes_idx` (`Equipes_equipeID` ASC),
    INDEX `fk_Noticias_Jornalistas1_idx` (`Jornalistas_jornalistaID` ASC),
    CONSTRAINT `fk_Noticias_Equipes`
      FOREIGN KEY (`Equipes_equipeID`)
      REFERENCES `Equipes` (`equipeID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
    CONSTRAINT `fk_Noticias_Jornalistas1`
      FOREIGN KEY (`Jornalistas_jornalistaID`)
      REFERENCES `Jornalistas` (`jornalistaID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
  ) ENGINE = InnoDB;
  
  -- -----------------------------------------------------
  -- Table `Noticias_has_Usuarios`
  -- -----------------------------------------------------
  CREATE TABLE IF NOT EXISTS `Noticias_has_Usuarios` (
    `Usuarios_usuarioID` INT NOT NULL,
    `Noticias_noticiaID` INT NOT NULL,
    PRIMARY KEY (`Usuarios_usuarioID`, `Noticias_noticiaID`),
    INDEX `fk_Noticias_has_Usuarios_Noticias1_idx` (`Noticias_noticiaID` ASC),
    CONSTRAINT `fk_Noticias_has_Usuarios_Usuarios1`
      FOREIGN KEY (`Usuarios_usuarioID`)
      REFERENCES `Usuarios` (`usuarioID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
    CONSTRAINT `fk_Noticias_has_Usuarios_Noticias1`
      FOREIGN KEY (`Noticias_noticiaID`)
      REFERENCES `Noticias` (`noticiaID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
  ) ENGINE = InnoDB;
  
  -- Restaurando modos anteriores
  SET SQL_MODE=@OLD_SQL_MODE;
  SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
  SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;