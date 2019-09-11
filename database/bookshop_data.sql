


INSERT INTO authors VALUES(1,"George Schlossnagle");
INSERT INTO authors VALUES(2,"Matt Doyle");
INSERT INTO authors VALUES(3,"Antonio Lopez");
INSERT INTO authors VALUES(4,"William Sanders");
INSERT INTO authors VALUES(5,"Y. Daniel Liang");
INSERT INTO authors VALUES(6,"Stephen Prata");
INSERT INTO authors VALUES(7,"Behrouz A. Forouzan");
INSERT INTO authors VALUES(8,"Charles K. Alexander , Matthew N. O. Sadiku");
INSERT INTO authors VALUES(9,"J. DAVID IRWIN , R. MARK NELMS");
INSERT INTO authors VALUES(10,"Robert Love");
INSERT INTO authors VALUES(11,"Marko Gargenta");
INSERT INTO authors VALUES(12,"Steven C.Chapra");
INSERT INTO authors VALUES(13,"Robert Boylestad ,Louis Nashelsky");
INSERT INTO authors VALUES(14,"Kenneth H.Rosen");
INSERT INTO authors VALUES(15,"Seymour Lipschutz,Marc Lars Lipson");




INSERT INTO publishers VALUES(1,"Sams Publishing","www.samspublishing.com");
INSERT INTO publishers VALUES(2,"Wiley Publishing, Inc.","www.wiley.com");
INSERT INTO publishers VALUES(3,"Packt Publishing Ltd.","www.packtpub.com");
INSERT INTO publishers VALUES(4,"O’Reilly Media, Inc.","my.safaribooksonline.com");
INSERT INTO publishers VALUES(5,"Pearson Education, Inc.","www.pearsonhighered.com");
INSERT INTO publishers VALUES(6,"McGraw-Hill Companies,Inc.","");
INSERT INTO publishers VALUES(7,"The MIT Press","");
INSERT INTO publishers VALUES(8,"Prentice-Hall,inc.","");




INSERT INTO category VALUES (1,"Computer Science and Engineering");
INSERT INTO category VALUES (2,"Electrical and Electronic Engineering");
INSERT INTO category VALUES (3,"Physic");
INSERT INTO category VALUES (4,"Civil");
INSERT INTO category VALUES (5,"Math");




INSERT INTO sub_category VALUES ("cse-1",1,"Web Development");
INSERT INTO sub_category VALUES ("cse-2",1,"Operating System");
INSERT INTO sub_category VALUES ("cse-3",1,"Networking");
INSERT INTO sub_category VALUES ("cse-4",1,"Programming Language");
INSERT INTO sub_category VALUES ("cse-5",1,"Algorithm");
INSERT INTO sub_category VALUES ("cse-6",1,"Data Structure");
INSERT INTO sub_category VALUES ("cse-7",1,"Android");
INSERT INTO sub_category VALUES ("cse-8",1,"Database Management System");
INSERT INTO sub_category VALUES ("eee-1",2,"Circuit");




INSERT INTO books  VALUES ("cse-1","Beginning PHP 5.3",2,2,1,400,"Beginning PHP 5.3.jpg");
INSERT INTO books  VALUES ("cse-2","Advanced PHP Programming",1,1,1,450,"Advanced PHP Programming.jpg");
INSERT INTO books  VALUES ("cse-3","Learning PHP 7",3,3,1,300,"Learning PHP 7.jpg");
INSERT INTO books  VALUES ("cse-4","Learning PHP Design Patterns",4,4,1,350,"Learning PHP Design Patterns.jpg");
INSERT INTO books  VALUES ("cse-5","Introduction To Java Progrmming",5,5,1,500,"Introduction To Java Progrmming.jpg");
INSERT INTO books  VALUES ("cse-6","C++ Primer Plus",6,1,1,400,"C++ Primer Plus.jpg");
INSERT INTO books  VALUES ("cse-7","Data Communication and Networking",7,6,1,250,"Data Communication and Networking.jpg");
INSERT INTO books  VALUES ("cse-8","Linux Kernel Development",10,5,1,200,"Linux Kernel Development.jpg");
INSERT INTO books  VALUES ("cse-9","Learning Android",11,4,1,400,"Learning Android.jpg");

INSERT INTO books  VALUES ("eee-1","Fundamentals of Electric Circuits",8,6,2,400,"Fundamentals of Electric Circuits.jpg");
INSERT INTO books  VALUES ("eee-2","BASIC ENGINEERING CIRCUIT ANALYSIS",9,2,2,400,"Basic Engineering Circut Analysis.jpg");

INSERT INTO books VALUES("math-1","Elementary Number Theory and Its Application",14,2,5,250,"Elementary Number Theory and Its Application.jpg");
INSERT INTO books VALUES("math-2","SCHAUM'S OUTLINE DISCRETE MATHEMATICS",15,6,5,300,"SCHAUM'S OUTLINE DISCRETE MATHEMATICS.jpg");
INSERT INTO books VALUES("math-3","Discrete Mathematics and Its Applications ",14,6,5,200,"Discrete Mathematics and Its Applications.jpg");
INSERT INTO books VALUES("math-4","Applied Numerical Methods",12,6,5,300,"Applied Numerical Methods.jpg");

INSERT INTO books  VALUES ('phy-1','Advance in Medical physic',1,2,3,100,'Advance in Medical physic.jpg');
INSERT INTO books  VALUES ('phy-2','All in one Physic',1,1,3,200,'All in one Physic.jpg');
INSERT INTO books  VALUES ('phy-3','Heinemann physic 11',1,4,3,300,'Heinemann physic 11.jpg');
INSERT INTO books  VALUES ('phy-4','Modern physics',1,6,3,150,'Modern physics.jpg');
INSERT INTO books  VALUES ('phy-5','Drawing physicsa',1,5,3,250,'Drawing physicsa.jpg');

INSERT INTO books  VALUES ('civ-1','Civil Engineering Formulas',1,3,4,300,'Civil Engineering Formulas.jpg');
INSERT INTO books  VALUES ('civ-2','Structural Analusis',1,2,4,350,'Structural Analusis.jpg');
INSERT INTO books  VALUES ('civ-3','Basic Civil Engineering',1,7,4,300,'Basic Civil Engineering.jpg');
INSERT INTO books  VALUES ('civ-4','Civil Practice Problems',1,8,4,260,'Civil Practice Problems.jpg');
INSERT INTO books  VALUES ('civ-5','Building Design and Construction Handbook',1,2,4,200,'Building Design and Construction Handbook.jpg');
