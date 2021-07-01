create database IF NOT EXISTS `aluno`;

USE `aluno`;

CREATE TABLE `aluno` (
          aluno int(11) NOT NULL auto_increment,
          nome varchar(100) NOT NULL,
          data_nasc date default NULL,
          rua varchar(100) default NULL,
          numero varchar(10) default NULL,
          complemento varchar(20) default NULL,
          bairro varchar(30) default NULL,
          cidade varchar(30) default NULL,
          uf varchar(2) default NULL,
          PRIMARY KEY  (aluno)
        ) ;