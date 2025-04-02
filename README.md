Gestor de Tareas 📌
Este es mi primer proyecto con Oracle: un gestor de tareas desarrollado con PHP y Oracle. Permite organizar tareas con diferentes prioridades de manera eficiente e intuitiva.

📂 Instalación y configuración
Descarga el repositorio y extráelo en tu servidor local.

Configura la conexión a Oracle en el archivo config.php:

Usuario: ANDEL_DATABASE

Contraseña: 1212

(Si usas un usuario diferente, actualiza estos valores en config.php).

Ejecuta el script SQL para crear la tabla GESTION_TAREA en tu base de datos Oracle.

📌 Estructura de la tabla GESTION_TAREA
  (Export).
  CREATE TABLE "ANDEL_DATABASE"."GESTION_TAREA" 
   (	"ID_TAREA" NUMBER(*,0) GENERATED ALWAYS AS IDENTITY MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 1 CACHE 20 NOORDER  NOCYCLE  NOKEEP  NOSCALE , 
	"TITULO" VARCHAR2(200 BYTE), 
	"DESCRIPCION" CLOB, 
	"PRIORIDAD" VARCHAR2(50 BYTE), 
	"FECHA_CREACION" DATE DEFAULT SYSDATE
   ) SEGMENT CREATION DEFERRED 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 
 NOCOMPRESS LOGGING
  TABLESPACE "USERS" 
 LOB ("DESCRIPCION") STORE AS SECUREFILE (
  TABLESPACE "USERS" ENABLE STORAGE IN ROW 4000 CHUNK 8192
  NOCACHE LOGGING  NOCOMPRESS  KEEP_DUPLICATES ) ;
REM INSERTING into ANDEL_DATABASE.GESTION_TAREA
SET DEFINE OFF;
--------------------------------------------------------
--  Constraints for Table GESTION_TAREA
--------------------------------------------------------

  ALTER TABLE "ANDEL_DATABASE"."GESTION_TAREA" MODIFY ("ID_TAREA" NOT NULL ENABLE);
