CREATE TABLE `prueba`.`agenda` (
    `id` INT(6) NULL AUTO_INCREMENT,
    `nombre` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `apellido` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `telefono` VARCHAR(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `username` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `password` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `nacionalidad` VARCHAR(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
    `sexo` CHAR(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `fecha_modificacion` TIMESTAMP NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET = utf8mb4 COLLATE utf8mb4_general_ci;