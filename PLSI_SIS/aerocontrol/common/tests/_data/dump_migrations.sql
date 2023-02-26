SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
    `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
    `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
    `created_at` int(11) DEFAULT NULL,
    PRIMARY KEY (`item_name`,`user_id`),
    KEY `idx-auth_assignment-user_id` (`user_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1673394885),
('client', '10', 1673394885),
('client', '11', 1673394885),
('client', '12', 1673394885),
('client', '13', 1673394885),
('client', '14', 1673394885),
('client', '15', 1673394885),
('client', '4', 1673394885),
('client', '5', 1673394885),
('client', '6', 1673394885),
('employee', '2', 1673394885),
('employee', '3', 1673394885),
('employee', '7', 1673394885),
('employee', '8', 1673394885),
('employee', '9', 1673394885),
('manager', '16', 1673394885);

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
    `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
    `type` smallint(6) NOT NULL,
    `description` text COLLATE utf8_unicode_ci,
    `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
    `data` blob,
    `created_at` int(11) DEFAULT NULL,
    `updated_at` int(11) DEFAULT NULL,
    PRIMARY KEY (`name`),
    KEY `rule_name` (`rule_name`),
    KEY `idx-auth_item-type` (`type`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('addTicketItem', 2, 'Adicionar Ticket-Item', NULL, NULL, 1673394885, 1673394885),
('admin', 1, 'Administrador', NULL, NULL, 1673394885, 1673394885),
('client', 1, 'Cliente', NULL, NULL, 1673394885, 1673394885),
('createAdmin', 2, 'Criar Admin', NULL, NULL, 1673394885, 1673394885),
('createAirplane', 2, 'Criar Avião', NULL, NULL, 1673394885, 1673394885),
('createAirport', 2, 'Criar Aeroporto', NULL, NULL, 1673394885, 1673394885),
('createCompany', 2, 'Criar companhia', NULL, NULL, 1673394885, 1673394885),
('createEmployee', 2, 'Criar Trabalhador', NULL, NULL, 1673394885, 1673394885),
('createEmployeeFunction', 2, 'Criar função do trabalhador', NULL, NULL, 1673394885, 1673394885),
('createFlight', 2, 'Criar voo', NULL, NULL, 1673394885, 1673394885),
('createLostItem', 2, 'Criar item dos perdidos e achados', NULL, NULL, 1673394885, 1673394885),
('createManager', 2, 'Criar gerente do restaurante', NULL, NULL, 1673394885, 1673394885),
('createMessage', 2, 'Criar Messagem', NULL, NULL, 1673394885, 1673394885),
('createOwnRestaurantItem', 2, 'Criar item do restaurante', 'isManager', NULL, 1673394885, 1673394885),
('createRestaurant', 2, 'Criar Restaurante', NULL, NULL, 1673394885, 1673394885),
('createRestaurantItem', 2, 'Criar item da ementa', NULL, NULL, 1673394885, 1673394885),
('createStore', 2, 'Criar Loja', NULL, NULL, 1673394885, 1673394885),
('createSupportTicket', 2, 'Criar Suport Ticket', NULL, NULL, 1673394885, 1673394885),
('createTicket', 2, 'Criar bilhete de voo', NULL, NULL, 1673394885, 1673394885),
('deleteAdmin', 2, 'Apagar Admin', NULL, NULL, 1673394885, 1673394885),
('deleteClient', 2, 'Apagar Cliente', NULL, NULL, 1673394885, 1673394885),
('deleteLostItem', 2, 'Apagar item dos perdidos e achados', NULL, NULL, 1673394885, 1673394885),
('deleteLostItemLogo', 2, 'Eliminar imagem do item dos perdidos e achados', NULL, NULL, 1673394885, 1673394885),
('deleteManager', 2, 'Apagar gerente do restaurante', NULL, NULL, 1673394885, 1673394885),
('deleteMessage', 2, 'Apagar Mensagem', NULL, NULL, 1673394885, 1673394885),
('deleteOwnRestaurantItem', 2, 'Apagar item do restaurante', 'isManager', NULL, 1673394885, 1673394885),
('deleteOwnRestaurantItemLogo', 2, 'Eliminar Logo do item do Restaurante', 'isManager', NULL, 1673394885, 1673394885),
('deleteOwnRestaurantLogo', 2, 'Eliminar Logo do Restaurante', 'isManager', NULL, 1673394885, 1673394885),
('deleteOwnTicket', 2, 'Apagar bilhete', 'isClient', NULL, 1673394885, 1673394885),
('deleteRestaurant', 2, 'Apagar Restaurante', NULL, NULL, 1673394885, 1673394885),
('deleteRestaurantItem', 2, 'Apagar item da ementa', NULL, NULL, 1673394885, 1673394885),
('deleteRestaurantItemLogo', 2, 'Eliminar Logo do item do Restaurante', NULL, NULL, 1673394885, 1673394885),
('deleteRestaurantLogo', 2, 'Eliminar Logo do Restaurante', NULL, NULL, 1673394885, 1673394885),
('deleteStore', 2, 'Apagar Loja', NULL, NULL, 1673394885, 1673394885),
('deleteStoreLogo', 2, 'Eliminar Logo da Loja', NULL, NULL, 1673394885, 1673394885),
('deleteTicket', 2, 'Apagar bilhete de voo', NULL, NULL, 1673394885, 1673394885),
('deleteTicketItem', 2, 'Eliminar Ticket-Item', NULL, NULL, 1673394885, 1673394885),
('employee', 1, 'Trabalhador', NULL, NULL, 1673394885, 1673394885),
('manager', 1, 'Gerente do Restaurante', NULL, NULL, 1673394885, 1673394885),
('updateAdmin', 2, 'Atualizar Admin', NULL, NULL, 1673394885, 1673394885),
('updateAirplane', 2, 'Atualizar Avião', NULL, NULL, 1673394885, 1673394885),
('updateAirport', 2, 'Atualizar Aeroporto', NULL, NULL, 1673394885, 1673394885),
('updateClient', 2, 'Atualizar Cliente', NULL, NULL, 1673394885, 1673394885),
('updateCompany', 2, 'Atualizar companhia', NULL, NULL, 1673394885, 1673394885),
('updateEmployee', 2, 'Atualizar Trabalhador', NULL, NULL, 1673394885, 1673394885),
('updateEmployeeFunction', 2, 'Atualizar função do trabalhador', NULL, NULL, 1673394885, 1673394885),
('updateFlight', 2, 'Atualizar voo', NULL, NULL, 1673394885, 1673394885),
('updateLostItem', 2, 'Atualizar item dos perdidos e achados', NULL, NULL, 1673394885, 1673394885),
('updateManager', 2, 'Atualizar gerente do restaurante', NULL, NULL, 1673394885, 1673394885),
('updateMessage', 2, 'Atualizar Messagem', NULL, NULL, 1673394885, 1673394885),
('updateOwnProfile', 2, 'Atualizar perfil', 'isClient', NULL, 1673394885, 1673394885),
('updateOwnRestaurant', 2, 'Atualizar restaurante', 'isManager', NULL, 1673394885, 1673394885),
('updateOwnRestaurantItem', 2, 'Atualizar item do restaurante', 'isManager', NULL, 1673394885, 1673394885),
('updateOwnSupportTicket', 2, 'Atualizar Support Ticket', 'isClient', NULL, 1673394885, 1673394885),
('updateOwnTicket', 2, 'Atualizar bilhete', 'isClient', NULL, 1673394885, 1673394885),
('updatePaymentMethod', 2, 'Atualizar método de pagamento', NULL, NULL, 1673394885, 1673394885),
('updateRestaurant', 2, 'Atualizar Restaurante', NULL, NULL, 1673394885, 1673394885),
('updateRestaurantItem', 2, 'Atualizar item da ementa', NULL, NULL, 1673394885, 1673394885),
('updateStore', 2, 'Atualizar Loja', NULL, NULL, 1673394885, 1673394885),
('updateSupportTicket', 2, 'Atualizar Suport Ticket', NULL, NULL, 1673394885, 1673394885),
('updateTicket', 2, 'Atualizar bilhete de voo', NULL, NULL, 1673394885, 1673394885),
('updateTicketItem', 2, 'Atualizar Ticket-Item', NULL, NULL, 1673394885, 1673394885),
('viewAdmin', 2, 'Visualizar Admin', NULL, NULL, 1673394885, 1673394885),
('viewAirplane', 2, 'Visualizar Avião', NULL, NULL, 1673394885, 1673394885),
('viewAirport', 2, 'Visualizar Aeroporto', NULL, NULL, 1673394885, 1673394885),
('viewClient', 2, 'Visualizar Cliente', NULL, NULL, 1673394885, 1673394885),
('viewCompany', 2, 'Visualizar companhia', NULL, NULL, 1673394885, 1673394885),
('viewEmployee', 2, 'Visualizar trabalhador', NULL, NULL, 1673394885, 1673394885),
('viewEmployeeFunction', 2, 'Visualizar função do trabalhador', NULL, NULL, 1673394885, 1673394885),
('viewFlight', 2, 'Visualizar voo', NULL, NULL, 1673394885, 1673394885),
('viewLostItem', 2, 'Visualizar item dos perdidos e achados', NULL, NULL, 1673394885, 1673394885),
('viewManager', 2, 'Visualizar gerente do restaurante', NULL, NULL, 1673394885, 1673394885),
('viewMessage', 2, 'Visualizar Messagem', NULL, NULL, 1673394885, 1673394885),
('viewOwnRestaurant', 2, 'Visualizar restaurante', 'isManager', NULL, 1673394885, 1673394885),
('viewOwnRestaurantItem', 2, 'Visualizar item do restaurante', 'isManager', NULL, 1673394885, 1673394885),
('viewOwnSupportTicket', 2, 'Visualizar Support Ticket', 'isClient', NULL, 1673394885, 1673394885),
('viewPaymentMethod', 2, 'Visualizar método de pagamento', NULL, NULL, 1673394885, 1673394885),
('viewRestaurant', 2, 'Visualizar Restaurante', NULL, NULL, 1673394885, 1673394885),
('viewRestaurantItem', 2, 'Visualizar item da ementa', NULL, NULL, 1673394885, 1673394885),
('viewServerLog', 2, 'Visualizar log do servidor', NULL, NULL, 1673394885, 1673394885),
('viewStore', 2, 'Visualizar Loja', NULL, NULL, 1673394885, 1673394885),
('viewSupportTicket', 2, 'Visualizar Suport Ticket', NULL, NULL, 1673394885, 1673394885),
('viewTicket', 2, 'Visualizar bilhete de voo', NULL, NULL, 1673394885, 1673394885),
('viewTicketItem', 2, 'Visualizar Ticket-Item', NULL, NULL, 1673394885, 1673394885);

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
    `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
    `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
    PRIMARY KEY (`parent`,`child`),
    KEY `child` (`child`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('employee', 'addTicketItem'),
('admin', 'createAdmin'),
('employee', 'createAirplane'),
('employee', 'createAirport'),
('admin', 'createCompany'),
('admin', 'createEmployee'),
('admin', 'createEmployeeFunction'),
('employee', 'createFlight'),
('employee', 'createLostItem'),
('admin', 'createManager'),
('client', 'createMessage'),
('employee', 'createMessage'),
('manager', 'createOwnRestaurantItem'),
('admin', 'createRestaurant'),
('admin', 'createRestaurantItem'),
('createOwnRestaurantItem', 'createRestaurantItem'),
('admin', 'createStore'),
('client', 'createSupportTicket'),
('client', 'createTicket'),
('admin', 'deleteAdmin'),
('admin', 'deleteClient'),
('employee', 'deleteLostItem'),
('employee', 'deleteLostItemLogo'),
('admin', 'deleteManager'),
('manager', 'deleteOwnRestaurantItem'),
('manager', 'deleteOwnRestaurantItemLogo'),
('manager', 'deleteOwnRestaurantLogo'),
('client', 'deleteOwnTicket'),
('admin', 'deleteRestaurant'),
('admin', 'deleteRestaurantItem'),
('deleteOwnRestaurantItem', 'deleteRestaurantItem'),
('deleteOwnRestaurantItemLogo', 'deleteRestaurantItemLogo'),
('admin', 'deleteRestaurantLogo'),
('deleteOwnRestaurantLogo', 'deleteRestaurantLogo'),
('admin', 'deleteStore'),
('admin', 'deleteStoreLogo'),
('deleteOwnTicket', 'deleteTicket'),
('employee', 'deleteTicketItem'),
('admin', 'employee'),
('admin', 'manager'),
('admin', 'updateAdmin'),
('employee', 'updateAirplane'),
('employee', 'updateAirport'),
('employee', 'updateClient'),
('updateOwnProfile', 'updateClient'),
('admin', 'updateCompany'),
('admin', 'updateEmployee'),
('admin', 'updateEmployeeFunction'),
('employee', 'updateFlight'),
('employee', 'updateLostItem'),
('admin', 'updateManager'),
('client', 'updateOwnProfile'),
('manager', 'updateOwnRestaurant'),
('manager', 'updateOwnRestaurantItem'),
('client', 'updateOwnSupportTicket'),
('client', 'updateOwnTicket'),
('employee', 'updatePaymentMethod'),
('admin', 'updateRestaurant'),
('updateOwnRestaurant', 'updateRestaurant'),
('admin', 'updateRestaurantItem'),
('updateOwnRestaurantItem', 'updateRestaurantItem'),
('admin', 'updateStore'),
('employee', 'updateSupportTicket'),
('updateOwnSupportTicket', 'updateSupportTicket'),
('employee', 'updateTicket'),
('updateOwnTicket', 'updateTicket'),
('employee', 'updateTicketItem'),
('admin', 'viewAdmin'),
('employee', 'viewAirplane'),
('employee', 'viewAirport'),
('employee', 'viewClient'),
('admin', 'viewCompany'),
('admin', 'viewEmployee'),
('admin', 'viewEmployeeFunction'),
('employee', 'viewFlight'),
('employee', 'viewLostItem'),
('admin', 'viewManager'),
('employee', 'viewMessage'),
('manager', 'viewOwnRestaurant'),
('manager', 'viewOwnRestaurantItem'),
('client', 'viewOwnSupportTicket'),
('employee', 'viewPaymentMethod'),
('admin', 'viewRestaurant'),
('viewOwnRestaurant', 'viewRestaurant'),
('admin', 'viewRestaurantItem'),
('viewOwnRestaurantItem', 'viewRestaurantItem'),
('admin', 'viewServerLog'),
('admin', 'viewStore'),
('employee', 'viewSupportTicket'),
('viewOwnSupportTicket', 'viewSupportTicket'),
('employee', 'viewTicket'),
('employee', 'viewTicketItem');

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
    `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
    `data` blob,
    `created_at` int(11) DEFAULT NULL,
    `updated_at` int(11) DEFAULT NULL,
    PRIMARY KEY (`name`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('isClient', 0x4f3a32343a22636f6e736f6c655c72756c65735c436c69656e7452756c65223a333a7b733a343a226e616d65223b733a383a226973436c69656e74223b733a393a22637265617465644174223b693a313637333339343838353b733a393a22757064617465644174223b693a313637333339343838353b7d, 1673394885, 1673394885),
('isManager', 0x4f3a32353a22636f6e736f6c655c72756c65735c4d616e6167657252756c65223a333a7b733a343a226e616d65223b733a393a2269734d616e61676572223b733a393a22637265617465644174223b693a313637333339343838353b733a393a22757064617465644174223b693a313637333339343838353b7d, 1673394885, 1673394885);


DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
    `version` varchar(180) NOT NULL,
    `apply_time` int(11) DEFAULT NULL,
    PRIMARY KEY (`version`)
    ) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1673394881),
('m140506_102106_rbac_init', 1673394882),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1673394882),
('m180523_151638_rbac_updates_indexes_without_prefix', 1673394882),
('m200409_110543_rbac_update_mssql_trigger', 1673394882),
('m130524_201442_init', 1673394885),
('m190124_110200_add_verification_token_column_to_user_table', 1673394885),
('m221115_155756_init_rbac', 1673394885);

ALTER TABLE `auth_assignment`
    ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `auth_item`
    ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `auth_item_child`
    ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;


