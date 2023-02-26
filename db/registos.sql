--
--
-- INSERTS
--
--

use aerocontrol;

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `first_name`, `last_name`, `gender`, `country`, `city`, `birthdate`, `email`, `phone`, `phone_country_code`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'rafael', '3LCUGMKxZPpzr34KJQqnRHerxvb9H-GD', '$2y$13$siIFsVQTb.Xw.SCmxCkkeOpP/jUmewhYu8kYaxdeH5XPFHyK1FCe6', NULL, 'Rafael', 'Bento', 'Masculino', 'Portugal', 'Lisboa', '2002-08-07', 'rafael@email.pt', '912345678', '+351', 10, 1667385991, 1667392931, 'iBlapCIFv2HLg6_itfyyr-xsERf_b287_1667385991'),
(2, 'pedro', 'JO3nV-1f2xjjEfqBrOw-EhJDGgAgFBvT', '$2y$13$t0EbTzLBtr2jKt5SteKVReIEyizI4lBopTTFJggFMjgj1odid.HpG', NULL, 'Pedro', 'Norberto', 'Masculino', 'Portugal', 'Lisboa', '2002-11-13', 'pedro@email.pt', '913412581', '+351', 10, 1667390821, 1667392906, 'fd73elasjLW11GrxlDenw2dcPfzWBA6h_1667390821'),
(3, 'manuel', 'E3JGSTaNM8D7MbTdd7VyXWKn2nMPN6kO', '$2y$13$WYKf.WWmQEb4Hd2FpvUsGer/Lq7bTQFaVm6WerOJjNmCBMBzXn.Yy', NULL, 'Manuel', 'Henriques', 'Masculino', 'Portugal', 'Lisboa', '2002-11-08', 'pedrohenriques@gmail.pt', '998877665', '+351', 10, 1667394488, 1667394488, 'aQ1CM8RK8jZVZo27pg8KI_EZXNCFCspR_1667394488'),
(4,'antonio', 'sOAZ_ou8A8ZImJjZ8C5R9mYrnSn3MjdR', '$2y$13$yRY3c2CeOV5472uQQQbyq.EXV3j1QZs9nZwg4ulAGMnHK/PhiKykC', NULL, 'António', 'Alberto', 'Masculino', 'Portugal', 'Torres Vedras', '2002-10-30', 'antonio.alberto@live.com', '911111111', '+351', 10, 1668529982, 1668529982, 'ny7bgoj7mvW732Kv1pBHzTF7A2cu3l66_1668529982'),
(5,'joaquim', 'SsqujPrZXyG1tLKUwF8XP0YfJWmmSh6n', '$2y$13$sq4r3qgKLBhjAuwehOnwju4f8RGh9kL04/Vzn0ntzq3KDY9kmbx1O', NULL, 'Joaquim', 'Antunes', 'Masculino', 'Portugal', 'Torres Vedras', '2022-11-13', 'joaquim.antunes@live.com', '911111111', '+351', 10, 1668530463, 1668531494, '62ZbfYy0ohnj5WoQjEYaUbNYaCnuBOi0_1668530463'),
(6, 'Joao', 'ONt0Widq05eyWiqSTSV5WxrS59J3zTFw', '$2y$13$ADCs0vpkBh1WWHHtG2kouuulmhZi7cRETBfL2Ig4yl4m.mGweo3RW', NULL, 'João', 'Pedro', 'Masculino', 'Portugal', 'Lisba', '2006-01-30', 'pedro@gmail.pt', '9132122321', '+351', 10, 1668591776, 1668591776, 'NOxk0W2NbArDSVrzGPpNAU9pQUb4b34H_1668591776'),
(7, 'Sandra', 'IfJ1kqp0kLeDSiGvqHv9_s-sYlpAhvRN', '$2y$13$Lw45a9c0AdueKewROmVT7.4aQqy/L7vemGMXyaGNzy1mLvkML4LCa', NULL, 'Sandra', 'Maria', 'Feminino', 'Portugal', 'Porto', '2000-10-22', 'sanda@gmail.pt', '912315860', '+351', 10, 1669143539, 1669143539, 'nz-hwMd3VkJkbciwqRuHC0uodlRRr8Vp_1669143539'),
(8, 'francisco', 'XA5zCtcYQRkoFlbWbhHGb6gwOya3ztnv', '$2y$13$ZFXgs/i5CcegMMFv9KZtt.ezq6AsTJXtS7oa.s6wp8NtGF0FcZHzS', NULL, 'Francisco', 'Vicente', 'Masculino', 'Portugal', 'Coimbra', '1998-04-30', 'francisco@gmail.pt', '913102895', '+351', 10, 1669143699, 1669143699, 'CsYy588m_A4ktZ4OAbJRxxmlrcMlziVv_1669143699'),
(9, 'tomas', 'pFq-wqjSnjyLMBr3nonCe3T8rTTWTSPD', '$2y$13$HAZSWqiqW55QAXpHyXwwQ.1OkkqcDX7mTlSt0Ok7yxoAW9oEHOL3C', NULL, 'Tomás', 'Alberto', 'Masculino', 'Portugal', 'Faro', '1989-02-01', 'tomas@gmail.pt', '910481963', '+351', 10, 1669144122, 1669144122, '5Ea-MdMWBsVHmTK5PnflQGGVk6uO7njY_1669144122'),
(10, 'andre', '4Q5zJzIPJeuaxpOVtfatgbGAQT8d-f96', '$2y$13$KTjIZBf2vBaHBU2tVmfOp.dvi/DueYKTLqveXegxtAj8Uah0hg57a', NULL, 'André', 'Cachão', 'Masculino', 'Portugal', 'Faro', '2001-07-01', 'andre@gmail.pt', '912369856', '+351', 10, 1669144361, 1669144361, 'XBEVC3NR96riHkmdsLiznlnOaz6C838F_1669144361'),
(11, 'beatriz', 'SSVnV8IaKsWesLhx48Lv91VU9QUb5u8c', '$2y$13$CRhrnsQp4osfc8ZnFYvs/.oK.5DiqcvXND3r9jPP4DLPBSGe/u3hi', NULL, 'Beatriz', 'Grilo', 'Feminino', 'Espanha', 'Barcelona', '2001-06-08', 'beatriz@gmail.pt', '930139168', '+351', 10, 1669144441, 1669144441, 'G2t7UqDIOqoObAHBqbwS5XOXjRS26O8S_1669144441'),
(12, 'joana', 'Mp9wa07PoGl3TVkV63_pt-p6aEi-cpJ1', '$2y$13$Rx/5L7/.UBJf9b0qO3VgI.gZXf/WfmuYZ58AqBGCnCJYxFSoOvu6O', NULL, 'Joana', 'Maria', 'Feminino', 'França', 'Paris', '1996-09-02', 'joana@gmail.pt', '913249815', '+351', 10, 1669144519, 1669144519, 'IdGl19M7LQhFkKl16WOItANYWWZqlnJ6_1669144519'),
(13, 'joaquina', 'iwTUez0kQ3CYl_BPlpU7p0bh9n2HD4ar', '$2y$13$Wxu5hFSdWw2OIblQhEXVy.JKT4OOXoBXHM3XiLlXjN7KZS8ljTPiS', NULL, 'Joaquina', 'Santos', 'Feminino', 'Portugal', 'Porto', '2004-02-22', 'joaquina@gmail.pt', '968483219', '+351', 10, 1669144583, 1669144583, 'lgz1gmJLdMxmfo3_CFopv1zVsdZW7hKW_1669144583'),
(14, 'tiago', 'tGYZhx8iparOM_XWY26Q6BU9rdv7mkhJ', '$2y$13$1MP2ZbecBaJ6WLCI9RNsKOIpk1fG86bWlODg0KS2YQk9kJ5rWvtFC', NULL, 'Tiago', 'Santos', 'Masculino', 'Portugal', 'Santarém', '1999-05-22', 'tiago@gmail.pt', '986142367', '+351', 10, 1669144760, 1669144760, 'zHSMLfY0UKQTdV1_lW87eN89OoKqqWm7_1669144760'),
(15, 'gonçalo', 'UZJof0DKXT0CZ5ElVh4SF5-VEEuGVEfw', '$2y$13$xJeXGwL1V2BZTnN4SBdpxOGmcSsr4ayIxPUe9o.XuyzuwfBSisnyO', NULL, 'Gonçalo', 'António', 'Masculino', 'Portugal', 'Braga', '2000-12-14', 'goncalo@gmail.com', '930139168', '+351', 10, 1669144816, 1669144816, 'ylcW1N-avvr6F332pae7JBV73v_Miyym_1669144816'),
(16, 'santos', 'mTTnBM1p-RSSQpPlUk4q8tM1TJyxI4qL', '$2y$13$eIBQ/na4mmkJ8pX8j6DgFef.1SmDJkgFknsUDYXW4jNBb8e1MP89.', NULL, 'Manuel', 'Santos', 'Masculino', 'Portugal', 'Aveiro', '1997-01-13', 'manuel@gmail.pt', '965896589', '+351', 10, 1672157137, 1672157137, 'SqIiyieRDtaSYqI_SeyZkp72KjaVbn3X_1672157137');


