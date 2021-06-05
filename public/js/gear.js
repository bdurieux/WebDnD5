class Armor {
	constructor(type, name, nom, cost, ac, prerequisites, weight, stealth, source){
		this.type = type;   // 1 = light / 2 = medium / 3 = heavy / 4 = shield
        this.name = name;
		this.nom = nom;
		this.cost = cost;
		this.ac = ac;
		this.prerequisites = prerequisites;
		this.weight = weight;
		this.stealth = stealth;
        this.source = source;
	}
}

class Weapon {
	constructor(type, name, nom, cost, damage, damageType, weight, properties,source){
        this.type = type;   // 1 = simple melee / 2 = simple range / 3 = martial melee / 4 = martial range
		this.name = name;
		this.nom = nom;
		this.cost = cost;
		this.damage = damage;
        this.damageType = damageType;
		this.weight = weight;
		this.properties = properties;
        this.source = source;
	}
}

class Upgrade {
    constructor(name, nom, cost, prerequisites, effect){
		this.name = name;
		this.nom = nom;
		this.cost = cost;
		this.prerequisites = prerequisites;
		this.effect = effect;
	}
}

class Runestone {
    constructor(name, nom, idRarity, prerequisites, effect){
		this.name = name;
		this.nom = nom;
		this.idRarity = idRarity;   // 1: common / 2: scrace / 3: rare / 4: very rare / 5: legendary
		this.prerequisites = prerequisites;
		this.effect = effect;
	}
}

const armors = [
    new Armor(1,
        "Padded","Matelassée",
        5,
        "11 + bDex",
        "-",
        4,
        "Désavantage",
        "PHB"),
    new Armor(1,
        "Leather *","Gambeson *",
        15,
        "11 + bDex",
        "-",
        3.5,
        "-",
        "CAH"),
    new Armor(1,
        "Leather Jerkin/Studded Leather)","Pourpoint en cuir",
        45,
        "12 + bDex",
        "-",
        4.5,
        "-",
        "CAH"),
    new Armor(2,
        "Wicker","Osier",
        2,
        "11 + bDex (max +1)",
        "-",
        5.5,
        "Désavantage",
        "OAR2"),
    new Armor(2,
        "Hide","Peaux",
        10,
        "12 + bDex (max +2)",
        "-",
        5.5,
        "-",
        "PHB"),
    new Armor(2,
        "Mail/Chain shirt","Chemise de maille",
        60,
        "13 + bDex (max +2)",
        "-",
        11.5,
        "-",
        "CAH"),
    new Armor(2,
        "Bone","Os",
        50,
        "14",
        "For 13+",
        11,
        "Désavantage",
        "OAR2"),
    new Armor(2,
        "Lamelar/Scale Mail)","Lamellaire",
        150,
        "14 + bDex (max +2)",
        "-",
        9,
        "Désavantage",
        "CAH"),
    new Armor(2,
        "Hauberk/Breastplate","Plastron",
        250,
        "14 + bDex (max +2)",
        "-",
        13.5,
        "-",
        "CAH"),
    new Armor(2,
        "Half plate","Brigandine",
        450,
        "15 + bDex (max +2)",
        "-",
        18,
        "Désavantage",
        "CAH"),
    new Armor(3,
        "Ring mail","Broigne",
        30,
        "14",
        "-",
        20,
        "Désavantage",
        "PHB"),
    new Armor(3,
        "Chain mail","Cotte de maille",
        90,
        "16",
        "For 13+",
        27.5,
        "Désavantage",
        "CAH"),
    new Armor(3,
        "Splint mail $","Clibanion $",
        450,
        "17",
        "For 15+",
        30,
        "Désavantage",
        "CAH"),
    new Armor(3,
        "Full plate","Harnois",
        900,
        "18",
        "For 15+",
        32.5,
        "Désavantage",
        "CAH"),
    new Armor(4,
        "Buckler","Rondache",
        10,
        "+1",
        "-",
        1.5,
        "-",
        "CAH"),
    new Armor(4,
        "Heater shield","Bouclier",
        20,
        "+2",
        "For 13+",
        3.5,
        "-",
        "CAH"),
    new Armor(4,
        "Tower shield #","Pavois #",
        75,
        "+3",
        "For 15+",
        6.5,
        "-",
        "CAH")
]

