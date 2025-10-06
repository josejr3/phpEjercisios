<?php
/**
 * Obtiene todos los detalles de un juego específico desde la base de datos.
 *
 * @param int $id_juego El ID del juego a buscar.
 * @param PDO $conn El objeto de conexión a la base de datos.
 * @return array|false Los datos del juego si se encuentra, o false si no.
 */
function obtenerDetallesJuego($id_juego, $conn) {
    try {
        $sql = "SELECT 
                    j.id_usuario_creador, j.titulo, j.descripcion, j.anio_lanzamiento, 
                    j.caratula_imagen, j.url_juego, p.nombre_plataforma
                FROM juegos AS j
                JOIN juegos_plataformas AS jp ON j.id_juego = jp.id_juego
                JOIN plataformas AS p ON jp.id_plataforma = p.id_plataforma
                WHERE j.id_juego = :id_juego";
                
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_juego', $id_juego, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        return false;
    }
}
