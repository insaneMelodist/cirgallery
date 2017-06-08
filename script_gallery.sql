/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de cr�ation :  01/06/2017 08:51:13                      */
/*==============================================================*/


drop table if exists COMMENTAIRE;

drop table if exists PHOTO;

/*==============================================================*/
/* Table : PHOTO                                                */
/*==============================================================*/
create table PHOTO
(
   ID_PHOTO             int not null auto_increment,
   ADRESSE              varchar(100),
   TITRE                varchar(20),
   primary key (ID_PHOTO)
);

/*==============================================================*/
/* Table : COMMENTAIRE                                          */
/*==============================================================*/
create table COMMENTAIRE
(
   ID_COMMENTAIRE       int not null auto_increment,
   ID_PHOTO             int not null,
   TEXTE                varchar(140),
   primary key (ID_COMMENTAIRE)
);

alter table COMMENTAIRE add constraint FK_ASSOCIATION_1 foreign key (ID_PHOTO)
      references PHOTO (ID_PHOTO) on delete restrict on update restrict;

/*----------------------------Insertions----------------------------*/
insert into PHOTO(ADRESSE, TITRE) values("resources/EmoteAH.png", "Ah");
insert into PHOTO(ADRESSE, TITRE) values("resources/favicon.png", "Logo Cir Gallery");
insert into PHOTO(ADRESSE, TITRE) values("resources/PhotoBDE.jpg", "BDE PLAY");

insert into COMMENTAIRE(ID_PHOTO, TEXTE) values(1, "ça veut dire que les femmes ne savent pas faire une cabane ?");
insert into COMMENTAIRE(ID_PHOTO, TEXTE) values(2, "Magnifique image !");
insert into COMMENTAIRE(ID_PHOTO, TEXTE) values(3, "Wouah le gars tout à gauche il est trop beau ! <3");
