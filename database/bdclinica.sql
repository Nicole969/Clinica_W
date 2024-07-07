create database bdclinica;

use bdclinica;

CREATE TABLE Roles (
    ID_Rol INTEGER PRIMARY KEY auto_increment,
    Cargo VARCHAR(50) NOT NULL
);

CREATE TABLE User (
    ID_User INTEGER PRIMARY KEY auto_increment,
    Username VARCHAR(50) NOT NULL,
    Clave VARCHAR(50) NOT NULL,
    ConfirmClave VARCHAR(50) NOT NULL,
    Correo VARCHAR(50),
    Id_rol INTEGER NOT NULL,
    tipo VARCHAR(50), /*Provicional*/
    FOREIGN KEY (Id_rol) REFERENCES Roles(ID_Rol)
);

CREATE TABLE Area (
    ID_Area INTEGER PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(100) NOT NULL,
    Descripcion VARCHAR(255)
);

CREATE TABLE Perfil (
    ID_Perfil INTEGER PRIMARY KEY auto_increment,
    Nombre VARCHAR(50) NOT NULL,
    Apellidos VARCHAR(50) NOT NULL,
    Celular VARCHAR(20),
    Direccion VARCHAR(100),
    Especialidad VARCHAR(50),
    Fecha DATE,
    DNI VARCHAR(20),
    Id_Reportes INTEGER,
    Id_Rol INTEGER,
    Id_Area INTEGER,
    FOREIGN KEY (Id_Area) REFERENCES Area(ID_Area),
    FOREIGN KEY (Id_Rol) REFERENCES Roles(ID_Rol)
);

CREATE TABLE Reportes (
    ID_Reporte INTEGER PRIMARY KEY auto_increment,
    Numero INTEGER NOT NULL,
    Folio INTEGER NOT NULL,
    Siglas VARCHAR(10),
    Nombre VARCHAR(50),
    Ruta VARCHAR(100),
    Fecha DATE,
    Hora TIME,
    Id_User INTEGER NOT NULL,
    FOREIGN KEY (Id_User) REFERENCES User(ID_User)
);

CREATE TABLE Horarios (
    ID_Horario INTEGER PRIMARY KEY auto_increment,
    diaSemana ENUM('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'),
    horaInicio TIME,
    horaFin TIME,
    Estado VARCHAR(20),
    Id_User INTEGER NOT NULL,
    FOREIGN KEY (Id_User) REFERENCES User(ID_User)
);

CREATE TABLE Citas (
    ID_Cita INTEGER PRIMARY KEY auto_increment,
    Asunto VARCHAR(100),
    Descripcion VARCHAR(255),
    Fecha DATE,
    Hora TIME,
    Tiempo TIME,
    Estado VARCHAR(20),
    ID_Paciente INTEGER NOT NULL,
    ID_Medico INTEGER NOT NULL,
    FOREIGN KEY (ID_Paciente) REFERENCES User(ID_User),
    FOREIGN KEY (ID_Medico) REFERENCES User(ID_User)
);

CREATE TABLE Historial_clinico (
    ID_Historial INTEGER PRIMARY KEY auto_increment,
    Fecha DATE,
    Altura DECIMAL(5, 2),
    Peso DECIMAL(5, 2),
    Alergias VARCHAR(255),
    EnfermedadesPrevias VARCHAR(255),
    Observaciones TEXT,
    Descripcion VARCHAR(255),
    Id_User INTEGER NOT NULL,
    Id_Citas INTEGER,
    FOREIGN KEY (Id_User) REFERENCES User(ID_User),
    FOREIGN KEY (Id_Citas) REFERENCES Citas(ID_Cita)
);

CREATE TABLE Notificacion (
    ID_Notificacion INTEGER PRIMARY KEY auto_increment,
    Tipo VARCHAR(50),
    Mensaje VARCHAR(255),
    FechaEnvio DATE,
    Id_User INTEGER NOT NULL,
    Id_Citas INTEGER,
    FOREIGN KEY (Id_User) REFERENCES User(ID_User),
    FOREIGN KEY (Id_Citas) REFERENCES Citas(ID_Cita)
);

CREATE TABLE Pagos (
    ID_Pago INTEGER PRIMARY KEY auto_increment,
    Monto DECIMAL(10, 2),
    Descuento DECIMAL(10, 2),
    Saldo DECIMAL(10, 2),
    Total DECIMAL(10, 2),
    FechaPago DATE NOT NULL,
    MetodoPago VARCHAR(50),
    ID_Cita INTEGER NOT NULL,
    FOREIGN KEY (ID_Cita) REFERENCES Citas(ID_Cita),
    Id_Paciente INTEGER,
    FOREIGN KEY (Id_Paciente) REFERENCES User(ID_User)
);


