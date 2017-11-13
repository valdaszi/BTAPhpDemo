CREATE TABLE IF NOT EXISTS `PREFIX_ltpastas_distance`(
    `id_ltpastas_distance` int(11) NOT NULL AUTO_INCREMENT,
    `store` VARCHAR(100) NOT NULL,
    `destination` VARCHAR(100) NOT NULL,
    `distance` INT NOT NULL,
    PRIMARY KEY (`id_ltpastas_distance`),
    UNIQUE KEY (`store`,`destination`)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 COMMENT='LT Pastas Distances';