import annexe as a

def affiche_stocks():
    mydb = a.connexion()
    curseur = mydb.cursor(dictionary=True)

    # Requête SQL pour obtenir les informations nécessaires
    requete = """
    SELECT articles.nom AS nom_article, articles.code, rangements.nom AS nom_rangement, stocks.quantite
    FROM stocks
    JOIN articles ON stocks.article = articles.code
    JOIN rangements ON stocks.rangement = rangements.id
    ORDER BY articles.nom;
    """

    curseur.execute(requete)
    resultats = curseur.fetchall()

    # Affichage des résultats
    for resultat in resultats:
        print(f"Article: {resultat['nom_article']}, Code: {resultat['code']}, Rangement: {resultat['nom_rangement']}, Quantité: {resultat['quantite']}")

    curseur.close()
    a.fin_connexion(mydb)
 
 
def est_present_dans_articles(code, nom):
    mydb = a.connexion()
    curseur = mydb.cursor()
    requete = f"SELECT COUNT(*) FROM articles WHERE code = '{code}' AND nom = '{nom}';"
    curseur.execute(requete)
    verif = curseur.fetchone()[0]
    if verif > 0 :
        print(f"L'article avec le code {code} et le nom {nom} est présent dans la table articles.")
    else:
        print(f"L'article avec le code {code} et le nom {nom} n'est pas présent dans la table articles.")
    return verif > 0
    curseur.close()
    a.fin_connexion(mydb)
    
    
def est_present_dans_rangements(nom):
    mydb = a.connexion()
    curseur = mydb.cursor()
    requete = f"SELECT COUNT(*) FROM rangements WHERE nom = '{nom}';"
    curseur.execute(requete)
    verif = curseur.fetchone()[0]
    if verif > 0:
        print(f"Le rangement avec le nom {nom} est présent dans la table Rangements.")
    else:
        print(f"Le rangement avec le nom {nom} n'est pas présent dans la table Rangements.")
    return verif > 0
    curseur.close()
    a.fin_connexion(mydb)
    
    
def est_present_dans_stocks(code):
    mydb = a.connexion()
    curseur = mydb.cursor()

    requete = f"SELECT COUNT(*) FROM stocks WHERE article = '{code}';"

    curseur.execute(requete)
    verif = curseur.fetchone()[0]
    
    if verif > 0:
        print(f"L'article avec le code {code} est présent dans la table stocks.")
    else:
        print(f"L'article avec le code {code} n'est pas présent dans la table stocks.")
    return verif > 0 
    curseur.close()
    a.fin_connexion(mydb)
    
def max_id_rangement():
    mydb = a.connexion()
    curseur = mydb.cursor(buffered=True)

    requete = "SELECT MAX(id) FROM rangements"
    curseur.execute(requete)

    max_id = curseur.fetchone()[0]

    curseur.close()
    a.fin_connexion(mydb)

    return max_id


def modif_stockage(code, nom, quantite, rangement):
    mydb = a.connexion()
    curseur = mydb.cursor()

    # Vérifier si l'article existe déjà dans la table stocks
    requete_existe = f"SELECT COUNT(*) FROM stocks WHERE article = '{code}';"
    curseur.execute(requete_existe)
    verif_existe = curseur.fetchone()[0]

    if verif_existe > 0:
        # L'article existe déjà, mise à jour de la quantité et du rangement
        rangement_obj = a.Rangement(rangement)

        if not est_present_dans_rangements(rangement):
            rangement_id = max_id_rangement() + 1
            requete_modif = f"UPDATE stocks SET quantite = {quantite}, rangement = {rangement_id} WHERE article = '{code}';"
            curseur.execute(requete_modif)

            # Correction : Utilisation de rangement_id au lieu de nouveau_rangement_id
            stocks = a.Stocks(code, rangement_id, quantite)
            stocks.insere_BDD()
        else:
            # Correction : Utilisation de rangement_id au lieu de nouveau_rangement_id
            rangement_id = rangement_obj.get_id()
            requete_modif = f"UPDATE stocks SET quantite = {quantite}, rangement = {rangement_id} WHERE article = '{code}';"
            curseur.execute(requete_modif)
    else:
        # L'article n'existe pas, vérifier s'il existe dans la table articles
        article = a.Article(nom, code)
        if not est_present_dans_articles(code, nom):
            article.insere_BDD()

        # Vérifier si le rangement existe dans la table rangements
        rangement_obj = a.Rangement(rangement)
        if est_present_dans_rangements(rangement):
            rangement_id = rangement_obj.get_id()
            requete_modif = f"UPDATE stocks SET rangement = {rangement_id} WHERE article = '{code}';"
            curseur.execute(requete_modif)
            stocks = a.Stocks(code, rangement_id, quantite)
            stocks.insere_BDD()
        else:
            rangement_id = max_id_rangement() + 1
            requete_modif = f"UPDATE stocks SET rangement = {rangement_id} WHERE article = '{code}';"
            curseur.execute(requete_modif)
            stocks = a.Stocks(code, rangement_id, quantite)
            stocks.insere_BDD()
    
    mydb.commit()
    curseur.close()
    a.fin_connexion(mydb)
    return "C'est fait"
    