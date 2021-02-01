<?php

use com\confdb\game\armies\business\AllianceBusiness;
use com\confdb\game\armies\business\ArmyBusiness;
use com\confdb\game\armies\dao\AllianceDao;
use com\confdb\game\armies\dao\ArmyDao;
use com\confdb\game\basics\business\GenderBusiness;
use com\confdb\game\basics\business\PedestalBusiness;
use com\confdb\game\basics\business\RankBusiness;
use com\confdb\game\basics\business\SizeBusiness;
use com\confdb\game\basics\business\SkillBusiness;
use com\confdb\game\basics\dao\GenderDao;
use com\confdb\game\basics\dao\PedestalDao;
use com\confdb\game\basics\dao\RankDao;
use com\confdb\game\basics\dao\SizeDao;
use com\confdb\game\basics\dao\SkillDao;
use com\confdb\label\business\LanguageBusiness;
use com\confdb\label\dao\LanguageDao;

function my_autoloader($class) {
    include $class . '.php';
}

spl_autoload_register('my_autoloader');
set_time_limit(0);

$dbh = new PDO('mysql:host=localhost', 'root', '', [
    PDO::ATTR_PERSISTENT => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);
$dbh->exec('DROP database confdb;');
$dbh->exec(file_get_contents(__DIR__.'/../sql/structure_confdb.sql'));
unset($dbh);

// INSERTION DES LANGAGES
$languageFr = LanguageDao::getInstance()->create('FR', 'français', 'fr.jpg');
$languageEn = LanguageDao::getInstance()->create('EN', 'english', 'en.jpg');

// INSERTION DES CARACTERISTIQUES
SkillDao::getInstance()->create([
    $languageFr => 'mouvement',
    $languageEn => 'movement'
]);
SkillDao::getInstance()->create([
    $languageFr => 'initiative',
    $languageEn => 'initiative'
]);
SkillDao::getInstance()->create([
    $languageFr => 'attaque',
    $languageEn => 'attack'
]);
SkillDao::getInstance()->create([
    $languageFr => 'force',
    $languageEn => 'strength'
]);
SkillDao::getInstance()->create([
    $languageFr => 'défense',
    $languageEn => 'defense'
]);
SkillDao::getInstance()->create([
    $languageFr => 'résistance',
    $languageEn => 'resistance'
]);
SkillDao::getInstance()->create([
    $languageFr => 'courage',
    $languageEn => 'courage'
]);
SkillDao::getInstance()->create([
    $languageFr => 'peur',
    $languageEn => 'fear'
]);
SkillDao::getInstance()->create([
    $languageFr => 'discipline',
    $languageEn => 'discipline'
]);

// INSERTION DES RANGS
// GUERRIERS
RankDao::getInstance()->create([
    $languageFr => 'irrégulier',
    $languageEn => 'irregular'
], 1);
RankDao::getInstance()->create([
    $languageFr => 'régulier',
    $languageEn => 'régular'
], 1);
RankDao::getInstance()->create([
    $languageFr => 'vétéran',
    $languageEn => 'veteran'
], 1);
RankDao::getInstance()->create([
    $languageFr => 'créature',
    $languageEn => 'creature'
], 1);
RankDao::getInstance()->create([
    $languageFr => 'spécial',
    $languageEn => 'special'
], 2);
RankDao::getInstance()->create([
    $languageFr => 'élite',
    $languageEn => 'elit'
], 2);
RankDao::getInstance()->create([
    $languageFr => 'machine de guerre',
    $languageEn => 'warmachine'
], 2);
RankDao::getInstance()->create([
    $languageFr => 'légende vivante',
    $languageEn => 'living legend'
], 3);
RankDao::getInstance()->create([
    $languageFr => 'allié majeur',
    $languageEn => 'major ally'
], 4);
// MAGICIENS
RankDao::getInstance()->create([
    $languageFr => 'initié',
    $languageEn => 'initiate'
], 1);
RankDao::getInstance()->create([
    $languageFr => 'adepte',
    $languageEn => 'adept'
], 2);
RankDao::getInstance()->create([
    $languageFr => 'maître',
    $languageEn => 'master'
], 3);
RankDao::getInstance()->create([
    $languageFr => 'virtuose',
    $languageEn => 'virtuoso'
], 4);
// FIDELES
RankDao::getInstance()->create([
    $languageFr => 'dévot',
    $languageEn => 'devout'
], 1);
RankDao::getInstance()->create([
    $languageFr => 'zélote',
    $languageEn => 'zealot'
], 2);
RankDao::getInstance()->create([
    $languageFr => 'doyen',
    $languageEn => 'doyen'
], 3);
RankDao::getInstance()->create([
    $languageFr => 'avatar',
    $languageEn => 'avatar'
], 4);

// INSERTION DES TAILLES
SizeDao::getInstance()->create([
    $languageFr => 'petite taille',
    $languageEn => 'small'
], 1);
SizeDao::getInstance()->create([
    $languageFr => 'taille normale',
    $languageEn => 'medium'
], 1);
SizeDao::getInstance()->create([
    $languageFr => 'grande taille',
    $languageEn => 'big'
], 2);
SizeDao::getInstance()->create([
    $languageFr => 'très grande taille',
    $languageEn => 'huge'
], 3);

// INSERTION DES SOCLES
PedestalDao::getInstance()->create([
    $languageFr => 'infanterie',
    $languageEn => 'infantry'
], '2.5 x 2.5cm');
PedestalDao::getInstance()->create([
    $languageFr => 'cavalerie',
    $languageEn => 'cavalry'
], '2.5 x 5cm');
PedestalDao::getInstance()->create([
    $languageFr => 'grande taille',
    $languageEn => 'big'
], '3.75 x 3.75cm');
PedestalDao::getInstance()->create([
    $languageFr => 'creature',
    $languageEn => 'creature'
], '5 x 5cm');

// INSERTION DES GENRES
GenderDao::getInstance()->create([
    $languageFr => 'masculin',
    $languageEn => 'male'
]);
GenderDao::getInstance()->create([
    $languageFr => 'féminin',
    $languageEn => 'female'
]);

// INSERTION DES ALLIANCES
$allianceLight = AllianceDao::getInstance()->create([
    $languageFr => 'voie de la lumière',
    $languageEn => 'light'
]);
$allianceDestiny = AllianceDao::getInstance()->create([
    $languageFr => 'voie du destin',
    $languageEn => 'destiny'
]);
$allianceDarkness = AllianceDao::getInstance()->create([
    $languageFr => 'voie des ténèbres',
    $languageEn => 'darkness'
]);
$allianceCadwallon = AllianceDao::getInstance()->create([
    $languageFr => 'Cadwallon',
    $languageEn => 'Cadwallon'
]);
$allianceElementals = AllianceDao::getInstance()->create([
    $languageFr => 'élémentaires',
    $languageEn => 'elementals'
]);
$allianceOthers = AllianceDao::getInstance()->create([
    $languageFr => 'autres',
    $languageEn => 'others'
]);

// INSERTION DES ARMEES
// Ténèbres
ArmyDao::getInstance()->create([
    $languageFr => 'morts-vivants d\'Achéron',
    $languageEn => 'undeads'
], 'acheron.png', $allianceDarkness);
ArmyDao::getInstance()->create([
    $languageFr => 'alchimistes de Dirz',
    $languageEn => 'dirz'
], 'dirz.png', $allianceDarkness);
ArmyDao::getInstance()->create([
    $languageFr => 'keltois du clan des Drunes',
    $languageEn => 'drunes'
], 'drunes.png', $allianceDarkness);
ArmyDao::getInstance()->create([
    $languageFr => 'nains de Mid-Nor',
    $languageEn => 'mid-nor'
], 'mid-nor.png', $allianceDarkness);
ArmyDao::getInstance()->create([
    $languageFr => 'alliance Ophidienne',
    $languageEn => 'ophidians'
], 'ophidian.png', $allianceDarkness);
ArmyDao::getInstance()->create([
    $languageFr => 'elfes Akkyshans',
    $languageEn => 'akkyshans'
], 'akkyshan.png', $allianceDarkness);
ArmyDao::getInstance()->create([
    $languageFr => 'dévoreurs de Vile-Tis',
    $languageEn => 'devourers'
], 'vile-tis.png', $allianceDarkness);
ArmyDao::getInstance()->create([
    $languageFr => 'horde de Dun-Scaîth',
    $languageEn => 'dun-scaith'
], 'dun-scaith.png', $allianceDarkness);
// Lumière
ArmyDao::getInstance()->create([
    $languageFr => 'lions d\'Alahan',
    $languageEn => 'lion'
], 'lions.png', $allianceLight);
ArmyDao::getInstance()->create([
    $languageFr => 'elfes Cynwäll',
    $languageEn => 'cynwalls'
], 'cynwalls.png', $allianceLight);
ArmyDao::getInstance()->create([
    $languageFr => 'griffons d\'Akkylannie',
    $languageEn => 'griffins'
], 'griffins.png', $allianceLight);
ArmyDao::getInstance()->create([
    $languageFr => 'keltois du clan des Sessairs',
    $languageEn => 'sessairs'
], 'sessairs.png', $allianceLight);
ArmyDao::getInstance()->create([
    $languageFr => 'nains de Tir-Na-Bor',
    $languageEn => 'tir-na-bor'
], 'tir-na-bor.png', $allianceLight);
ArmyDao::getInstance()->create([
    $languageFr => 'utopie du Sphinx',
    $languageEn => 'sphinx'
], 'sphinx.png', $allianceLight);
// Destin
ArmyDao::getInstance()->create([
    $languageFr => 'elfes Daïkinees',
    $languageEn => 'daikinees'
], 'daikinees.png', $allianceDestiny);
ArmyDao::getInstance()->create([
    $languageFr => 'orques de Bran-Ô-Kor',
    $languageEn => 'orks of Bran-O-Kor'
], 'bran-o-kor.png', $allianceDestiny);
ArmyDao::getInstance()->create([
    $languageFr => 'wolfens d\'Yllia',
    $languageEn => 'wolfen'
], 'wolfen.png', $allianceDestiny);
ArmyDao::getInstance()->create([
    $languageFr => 'gobelins de No-Dan-Kar',
    $languageEn => 'goblins'
], 'no-dan-kar.png', $allianceDestiny);
ArmyDao::getInstance()->create([
    $languageFr => 'orques du Béhémoth',
    $languageEn => 'orks of Behemoth'
], 'daikinees.png', $allianceDestiny);
ArmyDao::getInstance()->create([
    $languageFr => 'concorde de l\'Aigle',
    $languageEn => 'concordia'
], 'concordia.png', $allianceDestiny);
// Cadwallon
ArmyDao::getInstance()->create([
    $languageFr => 'milice de Cadwallon',
    $languageEn => 'cadwallon milice'
], 'milice.png', $allianceCadwallon);
ArmyDao::getInstance()->create([
    $languageFr => 'fiefs Ogrokh',
    $languageEn => 'ogrokh'
], 'ogrokh.png', $allianceCadwallon);
ArmyDao::getInstance()->create([
    $languageFr => 'guilde des Architectes',
    $languageEn => 'architects guild'
], 'architects.png', $allianceCadwallon);
ArmyDao::getInstance()->create([
    $languageFr => 'guilde des Nochers',
    $languageEn => 'nochers guild'
], 'nochers.png', $allianceCadwallon);
ArmyDao::getInstance()->create([
    $languageFr => 'guilde des Usuriers',
    $languageEn => 'usury guild'
], 'usury.png', $allianceCadwallon);
ArmyDao::getInstance()->create([
    $languageFr => 'guilde des Voleurs',
    $languageEn => 'thieves guild'
], 'thieves.png', $allianceCadwallon);
ArmyDao::getInstance()->create([
    $languageFr => 'guilde des Lames',
    $languageEn => 'blades guild'
], 'blades.png', $allianceCadwallon);
ArmyDao::getInstance()->create([
    $languageFr => 'guilde des Cartomanciens',
    $languageEn => 'cartomanciers guild'
], 'cartomanciers.png', $allianceCadwallon);
ArmyDao::getInstance()->create([
    $languageFr => 'guilde des Orfèvres',
    $languageEn => 'orfevres guild'
], 'orfevres.png', $allianceCadwallon);
// Elémentaires
ArmyDao::getInstance()->create([
    $languageFr => 'élémentaires de Feu',
    $languageEn => 'fire'
], 'fire.png', $allianceElementals);
ArmyDao::getInstance()->create([
    $languageFr => 'élémentaires d\'Eau',
    $languageEn => 'water'
], 'water.png', $allianceElementals);
ArmyDao::getInstance()->create([
    $languageFr => 'élémentaires de Terre',
    $languageEn => 'earth'
], 'earth.png', $allianceElementals);
ArmyDao::getInstance()->create([
    $languageFr => 'élémentaires d\'Air',
    $languageEn => 'air'
], 'air.png', $allianceElementals);
ArmyDao::getInstance()->create([
    $languageFr => 'élémentaires de Lumière',
    $languageEn => 'light'
], 'light.png', $allianceElementals);
ArmyDao::getInstance()->create([
    $languageFr => 'élémentaires de Ténèbres',
    $languageEn => 'darkness'
], 'darkness.png', $allianceElementals);
// Autres
ArmyDao::getInstance()->create([
    $languageFr => 'mercenaires',
    $languageEn => 'mercenaries'
], 'mercenaries.png', $allianceOthers);

echo '<pre>';
var_dump(ArmyBusiness::getInstance()->listByAlliance());
var_dump(ArmyBusiness::getInstance()->list());
var_dump(AllianceBusiness::getInstance()->list());
var_dump(LanguageBusiness::getInstance()->list());
var_dump(RankBusiness::getInstance()->list());
var_dump(SkillBusiness::getInstance()->list());
var_dump(SizeBusiness::getInstance()->list());
var_dump(PedestalBusiness::getInstance()->list());
var_dump(GenderBusiness::getInstance()->list());
echo '</pre>';