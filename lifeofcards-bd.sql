-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 06, 2017 at 10:13 PM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES latin1 */;
CREATE USER 'id2237061_admin'@'localhost' IDENTIFIED BY 'aparecido123';
GRANT ALL PRIVILEGES ON * . * TO 'id2237061_admin'@'localhost';
FLUSH PRIVILEGES;
--
-- Database: `id2237061_lifeofcards`
--
CREATE DATABASE IF NOT EXISTS `id2237061_lifeofcards` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `id2237061_lifeofcards`;

-- --------------------------------------------------------

--
-- Table structure for table `Amizades`
--

CREATE TABLE `Amizades` (
  `IDusuario` int(4) NOT NULL,
  `Nickname` varchar(42) NOT NULL,
  `Vitorias` int(4) NOT NULL,
  `Derrotas` int(4) NOT NULL,
  `Comentario` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Amizades`
--

INSERT INTO `Amizades` (`IDusuario`, `Nickname`, `Vitorias`, `Derrotas`, `Comentario`) VALUES
(10, 'Jonas das manon', 0, 0, ''),
(10, 'nickname', 0, 0, ''),
(10, 'Rual', 0, 0, ''),
(10, 'teste', 0, 0, ''),
(11, 'Jonas das manon', 0, 0, ''),
(11, 'Lucão', 0, 0, ''),
(11, 'teste123', 0, 0, ''),
(12, 'Lucão', 0, 0, ''),
(12, 'pintovaldo', 0, 0, ''),
(41, 'Lucão', 0, 0, ''),
(41, 'Rual', 0, 0, ''),
(41, 'Test', 0, 0, ''),
(41, 'teste', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `Cartas`
--

CREATE TABLE `Cartas` (
  `IDcarta` int(4) NOT NULL,
  `TabNum` int(1) NOT NULL DEFAULT '1',
  `General` tinyint(1) NOT NULL,
  `Ataque` int(2) NOT NULL,
  `Vida` int(2) NOT NULL,
  `IDtema` int(2) NOT NULL,
  `IDpacote` int(2) NOT NULL,
  `arquivo.sprite` varchar(80) NOT NULL,
  `Descricao` varchar(200) NOT NULL,
  `Nome` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Chave estrangeira bem louca';

--
-- Dumping data for table `Cartas`
--

INSERT INTO `Cartas` (`IDcarta`, `TabNum`, `General`, `Ataque`, `Vida`, `IDtema`, `IDpacote`, `arquivo.sprite`, `Descricao`, `Nome`) VALUES
(1, 1, 1, 2, 20, 1, 3, '10.jpg', 'Mudar postura: Alterna para corpo-a-corpo criaturas de longa distância e vice-versa. Quando isso ocorre, fornece +1/+1 para criaturas. Criaturas corpo-a-corpo recebem +0/+1 sempre', 'Ananias'),
(2, 1, 1, 2, 20, 2, 3, '11.jpg', 'Parece que as cartas ficam mais fortes ou fracas dependendo do tempo dentro do jogo.', 'Jonas'),
(3, 1, 1, 2, 20, 3, 3, '12.jpg', 'Deck padrão de swarm', 'Mamonas'),
(4, 1, 0, 0, 0, 1, 3, '4.jpg', 'This legendary dragon is a powerful engine of destruction', 'Blue-Eyes White Dragon'),
(5, 1, 0, 0, 0, 1, 2, '5.jpg', 'Protection from everythinh', 'Progenitus'),
(6, 1, 0, 0, 0, 2, 3, '6.jpg', 'Legendary Creature', 'Laurence'),
(7, 1, 0, 0, 0, 4, 2, '7.jpg', 'Creature', 'Mana-Charged Dragon'),
(8, 1, 0, 0, 0, 3, 1, '8.jpg', 'Chuck Norris is indestructible and can\'t be countered', 'Chuck Norris'),
(9, 1, 0, 0, 0, 4, 2, '9.jpg', 'Top-performing automation', 'Arcbound Ravager'),
(13, 1, 0, 0, 0, 1, 1, '1.jpg', 'Whenever a Dragon you control attacks, put a red Dragon in your hand', 'Utvara Hellkite'),
(14, 1, 0, 0, 0, 1, 2, '2.jpg', 'The only prophecies he tells are those of destruction', 'Dragon\'s Prophet'),
(15, 1, 0, 0, 0, 1, 2, '3.jpg', 'When Noxious Gearhulk enters the battlefield, you lose.', 'Noxious Gearhulk');

-- --------------------------------------------------------

--
-- Table structure for table `Cartas_Deck`
--

CREATE TABLE `Cartas_Deck` (
  `IDdeck` int(4) NOT NULL,
  `IDcarta` int(4) NOT NULL,
  `QtdeCartas` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Cartas_Deck`
--

INSERT INTO `Cartas_Deck` (`IDdeck`, `IDcarta`, `QtdeCartas`) VALUES
(9, 1, 1),
(9, 4, 1),
(9, 5, 2),
(9, 7, 3),
(10, 2, 1),
(10, 6, 3),
(10, 7, 3),
(11, 5, 2),
(11, 6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `Cartas_Usuario`
--

CREATE TABLE `Cartas_Usuario` (
  `IDusuario` int(4) NOT NULL,
  `IDcarta` int(4) NOT NULL,
  `Qtde` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Cartas_Usuario`
--

INSERT INTO `Cartas_Usuario` (`IDusuario`, `IDcarta`, `Qtde`) VALUES
(10, 1, 0),
(10, 2, 0),
(10, 3, 0),
(10, 4, 3),
(10, 5, 3),
(10, 6, 3),
(10, 7, 3),
(10, 8, 3),
(10, 9, 3),
(10, 13, 3),
(10, 14, 3),
(11, 1, 0),
(11, 2, 0),
(11, 3, 0),
(11, 4, 1),
(11, 5, 2),
(11, 6, 3),
(11, 7, 3),
(11, 8, 2),
(12, 1, 0),
(12, 2, 0),
(12, 3, 0),
(12, 4, 3),
(12, 5, 3),
(12, 6, 3),
(12, 7, 3),
(12, 8, 3),
(12, 9, 3),
(12, 13, 3),
(12, 14, 3),
(37, 1, 2),
(37, 2, 2),
(37, 3, 2),
(37, 4, 2),
(37, 5, 1),
(37, 6, 2),
(37, 7, 1),
(37, 8, 1),
(37, 9, 1),
(37, 13, 1),
(37, 14, 1),
(37, 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `DeckUsuario`
--

CREATE TABLE `DeckUsuario` (
  `IDdeck` int(4) NOT NULL,
  `IDusuario` int(4) NOT NULL,
  `Descricao` varchar(100) NOT NULL,
  `Nome` varchar(20) NOT NULL,
  `ImagemDeck` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `DeckUsuario`
--

INSERT INTO `DeckUsuario` (`IDdeck`, `IDusuario`, `Descricao`, `Nome`, `ImagemDeck`) VALUES
(9, 11, 'Deck Criado', 'Furia_Do_Bob_Esponja', '10.jpg'),
(10, 11, 'Deck Criado', 'Latorresmo', '3.jpg'),
(11, 11, 'Deck Criado', '', '11.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `Habilidades`
--

CREATE TABLE `Habilidades` (
  `IDcarta` int(4) NOT NULL,
  `IDhabilidade` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Loja`
--

CREATE TABLE `Loja` (
  `IDproduto` int(4) NOT NULL,
  `TabNum` int(2) NOT NULL,
  `Preço` int(6) NOT NULL,
  `IDpromocao` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Loja`
--

INSERT INTO `Loja` (`IDproduto`, `TabNum`, `Preço`, `IDpromocao`) VALUES
(1, 3, 300, 1),
(2, 3, 300, 1),
(3, 3, 350, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Nivel`
--

CREATE TABLE `Nivel` (
  `Nivel` int(4) NOT NULL,
  `XPnecessaria` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Nivel`
--

INSERT INTO `Nivel` (`Nivel`, `XPnecessaria`) VALUES
(1, -1),
(2, 100),
(3, 200),
(4, 400),
(5, 600),
(6, 900),
(7, 1200),
(1338, 1337),
(8, 1500);

-- --------------------------------------------------------

--
-- Table structure for table `Noticias`
--

CREATE TABLE `Noticias` (
  `IDnoticia` int(4) NOT NULL,
  `Descrição` varchar(100) NOT NULL,
  `Data` date NOT NULL,
  `Título` varchar(42) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Noticias`
--

INSERT INTO `Noticias` (`IDnoticia`, `Descrição`, `Data`, `Título`) VALUES
(1, 'Site agora recebe informações do banco de dados!!!! WOWOWOWOW.', '2017-09-29', 'Atualizações');

-- --------------------------------------------------------

--
-- Table structure for table `Pacote`
--

CREATE TABLE `Pacote` (
  `IDpacote` int(4) NOT NULL,
  `TabNum` int(1) NOT NULL DEFAULT '3',
  `Nome` varchar(42) NOT NULL,
  `QtdeCartas/pacote` int(2) NOT NULL,
  `Descricao` varchar(100) NOT NULL,
  `ImagemPacote` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Pacote`
--

INSERT INTO `Pacote` (`IDpacote`, `TabNum`, `Nome`, `QtdeCartas/pacote`, `Descricao`, `ImagemPacote`) VALUES
(1, 3, 'Viking Pack', 5, 'Muito ataque e defesa', 'viking.jpg'),
(2, 3, 'Eagle Pack', 5, 'Muito ataque, pouca defesa', 'eagle.jpg'),
(3, 3, 'Three Eyes Pack', 5, 'Muita defesa, mas pouco ataque', '3eyes.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `Promocao`
--

CREATE TABLE `promocao` (
  `IDpromocao` int(4) NOT NULL,
  `Valor` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Promocao`
--

INSERT INTO `Promocao` (`IDpromocao`, `Valor`) VALUES
(2, 0.85),
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Skin`
--

CREATE TABLE `Skin` (
  `IDskin` int(4) NOT NULL,
  `TabNum` int(2) NOT NULL DEFAULT '2',
  `IDcarta` int(4) NOT NULL,
  `Nome` varchar(42) NOT NULL,
  `Descricao` varchar(70) NOT NULL,
  `ImagemSkin` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TabID`
--

CREATE TABLE `TabID` (
  `TabNum` int(5) NOT NULL,
  `TabNome` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TabID`
--

INSERT INTO `TabID` (`TabNum`, `TabNome`) VALUES
(1, 'Cartas'),
(2, 'Skin'),
(3, 'Pacote');

-- --------------------------------------------------------

--
-- Table structure for table `Usuario`
--

CREATE TABLE `Usuario` (
  `IDusuario` int(11) NOT NULL,
  `Nome` varchar(15) DEFAULT NULL,
  `Sexo` varchar(8) DEFAULT NULL,
  `Login` varchar(30) NOT NULL,
  `Senha` varchar(15) NOT NULL,
  `Endereço` varchar(70) DEFAULT NULL,
  `Email` varchar(42) NOT NULL,
  `Nascimento` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela do usuario';

--
-- Dumping data for table `Usuario`
--

INSERT INTO `Usuario` (`IDusuario`, `Nome`, `Sexo`, `Login`, `Senha`, `Endereço`, `Email`, `Nascimento`) VALUES
(10, NULL, 'Masculin', 'lucas', '123', 'Sao Paulo', 'lucasrodrigues10@outlook.com', 23),
(11, NULL, 'Masc', 'raul', '123', 'Brasil', 'raul.vaz@uol.com.br', 21),
(12, NULL, NULL, 'pintovaldo', '123', NULL, 'johnltc@yahoo.com.br', NULL),
(13, NULL, NULL, 'chahestian@hotmail.com', '270396', NULL, 'chahestian@hotmail.com', NULL),
(15, NULL, NULL, 'testeusuario2', '123', NULL, 'ab@cd.com', NULL),
(16, NULL, '3', 'dz2', '123', '2', 'testeusuario10@email.com', 1),
(17, NULL, NULL, 'vzxa', '123', NULL, 'testeusuario11@email.com', NULL),
(18, NULL, NULL, 'aefde', '123', NULL, 'testeusuario12@email.com', NULL),
(19, NULL, NULL, 'hvL6sn5XVwdZsXXav9FC9rmekYEWff', '123', NULL, 'testeusuario13@email.com', NULL),
(20, NULL, NULL, '6RJhGi9mI59EYCJ2hZeHkaaTcqIrh0', '123', NULL, 'testeusuario14@email.com', NULL),
(21, NULL, NULL, 'senha1', 'dascs', NULL, 'testesenha1@email.com', NULL),
(22, NULL, NULL, 'senha2', '6U5diq', NULL, 'testesenha2@email.com', NULL),
(23, NULL, NULL, 'senha3', '12d5231', NULL, 'testesenha3@email.com', NULL),
(24, NULL, NULL, 'senha4', 'CMJ6hhTpZL8CN2J', NULL, 'testesenha4@email.com', NULL),
(25, NULL, NULL, 'senha5', 'QF5HYQW7qwhFQZT', NULL, 'testesenha5@email.com', NULL),
(34, NULL, NULL, 'teste123', '123', NULL, '123@123', NULL),
(35, NULL, NULL, 'testenick', '123', NULL, 'testenick@email.com', NULL),
(36, NULL, NULL, 'raid', '123', NULL, 'raidraid@raid.com', NULL),
(37, NULL, 'b', 'test', 'test', 'a', 'test@test.test', 13),
(38, NULL, NULL, 'lucas12039', 'eoqwkpe12', NULL, 'lucasrodrigues101@outlook.com', NULL),
(39, NULL, NULL, 'lalalou', 'rewr32', NULL, 'teste213423@email.com', NULL),
(40, NULL, NULL, 'fasdf2', '123as', NULL, 'lksdf@meail.com', NULL),
(41, NULL, NULL, 'usuario', '123', NULL, 'usuario@email.com', NULL),
(42, NULL, NULL, 'jonas', '123', NULL, 'assas@fffa.com.br', NULL),
(43, NULL, NULL, 'testao', 'testao', NULL, 'abc@bcas.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `UsuarioNoJogo`
--

CREATE TABLE `UsuarioNoJogo` (
  `Nickname` varchar(15) NOT NULL,
  `Moedas` int(6) NOT NULL,
  `Experiencia` int(20) NOT NULL,
  `img_avatar.arquivo` varchar(100) NOT NULL,
  `Vitorias` int(4) NOT NULL,
  `Derrotas` int(4) NOT NULL,
  `IDusuario` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `UsuarioNoJogo`
--

INSERT INTO `UsuarioNoJogo` (`Nickname`, `Moedas`, `Experiencia`, `img_avatar.arquivo`, `Vitorias`, `Derrotas`, `IDusuario`) VALUES
('aaaaaaa', 0, 0, '', 0, 0, 16),
('Jonas das manon', 0, 0, '', 0, 0, 13),
('Lucão', 0, 80, '', 0, 0, 10),
('nickname', 0, 0, '', 0, 0, 41),
('pintovaldo', 0, 0, 'gato.jpg', 0, 0, 12),
('Ra1D', 0, 0, '', 0, 0, 36),
('Rual', -10, 0, 'cachorro.jpg', 0, 200, 11),
('Test', 10003, 0, 'motoca.jpg', 0, 0, 37),
('teste', 0, 0, '', 0, 0, 40),
('teste123', 0, 0, '', 0, 0, 35);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Amizades`
--
ALTER TABLE `Amizades`
  ADD PRIMARY KEY (`IDusuario`,`Nickname`),
  ADD KEY `Amizade_Nickname` (`Nickname`);

--
-- Indexes for table `Cartas`
--
ALTER TABLE `Cartas`
  ADD PRIMARY KEY (`IDcarta`),
  ADD UNIQUE KEY `arquivo.sprite` (`arquivo.sprite`),
  ADD UNIQUE KEY `arquivo.sprite_2` (`arquivo.sprite`),
  ADD KEY `Carta_pacote` (`IDpacote`),
  ADD KEY `TabNum_Cartas` (`TabNum`);

--
-- Indexes for table `Cartas_Deck`
--
ALTER TABLE `Cartas_Deck`
  ADD PRIMARY KEY (`IDdeck`,`IDcarta`),
  ADD KEY `Carta_Deck` (`IDcarta`);

--
-- Indexes for table `Cartas_Usuario`
--
ALTER TABLE `Cartas_Usuario`
  ADD PRIMARY KEY (`IDusuario`,`IDcarta`),
  ADD KEY `Definição_Cartas` (`IDcarta`);

--
-- Indexes for table `DeckUsuario`
--
ALTER TABLE `DeckUsuario`
  ADD PRIMARY KEY (`IDdeck`),
  ADD KEY `Usuario_Deck` (`IDusuario`);

--
-- Indexes for table `Habilidades`
--
ALTER TABLE `Habilidades`
  ADD PRIMARY KEY (`IDcarta`,`IDhabilidade`);

--
-- Indexes for table `Loja`
--
ALTER TABLE `Loja`
  ADD PRIMARY KEY (`IDproduto`,`TabNum`),
  ADD KEY `Promocao` (`IDpromocao`),
  ADD KEY `TabNum_Loja` (`TabNum`);

--
-- Indexes for table `Nivel`
--
ALTER TABLE `Nivel`
  ADD PRIMARY KEY (`Nivel`),
  ADD UNIQUE KEY `XPnecessaria` (`XPnecessaria`);

--
-- Indexes for table `Noticias`
--
ALTER TABLE `Noticias`
  ADD PRIMARY KEY (`IDnoticia`);

--
-- Indexes for table `Pacote`
--
ALTER TABLE `Pacote`
  ADD PRIMARY KEY (`IDpacote`),
  ADD UNIQUE KEY `Imagem` (`ImagemPacote`),
  ADD KEY `TabNum` (`TabNum`);

--
-- Indexes for table `promocao`
--
ALTER TABLE `Promocao`
  ADD PRIMARY KEY (`IDpromocao`),
  ADD UNIQUE KEY `Valor` (`Valor`);
  
--
-- Indexes for table `Skin`
--
ALTER TABLE `Skin`
  ADD PRIMARY KEY (`IDskin`),
  ADD KEY `Skin_Carta` (`IDcarta`),
  ADD KEY `TabNum_Skin` (`TabNum`);

--
-- Indexes for table `TabID`
--
ALTER TABLE `TabID`
  ADD PRIMARY KEY (`TabNum`);

--
-- Indexes for table `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`IDusuario`);

--
-- Indexes for table `UsuarioNoJogo`
--
ALTER TABLE `UsuarioNoJogo`
  ADD PRIMARY KEY (`Nickname`),
  ADD UNIQUE KEY `IDusuario` (`IDusuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Cartas`
--
ALTER TABLE `Cartas`
  MODIFY `IDcarta` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `DeckUsuario`
--
ALTER TABLE `DeckUsuario`
  MODIFY `IDdeck` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `Nivel`
--
ALTER TABLE `Nivel`
  MODIFY `Nivel` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1338;
--
-- AUTO_INCREMENT for table `Noticias`
--
ALTER TABLE `Noticias`
  MODIFY `IDnoticia` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Pacote`
--
ALTER TABLE `Pacote`
  MODIFY `IDpacote` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `promocao`
--
ALTER TABLE `promocao`
  MODIFY `IDpromocao` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Skin`
--
ALTER TABLE `Skin`
  MODIFY `IDskin` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `IDusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Amizades`
--
ALTER TABLE `Amizades`
  ADD CONSTRAINT `Amizade_Nickname` FOREIGN KEY (`Nickname`) REFERENCES `UsuarioNoJogo` (`Nickname`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Amizade_Usuario` FOREIGN KEY (`IDusuario`) REFERENCES `Usuario` (`IDusuario`) ON UPDATE CASCADE;

--
-- Constraints for table `Cartas`
--
ALTER TABLE `Cartas`
  ADD CONSTRAINT `Carta_pacote` FOREIGN KEY (`IDpacote`) REFERENCES `Pacote` (`IDpacote`) ON UPDATE CASCADE,
  ADD CONSTRAINT `TabNum_Cartas` FOREIGN KEY (`TabNum`) REFERENCES `TabID` (`TabNum`) ON UPDATE CASCADE;

--
-- Constraints for table `Cartas_Deck`
--
ALTER TABLE `Cartas_Deck`
  ADD CONSTRAINT `Carta_Deck` FOREIGN KEY (`IDcarta`) REFERENCES `Cartas` (`IDcarta`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Deck_Deck` FOREIGN KEY (`IDdeck`) REFERENCES `DeckUsuario` (`IDdeck`) ON UPDATE CASCADE;

--
-- Constraints for table `Cartas_Usuario`
--
ALTER TABLE `Cartas_Usuario`
  ADD CONSTRAINT `Definição_Cartas` FOREIGN KEY (`IDcarta`) REFERENCES `Cartas` (`IDcarta`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Usuario_e_suas_cartas` FOREIGN KEY (`IDusuario`) REFERENCES `Usuario` (`IDusuario`) ON UPDATE CASCADE;

--
-- Constraints for table `DeckUsuario`
--
ALTER TABLE `DeckUsuario`
  ADD CONSTRAINT `Usuario_Deck` FOREIGN KEY (`IDusuario`) REFERENCES `Usuario` (`IDusuario`) ON UPDATE CASCADE;

--
-- Constraints for table `Habilidades`
--
ALTER TABLE `Habilidades`
  ADD CONSTRAINT `CARTAS` FOREIGN KEY (`IDcarta`) REFERENCES `Cartas` (`IDcarta`) ON UPDATE CASCADE;

--
-- Constraints for table `Loja`
--
ALTER TABLE `Loja`
  ADD CONSTRAINT `Promocao` FOREIGN KEY (`IDpromocao`) REFERENCES `promocao` (`IDpromocao`) ON UPDATE CASCADE,
  ADD CONSTRAINT `TabNum_Loja` FOREIGN KEY (`TabNum`) REFERENCES `TabID` (`TabNum`) ON UPDATE CASCADE;

--
-- Constraints for table `Pacote`
--
ALTER TABLE `Pacote`
  ADD CONSTRAINT `Tab_Num` FOREIGN KEY (`TabNum`) REFERENCES `TabID` (`TabNum`) ON UPDATE CASCADE;

--
-- Constraints for table `Skin`
--
ALTER TABLE `Skin`
  ADD CONSTRAINT `Skin_Carta` FOREIGN KEY (`IDcarta`) REFERENCES `Cartas` (`IDcarta`) ON UPDATE CASCADE,
  ADD CONSTRAINT `TabNum_Skin` FOREIGN KEY (`TabNum`) REFERENCES `TabID` (`TabNum`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