const armors_upgrade = [
    new Upgrade(
        "Decorated","Décorée",
        5,
        "Intermédiaire, Lourde ou Bouclier",
        "Peut être utilisée comme symbole sacré par un prêtre ou paladin."
    ),
    new Upgrade(
        "Burnished","Brunie",
        10,
        "Lourde",
        "Avantage sur les jets de Cha. Disparait après un combat ou 24h."
    ),
    new Upgrade(
        "Muffled","Etouffée",
        50,
        "Clibanion",
        "N'impose pas de désavantage sur les jets de Discrétion."
    ),
    new Upgrade(
        "Breathable","Respirante",
        100,
        "Légère ou Intermédiaire",
        "Avantage sur les JS pour résister à l'épuisement causé par la chaleur."
    ),
    new Upgrade(
        "Climbing Harness","Harnais d'escalade",
        100,
        "Légère, Intermédiaire ou Lourde",
        "Avantage sur les jets d'Athlétisme pour grimper avec une corde."
    ),
    new Upgrade(
        "Insulated","Isolée",
        100,
        "Incompatible avec Respirante",
        "Compte comme équipement de survie dans les conditions de froid extrème."
    ),
    new Upgrade(
        "Locking Joints","Articulations bloquantes",
        150,
        "Clibanion ou plate",
        "Avantage sur les jets d'Athlétisme pour résister à une bousculade."
    ),
    new Upgrade(
        "Quick Release Clasps","Fermoir rapide",
        200,
        "Légère, Intermédiaire ou Lourde",
        "L'armure peut être retiré en 1 action seulement."
    ),
    new Upgrade(
        "Spiked","A Pointes",
        250,
        "Intermédiaire ou Lourde",
        "Inflige 1d4 dégâts (P) en mêlée à ceux qui attaquent avec des armes naturelles non-magiques."
    ),
    new Upgrade(
        "Reinforced","Renforcée",
        300,
        "Lourde",
        "Réduit les dégâts des critiques non-magiques de 3."
    ),
    new Upgrade(
        "Runic","Runique",
        400,
        "Bouclier ou tag Améliorée/Protection #",
        "Peut recevoir une rune magique."
    ),
    new Upgrade(
        "Armor Proofing 1","Protection 1",
        1000,
        "Légère, Intermédiaire ou Lourde",
        "Ignore les dégâts tranchants s'ils sont inférieurs à 7 avant résistance."
    ),
    new Upgrade(
        "Armor Proofing 2","Protection 2",
        2000,
        "Intermédiaire ou Lourde avec Protection 1",
        "Ignore les dégâts tranchants et perforants s'ils sont inférieurs à 8 avant résistance."
    ),
    new Upgrade(
        "Armor Proofing 3","Protection 3",
        3000,
        "Lourde avec Protection 2",
        "Ignore les dégâts tranchants, perforants et contondants s'ils sont inférieurs à 9 avant résistance."
    ),
    new Upgrade(
        "Armor Upgrade 1","Améliorée 1",
        3000,
        "Légère, Intermédiaire ou Lourde",
        "CA +1."
    ),
    new Upgrade(
        "Armor Upgrade 2","Améliorée 2",
        6000,
        "Intermédiaire ou Lourde avec Améliorée 1",
        "CA +1 (cumulatif avec Améliorée 1)."
    ),
    new Upgrade(
        "Armor Upgrade 3","Améliorée 3",
        9000,
        "Lourde avec Améliorée 2",
        "CA +1 (cumulatif avec Améliorée 2)."
    )
]

