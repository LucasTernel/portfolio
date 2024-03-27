import csv
def depuis_csv(fichier):
    lecteur = csv.DictReader(open(fichier + '.csv','r',encoding='utf-8'))
    return [dict(ligne) for ligne in lecteur]

def vers_csv(table,nom_fichier): 
    liste_attributs = list(table[0].keys()) #crée la liste des attributs
    with open(nom_fichier + '.csv','w',encoding='utf-8') as fic: 
        dic = csv.DictWriter(fic,fieldnames=liste_attributs)
        dic.writeheader() # pour écrire la 1ere ligne du fichier soit la liste des attributs
        for ligne in table:
            dic.writerow(ligne) # pour écrire chaque ligne
    fic.close()
    return None

def select(table, condition):
    t = []
    for ligne in table:
        if eval(condition):
            t.append(ligne)
    return t

def select_bis(table, condition): #par compréhension
    return [ligne for ligne in table if eval(condition)]

def projection(table, liste_attributs):
    t = []
    for ligne in table:
        d = {}
        for cle in ligne.keys():
            if cle in liste_attributs:
                d[cle] = ligne[cle]
        t.append(d)
    return t

def projection_bis(table, liste_attributs): #par compréhension
    return [{cle : ligne[cle] for cle in ligne.keys() if cle in liste_attributs} for ligne in table]
    
def tri_table(table, attribut, decroissant = False):
    def critere(ligne):
        return ligne[attribut]
    table_triee = sorted(table, key = critere, reverse = decroissant)
    return table_triee

def convertir_en_nombre(table):
    '''Convertit les valeurs de type str associées aux attributs 'latitude' et 'longitude' du paramètre table en type float
       Paramètre table : list : tableau de dictionnaires
       return : list : tableau de dictionnaires
       >>> convertir_en_nombre([{'latitude': '50.3965609084', 'longitude': '2.69725163344', 'nom_commune_complet': 'Ablain-Saint-Nazaire', 'code_departement': '62', 'nom_departement': 'Pas-de-Calais', 'nom_region': 'Hauts-de-France'},\
                                {'latitude': '50.153659552', 'longitude': '2.74147361096', 'nom_commune_complet': 'Ablainzevelle', 'code_departement': '62', 'nom_departement': 'Pas-de-Calais', 'nom_region': 'Hauts-de-France'}])
       [{'latitude': 50.3965609084, 'longitude': 2.69725163344, 'nom_commune_complet': 'Ablain-Saint-Nazaire', 'code_departement': '62', 'nom_departement': 'Pas-de-Calais', 'nom_region': 'Hauts-de-France'},\
        {'latitude': 50.153659552, 'longitude': 2.74147361096, 'nom_commune_complet': 'Ablainzevelle', 'code_departement': '62', 'nom_departement': 'Pas-de-Calais', 'nom_region': 'Hauts-de-France'}])
                                        
    '''
    t = []
    for ligne in table: 
        ligne['latitude'] = float(ligne['latitude'])
        ligne['longitude'] = float(ligne['longitude'])
        t.append(ligne)
    return t

def affiche_table(table):
    for ligne in table:
        phrase = ' '
        for val in ligne.values():
            phrase = phrase + str(val) + '  '
        print(phrase)

table_communes = depuis_csv("communes_francaises")
commune_pdc = select(table_communes, "ligne['nom_departement']== 'Pas-de-Calais'" )
table_convertie = convertir_en_nombre(commune_pdc)
table_modif = projection(table_convertie, ['nom_commune_complet','latitude' ,'longitude'])  

latitude_nord = tri_table(table_modif, 'latitude', True)[:10]

dix_plus_au_nord = []
for ligne in latitude_nord:
    dix_plus_au_nord.append(ligne['nom_commune_complet'])

latitude_sud = tri_table(table_modif, 'latitude')[:10]

dix_plus_au_sud = []
for ligne in latitude_sud:
    dix_plus_au_sud.append(ligne['nom_commune_complet'])
  