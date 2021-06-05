class Poison {
	constructor(name, nom, application, desc, type, prix, source){
		this.name = name;
		this.nom = nom;
		this.application = application;
		this.desc = desc;
		this.type = type;
		this.prix = prix;
		this.source = source;
	}
}

const poisonPHB = [
	new Poison("Essense of ether",
		"Essence éthérée",
		"Inhalation",
		"Con DD 15. Inconscient 8h.",
		"Toxine",
		300,
		"DMG"),
	new Poison("Burnt Othur fumes",
		"Fumée d'Othur",
		"Inhalation",
		"Con DD 13. 3d6 dégâts par rd jusqu’à 3 succès.",
		"Mixture",
		500,
		"DMG"),
	new Poison("Oil of Taggit",
		"Huile de Taggit",
		"Contact",
		"Con DD 13. Inconscient 24h.",
		"Toxine",
		400,
		"DMG"),
	new Poison("Midnight tears",
		"Larmes de minuit",
		"Ingestion",
		"Con DD 17. 9d6 (succès = 50%). Ne prend effet qu’à minuit.",
		"Mixture",
		1500,
		"DMG"),
	new Poison("Malice",
		"Malice",
		"Inhalation",
		"Con DD 15. Aveuglée 1h.",
		"Toxine",
		250,
		"DMG"),
	new Poison("Carrion crawler mucus",
		"Mucus de ver charognard",
		"Contact",
		"Con DD 13. Paralysie 1 min. 1 JS/tour.",
		"Venin",
		200,
		"DMG"),
	new Poison("Purple worm poison",
		"Poison de ver pourpre",
		"Blessure",
		"Con DD 19. 12d6 (succès = 50%).",
		"Venin",
		2000,
		"DMG"),
	new Poison("Wyvern poison",
		"Poison de vouivre",
		"Blessure",
		"Con DD 15. 7d6 (succès = 50%).",
		"Venin",
		1200,
		"DMG"),
	new Poison("Drow poison",
		"Poison drow",
		"Blessure",
		"Con DD 15. 1h. Echec de 5+ : inconscient.",
		"Toxine",
		200,
		"DMG"),
	new Poison("Assassin's blood",
		"Sang d'assassin",
		"Ingestion",
		"Con DD 10. 1d12 (succès = 50%). 24h.",
		"Toxine",
		150,
		"DMG"),
	new Poison("Truth sérum",
		"Sérum de vérité",
		"Ingestion",
		"Con DD 11. 1h. Ne peut pas mentir.",
		"Mixture",
		150,
		"DMG"),
	new Poison("Pale tincture",
		"Teinture pale",
		"Ingestion",
		"Con DD 16. 1d6/24h jusqu’à 7 succès.",
		"Mixture",
		250,
		"DMG"),
	new Poison("Torpor",
		"Torpeur",
		"Ingestion",
		"Con DD 15. 4d6h & ne peut agir.",
		"Mixture",
		600,
		"DMG"),
	new Poison("Serpent venom",
		"Venin de serpent",
		"Blessure",
		"Con DD 11. 3d6 (succès = 50%).",
		"Venin",
		200,
		"DMG"),
	new Poison("Basic weapon Poison",
		"Poison d'arme",
		"Blessure",
		"Con DD 14. 2d8.",
		"Toxine",
		50,
		"TCE")
];

