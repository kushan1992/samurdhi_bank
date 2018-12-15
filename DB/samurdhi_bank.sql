-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema samurdhi_bank
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema samurdhi_bank
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `samurdhi_bank` DEFAULT CHARACTER SET latin1 ;
USE `samurdhi_bank` ;

-- -----------------------------------------------------
-- Table `samurdhi_bank`.`interest`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `samurdhi_bank`.`interest` (
  `idinterest` INT NOT NULL AUTO_INCREMENT,
  `rate` FLOAT NULL,
  `status` TINYINT NULL,
  PRIMARY KEY (`idinterest`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `samurdhi_bank`.`loan_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `samurdhi_bank`.`loan_type` (
  `idloan_type` INT NOT NULL AUTO_INCREMENT,
  `loan_name` VARCHAR(45) NULL,
  `duration_min` VARCHAR(45) NULL,
  `duration_max` VARCHAR(45) NULL,
  `interest_min` VARCHAR(45) NULL,
  `interest_max` VARCHAR(45) NULL,
  `status` TINYINT NULL,
  PRIMARY KEY (`idloan_type`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `samurdhi_bank`.`customer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `samurdhi_bank`.`customer` (
  `idcustomer` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `nic` VARCHAR(45) NULL,
  `create_date` DATETIME NULL,
  `status` TINYINT NULL,
  PRIMARY KEY (`idcustomer`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `samurdhi_bank`.`role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `samurdhi_bank`.`role` (
  `idrole` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  `status` TINYINT NULL,
  PRIMARY KEY (`idrole`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `samurdhi_bank`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `samurdhi_bank`.`user` (
  `iduser` INT NOT NULL AUTO_INCREMENT,
  `role_idrole` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `create_date` DATETIME NULL,
  `status` TINYINT NULL,
  PRIMARY KEY (`iduser`),
  INDEX `fk_user_role1_idx` (`role_idrole` ASC) VISIBLE,
  CONSTRAINT `fk_user_role1`
    FOREIGN KEY (`role_idrole`)
    REFERENCES `samurdhi_bank`.`role` (`idrole`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `samurdhi_bank`.`loan_create`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `samurdhi_bank`.`loan_create` (
  `idloan_create` INT NOT NULL AUTO_INCREMENT,
  `customer_idcustomer` INT NOT NULL,
  `loan_type_idloan_type` INT NOT NULL,
  `interest_idinterest` INT NOT NULL,
  `duration` INT NULL,
  `user_iduser` INT NOT NULL,
  `status` TINYINT NULL,
  PRIMARY KEY (`idloan_create`),
  INDEX `fk_loan_create_user1_idx` (`user_iduser` ASC) VISIBLE,
  INDEX `fk_loan_create_loan_type1_idx` (`loan_type_idloan_type` ASC) VISIBLE,
  INDEX `fk_loan_create_interest1_idx` (`interest_idinterest` ASC) VISIBLE,
  INDEX `fk_loan_create_customer1_idx` (`customer_idcustomer` ASC) VISIBLE,
  CONSTRAINT `fk_loan_create_user1`
    FOREIGN KEY (`user_iduser`)
    REFERENCES `samurdhi_bank`.`user` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_loan_create_loan_type1`
    FOREIGN KEY (`loan_type_idloan_type`)
    REFERENCES `samurdhi_bank`.`loan_type` (`idloan_type`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_loan_create_interest1`
    FOREIGN KEY (`interest_idinterest`)
    REFERENCES `samurdhi_bank`.`interest` (`idinterest`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_loan_create_customer1`
    FOREIGN KEY (`customer_idcustomer`)
    REFERENCES `samurdhi_bank`.`customer` (`idcustomer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `samurdhi_bank`.`payment_log`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `samurdhi_bank`.`payment_log` (
  `idpayment_log` INT NOT NULL AUTO_INCREMENT,
  `customer_idcustomer` INT NOT NULL,
  `loan_create_idloan_create` INT NOT NULL,
  `date_time` DATETIME NULL,
  `premium` FLOAT NULL,
  `interest` FLOAT NULL,
  `panalty` FLOAT NULL,
  `user_iduser` INT NOT NULL,
  `status` TINYINT NULL,
  PRIMARY KEY (`idpayment_log`),
  INDEX `fk_payment_log_user1_idx` (`user_iduser` ASC) VISIBLE,
  INDEX `fk_payment_log_loan_create1_idx` (`loan_create_idloan_create` ASC) VISIBLE,
  INDEX `fk_payment_log_customer1_idx` (`customer_idcustomer` ASC) VISIBLE,
  CONSTRAINT `fk_payment_log_user1`
    FOREIGN KEY (`user_iduser`)
    REFERENCES `samurdhi_bank`.`user` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_payment_log_loan_create1`
    FOREIGN KEY (`loan_create_idloan_create`)
    REFERENCES `samurdhi_bank`.`loan_create` (`idloan_create`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_payment_log_customer1`
    FOREIGN KEY (`customer_idcustomer`)
    REFERENCES `samurdhi_bank`.`customer` (`idcustomer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `samurdhi_bank`.`account_log`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `samurdhi_bank`.`account_log` (
  `idaccount_log` INT NOT NULL AUTO_INCREMENT,
  `premium_balance` FLOAT NULL,
  `interest_balance` FLOAT NULL,
  `date_time` DATETIME NULL,
  `loan_create_id` INT NOT NULL,
  `customer_id` INT NOT NULL,
  PRIMARY KEY (`idaccount_log`),
  INDEX `fk_account_log_loan_create1` (`loan_create_id` ASC) VISIBLE,
  INDEX `fk_account_log_customer1` (`customer_id` ASC) VISIBLE,
  CONSTRAINT `fk_account_log_loan_create1`
    FOREIGN KEY (`loan_create_id`)
    REFERENCES `samurdhi_bank`.`loan_create` (`idloan_create`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_account_log_customer1`
    FOREIGN KEY (`customer_id`)
    REFERENCES `samurdhi_bank`.`customer` (`idcustomer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `samurdhi_bank`.`privilege`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `samurdhi_bank`.`privilege` (
  `idprivilege` INT NOT NULL,
  `privilege` VARCHAR(100) NULL,
  PRIMARY KEY (`idprivilege`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `samurdhi_bank`.`privilege_has_role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `samurdhi_bank`.`privilege_has_role` (
  `privilege_idprivilege` INT NOT NULL,
  `role_idrole` INT NOT NULL,
  `status` TINYINT NULL,
  INDEX `fk_privilege_has_role_role1_idx` (`role_idrole` ASC) VISIBLE,
  INDEX `fk_privilege_has_role_privilege1_idx` (`privilege_idprivilege` ASC) VISIBLE,
  CONSTRAINT `fk_privilege_has_role_privilege1`
    FOREIGN KEY (`privilege_idprivilege`)
    REFERENCES `samurdhi_bank`.`privilege` (`idprivilege`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_privilege_has_role_role1`
    FOREIGN KEY (`role_idrole`)
    REFERENCES `samurdhi_bank`.`role` (`idrole`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
