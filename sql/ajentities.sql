# phpMyAdmin MySQL-Dump
# version 2.3.0
# http://phpwizard.net/phpMyAdmin/
# http://www.phpmyadmin.net/ (download page)
#
# servidor: localhost
# Tiempo de generación: 17-08-2004 a las 16:35:37
# Versión del servidor: 3.23.58
# Versión de PHP: 4.3.4
# Base de datos : `ajentities`
# --------------------------------------------------------

#
# Estructura de tabla para la tabla `entities`
#

CREATE TABLE entities (
  Id int(11) NOT NULL auto_increment,
  Code varchar(30) NOT NULL default '',
  IdProject int(11) NOT NULL default '0',
  Description varchar(50) NOT NULL default '',
  Name varchar(50) NOT NULL default '',
  SetName varchar(50) NOT NULL default '',
  TableName varchar(50) NOT NULL default '',
  Descriptor varchar(50) NOT NULL default '',
  PluralDescriptor varchar(50) NOT NULL default '',
  Genre char(1) NOT NULL default '',
  Comments text NOT NULL,
  DateTimeInsert datetime NOT NULL default '0000-00-00 00:00:00',
  DateTimeUpdate datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (Id),
  KEY Code (Code)
) TYPE=MyISAM;

#
# Volcar la base de datos para la tabla `entities`
#

INSERT INTO entities VALUES (1, 'Noticia', 4, 'Noticias', 'noticia', 'noticias', 'noticias', 'Noticia', 'Noticias', 'F', 'Es la tabla de las noticias', '0000-00-00 00:00:00', '2004-08-15 19:00:42');
INSERT INTO entities VALUES (2, 'Usuario', 1, 'Usuario', 'usuario', 'usuarios', 'usuarios', 'Usuario', 'Usuarios', 'M', '', '0000-00-00 00:00:00', '2004-08-15 19:01:45');
INSERT INTO entities VALUES (3, 'Deposito', 2, 'Depósito', 'deposito', 'depositos', 'depositos', 'Depósito', 'Depósitos', 'M', '', '0000-00-00 00:00:00', '2004-08-15 18:53:49');
INSERT INTO entities VALUES (4, 'Articulo', 2, 'Artículo', 'articulo', 'articulos', 'articulos', 'Artículo', 'Artículos', 'M', '', '2004-08-15 14:14:44', '2004-08-15 18:53:02');
INSERT INTO entities VALUES (5, 'Provincia', 2, 'Provincia', 'provincia', 'provincias', 'provincias', 'Provincia', 'Provincias', 'F', '', '2004-08-15 14:59:00', '2004-08-15 19:01:01');
INSERT INTO entities VALUES (6, 'Proveedor', 2, 'Proveedor', 'proveedor', 'proveedores', 'proveedores', '', '', 'N', '', '2004-08-15 17:35:57', '2004-08-15 19:00:52');
INSERT INTO entities VALUES (7, 'Comprobante', 2, 'Comprobante', 'comprobante', 'comprobantes', 'comprobantes', '', '', 'N', '', '2004-08-15 17:42:44', '2004-08-15 18:49:58');
INSERT INTO entities VALUES (8, 'ComprobanteRenglon', 2, 'Renglon de Comprobante', 'comprobanterenglon', 'comprobanterenglones', 'comprobante_renglones', '', '', 'N', '', '2004-08-15 17:55:41', '2004-08-15 18:56:20');
INSERT INTO entities VALUES (9, 'Consorcio', 3, 'Consorcio', 'consorcio', 'consorcios', 'consorcios', '', '', 'M', '', '2004-08-15 17:59:15', '2004-08-15 18:57:23');
INSERT INTO entities VALUES (10, 'CategoriaNoticia', 4, 'Categoría de Noticia', 'noticiacategoria', 'noticiacategorias', 'noticia_categorias', 'Categoría de Noticia', 'Categorías de Noticias', 'F', '', '2004-08-15 19:07:29', '2004-08-15 19:07:29');
INSERT INTO entities VALUES (11, 'Categoria', 5, 'Categorías', 'categoria', 'categorias', 'categorias', 'Categoría', 'Categorías', 'F', '', '2004-08-16 17:13:31', '2004-08-16 17:13:31');
INSERT INTO entities VALUES (12, 'Proyecto', 5, 'Proyectos', 'proyecto', 'proyectos', 'projects', 'Proyecto', 'Proyectos', 'M', '', '2004-08-16 18:28:51', '2004-08-16 18:38:05');
# --------------------------------------------------------

