

-- ==========================================================
-- Tabla de Usuarios
-- ==========================================================



 -- Autor: Humberto Amilcar (Senior PHP/MySQL) 
 -- ============================================================================ 
 DROP DATABASE IF EXISTS trazabilidad; 
 CREATE DATABASE trazabilidad CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci; 
 USE trazabilidad; 
 -- ============================================================================ 
 -- TABLA EMPRESAS 
 -- ============================================================================ 
CREATE TABLE empresas ( 
    id_empresa BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
    razon_social VARCHAR(200) NOT NULL, 
    ruc VARCHAR(20) NOT NULL UNIQUE, 
    direccion VARCHAR(255) NULL, 
    telefono VARCHAR(20) NULL, 
    correo VARCHAR(150) NULL, 
    logo VARCHAR(255) NULL, 
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ) 
ENGINE=InnoDB; 

INSERT INTO empresas (razon_social, ruc, direccion, telefono, correo, logo) VALUES 
('AgroAndes SAC','20123456789','Av. Principal 123, Lima','999111222','contacto@agroandes.com','logo1.png'), 
('Frutas del Sol SAC','20234567890','Jr. Comercio 456, Arequipa','988111222','ventas@frutassol.com','logo2.png'), 
('Pesquera Pacífico','20345678901','Malecón 789, Callao','977111222','info@pacifico.com','logo3.png'), 
('Lácteos Sierra','20456789012','Carretera Central km 10, Junín','966111222','ventas@lacteossi.com','logo4.png'), 
('Café Amazónico','20567890123','Plaza de Armas 22, Amazonas','955111222','info@cafeamazon.com','logo5.png'), 
('Textiles Inca','20678901234','Av. Los Héroes 444, Cusco','944111222','ventas@textilesinca.com','logo6.png'), 
('Bebidas Naturales','20789012345','Jr. Salud 55, Piura','933111222','ventas@bebidas.com','logo7.png'), 
('Farmagro SAC','20890123456','Av. La Salud 900, Lima','922111222','info@farmagro.com','logo8.png'), 
('Avícola El Gran Pollo','20901234567','Jr. Libertad 123, Ica','911111222','ventas@granpollo.com','logo9.png'), 
('Minera Andina','21012345678','Av. Industrial 890, Cajamarca','900111222','info@mineraandina.com','logo10.png'); 
-- ============================================================================ 
-- TABLA USUARIOS 
-- ============================================================================ 
CREATE TABLE usuarios (
    id_usuario BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    id_empresa BIGINT UNSIGNED NOT NULL,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    documento VARCHAR(20) UNIQUE NOT NULL,
    foto VARCHAR(100),
    celular VARCHAR(20) UNIQUE,
    correo VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('ADMINISTRADOR','OPERADOR','USUARIO','CLIENTE')  DEFAULT 'OPERADOR',
    activo TINYINT(1) NOT NULL DEFAULT 1,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_usuarios_empresa FOREIGN KEY (id_empresa) 
        REFERENCES empresas (id_empresa) 
        ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO usuarios (id_empresa, nombres, apellidos, documento, celular, correo, password, rol, foto) VALUES 
(1,'Juan','Pérez','12345678','999000111','juan.perez@agroandes.com','hash1','ADMINISTRADOR','juan.png'), 
(1,'María','López','23456789','988000111','maria.lopez@agroandes.com','hash2','OPERADOR','maria.png'), 
(2,'Carlos','Sánchez','34567890','977000111','carlos.sanchez@frutassol.com','hash3','ADMINISTRADOR','carlos.png'), 
(2,'Lucía','Fernández','45678901','966000111','lucia.fernandez@frutassol.com','hash4','OPERADOR','lucia.png'), 
(3,'Pedro','Ramírez','56789012','955000111','pedro.ramirez@pacifico.com','hash5','ADMINISTRADOR','pedro.png'), 
(3,'Ana','Torres','67890123','944000111','ana.torres@pacifico.com','hash6','OPERADOR','ana.png'), 
(4,'José','Castro','78901234','933000111','jose.castro@lacteossi.com','hash7','ADMINISTRADOR','jose.png'), 
(5,'Elena','García','89012345','922000111','elena.garcia@cafeamazon.com','hash8','CLIENTE','elena.png'), 
(6,'Miguel','Hernández','90123456','911000111','miguel.hernandez@textilesinca.com','hash9','OPERADOR','miguel.png'), 
(7,'Laura','Martínez','01234567','900000111','laura.martinez@bebidas.com','hash10','ADMINISTRADOR','laura.png'); 
-- ============================================================================ 
-- TABLA PRODUCTOS 
-- ============================================================================ 
CREATE TABLE productos ( 
    id_producto BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
    id_empresa BIGINT UNSIGNED NOT NULL, 
    gtin VARCHAR(14) NULL, 
    sku VARCHAR(64) NULL, 
    nombre VARCHAR(200) NOT NULL, 
    descripcion TEXT NULL, 
    imagen VARCHAR(255) NULL, 
    activo TINYINT(1) NOT NULL DEFAULT 1, 
    UNIQUE KEY ux_productos_sku (sku), 
    UNIQUE KEY ux_productos_gtin (gtin), 
    FOREIGN KEY (id_empresa) 
    REFERENCES empresas(id_empresa) 
    ON UPDATE CASCADE ON DELETE CASCADE ) 
ENGINE=InnoDB; 

INSERT INTO productos (id_empresa, gtin, sku, nombre, descripcion, imagen) VALUES 
(1,'7750000000012','SKU001','Papa Andina','Papa blanca seleccionada','papa.png'), 
(1,'7750000000029','SKU002','Maíz Amarillo','Grano seco de maíz amarillo','maiz.png'), 
(2,'7750000000036','SKU003','Mango Kent','Mango fresco exportación','mango.png'), 
(2,'7750000000043','SKU004','Uva Red Globe','Uva de mesa de exportación','uva.png'), 
(3,'7750000000050','SKU005','Atún en lata','Atún en aceite vegetal','atun.png'), 
(3,'7750000000067','SKU006','Harina de pescado','Harina para balanceados','harina.png'), 
(4,'7750000000074','SKU007','Leche evaporada','Leche entera evaporada','leche.png'),
(5,'7750000000081','SKU008','Café tostado','Café orgánico amazónico','cafe.png'), 
(6,'7750000000098','SKU009','Camisa algodón','Camisa 100% algodón pima','camisa.png'), 
(7,'7750000000104','SKU010','Jugo de naranja','Bebida natural sin azúcar','jugo.png'); 
-- ============================================================================ 
-- TABLAS DE TRAZABILIDAD (lotes, unidades, ubicaciones, actores, eventos, etc.) 
-- ============================================================================ 
CREATE TABLE lotes ( 
    id_lote BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
    id_producto BIGINT UNSIGNED NOT NULL, 
    codigo_lote VARCHAR(64) NOT NULL, 
    fecha_fabricacion DATE NULL, 
    fecha_vencimiento DATE NULL, 
    creado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    UNIQUE KEY ux_lotes_codigo (codigo_lote), 
    FOREIGN KEY (id_producto) REFERENCES productos(id_producto) ON UPDATE CASCADE ON DELETE RESTRICT ) 
ENGINE=InnoDB; 

INSERT INTO lotes (id_producto, codigo_lote, fecha_fabricacion, fecha_vencimiento) VALUES 
(1,'LOTE-001','2024-01-15','2025-01-15'), (2,'LOTE-002','2024-02-01','2025-02-01'), 
(3,'LOTE-003','2024-02-20','2025-02-20'), (4,'LOTE-004','2024-03-05','2025-03-05'), 
(5,'LOTE-005','2024-03-18','2025-03-18'), (6,'LOTE-006','2024-04-01','2025-04-01'), 
(7,'LOTE-007','2024-04-15','2025-04-15'), (8,'LOTE-008','2024-05-10','2025-05-10'), 
(9,'LOTE-009','2024-05-25','2025-05-25'), (10,'LOTE-010','2024-06-01','2025-06-01'); 

CREATE TABLE unidades_serie ( 
    id_unidad_serie BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
    id_lote BIGINT UNSIGNED NOT NULL, 
    codigo_serie VARCHAR(64) NOT NULL, 
    UNIQUE KEY ux_unidades_serie_codigo (codigo_serie), 
    FOREIGN KEY (id_lote) REFERENCES lotes(id_lote) ON UPDATE CASCADE ON DELETE CASCADE ) 
ENGINE=InnoDB; 
INSERT INTO unidades_serie (id_unidad_serie, id_lote, codigo_serie) VALUES 
(1,1,'SERIE-001'), (2,1,'SERIE-002'), (3,1,'SERIE-003'), (4,2,'SERIE-004'), 
(5,2,'SERIE-005'), (6,3,'SERIE-006'), (7,3,'SERIE-007'), (8,4,'SERIE-008'), 
(9,5,'SERIE-009'), (10,5,'SERIE-010'); 

CREATE TABLE ubicaciones ( 
    id_ubicacion BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
    codigo VARCHAR(50) NOT NULL, 
    nombre VARCHAR(200) NOT NULL, 
    tipo ENUM('PLANTA','ALMACEN','TIENDA','VEHICULO','CLIENTE','OTRO') NOT NULL, 
    direccion VARCHAR(255) NULL, 
    latitud DECIMAL(9,6) NULL, 
    longitud DECIMAL(9,6) NULL, 
    activo TINYINT(1) NOT NULL DEFAULT 1, UNIQUE KEY ux_ubicaciones_codigo (codigo) ) 
ENGINE=InnoDB; 

INSERT INTO ubicaciones (codigo, nombre, tipo, direccion, latitud, longitud, activo) VALUES 
('UB001','Planta Lima','PLANTA','Av. Industrial 101, Lima',-12.046374,-77.042793,1), 
('UB002','Almacén Sur','ALMACEN','Carretera Panamericana Sur Km 20',-12.200000,-76.950000,1), 
('UB003','Tienda Miraflores','TIENDA','Av. Pardo 456, Miraflores',-12.121000,-77.030000,1), 
('UB004','Vehículo 01','VEHICULO','Camión placa ABC-123',NULL,NULL,1), 
('UB005','Cliente Mayorista','CLIENTE','Jr. Comercio 789, Arequipa',-16.398890,-71.535000,1), 
('UB006','Puerto Callao','OTRO','Av. Portuaria s/n, Callao',-12.061000,-77.150000,1), 
('UB007','Tienda Cusco','TIENDA','Plaza de Armas, Cusco',-13.516667,-71.978056,1), 
('UB008','Almacén Norte','ALMACEN','Av. Grau 100, Piura',-5.200000,-80.633333,1), 
('UB009','Vehículo 02','VEHICULO','Camión placa XYZ-987',NULL,NULL,1), 
('UB010','Cliente Minorista','CLIENTE','Jr. Mercaderes 456, Trujillo',-8.111111,-79.028889,1); 


CREATE TABLE actores ( 
    id_actor BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
    codigo VARCHAR(50) NOT NULL, nombre VARCHAR(200) NOT NULL, 
    rol ENUM('PROVEEDOR','TRANSPORTISTA','OPERADOR','CLIENTE','REGULADOR','OTRO') NOT NULL, 
    correo VARCHAR(200) NULL, 
    telefono VARCHAR(40) NULL, 
    UNIQUE KEY ux_actores_codigo (codigo) ) ENGINE=InnoDB; 

INSERT INTO actores (codigo, nombre, rol, correo, telefono) VALUES 
('ACT001','Proveedor Lácteos Andinos','PROVEEDOR','contacto@lacteosandinos.pe','987654321'), 
('ACT002','Transportes del Sur','TRANSPORTISTA','logistica@tds.pe','912345678'), 
('ACT003','Operador Planta Lima','OPERADOR','planta@agroandes.com','923456789'), 
('ACT004','Cliente Mayorista Arequipa','CLIENTE','ventas@mayoristaaqp.pe','934567890'), 
('ACT005','SUNAT Fiscalizador','REGULADOR','control@sunat.gob.pe','945678901'), 
('ACT006','Proveedor Envases SAC','PROVEEDOR','info@envases.pe','956789012'), 
('ACT007','Transportes del Norte','TRANSPORTISTA','contacto@tdn.pe','967890123'), 
('ACT008','Operador Planta Cusco','OPERADOR','planta@cusco.pe','978901234'), 
('ACT009','Cliente Minorista Trujillo','CLIENTE','ventas@minoristatrux.pe','989012345'), 
('ACT010','Ministerio de Salud','REGULADOR','control@minsa.gob.pe','900123456'); 

CREATE TABLE tipos_evento ( 
    id_tipo_evento TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
    codigo VARCHAR(30) NOT NULL, descripcion VARCHAR(200) NOT NULL,
    publico TINYINT(1) NOT NULL DEFAULT 0, 
    UNIQUE KEY ux_tipos_evento_codigo (codigo) ) 
ENGINE=InnoDB; 

INSERT INTO tipos_evento (codigo, descripcion, publico) VALUES 
('RECEPCION','Recepción de lote',0), 
('PROCESO','Transformación/Proceso',0), 
('TRASLADO','Traslado/Movimiento',0), 
('INSPECCION','Inspección/Control de calidad',1), 
('VENTA','Venta/Despacho',1), 
('DEVOLUCION','Devolución',0); 

CREATE TABLE insumos_lote ( 
    id_insumo_lote BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
    id_lote_salida BIGINT UNSIGNED NOT NULL, 
    id_lote_insumo BIGINT UNSIGNED NOT NULL, 
    cantidad_entrada DECIMAL(18,6) NULL, 
    UNIQUE KEY ux_insumos_lote (id_lote_salida, id_lote_insumo), 
    FOREIGN KEY (id_lote_salida) REFERENCES lotes(id_lote) ON UPDATE CASCADE ON DELETE CASCADE, 
    FOREIGN KEY (id_lote_insumo) REFERENCES lotes(id_lote) ON UPDATE CASCADE ON DELETE RESTRICT ) 
ENGINE=InnoDB; 

INSERT INTO insumos_lote (id_lote_salida, id_lote_insumo, cantidad_entrada) VALUES 
(1,2,50.000000), (1,3,30.000000), (2,4,20.500000), (3,5,10.000000), (4,6,15.750000), 
(5,7,5.250000), (6,8,8.000000), (7,9,12.500000), (8,10,7.300000), (9,1,6.900000); 

CREATE TABLE eventos_trazabilidad ( 
    id_evento BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
    id_lote BIGINT UNSIGNED NOT NULL, 
    id_unidad_serie BIGINT UNSIGNED NULL, 
    id_tipo_evento TINYINT UNSIGNED NOT NULL, 
    ocurrido_en DATETIME NOT NULL, 
    id_ubicacion BIGINT UNSIGNED NOT NULL, 
    id_actor BIGINT UNSIGNED NOT NULL, 
    cantidad DECIMAL(18,6) NULL, 
    unidad_medida VARCHAR(16) NULL, 
    metadatos JSON NULL, 
    creado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    FOREIGN KEY (id_lote) REFERENCES lotes(id_lote) ON UPDATE CASCADE ON DELETE CASCADE, 
    FOREIGN KEY (id_unidad_serie) REFERENCES unidades_serie(id_unidad_serie) ON UPDATE CASCADE ON DELETE SET NULL, 
    FOREIGN KEY (id_tipo_evento) REFERENCES tipos_evento(id_tipo_evento) ON UPDATE CASCADE ON DELETE RESTRICT, 
    FOREIGN KEY (id_ubicacion) REFERENCES ubicaciones(id_ubicacion) ON UPDATE CASCADE ON DELETE RESTRICT, 
    FOREIGN KEY (id_actor) REFERENCES actores(id_actor) ON UPDATE CASCADE ON DELETE RESTRICT ) 
ENGINE=InnoDB; 

INSERT INTO eventos_trazabilidad (id_lote, id_unidad_serie, id_tipo_evento, ocurrido_en, id_ubicacion, id_actor, cantidad, unidad_medida, metadatos) VALUES 
(1,1,1,'2025-01-10 10:30:00',1,1,100,'KG','{"temperatura":4.5,"humedad":70}'), 
(2,2,2,'2025-01-12 14:00:00',2,2,200,'L','{"notas":"mezcla inicial"}'), 
(3,3,3,'2025-01-15 09:15:00',3,3,50,'KG','{"temperatura":5.0}'), 
(4,4,4,'2025-01-18 16:45:00',4,4,75,'KG','{"inspeccion":"aprobado"}'), 
(5,5,5,'2025-01-20 11:20:00',5,5,120,'UN','{"cliente":"ABC Corp"}'), 
(6,6,6,'2025-01-22 08:10:00',6,6,30,'UN','{"motivo":"defecto"}'), 
(7,7,1,'2025-01-25 13:30:00',7,7,90,'KG','{"temperatura":3.8}'), 
(8,8,2,'2025-01-28 15:40:00',8,8,60,'L','{"observacion":"reprocesado"}'), 
(9,9,3,'2025-01-30 10:05:00',9,9,110,'KG','{"nota":"traslado a almacén"}'), 
(10,10,5,'2025-02-01 12:25:00',10,10,200,'UN','{"venta":"pedido #4521"}'); 


CREATE TABLE evidencias_evento ( 
    id_evidencia BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
    id_evento BIGINT UNSIGNED NOT NULL, 
    url_archivo VARCHAR(500) NOT NULL, 
    tipo_mime VARCHAR(100) NULL, 
    creado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    FOREIGN KEY (id_evento) REFERENCES eventos_trazabilidad(id_evento) ON UPDATE CASCADE ON DELETE CASCADE ) 
ENGINE=InnoDB; 


INSERT INTO evidencias_evento (id_evento, url_archivo, tipo_mime) VALUES 
(1,'/evidencias/evento1_foto1.jpg','image/jpeg'), 
(2,'/evidencias/evento2_doc.pdf','application/pdf'), 
(3,'/evidencias/evento3_video.mp4','video/mp4'), 
(4,'/evidencias/evento4_foto2.png','image/png'), 
(5,'/evidencias/evento5_factura.pdf','application/pdf'), 
(6,'/evidencias/evento6_audio.mp3','audio/mpeg'), 
(7,'/evidencias/evento7_foto3.jpg','image/jpeg'), 
(8,'/evidencias/evento8_manual.pdf','application/pdf'), 
(9,'/evidencias/evento9_certificado.png','image/png'), 
(10,'/evidencias/evento10_foto4.jpg','image/jpeg'); 

CREATE TABLE escaneos_publicos ( 
    id_escaneo BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
    codigo_lote VARCHAR(64) NOT NULL, 
    escaneado_en DATETIME NOT NULL, 
    dispositivo VARCHAR(80) NULL, 
    latitud DECIMAL(9,6) NULL, 
    longitud DECIMAL(9,6) NULL, 
    ciudad VARCHAR(100) NULL, 
    pais VARCHAR(100) NULL ) 
ENGINE=InnoDB; 

INSERT INTO escaneos_publicos (codigo_lote, escaneado_en, dispositivo, latitud, longitud, ciudad, pais) VALUES 
('LOTE-001','2025-02-05 10:10:00','iPhone 14',-12.0464,-77.0428,'Lima','Perú'), 
('LOTE-002','2025-02-06 11:15:00','Samsung S22',40.4168,-3.7038,'Madrid','España'), 
('LOTE-003','2025-02-06 12:30:00','Xiaomi Mi11',34.0522,-118.2437,'Los Ángeles','EE.UU.'), 
('LOTE-004','2025-02-07 09:45:00','Huawei P50',48.8566,2.3522,'París','Francia'), 
('LOTE-005','2025-02-07 15:20:00','Motorola Edge',51.5074,-0.1278,'Londres','Reino Unido'), 
('LOTE-006','2025-02-08 08:00:00','iPad Pro',35.6895,139.6917,'Tokio','Japón'), 
('LOTE-007','2025-02-08 17:40:00','Google Pixel 7',52.5200,13.4050,'Berlín','Alemania'), 
('LOTE-008','2025-02-09 13:05:00','Samsung Tab S8',-34.6037,-58.3816,'Buenos Aires','Argentina'), 
('LOTE-009','2025-02-09 19:25:00','iPhone 13 Mini',19.4326,-99.1332,'Ciudad de México','México'), 
('LOTE-010','2025-02-10 14:50:00','Redmi Note 12',37.7749,-122.4194,'San Francisco','EE.UU.');