const weapons = [
    new Weapon(
        1,
        "Quarterstaff","Bâton",
        "2 pa",
        "1d6","C",
        2,
        "Polyvalente (1d8)",
        "PHB"
    ),
    new Weapon(
        1,
        "Dagger","Dague",
        "2 po",
        "1d4","P",
        0.5,
        "Cachée, Cartouchière, Finesse, Lancer (6/18), Légère",
        "CAH"
    ),
    new Weapon(
        1,
        "Club","Gourdin",
        "1 pa",
        "1d4","C",
        1,
        "Légère",
        "PHB"
    ),
    new Weapon(
        1,
        "Handaxe","Hachette",
        "5 po",
        "1d6","T",
        1,
        "Lancer (6/18), Légère",
        "PHB"
    ),
    new Weapon(
        1,
        "Javelin","Javelot",
        "5 pa",
        "1d6","P",
        1,
        "Lancer (9/36)",
        "PHB"
    ),
    new Weapon(
        1,
        "Macana","Macana",
        "2 po",
        "1d6","T",
        1.5,
        "Polyvalente (1d8)",
        "OAR2"
    ),
    new Weapon(
        1,
        "Lance","Epieux",
        "1 po",
        "1d6","P",
        1.5,
        "Lancer (6/18), Polyvalente (1d8)",
        "PHB"
    ),
    new Weapon(
        1,
        "Light Hammer","Marteau léger",
        "2 po",
        "1d4","C",
        1,
        "Lancer (6/18), Légère",
        "PHB"
    ),
    new Weapon(
        1,
        "Mace","Masse d'armes",
        "5 po",
        "1d6","C",
        2,
        "-",
        "PHB"
    ),
    new Weapon(
        1,
        "Greatclub","Massue",
        "2 pa",
        "1d8","C",
        5,
        "A deux main, Lourde, Siège",
        "CAH"
    ),
    new Weapon(
        1,
        "Sickle","Serpe",
        "1 po",
        "1d4","T",
        1,
        "Légère",
        "PHB"
    ),
    new Weapon(
        2,
        "Light Crossbow","Arbalête légère",
        "25 po",
        "1d8","P",
        2.5,
        "A deux main, Chargement, Munition (24/96)",
        "PHB"
    ),
    new Weapon(
        2,
        "Shortbow","Arc court",
        "25 po",
        "1d6","P",
        1,
        "A deux main, Munition (24/96)",
        "PHB"
    ),
    new Weapon(
        2,
        "Dart","Fléchette",
        "5 pc",
        "1d4","P",
        0.1,
        "Cachée, Cartouchière, Finesse, Lancer (6/18)",
        "CAH"
    ),
    new Weapon(
        2,
        "Sling","Fronde",
        "1 pa",
        "1d4","C",
        0,
        "Cachée, Munition (9/36)",
        "CAH"
    ),
    new Weapon(
        3,
        "Scimitar","Cimeterre",
        "25 po",
        "1d6","T",
        1.5,
        "Finesse, Légère",
        "PHB"
    ),
    new Weapon(
        3,
        "Cutlass","Coutelas",
        "15 po",
        "1d8","T",
        2,
        "Finesse",
        "OAR2"
    ),
    new Weapon(
        3,
        "Glaive","Coutille",
        "20 po",
        "1d10","T",
        3,
        "A deux main, Allonge, Lourde",
        "PHB"
    ),
    new Weapon(
        3,
        "Greatsword","Epée à 2 mains",
        "50 po",
        "2d6","T",
        3,
        "A deux main, Lourde",
        "PHB"
    ),
    new Weapon(
        3,
        "Shortsword","Epée Courte",
        "10 po",
        "1d6","P",
        1,
        "Finesse, Légère",
        "PHB"
    ),
    new Weapon(
        3,
        "Longsword","Epée longue",
        "15 po",
        "1d8","T",
        1.5,
        "Polyvalente (1d10)",
        "PHB"
    ),
    new Weapon(
        3,
        "Flail","Fléau",
        "10 po",
        "1d8","C",
        1,
        "-",
        "PHB"
    ),
    new Weapon(
        3,
        "Whip","Fouet",
        "2 po",
        "1d4","T",
        1.5,
        "Allonge, Finesse",
        "PHB"
    ),
    new Weapon(
        3,
        "War Claws","Griffes",
        "25 po",
        "1d6","T",
        0.5,
        "Finesse, Légère",
        "CAH"
    ),
    new Weapon(
        3,
        "Greataxe","Hache à deux mains",
        "30 po",
        "1d12","T",
        3.5,
        "A deux main, Lourde",
        "PHB"
    ),
    new Weapon(
        3,
        "Battleaxe","Hache d'arme",
        "10 po",
        "1d8","T",
        2,
        "Polyvalente (1d10)",
        "PHB"
    ),
    new Weapon(
        3,
        "Halberd","Hallebarde",
        "20 po",
        "1d10","T",
        3,
        "A deux main, Allonge, Lourde",
        "PHB"
    ),
    new Weapon(
        3,
        "Lance","Lance d'arçon",
        "10 po",
        "1d12","P",
        3,
        "Allonge, Spéciale",
        "PHB"
    ),
    new Weapon(
        3,
        "Maul","Maillet d'arme",
        "10 po",
        "2d6","C",
        5,
        "A deux main, Lourde, Siège",
        "PHB"
    ),
    new Weapon(
        3,
        "Warhammer","Marteau de guerre",
        "15 po",
        "1d8","C",
        1,
        "Polyvalente (1d10)",
        "PHB"
    ),
    new Weapon(
        3,
        "Morningstar","Morgenstern",
        "15 po",
        "1d8","P",
        2,
        "-",
        "PHB"
    ),
    new Weapon(
        3,
        "Warpick","Pic de guerre",
        "5 po",
        "1d8","P",
        1,
        "-",
        "PHB"
    ),
    new Weapon(
        3,
        "Pike","Pique",
        "5 po",
        "1d10","P",
        9,
        "A deux main, Allonge, Lourde",
        "PHB"
    ),
    new Weapon(
        3,
        "Rapier","Rapière",
        "25 po",
        "1d8","P",
        1,
        "Finesse",
        "PHB"
    ),
    new Weapon(
        3,
        "Trident","Trident",
        "5 po",
        "1d6","P",
        2,
        "Lancer (6/18), Polyvalente (1d8)",
        "PHB"
    ),
    new Weapon(
        4,
        "Hand Crossbow","Arbalète de poing",
        "75 po",
        "1d6","P",
        1.5,
        "Cachée, Chargement, Légère, Limitée, Munition (9/36)",
        "CAH"
    ),
    new Weapon(
        4,
        "Heavy Crossbow","Arbalère lourde",
        "50 po",
        "1d10","P",
        9,
        "A deux main, Chargement, Lourde, Munition (30/120)",
        "PHB"
    ),
    new Weapon(
        4,
        "Longbow","Arc Long",
        "50 po",
        "1d8","P",
        1,
        "A deux main, Lourde, Munition (45/180)",
        "PHB"
    ),
    new Weapon(
        4,
        "Atlatl","Atlatl",
        "4 po",
        "-","-",
        1.5,
        "Munition (12/45)",
        "OAR2"
    ),
    new Weapon(
        4,
        "War Boomerang","Boomerang de guerre",
        "10 po",
        "1d6","T",
        1,
        "Lancer (7.5/30)",
        "OAR2"
    ),
    new Weapon(
        4,
        "Net","Filet",
        "1 po",
        "-","-",
        1.5,
        "Lancer (1,5/4,5), Spéciale",
        "PHB"
    ),
    new Weapon(
        4,
        "Blowgun","Sarbacane",
        "10 po",
        "1","P",
        0.5,
        "Cachée, Chargement, Munition (7,5/30)",
        "CAH"
    )
]