#
# Estructura de tabla para la tabla `entity_fields`
#

CREATE TABLE entity_fields (
  Id int(11) NOT NULL auto_increment,
  IdEntity int(11) NOT NULL default '0',
  OrderNo int(11) NOT NULL default '0',
  Name varchar(50) NOT NULL default '',
  Description varchar(100) NOT NULL default '',
  Title varchar(100) NOT NULL default '',
  Legend varchar(100) NOT NULL default '',
  Type int(11) NOT NULL default '0',
  SqlType varchar(20) NOT NULL default '',
  SqlLength varchar(20) NOT NULL default '',
  Comments text NOT NULL,
  DateTimeInsert datetime NOT NULL default '0000-00-00 00:00:00',
  DateTimeUpdate datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (Id)
) TYPE=MyISAM;

#
# Volcar la base de datos para la tabla `entity_fields`
#

INSERT INTO entity_fields VALUES (1, 2, 1, 'Id', 'Id de Usuario', '', '', 4, 'int', '', '', '2004-08-15 14:53:53', '2004-08-15 17:45:59');
INSERT INTO entity_fields VALUES (2, 2, 4, 'Nombre', 'Nombre de Usuario', '', '', 1, 'varchar', '50', '', '2004-08-15 14:57:54', '2004-08-15 14:57:54');
INSERT INTO entity_fields VALUES (3, 5, 1, 'Id', 'Id', '', '', 4, 'int', '', '', '2004-08-15 14:59:46', '2004-08-15 17:45:44');
INSERT INTO entity_fields VALUES (4, 5, 2, 'Descripcion', 'Descripción', 'Descripción', 'Descripción', 1, 'varchar', '50', '', '2004-08-15 15:00:12', '2004-08-15 17:51:05');
INSERT INTO entity_fields VALUES (5, 1, 1, 'Id', '', '', '', 0, '', '', '', '2004-08-15 15:02:25', '2004-08-15 15:02:25');
INSERT INTO entity_fields VALUES (6, 1, 2, 'Titulo', 'Título', '', '', 0, 'varchar', '100', '', '2004-08-15 15:02:40', '2004-08-15 15:02:40');
INSERT INTO entity_fields VALUES (7, 1, 3, 'Resumen', 'Resumen', '', '', 1, 'text', '', '', '2004-08-15 15:02:52', '2004-08-15 15:02:52');
INSERT INTO entity_fields VALUES (8, 4, 1, 'Id', '', '', '', 4, 'int', '', '', '2004-08-15 15:04:42', '2004-08-15 17:46:14');
INSERT INTO entity_fields VALUES (9, 4, 2, 'Descripcion', '', '', '', 1, 'varchar', '50', '', '2004-08-15 15:04:54', '2004-08-15 17:31:02');
INSERT INTO entity_fields VALUES (10, 3, 1, 'Id', '', '', '', 4, 'int', '', '', '2004-08-15 15:16:45', '2004-08-15 17:58:55');
INSERT INTO entity_fields VALUES (11, 3, 2, 'Descripcion', '', '', '', 1, 'varchar', '50', '', '2004-08-15 15:16:53', '2004-08-15 18:28:29');
INSERT INTO entity_fields VALUES (19, 4, 3, 'IdCategoria', '', '', '', 4, 'int', '', '', '2004-08-15 17:32:52', '2004-08-15 17:46:23');
INSERT INTO entity_fields VALUES (18, 4, 5, 'Detalle', '', '', '', 1, 'text', '', '', '2004-08-15 17:32:35', '2004-08-15 17:32:35');
INSERT INTO entity_fields VALUES (15, 4, 6, 'Comentarios', '', '', '', 1, 'text', '', '', '2004-08-15 17:30:35', '2004-08-15 17:30:35');
INSERT INTO entity_fields VALUES (16, 4, 4, 'Precio', '', '', '', 2, 'decimal', '10,2', '', '2004-08-15 17:30:54', '2004-08-15 18:14:31');
INSERT INTO entity_fields VALUES (20, 6, 1, 'Id', '', '', '', 4, 'int', '', '', '2004-08-15 17:36:11', '2004-08-15 17:51:56');
INSERT INTO entity_fields VALUES (21, 6, 2, 'Nombre', '', '', '', 1, 'varchar', '100', '', '2004-08-15 17:36:17', '2004-08-15 17:52:12');
INSERT INTO entity_fields VALUES (22, 6, 3, 'Domicilio', '', '', '', 1, 'varchar', '100', '', '2004-08-15 17:36:22', '2004-08-15 17:52:19');
INSERT INTO entity_fields VALUES (23, 6, 4, 'Localidad', '', '', '', 1, 'varchar', '50', '', '2004-08-15 17:36:26', '2004-08-15 17:52:27');
INSERT INTO entity_fields VALUES (24, 6, 5, 'CodPostal', '', '', '', 1, 'varchar', '20', '', '2004-08-15 17:36:34', '2004-08-15 17:52:33');
INSERT INTO entity_fields VALUES (25, 7, 1, 'Id', '', '', '', 4, 'int', '', '', '2004-08-15 17:42:54', '2004-08-15 17:45:12');
INSERT INTO entity_fields VALUES (26, 6, 6, 'IdProvincia', 'Provincia', 'Provincia', 'Provincia', 4, 'int', '', '', '2004-08-15 17:51:44', '2004-08-15 17:51:44');
INSERT INTO entity_fields VALUES (27, 7, 2, 'Tipo', '', '', '', 1, 'char', '2', '', '2004-08-15 17:53:46', '2004-08-15 17:53:46');
INSERT INTO entity_fields VALUES (28, 7, 3, 'Sucursal', '', '', '', 1, 'char', '4', '', '2004-08-15 17:53:54', '2004-08-15 17:53:54');
INSERT INTO entity_fields VALUES (29, 7, 4, 'Numero', 'Número de Comprobante', '', '', 1, 'char', '8', '', '2004-08-15 17:54:08', '2004-08-15 17:54:08');
INSERT INTO entity_fields VALUES (30, 2, 2, 'Codigo', 'Código', 'Código', 'Código', 1, 'varchar', '16', '', '2004-08-15 18:08:14', '2004-08-15 18:08:14');
INSERT INTO entity_fields VALUES (31, 2, 3, 'Contrasenia', 'Contraseña', '', '', 1, 'varchar', '16', '', '2004-08-15 18:08:30', '2004-08-15 18:08:30');
INSERT INTO entity_fields VALUES (32, 2, 5, 'Email', 'Email', '', '', 1, 'varchar', '100', '', '2004-08-15 18:08:41', '2004-08-15 18:08:41');
INSERT INTO entity_fields VALUES (33, 9, 1, 'Id', '', '', '', 4, 'int', '', '', '2004-08-15 18:56:33', '2004-08-15 18:56:33');
INSERT INTO entity_fields VALUES (34, 9, 2, 'Descripcion', 'Descripción', '', '', 1, 'varchar', '50', '', '2004-08-15 18:56:47', '2004-08-15 18:56:47');
INSERT INTO entity_fields VALUES (35, 1, 4, 'Autor', '', '', '', 1, 'varchar', '100', '', '2004-08-15 19:04:40', '2004-08-15 19:04:40');
INSERT INTO entity_fields VALUES (36, 1, 5, 'Visitas', '', '', '', 2, 'int', '', '', '2004-08-15 19:04:48', '2004-08-15 19:04:48');
INSERT INTO entity_fields VALUES (37, 10, 1, 'Id', '', '', '', 4, 'int', '', '', '2004-08-15 19:07:42', '2004-08-15 19:07:42');
INSERT INTO entity_fields VALUES (38, 10, 2, 'Descripcion', '', '', '', 1, 'varchar', '50', '', '2004-08-15 19:07:52', '2004-08-15 19:07:52');
INSERT INTO entity_fields VALUES (39, 11, 1, 'Id', '', '', '', 4, 'int', '', '', '2004-08-16 18:14:38', '2004-08-16 18:14:38');
INSERT INTO entity_fields VALUES (40, 11, 2, 'Descripcion', 'Descripción', '', '', 1, 'varchar', '50', '', '2004-08-16 18:14:54', '2004-08-16 18:14:54');
INSERT INTO entity_fields VALUES (41, 12, 1, 'Id', '', '', '', 4, 'int', '', '', '2004-08-16 18:52:11', '2004-08-16 18:52:11');
INSERT INTO entity_fields VALUES (42, 12, 2, 'Code', 'Código', '', '', 1, 'varchar', '16', '', '2004-08-16 18:52:23', '2004-08-16 18:53:35');
INSERT INTO entity_fields VALUES (43, 12, 3, 'Description', 'Descripción', '', '', 1, 'varchar', '100', '', '2004-08-16 18:52:52', '2004-08-16 18:52:52');
INSERT INTO entity_fields VALUES (44, 12, 4, 'DataBaseName', 'Nombre de la Base de Datos', '', '', 1, 'varchar', '100', '', '2004-08-16 19:23:41', '2004-08-16 19:23:41');
# --------------------------------------------------------

