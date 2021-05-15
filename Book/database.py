import psycopg2

def PSQL():
  try:
    connection = psycopg2.connect(user = "lsvrqtnbnvmbxm",
                                  password = "627aab92ae4a1508f7ef06e78e37d5a91c51f1666eb8cd52f32f3c0d1609eda3",
                                  host = "ec2-35-171-31-33.compute-1.amazonaws.com",
                                  port = "5432",
                                  database = "d5gpllpq5k1ulq")

    cursor = connection.cursor()
    # Print PostgreSQL Connection properties
    print ( connection.get_dsn_parameters(),"\n")

    # Print PostgreSQL version
    cursor.execute("SELECT version();")
    record = cursor.fetchone()
    print("Done! You are connected to - ")

  except (Exception, psycopg2.Error) as error :
    print ("Error while connecting to PostgreSQL", error)
  #finally:
    #closing database connection.
        #if(connection):
            #cursor.close()
            #connection.close()
            #print("PostgreSQL connection is closed")
  return connection

def get_data():
  con=PSQL()
  cursor=con.cursor()
  cursor.execute("SELECT * from books limit 3")
  result = cursor.fetchall();
  print(result)


#get_data()