<?php
/**
 * Obtiene todos los detalles de un juego específico desde la base de datos.
 *
 * @param int $id_juego El ID del juego a buscar.
 *  @param int $id_usuario El ID del usuario que está logeado.
 * @param PDO $conn La variable de conexión a la base de datos.
 * @return array|false Los datos del juego si se encuentra, o false si no.
 */
function obtenerDetallesJuego($id_juego, $id_usuario, $conn) {
    try {
        $sql = "SELECT 
                    j.id_usuario_creador, j.titulo, j.descripcion, j.anio_lanzamiento, 
                    j.caratula_imagen, j.url_juego, j.vistas, p.nombre_plataforma
                FROM juegos AS j
                JOIN juegos_plataformas AS jp ON j.id_juego = jp.id_juego
                JOIN plataformas AS p ON jp.id_plataforma = p.id_plataforma
                WHERE j.id_juego = :id_juego";
                
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_juego', $id_juego, PDO::PARAM_INT);
        $stmt->execute();
        
        $juego = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$juego) {
            return false;
        }

        $juego['puntuacion'] = obtenerPuntuacionJuego($id_juego, $conn);   

        $sql_voto_usr = "SELECT voto FROM votos_juegos WHERE id_juego = :id_juego AND id_usuario = :id_usuario";
        $stmt_voto_usr = $conn->prepare($sql_voto_usr);
        $stmt_voto_usr->bindParam(':id_juego', $id_juego, PDO::PARAM_INT);
        $stmt_voto_usr->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt_voto_usr->execute();
        
        $voto_usuario = $stmt_voto_usr->fetchColumn();
        $juego['voto_usuario'] = $voto_usuario ? $voto_usuario : null;

        return $juego;

    } catch (PDOException $e) {
        echo ($e->getMessage());
        //die();
        return false;
    }
}

/**
 * Calcula la puntuación total (likes - dislikes) para un juego.
 *
 * @param int $id_juego El ID del juego a calcular.
 * @param PDO $conn El objeto de conexión a la base de datos.
 * @return int La puntuación final.
 */
function obtenerPuntuacionJuego($id_juego, $conn) {
    try {
        $sql_likes = "SELECT COUNT(*) FROM votos_juegos WHERE id_juego = :id_juego AND voto = 'like'";
        $stmt_likes = $conn->prepare($sql_likes);
        $stmt_likes->bindParam(':id_juego', $id_juego, PDO::PARAM_INT);
        $stmt_likes->execute();
        $total_likes = $stmt_likes->fetchColumn();

        $sql_dislikes = "SELECT COUNT(*) FROM votos_juegos WHERE id_juego = :id_juego AND voto = 'dislike'";
        $stmt_dislikes = $conn->prepare($sql_dislikes);
        $stmt_dislikes->bindParam(':id_juego', $id_juego, PDO::PARAM_INT);
        $stmt_dislikes->execute();
        $total_dislikes = $stmt_dislikes->fetchColumn();

        return (int)$total_likes - (int)$total_dislikes;

    } catch (PDOException $e) {
        return 0;
    }
}