INSERT INTO `admin`(admin_id) VALUES
(1);


INSERT INTO `employee_function`(id,name,state) VALUES
(1,"Limpeza",1),
(2,"Empregado de Balcão",0),
(3,"Piloto",1),
(4,"Co-Piloto",1),
(5,"Segurança",1),
(6,"Comissário de bordo",1),
(7,"Carregador de bagagem",1);


INSERT INTO `employee` (`employee_id`, `tin`, `num_emp`, `ssn`, `street`, `zip_code`, `iban`, `qualifications`, `function_id`) VALUES
(2, '123321432', 'a121112', '312123412', 'Rua Principal nº6', '2530-321', 'PT50123123123123123123123', 'Curso técnico superior profissional', 1),
(3, '123456444', 'a123321', '567431987', 'Rua das Amoreiras nº3', '2530-555', 'PT50948594069485013430405', 'Ensino superior - bacharelato ou equivalente', 3),
(7, '143041950', 'a3311223', '123414613', 'Travessa das flores nº4', '2819-312', 'PT50123123863123167423999', 'Diploma de Especialização Tecnológica', 5),
(8, '869962468', 'a121133', '759639452', 'Rua de coimbra nº83', '2600-412', 'PT50123689253183129967499', 'Mestrado', 4),
(9, '759698325', 'a121415', '964759823', 'Rua de Faro nº31', '2800-513', 'PT50678523689426587125389', 'Doutoramento', 7);


