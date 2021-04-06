class Classe {
	constructor(name, nom, dv, desc, armures, armes, outils, js, competences, mainStat, source,id){
		this.name = name;
		this.nom = nom;
		this.dv = dv;
		this.desc = desc;
		this.armures = armures;
		this.armes = armes;
		this.outils = outils;
		this.js = js;
		this.competences = competences;
		this.mainStat = mainStat;
		this.source = source;
		this.id = id;	// vérifier que l'id correspond à celui en bdd
	}
}

const classListPHB = [
	new Classe("Barbarian", "Barbare", 12,
		"Un féroce combattant primitif capable de devenir enragé",
		"Légères, Intermédiaires, Bouclier",
		"Courantes, de Guerre",
		"",
		"For & Con",
		"2 parmi: Athlétisme, Dressage, Intimidation, Nature, Perception, Survie",
		"For",
		"PHB 47",1),
	new Classe("Bard", "Barde", 8,
		"Un mage capable d'inspirer ses compagnons et dont les pouvoirs font appel à la musique",
		"Légères",
		"Courantes, arbalète de poing, épée, rapière, épée courte",
		"3 instruments de musique",
		"Dex & Cha",
		"3 au choix",
		"Cha",
		"PHB 52",2),
	new Classe("Cleric", "Clerc", 8,
		"Un champion ecclésiastique qui utilise la magie divine au service d'une entité supérieure",
		"Légères, Intermédiaires, Bouclier",
		"Courantes",
		"",
		"Sag & Cha",
		"2 parmi: Histoire, Médecine, Perspicacité, Persuasion, Religion",
		"Sag",
		"PHB 57",3),
	new Classe("Druid", "Druide", 8,
		"Un adepte de l'antique religion qui manie les pouvoirs de la nature et peut prendre une forme animale",
		"Légères, Intermédiaires, Bouclier (sans métal)",
		"Gourdin, dague, fléchette, javeline, massue, baton, cimeterre, serpe, fronde, lance",
		"Herboriste",
		"Int & Sag",
		"2 parmi: Arcanes, Dressage, Médecine, Nature, Perception, Perspicacité, Religion, Survie",
		"Sag",
		"PHB 65",4),
	new Classe("Sorcerer", "Ensorceleur", 6,
		"Un mage qui tire ses pouvoirs magiques innés de sa lignée ou d'un don",
		"",
		"Dague, fléchette, fronde, baton, arbalète légère",
		"",
		"Con & Cha",
		"2 parmi: Arcanes, Intimidation, Persuasion, Religion, Tromperie",
		"Cha",
		"PHB 71",10),
	new Classe("Fighter", "Guerrier", 10,
		"Un maître de guerre sachant utiliser tout un éventail d'armes et d'armures",
		"Légères, Intermédiaires, Lourdes, Bouclier",
		"Courantes, de Guerre",
		"",
		"For & Con",
		"2 parmi: Acrobaties, Athlétisme, Dressage, Histoire, Intimidation, Perception, Perspicacité, Survie",
		"For ou Dex",
		"PHB 77",5),
	new Classe("Wizard", "Magicien", 6,
		"Un utilisateur de magie académique capable de manipuler le tissu de la réalité",
		"",
		"Dague, fléchette, fronde, baton, arbalète légère",
		"",
		"Int & Sag",
		"2 parmi: Arcanes, Histoire, Investigation, Médecine, Perspicacité, Religion",
		"Int",
		"PHB 83",12),
	new Classe("Monk", "Moine", 8,
		"Un maître des arts martiaux qui puise dans sa puissance corporelle pour atteindre la perfection physique et spirituelle",
		"",
		"Courantes, épée courte",
		"1 artisanat ou 1 instrument",
		"For & Dex",
		"2 parmi: Acrobaties, Athlétisme, Discrétion, Histoire, Perspicacité, Religion",
		"Dex & Sag",
		"PHB 91",6),
	new Classe("Paladin", "Paladin", 10,
		"Un guerrier saint lié par un serment sacré",
		"Légères, Intermédiaires, Lourdes, Bouclier",
		"Courantes, de Guerre",
		"",
		"Sag & Cha",
		"2 parmi: Athlétisme, Intimidation, Médecine, Perspicacité, Persuasion, Religion",
		"For & Cha",
		"PHB 97",7),
	new Classe("Ranger", "Rodeur", 10,
		"Un combattant qui recourt aux prouesses, martiales et à la magie du monde naturel",
		"Légères, Intermédiaires, Bouclier",
		"Courantes, de Guerre",
		"",
		"For & Dex",
		"3 parmi: Athlétisme, Discrétion, Dressage, Investigation, Nature, Perception, Perspicacité, Survie",
		"Dex & Sag",
		"PHB 104",8),
	new Classe("Rogue", "Roublard", 8,
		"Une crapule qui surmonte les obstacles et triomphe de ses ennemis grâce à sa discrétion et ses ruses",
		"Légères",
		"Courantes, arbalète de poing, épée longue, épée courte, rapière",
		"Voleur",
		"Dex & Int",
		"4 parmi: Acrobaties, Athlétisme, Discrétion, Escamotage, Intimidation, Investigation, Perception, Perspicacité, Persuasion, Représentation, Tromperie",
		"Dex",
		"PHB 109",9),
	new Classe("Warlock", "Sorcier", 8,
		"Un mage qui doit ses pouvoirs au marché passé avec une entité extraplanaire",
		"Légères",
		"Courantes",
		"",
		"Sag & Cha",
		"2 parmi: Arcanes, Histoire, Intimidation, Investigation, Nature, Religion, Tromperie",
		"Cha",
		"PHB 114",11)
];