const weapons_upgrade = [
    new Upgrade(
        "Argentée","Argentée",
        100,
        "-",
        "Compte comme en argent pour les résistances et immunités."
    ),
    new Upgrade(
        "Wounded - Keen","Blessante - Affutée",
        100,
        "Arme de mêlée",
        "+1 aux jets de dégâts."
    ),
    new Upgrade(
        "Wounded - Oiled String","Blessante - Huilée",
        100,
        "Arc ou arbalète",
        "+1 aux jets de dégâts."
    ),
    new Upgrade(
        "Critical - Sharpened","Critique - Aiguisée",
        100,
        "Arme de mêlée (P ou T)",
        "+1 aux chance de coup critique (19-20)."
    ),
    new Upgrade(
        "Critical - Sight Pin","Critique - Visée",
        100,
        "Arc ou arbalète",
        "+1 aux chance de coup critique (19-20)."
    ),
    new Upgrade(
        "Critical - Spiked","Critique - A Pointes",
        100,
        "Arme de mêlée (C)",
        "+1 aux chance de coup critique (19-20)."
    ),
    new Upgrade(
        "Balanced","Equilibrée",
        100,
        "-",
        "+1 aux jets pour toucher."
    ),
    new Upgrade(
        "Runic","Runique",
        100,
        "(#)",
        "Peut recevoir 1 rune magique."
    ),
    new Upgrade(
        "Brutal","Brutale",
        1000,
        "Tag 'à pointe' ou 'aiguisée'",
        "Quand le dé de dégât fait le max, relancer et ajouter (jusqu'à ne plus faire le max)."
    ),
    new Upgrade(
        "Enchanted","Enchantée",
        1000,
        "Bâton avec 1 tag de rang 1 ($)",
        "+1 aux jets d'attaque de sorts si utilisé comme focalisateur."
    ),
    new Upgrade(
        "Flanged","A Ailettes",
        1000,
        "Arme de mêlée avec Tag 'aiguisée' ou 'à pointes'",
        "Scinde les armures intermédiaires et lourdes (CA -1, non cumulatif) jusqu'à réparation."
    ),
    new Upgrade(
        "Magical","Magique",
        1000,
        "Tag 'argentée' ($)",
        "Compte comme magique pour les résistances et les immunités."
    ),
    new Upgrade(
        "Saw-toothed","Dent de scie",
        1000,
        "Dague avec Tag 'aiguisée'",
        "+1d4 dégats (T) (sauf contre MV et construct)."
    ),
    new Upgrade(
        "Superior","Supérieure",
        1000,
        "Arme infligeant 1 dé de dégâts avec Tag 'affutée', 'équilibrée' ou 'huilée'",
        "Augmente la taille du dé de dégâts d'un cran (d4 => d6 => d8 => d10 => d12 (max))."
    ),
    new Upgrade(
        "Arcane","Arcane",
        10000,
        "Tag 'enchantée' ($)",
        "+1 aux DD de vos sorts si utilisé comme focalisateur."
    ),
    new Upgrade(
        "Masterwork","Chef d'oeuvre",
        10000,
        "Tag 'brutale' ou 'supérieure'",
        "+1 aux jets pour toucher et de dégâts (cumulatif avec 'affutée' et 'équilibrée')."
    )
]