CREATE TABLE Cita_atencion (
    ID_Cita INTEGER NOT NULL,
    ID_Paciente INTEGER NOT NULL,
    ID_Medico INTEGER NOT NULL,
    PRIMARY KEY (ID_Cita, ID_Paciente),
    FOREIGN KEY (ID_Paciente) REFERENCES User(ID_User),
    FOREIGN KEY (ID_Medico) REFERENCES User(ID_User),
    FOREIGN KEY (ID_Cita) REFERENCES Citas(ID_Cita)
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

-- Inserta más áreas
INSERT INTO Area (Nombre, Descripcion) VALUES ('Cardiología', 'Especialidad en problemas cardíacos');
INSERT INTO Area (Nombre, Descripcion) VALUES ('Pediatría', 'Especialidad en atención infantil');


-- Insertar datos en Perfil
INSERT INTO Perfil (Nombre, Apellidos, Celular, Direccion, Especialidad, Fecha, DNI, Id_Reportes, Id_Rol, Id_Area) VALUES ('Juan', 'Perez', '123456789', 'Calle Falsa 123', 'Cardiología', '2024-01-01', '12345678', 1, 1, 1);
INSERT INTO Perfil (Nombre, Apellidos, Celular, Direccion, Especialidad, Fecha, DNI, Id_Reportes, Id_Rol, Id_Area) VALUES ('Maria', 'Lopez', '987654321', 'Avenida Siempreviva 456', 'Pediatría', '2024-01-01', '87654321', 2, 2, 2);

-- Insertar datos en Reportes
INSERT INTO Reportes (Numero, Folio, Siglas, Nombre, Ruta, Fecha, Hora, Id_User) VALUES (1, 1001, 'RP', 'Reporte 1', 'ruta1', '2024-06-01', '08:00:00', 1);
INSERT INTO Reportes (Numero, Folio, Siglas, Nombre, Ruta, Fecha, Hora, Id_User) VALUES (2, 1002, 'RP', 'Reporte 2', 'ruta2', '2024-06-02', '09:00:00', 2);

-- Insertar datos en Horarios
INSERT INTO Horarios (diaSemana, horaInicio, horaFin, Id_User) VALUES ('Lunes', '08:00:00', '17:00:00', 1);
INSERT INTO Horarios (diaSemana, horaInicio, horaFin, Id_User) VALUES ('Martes', '08:00:00', '17:00:00', 2);

-- Insertar datos en Citas
INSERT INTO Citas (Asunto, Descripcion, Fecha, Hora, Tiempo, Estado, ID_Paciente, ID_Medico) VALUES ('Consulta General', 'Revisión anual', '2024-06-15', '10:00:00', '01:00:00', 'Pendiente', 2, 3);
INSERT INTO Citas (Asunto, Descripcion, Fecha, Hora, Tiempo, Estado, ID_Paciente, ID_Medico) VALUES ('Consulta Especialista', 'Consulta con cardiologo', '2024-06-20', '11:00:00', '01:30:00', 'Confirmada', 4, 1);

-- Insertar datos en Historial_clinico
INSERT INTO Historial_clinico (Fecha, Descripcion, Id_User, Id_Citas) VALUES ('2024-06-15', 'Paciente presenta buen estado de salud', 2, 1);
INSERT INTO Historial_clinico (Fecha, Descripcion, Id_User, Id_Citas) VALUES ('2024-06-20', 'Requiere seguimiento por especialista', 4, 2);

-- Insertar datos en Notificacion
INSERT INTO Notificacion (Tipo, Mensaje, FechaEnvio, Id_User, Id_Citas) VALUES ('Recordatorio', 'Su cita es mañana a las 10:00 am', '2024-06-14', 2, 1);
INSERT INTO Notificacion (Tipo, Mensaje, FechaEnvio, Id_User, Id_Citas) VALUES ('Recordatorio', 'Su cita es mañana a las 11:00 am', '2024-06-19', 4, 2);

-- Insertar datos en Pagos
INSERT INTO Pagos (Monto, Descuento, Saldo, Total, FechaPago, MetodoPago, ID_Cita, Id_Paciente) VALUES (100.0, 10.0, 90.0, 100.0, '2024-06-15', 'Tarjeta', 1, 2);
INSERT INTO Pagos (Monto, Descuento, Saldo, Total, FechaPago, MetodoPago, ID_Cita, Id_Paciente) VALUES (200.0, 20.0, 180.0, 200.0, '2024-06-20', 'Efectivo', 2, 4);

-- Insertar datos en Cita_atencion
INSERT INTO Cita_atencion (ID_Cita, ID_Paciente, ID_Medico) VALUES (1, 2, 3);
INSERT INTO Cita_atencion (ID_Cita, ID_Paciente, ID_Medico) VALUES (2, 4, 1);