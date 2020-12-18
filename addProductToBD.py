from bs4 import BeautifulSoup
import requests
import mysql.connector


mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="ecommerceprojetphp"
)

mc = mydb.cursor()

myUrl = "https://www.tunisianet.com.tn/596-smartphone-mobile-4g-tunisie"

source = requests.get(myUrl).text

soup = BeautifulSoup(source)

mydivs = soup.findAll("h2", {"class": "h3 product-title"})

for i in mydivs:
    print(i.a['href'])



liste = []
for div in mydivs:
    liste.append(div.a['href'])


for l in liste:
    src = requests.get(l).text
    sp = BeautifulSoup(src)
    name = sp.findAll("meta", {"property": "og:title"})
    desc = sp.findAll("meta", {"property": "og:description"})
    img = sp.findAll("meta", {"property": "og:image"})
    pri = sp.findAll("meta", {"property": "product:price:amount"})

    e = 0
    for i in name:
        sql = "insert into article values(Null , %s ,%s , %s ,%s , 0 , 3 , 0)"
        val = (i['content'] , desc[0]['content'] , img[0]['content'] , pri[0]['content'])
        mc.execute(sql,val)
        mydb.commit()

print("done")
