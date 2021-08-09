ALTER TABLE app_tiendas ADD COLUMN `idPais` VARCHAR(10) DEFAULT '057' AFTER `direccionTienda`;
ALTER TABLE app_tiendas ADD COLUMN `idDepartamento` VARCHAR(10) DEFAULT '0' AFTER `idPais`;
ALTER TABLE app_tiendas ADD COLUMN `idCiudad` VARCHAR(10) DEFAULT '0' AFTER `idDepartamento`;
ALTER TABLE app_tiendas ADD COLUMN `telefonoTienda` VARCHAR(10) DEFAULT '0' AFTER `celularTienda`;--