const poisonAideDD = [
	new Poison("Venom's blood",
		"Sang des venins",
		"Blessure",
		"Con DD 9. 6d10 (succès = 50%).",
		"Venin",
		1200,
		"AideDD"),
	new Poison("Troll's blood",
		"Sang de troll",
		"Ingestion",
		"Con DD 15. Pétrifié 1d4 rd (5 rd si échec critique).",
		"Toxine",
		300,
		"AideDD"),
	new Poison("Ghoul saliva",
		"Salive de goule",
		"Contact",
		"Con DD 13. Entravé 2d6 min (succès = 50%).",
		"Toxine",
		600,
		"AideDD"),
	new Poison("Royal scorpion's sting",
		"Queue de scorpion royal",
		"Contact",
		"Con DD 16. 4d6 +1d6/rd. 1min. 1 JS/rd.",
		"Venin",
		1000,
		"AideDD"),
	new Poison("Black lotus dust",
		"Poudre de lotus noir",
		"Ingestion",
		"Con DD 12. 1d4 Con & Empoisonné jusqu’à fin repos long.",
		"Végétal",
		800,
		"AideDD"),
	new Poison("Yellow lotus dust",
		"Poudre de lotus jaune",
		"Ingestion",
		"Con DD 10. 1d6 Cha & Empoisonné jusqu’à fin repos long.",
		"Végétal",
		800,
		"AideDD"),
	new Poison("Giant toad poison",
		"Poison de crapaud géant",
		"Blessure",
		"Con DD 11. 1d10.",
		"Venin",
		200,
		"AideDD"),
	new Poison("Ettercap poison",
		"Poison d'ettercap",
		"Blessure",
		"Con DD 11. 1d8. Empoisonné 1 min. 1 JS/rd.",
		"Venin",
		200,
		"AideDD"),
	new Poison("Basilisk eye",
		"Oeil de basilic",
		"Blessure",
		"Con DD 12. Pétrifié. 1 JS/rd.",
		"Mixture",
		600,
		"AideDD"),
	new Poison("Mandrake",
		"Mandragore",
		"Ingestion",
		"Con DD 10. -1d4 Sag + hallucinations pour 2d6 min.",
		"Végétal",
		300,
		"AideDD"),
	new Poison("Black oil",
		"Huile noire",
		"Ingestion",
		"Con DD 20. Aveugle et résistance dégâts contondats 1d4 h.",
		"Mixture",
		500,
		"AideDD"),
	new Poison("Devil's herb",
		"Herbe du diable",
		"Ingestion",
		"Con DD 10. Hallucinations et incapacité à parler jusqu’à fin repos long.",
		"Végétal",
		300,
		"AideDD"),
	new Poison("Wolves herb",
		"Herbe aux loups",
		"Ingestion",
		"Con DD 9. 3d4 (JS annule). Echec : JS 10 ou paralysie 1 min.",
		"Végétal",
		250,
		"AideDD"),
	new Poison("Greenblood oil",
		"Extrait de sangvert",
		"Ingestion",
		"Con DD 10. empoisonné 1d6 min.",
		"Végétal",
		150,
		"AideDD"),
	new Poison("Black lotus extract",
		"Extrait de lotus noir",
		"Ingestion",
		"Con DD 20. 10d10 (succès = 50%).",
		"Végétal",
		4000,
		"AideDD"),
	new Poison("Cyanide",
		"Cyanure",
		"Ingestion",
		"Con DD 15. 4d8 (succès = 50%) 1h.",
		"Toxine",
		600,
		"AideDD"),
	new Poison("Curare",
		"Curare",
		"Blessure",
		"Con DD 9. Paralysie 1 min. 1 JS/rd.",
		"Végétal",
		150,
		"AideDD"),
	new Poison("Lich dust",
		"Poussière de liche",
		"Ingestion",
		"Con DD 14. 4d4 (succès = 50%).",
		"Mixture",
		400,
		"AideDD"),
	new Poison("Belladonna",
		"Belladone",
		"Ingestion",
		"Con DD 11. -2 Dex & 1d4/10 min (succès = 50%) 1h.",
		"Végétal",
		250,
		"AideDD"),
	new Poison("Arsenic",
		"Arsenic",
		"Ingestion",
		"Con DD 15. 3d8 (succès = 50%) 1h.",
		"Toxine",
		500,
		"AideDD"),
	new Poison("Green dragon bile",
		"Bile de dragon vert",
		"Inhalation",
		"Con DD 22. 10d8 (succès = 50%) 1h.",
		"Toxine",
		2500,
		"AideDD"),
	new Poison("Giant spider venom",
		"Venin d'araignée géante",
		"Blessure",
		"Con DD 22. 2d4 & paralysie 1d4 rd.",
		"Toxine",
		600,
		"AideDD"),
	new Poison("Giant spider venom",
		"Venin d'araignée géante",
		"Blessure",
		"Con DD 11. 2d8 (succès = 50%). Si tombe à 0 pv : Paralysée 1h.",
		"Venin",
		300,
		"AideDD"),
	new Poison("Giant wolf spider venom",
		"Venin d'araignée loup géante",
		"Blessure",
		"Con DD 11. 2d6 (succès = 50%). Si tombe à 0 pv : Paralysée 1h.",
		"Venin",
		250,
		"AideDD"),
	new Poison("Giant wasp venom",
		"Venin de guêpe géante",
		"Blessure",
		"Con DD 11. 3d6 (succès = 50%). Si tombe à 0 pv : Paralysée 1h.",
		"Venin",
		300,
		"AideDD"),
	new Poison("Giant centipede venom",
		"Venin de mille pattes géant",
		"Blessure",
		"Con DD 11. 3d6 (succès = 50%). Si tombe à 0 pv : Paralysée 1h.",
		"Venin",
		300,
		"AideDD"),
	new Poison("Giant scorpion venom",
		"Venin de scorpion géant",
		"Blessure",
		"Con DD 12. 4d10 (succès = 50%).",
		"Venin",
		1000,
		"AideDD"),
	new Poison("Black adder venom",
		"Venin de vipêre",
		"Blessure",
		"Con DD 11. 1d6 après 2d6 rds.",
		"Venin",
		150,
		"AideDD")
];

