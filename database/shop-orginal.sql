 CREATE TABLE Users(
     
    User_id     int  AUTO_INCREMENT,
    First_name  varchar(30),
    Last_name   varchar(15),
    Password    varchar(300),
    Phone       varchar (20),
    Email       varchar(50),
    City        varchar (100),	
    /*-- address  needed  --*/
    CONSTRAINT user_pk PRIMARY key (User_id)
    
    
);

 CREATE  TABLE  Authors(
  
     Author_id         int,
     Name         varchar(1000),
     /*--Url          varchar(100),--
     --url can be replaced by email --*/
     CONSTRAINT Authors_pk PRIMARY key (Author_id)

  );
  
  CREATE  TABLE Publishers(
  
     Publisher_id   int , 
     Name           varchar(500),	 
     Url            varchar(200), 
	/* --Mail           varchar (200),--
     -- address might be added--
     -- email might be added --	 */
     CONSTRAINT Publishers_pk PRIMARY key (Publisher_id)
  
  );
  
    CREATE  TABLE Category(
  
       Category_id        int,
       Name        varchar(300),
      
       CONSTRAINT Category_pk PRIMARY key (Category_id)
  );
  
   CREATE  TABLE Sub_category(
   
         Sub_category_id      varchar(11),
         Category_id           int ,
         Name           varchar(100),
       
       CONSTRAINT Sub_category_pk PRIMARY key (Sub_category_id),
       CONSTRAINT Sub_category_fk FOREIGN KEY (Category_id) REFERENCES Category (Category_id)
   );
   
     
  CREATE TABLE Books (
  
        Book_id        varchar (20),
        Book_title     varchar (1000), 
        Author_id      int         ,
        Publisher_id   int         ,
        Category_id    int         ,
        price          double     ,
		img_name       varchar(50),
		
	/*-- Review         varchar(300),--*/
      
      CONSTRAINT Books_pk  PRIMARY KEY (Book_id),
      CONSTRAINT Books_fkA FOREIGN KEY (Author_id) REFERENCES Authors (Author_id),
      CONSTRAINT Books_fkP FOREIGN KEY (Publisher_id) REFERENCES Publishers (Publisher_id),
      CONSTRAINT Books_fkC FOREIGN KEY (Category_id) REFERENCES Category (Category_id)
  
  );
  
   create table review (
   comment_id    int AUTO_INCREMENT,
   user_id       int , 
   book_id       varchar(20),
   comments      varchar(1000), 
   /*--rating can be added --*/
   CONSTRAINT review_pk  PRIMARY KEY (comment_id),
   CONSTRAINT review_fkU FOREIGN KEY (user_id) REFERENCES users (User_id),
   CONSTRAINT review_fkB FOREIGN KEY (book_id) REFERENCES books (Book_id)
   
   );

  create TABLE orders(

    order_id      int  AUTO_INCREMENT ,
    user_id       int ,
    order_date    date,
    total_qnt     int ,
    total_price   float,
    
    CONSTRAINT orders_pk  PRIMARY key (order_id),
    CONSTRAINT orders_fk  FOREIGN KEY (user_id) REFERENCES users (User_id)
);

CREATE TABLE order_item(

    order_id   int ,
    book_id   varchar(20) ,
    quantity  int ,
	price     float,
    CONSTRAINT  order_item_fk  FOREIGN KEY (order_id) REFERENCES orders(order_id),
    CONSTRAINT  order_item_fk2  FOREIGN KEY (book_id) REFERENCES books(Book_id)
    
);

CREATE TABLE G_user (
             id       int AUTO_INCREMENT ,
             Name    varchar(50),
             phone   varchar(20),
             email   varchar(30),
             city    varchar(50),
             district varchar(50),
             divition  varchar(50),
             order_id   int ,
    
    
    CONSTRAINT G_userpk  PRIMARY key (id) ,
    CONSTRAINT G_userfk  FOREIGN key (order_id) REFERENCES orders(order_id)
             
);