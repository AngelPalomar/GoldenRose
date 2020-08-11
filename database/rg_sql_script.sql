CREATE DATABASE golden_rose;

CREATE TABLE accesos(
    id INT NOT NULL,
    tipoUsuario ENUM('cliente','empleado','admin') NOT NULL,
    url VARCHAR(256) NOT NULL,
    CONSTRAINT Index_PK_accesos PRIMARY KEY (id)
);

CREATE TABLE categoria(
    id INT NOT NULL,
    nombre VARCHAR(20) NOT NULL,
    CONSTRAINT index_PK_categoria PRIMARY KEY (id)
);

CREATE TABLE marca(
    id INT NOT NULL,
    nombre VARCHAR(20) NOT NULL,
    CONSTRAINT Index_PK_marca PRIMARY KEY (id)
);

CREATE TABLE producto(
    id INT NOT NULL,
    nombre VARCHAR(25) NOT NULL,
    precio FLOAT(10, 2) NOT NULL,
    costo FLOAT(10, 2) NOT NULL,
    descripcion VARCHAR(256) NOT NULL,
    descripcionAmpliada VARCHAR(512) NOT NULL,
    modelo VARCHAR(30) NOT NULL,
    pathImagen VARCHAR(216) NOT NULL,
    idCategoria INT NOT NULL,
    idMarca INT NOT NULL,
    estado ENUM('disponible', 'no_disponible') NOT NULL DEFAULT 'disponible',
    CONSTRAINT Index_PK_producto PRIMARY KEY (id),
    CONSTRAINT Index_producto_FK1_categoria FOREIGN KEY (idCategoria) REFERENCES categoria(id),
    CONSTRAINT Index_producto_FK2_marca FOREIGN KEY (idMarca) REFERENCES marca(id)
);

CREATE TABLE sucursal(
    id INT NOT NULL,
    nombre VARCHAR(20) NOT NULL,
    idDireccion INT NOT NULL,
    CONSTRAINT index_PK_sucursal PRIMARY KEY (id)
);

CREATE TABLE inventario(
    id INT NOT NULL,
    idProducto INT NOT NULL,
    idSucursal INT NOT NULL,
    cantidad INT DEFAULT 1,
    CONSTRAINT Index_PK_inventario PRIMARY KEY (id),
    CONSTRAINT Index_inventario_FK1_producto FOREIGN KEY (idProducto) REFERENCES producto(id),
    CONSTRAINT Index_inventario_FK2_sucursal FOREIGN KEY (idSucursal) REFERENCES sucursal(id)
);

CREATE TABLE usuario(
    id INT NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(50) NOT NULL,
    tipoUsuario ENUM('cliente','empleado','admin') NOT NULL DEFAULT 'cliente',
    nombre1 VARCHAR(20) NOT NULL,
    nombre2 VARCHAR(20),
    apellidoPaterno VARCHAR(20) NOT NULL,
    apellidoMaterno VARCHAR(20),
    fechaRegisro DATE NOT NULL,
    fechaUltimoAcceso DATE NOT NULL,
    estado ENUM('activo','inactivo') NOT NULL DEFAULT 'activo',
    idSucursal INT,
    CONSTRAINT Index_PK_usuario PRIMARY KEY (id),
    CONSTRAINT Index_usuario_FK1_sucursal FOREIGN KEY (idSucursal) REFERENCES sucursal (id)
);

CREATE TABLE venta(
    id INT NOT NULL,
    fecha DATE NOT NULL,
    monto FLOAT(10,2) NOT NULL,
    folioFactura VARCHAR(30),
    fechaFactura DATE,
    CONSTRAINT Index_PK_venta PRIMARY KEY (id)
);

CREATE TABLE detalle_venta(
    id INT NOT NULL,
    idVenta INT NOT NULL,
    idInventario INT NOT NULL,
    idUsuario INT,
    precioProducto FLOAT(10,2),
    cantidad INT,
    subtotal FLOAT(10, 2),
    CONSTRAINT Index_PK_producto PRIMARY KEY (id),
    CONSTRAINT Index_detalleVenta_FK1_venta FOREIGN KEY(idVenta) REFERENCES venta(id),
    CONSTRAINT Index_detalleVenta_FK2_inventario FOREIGN KEY(idInventario) REFERENCES inventario(id),
    CONSTRAINT fk3 FOREIGN KEY(idUsuario) REFERENCES usuario(id)
);

CREATE TABLE estado(
    id INT NOT NULL,
    nombre VARCHAR(20) NOT NULL,
    CONSTRAINT Index_PK_estado PRIMARY KEY (id)
);

CREATE TABLE municipio(
    id VARCHAR(6) NOT NULL,
    nombre VARCHAR(20) NOT NULL,
    idEstado INT NOT NULL,
    CONSTRAINT Index_PK_municipio PRIMARY KEY (id),
    CONSTRAINT Index_municipio_FK1_estado FOREIGN KEY (idEstado) REFERENCES estado(id)
);