const poisonHomebrew = [
	new Poison("Deathtoad toxin",
		"Toxine de crapaud mortelle",
		"Blessure",
		"Con DD 10. 2d6.",
		"Toxine",
		150,
		"Homebrew"),
	new Poison("Chuul Ichor",
		"Ichor de Chuul",
		"Blessure",
		"Con DD 10. Paralysie 1 min. 1 JS/rd.",
		"Toxine",
		150,
		"Homebrew")
];

var poisonList = [];

/*	FONCTIONS	*/

function compareNom(a, b) {
  const nameA = a.nom.toUpperCase();
  const nameB = b.nom.toUpperCase();

  let comparison = 0;
  if (nameA > nameB) {
    comparison = 1;
  } else if (nameA < nameB) {
    comparison = -1;
  }
  return comparison;
}

function compareApplication(a, b) {
  const nameA = a.application.toUpperCase();
  const nameB = b.application.toUpperCase();

  let comparison = 0;
  if (nameA > nameB) {
    comparison = 1;
  } else if (nameA < nameB) {
    comparison = -1;
  }
  return comparison;
}

function compareType(a, b) {
  const nameA = a.type.toUpperCase();
  const nameB = b.type.toUpperCase();

  let comparison = 0;
  if (nameA > nameB) {
    comparison = 1;
  } else if (nameA < nameB) {
    comparison = -1;
  }
  return comparison;
}

function comparePrix(a, b) {
  const prixA = a.prix;
  const prixB = b.prix;

  let comparison = 0;
  if (prixA > prixB) {
    comparison = 1;
  } else if (prixA < prixB) {
    comparison = -1;
  }
  return comparison;
}

function sortPoisonByNom(myList){
	myList.sort(compareNom);	// on trie par noms
}

function sortPoisonByPrix(myList){
	myList.sort(compareNom);	// on trie par prix
	myList.sort(comparePrix);
}

function sortPoisonByApplication(myList){
	myList.sort(compareNom);	// on trie par application
	myList.sort(compareApplication);
}

function sortPoisonByType(myList){
	myList.sort(compareNom);	// on trie par type
	myList.sort(compareType);
}

function ajouterLigne(myPoison,myTable)
{
	var ligne = myTable.insertRow(-1);//on a ajouté une ligne

	var colonne1 = ligne.insertCell(0);//on a une ajouté une cellule
	//colonne1.innerHTML += "<strong title=\""+myPoison.source+"\">"+myPoison.nom+"</strong>";	 
	colonne1.setAttribute('data-label','Nom');
	colonne1.innerHTML += `<strong title="${myPoison.source}">${myPoison.nom}</strong>`;
	

	var colonne2 = ligne.insertCell(1);//on ajoute la seconde cellule
	colonne2.setAttribute('data-label','Application');
	colonne2.innerHTML += myPoison.application;

	var colonne3 = ligne.insertCell(2);
	colonne3.setAttribute('data-label','Type');
	colonne3.innerHTML += myPoison.type;

	var colonne4 = ligne.insertCell(3);
	colonne4.setAttribute('data-label','Prix');
	colonne4.innerHTML += myPoison.prix;

	var colonne5 = ligne.insertCell(4);
	colonne5.setAttribute('data-label','Description');
	colonne5.innerHTML += myPoison.desc;
}

function supprimerLigne(numLine,myTable)
{
	myTable.deleteRow(numLine);
}

function viderListePoison(){
	let listeVide = [];
	poisonList = listeVide;
	const tableau = document.getElementById("table_poison");
	const nbLigne = tableau.rows.length;
	for(let i=2;i<nbLigne;i++){
		supprimerLigne(2,tableau);
	}
}

function showTablePoison(){
	const tableau = document.getElementById("table_poison");
	for(let poison of poisonList){
		ajouterLigne(poison,tableau);
	}
}

function getPoisonBySource(){
	viderListePoison();
	remplirListe();
	sortPoisonByNom(poisonList);
	showTablePoison();
}

function getPoisonByPrix(){
	viderListePoison();
	remplirListe();
	sortPoisonByPrix(poisonList);
	showTablePoison();
}

function getPoisonByApplication(){
	viderListePoison();
	remplirListe();
	sortPoisonByApplication(poisonList);
	showTablePoison();
}

function getPoisonByType(){
	viderListePoison();
	remplirListe();
	sortPoisonByType(poisonList);
	showTablePoison();
}

/* function getPoison(sortFunction){	// DOES NOT WORK
	viderListePoison();
	remplirListe();
	sortFunction(poisonList);
	showTablePoison();
} */

function remplirListe(){
	//if(document.getElementById("chb_dmg").checked)
    {
		for(let poison of poisonPHB)
		{
			poisonList.push(poison);
		}
	}
	//if(document.getElementById("chb_aidedd").checked)
    {
		for(let poison of poisonAideDD)
		{
			poisonList.push(poison);
		}
	}
	//if(document.getElementById("chb_homebrew").checked)
    {
		for(let poison of poisonHomebrew)
		{
			poisonList.push(poison);
		}
	}
}

getPoisonBySource();