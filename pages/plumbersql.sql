USE [master]
GO
/****** Object:  Database [DataBasePlumberV2]    Script Date: 26/06/2024 12:05:44 a. m. ******/
CREATE DATABASE [DataBasePlumberV2]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'DataBasePlumberV2', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL16.SQLEXPRESS\MSSQL\DATA\DataBasePlumberV2.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'DataBasePlumberV2_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL16.SQLEXPRESS\MSSQL\DATA\DataBasePlumberV2_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
 WITH CATALOG_COLLATION = DATABASE_DEFAULT, LEDGER = OFF
GO
ALTER DATABASE [DataBasePlumberV2] SET COMPATIBILITY_LEVEL = 160
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [DataBasePlumberV2].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [DataBasePlumberV2] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [DataBasePlumberV2] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [DataBasePlumberV2] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [DataBasePlumberV2] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [DataBasePlumberV2] SET ARITHABORT OFF 
GO
ALTER DATABASE [DataBasePlumberV2] SET AUTO_CLOSE ON 
GO
ALTER DATABASE [DataBasePlumberV2] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [DataBasePlumberV2] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [DataBasePlumberV2] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [DataBasePlumberV2] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [DataBasePlumberV2] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [DataBasePlumberV2] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [DataBasePlumberV2] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [DataBasePlumberV2] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [DataBasePlumberV2] SET  ENABLE_BROKER 
GO
ALTER DATABASE [DataBasePlumberV2] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [DataBasePlumberV2] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [DataBasePlumberV2] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [DataBasePlumberV2] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [DataBasePlumberV2] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [DataBasePlumberV2] SET READ_COMMITTED_SNAPSHOT ON 
GO
ALTER DATABASE [DataBasePlumberV2] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [DataBasePlumberV2] SET RECOVERY SIMPLE 
GO
ALTER DATABASE [DataBasePlumberV2] SET  MULTI_USER 
GO
ALTER DATABASE [DataBasePlumberV2] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [DataBasePlumberV2] SET DB_CHAINING OFF 
GO
ALTER DATABASE [DataBasePlumberV2] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [DataBasePlumberV2] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [DataBasePlumberV2] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [DataBasePlumberV2] SET ACCELERATED_DATABASE_RECOVERY = OFF  
GO
ALTER DATABASE [DataBasePlumberV2] SET QUERY_STORE = ON
GO
ALTER DATABASE [DataBasePlumberV2] SET QUERY_STORE (OPERATION_MODE = READ_WRITE, CLEANUP_POLICY = (STALE_QUERY_THRESHOLD_DAYS = 30), DATA_FLUSH_INTERVAL_SECONDS = 900, INTERVAL_LENGTH_MINUTES = 60, MAX_STORAGE_SIZE_MB = 1000, QUERY_CAPTURE_MODE = AUTO, SIZE_BASED_CLEANUP_MODE = AUTO, MAX_PLANS_PER_QUERY = 200, WAIT_STATS_CAPTURE_MODE = ON)
GO
USE [DataBasePlumberV2]
GO
/****** Object:  Table [dbo].[__EFMigrationsHistory]    Script Date: 26/06/2024 12:05:44 a. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[__EFMigrationsHistory](
	[MigrationId] [nvarchar](150) NOT NULL,
	[ProductVersion] [nvarchar](32) NOT NULL,
 CONSTRAINT [PK___EFMigrationsHistory] PRIMARY KEY CLUSTERED 
(
	[MigrationId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Almacen]    Script Date: 26/06/2024 12:05:44 a. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Almacen](
	[IdMaterialAlmacen] [int] IDENTITY(1,1) NOT NULL,
	[NombreMaterial] [nvarchar](max) NOT NULL,
	[CantidadTotal] [float] NOT NULL,
	[CantidadDisponible] [float] NULL,
	[CantidadPrestada] [float] NULL,
	[CostoUnitario] [float] NULL,
	[Tipo] [nvarchar](max) NOT NULL,
 CONSTRAINT [PK_Almacen] PRIMARY KEY CLUSTERED 
(
	[IdMaterialAlmacen] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Clientes]    Script Date: 26/06/2024 12:05:44 a. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Clientes](
	[IdCliente] [int] IDENTITY(1,1) NOT NULL,
	[Nombre] [nvarchar](max) NOT NULL,
	[ApMaterno] [nvarchar](max) NOT NULL,
	[ApPaterno] [nvarchar](max) NOT NULL,
	[NumeTel] [nvarchar](max) NULL,
	[CorreoElectronico] [nvarchar](max) NOT NULL,
	[Contrasena] [nvarchar](max) NOT NULL,
 CONSTRAINT [PK_Clientes] PRIMARY KEY CLUSTERED 
(
	[IdCliente] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[CodigoPostal]    Script Date: 26/06/2024 12:05:44 a. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CodigoPostal](
	[IdCodigoPostal] [int] IDENTITY(1,1) NOT NULL,
	[Asenta] [nvarchar](max) NOT NULL,
	[TipoAsenta] [nvarchar](max) NOT NULL,
	[Municipio] [nvarchar](max) NOT NULL,
	[Estado] [nvarchar](max) NOT NULL,
	[Ciudad] [nvarchar](max) NOT NULL,
	[CP] [nvarchar](max) NOT NULL,
	[CodigoEstado] [nvarchar](max) NOT NULL,
	[CodigoOficina] [nvarchar](max) NOT NULL,
	[CodigoTipoAsenta] [nvarchar](max) NOT NULL,
	[CodigoMunicipio] [nvarchar](max) NOT NULL,
	[IdAsenta] [nvarchar](max) NOT NULL,
	[Zona] [nvarchar](max) NOT NULL,
	[Clave] [nvarchar](max) NOT NULL,
 CONSTRAINT [PK_CodigoPostal] PRIMARY KEY CLUSTERED 
(
	[IdCodigoPostal] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[MaterialesPrestados]    Script Date: 26/06/2024 12:05:44 a. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[MaterialesPrestados](
	[IdMaterialPrestado] [int] IDENTITY(1,1) NOT NULL,
	[ServicioId] [int] NOT NULL,
	[AlmacenId] [int] NOT NULL,
	[CantidadUsada] [float] NOT NULL,
 CONSTRAINT [PK_MaterialesPrestados] PRIMARY KEY CLUSTERED 
(
	[IdMaterialPrestado] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Notificacion]    Script Date: 26/06/2024 12:05:44 a. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Notificacion](
	[IdNotificacion] [int] IDENTITY(1,1) NOT NULL,
	[ServicioId] [int] NOT NULL,
 CONSTRAINT [PK_Notificacion] PRIMARY KEY CLUSTERED 
(
	[IdNotificacion] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Pago]    Script Date: 26/06/2024 12:05:44 a. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Pago](
	[IdPago] [int] IDENTITY(1,1) NOT NULL,
	[ServicioId] [int] NOT NULL,
	[FechaPago] [datetime2](7) NOT NULL,
	[Tarjeta] [nvarchar](max) NOT NULL,
	[FechaVencimiento] [datetime2](7) NOT NULL,
	[Referencia] [nvarchar](max) NOT NULL,
	[Monto] [float] NOT NULL,
 CONSTRAINT [PK_Pago] PRIMARY KEY CLUSTERED 
(
	[IdPago] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Servicio]    Script Date: 26/06/2024 12:05:44 a. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Servicio](
	[IdServicio] [int] IDENTITY(1,1) NOT NULL,
	[SolicitudId] [int] NOT NULL,
	[UsuarioId] [int] NOT NULL,
	[FechaIniciada] [datetime2](7) NOT NULL,
	[FechaFinalizada] [datetime2](7) NOT NULL,
	[HorasServicio] [int] NOT NULL,
	[Fotos] [nvarchar](max) NOT NULL,
 CONSTRAINT [PK_Servicio] PRIMARY KEY CLUSTERED 
(
	[IdServicio] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Solicitud]    Script Date: 26/06/2024 12:05:44 a. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Solicitud](
	[IdSolicitud] [int] IDENTITY(1,1) NOT NULL,
	[ClienteId] [int] NOT NULL,
	[TipoServicioId] [int] NOT NULL,
	[CodigoPostalId] [int] NOT NULL,
	[FechaSolicitud] [datetime2](7) NOT NULL,
	[Calle] [nvarchar](max) NOT NULL,
	[NumExt] [int] NOT NULL,
	[NumInt] [int] NULL,
	[EstadoSolicitud] [nvarchar](max) NOT NULL,
	[CodigoPostalIdCodigoPostal] [int] NULL,
	[TipoServicioIdTipoServicio] [int] NULL,
 CONSTRAINT [PK_Solicitud] PRIMARY KEY CLUSTERED 
(
	[IdSolicitud] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[SolicitudMaterial]    Script Date: 26/06/2024 12:05:44 a. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[SolicitudMaterial](
	[IdSolicitudMaterial] [int] IDENTITY(1,1) NOT NULL,
	[AlmacenId] [int] NOT NULL,
	[FechaSolicitud] [datetime2](7) NOT NULL,
	[CantidadSolicitada] [float] NOT NULL,
	[CostoTotal] [float] NOT NULL,
 CONSTRAINT [PK_SolicitudMaterial] PRIMARY KEY CLUSTERED 
(
	[IdSolicitudMaterial] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[TipoServicio]    Script Date: 26/06/2024 12:05:44 a. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[TipoServicio](
	[IdTipoServicio] [int] IDENTITY(1,1) NOT NULL,
	[NombreServicio] [nvarchar](max) NOT NULL,
	[CostoServicio] [float] NOT NULL,
 CONSTRAINT [PK_TipoServicio] PRIMARY KEY CLUSTERED 
(
	[IdTipoServicio] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Usuarios]    Script Date: 26/06/2024 12:05:44 a. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Usuarios](
	[IdUsuario] [int] IDENTITY(1,1) NOT NULL,
	[Nombre] [nvarchar](max) NOT NULL,
	[ApMaterno] [nvarchar](max) NOT NULL,
	[ApPaterno] [nvarchar](max) NOT NULL,
	[NumeTel] [nvarchar](max) NULL,
	[CorreoElectronico] [nvarchar](max) NOT NULL,
	[Contrasena] [nvarchar](max) NOT NULL,
	[Rol] [nvarchar](max) NOT NULL,
 CONSTRAINT [PK_Usuarios] PRIMARY KEY CLUSTERED 
(
	[IdUsuario] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
INSERT [dbo].[__EFMigrationsHistory] ([MigrationId], [ProductVersion]) VALUES (N'20240623003017_DataBasePlumberV2', N'8.0.6')
INSERT [dbo].[__EFMigrationsHistory] ([MigrationId], [ProductVersion]) VALUES (N'20240624220211_PlumberV2', N'8.0.6')
GO
SET IDENTITY_INSERT [dbo].[Almacen] ON 

INSERT [dbo].[Almacen] ([IdMaterialAlmacen], [NombreMaterial], [CantidadTotal], [CantidadDisponible], [CantidadPrestada], [CostoUnitario], [Tipo]) VALUES (1, N'Destornillador 3/4', 30, 30, 0, 150, N'NoConsumible')
SET IDENTITY_INSERT [dbo].[Almacen] OFF
GO
SET IDENTITY_INSERT [dbo].[Clientes] ON 

INSERT [dbo].[Clientes] ([IdCliente], [Nombre], [ApMaterno], [ApPaterno], [NumeTel], [CorreoElectronico], [Contrasena]) VALUES (1, N'Jair', N'Garcia', N'Salvador', N'5567890123', N'JairSalvadorGarcia@gmail.com', N'123456789')
INSERT [dbo].[Clientes] ([IdCliente], [Nombre], [ApMaterno], [ApPaterno], [NumeTel], [CorreoElectronico], [Contrasena]) VALUES (2, N'Enrique', N'Macias', N'Perez', N'5567902345', N'EnriquePerezMacias123@gmail.com', N'123456789')
SET IDENTITY_INSERT [dbo].[Clientes] OFF
GO
SET IDENTITY_INSERT [dbo].[Usuarios] ON 

INSERT [dbo].[Usuarios] ([IdUsuario], [Nombre], [ApMaterno], [ApPaterno], [NumeTel], [CorreoElectronico], [Contrasena], [Rol]) VALUES (2, N'Luis', N'Ramirez', N'Manuel', N'5566778899', N'luismanuelramirez123@gmail.com', N'1*m06a&szk', N'Gerente')
SET IDENTITY_INSERT [dbo].[Usuarios] OFF
GO
/****** Object:  Index [IX_MaterialesPrestados_AlmacenId]    Script Date: 26/06/2024 12:05:44 a. m. ******/
CREATE NONCLUSTERED INDEX [IX_MaterialesPrestados_AlmacenId] ON [dbo].[MaterialesPrestados]
(
	[AlmacenId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
GO
/****** Object:  Index [IX_MaterialesPrestados_ServicioId]    Script Date: 26/06/2024 12:05:44 a. m. ******/
CREATE NONCLUSTERED INDEX [IX_MaterialesPrestados_ServicioId] ON [dbo].[MaterialesPrestados]
(
	[ServicioId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
GO
/****** Object:  Index [IX_Notificacion_ServicioId]    Script Date: 26/06/2024 12:05:44 a. m. ******/
CREATE NONCLUSTERED INDEX [IX_Notificacion_ServicioId] ON [dbo].[Notificacion]
(
	[ServicioId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
GO
/****** Object:  Index [IX_Pago_ServicioId]    Script Date: 26/06/2024 12:05:44 a. m. ******/
CREATE NONCLUSTERED INDEX [IX_Pago_ServicioId] ON [dbo].[Pago]
(
	[ServicioId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
GO
/****** Object:  Index [IX_Servicio_SolicitudId]    Script Date: 26/06/2024 12:05:44 a. m. ******/
CREATE NONCLUSTERED INDEX [IX_Servicio_SolicitudId] ON [dbo].[Servicio]
(
	[SolicitudId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
GO
/****** Object:  Index [IX_Servicio_UsuarioId]    Script Date: 26/06/2024 12:05:44 a. m. ******/
CREATE NONCLUSTERED INDEX [IX_Servicio_UsuarioId] ON [dbo].[Servicio]
(
	[UsuarioId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
GO
/****** Object:  Index [IX_Solicitud_ClienteId]    Script Date: 26/06/2024 12:05:44 a. m. ******/
CREATE NONCLUSTERED INDEX [IX_Solicitud_ClienteId] ON [dbo].[Solicitud]
(
	[ClienteId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
GO
/****** Object:  Index [IX_Solicitud_CodigoPostalId]    Script Date: 26/06/2024 12:05:44 a. m. ******/
CREATE NONCLUSTERED INDEX [IX_Solicitud_CodigoPostalId] ON [dbo].[Solicitud]
(
	[CodigoPostalId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
GO
/****** Object:  Index [IX_Solicitud_CodigoPostalIdCodigoPostal]    Script Date: 26/06/2024 12:05:44 a. m. ******/
CREATE NONCLUSTERED INDEX [IX_Solicitud_CodigoPostalIdCodigoPostal] ON [dbo].[Solicitud]
(
	[CodigoPostalIdCodigoPostal] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
GO
/****** Object:  Index [IX_Solicitud_TipoServicioId]    Script Date: 26/06/2024 12:05:44 a. m. ******/
CREATE NONCLUSTERED INDEX [IX_Solicitud_TipoServicioId] ON [dbo].[Solicitud]
(
	[TipoServicioId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
GO
/****** Object:  Index [IX_Solicitud_TipoServicioIdTipoServicio]    Script Date: 26/06/2024 12:05:44 a. m. ******/
CREATE NONCLUSTERED INDEX [IX_Solicitud_TipoServicioIdTipoServicio] ON [dbo].[Solicitud]
(
	[TipoServicioIdTipoServicio] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
GO
/****** Object:  Index [IX_SolicitudMaterial_AlmacenId]    Script Date: 26/06/2024 12:05:44 a. m. ******/
CREATE NONCLUSTERED INDEX [IX_SolicitudMaterial_AlmacenId] ON [dbo].[SolicitudMaterial]
(
	[AlmacenId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
GO
ALTER TABLE [dbo].[MaterialesPrestados]  WITH CHECK ADD  CONSTRAINT [FK_MaterialesPrestados_Almacen_AlmacenId] FOREIGN KEY([AlmacenId])
REFERENCES [dbo].[Almacen] ([IdMaterialAlmacen])
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[MaterialesPrestados] CHECK CONSTRAINT [FK_MaterialesPrestados_Almacen_AlmacenId]
GO
ALTER TABLE [dbo].[MaterialesPrestados]  WITH CHECK ADD  CONSTRAINT [FK_MaterialesPrestados_Servicio_ServicioId] FOREIGN KEY([ServicioId])
REFERENCES [dbo].[Servicio] ([IdServicio])
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[MaterialesPrestados] CHECK CONSTRAINT [FK_MaterialesPrestados_Servicio_ServicioId]
GO
ALTER TABLE [dbo].[Notificacion]  WITH CHECK ADD  CONSTRAINT [FK_Notificacion_Servicio_ServicioId] FOREIGN KEY([ServicioId])
REFERENCES [dbo].[Servicio] ([IdServicio])
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Notificacion] CHECK CONSTRAINT [FK_Notificacion_Servicio_ServicioId]
GO
ALTER TABLE [dbo].[Pago]  WITH CHECK ADD  CONSTRAINT [FK_Pago_Servicio_ServicioId] FOREIGN KEY([ServicioId])
REFERENCES [dbo].[Servicio] ([IdServicio])
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Pago] CHECK CONSTRAINT [FK_Pago_Servicio_ServicioId]
GO
ALTER TABLE [dbo].[Servicio]  WITH CHECK ADD  CONSTRAINT [FK_Servicio_Solicitud_SolicitudId] FOREIGN KEY([SolicitudId])
REFERENCES [dbo].[Solicitud] ([IdSolicitud])
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Servicio] CHECK CONSTRAINT [FK_Servicio_Solicitud_SolicitudId]
GO
ALTER TABLE [dbo].[Servicio]  WITH CHECK ADD  CONSTRAINT [FK_Servicio_Usuarios_UsuarioId] FOREIGN KEY([UsuarioId])
REFERENCES [dbo].[Usuarios] ([IdUsuario])
GO
ALTER TABLE [dbo].[Servicio] CHECK CONSTRAINT [FK_Servicio_Usuarios_UsuarioId]
GO
ALTER TABLE [dbo].[Solicitud]  WITH CHECK ADD  CONSTRAINT [FK_Solicitud_Clientes_ClienteId] FOREIGN KEY([ClienteId])
REFERENCES [dbo].[Clientes] ([IdCliente])
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Solicitud] CHECK CONSTRAINT [FK_Solicitud_Clientes_ClienteId]
GO
ALTER TABLE [dbo].[Solicitud]  WITH CHECK ADD  CONSTRAINT [FK_Solicitud_CodigoPostal_CodigoPostalId] FOREIGN KEY([CodigoPostalId])
REFERENCES [dbo].[CodigoPostal] ([IdCodigoPostal])
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Solicitud] CHECK CONSTRAINT [FK_Solicitud_CodigoPostal_CodigoPostalId]
GO
ALTER TABLE [dbo].[Solicitud]  WITH CHECK ADD  CONSTRAINT [FK_Solicitud_CodigoPostal_CodigoPostalIdCodigoPostal] FOREIGN KEY([CodigoPostalIdCodigoPostal])
REFERENCES [dbo].[CodigoPostal] ([IdCodigoPostal])
GO
ALTER TABLE [dbo].[Solicitud] CHECK CONSTRAINT [FK_Solicitud_CodigoPostal_CodigoPostalIdCodigoPostal]
GO
ALTER TABLE [dbo].[Solicitud]  WITH CHECK ADD  CONSTRAINT [FK_Solicitud_TipoServicio_TipoServicioId] FOREIGN KEY([TipoServicioId])
REFERENCES [dbo].[TipoServicio] ([IdTipoServicio])
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Solicitud] CHECK CONSTRAINT [FK_Solicitud_TipoServicio_TipoServicioId]
GO
ALTER TABLE [dbo].[Solicitud]  WITH CHECK ADD  CONSTRAINT [FK_Solicitud_TipoServicio_TipoServicioIdTipoServicio] FOREIGN KEY([TipoServicioIdTipoServicio])
REFERENCES [dbo].[TipoServicio] ([IdTipoServicio])
GO
ALTER TABLE [dbo].[Solicitud] CHECK CONSTRAINT [FK_Solicitud_TipoServicio_TipoServicioIdTipoServicio]
GO
ALTER TABLE [dbo].[SolicitudMaterial]  WITH CHECK ADD  CONSTRAINT [FK_SolicitudMaterial_Almacen_AlmacenId] FOREIGN KEY([AlmacenId])
REFERENCES [dbo].[Almacen] ([IdMaterialAlmacen])
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[SolicitudMaterial] CHECK CONSTRAINT [FK_SolicitudMaterial_Almacen_AlmacenId]
GO
USE [master]
GO
ALTER DATABASE [DataBasePlumberV2] SET  READ_WRITE 
GO
