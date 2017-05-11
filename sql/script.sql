CREATE DATABASE IF NOT EXISTS `simplonkids` CHARACTER SET 'utf8';
USE `simplonkids` ;

CREATE TABLE IF NOT EXISTS `kid` (
    id INT NOT NULL AUTO_INCREMENT,
    firstname VARCHAR(255 ) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    birthday DATE NOT NULL,
    classroom VARCHAR(255),
    PRIMARY KEY (`id`)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `address` (
  id INT NOT NULL AUTO_INCREMENT,
  address VARCHAR(255) NOT NULL,
  complement VARCHAR(255),
  city VARCHAR(255) NOT NULL,
  zipcode VARCHAR(5) NOT NULL,
  PRIMARY KEY (id)

)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `parent` (
  id INT NOT NULL AUTO_INCREMENT,
  firstname VARCHAR(255) NOT NULL,
  lastname VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  telephone VARCHAR(255) NOT NULL,
  address_id INT NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT `fk_parent_address`
    FOREIGN KEY (address_id)
    REFERENCES `address`(id)
  )
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `kid_has_parent` (
  kid_id INT NOT NULL,
  parent_id INT NOT NULL,
  CONSTRAINT `fk_kid_parent`
    FOREIGN KEY (kid_id)
    REFERENCES `kid`(id),
  CONSTRAINT `fk_parent_kid`
    FOREIGN KEY (parent_id)
    REFERENCES `parent`(id)
)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `public_age` (
  id INT NOT NULL AUTO_INCREMENT,
  start INT(3) NOT NULL,
  `end` INT(3) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `workshop_category` (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `establishment` (
  id INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  address_id INT NOT NULL UNIQUE ,
  PRIMARY KEY (id),
  CONSTRAINT `fk_establishment_address`
     FOREIGN KEY (address_id)
    REFERENCES address(id)
)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `workshop` (
  id INT NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  price DECIMAL(5,2) NOT NULL,
  max_kids INT NOT NULL,
  image VARCHAR(255),
  visible TINYINT,
  public_age_id INT NOT NULL,
  establishment_id INT NOT NULL,
  workshop_category_id INT NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT `fk_workshop_public_age`
    FOREIGN KEY (public_age_id)
    REFERENCES public_age(id),
  CONSTRAINT `fk_workshop_establishment`
    FOREIGN KEY (establishment_id)
    REFERENCES establishment(id),
  CONSTRAINT `fk_workshop_workshop_category_id`
    FOREIGN KEY (workshop_category_id)
    REFERENCES workshop_category(id)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `workshop_has_kid` (
  workshop_id INT NOT NULL,
  kid_id INT NOT NULL,
  has_participated TINYINT,
  validated TINYINT,
  CONSTRAINT `fk_workshop_kid`
    FOREIGN KEY (workshop_id)
    REFERENCES `workshop`(id),
  CONSTRAINT `fk_kid_workshop`
    FOREIGN KEY (kid_id)
    REFERENCES `kid`(id)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `timetable` (
  id INT NOT NULL AUTO_INCREMENT,
  startAt DATETIME NOT NULL ,
  endAt DATETIME NOT NULL,
  enable TINYINT,
  workshop_id INT NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT `fk_timetable_workshop`
    FOREIGN KEY (workshop_id)
    REFERENCES `workshop`(id)
)
ENGINE = InnoDB;

-- kid table data

INSERT INTO `kid`(firstname,lastname,birthday,classroom) VALUES
("Paul" , "Boyer" , "2008-05-01" , "CM1" ),
("Jean-Michel" , "Grondin" , "2007-01-15" , "CM2" ),
("Antoine" , "Riviere" , "2009-08-19" , "CE2" ),
("Alfredo" , "Kaporal" , "2012-12-24" , "CE2" );

-- address table data

INSERT INTO `address`(address,complement,city,zipcode) VALUES
("11 rue belzor" , "", "Saint-André","97440"),
("29 rue des quatres épices", "Plateau goyave", "Saint-Louis","97450"),
("49 avenue dubois", "", "Saint-Denis","97490"),
("99 rue groster", "endroit perdus", "Plaine des Palmistes","97431"),
("15 rue pomme", "endroit perdus", "Bras-Panon","97431");


-- parent table data

INSERT INTO `parent`(firstname,lastname,email,telephone,address_id) VALUES
("Marine","Grondin","marinegrondin@gmail.com","0692568547",3),
("Patrick","Riviere","patrickriviere@gmail.com","0692647925",2),
("Ceinture","Kaporal","ceinturekaporal@gmail.com","0692368159",4),
("Pierre","Boyer","pierreboyer@gmail.com","0692221145",1);

-- kid_has_parent table data

INSERT INTO `kid_has_parent`(kid_id,parent_id) VALUES
(1,4),
(2,1),
(3,2),
(4,3);

-- public age table data

INSERT INTO `public_age`(start,`end`) VALUES
(4,8),
(8,12),
(12,16);


-- establishment table data

INSERT INTO `establishment`(`name`,address_id) VALUES
("Simplon Reunion",5);

-- workshop category table data

INSERT INTO `workshop_category`(name) VALUES
("Debutant"),
("Intermediaire"),
("Difficile"),
("Insane");

-- workshop table data

INSERT INTO `workshop`(title,description,price,max_kids,image,visible,public_age_id,establishment_id,workshop_category_id) VALUES
("Code combat","Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ",9.99,30,"Workshop1.jpg",0,2,1,3),
("Scratch","Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ",20,15,"Workshop1.jpg",0,1,1,1),
("Algo","Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ",20,10,"Workshop1.jpg",0,1,1,4);

-- timetable table data

INSERT INTO `timetable`(startAt,endAt,`enable`,workshop_id) VALUES
("2017-05-15","2017-05-25",0,1),
("2017-06-15","2017-06-25",0,2),
("2017-07-15","2017-07-25",0,3);

-- workshop_has_kids table data

INSERT INTO `workshop_has_kid`(workshop_id,kid_id,has_participated,validated) VALUES
(1,2,0,0),
(2,4,0,0),
(3,1,0,0);



