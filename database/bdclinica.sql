CREATE DATABASE bdclinica;

USE bdclinica;

CREATE TABLE Roles (
    ID_Rol INTEGER PRIMARY KEY AUTO_INCREMENT,
    Cargo VARCHAR(50) NOT NULL
);

CREATE TABLE Users (
    ID_User INTEGER PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(50) NOT NULL,
    Clave VARCHAR(50) NOT NULL,
    ConfirmClave VARCHAR(50) NOT NULL,
    Correo VARCHAR(50),
    Tipo VARCHAR(50), /*Provisional*/
    ID_Rol INTEGER NOT NULL,
    FOREIGN KEY (ID_Rol) REFERENCES Roles(ID_Rol)
);

CREATE TABLE Areas ( /* ESPECIALIDAD */
    ID_Area INTEGER PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(100) NOT NULL,
    Descripcion VARCHAR(255)
);

CREATE TABLE Perfiles (
    ID_Perfil INTEGER PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(50) NOT NULL,
    Apellidos VARCHAR(50) NOT NULL,
    Celular VARCHAR(20),
    Direccion VARCHAR(100),
    Especialidad VARCHAR(50),
    FechaNac DATE,
    FechaContrato DATE,
    SueldoEmpleado DECIMAL(10, 2),
    DNI VARCHAR(20),
    ID_Reportes INTEGER,
    ID_Rol INTEGER,
    ID_Area INTEGER,
    FOREIGN KEY (ID_Area) REFERENCES Areas(ID_Area),
    FOREIGN KEY (ID_Rol) REFERENCES Roles(ID_Rol)
);

CREATE TABLE Servicios (
    ID_Servicio INTEGER PRIMARY KEY AUTO_INCREMENT,
    Servicio VARCHAR(100),
    Descripcion VARCHAR(300),
    Costo DECIMAL(10, 2)
);

CREATE TABLE Reportes (
    ID_Reporte INTEGER PRIMARY KEY AUTO_INCREMENT,
    Numero INTEGER NOT NULL,
    Folio INTEGER NOT NULL,
    Siglas VARCHAR(10),
    Nombre VARCHAR(50),
    Ruta VARCHAR(100),
    Fecha DATE,
    Hora TIME,
    ID_User INTEGER,
    FOREIGN KEY (ID_User) REFERENCES Users(ID_User)
);

CREATE TABLE Horarios (
    ID_Horario INTEGER PRIMARY KEY auto_increment,
    diaSemana ENUM('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'),
    horaInicio TIME,
    horaFin TIME,
    Id_User INTEGER NOT NULL,
    FOREIGN KEY (Id_User) REFERENCES User(ID_User)
);

CREATE TABLE Citas (
    ID_Cita INTEGER PRIMARY KEY AUTO_INCREMENT,
    Title VARCHAR(100),
    Start DATE,
    End DATE, 
    Color VARCHAR(50),
    Hora VARCHAR(100),
    Fecha_Cr DATETIME,
    Fecha_Up DATETIME,
    Descripcion VARCHAR(255),
    Fecha DATE,
    Hora TIME,
    Tiempo TIME,
    Estado VARCHAR(20),
    ID_Paciente INTEGER NOT NULL,
    ID_Medico INTEGER NOT NULL,
    FOREIGN KEY (ID_Paciente) REFERENCES Paciente(ID_User),
    FOREIGN KEY (ID_Medico) REFERENCES Medico(ID_User)
);

CREATE TABLE Historial_Clinico (
    ID_Historial INTEGER PRIMARY KEY AUTO_INCREMENT,
    Fecha DATE,
    Altura DECIMAL(5, 2),
    Peso DECIMAL(5, 2),
    Alergias VARCHAR(255),
    EnfermedadesPrevias VARCHAR(255),
    Observaciones TEXT,
    Descripcion VARCHAR(255),
    ID_User INTEGER,
    ID_Cita INTEGER,
    FOREIGN KEY (ID_User) REFERENCES Users(ID_User),
    FOREIGN KEY (ID_Cita) REFERENCES Citas(ID_Cita)
);

CREATE TABLE Notificaciones (
    ID_Notificacion INTEGER PRIMARY KEY AUTO_INCREMENT,
    Tipo VARCHAR(50),
    Mensaje VARCHAR(255),
    FechaEnvio DATE,
    ID_User INTEGER NOT NULL,
    ID_Cita INTEGER,
    FOREIGN KEY (ID_User) REFERENCES Users(ID_User),
    FOREIGN KEY (ID_Cita) REFERENCES Citas(ID_Cita)
);