INSERT INTO `client` (client_id) VALUES 
(4),
(5),
(6),
(10),
(11),
(12),
(13),
(14),
(15);

INSERT INTO `store` (`id`, `name`, `description`, `phone`, `open_time`, `close_time`, `logo`, `website`) VALUES
(1, 'Acium', 'A Acium apresenta uma proposta única no segmento de joias, refletindo a sua energia criativa e moderna, e um estilo de vida em que o minimalismo e simplicidade são fortemente marcados pelas cores universais preto e branco.', '912965258', '08:00:00', '20:00:00', 'Logo_16-12-2022_12-27.jpg', 'https://acium.pt'),
(2, 'Benfica Official Store', 'Para os amantes de vermelho e branco visitar esta loja é obrigatório. Equipe-se com as cores do seu clube do coração.', '986542687', '06:00:00', '23:30:00', 'Logo_16-12-2022_12-30.jpg', 'https://www.slbenfica.pt/pt-pt/loja'),
(3, 'Hugo boss', 'Hugo Boss é sinónimo de moda. As suas coleções dinâmicas e cosmopolitas variam entre os visuais desportivos e jovens, e os estilos mais requintados e luxuosos', '984256325', '06:00:00', '22:00:00', 'Logo_16-12-2022_12-32.jpg', 'https://www.hugoboss.com/pt/pt/home'),
(4, 'Lacoste', 'Originalmente criada como marca desportiva, Lacoste continua a inovar no mundo da moda e acessórios, sendo um símbolo de elegância intemporal desde 1933.', '9856321456', '06:00:00', '22:00:00', 'Logo_16-12-2022_12-35.png', 'https://www.lacoste.com/pt/'),
(5, 'Fnac', 'Para quem procura o melhor entretenimento para a sua viagem, esta é uma paragem obrigatória - literatura, música, videojogos, gadgets e, ainda, uma divertida área dedicada aos mais novos, a Fnac Kids.', '965124369', '07:00:00', '09:00:00', 'Logo_16-12-2022_12-38.jpg', 'https://www.fnac.pt');