const armors_runestones = [
    new Runestone(
        "Alchemist","Alchimiste",
        1,
        "Armure",
        "Le porteur gagne 2 pv supplémentaires quand il boit une potion."
    ),
    new Runestone(
        "Thief","Voleur",
        1,
        "Armure",
        "Le porteur peut relancer un JS Dex raté. 1 fois par jour."
    ),
    new Runestone(
        "Arrow-catcher","Attrape flêche",
        2,
        "Bouclier",
        "Réaction pour imposer désavantage sur les attaques à distance qui ciblent le porteur. Récupère 1-3 charge à l'aube."
    ),
    new Runestone(
        "Elemental Shield","Bouclier Elémentaire",
        2,
        "Armure, Bouclier",
        "Réaction pour réduire les dégâts d'un type d'énergie de [2x niveau] + bCon."
    ),
    new Runestone(
        "Daywalker","Jour",
        2,
        "Armure avec heaume ou capuche",
        "Le porteur ignore la sensitivité à la lumière du soleil."
    ),
    new Runestone(
        "Bound Armor","Lien",
        2,
        "Armure",
        "Action bonus pour enfiler ou ôter l'armure."
    ),
    new Runestone(
        "Nondetection","Non détection",
        2,
        "Armure",
        "Immunise le porteur à la magie de divination."
    ),
    new Runestone(
        "Knock","Ouverture",
        2,
        "Armure avec gantelets",
        "Le porteur peut lancer 'knock'. 1 fois par jour."
    ),
    new Runestone(
        "Featherfoot","Pas Léger",
        2,
        "Armure",
        "Votre distance de saut en longueur de base est égale à votre mouvement."
    ),
    new Runestone(
        "Bastion","Bastion",
        3,
        "Armure avec gantelets ou Bouclier",
        "Action bonus pour créer un dome de force de 3 m de rayon pour 1 min. 1 fois par jour."
    ),
    new Runestone(
        "Chalice","Calice",
        3,
        "Armure",
        "Peut emmagasiner 5 niveaux d'emplacement de sort et le porteur peut les lancer."
    ),
    new Runestone(
        "Warmage","Mage de Bataille",
        3,
        "Armure ou Bouclier",
        "Réaction pour dépenser 1 charge et relancer un jet de concentration raté. 3 charges."
    ),
    new Runestone(
        "Phoenix","Phénix",
        3,
        "Armure",
        "Quand le porteur tombe à 0 pv, lance une 'fireball' sur lui et lui rend 1d6 pv. 1 fois par jour."
    ),
    new Runestone(
        "Journey","Voyage",
        3,
        "Armure",
        "Le porteur augmente son mouvement de 3 m et peut se déplacer à une allure rapide sans encombres."
    ),
    new Runestone(
        "Displacement","Déplacement",
        4,
        "Armure légère ou intermédiaire",
        "Quand le porteur subit des dégâts, il peut se téléporter à 9 m."
    ),
    new Runestone(
        "Recall","Rappel",
        4,
        "Armure",
        "Action pour marquer 1 lieu. 1 min de concentration pour se téléporter en se lieu avec 5 alliés."
    ),
    new Runestone(
        "Retribution","Rétribution",
        4,
        "Armure ou Bouclier",
        "Le porteur a l'avantage sur sa prochaine attaque après avoir subit des dégâts."
    ),
    new Runestone(
        "Overshield","Surprotection",
        4,
        "Armure Lourde",
        "Le porteur gagne 8 pvt au début de chacun de ses tours."
    ),
    new Runestone(
        "Mime","Copieuse",
        5,
        "Armure",
        "Le porteur peut copier 1 propriété magique d'une armure du même type et l'attribuer à son armure."
    ),
    new Runestone(
        "Force of Will","Force Mentale",
        5,
        "Armure",
        "Le porteur est immunisé aux effets d'enchantement."
    ),
    new Runestone(
        "Volant","Volante",
        5,
        "Armure",
        "Le porteur peut voler (planer) à une vitesse égale au double de son mouvement."
    )
]