CREATE TABLE Pagos (
    ID_Pago INTEGER PRIMARY KEY AUTO_INCREMENT,
    Monto DECIMAL(10, 2),
    Descuento DECIMAL(10, 2),
    Saldo DECIMAL(10, 2),
    Total DECIMAL(10, 2),
    FechaPago DATE NOT NULL,
    MetodoPago VARCHAR(50),
    ID_Cita INTEGER NOT NULL,
    FOREIGN KEY (ID_Cita) REFERENCES Citas(ID_Cita)
    Id_Paciente INTEGER,
    FOREIGN KEY (Id_Paciente) REFERENCES User(ID_User)
);

CREATE TABLE Cita_Atencion (
    ID_Cita INTEGER NOT NULL,
    ID_Paciente INTEGER NOT NULL,
    ID_Medico INTEGER NOT NULL,
    PRIMARY KEY (ID_Cita, ID_Paciente),
    FOREIGN KEY (ID_Paciente) REFERENCES Paciente(ID_User),
    FOREIGN KEY (ID_Medico) REFERENCES Medico(ID_User)
    FOREIGN KEY (ID_Cita) REFERENCES Citas(ID_Cita),
);

-- Insertar datos en Roles
INSERT INTO Roles (Cargo) VALUES ('Admin');
INSERT INTO Roles (Cargo) VALUES ('Doctor');
INSERT INTO Roles (Cargo) VALUES ('Paciente');
INSERT INTO Roles (Cargo) VALUES ('Recepcionista');

-- Insertar datos en User
INSERT INTO User (Username, Clave, ConfirmClave, Correo, Id_rol, tipo) VALUES ('JuanP', 'clave123', 'clave123', 'juan@example.com', 1, 'admin');
INSERT INTO User (Username, Clave, ConfirmClave, Correo, Id_rol, tipo) VALUES ('MariaL', 'clave456', 'clave456', 'maria@example.com', 2, 'paciente');
INSERT INTO User (Username, Clave, ConfirmClave, Correo, Id_rol, tipo) VALUES ('PedroG', 'clave789', 'clave789', 'pedro@example.com', 3, 'medico');
INSERT INTO User (Username, Clave, ConfirmClave, Correo, Id_rol, tipo) VALUES ('AnaT', 'clave101', 'clave101', 'ana@example.com', 4, 'recepcionista');

-- Insertar datos en Perfiles
INSERT INTO Perfiles (Nombre, Apellidos, Celular, Direccion, Especialidad, FechaNac, FechaContrato, SueldoEmpleado, DNI, ID_Reportes, ID_Rol, ID_Area) VALUES ('Juan', 'Perez', '123456789', 'Calle Falsa 123', 'Cardiología', '1980-01-01', '2020-01-01', 5000.00, '12345678', 1, 1, 1);
INSERT INTO Perfiles (Nombre, Apellidos, Celular, Direccion, Especialidad, FechaNac, FechaContrato, SueldoEmpleado, DNI, ID_Reportes, ID_Rol, ID_Area) VALUES ('Maria', 'Lopez', '987654321', 'Avenida Siempreviva 456', 'Pediatría', '1990-01-01', '2020-01-01', 4500.00, '87654321', 2, 2, 2);
INSERT INTO Perfiles (Nombre, Apellidos, Celular, Direccion, Especialidad, FechaNac, FechaContrato, SueldoEmpleado, DNI, ID_Reportes, ID_Rol, ID_Area) VALUES ('Pedro', 'Garcia', '123123123', 'Calle Verdadera 789', 'Neurología', '1985-01-01', '2020-01-01', 6000.00, '11223344', 3, 3, 3);

-- Insertar datos en Servicios
INSERT INTO Servicios (Servicio, Descripcion, Costo) VALUES ('Consulta General', 'Consulta médica general', 50.00);
INSERT INTO Servicios (Servicio, Descripcion, Costo) VALUES ('Consulta Especialista', 'Consulta con un especialista', 100.00);
INSERT INTO Servicios (Servicio, Descripcion, Costo) VALUES ('Examen de Sangre', 'Análisis de sangre completo', 30.00);

-- Insertar datos en Reportes
INSERT INTO Reportes (Numero, Folio, Siglas, Nombre, Ruta, Fecha, Hora, ID_User) VALUES (1, 1001, 'RP', 'Reporte 1', 'ruta1', '2024-06-01', '08:00:00', 1);
INSERT INTO Reportes (Numero, Folio, Siglas, Nombre, Ruta, Fecha, Hora, ID_User) VALUES (2, 1002, 'RP', 'Reporte 2', 'ruta2', '2024-06-02', '09:00:00', 2);
INSERT INTO Reportes (Numero, Folio, Siglas, Nombre, Ruta, Fecha, Hora, ID_User) VALUES (3, 1003, 'RP', 'Reporte 3', 'ruta3', '2024-06-03', '10:00:00', 3);