CREATE TABLE direccion(
    id INT NOT NULL,
    calle VARCHAR(25) NOT NULL,
    numeroExterior VARCHAR(10) NOT NULL,
    numeroInterior VARCHAR(10),
    colonia VARCHAR(40) NOT NULL,
    codigoPostal VARCHAR(10) NOT NULL,
    idMunicipio VARCHAR(6) NOT NULL,
    idUsuario INT,
    CONSTRAINT Index_PK_direccion PRIMARY KEY (id),
    CONSTRAINT Index_direccion_FK1_municipio FOREIGN KEY(idMunicipio) REFERENCES municipio(id),
    CONSTRAINT Index_direccion_FK2_usuario FOREIGN KEY(idUsuario) REFERENCES usuario(id)
);

ALTER TABLE sucursal ADD CONSTRAINT Index_sucursal_FK1_direccion FOREIGN KEY(idDireccion) REFERENCES direccion(id); 

-- ############  PRODEDIMIENTOS, TRIGGERS, VISTAS Y CONSULTAS ############ --

--Vista que muestre historial de compras de los clientes

CREATE VIEW usu_comp AS
SELECT email, CONCAT(nombre1, " ", nombre2, " ", apellidopaterno, " ", apellidoMaterno) AS Nombre, venta.id AS CantidadCompras,
monto
FROM venta
INNER JOIN detalle_venta ON (detalle_venta.idVenta = venta.id)
INNER JOIN usuario ON (usuario.id = detalle_venta.idUsuario)
GROUP BY idusuario;

SELECT * FROM usu_comp;

--Vista que muestre ganancias ariba de 50 pesos de productos [Cruz]

CREATE VIEW ganancias_arriba AS
SELECT * 
FROM (
    SELECT producto.nombre as NOMBRE_PRODUCTO,
    precio AS PRECIO,
    costo AS COSTO,
    (precio - costo) AS GANANCIA,
    marca.nombre AS MARCA,
    categoria.nombre AS CATEGORIA
    FROM producto
    INNER JOIN marca ON (marca.id = producto.idMarca)
    INNER JOIN categoria ON (categoria.id = producto.idCategoria)
) AS Ficha
WHERE GANANCIA >= 10

SELECT * FROM ganancias_arriba

/*Consulta que muestre todos los usuarios que vivan en el Estado 
de querétaro pero no vivan en el municipio de querétaro [Cruz]*/

SELECT usuario.id, CONCAT(nombre1, " ", nombre2, " ", apellidopaterno, " ", apellidoMaterno) AS Nombre, 
direccion.calle, CONCAT(numeroExterior, " ", numeroInterior) AS Numero,
direccion.colonia, direccion.codigoPostal, CONCAT(municipio.nombre, ", ", estado.nombre) AS Entidad
FROM direccion 
INNER JOIN usuario ON (usuario.id = direccion.idUsuario)
INNER JOIN municipio ON (municipio.id = direccion.idMunicipio)
INNER JOIN estado ON (estado.id = municipio.idEstado)
WHERE idUsuario IN (
    SELECT idUsuario
    FROM direccion
    WHERE idUsuario NOT LIKE ""
) AND
estado.nombre LIKE "queretaro" AND
municipio.nombre NOT LIKE "queretaro"

/*Consulta que muestre la ganancia de un catálogo cuyo precios sean menores a 15 pesos [Cruz]*/

SELECT *,(PRECIO - COSTO) AS GANANCIA FROM (
    SELECT producto.nombre AS NOMBRE_PRODUCTO,
    producto.precio AS PRECIO,
    producto.costo AS COSTO,
    categoria.nombre AS CATEGORIA,
    marca.nombre AS MARCA
    FROM producto
    INNER JOIN categoria ON (categoria.id = producto.idCategoria)
    INNER JOIN marca ON (marca.id = producto.idMarca)
    ORDER BY producto.id
) AS Catalogo
WHERE (PRECIO - COSTO) <= 15

/*Procedimiento almacenado que cree clientes con una contraseña aleatoria con su dirección,
evitando la duplicidad de correos electrónicos [Cruz]*/

CREATE PROCEDURE alta_cliente(IN Email VARCHAR(50), IN Contrasena VARCHAR(50), IN Nombre1 VARCHAR(20),
    IN Nombre2 VARCHAR(20), IN ApellidoPaterno VARCHAR(20), IN ApellidoMaterno VARCHAR(20),
    IN Calle VARCHAR(25), IN NumeroExterior VARCHAR(10), IN NumeroInterior VARCHAR(10),
    IN Colonia VARCHAR(40), IN CodigoPostal VARCHAR(10), IN Municipio VARCHAR(20))