const classListERLW = [
	new Classe("Artificer", "Artificier", 8,
		"Un mage inventeur spécialisé dans la création d'objet magiques",
		"Légères, Intermédiaires, Bouclier",
		"Courantes",
		"Voleur, Bricoleur & 1 artisanat au choix",
		"Con & Int",
		"2 parmi: Arcanes, Escamotage, Histoire, Investigation, Médecine, Nature, Perception",
		"Int",
		"ERLW 56",13)
];


const classListTCE = [
	new Classe("Artificer", "Artificier", 8,
		"Un mage inventeur spécialisé dans la création d'objet magiques",
		"Légères, Intermédiaires, Bouclier",
		"Courantes",
		"Voleur, Bricoleur & 1 artisanat au choix",
		"Con & Int",
		"2 parmi: Arcanes, Escamotage, Histoire, Investigation, Médecine, Nature, Perception",
		"Int",
		"TCE 11",13)
];

const classListBotD = [
	new Classe("Dread Necromancer", "Nécromancien", 8,
		"Un mage spécialisé dans la magie nécromantique et les morts vivants",
		"Légères",
		"Courantes & 1 de Guerre (au choix)",
		"",
		"Con & Cha",
		"2 parmi: Arcanes, Histoire, Intimidation, Investigation, Nature, Religion, Tromperie",
		"Cha",
		"BotD 11",16)
];

const classListPPKC = [
	new Classe("Empath", "Empathe", 8,
		"Un spécialiste des pouvoirs mentaux controlant les émotions et les perceptions",
		"Bouclier",
		"Courantes",
		"",
		"Sag & Cha",
		"2 parmi: Arcanes, Intimidation, Médecine, Nature, Perception, Perspicacité, Persuasion, Religion",
		"Sag",
		"PPKC 10",14),
	new Classe("Psion", "Psion", 6,
		"Un spécialiste des pouvoirs mentaux controlant l'environnement",
		"",
		"Massue, fléchette, baton, fronde, épieu",
		"",
		"Int & Sag",
		"2 parmi: Arcanes, Histoire, Investigation, Nature, Perspicacité",
		"Int",
		"PPKC 16",15),
];

var classeList = [];

/*	FONCTIONS	*/

function compareName(a, b) {
  const nameA = a.name.toUpperCase();
  const nameB = b.name.toUpperCase();

  let comparison = 0;
  if (nameA > nameB) {
    comparison = 1;
  } else if (nameA < nameB) {
    comparison = -1;
  }
  return comparison;
}

function sortClassByName(classeList){
	classeList.sort(compareName);	// on trie dabord les noms
}

//	CREATION LIGNE tableau
function ajouterLigne(myClass,myTable)
{
	var ligne = myTable.insertRow(-1);//on a ajouté une ligne

	var colonne1 = ligne.insertCell(0);//on a une ajouté une cellule
	colonne1.innerHTML += `<strong title="${myClass.source}"><span class="english">
								<a href="class/${myClass.id}".html>${myClass.name}</a>
							</span></strong>`;
	var colonne2 = ligne.insertCell(1);//on ajoute la seconde cellule
	colonne2.innerHTML += myClass.desc;

	var colonne3 = ligne.insertCell(2);
	colonne3.innerHTML += myClass.mainStat;

	var colonne4 = ligne.insertCell(3);
	colonne4.innerHTML += myClass.dv;

	var colonne5 = ligne.insertCell(4);
	colonne5.innerHTML += myClass.js;
}

function supprimerLigne(numLine,myTable)
{
	myTable.deleteRow(numLine);
}

function viderListeClasse(){
	let listeVide = [];
	classeList = listeVide;
	const tableau = document.getElementById("table_classe");
	const nbLigne = tableau.rows.length;
	for(let i=2;i<nbLigne;i++){
		supprimerLigne(2,tableau);
	}
}

function showTableClasse(){
	const tableau = document.getElementById("table_classe");
	sortClassByName(classeList);
	for(let classe of classeList){
		ajouterLigne(classe,tableau);
	}
}

function getClassBySource(){
	viderListeClasse();
	if(document.getElementById("chb_phb").checked){
		for(let classe of classListPHB)
		{
			classeList.push(classe);
		}
	}
	if(document.getElementById("chb_tce").checked){
		for(let classe of classListTCE)
		{
			classeList.push(classe);
		}
	}
	if(document.getElementById("chb_botd").checked){
		for(let classe of classListBotD)
		{
			classeList.push(classe);
		}
	}
	if(document.getElementById("chb_ppkc").checked){
		for(let classe of classListPPKC)
		{
			classeList.push(classe);
		}
	}
	showTableClasse();
}

getClassBySource();