-- Insertar datos en Horarios
INSERT INTO Horarios (DiaSemana, HoraInicio, HoraFin, ID_User) VALUES ('Lunes', '08:00:00', '17:00:00', 1);
INSERT INTO Horarios (DiaSemana, HoraInicio, HoraFin, ID_User) VALUES ('Martes', '08:00:00', '17:00:00', 2);
INSERT INTO Horarios (DiaSemana, HoraInicio, HoraFin, ID_User) VALUES ('Miércoles', '08:00:00', '17:00:00', 3);

-- Insertar datos en Citas
INSERT INTO Citas (Title, Start, End, Color, Hora, Fecha_Cr, Fecha_Up, Descripcion, Fecha, Hora, Tiempo, Estado, ID_Paciente, ID_Medico, ID_Servicio) VALUES ('Consulta General', '2024-06-15', '2024-06-15', 'Azul', '10:00:00', '2024-06-01 08:00:00', '2024-06-01 08:00:00', 'Revisión anual', '2024-06-15', '10:00:00', '01:00:00', 'Pendiente', 2, 3, 1);
INSERT INTO Citas (Title, Start, End, Color, Hora, Fecha_Cr, Fecha_Up, Descripcion, Fecha, Hora, Tiempo, Estado, ID_Paciente, ID_Medico, ID_Servicio) VALUES ('Consulta Especialista', '2024-06-20', '2024-06-20', 'Rojo', '11:00:00', '2024-06-02 09:00:00', '2024-06-02 09:00:00', 'Consulta con cardiologo', '2024-06-20', '11:00:00', '01:30:00', 'Confirmada', 4, 1, 2);
INSERT INTO Citas (Title, Start, End, Color, Hora, Fecha_Cr, Fecha_Up, Descripcion, Fecha, Hora, Tiempo, Estado, ID_Paciente, ID_Medico, ID_Servicio) VALUES ('Examen de Sangre', '2024-07-01', '2024-07-01', 'Verde', '09:00:00', '2024-06-15 10:00:00', '2024-06-15 10:00:00', 'Análisis de sangre completo', '2024-07-01', '09:00:00', '00:30:00', 'Pendiente', 3, 2, 3);

-- Insertar datos en Tipos_Medicamentos
INSERT INTO Tipos_Medicamentos (NomTipoMed, Descripcion) VALUES ('Analgésico', 'Medicamento para aliviar el dolor.');
INSERT INTO Tipos_Medicamentos (NomTipoMed, Descripcion) VALUES ('Antibiótico', 'Medicamento para tratar infecciones bacterianas.');
INSERT INTO Tipos_Medicamentos (NomTipoMed, Descripcion) VALUES ('Antihistamínico', 'Medicamento para aliviar reacciones alérgicas.');

-- Insertar datos en Medicamentos
INSERT INTO Medicamentos (NombreMedi, Presentacion, Fabricacion, PreCompra, PrecVenta, Stock, FechProduccion, FechVencimiento, ID_TipoMedi) VALUES ('Paracetamol', 'Tableta', 'LabX', 0.10, 0.50, 1000, '2024-01-01', '2025-01-01', 1);
INSERT INTO Medicamentos (NombreMedi, Presentacion, Fabricacion, PreCompra, PrecVenta, Stock, FechProduccion, FechVencimiento, ID_TipoMedi) VALUES ('Amoxicilina', 'Cápsula', 'LabY', 0.20, 1.00, 500, '2024-02-01', '2025-02-01', 2);
INSERT INTO Medicamentos (NombreMedi, Presentacion, Fabricacion, PreCompra, PrecVenta, Stock, FechProduccion, FechVencimiento, ID_TipoMedi) VALUES ('Loratadina', 'Jarabe', 'LabZ', 0.15, 0.75, 300, '2024-03-01', '2025-03-01', 3);

-- Insertar datos en Tratamientos
INSERT INTO Tratamientos (Cantidad, Dosis, Duracion, ID_Medico, ID_Cita) VALUES (2, '1 tableta cada 8 horas', '5 días', 3, 1);
INSERT INTO Tratamientos (Cantidad, Dosis, Duracion, ID_Medico, ID_Cita) VALUES (1, '1 cápsula cada 12 horas', '7 días', 1, 2);
INSERT INTO Tratamientos (Cantidad, Dosis, Duracion, ID_Medico, ID_Cita) VALUES (1, '10 ml cada 24 horas', '10 días', 2, 3);