const weapons_runestones = [
    new Runestone(
        "Warrior","Guerrier",
        1,
        "Arme simple ou de guerre",
        "Ne peut être désarmé."
    ),
    new Runestone(
        "Mariner","Marin",
        1,
        "Arme simple ou de guerre",
        "Aucune pénalité dû à l'eau lors d'un combat sous l'eau."
    ),
    new Runestone(
        "Cat","Chat",
        2,
        "Arme simple ou de guerre",
        "1 action bonus pour gagner Vision dans le noir (36 m) pendant 1 h. 1 fois par jour."
    ),
    new Runestone(
        "Chaos","Chaos",
        2,
        "Arme simple ou de guerre",
        "Cause 1 excès de magie sauvage quand l'arme inflige un critique."
    ),
    new Runestone(
        "Bound Weapon","Lien",
        2,
        "Arme simple ou de guerre",
        "1 action bonus pour faire apparaître ou disparaître une arme dans une main libre."
    ),
    new Runestone(
        "Nondetection","Non détection",
        2,
        "Arme simple ou de guerre",
        "Immunise le porteur à la magie de divination."
    ),
    new Runestone(
        "Featherfoot","Pas léger",
        2,
        "Arme simple ou de guerre",
        "Votre distance de saut en longueur de base est égale à votre mouvement."
    ),
    new Runestone(
        "Serpent","Serpent",
        2,
        "Arme simple ou de guerre",
        "Peut empoisonner 1 cible touchée pour 1 min. 1 fois par jour."
    ),
    new Runestone(
        "Berserker","Berserker",
        3,
        "Arme simple ou de guerre",
        "Peut dépenser des DV pour augmenter les dégâts d'une attaque (mais subir les dégâts supplémentaires)."
    ),
    new Runestone(
        "Chalice","Calice",
        3,
        "Arme simple ou de guerre",
        "Peut emmagasiner 5 niveaux d'emplacement de sort et le porteur peut les lancer."
    ),
    new Runestone(
        "Hunt","Chasse",
        3,
        "Arme avec munitions",
        "Le porteur peut se téléporter auprès d'1 cible marqué. 1 fois par jour."
    ),
    new Runestone(
        "Death","Mort",
        3,
        "Arme simple ou de guerre",
        "1 créature tuée par l'arme devient 1 zombie sous le contrôle du porteur pendant 1 min."
    ),
    new Runestone(
        "Soultrap","Piègeuse d'âme",
        3,
        "Arme simple ou de guerre",
        "Le porteur regagne 1 emplacement de sort (max = bMaitrise) en tuant 1 créature avec l'arme."
    ),
    new Runestone(
        "Superconductor","Supra conductrice",
        3,
        "Arme simple ou de guerre",
        "Peut emmagasiner des sorts (max = bMaitrise) et libérer l'énergie en attaquant avec l'arme (+1d6 par niveau (force))."
    ),
    new Runestone(
        "Magebane","Tueuse de Mage",
        3,
        "Arme simple ou de guerre",
        "Le porteur peut lancer 'dispel magic' sur la cible de ses attaques. 3 fois par jour."
    ),
    new Runestone(
        "Blood Weapon","Sanglante",
        4,
        "Arme simple ou de guerre",
        "Le porteur gagne en pv les dégâts infligés par un coup critique avec l'arme contre une créature vivante."
    ),
    new Runestone(
        "Earthshaker","Trembleterre",
        4,
        "Arme lourde",
        "Le porteur peut lancer 'earthquake' pour 1 round. 1 fois par jour."
    ),
    new Runestone(
        "Wolfsbane","Tueuse de changeforme",
        4,
        "Arme simple ou de guerre",
        "L'arme illumine à 4,5 m et inflige +2d6 dégâts supplémentaires (arme) aux métamorphes et les force à prendre leur forme naturelle pour 1 round (JS Con, annule)."
    ),
    new Runestone(
        "Dragon Slayer","Tueuse de dragon",
        4,
        "Arme simple ou de guerre",
        "L'arme inflige +2d6 dégâts supplémentaires (arme) aux dragons et les empêche de voler pour 1 round."
    ),
    new Runestone(
        "Giant Slayer","Tueuse de géant	",
        4,
        "Arme simple ou de guerre",
        "L'arme inflige +2d6 dégâts supplémentaires (arme) aux géants et les fait tomber à terre (JS For, annule)."
    ),
    new Runestone(
        "Mime","Copieuse",
        5,
        "Arme simple ou de guerre",
        "Le porteur peut copier 1 propriété magique d'une arme du même type et l'attribuer à son arme."
    ),
    new Runestone(
        "Tempest","Tempête",
        5,
        "Arme simple ou de guerre",
        "L'arme inflige +1d10 dégâts supplémentaires (foudre) quand elle touche. Les dégâts supplémentaires se propagent jusqu'à 3 cibles à moins de 9 m. 1 fois par tour."
    )
]

/*	FUNCTIONS	*/

function compareAC(a, b) {
    const armorA = a.ac;
    const armorB = b.ac;
  
    let comparison = 0;
    if (armorA > armorB) {
      comparison = 1;
    } else if (armorA < armorB) {
      comparison = -1;
    }
    return comparison;
  }

function compareNom(a, b) {
    const nameA = a.nom;
    const nameB = b.nom;
  
    let comparison = 0;
    if (nameA > nameB) {
      comparison = 1;
    } else if (nameA < nameB) {
      comparison = -1;
    }
    return comparison;
  }

function compareCost(a, b) {
    const costA = a.cost;
    const costB = b.cost;
  
    let comparison = 0;
    if (costA > costB) {
      comparison = 1;
    } else if (costA < costB) {
      comparison = -1;
    }
    return comparison;
  }

