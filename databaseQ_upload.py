import mysql.connector

#this is the connection object for the mysql database
db_connection = mysql.connector.connect(
    host='localhost',
    user='root',
    password='',
    database = 'falala'
)

#create a cursor for the database
db_cursor = db_connection.cursor()

#sql variable
sql = "INSERT INTO `q_a_users`(`user_name`, `question`, `answer`, `done`) VALUES('poorni', %s, %s, 0)"
values = [
    ('Who is the founder of Apple?', 'Steve Jobs'),
    ('Who is the current CEO of spaceX?', 'Elon Musk'),
    ('What stands for WWW?', 'World Wide Web'),
    ('OS stands for (Open Software, Open Source, Operatin System, Order of Significance,)', 'Operating System'),
    ('.docx is a extensition of (Power point, Word, Excel, Access)', 'Word'),
    ('What is the odd one? (Mysql, Access, LibreOffice Base, Excel)', 'Excel'),
    ('IOS is a Operating System of what company?', 'apple'),
    ('Whatsapp is now owned by?', 'Mark Zuckerberg'),
    ('Nowadays we use Universal Serial Bus (USB) to transfer data. Recently USB v4.0 arrived. What is the max speed of data transfer in Giga bits per seconds?', '40'),
    ('What is the smalles quantity of digital data?', 'bit'),
    ('Keyboard is a ---------- device', 'input'),
    ('What is the name of famous Artificial Intelligence Robbot?', 'Sofia'),
    ('Nowadays all of us widely use GUI.. And GUI stands for', 'graphical user interface'),
    ('Who is the founder of World Wide Web?', 'Tim Berners Lee'),
    ('Who is the Father of modern computers?', 'Charles Babbage'),
    ('What is the net worth of the CEO of Microsoft company (in USD)?', '113.6 billion'),
    ('Were will be the next olynpics?', 'Japan'),
    ('What is the launch year of Facebook?', '2004'),
    ('What is the most used website as we speak?', 'Google'),
    ('http stands for?', 'Hypertext Transfer Protocol'),
    ('What is the name of the protocol uses when transfering files (give the short form as http, https)?', 'ftp'),
    ('Spread sheet uses in (xcel, powerpoint, word, acces)?', 'xcel'),
    ('How computers uniquely identify each other when communicating through a network? (IP address, URL, MAC address, HTTP)', 'MAC address'),
    ('RAM stads for?', 'Random access memory'),
    ('4 GB are equals to how many Gb?', '32'),
    ('What is the first name of the first programmer?', 'ada')
]

db_cursor.executemany(sql, values)
db_connection.commit()

print(db_cursor.rowcount, 'was inserted')