-- Insertar datos en Comprobantes
INSERT INTO Comprobantes (FechaPago, MontoComp, Descripcion, ID_User) VALUES ('2024-06-15 10:00:00', 100.00, 'Pago por consulta general', 2);
INSERT INTO Comprobantes (FechaPago, MontoComp, Descripcion, ID_User) VALUES ('2024-06-20 11:00:00', 200.00, 'Pago por consulta especialista', 4);
INSERT INTO Comprobantes (FechaPago, MontoComp, Descripcion, ID_User) VALUES ('2024-07-01 09:00:00', 30.00, 'Pago por examen de sangre', 3);

-- Insertar datos en Detalles_Comprobante
INSERT INTO Detalles_Comprobante (CantUnidVta, PrecUnitVta, SubTotal, ID_Comp, ID_Servicio) VALUES (1, 50.00, 50.00, 1, 1);
INSERT INTO Detalles_Comprobante (CantUnidVta, PrecUnitVta, SubTotal, ID_Comp, ID_Servicio) VALUES (1, 100.00, 100.00, 2, 2);
INSERT INTO Detalles_Comprobante (CantUnidVta, PrecUnitVta, SubTotal, ID_Comp, ID_Servicio) VALUES (1, 30.00, 30.00, 3, 3);

-- Insertar datos en Recetas
INSERT INTO Recetas (Fecha, Descripcion, ID_User, ID_Cita) VALUES ('2024-06-15', 'Receta para tratamiento de dolor', 3, 1);
INSERT INTO Recetas (Fecha, Descripcion, ID_User, ID_Cita) VALUES ('2024-06-20', 'Receta para tratamiento de infección', 1, 2);
INSERT INTO Recetas (Fecha, Descripcion, ID_User, ID_Cita) VALUES ('2024-07-01', 'Receta para tratamiento de alergia', 2, 3);

-- Insertar datos en Historial_Clinico
INSERT INTO Historial_Clinico (Fecha, Altura, Peso, Alergias, EnfermedadesPrevias, Observaciones, Descripcion, ID_User, ID_Cita) VALUES ('2024-06-15', 1.75, 70.5, 'Ninguna', 'Ninguna', 'Buen estado de salud', 'Paciente presenta buen estado de salud', 2, 1);
INSERT INTO Historial_Clinico (Fecha, Altura, Peso, Alergias, EnfermedadesPrevias, Observaciones, Descripcion, ID_User, ID_Cita) VALUES ('2024-06-20', 1.80, 80.0, 'Polen', 'Asma', 'Requiere seguimiento por especialista', 'Requiere seguimiento por especialista', 4, 2);
INSERT INTO Historial_Clinico (Fecha, Altura, Peso, Alergias, EnfermedadesPrevias, Observaciones, Descripcion, ID_User, ID_Cita) VALUES ('2024-07-01', 1.65, 60.0, 'Polvo', 'Bronquitis', 'Control regular necesario', 'Paciente requiere control regular', 3, 3);

-- Insertar datos en Notificaciones
INSERT INTO Notificaciones (Tipo, Mensaje, FechaEnvio, ID_User, ID_Cita) VALUES ('Recordatorio', 'Su cita es mañana a las 10:00 am', '2024-06-14', 2, 1);
INSERT INTO Notificaciones (Tipo, Mensaje, FechaEnvio, ID_User, ID_Cita) VALUES ('Recordatorio', 'Su cita es mañana a las 11:00 am', '2024-06-19', 4, 2);
INSERT INTO Notificaciones (Tipo, Mensaje, FechaEnvio, ID_User, ID_Cita) VALUES ('Recordatorio', 'Su cita es mañana a las 09:00 am', '2024-06-30', 3, 3);

-- Insertar datos en Pagos
INSERT INTO Pagos (Monto, Descuento, Saldo, Total, FechaPago, MetodoPago, ID_Cita, ID_Paciente) VALUES (100.00, 10.00, 90.00, 100.00, '2024-06-15', 'Tarjeta', 1, 2);
INSERT INTO Pagos (Monto, Descuento, Saldo, Total, FechaPago, MetodoPago, ID_Cita, ID_Paciente) VALUES (200.00, 20.00, 180.00, 200.00, '2024-06-20', 'Efectivo', 2, 4);
INSERT INTO Pagos (Monto, Descuento, Saldo, Total, FechaPago, MetodoPago, ID_Cita, ID_Paciente) VALUES (30.00, 5.00, 25.00, 30.00, '2024-07-01', 'Transferencia', 3, 3);

-- Insertar datos en Cita_Atencion
INSERT INTO Cita_Atencion (ID_Cita, ID_Paciente, ID_Medico) VALUES (1, 2, 3);
INSERT INTO Cita_Atencion (ID_Cita, ID_Paciente, ID_Medico) VALUES (2, 4, 1);
INSERT INTO Cita_Atencion (ID_Cita, ID_Paciente, ID_Medico) VALUES (3, 3, 2);