#
# Estructura de tabla para la tabla `entity_relations`
#

CREATE TABLE entity_relations (
  Id int(11) NOT NULL auto_increment,
  Description varchar(100) NOT NULL default '',
  IdEntity1 int(11) NOT NULL default '0',
  Fields1 varchar(100) NOT NULL default '',
  IdEntity2 int(11) NOT NULL default '0',
  Fields2 varchar(100) NOT NULL default '',
  Type int(11) NOT NULL default '0',
  OrderBy varchar(100) NOT NULL default '',
  DateTimeInsert datetime NOT NULL default '0000-00-00 00:00:00',
  DateTimeUpdate datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (Id)
) TYPE=MyISAM;

#
# Volcar la base de datos para la tabla `entity_relations`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `projects`
#

CREATE TABLE projects (
  Id int(11) NOT NULL auto_increment,
  Code varchar(30) NOT NULL default '',
  Description varchar(100) NOT NULL default '',
  DataBaseName varchar(100) NOT NULL default '',
  TablePrefix varchar(20) NOT NULL default '',
  FileSystem varchar(100) NOT NULL default '',
  Comments text NOT NULL,
  DateTimeInsert datetime NOT NULL default '0000-00-00 00:00:00',
  DateTimeUpdate datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (Id),
  UNIQUE KEY Code (Code)
) TYPE=MyISAM;

