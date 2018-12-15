SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';


-- -----------------------------------------------------
-- Table `samurdhi_bank`.`interest`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `samurdhi_bank`.`interest` (
  `idinterest` INT NOT NULL AUTO_INCREMENT ,
  `rate` FLOAT NULL ,
  `status` VARCHAR(45) NULL ,
  PRIMARY KEY (`idinterest`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `samurdhi_bank`.`loan_type`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `samurdhi_bank`.`loan_type` (
  `idloan_type` INT NOT NULL AUTO_INCREMENT ,
  `loan_name` VARCHAR(100) NULL ,
  `duration_min` INT NULL ,
  `duration_max` INT NULL ,
  `interest_min` FLOAT NULL ,
  `interest_max` FLOAT NULL ,
  `status` VARCHAR(45) NULL ,
  PRIMARY KEY (`idloan_type`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `samurdhi_bank`.`privilege`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `samurdhi_bank`.`privilege` (
  `idprivilege` INT NOT NULL AUTO_INCREMENT ,
  `privilege` VARCHAR(100) NULL ,
  `status` VARCHAR(45) NULL ,
  PRIMARY KEY (`idprivilege`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `samurdhi_bank`.`role`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `samurdhi_bank`.`role` (
  `idrole` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NULL ,
  `status` VARCHAR(45) NULL ,
  PRIMARY KEY (`idrole`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `samurdhi_bank`.`role_has_privilege`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `samurdhi_bank`.`role_has_privilege` (
  `role_idrole` INT NOT NULL ,
  `privilege_idprivilege` INT NOT NULL ,
  PRIMARY KEY (`role_idrole`, `privilege_idprivilege`) ,
  INDEX `fk_role_has_privilege_privilege1` (`privilege_idprivilege` ASC) ,
  INDEX `fk_role_has_privilege_role` (`role_idrole` ASC) ,
  CONSTRAINT `fk_role_has_privilege_role`
    FOREIGN KEY (`role_idrole` )
    REFERENCES `samurdhi_bank`.`role` (`idrole` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_role_has_privilege_privilege1`
    FOREIGN KEY (`privilege_idprivilege` )
    REFERENCES `samurdhi_bank`.`privilege` (`idprivilege` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `samurdhi_bank`.`user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `samurdhi_bank`.`user` (
  `iduser` INT NOT NULL AUTO_INCREMENT ,
  `role_idrole` INT NOT NULL ,
  `name` VARCHAR(100) NULL ,
  `password` VARCHAR(100) NULL ,
  `date` DATE NULL ,
  `status` VARCHAR(45) NULL ,
  PRIMARY KEY (`iduser`) ,
  INDEX `fk_user_role1` (`role_idrole` ASC) ,
  CONSTRAINT `fk_user_role1`
    FOREIGN KEY (`role_idrole` )
    REFERENCES `samurdhi_bank`.`role` (`idrole` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `samurdhi_bank`.`customer`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `samurdhi_bank`.`customer` (
  `idcustomer` INT NOT NULL ,
  `name` VARCHAR(100) NULL ,
  `nic` VARCHAR(45) NULL ,
  `date` DATE NULL ,
  `status` VARCHAR(45) NULL ,
  PRIMARY KEY (`idcustomer`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `samurdhi_bank`.`loan`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `samurdhi_bank`.`loan` (
  `idloan` INT NOT NULL AUTO_INCREMENT ,
  `customer_idcustomer` INT NOT NULL ,
  `loan_type_idloan_type` INT NOT NULL ,
  `interest_idinterest` INT NOT NULL ,
  `duratioin` VARCHAR(45) NULL ,
  `user_iduser` INT NOT NULL ,
  `status` VARCHAR(45) NULL ,
  PRIMARY KEY (`idloan`) ,
  INDEX `fk_loan_customer1` (`customer_idcustomer` ASC) ,
  INDEX `fk_loan_loan_type1` (`loan_type_idloan_type` ASC) ,
  INDEX `fk_loan_interest1` (`interest_idinterest` ASC) ,
  INDEX `fk_loan_user1` (`user_iduser` ASC) ,
  CONSTRAINT `fk_loan_customer1`
    FOREIGN KEY (`customer_idcustomer` )
    REFERENCES `samurdhi_bank`.`customer` (`idcustomer` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_loan_loan_type1`
    FOREIGN KEY (`loan_type_idloan_type` )
    REFERENCES `samurdhi_bank`.`loan_type` (`idloan_type` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_loan_interest1`
    FOREIGN KEY (`interest_idinterest` )
    REFERENCES `samurdhi_bank`.`interest` (`idinterest` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_loan_user1`
    FOREIGN KEY (`user_iduser` )
    REFERENCES `samurdhi_bank`.`user` (`iduser` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `samurdhi_bank`.`payment_log`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `samurdhi_bank`.`payment_log` (
  `idpayment_log` INT NOT NULL AUTO_INCREMENT ,
  `customer_idcustomer` INT NOT NULL ,
  `loan_idloan` INT NOT NULL ,
  `date` DATE NULL ,
  `premium` FLOAT NULL ,
  `interest` FLOAT NULL ,
  `panalty` FLOAT NULL ,
  `user_iduser` INT NOT NULL ,
  `status` VARCHAR(45) NULL ,
  PRIMARY KEY (`idpayment_log`) ,
  INDEX `fk_payment_log_customer1` (`customer_idcustomer` ASC) ,
  INDEX `fk_payment_log_loan1` (`loan_idloan` ASC) ,
  INDEX `fk_payment_log_user1` (`user_iduser` ASC) ,
  CONSTRAINT `fk_payment_log_customer1`
    FOREIGN KEY (`customer_idcustomer` )
    REFERENCES `samurdhi_bank`.`customer` (`idcustomer` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_payment_log_loan1`
    FOREIGN KEY (`loan_idloan` )
    REFERENCES `samurdhi_bank`.`loan` (`idloan` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_payment_log_user1`
    FOREIGN KEY (`user_iduser` )
    REFERENCES `samurdhi_bank`.`user` (`iduser` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
