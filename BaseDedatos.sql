CREATE TABLE `juegos` (
  `id_juego` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `anio_lanzamiento` year(4) DEFAULT NULL,
  `caratula_imagen` blob DEFAULT NULL,
  `url_juego` varchar(255) DEFAULT NULL,
  `id_usuario_creador` int(11) NOT NULL,
  `fecha_subida` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `juegos_plataformas` (
  `id_juego` int(11) NOT NULL,
  `id_plataforma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `plataformas` (
  `id_plataforma` int(11) NOT NULL,
  `nombre_plataforma` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `plataformas` (`nombre_plataforma`) VALUES
('PC'),
('Xbox'),
('Nintendo'),
('PlayStation');

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password_hash` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `juegos`
  ADD PRIMARY KEY (`id_juego`),
  ADD KEY `id_usuario_creador` (`id_usuario_creador`);


ALTER TABLE `juegos_plataformas`
  ADD PRIMARY KEY (`id_juego`,`id_plataforma`),
  ADD KEY `id_plataforma` (`id_plataforma`);


ALTER TABLE `plataformas`
  ADD PRIMARY KEY (`id_plataforma`),
  ADD UNIQUE KEY `nombre_plataforma` (`nombre_plataforma`);


ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);


ALTER TABLE `juegos`
  MODIFY `id_juego` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `plataformas`
  MODIFY `id_plataforma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;


ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `juegos`
  ADD CONSTRAINT `juegos_ibfk_1` FOREIGN KEY (`id_usuario_creador`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `juegos_plataformas`
  ADD CONSTRAINT `juegos_plataformas_ibfk_1` FOREIGN KEY (`id_juego`) REFERENCES `juegos` (`id_juego`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `juegos_plataformas_ibfk_2` FOREIGN KEY (`id_plataforma`) REFERENCES `plataformas` (`id_plataforma`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