BEGIN

	DECLARE NewIdUsuario INT(10);
    DECLARE newIdDireccion INT(10);
   
   	DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
	   	SELECT 'ERROR' AS RESULT;
	   	ROLLBACK;
   	END;
   
   	DECLARE EXIT HANDLER FOR SQLWARNING
   	BEGIN
		SELECT 'ERROR' AS RESULT;
	   	ROLLBACK;
   	END;

        SET NewIdUsuario = (SELECT MAX(id) FROM usuario);
        SET newIdDireccion = (SELECT MAX(id) FROM direccion);

        IF NewIdUsuario IS NULL THEN
            SET NewIdUsuario = 1;
        ELSE
            SET NewIdUsuario = NewIdUsuario + 1;
        END IF;
       
       	IF newIdDireccion IS NULL THEN
            SET newIdDireccion = 1;
        ELSE 
            SET newIdDireccion = newIdDireccion + 1;
        END IF;
       
       	START TRANSACTION;

        INSERT INTO usuario (id, email, password, nombre1, nombre2, apellidoPaterno, 
        apellidoMaterno, fechaRegisro, fechaUltimoAcceso) VALUES (
            NewIdUsuario,
            Email,
            MD5(Contrasena),
            Nombre1,
            Nombre2,
            ApellidoPaterno,
            ApellidoMaterno,
            NOW(),
            NOW()
        );

        INSERT INTO direccion (id, calle, numeroExterior, numeroInterior, colonia, 
        codigoPostal, idMunicipio, idUsuario) VALUES (
            newIdDireccion,
            Calle,
            NumeroExterior,
            NumeroInterior,
            Colonia,
            CodigoPostal,
            Municipio,
            NewIdUsuario
        );
       
    SELECT 'OK' AS RESULT;
  
   	COMMIT;
END;

/*Procedimiento almacenado que consulte productos (omitir id, idCategorias) por categoría mostrando la
nombre de la marca [Erick]*/

CREATE PROCEDURE consulta_existencias_producto(IN Categ VARCHAR(20))
BEGIN
    SELECT pathimagen AS Imagen, producto.nombre AS Nombre_del_producto, categoria.nombre AS Categoria, 
    marca.nombre AS Marca, precio AS Precio, cantidad AS Existencias, sucursal.nombre AS Sucursal 
    FROM inventario
    INNER JOIN sucursal ON (sucursal.id = idSucursal)
    INNER JOIN producto ON (producto.id = idProducto)
    INNER JOIN categoria ON (categoria.id = idCategoria)
    INNER JOIN marca on(marca.id = idMarca)
    WHERE idCategoria IN (
        SELECT categoria.id FROM categoria WHERE categoria.nombre LIKE Categ
    );
END;

CALL consulta_existencias_producto("cat1");

/*Disparador que realiza una venta actualizando y verificando el inventario, el cliente no puede comprar
en más de dos sucursales [Erick]*/

CREATE TRIGGER nuevaVenta BEFORE INSERT ON detalle_venta
FOR EACH ROW
BEGIN
    DECLARE Stock INT;
    DECLARE ProductoElegido INT;
    DECLARE MaximoStock INT;
    DECLARE newIdDetalle INT;

    SET ProductoElegido = (SELECT idProducto FROM inventario WHERE id = new.idInventario);
    SET MaximoStock = (SELECT MAX(cantidad) FROM inventario WHERE idProducto = ProductoElegido);
    SET Stock = (SELECT SUM(cantidad) FROM inventario WHERE idProducto = ProductoElegido);
    SET newIdDetalle = (SELECT MAX(id) FROM detalle_venta);

    IF newIdDetalle IS NULL THEN 
        SET new.id = 1;
    ELSE
        SET new.id = newIdDetalle + 1;
    END IF;

    IF new.cantidad <= Stock THEN
        SET new.precioProducto = (
            SELECT DISTINCT(precio)
            FROM inventario
            INNER JOIN producto ON (producto.id = inventario.idproducto)
            WHERE producto.id = ProductoElegido AND inventario.cantidad = MaximoStock
        );
        SET new.subtotal = new.precioProducto * new.cantidad;
        SET new.idInventario = (SELECT MAX(id) FROM inventario WHERE cantidad = MaximoStock AND idProducto = ProductoElegido);
        IF new.cantidad <= MaximoStock THEN
            UPDATE inventario SET cantidad = cantidad - new.cantidad WHERE cantidad = MaximoStock AND idProducto = ProductoElegido;
            UPDATE venta SET monto = monto + new.subtotal WHERE id = new.idVenta;
        ELSE
            SET new.id = NULL;
        END IF;
    ELSE
        SET NEW.id=NULL;
    END IF;
END;

/*Disparador que calcule el precio de un producto a partir de un marjen de contribución fijo del 23% y un costo 
variable (100% - marjen) [Cruz]*/

CREATE TRIGGER calcularPrecioProducto BEFORE INSERT ON producto
FOR EACH ROW
BEGIN

    DECLARE MarjenContribucion FLOAT(4,2);
    DECLARE CostoVariable FLOAT(4,2);

    SET MarjenContribucion = 0.23;
    SET CostoVariable = 1.00 - MarjenContribucion;
    
    SET new.precio = new.costo / CostoVariable;

END;