INSERT INTO `restaurant` (`id`, `name`, `description`, `phone`, `open_time`, `close_time`, `logo`, `website`) VALUES
(1, 'Burger King', 'Restaurante de hamburguers', '911111111', '05:00:00', '23:59:00', 'Logo_15-12-2022_20-49.png', 'https://www.burgerking.pt/home'),
(2, 'Delta', 'Café', '912222222', NULL, NULL, 'Logo_15-12-2022_20-50.png', 'https://www.deltacafes.pt/'),
(3, 'KFC', 'Restaurante de carne', '913333333', '08:00:00', '23:59:00', 'Logo_15-12-2022_20-52.png', 'https://www.kfc.pt/'),
(4, 'McDonalds', 'Restaurante de hamburguers', '914444444', '08:00:00', '02:00:00', 'Logo_15-12-2022_20-53.png', 'https://www.mcdonalds.pt/'),
(5, 'Starbucks', 'Café e pastelaria', '915555555', '09:00:00', '22:00:00', 'Logo_15-12-2022_20-55.png', 'https://www.starbucks.pt/');

INSERT INTO `restaurant_item` (`id`, `item`, `image`, `state`, `restaurant_id`) VALUES
(1, 'Big Mac', 'Big Mac_15-12-2022_20-49.png', 1, 4),
(2, 'Big Tasty', 'Big Tasty_15-12-2022_20-49.png', 1, 4),
(3, 'CBO', 'CBO_15-12-2022_20-49.png', 1, 4),
(4, 'Chicken McNuggets', 'Chicken McNuggets_15-12-2022_20-49.png', 1, 4),
(5, 'Brutal Bacon', 'Brutal Bacon_15-12-2022_20-49.png', 1, 1),
(6, 'King Chicken', 'King Chicken_15-12-2022_20-49.png', 1, 1),
(7, 'Whopper', 'Whopper_15-12-2022_20-49.png', 1, 1),
(8, 'Big King XXL', 'Big King XXL_15-12-2022_20-49.png', 1, 1),
(9, 'Buger Double', 'Buger Double_15-12-2022_20-49.png', 1, 3),
(10, 'BBC', 'BBC_15-12-2022_20-49.png', 1, 3),
(11, 'Iced Latte', 'Iced Latte_15-12-2022_20-49.png', 1, 5),
(12, 'Caffe Americano', 'Caffe Americano_15-12-2022_20-49.png', 1, 5);


INSERT INTO `manager`(`manager_id`,`restaurant_id`) VALUES
(16,1);

INSERT INTO `company` (`id`, `name`, `state`) VALUES
(1, 'TAP Portugal', 1),
(2, 'Ryanair', 1),
(3, 'EasyJet Europe', 1),
(4, 'Iberia', 0);


INSERT INTO `airplane` (`id`, `name`, `capacity`, `state`, `company_id`) VALUES
(1, 'Hawker Hurricane', 120, 1, 1),
(2, 'U-2 spy plane', 100, 1, 3),
(3, 'B-52 Stratofortress ', 135, 1, 2),
(4, 'F-16 Fighting Falcon', 200, 1, 3),
(5, 'MiG-21 fighter', 80, 1, 2),
(6, 'Tupolev Tu-95 bomber', 60, 0, 1),
(7, 'Bf 109 fighter', 12, 0, 2),
(8, 'P-51 Mustang', 12, 0, 3);


INSERT INTO `airport` (`id`, `country`, `city`, `name`, `website`) VALUES
(1, 'Portugal', 'Lisboa', 'ANA Aeroporto de Lisboa', 'https://www.aeroportolisboa.pt/pt/lis/home'),
(2, 'Portugal', 'Porto', 'ANA Aeroporto do Porto', 'https://www.aeroportoporto.pt/pt/opo/home'),
(3, 'Portugal', 'Faro', 'ANA Aeroporto de Faro', 'https://www.aeroportofaro.pt/pt/fao/home'),
(4, 'Espanha', 'Madrid', 'Aena Aeropuerto de Madrid-Barajas', 'https://www.aena.es/es/adolfo-suarez-madrid-baraja'),
(5, 'Espanha', 'Burgos', 'Aena Aeropuerto de Burgos', 'https://www.aena.es/es/burgos.html'),
(6, 'Espanha', 'Ibiza', 'Aena Aeropuerto de Ibiza', 'https://www.aena.es/es/ibiza.html'),
(7, 'França', 'Paris', 'Paris Aéroport', 'https://www.parisaeroport.fr/'),
(8, 'França', 'Marseille', 'Aéroport Marseille Provence', 'https://www.marseille.aeroport.fr/'),
(9, 'França', 'Lyon', 'Lyon Aéroport', 'https://www.lyonaeroports.com/');

