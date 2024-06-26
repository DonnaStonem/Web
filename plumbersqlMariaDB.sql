-- Crear la base de datos
CREATE DATABASE `DataBasePlumberV2`;
USE `DataBasePlumberV2`;

-- Crear la tabla __EFMigrationsHistory
CREATE TABLE `__EFMigrationsHistory` (
  `MigrationId` VARCHAR(150) NOT NULL,
  `ProductVersion` VARCHAR(32) NOT NULL,
  PRIMARY KEY (`MigrationId`)
) ENGINE=InnoDB;

-- Crear la tabla Almacen
CREATE TABLE `Almacen` (
  `IdMaterialAlmacen` INT AUTO_INCREMENT NOT NULL,
  `NombreMaterial` TEXT NOT NULL,
  `CantidadTotal` FLOAT NOT NULL,
  `CantidadDisponible` FLOAT NULL,
  `CantidadPrestada` FLOAT NULL,
  `CostoUnitario` FLOAT NULL,
  `Tipo` TEXT NOT NULL,
  PRIMARY KEY (`IdMaterialAlmacen`)
) ENGINE=InnoDB;

-- Crear la tabla Clientes
CREATE TABLE `Clientes` (
  `IdCliente` INT AUTO_INCREMENT NOT NULL,
  `Nombre` TEXT NOT NULL,
  `ApMaterno` TEXT NOT NULL,
  `ApPaterno` TEXT NOT NULL,
  `NumeTel` TEXT NULL,
  `CorreoElectronico` TEXT NOT NULL,
  `Contrasena` TEXT NOT NULL,
  PRIMARY KEY (`IdCliente`)
) ENGINE=InnoDB;

-- Crear la tabla CodigoPostal
CREATE TABLE `CodigoPostal` (
  `IdCodigoPostal` INT AUTO_INCREMENT NOT NULL,
  `Asenta` TEXT NOT NULL,
  `TipoAsenta` TEXT NOT NULL,
  `Municipio` TEXT NOT NULL,
  `Estado` TEXT NOT NULL,
  `Ciudad` TEXT NOT NULL,
  `CP` TEXT NOT NULL,
  `CodigoEstado` TEXT NOT NULL,
  `CodigoOficina` TEXT NOT NULL,
  `CodigoTipoAsenta` TEXT NOT NULL,
  `CodigoMunicipio` TEXT NOT NULL,
  `IdAsenta` TEXT NOT NULL,
  `Zona` TEXT NOT NULL,
  `Clave` TEXT NOT NULL,
  PRIMARY KEY (`IdCodigoPostal`)
) ENGINE=InnoDB;

-- Crear la tabla MaterialesPrestados
CREATE TABLE `MaterialesPrestados` (
  `IdMaterialPrestado` INT AUTO_INCREMENT NOT NULL,
  `ServicioId` INT NOT NULL,
  `AlmacenId` INT NOT NULL,
  `CantidadUsada` FLOAT NOT NULL,
  PRIMARY KEY (`IdMaterialPrestado`)
) ENGINE=InnoDB;

-- Crear la tabla Notificacion
CREATE TABLE `Notificacion` (
  `IdNotificacion` INT AUTO_INCREMENT NOT NULL,
  `ServicioId` INT NOT NULL,
  PRIMARY KEY (`IdNotificacion`)
) ENGINE=InnoDB;

-- Crear la tabla Pago
CREATE TABLE `Pago` (
  `IdPago` INT AUTO_INCREMENT NOT NULL,
  `ServicioId` INT NOT NULL,
  `FechaPago` DATETIME NOT NULL,
  `Tarjeta` TEXT NOT NULL,
  `FechaVencimiento` DATETIME NOT NULL,
  `Referencia` TEXT NOT NULL,
  `Monto` FLOAT NOT NULL,
  PRIMARY KEY (`IdPago`)
) ENGINE=InnoDB;

-- Crear la tabla Servicio
CREATE TABLE `Servicio` (
  `IdServicio` INT AUTO_INCREMENT NOT NULL,
  `SolicitudId` INT NOT NULL,
  `UsuarioId` INT NOT NULL,
  `FechaIniciada` DATETIME NOT NULL,
  `FechaFinalizada` DATETIME NOT NULL,
  `HorasServicio` INT NOT NULL,
  `Fotos` TEXT NOT NULL,
  PRIMARY KEY (`IdServicio`)
) ENGINE=InnoDB;

-- Crear la tabla Solicitud
CREATE TABLE `Solicitud` (
  `IdSolicitud` INT AUTO_INCREMENT NOT NULL,
  `ClienteId` INT NOT NULL,
  `TipoServicioId` INT NOT NULL,
  `CodigoPostalId` INT NOT NULL,
  `FechaSolicitud` DATETIME NOT NULL,
  `Calle` TEXT NOT NULL,
  `NumExt` INT NOT NULL,
  `NumInt` INT NULL,
  `EstadoSolicitud` TEXT NOT NULL,
  PRIMARY KEY (`IdSolicitud`)
) ENGINE=InnoDB;