function compareRarity(a, b) {
    const itemA = a.idRarity;
    const itemB = b.idRarity;
  
    let comparison = 0;
    if (itemA > itemB) {
      comparison = 1;
    } else if (itemA < itemB) {
      comparison = -1;
    }
    return comparison;
  }

// ARMOR
function showTableArmor(){
    // sort armor by AC
    armors.sort(compareAC);
	const table = document.getElementById("table_armor");
    // add armor by type 
    for(let i = 1; i <= 4; i++){
        // header
        addArmorHeader(table,i)
        // armor 
        for(let armor of armors){
            if(armor.type === i){
                addArmorLine(table,armor)
            }
        }        
    }
}

function addArmorHeader(table,type){
    let header = getArmorHeader(type)
    var row = table.insertRow(-1);
    let lineHeader = document.createElement("th")
    lineHeader.setAttribute('colspan',6)
    lineHeader.innerHTML = `${header}`
    row.appendChild(lineHeader)
}

function getArmorHeader(idType){
    let header = "";
    switch(idType){
        case 1:
            header = "armures légères";
            break;
        case 2:
            header = "armures intermédiaires";
            break;
        case 3:
            header = "armures lourdes";
            break;
        case 4:
            header = "bouclier";
            break;   
    }
    return header;    
}

function addArmorLine(table,armor){
    var row = table.insertRow(-1);

    // NAME
    var col1 = row.insertCell(0);
    col1.setAttribute('data-label','Nom');
    col1.setAttribute('title',`${armor.name} (${armor.source})`);
    col1.innerHTML += armor.nom;

    // COST
    var col2 = row.insertCell(1);
    col2.setAttribute('data-label','Coût (po)');
    col2.innerHTML += armor.cost;

    // AC
    var col3 = row.insertCell(2);
    col3.setAttribute('data-label','CA');
    col3.innerHTML += armor.ac;

    // PREREQUISITES
    var col4 = row.insertCell(3);
    col4.setAttribute('data-label','Prérequis');
    col4.innerHTML += armor.prerequisites;

    // WEIGHT
    var col5 = row.insertCell(4);
    col5.setAttribute('data-label','Poids (kg)');
    col5.innerHTML += armor.weight;

    // DISCRETION modifier
    var col6 = row.insertCell(5);
    col6.setAttribute('data-label','Discrétion');
    col6.innerHTML += armor.stealth;
}

// ARMOR UPGRADE
function showTableArmorUpgrade(){
    // sort armor by cost
    armors_upgrade.sort(compareNom);
    armors_upgrade.sort(compareCost);
	const table = document.getElementById("table_armor_upgrade");
    
    for(let upgrade of armors_upgrade){
        addArmorUpgradeLine(table,upgrade)
    }
}

function addArmorUpgradeLine(table,upgrade){
    var row = table.insertRow(-1);

    // NAME
    var col1 = row.insertCell(0);
    col1.setAttribute('data-label','Nom');
    col1.setAttribute('title',`${upgrade.name} (${upgrade.source})`);
    col1.innerHTML += upgrade.nom;

    // COST
    var col2 = row.insertCell(1);
    col2.setAttribute('data-label','Coût (po)');
    col2.innerHTML += upgrade.cost;

    // PREREQUISITES
    var col3 = row.insertCell(2);
    col3.setAttribute('data-label','Prérequis');
    col3.innerHTML += upgrade.prerequisites;

    // EFFECTS
    var col4 = row.insertCell(3);
    col4.setAttribute('data-label','Effets');
    col4.innerHTML += upgrade.effect;
}

showTableArmor()
showTableArmorUpgrade()

// WEAPON
function showTableWeapon(){
    // sort weapon by nom
    weapons.sort(compareNom);
	const table = document.getElementById("table_weapon");
    // add weapon by type 
    for(let i = 1; i <= 4; i++){
        // header
        addWeaponHeader(table,i);
        // weapon 
        for(let weapon of weapons){
            if(weapon.type === i){
                addWeaponLine(table,weapon);
            }
        }        
    }
}

function addWeaponHeader(table,idType){
    let header = getWeaponHeader(idType)
    var row = table.insertRow(-1);
    let lineHeader = document.createElement("th")
    lineHeader.setAttribute('colspan',5)
    lineHeader.innerHTML = `${header}`
    row.appendChild(lineHeader)
}

function getWeaponHeader(idType){
    let header = "";
    switch(idType){
        case 1:
            header = "armes simples - mêlée";
            break;
        case 2:
            header = "armes simples - distance";
            break;
        case 3:
            header = "armes de guerre - mêlée";
            break;
        case 4:
            header = "armes de guerre - distance";
            break;   
    }
    return header;    
}