INSERT INTO `payment_method` (`id`,`name`,`state`) VALUES
(1,'Cartão de crédito',1),
(2,'Cartão de débito',1),
(3,'MBWay',0),
(4,'Multibanco',1),
(5,'Paypal',0);


INSERT INTO `lost_item` (`id`, `description`, `state`, `image`) VALUES
(1, 'Camisa às riscas azul e branca.', 'Entregue', '19-12-2022_20-03-20.jpg'),
(2, 'Camisa vermelha, marca BOSS.', 'Perdido', '19-12-2022_20-04-20.jpg'),
(3, 'Casaco azul de inverno para mulher.', 'Perdido', '19-12-2022_20-06-34.jpg'),
(4, 'Casaco cinzento da Lacoste.', 'Perdido', '19-12-2022_20-09-46.jpg'),
(5, 'Casaco preto da carhatt de inverno.', 'Perdido', '19-12-2022_20-10-56.jpg'),
(6, 'Mala de viagem cinzenta com 20kg.', 'Perdido', '19-12-2022_20-11-37.jfif'),
(7, 'Mala de viagem preta 20kg', 'Perdido', '19-12-2022_20-12-20.jpg'),
(8, 'Mala de viagem verde da PepeJeans de 10kg', 'Perdido', '19-12-2022_20-12-56.jpg'),
(9, 'Mala de viagem vermelha com código na parte lateral de 20kg', 'Perdido', '19-12-2022_20-13-29.jpg'),
(10, 'Mala de viagem azul da ITACA de 20kg', 'Perdido', '19-12-2022_20-14-19.jpeg'),
(11, 'Mochila de escola da Nike azul.', 'Perdido', '19-12-2022_20-15-13.jpg'),
(12, 'Mochila de escola da Nike cor-de-rosa.', 'Perdido', '19-12-2022_20-15-48.png');

INSERT INTO `flight`
(`id`, `terminal`, `estimated_departure_date`, `estimated_arrival_date`, `departure_date`, `arrival_date`, `price`, `distance`, `state`,`passengers_left`, `discount_percentage`, `origin_airport_id`, `arrival_airport_id`, `airplane_id`)
VALUES
(1, 'T1', '2023-01-28 13:30:00', '2023-01-28 15:00:00', '2023-01-28 13:30:00', '2023-01-28 15:00:00', 100, 300, 'Previsto', 120, 0, 1, 3, 1),
(2, 'T2', '2023-01-28 08:00:00', '2023-01-28 09:30:00', '2023-01-28 08:00:00', '2023-01-28 09:30:00', 130, 300, 'Previsto', 100, 5, 1, 3, 2),
(3, 'T3', '2023-01-30 08:00:00', '2023-01-30 09:30:00', '2023-01-30 08:00:00', '2023-01-30 09:30:00', 100, 300, 'Previsto', 135, 0, 3, 1, 3),
(4, 'T2', '2023-01-31 11:00:00', '2023-01-31 12:30:00', '2023-01-31 11:00:00', '2023-01-31 12:30:00', 130, 300, 'Previsto', 12, 0, 3, 1, 8),
(5, 'T1', '2023-02-26 12:00:00', '2023-02-26 14:30:00', '2023-02-26 12:00:00', '2023-02-26 14:30:00', 100, 279, 'Previsto', 80, 0, 3, 1, 5),
(6, 'T3', '2023-03-15 21:00:00', '2023-03-16 23:25:00', '2023-03-15 21:00:00', '2023-03-16 23:25:00', 130, 1109, 'Previsto', 60, 5, 6, 7, 6),
(7, 'T1', '2023-03-07 16:30:00', '2023-03-07 17:30:00', '2023-03-07 16:30:00', '2023-03-07 17:30:00', 100, 279, 'Previsto', 12, 0, 1, 3, 7),
(8, 'T1', '2023-03-15 07:00:00', '2023-03-16 10:25:00', '2023-03-15 07:00:00', '2023-03-16 10:25:00', 130, 1109, 'Previsto', 120, 5, 6, 7, 1),
(9, 'T3', '2023-04-07 13:30:00', '2023-04-07 15:30:00', '2023-04-07 13:30:00', '2023-04-07 15:30:00', 100, 279, 'Previsto', 100, 0, 1, 3, 2),
(10, 'T2', '2023-04-15 09:00:00', '2023-04-16 10:25:00', '2023-04-15 09:00:00', '2023-04-16 10:25:00', 130, 1109, 'Previsto', 135, 5, 6, 7, 3),
(11, 'T3', '2023-04-07 13:30:00', '2023-04-07 22:30:00', '2023-04-07 13:30:00', '2023-04-07 22:30:00', 100, 279, 'Previsto', 200, 0, 1, 3, 4),
(12, 'T2', '2023-04-15 17:00:00', '2023-04-16 18:25:00', '2023-04-15 17:00:00', '2023-04-16 18:25:00', 130, 1109, 'Previsto', 60, 5, 6, 7, 6),
(13, 'T1', '2023-04-07 13:30:00', '2023-04-07 22:30:00', '2023-04-07 13:30:00', '2023-04-07 22:30:00', 100, 279, 'Previsto', 80, 0, 1, 3, 5),
(14, 'T2', '2023-05-15 08:00:00', '2023-05-16 12:25:00', '2023-05-15 08:00:00', '2023-05-16 12:25:00', 130, 1109, 'Previsto', 12, 5, 6, 7, 8),
(15, 'T1', '2023-05-07 21:30:00', '2023-05-07 22:30:00', '2023-05-07 21:30:00', '2023-05-07 22:30:00', 100, 279, 'Previsto', 120, 0, 1, 3, 1),
(16, 'T2', '2023-05-15 03:00:00', '2023-05-16 04:25:00', '2023-05-15 03:00:00', '2023-05-16 04:25:00', 130, 1109, 'Previsto', 100, 0, 6, 7, 2),
(17, 'T3', '2023-05-30 23:45:00', '2023-05-30 01:45:00', '2023-05-30 23:45:00', '2023-05-30 01:45:00', 200, 1223, 'Previsto', 80, 0, 4, 9, 5);