#
# Volcar la base de datos para la tabla `projects`
#

INSERT INTO projects VALUES (1, 'ajfiles', 'AjFiles', '', '', '', '', '2004-08-15 18:23:39', '2004-08-15 18:23:39');
INSERT INTO projects VALUES (2, 'ajstock', 'AjStock', 'ajstock', '', 'c:\\inetpub\\wwwroot\\ajstock', '', '2004-08-15 18:24:05', '2004-08-15 18:24:05');
INSERT INTO projects VALUES (3, 'ajconsor', 'AjConsor', 'ajconsor', '', 'c:\\inetpub\\wwwroot\\ajconsorphp', '', '2004-08-15 18:57:11', '2004-08-15 18:57:11');
INSERT INTO projects VALUES (4, 'ajnoticias', 'AjNoticias', 'ajnoticias', '', 'c:\\inetpub\\wwwroot\\ajnoticiasphp', '', '2004-08-15 18:59:40', '2004-08-15 18:59:40');
INSERT INTO projects VALUES (5, 'ajentities', 'Generador de Entidades', 'ajentities', '', 'c:\\inetpub\\wwwroot\\ajentitiesphp', '', '2004-08-16 17:12:49', '2004-08-16 18:13:10');
# --------------------------------------------------------

#
# Estructura de tabla para la tabla `users`
#