-- Crear la tabla SolicitudMaterial
CREATE TABLE `SolicitudMaterial` (
  `IdSolicitudMaterial` INT AUTO_INCREMENT NOT NULL,
  `AlmacenId` INT NOT NULL,
  `FechaSolicitud` DATETIME NOT NULL,
  `CantidadSolicitada` FLOAT NOT NULL,
  `CostoTotal` FLOAT NOT NULL,
  PRIMARY KEY (`IdSolicitudMaterial`)
) ENGINE=InnoDB;

-- Crear la tabla TipoServicio
CREATE TABLE `TipoServicio` (
  `IdTipoServicio` INT AUTO_INCREMENT NOT NULL,
  `NombreServicio` TEXT NOT NULL,
  `CostoServicio` FLOAT NOT NULL,
  PRIMARY KEY (`IdTipoServicio`)
) ENGINE=InnoDB;

-- Crear la tabla Usuarios
CREATE TABLE `Usuarios` (
  `IdUsuario` INT AUTO_INCREMENT NOT NULL,
  `Nombre` TEXT NOT NULL,
  `ApMaterno` TEXT NOT NULL,
  `ApPaterno` TEXT NOT NULL,
  `NumeTel` TEXT NULL,
  `CorreoElectronico` TEXT NOT NULL,
  `Contrasena` TEXT NOT NULL,
  `Rol` TEXT NOT NULL,
  PRIMARY KEY (`IdUsuario`)
) ENGINE=InnoDB;

-- Insertar datos en la tabla __EFMigrationsHistory
INSERT INTO `__EFMigrationsHistory` (`MigrationId`, `ProductVersion`) VALUES ('20240623003017_DataBasePlumberV2', '8.0.6');
INSERT INTO `__EFMigrationsHistory` (`MigrationId`, `ProductVersion`) VALUES ('20240624220211_PlumberV2', '8.0.6');

-- Insertar datos en la tabla Almacen
INSERT INTO `Almacen` (`IdMaterialAlmacen`, `NombreMaterial`, `CantidadTotal`, `CantidadDisponible`, `CantidadPrestada`, `CostoUnitario`, `Tipo`) VALUES (1, 'Destornillador 3/4', 30, 30, 0, 150, 'NoConsumible');

-- Insertar datos en la tabla Clientes
INSERT INTO `Clientes` (`IdCliente`, `Nombre`, `ApMaterno`, `ApPaterno`, `NumeTel`, `CorreoElectronico`, `Contrasena`) VALUES (1, 'Jair', 'Garcia', 'Salvador', '5567890123', 'JairSalvadorGarcia@gmail.com', '123456789');
INSERT INTO `Clientes` (`IdCliente`, `Nombre`, `ApMaterno`, `ApPaterno`, `NumeTel`, `CorreoElectronico`, `Contrasena`) VALUES (2, 'Enrique', 'Macias', 'Perez', '5567902345', 'EnriquePerezMacias123@gmail.com', '123456789');

-- Insertar datos en la tabla Usuarios
INSERT INTO `Usuarios` (`IdUsuario`, `Nombre`, `ApMaterno`, `ApPaterno`, `NumeTel`, `CorreoElectronico`, `Contrasena`, `Rol`) VALUES (2, 'Luis', 'Ramirez', 'Manuel', '5566778899', 'luismanuelramirez123@gmail.com', '1*m06a&szk', 'Gerente');

-- Crear índices en la tabla MaterialesPrestados
CREATE INDEX `IX_MaterialesPrestados_AlmacenId` ON `MaterialesPrestados` (`AlmacenId`);
CREATE INDEX `IX_MaterialesPrestados_ServicioId` ON `MaterialesPrestados` (`ServicioId`);

-- Crear índices en la tabla Notificacion
CREATE INDEX `IX_Notificacion_ServicioId` ON `Notificacion` (`ServicioId`);

-- Crear índices en la tabla Pago
CREATE INDEX `IX_Pago_ServicioId` ON `Pago` (`ServicioId`);

-- Crear índices en la tabla Servicio
CREATE INDEX `IX_Servicio_SolicitudId` ON `Servicio` (`SolicitudId`);
CREATE INDEX `IX_Servicio_UsuarioId` ON `Servicio` (`UsuarioId`);

-- Crear índices en la tabla Solicitud
CREATE INDEX `IX_Solicitud_ClienteId` ON `Solicitud` (`ClienteId`);
CREATE INDEX `IX_Solicitud_CodigoPostalId` ON `Solicitud` (`CodigoPostalId`);
databaseplumberv2databaseplumberv2databaseplumberv2