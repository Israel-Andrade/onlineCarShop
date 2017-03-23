import MySQLdb

host = "127.0.0.1"
user = "israelandrade22"
password = ""
dbName = "Car_Inventory"
#Open database connection
db = MySQLdb.connect(host, user, password, dbName)

#Prepare a cursor object using cursor() method
cursor = db.cursor()

# Drop table if it already exist using execute() method.
cursor.execute("DROP TABLE IF EXISTS CAR_INFORMATION")
cursor.execute("DROP TABLE IF EXISTS MODEL")
cursor.execute("DROP TABLE IF EXISTS MAKE")
#Create table as per requirement

#CREATING TABLE
sql = """CREATE TABLE CAR_INFORMATION(
        YEAR INT,
        MAKE CHAR(20),
        MODEL CHAR(20),
        PRICE INT,
        FUEL_EFFICIENCY DOUBLE)"""
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




# Prepare SQL query to INSERT a record into the database.
def insertToCarInformation(year, make, model, price, fuel_efficiency):
    sql = "INSERT INTO CAR_INFORMATION(YEAR, MAKE, MODEL, PRICE, FUEL_EFFICIENCY) \
           VALUES ('%d', '%s', '%s', '%d', '%d' )" % \
           (year, make, model, price, fuel_efficiency)
           
    try:
       # Execute the SQL command
       cursor.execute(sql)
       # Commit your changes in the database
       db.commit()
    except:
       # Rollback in case there is any error
       db.rollback()

def insertToMake(make, makeId):
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
            currentline[0] = int(currentline[0])
            currentline[3] = int(currentline[3])
            currentline[4] = float(currentline[4])
            currentline[5] = int(currentline[5])
            
            insertToCarInformation(currentline[0], currentline[1], currentline[2], currentline[3], currentline[4])
            insertToModel(currentline[2], currentline[5])
            insertToMake( currentline[1], currentline[5])
            


    
# disconnct from server
db.close()
