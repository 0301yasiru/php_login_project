import mysql.connector

def read_file():
    with open('qa.txt', "r") as data:
        content = data.readlines()

    values = []
    for item in content:
        try:
            item = item.split('|')
            values.append((item[0], item[1][:-1]))
        except IndexError:
            pass

    return values

#this is the connection object for the mysql database
db_connection = mysql.connector.connect(
    host='localhost',
    user='root',
    password='',
    database = 'falala'
)

#create a cursor for the database
db_cursor = db_connection.cursor()

uname = input("Enter User name: ")

#sql variable
sql = "INSERT INTO `q_a_users`(`user_name`, `question`, `answer`, `done`) VALUES('{}', %s, %s, 0)".format(uname)


db_cursor.executemany(sql, read_file())
db_connection.commit()

print(db_cursor.rowcount, 'was inserted')