CREATE TABLE users (
  Id int(11) NOT NULL auto_increment,
  UserName varchar(16) NOT NULL default '',
  Password varchar(16) NOT NULL default '',
  FirstName varchar(40) NOT NULL default '',
  LastName varchar(40) NOT NULL default '',
  Email varchar(50) NOT NULL default '',
  Reference char(2) NOT NULL default '',
  Comments text NOT NULL,
  IdGenre tinyint(4) NOT NULL default '0',
  IdCountry int(11) NOT NULL default '0',
  State varchar(30) NOT NULL default '',
  City varchar(40) NOT NULL default '',
  ZipCode varchar(10) NOT NULL default '',
  DateBorn date NOT NULL default '0000-00-00',
  IsAdministrator tinyint(4) NOT NULL default '0',
  IsTeacher tinyint(4) NOT NULL default '0',
  DateTimeInsert datetime NOT NULL default '0000-00-00 00:00:00',
  DateTimeUpdate datetime NOT NULL default '0000-00-00 00:00:00',
  DateTimeLastLogin datetime NOT NULL default '0000-00-00 00:00:00',
  LoginCount int(11) NOT NULL default '0',
  Verified tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (Id),
  UNIQUE KEY UserName (UserName)
) TYPE=MyISAM;

#
# Volcar la base de datos para la tabla `users`
#

INSERT INTO users VALUES (1, 'ajlopez', 'ajlopez', 'Angel', 'Lopez', '', '', '', 0, 1, '', '', '', '0000-00-00', 1, 0, '2004-08-01 11:49:01', '2004-08-01 11:49:01', '2004-08-08 12:01:01', 9, 0);
# --------------------------------------------------------

#
# Estructura de tabla para la tabla `view_fields`
#

CREATE TABLE view_fields (
  Id int(11) NOT NULL auto_increment,
  IdView int(11) NOT NULL default '0',
  OrderNo int(11) NOT NULL default '0',
  IdField int(11) NOT NULL default '0',
  Link varchar(100) NOT NULL default '',
  IdLinkField int(11) NOT NULL default '0',
  Contents varchar(100) NOT NULL default '',
  Title varchar(100) NOT NULL default '',
  Legend varchar(100) NOT NULL default '',
  IsRequired tinyint(4) NOT NULL default '0',
  IsReadOnly tinyint(4) NOT NULL default '0',
  IsHidden tinyint(4) NOT NULL default '0',
  Comments text NOT NULL,
  DateTimeInsert datetime NOT NULL default '0000-00-00 00:00:00',
  DateTimeUpdate datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (Id)
) TYPE=MyISAM;

#
# Volcar la base de datos para la tabla `view_fields`
#

# --------------------------------------------------------

#
# Estructura de tabla para la tabla `views`
#

CREATE TABLE views (
  Id int(11) NOT NULL auto_increment,
  Code varchar(30) NOT NULL default '',
  IdEntity int(11) NOT NULL default '0',
  Description varchar(50) NOT NULL default '',
  Comments text NOT NULL,
  DateTimeInsert datetime NOT NULL default '0000-00-00 00:00:00',
  DateTimeUpdate datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (Id),
  KEY Code (Code)
) TYPE=MyISAM;

#
# Volcar la base de datos para la tabla `views`
#

INSERT INTO views VALUES (3, 'Proyecto', 12, 'Proyecto', '', '2004-08-17 14:38:11', '2004-08-17 14:38:11');
INSERT INTO views VALUES (4, 'Consorcio', 9, 'Consorcio', '', '2004-08-17 14:39:10', '2004-08-17 14:39:10');
INSERT INTO views VALUES (5, 'ProyectoLista', 12, 'Lista de Proyectos', '', '2004-08-17 15:11:49', '2004-08-17 15:11:49');
INSERT INTO views VALUES (6, 'ArticuloLista', 4, 'Lista de Artículos', '', '2004-08-17 15:21:45', '2004-08-17 15:21:45');

