SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `biblioteca_de_juegos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `biblioteca_de_juegos`;

CREATE TABLE IF NOT EXISTS `juegos` (
  `id_juego` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `anio_lanzamiento` year(4) DEFAULT NULL,
  `caratula_imagen` varchar(255) DEFAULT NULL,
  `url_juego` varchar(255) DEFAULT NULL,
  `id_usuario_creador` int(11) NOT NULL,
  PRIMARY KEY (`id_juego`),
  KEY `id_usuario_creador` (`id_usuario_creador`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `juegos` (`id_juego`, `titulo`, `descripcion`, `anio_lanzamiento`, `caratula_imagen`, `url_juego`, `id_usuario_creador`) VALUES
(5, 'Dragon Ball Sparking! Zero', 'DRAGON BALL: Sparking! ZERO lleva a un nuevo nivel el legendario estilo de juego de la serie Budokai Tenkaichi. Aprende a dominar a diversos pppppppppppppppppppppppppppppppppppppppppppppppppppersonajes jugables, cada uno con sus habilidades, transformaciones y técnicas propias. Libera tu espíritu de lucha y pelea en escenarios que se derrumban y reaccionan a tu poder a medida que el combate se recrudece.', '2024', 'uploads/caratula_68e2df12d62d9.jpg', 'https://es.bandainamcoent.eu/dragon-ball/dragon-ball-sparking-zero', 1),
(6, 'Dragon Ball Sparking! Zero', 'DRAGON BALL: Sparking! ZERO lleva a un nuevo nivel el legendario estilo de juego de lpppppppppppppppppppppppppppAprende a dominar a diversos personajes jugables, cada uno con sus habilidades, transformaciones y técnicas propias. Libera tu espíritu de lucha y pelea en escenarios que se derrumban y reaccionan a tu poder a medida que el combate se recrudece.', '2024', NULL, 'https://es.bandainamcoent.eu/dragon-ball/dragon-ball-sparking-zero', 1),
(7, 'Cyberpunk 2077', 'Sumérgete en el universo de Cyberpunk: desde la historia original de Cyberpunk 2077 y su fascinante expansión de suspense y espionaje, Phantom Liberty, al premiado anime Cyberpunk: Edgerunners. Hay infinidad de historias por descubrir en la letal megalópolis de Night City.', '2025', 'uploads/caratula_68e30b1b56175.jpg', 'https://www.cyberpunk.net/es/es/', 1),
(8, 'dfdsf', 'dfewfewaf', '2025', NULL, '', 1),
(9, 'efew', 'ewfwf', '2021', NULL, '', 2);

CREATE TABLE IF NOT EXISTS `juegos_plataformas` (
  `id_juego` int(11) NOT NULL,
  `id_plataforma` int(11) NOT NULL,
  PRIMARY KEY (`id_juego`,`id_plataforma`),
  KEY `id_plataforma` (`id_plataforma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `juegos_plataformas` (`id_juego`, `id_plataforma`) VALUES
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1);

CREATE TABLE IF NOT EXISTS `plataformas` (
  `id_plataforma` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_plataforma` varchar(50) NOT NULL,
  PRIMARY KEY (`id_plataforma`),
  UNIQUE KEY `nombre_plataforma` (`nombre_plataforma`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `plataformas` (`id_plataforma`, `nombre_plataforma`) VALUES
(1, 'PC'),
(4, 'Xbox'),
(3, 'Nintendo'),
(2, 'PlayStation');

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password_hash` varchar(60) NOT NULL,
  `imagen_perfil` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `usuarios` (`id_usuario`, `username`, `email`, `password_hash`) VALUES
(1, 'jose', 'gregorio.jrviewer@gmail.com', '$2y$10$bI1YnsiXERXBjsrQLkJ7WOQv9QrhNMznqHIsaXcboP3degwoaNaRa'),
(2, 'jose2', 'gregoriodoc.class@gmail.com', '$2y$10$5IM2q/41XjgQiGQahkKrh.n96kxjiutZck2SeX6G80Y3PBLrx4Wnu');


ALTER TABLE `juegos`
  ADD CONSTRAINT `juegos_ibfk_1` FOREIGN KEY (`id_usuario_creador`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `juegos_plataformas`
  ADD CONSTRAINT `juegos_plataformas_ibfk_1` FOREIGN KEY (`id_juego`) REFERENCES `juegos` (`id_juego`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `juegos_plataformas_ibfk_2` FOREIGN KEY (`id_plataforma`) REFERENCES `plataformas` (`id_plataforma`) ON DELETE CASCADE ON UPDATE CASCADE;
USE `phpmyadmin`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
