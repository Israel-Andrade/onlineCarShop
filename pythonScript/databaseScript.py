import MySQLdb

host = "127.0.0.1"
user = "israelandrade22"
password = ""
dbName = "Car_Inventory"
#Open database connection
#db = MySQLdb.connect(host, user, password, dbName)
db = MySQLdb.connect(host, user, password)
#Prepare a cursor object using cursor() method
cursor = db.cursor()


# Drop table if it already exist using execute() method.
cursor.execute("DROP DATABASE IF EXISTS Car_Inventory")
cursor.execute("CREATE DATABASE Car_Inventory")
db = MySQLdb.connect(host, user, password, dbName)
#Prepare a cursor object using cursor() method
cursor = db.cursor()
cursor.execute("DROP TABLE IF EXISTS CAR_INFORMATION")
cursor.execute("DROP TABLE IF EXISTS MODEL")
cursor.execute("DROP TABLE IF EXISTS MAKE")
#Create table as per requirement

#CREATING TABLE
sql = """CREATE TABLE CAR_INFORMATION(
        YEAR INT,
        MAKE_ID INT,
        MODEL_ID INT,
        PRICE INT,
        FUEL_EFFICIENCY DOUBLE,
        DESCRIPTION TEXT)"""
cursor.execute(sql)


#CREATING TABLE
sql = """CREATE TABLE MODEL(
        ID INT,
        MODEL CHAR(20))
        """
cursor.execute(sql)


#CREATING TABLE
sql = """CREATE TABLE MAKE(
         ID INT,
         MAKE CHAR(20))"""
cursor.execute(sql)


"""DICTIONARY TO FOR MAKE AND MAKE_ID"""
makes ={
    "FORD": 1,
    "TOYOTA": 2,
    "HONDA": 3,
    "NISSAN": 4,
    "TESLA": 5
}
"""DiCTIONARY CHECK IF MAKE HAS BEEN ADDED TO DATABASE"""
makeHasBeenAdded ={
    "FORD": False,
    "TOYOTA": False,
    "HONDA": False,
    "NISSAN": False,
    "TESLA": False
}
# Prepare SQL query to INSERT a record into the database.
def insertToCarInformation(year, make, model, price, fuel_efficiency, description):
    sql = "INSERT INTO CAR_INFORMATION(YEAR, MAKE_ID, MODEL_ID, PRICE, FUEL_EFFICIENCY, DESCRIPTION) \
           VALUES ('%d', '%d', '%d', '%d', '%d', '%s')" % \
           (year, make, model, price, fuel_efficiency, description)
           
    try:
       # Execute the SQL command
       cursor.execute(sql)
       # Commit your changes in the database
       db.commit()
    except:
       # Rollback in case there is any error
       db.rollback()

def insertToMake(make, makeId):
    if(makeHasBeenAdded[make] == False):
        sql = "INSERT INTO MAKE(ID, MAKE) \
               VALUES ('%d', '%s')" % \
               (makeId, make)
               
        try:
           # Execute the SQL command
           cursor.execute(sql)
           # Commit your changes in the database
           db.commit()
        except:
           # Rollback in case there is any error
           db.rollback()
        makeHasBeenAdded[make] = True
           
    
    
def insertToModel(model, modelId):
    sql = "INSERT INTO MODEL(ID, MODEL) \
       VALUES ('%d', '%s')" % \
       (modelId, model)
           
    try:
       # Execute the SQL command
       cursor.execute(sql)
       # Commit your changes in the database
       db.commit()
    except:
       # Rollback in case there is any error
       db.rollback()
       
       
with open("carsInformation.csv", "r") as filestream:
    for line in filestream:
        currentline = line.split(",")
        if(currentline[0] != '\n'):
            print( currentline[0])
            print( currentline[1])
            print( currentline[2])
            print( currentline[3])
            print( currentline[4])
            print( currentline[5])
            print(currentline[6])
            currentline[0] = int(currentline[0])
            currentline[3] = int(currentline[3])
            currentline[4] = float(currentline[4])
            currentline[5] = int(currentline[5])
            oldMake = currentline[1]
            make = oldMake.replace("\"", '')
            insertToCarInformation(currentline[0],makes[make] , currentline[5], currentline[3], currentline[4], currentline[6])
            insertToModel(currentline[2], currentline[5])
            insertToMake(make, makes[make])
# disconnct from server
db.close()
