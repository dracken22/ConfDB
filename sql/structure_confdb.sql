-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 09 fév. 2021 à 00:03
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `confdb`
--
CREATE DATABASE IF NOT EXISTS `confdb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `confdb`;

-- --------------------------------------------------------

--
-- Structure de la table `abilities`
--

CREATE TABLE `abilities` (
  `id` int(11) NOT NULL,
  `_name` int(11) NOT NULL,
  `_rule` int(11) NOT NULL,
  `has_value` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Les compétences du jeu (bravoure, possédé) et la règle de cette compétence, traduite.';

-- --------------------------------------------------------

--
-- Structure de la table `alliances`
--

CREATE TABLE `alliances` (
  `_label` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Voies d''alliance (lumière, destin etc)';

-- --------------------------------------------------------

--
-- Structure de la table `armies`
--

CREATE TABLE `armies` (
  `_label` int(11) NOT NULL,
  `icon` text NOT NULL,
  `_alliance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Les armées (Lions, Mid Nor, etc)';

-- --------------------------------------------------------

--
-- Structure de la table `armylists`
--

CREATE TABLE `armylists` (
  `id` int(11) NOT NULL,
  `_army` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text DEFAULT NULL,
  `_language` int(11) NOT NULL,
  `_player` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `artifacts_alliances`
--

CREATE TABLE `artifacts_alliances` (
  `_card_artifact` int(11) NOT NULL,
  `_alliance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Si un artefact est associé à une voie d''alliance';

-- --------------------------------------------------------

--
-- Structure de la table `artifacts_armies`
--

CREATE TABLE `artifacts_armies` (
  `_card_artifact` int(11) NOT NULL,
  `_army` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Si un artefact est associé à une armée';

-- --------------------------------------------------------

--
-- Structure de la table `artifacts_champions`
--

CREATE TABLE `artifacts_champions` (
  `_card_artifact` int(11) NOT NULL,
  `_champion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Lien entre artefact et champions (peu importe l''incarnation)';

-- --------------------------------------------------------

--
-- Structure de la table `artifacts_fighters`
--

CREATE TABLE `artifacts_fighters` (
  `_card_artifact` int(11) NOT NULL,
  `_card_fighter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Lien entre artefact et combattant (réservé à)';

-- --------------------------------------------------------

--
-- Structure de la table `artifact_types`
--

CREATE TABLE `artifact_types` (
  `id` int(11) NOT NULL,
  `_name` int(11) NOT NULL,
  `_effect` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Les différentes familles d''artefact (potion, légendaire, poupées, vertues, ...)';

-- --------------------------------------------------------

--
-- Structure de la table `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `_name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Table parente de toutes les cartes';

-- --------------------------------------------------------

--
-- Structure de la table `card_artifacts`
--

CREATE TABLE `card_artifacts` (
  `_card` int(11) NOT NULL,
  `_point` int(11) NOT NULL,
  `_type` int(11) DEFAULT NULL,
  `_effect` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Cartes d''artefacts';

-- --------------------------------------------------------

--
-- Structure de la table `card_fighters`
--

CREATE TABLE `card_fighters` (
  `_card` int(11) NOT NULL,
  `_army` int(11) NOT NULL,
  `_point` int(11) NOT NULL,
  `_rank` int(11) NOT NULL,
  `_size` int(11) NOT NULL,
  `_pedestal` int(11) NOT NULL,
  `_gender` int(11) DEFAULT NULL,
  `_magician` int(11) DEFAULT NULL,
  `_priest` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Cartes de combattants';

-- --------------------------------------------------------

--
-- Structure de la table `card_fighters_abilities`
--

CREATE TABLE `card_fighters_abilities` (
  `_card_fighter` int(11) NOT NULL,
  `_ability` int(11) NOT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Compétences associées à un combattant';

-- --------------------------------------------------------

--
-- Structure de la table `card_fighters_classes`
--

CREATE TABLE `card_fighters_classes` (
  `_card_fighter` int(11) NOT NULL,
  `_class` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Classes d''un combattant (formor, paladin, ...)';

-- --------------------------------------------------------

--
-- Structure de la table `card_fighters_ranged_weapons`
--

CREATE TABLE `card_fighters_ranged_weapons` (
  `_card_fighter` int(11) NOT NULL,
  `_ranged_weapon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Armes de tir associées à un combattant';

-- --------------------------------------------------------

--
-- Structure de la table `card_fighters_skills`
--

CREATE TABLE `card_fighters_skills` (
  `_card_fighter` int(11) NOT NULL,
  `_skill` int(11) NOT NULL,
  `value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Valeur de caractéristiques d''un combattant (MOU, etc)';

-- --------------------------------------------------------

--
-- Structure de la table `card_fighter_champions`
--

CREATE TABLE `card_fighter_champions` (
  `_card_fighter` int(11) NOT NULL,
  `_champion` int(11) NOT NULL,
  `incarnation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Combattants champions';

-- --------------------------------------------------------

--
-- Structure de la table `card_fighter_troops`
--

CREATE TABLE `card_fighter_troops` (
  `_card_fighter` int(11) NOT NULL,
  `quantity_max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Combattants troupes';

-- --------------------------------------------------------

--
-- Structure de la table `card_images`
--

CREATE TABLE `card_images` (
  `_card` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Images pour une carte (différentes illustrations, différents fonds/template).';

-- --------------------------------------------------------

--
-- Structure de la table `card_magic_spells`
--

CREATE TABLE `card_magic_spells` (
  `_card` int(11) NOT NULL,
  `_difficulty` int(11) NOT NULL,
  `_range` int(11) NOT NULL,
  `_area` int(11) NOT NULL,
  `_duration` int(11) NOT NULL,
  `_frequency` int(11) NOT NULL,
  `_effect` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Sorts';

-- --------------------------------------------------------

--
-- Structure de la table `card_miracles`
--

CREATE TABLE `card_miracles` (
  `_card` int(11) NOT NULL,
  `creation` int(11) NOT NULL,
  `alteration` int(11) NOT NULL,
  `destruction` int(11) NOT NULL,
  `_difficulty` int(11) NOT NULL,
  `_range` int(11) NOT NULL,
  `_duration` int(11) NOT NULL,
  `_area` int(11) NOT NULL,
  `_fervor` int(11) NOT NULL,
  `_effect` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Miracles';

-- --------------------------------------------------------

--
-- Structure de la table `champions`
--

CREATE TABLE `champions` (
  `id` int(11) NOT NULL,
  `_name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Champions (indépendant de l''incarnation)';

-- --------------------------------------------------------

--
-- Structure de la table `classes`
--

CREATE TABLE `classes` (
  `_label` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Classes de combattants (formor, paladins,...)';

-- --------------------------------------------------------

--
-- Structure de la table `fighter_options`
--

CREATE TABLE `fighter_options` (
  `id` int(11) NOT NULL,
  `_label` int(11) NOT NULL,
  `_point` int(11) NOT NULL,
  `_fighter_option_group` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `fighter_options_abilities`
--

CREATE TABLE `fighter_options_abilities` (
  `_fighter_option` int(11) NOT NULL,
  `_ability` int(11) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `fighter_options_magicians`
--

CREATE TABLE `fighter_options_magicians` (
  `_fighter_option` int(11) NOT NULL,
  `_magician` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `fighter_options_priests`
--

CREATE TABLE `fighter_options_priests` (
  `_fighter_option` int(11) NOT NULL,
  `_priest` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `fighter_options_ranged_weapons`
--

CREATE TABLE `fighter_options_ranged_weapons` (
  `_fighter_option` int(11) NOT NULL,
  `_ranged_weapon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `fighter_options_skills`
--

CREATE TABLE `fighter_options_skills` (
  `_fighter_option` int(11) NOT NULL,
  `_skill` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `fighter_option_groups`
--

CREATE TABLE `fighter_option_groups` (
  `id` int(11) NOT NULL,
  `_card_fighter` int(11) NOT NULL,
  `mandatory` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `_tournament` int(11) NOT NULL,
  `_language` int(11) NOT NULL,
  `played_date` date NOT NULL,
  `publication_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Parties ayant eu lieu';

-- --------------------------------------------------------

--
-- Structure de la table `genders`
--

CREATE TABLE `genders` (
  `_label` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Genre des figurines (mâle/femelle/selon la figurine)';

-- --------------------------------------------------------

--
-- Structure de la table `labels`
--

CREATE TABLE `labels` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Table d''index des libellés';

-- --------------------------------------------------------

--
-- Structure de la table `labels_languages`
--

CREATE TABLE `labels_languages` (
  `_label` int(11) NOT NULL,
  `_language` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Libellés par langue';

-- --------------------------------------------------------

--
-- Structure de la table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `code` text NOT NULL,
  `name` text NOT NULL,
  `flag_icon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Langues d''affichage des textes';

-- --------------------------------------------------------

--
-- Structure de la table `magicians`
--

CREATE TABLE `magicians` (
  `id` int(11) NOT NULL,
  `power` int(11) DEFAULT NULL,
  `is_warrior` tinyint(1) NOT NULL DEFAULT 0,
  `_rank` int(11) DEFAULT NULL,
  `fixed_number_of_spell` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Profils de magiciens';

-- --------------------------------------------------------

--
-- Structure de la table `magicians_elements`
--

CREATE TABLE `magicians_elements` (
  `_magician` int(11) NOT NULL,
  `_magic_element` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Eléments maîtrisés par un mage';

-- --------------------------------------------------------

--
-- Structure de la table `magicians_ways`
--

CREATE TABLE `magicians_ways` (
  `_magician` int(11) NOT NULL,
  `_magic_way` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Grimoires maîtrisés par un mage';

-- --------------------------------------------------------

--
-- Structure de la table `magic_elements`
--

CREATE TABLE `magic_elements` (
  `id` int(11) NOT NULL,
  `_label` int(11) NOT NULL,
  `icon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Les éléments de la magie';

-- --------------------------------------------------------

--
-- Structure de la table `magic_spells_mana_costs`
--

CREATE TABLE `magic_spells_mana_costs` (
  `_magic_spell` int(11) NOT NULL,
  `_magic_element` int(11) NOT NULL,
  `quantity` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Les coûts en gemmes pour chaque élément d''un sort';

-- --------------------------------------------------------

--
-- Structure de la table `magic_spells_ways`
--

CREATE TABLE `magic_spells_ways` (
  `_magic_spell` int(11) NOT NULL,
  `_magic_way` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Les grimoires de chaque sort';

-- --------------------------------------------------------

--
-- Structure de la table `magic_ways`
--

CREATE TABLE `magic_ways` (
  `id` int(11) NOT NULL,
  `_name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Les grimoires';

-- --------------------------------------------------------

--
-- Structure de la table `miracle_ways`
--

CREATE TABLE `miracle_ways` (
  `id` int(11) NOT NULL,
  `_name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Les voies et panthéons de la divination';

-- --------------------------------------------------------

--
-- Structure de la table `pedestals`
--

CREATE TABLE `pedestals` (
  `_label` int(11) NOT NULL,
  `dimensions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `players`
--

CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Joueurs (pas forcément liés à un compte)';

-- --------------------------------------------------------

--
-- Structure de la table `players_games`
--

CREATE TABLE `players_games` (
  `_player` int(11) NOT NULL,
  `_game` int(11) NOT NULL,
  `_armylist` int(11) DEFAULT NULL,
  `victory_points` int(11) DEFAULT NULL,
  `goal_average` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Joueur ayant participé à une partie';

-- --------------------------------------------------------

--
-- Structure de la table `points`
--

CREATE TABLE `points` (
  `id` int(11) NOT NULL,
  `fix_points` int(11) NOT NULL,
  `calculation_rule` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Coût en PA d''une carte, d''un item.';

-- --------------------------------------------------------

--
-- Structure de la table `priests`
--

CREATE TABLE `priests` (
  `id` int(11) NOT NULL,
  `creation` int(11) NOT NULL,
  `alteration` int(11) NOT NULL,
  `destruction` int(11) NOT NULL,
  `is_warrior` tinyint(1) NOT NULL DEFAULT 0,
  `_rank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Profils de prêtre';

-- --------------------------------------------------------

--
-- Structure de la table `priests_miracle_ways`
--

CREATE TABLE `priests_miracle_ways` (
  `_priest` int(11) NOT NULL,
  `_miracle_way` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Panthéons auxquels a accès un prêtre';

-- --------------------------------------------------------

--
-- Structure de la table `races`
--

CREATE TABLE `races` (
  `id` int(11) NOT NULL,
  `_name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Race d''une figurine (Wolfen, elfe, ogre, nain, ...)';

-- --------------------------------------------------------

--
-- Structure de la table `ranged_weapons`
--

CREATE TABLE `ranged_weapons` (
  `id` int(11) NOT NULL,
  `_name` int(11) NOT NULL,
  `accuracy` int(11) NOT NULL,
  `weapon_strength` int(11) NOT NULL,
  `short_range` int(11) DEFAULT NULL,
  `medium_range` int(11) DEFAULT NULL,
  `long_range` int(11) DEFAULT NULL,
  `piercing` tinyint(1) NOT NULL DEFAULT 0,
  `splash` tinyint(1) NOT NULL DEFAULT 0,
  `heavy` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Armes de tir';

-- --------------------------------------------------------

--
-- Structure de la table `ranks`
--

CREATE TABLE `ranks` (
  `_label` int(11) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Rangs des profils (special, élite, vétéran, ...)';

-- --------------------------------------------------------

--
-- Structure de la table `scenarios`
--

CREATE TABLE `scenarios` (
  `id` int(11) NOT NULL,
  `_name` int(11) NOT NULL,
  `_rules` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Les scénarios et leurs règles';

-- --------------------------------------------------------

--
-- Structure de la table `sizes`
--

CREATE TABLE `sizes` (
  `_label` int(11) NOT NULL,
  `potency` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tailles des figurines (cavalier, grande taille, 2.5x5cm)';

-- --------------------------------------------------------

--
-- Structure de la table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `_name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Caractéristiques (MOU, FOR, ...)';

-- --------------------------------------------------------

--
-- Structure de la table `tournaments`
--

CREATE TABLE `tournaments` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `_language` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tournois';

-- --------------------------------------------------------

--
-- Structure de la table `usergroups`
--

CREATE TABLE `usergroups` (
  `id` int(11) NOT NULL,
  `_label` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Groupes d''utilisateurs (joueurs, admin, saisie, organisateurs de tournoi, ...)';

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `_language` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Utilisateurs du site web';

-- --------------------------------------------------------

--
-- Structure de la table `users_usergroups`
--

CREATE TABLE `users_usergroups` (
  `_user` int(11) NOT NULL,
  `_usergroup` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Lien utilisateur / groupe d''utilisateur';

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `abilities`
--
ALTER TABLE `abilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ability_name_label` (`_name`),
  ADD KEY `ability_rule_label` (`_rule`);

--
-- Index pour la table `alliances`
--
ALTER TABLE `alliances`
  ADD PRIMARY KEY (`_label`),
  ADD KEY `alliance_name` (`_label`);

--
-- Index pour la table `armies`
--
ALTER TABLE `armies`
  ADD PRIMARY KEY (`_label`),
  ADD KEY `army_label` (`_label`),
  ADD KEY `army_alliance` (`_alliance`);

--
-- Index pour la table `armylists`
--
ALTER TABLE `armylists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `armylist_army` (`_army`),
  ADD KEY `armylist_language` (`_language`),
  ADD KEY `armylist_player` (`_player`);

--
-- Index pour la table `artifacts_alliances`
--
ALTER TABLE `artifacts_alliances`
  ADD PRIMARY KEY (`_card_artifact`,`_alliance`),
  ADD KEY `artifactalliance_alliance` (`_alliance`);

--
-- Index pour la table `artifacts_armies`
--
ALTER TABLE `artifacts_armies`
  ADD PRIMARY KEY (`_card_artifact`,`_army`),
  ADD KEY `artifactarmy_army` (`_army`);

--
-- Index pour la table `artifacts_champions`
--
ALTER TABLE `artifacts_champions`
  ADD PRIMARY KEY (`_card_artifact`,`_champion`),
  ADD KEY `artifactchampion_champion` (`_champion`);

--
-- Index pour la table `artifacts_fighters`
--
ALTER TABLE `artifacts_fighters`
  ADD PRIMARY KEY (`_card_artifact`,`_card_fighter`),
  ADD KEY `fighterartifact_fighter` (`_card_fighter`);

--
-- Index pour la table `artifact_types`
--
ALTER TABLE `artifact_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artifacttype_name` (`_name`),
  ADD KEY `artifacttype_effect` (`_effect`);

--
-- Index pour la table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `card_name_label` (`_name`);

--
-- Index pour la table `card_artifacts`
--
ALTER TABLE `card_artifacts`
  ADD PRIMARY KEY (`_card`),
  ADD KEY `artifact_effect` (`_effect`),
  ADD KEY `artifact_point` (`_point`),
  ADD KEY `artifact_type` (`_type`);

--
-- Index pour la table `card_fighters`
--
ALTER TABLE `card_fighters`
  ADD PRIMARY KEY (`_card`),
  ADD KEY `fighter_army` (`_army`),
  ADD KEY `fighter_points` (`_point`),
  ADD KEY `fighter_rank` (`_rank`),
  ADD KEY `fighter_size` (`_size`),
  ADD KEY `fighter_gender` (`_gender`),
  ADD KEY `fighter_magician` (`_magician`),
  ADD KEY `fighter_priest` (`_priest`),
  ADD KEY `fighter_pedestal` (`_pedestal`);

--
-- Index pour la table `card_fighters_abilities`
--
ALTER TABLE `card_fighters_abilities`
  ADD PRIMARY KEY (`_card_fighter`,`_ability`),
  ADD KEY `fighterability_ability` (`_ability`);

--
-- Index pour la table `card_fighters_classes`
--
ALTER TABLE `card_fighters_classes`
  ADD PRIMARY KEY (`_card_fighter`,`_class`),
  ADD KEY `fighterclass_class` (`_class`);

--
-- Index pour la table `card_fighters_ranged_weapons`
--
ALTER TABLE `card_fighters_ranged_weapons`
  ADD PRIMARY KEY (`_card_fighter`,`_ranged_weapon`),
  ADD KEY `cardfighter_rangedweapon_weapon` (`_ranged_weapon`);

--
-- Index pour la table `card_fighters_skills`
--
ALTER TABLE `card_fighters_skills`
  ADD PRIMARY KEY (`_card_fighter`,`_skill`),
  ADD KEY `fighterskill_skill` (`_skill`);

--
-- Index pour la table `card_fighter_champions`
--
ALTER TABLE `card_fighter_champions`
  ADD PRIMARY KEY (`_card_fighter`),
  ADD KEY `champion_champion` (`_champion`);

--
-- Index pour la table `card_fighter_troops`
--
ALTER TABLE `card_fighter_troops`
  ADD PRIMARY KEY (`_card_fighter`);

--
-- Index pour la table `card_images`
--
ALTER TABLE `card_images`
  ADD PRIMARY KEY (`_card`);

--
-- Index pour la table `card_magic_spells`
--
ALTER TABLE `card_magic_spells`
  ADD PRIMARY KEY (`_card`),
  ADD KEY `spell_difficulty_label` (`_difficulty`),
  ADD KEY `spall_range_label` (`_range`),
  ADD KEY `spell_area_label` (`_area`),
  ADD KEY `spell_duration_label` (`_duration`),
  ADD KEY `spell_frequency_label` (`_frequency`),
  ADD KEY `spell_effect_label` (`_effect`);

--
-- Index pour la table `card_miracles`
--
ALTER TABLE `card_miracles`
  ADD PRIMARY KEY (`_card`),
  ADD KEY `miracle_area` (`_area`),
  ADD KEY `miracle_difficulty` (`_difficulty`),
  ADD KEY `miracle_duration` (`_duration`),
  ADD KEY `miracle_fervor` (`_fervor`),
  ADD KEY `miracle_range` (`_range`),
  ADD KEY `miracle_effect` (`_effect`);

--
-- Index pour la table `champions`
--
ALTER TABLE `champions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `champion_name` (`_name`);

--
-- Index pour la table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`_label`);

--
-- Index pour la table `fighter_options`
--
ALTER TABLE `fighter_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `option_group` (`_fighter_option_group`);

--
-- Index pour la table `fighter_options_abilities`
--
ALTER TABLE `fighter_options_abilities`
  ADD PRIMARY KEY (`_fighter_option`,`_ability`),
  ADD KEY `optionability_ability` (`_ability`);

--
-- Index pour la table `fighter_options_magicians`
--
ALTER TABLE `fighter_options_magicians`
  ADD PRIMARY KEY (`_fighter_option`,`_magician`),
  ADD KEY `optionmagician_magicien` (`_magician`);

--
-- Index pour la table `fighter_options_priests`
--
ALTER TABLE `fighter_options_priests`
  ADD PRIMARY KEY (`_fighter_option`,`_priest`),
  ADD KEY `optionpriest_priest` (`_priest`);

--
-- Index pour la table `fighter_options_ranged_weapons`
--
ALTER TABLE `fighter_options_ranged_weapons`
  ADD PRIMARY KEY (`_fighter_option`,`_ranged_weapon`),
  ADD KEY `optionrangedweapon_rangedweapon` (`_ranged_weapon`);

--
-- Index pour la table `fighter_options_skills`
--
ALTER TABLE `fighter_options_skills`
  ADD PRIMARY KEY (`_fighter_option`,`_skill`),
  ADD KEY `optionskill_skill` (`_skill`);

--
-- Index pour la table `fighter_option_groups`
--
ALTER TABLE `fighter_option_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `optiongroup_fighter` (`_card_fighter`);

--
-- Index pour la table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tournament_game` (`_tournament`),
  ADD KEY `game_language` (`_language`);

--
-- Index pour la table `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`_label`),
  ADD KEY `genre_label` (`_label`);

--
-- Index pour la table `labels`
--
ALTER TABLE `labels`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `labels_languages`
--
ALTER TABLE `labels_languages`
  ADD PRIMARY KEY (`_label`,`_language`),
  ADD KEY `languages_language_id` (`_language`);

--
-- Index pour la table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`) USING HASH,
  ADD UNIQUE KEY `name` (`name`) USING HASH,
  ADD UNIQUE KEY `flag_icon` (`flag_icon`) USING HASH;

--
-- Index pour la table `magicians`
--
ALTER TABLE `magicians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `magician_rank` (`_rank`);

--
-- Index pour la table `magicians_elements`
--
ALTER TABLE `magicians_elements`
  ADD PRIMARY KEY (`_magician`,`_magic_element`),
  ADD KEY `magicianelement_element` (`_magic_element`);

--
-- Index pour la table `magicians_ways`
--
ALTER TABLE `magicians_ways`
  ADD PRIMARY KEY (`_magician`,`_magic_way`),
  ADD KEY `magicianway_way` (`_magic_way`);

--
-- Index pour la table `magic_elements`
--
ALTER TABLE `magic_elements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `magic_element_label` (`_label`);

--
-- Index pour la table `magic_spells_mana_costs`
--
ALTER TABLE `magic_spells_mana_costs`
  ADD PRIMARY KEY (`_magic_spell`,`_magic_element`),
  ADD KEY `spellmanacost_element` (`_magic_element`);

--
-- Index pour la table `magic_spells_ways`
--
ALTER TABLE `magic_spells_ways`
  ADD PRIMARY KEY (`_magic_spell`,`_magic_way`),
  ADD KEY `spellways_way` (`_magic_way`);

--
-- Index pour la table `magic_ways`
--
ALTER TABLE `magic_ways`
  ADD PRIMARY KEY (`id`),
  ADD KEY `magicway_label` (`_name`);

--
-- Index pour la table `miracle_ways`
--
ALTER TABLE `miracle_ways`
  ADD PRIMARY KEY (`id`),
  ADD KEY `miracle_name_label` (`_name`);

--
-- Index pour la table `pedestals`
--
ALTER TABLE `pedestals`
  ADD PRIMARY KEY (`_label`);

--
-- Index pour la table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`) USING HASH,
  ADD KEY `player_user` (`_user`);

--
-- Index pour la table `players_games`
--
ALTER TABLE `players_games`
  ADD PRIMARY KEY (`_player`,`_game`),
  ADD KEY `playergame_game` (`_game`),
  ADD KEY `playergame_armylist` (`_armylist`);

--
-- Index pour la table `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `priests`
--
ALTER TABLE `priests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `priest_rank` (`_rank`);

--
-- Index pour la table `priests_miracle_ways`
--
ALTER TABLE `priests_miracle_ways`
  ADD PRIMARY KEY (`_priest`,`_miracle_way`),
  ADD KEY `priestway_way` (`_miracle_way`);

--
-- Index pour la table `races`
--
ALTER TABLE `races`
  ADD PRIMARY KEY (`id`),
  ADD KEY `race_label` (`_name`);

--
-- Index pour la table `ranged_weapons`
--
ALTER TABLE `ranged_weapons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ranged_weapon_name` (`_name`);

--
-- Index pour la table `ranks`
--
ALTER TABLE `ranks`
  ADD PRIMARY KEY (`_label`),
  ADD KEY `rank_label` (`_label`);

--
-- Index pour la table `scenarios`
--
ALTER TABLE `scenarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `scenario_name` (`_name`),
  ADD KEY `scenario_rules` (`_rules`);

--
-- Index pour la table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`_label`),
  ADD KEY `size_size_label` (`_label`);

--
-- Index pour la table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `skill_name_label` (`_name`);

--
-- Index pour la table `tournaments`
--
ALTER TABLE `tournaments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tournament_language` (`_language`);

--
-- Index pour la table `usergroups`
--
ALTER TABLE `usergroups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usergroup_name_label` (`_label`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING HASH,
  ADD UNIQUE KEY `login` (`login`) USING HASH,
  ADD KEY `user_language` (`_language`);

--
-- Index pour la table `users_usergroups`
--
ALTER TABLE `users_usergroups`
  ADD PRIMARY KEY (`_user`,`_usergroup`),
  ADD KEY `usergroupuser_usergroup` (`_usergroup`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `abilities`
--
ALTER TABLE `abilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `armylists`
--
ALTER TABLE `armylists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `artifact_types`
--
ALTER TABLE `artifact_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `champions`
--
ALTER TABLE `champions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fighter_options`
--
ALTER TABLE `fighter_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fighter_option_groups`
--
ALTER TABLE `fighter_option_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `labels`
--
ALTER TABLE `labels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `magicians`
--
ALTER TABLE `magicians`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `magic_elements`
--
ALTER TABLE `magic_elements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `magic_ways`
--
ALTER TABLE `magic_ways`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `miracle_ways`
--
ALTER TABLE `miracle_ways`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `points`
--
ALTER TABLE `points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `priests`
--
ALTER TABLE `priests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `races`
--
ALTER TABLE `races`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ranged_weapons`
--
ALTER TABLE `ranged_weapons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `scenarios`
--
ALTER TABLE `scenarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tournaments`
--
ALTER TABLE `tournaments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `usergroups`
--
ALTER TABLE `usergroups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `abilities`
--
ALTER TABLE `abilities`
  ADD CONSTRAINT `ability_name_label` FOREIGN KEY (`_name`) REFERENCES `labels` (`id`),
  ADD CONSTRAINT `ability_rule_label` FOREIGN KEY (`_rule`) REFERENCES `labels` (`id`);

--
-- Contraintes pour la table `alliances`
--
ALTER TABLE `alliances`
  ADD CONSTRAINT `alliance_name` FOREIGN KEY (`_label`) REFERENCES `labels` (`id`);

--
-- Contraintes pour la table `armies`
--
ALTER TABLE `armies`
  ADD CONSTRAINT `army_alliance` FOREIGN KEY (`_alliance`) REFERENCES `alliances` (`_label`),
  ADD CONSTRAINT `army_label` FOREIGN KEY (`_label`) REFERENCES `labels` (`id`);

--
-- Contraintes pour la table `armylists`
--
ALTER TABLE `armylists`
  ADD CONSTRAINT `armylist_army` FOREIGN KEY (`_army`) REFERENCES `armies` (`_label`),
  ADD CONSTRAINT `armylist_language` FOREIGN KEY (`_language`) REFERENCES `languages` (`id`),
  ADD CONSTRAINT `armylist_player` FOREIGN KEY (`_player`) REFERENCES `players` (`id`);

--
-- Contraintes pour la table `artifacts_alliances`
--
ALTER TABLE `artifacts_alliances`
  ADD CONSTRAINT `artifactalliance_alliance` FOREIGN KEY (`_alliance`) REFERENCES `alliances` (`_label`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `artifactalliance_artifact` FOREIGN KEY (`_card_artifact`) REFERENCES `card_artifacts` (`_card`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `artifacts_armies`
--
ALTER TABLE `artifacts_armies`
  ADD CONSTRAINT `artifactarmy_army` FOREIGN KEY (`_army`) REFERENCES `armies` (`_label`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `artifactarmy_artifact` FOREIGN KEY (`_card_artifact`) REFERENCES `card_artifacts` (`_card`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `artifacts_champions`
--
ALTER TABLE `artifacts_champions`
  ADD CONSTRAINT `artifactchampion_artifact` FOREIGN KEY (`_card_artifact`) REFERENCES `card_artifacts` (`_card`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `artifactchampion_champion` FOREIGN KEY (`_champion`) REFERENCES `champions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `artifacts_fighters`
--
ALTER TABLE `artifacts_fighters`
  ADD CONSTRAINT `fighterartifact_artifact` FOREIGN KEY (`_card_artifact`) REFERENCES `card_artifacts` (`_card`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fighterartifact_fighter` FOREIGN KEY (`_card_fighter`) REFERENCES `card_fighters` (`_card`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `artifact_types`
--
ALTER TABLE `artifact_types`
  ADD CONSTRAINT `artifacttype_effect` FOREIGN KEY (`_effect`) REFERENCES `labels` (`id`),
  ADD CONSTRAINT `artifacttype_name` FOREIGN KEY (`_name`) REFERENCES `labels` (`id`);

--
-- Contraintes pour la table `cards`
--
ALTER TABLE `cards`
  ADD CONSTRAINT `card_name_label` FOREIGN KEY (`_name`) REFERENCES `labels` (`id`);

--
-- Contraintes pour la table `card_artifacts`
--
ALTER TABLE `card_artifacts`
  ADD CONSTRAINT `artifact_card` FOREIGN KEY (`_card`) REFERENCES `cards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `artifact_effect` FOREIGN KEY (`_effect`) REFERENCES `labels` (`id`),
  ADD CONSTRAINT `artifact_point` FOREIGN KEY (`_point`) REFERENCES `points` (`id`),
  ADD CONSTRAINT `artifact_type` FOREIGN KEY (`_type`) REFERENCES `artifact_types` (`id`);

--
-- Contraintes pour la table `card_fighters`
--
ALTER TABLE `card_fighters`
  ADD CONSTRAINT `fighter_army` FOREIGN KEY (`_army`) REFERENCES `armies` (`_label`),
  ADD CONSTRAINT `fighter_card` FOREIGN KEY (`_card`) REFERENCES `cards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fighter_gender` FOREIGN KEY (`_gender`) REFERENCES `genders` (`_label`),
  ADD CONSTRAINT `fighter_magician` FOREIGN KEY (`_magician`) REFERENCES `magicians` (`id`),
  ADD CONSTRAINT `fighter_pedestal` FOREIGN KEY (`_pedestal`) REFERENCES `pedestals` (`_label`),
  ADD CONSTRAINT `fighter_points` FOREIGN KEY (`_point`) REFERENCES `points` (`id`),
  ADD CONSTRAINT `fighter_priest` FOREIGN KEY (`_priest`) REFERENCES `priests` (`id`),
  ADD CONSTRAINT `fighter_rank` FOREIGN KEY (`_rank`) REFERENCES `ranks` (`_label`),
  ADD CONSTRAINT `fighter_size` FOREIGN KEY (`_size`) REFERENCES `sizes` (`_label`);

--
-- Contraintes pour la table `card_fighters_abilities`
--
ALTER TABLE `card_fighters_abilities`
  ADD CONSTRAINT `fighterability_ability` FOREIGN KEY (`_ability`) REFERENCES `abilities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fighterability_fighter` FOREIGN KEY (`_card_fighter`) REFERENCES `card_fighters` (`_card`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `card_fighters_classes`
--
ALTER TABLE `card_fighters_classes`
  ADD CONSTRAINT `fighterclass_class` FOREIGN KEY (`_class`) REFERENCES `classes` (`_label`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fighterclass_fighter` FOREIGN KEY (`_card_fighter`) REFERENCES `card_fighters` (`_card`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `card_fighters_ranged_weapons`
--
ALTER TABLE `card_fighters_ranged_weapons`
  ADD CONSTRAINT `cardfighter_rangedweapon_fighter` FOREIGN KEY (`_card_fighter`) REFERENCES `card_fighters` (`_card`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cardfighter_rangedweapon_weapon` FOREIGN KEY (`_ranged_weapon`) REFERENCES `ranged_weapons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `card_fighters_skills`
--
ALTER TABLE `card_fighters_skills`
  ADD CONSTRAINT `fighterskill_fighter` FOREIGN KEY (`_card_fighter`) REFERENCES `card_fighters` (`_card`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fighterskill_skill` FOREIGN KEY (`_skill`) REFERENCES `skills` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `card_fighter_champions`
--
ALTER TABLE `card_fighter_champions`
  ADD CONSTRAINT `champion_champion` FOREIGN KEY (`_champion`) REFERENCES `champions` (`id`),
  ADD CONSTRAINT `champion_fighter_card` FOREIGN KEY (`_card_fighter`) REFERENCES `card_fighters` (`_card`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `card_fighter_troops`
--
ALTER TABLE `card_fighter_troops`
  ADD CONSTRAINT `troop_card_fighter` FOREIGN KEY (`_card_fighter`) REFERENCES `card_fighters` (`_card`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `card_images`
--
ALTER TABLE `card_images`
  ADD CONSTRAINT `image_card` FOREIGN KEY (`_card`) REFERENCES `cards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `card_magic_spells`
--
ALTER TABLE `card_magic_spells`
  ADD CONSTRAINT `spall_range_label` FOREIGN KEY (`_range`) REFERENCES `labels` (`id`),
  ADD CONSTRAINT `spell_area_label` FOREIGN KEY (`_area`) REFERENCES `labels` (`id`),
  ADD CONSTRAINT `spell_card` FOREIGN KEY (`_card`) REFERENCES `cards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `spell_difficulty_label` FOREIGN KEY (`_difficulty`) REFERENCES `labels` (`id`),
  ADD CONSTRAINT `spell_duration_label` FOREIGN KEY (`_duration`) REFERENCES `labels` (`id`),
  ADD CONSTRAINT `spell_effect_label` FOREIGN KEY (`_effect`) REFERENCES `labels` (`id`),
  ADD CONSTRAINT `spell_frequency_label` FOREIGN KEY (`_frequency`) REFERENCES `labels` (`id`);

--
-- Contraintes pour la table `card_miracles`
--
ALTER TABLE `card_miracles`
  ADD CONSTRAINT `miracle_area` FOREIGN KEY (`_area`) REFERENCES `labels` (`id`),
  ADD CONSTRAINT `miracle_difficulty` FOREIGN KEY (`_difficulty`) REFERENCES `labels` (`id`),
  ADD CONSTRAINT `miracle_duration` FOREIGN KEY (`_duration`) REFERENCES `labels` (`id`),
  ADD CONSTRAINT `miracle_effect` FOREIGN KEY (`_effect`) REFERENCES `labels` (`id`),
  ADD CONSTRAINT `miracle_fervor` FOREIGN KEY (`_fervor`) REFERENCES `labels` (`id`),
  ADD CONSTRAINT `miracle_range` FOREIGN KEY (`_range`) REFERENCES `labels` (`id`);

--
-- Contraintes pour la table `champions`
--
ALTER TABLE `champions`
  ADD CONSTRAINT `champion_name` FOREIGN KEY (`_name`) REFERENCES `labels` (`id`);

--
-- Contraintes pour la table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `fk_classes_label` FOREIGN KEY (`_label`) REFERENCES `labels` (`id`);

--
-- Contraintes pour la table `fighter_options`
--
ALTER TABLE `fighter_options`
  ADD CONSTRAINT `option_group` FOREIGN KEY (`_fighter_option_group`) REFERENCES `fighter_option_groups` (`id`);

--
-- Contraintes pour la table `fighter_options_abilities`
--
ALTER TABLE `fighter_options_abilities`
  ADD CONSTRAINT `optionability_ability` FOREIGN KEY (`_ability`) REFERENCES `abilities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `optionability_option` FOREIGN KEY (`_fighter_option`) REFERENCES `fighter_options` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `fighter_options_magicians`
--
ALTER TABLE `fighter_options_magicians`
  ADD CONSTRAINT `optionmagician_magicien` FOREIGN KEY (`_magician`) REFERENCES `magicians` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `optionmagician_option` FOREIGN KEY (`_fighter_option`) REFERENCES `fighter_options` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `fighter_options_priests`
--
ALTER TABLE `fighter_options_priests`
  ADD CONSTRAINT `optionpriest_option` FOREIGN KEY (`_fighter_option`) REFERENCES `fighter_options` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `optionpriest_priest` FOREIGN KEY (`_priest`) REFERENCES `priests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `fighter_options_ranged_weapons`
--
ALTER TABLE `fighter_options_ranged_weapons`
  ADD CONSTRAINT `optionrangedweapon_option` FOREIGN KEY (`_fighter_option`) REFERENCES `fighter_options` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `optionrangedweapon_rangedweapon` FOREIGN KEY (`_ranged_weapon`) REFERENCES `ranged_weapons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `fighter_options_skills`
--
ALTER TABLE `fighter_options_skills`
  ADD CONSTRAINT `optionskill_option` FOREIGN KEY (`_fighter_option`) REFERENCES `fighter_options` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `optionskill_skill` FOREIGN KEY (`_skill`) REFERENCES `skills` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `fighter_option_groups`
--
ALTER TABLE `fighter_option_groups`
  ADD CONSTRAINT `optiongroup_fighter` FOREIGN KEY (`_card_fighter`) REFERENCES `card_fighters` (`_card`);

--
-- Contraintes pour la table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `game_language` FOREIGN KEY (`_language`) REFERENCES `languages` (`id`),
  ADD CONSTRAINT `tournament_game` FOREIGN KEY (`_tournament`) REFERENCES `tournaments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `genders`
--
ALTER TABLE `genders`
  ADD CONSTRAINT `genre_label` FOREIGN KEY (`_label`) REFERENCES `labels` (`id`);

--
-- Contraintes pour la table `labels_languages`
--
ALTER TABLE `labels_languages`
  ADD CONSTRAINT `labels_label_id` FOREIGN KEY (`_label`) REFERENCES `labels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `languages_language_id` FOREIGN KEY (`_language`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `magicians`
--
ALTER TABLE `magicians`
  ADD CONSTRAINT `magician_rank` FOREIGN KEY (`_rank`) REFERENCES `ranks` (`_label`);

--
-- Contraintes pour la table `magicians_elements`
--
ALTER TABLE `magicians_elements`
  ADD CONSTRAINT `magicianelement_element` FOREIGN KEY (`_magic_element`) REFERENCES `magic_elements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `magicianelement_magician` FOREIGN KEY (`_magician`) REFERENCES `magicians` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `magicians_ways`
--
ALTER TABLE `magicians_ways`
  ADD CONSTRAINT `magicianway_magician` FOREIGN KEY (`_magician`) REFERENCES `magicians` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `magicianway_way` FOREIGN KEY (`_magic_way`) REFERENCES `magic_ways` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `magic_elements`
--
ALTER TABLE `magic_elements`
  ADD CONSTRAINT `magic_element_label` FOREIGN KEY (`_label`) REFERENCES `labels` (`id`);

--
-- Contraintes pour la table `magic_spells_mana_costs`
--
ALTER TABLE `magic_spells_mana_costs`
  ADD CONSTRAINT `spellmanacost_element` FOREIGN KEY (`_magic_element`) REFERENCES `magic_elements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `spellmanacost_spell` FOREIGN KEY (`_magic_spell`) REFERENCES `card_magic_spells` (`_card`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `magic_spells_ways`
--
ALTER TABLE `magic_spells_ways`
  ADD CONSTRAINT `spellways_spell` FOREIGN KEY (`_magic_spell`) REFERENCES `card_magic_spells` (`_card`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `spellways_way` FOREIGN KEY (`_magic_way`) REFERENCES `magic_ways` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `magic_ways`
--
ALTER TABLE `magic_ways`
  ADD CONSTRAINT `magicway_label` FOREIGN KEY (`_name`) REFERENCES `labels` (`id`);

--
-- Contraintes pour la table `miracle_ways`
--
ALTER TABLE `miracle_ways`
  ADD CONSTRAINT `miracle_name_label` FOREIGN KEY (`_name`) REFERENCES `labels` (`id`);

--
-- Contraintes pour la table `pedestals`
--
ALTER TABLE `pedestals`
  ADD CONSTRAINT `pedestal_label` FOREIGN KEY (`_label`) REFERENCES `labels` (`id`);

--
-- Contraintes pour la table `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `player_user` FOREIGN KEY (`_user`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Contraintes pour la table `players_games`
--
ALTER TABLE `players_games`
  ADD CONSTRAINT `playergame_armylist` FOREIGN KEY (`_armylist`) REFERENCES `armylists` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `playergame_game` FOREIGN KEY (`_game`) REFERENCES `games` (`id`),
  ADD CONSTRAINT `playergame_player` FOREIGN KEY (`_player`) REFERENCES `players` (`id`);

--
-- Contraintes pour la table `priests`
--
ALTER TABLE `priests`
  ADD CONSTRAINT `priest_rank` FOREIGN KEY (`_rank`) REFERENCES `ranks` (`_label`);

--
-- Contraintes pour la table `priests_miracle_ways`
--
ALTER TABLE `priests_miracle_ways`
  ADD CONSTRAINT `priestway_priest` FOREIGN KEY (`_priest`) REFERENCES `priests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `priestway_way` FOREIGN KEY (`_miracle_way`) REFERENCES `miracle_ways` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `races`
--
ALTER TABLE `races`
  ADD CONSTRAINT `race_label` FOREIGN KEY (`_name`) REFERENCES `labels` (`id`);

--
-- Contraintes pour la table `ranged_weapons`
--
ALTER TABLE `ranged_weapons`
  ADD CONSTRAINT `ranged_weapon_name` FOREIGN KEY (`_name`) REFERENCES `labels` (`id`);

--
-- Contraintes pour la table `ranks`
--
ALTER TABLE `ranks`
  ADD CONSTRAINT `rank_label` FOREIGN KEY (`_label`) REFERENCES `labels` (`id`);

--
-- Contraintes pour la table `scenarios`
--
ALTER TABLE `scenarios`
  ADD CONSTRAINT `scenario_name` FOREIGN KEY (`_name`) REFERENCES `labels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `scenario_rules` FOREIGN KEY (`_rules`) REFERENCES `labels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `sizes`
--
ALTER TABLE `sizes`
  ADD CONSTRAINT `size_label` FOREIGN KEY (`_label`) REFERENCES `labels` (`id`);

--
-- Contraintes pour la table `skills`
--
ALTER TABLE `skills`
  ADD CONSTRAINT `skill_name_label` FOREIGN KEY (`_name`) REFERENCES `labels` (`id`);

--
-- Contraintes pour la table `tournaments`
--
ALTER TABLE `tournaments`
  ADD CONSTRAINT `tournament_language` FOREIGN KEY (`_language`) REFERENCES `languages` (`id`);

--
-- Contraintes pour la table `usergroups`
--
ALTER TABLE `usergroups`
  ADD CONSTRAINT `usergroup_name_label` FOREIGN KEY (`_label`) REFERENCES `labels` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_language` FOREIGN KEY (`_language`) REFERENCES `languages` (`id`);

--
-- Contraintes pour la table `users_usergroups`
--
ALTER TABLE `users_usergroups`
  ADD CONSTRAINT `usergroupuser_user` FOREIGN KEY (`_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usergroupuser_usergroup` FOREIGN KEY (`_usergroup`) REFERENCES `usergroups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
