import mysql.connector

def connexion():
    return mysql.connector.connect(
        host="localhost",
        user="root",
        password="root",
        database="gestion_stocks"
    )

def fin_connexion(mydb):
    mydb.close()

class Article():
    def __init__(self, nom, code):
        self.__nom = nom
        self.__code = code

    def insere_BDD(self):
        mydb = connexion()
        curseur = mydb.cursor(buffered=True)
        requete = "INSERT INTO articles(code, nom) VALUES('" + self.__code + "','" + self.__nom + "')"
        curseur.execute(requete)
        mydb.commit()
        curseur.close()
        fin_connexion(mydb)

    def get_nom(self):
        return self.__nom

    def get_code(self):
        return self.__code

    def __repr__(self):
        return "" + self.__nom + " : " + self.__code

class Rangement():
    def __init__(self, nom):
        self.__nom = nom

    def insere_BDD(self):
        mydb = connexion()
        curseur = mydb.cursor(buffered=True)
        requete = "INSERT INTO rangements(id, nom) VALUES(NULL,'" + self.__nom + "')"
        curseur.execute(requete)
        mydb.commit()
        curseur.close()
        fin_connexion(mydb)

    def get_nom(self):
        return self.__nom

    def get_id(self):
        mydb = connexion()
        curseur = mydb.cursor(buffered=True)
        requete = "SELECT id FROM rangements WHERE nom='" + self.__nom + "'"
        curseur.execute(requete)
        ligne = curseur.fetchone()
        curseur.close()
        fin_connexion(mydb)
        return ligne[0]

    def __repr__(self):
        return self.__nom

class Stocks():
    def __init__(self, code_article, code_rangement, quantite):
        self.__quantite = quantite
        self.__article = code_article
        self.__rangement = code_rangement

    def insere_BDD(self):
        mydb = connexion()
        curseur = mydb.cursor(buffered=True)

        requete = f"INSERT INTO stocks(article, rangement, quantite) VALUES('{self.__article}', '{self.__rangement}', {self.__quantite})"
        curseur.execute(requete)

        mydb.commit()
        curseur.close()
        fin_connexion(mydb)


    def __repr__(self):
        return "|" + self.__article.get_nom() + "|" + self.__article.get_code() + "|" + self.__rangement.get_nom()

    def get_quantite(self):
        return self.__quantite

    def get_rangement(self):
        return self.__rangement

    def modif_quantite(self, quantite):
        self.__quantite = quantite
        mydb = connexion()
        curseur = mydb.cursor(buffered=True)
        requete = "UPDATE stocks SET quantite =" + str(quantite) + " WHERE article = '" + self.__article + "'"
        curseur.execute(requete)
        mydb.commit()
        curseur.close()
        fin_connexion(mydb)

    def modif_rangement(self, rangement):
        self.__rangement = rangement
        mydb = connexion()
        curseur = mydb.cursor(buffered=True)
        requete = "UPDATE stocks SET rangement =" + str(rangement) + " WHERE article = '" + self.__article + "'"
        curseur.execute(requete)
        mydb.commit()
        curseur.close()
        fin_connexion(mydb)