function addWeaponLine(table,weapon){
    var row = table.insertRow(-1);

    // NAME
    var col1 = row.insertCell(0);
    col1.setAttribute('data-label','Nom');
    col1.setAttribute('title',`${weapon.name} (${weapon.source})`);
    col1.innerHTML += weapon.nom;

    // COST
    var col2 = row.insertCell(1);
    col2.setAttribute('data-label','Coût (po)');
    col2.innerHTML += weapon.cost;

    // DAMAGE
    var col3 = row.insertCell(2);
    col3.setAttribute('data-label','Dégâts');
    col3.innerHTML += `${weapon.damage} (${weapon.damageType})`;

    // WEIGHT
    var col4 = row.insertCell(3);
    col4.setAttribute('data-label','Poids (kg)');
    col4.innerHTML += weapon.weight;

    // PROPERTIES
    var col5 = row.insertCell(4);
    col5.setAttribute('data-label','Propriétés');
    col5.innerHTML += weapon.properties;
}

// WEAPON UPGRADE
function showTableWeaponUpgrade(){
    // sort weapon by cost
    weapons_upgrade.sort(compareNom);

	const table = document.getElementById("table_weapon_upgrade");
    // loop to create section for rank (1 : 100 / 2 : 1000 / 3 : 10000)
    for(let i = 100; i <= 10000; i = i*10){
        // header
        addWeaponUpgradeHeader(table,i)
        // weapon 
        for(let upgrade of weapons_upgrade){
            if(upgrade.cost === i){
                addWeaponUpgradeLine(table,upgrade)
            }            
        }
    }    
}

function addWeaponUpgradeHeader(table,cost){
    let header = getWeaponUpgradeHeader(cost)
    var row = table.insertRow(-1);
    let lineHeader = document.createElement("th")
    lineHeader.setAttribute('colspan',3)
    lineHeader.innerHTML = `${header}`
    row.appendChild(lineHeader)
}

function getWeaponUpgradeHeader(rank){
    let header = "";
    switch(rank){
        case 100:
            header = `Rang 1 (${rank} po)`;
            break;
        case 1000:
            header = `Rang 2 (${rank} po)`;
            break;
        case 10000:
            header = `Rang 3 (${rank} po)`;
            break;   
    }
    return header;    
}

function addWeaponUpgradeLine(table,upgrade){
    var row = table.insertRow(-1);

    // NAME
    var col1 = row.insertCell(0);
    col1.setAttribute('data-label','Nom');
    col1.setAttribute('title',`${upgrade.name} (${upgrade.source})`);
    col1.innerHTML += upgrade.nom;

    // PREREQUISITES
    var col2 = row.insertCell(1);
    col2.setAttribute('data-label','Prérequis');
    col2.innerHTML += upgrade.prerequisites;

    // EFFECTS
    var col3 = row.insertCell(2);
    col3.setAttribute('data-label','Effets');
    col3.innerHTML += upgrade.effect;
}

showTableWeapon()
showTableWeaponUpgrade()

// RUNESTONES
function showTableRunestone(table,runestoneList){
    // sort runestone by rarity
    runestoneList.sort(compareNom);
    runestoneList.sort(compareRarity);	
    
    for(let runestone of runestoneList){
        addRunestoneLine(table,runestone)
    }
}

function addRunestoneLine(table,runestone){
    var row = table.insertRow(-1);

    // NAME
    var col1 = row.insertCell(0);
    col1.setAttribute('data-label','Nom');
    col1.setAttribute('title',`${runestone.name}`);
    col1.innerHTML += runestone.nom;

    // RARITY
    var col2 = row.insertCell(1);
    col2.setAttribute('data-label','Rareté');
    col2.innerHTML += getRarity(runestone.idRarity);

    // PREREQUISITES
    var col3 = row.insertCell(2);
    col3.setAttribute('data-label','Prérequis');
    col3.innerHTML += runestone.prerequisites;

    // EFFECTS
    var col4 = row.insertCell(3);
    col4.setAttribute('data-label','Effets');
    col4.innerHTML += runestone.effect;
}

function getRarity(idRarity){
    let rarity = "";
    switch (idRarity){
        case 1:
            rarity = "Commune";
            break;
        case 2:
            rarity = "Inhabituelle";
            break;
        case 3:
            rarity = "Rare";
            break;
        case 4:
            rarity = "Très Rare";
            break;
        case 5:
            rarity = "Légendaire";
            break;
    }
    return rarity;
}

// ARMOR RUNESTONES
function showTableArmorRunestone(){
    const table = document.getElementById("table_armor_runestone");    
    showTableRunestone(table,armors_runestones)
}

// WEAPON RUNESTONES
function showTableWeaponRunestone(){
    const table = document.getElementById("table_weapon_runestone");
    showTableRunestone(table,weapons_runestones)
}

showTableArmorRunestone()
showTableWeaponRunestone()