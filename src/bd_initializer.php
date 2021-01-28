<?php

use com\confdb\base\tool\Constants;
use com\confdb\base\tool\SqlTool;
use com\confdb\game\basics\dao\RankDao;
use com\confdb\game\basics\dao\SkillDao;
use com\confdb\label\dao\LanguageDao;

function my_autoloader($class) {
    include $class . '.php';
}

spl_autoload_register('my_autoloader');
set_time_limit(0);

$dbh = new PDO('mysql:host=localhost', 'root', '', [
    PDO::ATTR_PERSISTENT => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);
$dbh->exec(file_get_contents(__DIR__.'/../sql/structure_confdb.sql'));
unset($dbh);

// INSERTION DES LANGAGES
LanguageDao::getInstance()->create('FR', 'français', 'fr.jpg');
LanguageDao::getInstance()->create('EN', 'english', 'en.jpg');

// INSERTION DES CARACTERISTIQUES
SkillDao::getInstance()->create([
    Constants::LANGUAGE_FR => 'mouvement',
    Constants::LANGUAGE_EN => 'movement'
]);
SkillDao::getInstance()->create([
    Constants::LANGUAGE_FR => 'initiative',
    Constants::LANGUAGE_EN => 'initiative'
]);
SkillDao::getInstance()->create([
    Constants::LANGUAGE_FR => 'attaque',
    Constants::LANGUAGE_EN => 'attack'
]);
SkillDao::getInstance()->create([
    Constants::LANGUAGE_FR => 'force',
    Constants::LANGUAGE_EN => 'strength'
]);
SkillDao::getInstance()->create([
    Constants::LANGUAGE_FR => 'défense',
    Constants::LANGUAGE_EN => 'defense'
]);
SkillDao::getInstance()->create([
    Constants::LANGUAGE_FR => 'résistance',
    Constants::LANGUAGE_EN => 'resistance'
]);
SkillDao::getInstance()->create([
    Constants::LANGUAGE_FR => 'courage',
    Constants::LANGUAGE_EN => 'courage'
]);
SkillDao::getInstance()->create([
    Constants::LANGUAGE_FR => 'peur',
    Constants::LANGUAGE_EN => 'fear'
]);
SkillDao::getInstance()->create([
    Constants::LANGUAGE_FR => 'discipline',
    Constants::LANGUAGE_EN => 'discipline'
]);

// INSERTION DES RANGS
// GUERRIERS
RankDao::getInstance()->create([
    Constants::LANGUAGE_FR => 'irrégulier',
    Constants::LANGUAGE_EN => 'irregular'
], 1);
RankDao::getInstance()->create([
    Constants::LANGUAGE_FR => 'régulier',
    Constants::LANGUAGE_EN => 'régular'
], 1);
RankDao::getInstance()->create([
    Constants::LANGUAGE_FR => 'vétéran',
    Constants::LANGUAGE_EN => 'veteran'
], 1);
RankDao::getInstance()->create([
    Constants::LANGUAGE_FR => 'créature',
    Constants::LANGUAGE_EN => 'creature'
], 1);
RankDao::getInstance()->create([
    Constants::LANGUAGE_FR => 'spécial',
    Constants::LANGUAGE_EN => 'special'
], 2);
RankDao::getInstance()->create([
    Constants::LANGUAGE_FR => 'élite',
    Constants::LANGUAGE_EN => 'elit'
], 2);
RankDao::getInstance()->create([
    Constants::LANGUAGE_FR => 'machine de guerre',
    Constants::LANGUAGE_EN => 'warmachine'
], 2);
RankDao::getInstance()->create([
    Constants::LANGUAGE_FR => 'légende vivante',
    Constants::LANGUAGE_EN => 'living legend'
], 3);
RankDao::getInstance()->create([
    Constants::LANGUAGE_FR => 'allié majeur',
    Constants::LANGUAGE_EN => 'major ally'
], 4);
// MAGICIENS
RankDao::getInstance()->create([
    Constants::LANGUAGE_FR => 'initié',
    Constants::LANGUAGE_EN => 'initiate'
], 1);
RankDao::getInstance()->create([
    Constants::LANGUAGE_FR => 'adepte',
    Constants::LANGUAGE_EN => 'adept'
], 2);
RankDao::getInstance()->create([
    Constants::LANGUAGE_FR => 'maître',
    Constants::LANGUAGE_EN => 'master'
], 3);
RankDao::getInstance()->create([
    Constants::LANGUAGE_FR => 'virtuose',
    Constants::LANGUAGE_EN => 'virtuoso'
], 4);
// FIDELES
RankDao::getInstance()->create([
    Constants::LANGUAGE_FR => 'dévot',
    Constants::LANGUAGE_EN => 'devout'
], 1);
RankDao::getInstance()->create([
    Constants::LANGUAGE_FR => 'zélote',
    Constants::LANGUAGE_EN => 'zealot'
], 2);
RankDao::getInstance()->create([
    Constants::LANGUAGE_FR => 'doyen',
    Constants::LANGUAGE_EN => 'doyen'
], 3);
RankDao::getInstance()->create([
    Constants::LANGUAGE_FR => 'avatar',
    Constants::LANGUAGE_EN => 'avatar'
], 4);