INSERT INTO `flight_ticket` 
(`flight_ticket_id`, `price`, `purchase_date`, `checkin`, `client_id`, `flight_id`, `payment_method_id`) 
VALUES
(1, 100, '2022-12-25 13:30:00', 0, 4, 1, 1),
(2, 100, '2023-01-01 10:45:00', 0, 5, 1, 2),
(3, 100, '2023-01-03 13:30:00', 0, 4, 3, 4),
(4, 100, '2022-12-25 13:30:00', 0, 5, 4, 1),
(5, 100, '2022-12-25 13:30:00', 0, 4, 15, 3),
(6, 130, '2022-12-25 13:30:00', 0, 4, 17, 1);

INSERT INTO `passenger`
(`id`, `name`, `gender`, `extra_baggage`, `seat`, `flight_ticket_id`)
VALUES
(1, 'António Alberto', 'Masculino', 0, 'A1', 1),
(2, 'Joaquim Antunes', 'Masculino', 0, 'B6', 2),
(3, 'António Alberto', 'Masculino', 0, 'C1', 3),
(4, 'Joaquim Antunes', 'Masculino', 0, 'R1', 4),
(5, 'António Alberto', 'Masculino', 0, 'A1', 5),
(6, 'António Alberto', 'Masculino', 0, 'A2', 6);

INSERT INTO `support_ticket` (`id`,`title`,`state`,`client_id`) VALUES
(1, 'Camisola Perdida', 'Concluido', 4),
(2, 'Mala Perdida', 'Por Rever', 4),
(3, 'Mala de Viagem' , 'Por Rever', 5);

INSERT INTO `ticket_item` (`lost_item_id`,`support_ticket_id`) VALUES
(1,1);

INSERT INTO `ticket_message` (`id`, `message`, `sender_id`, `support_ticket_id`) VALUES
(1, 'Bom dia, gostava de saber se foi encontrada uma camisola no voo Lisboa Faro no dia 3 de janeiro.', 4,1),
(2, 'Olá, a sua camisola é uma camisola às riscas azul e branca?',2,1),
(3, 'Sim!',4,1),
(4, 'Confira se é a camisola indicada na sua lista de bilhetes, em caso de ser o indicado conclua o ticket, obrigado.',2,1);