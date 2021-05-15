from flask import Flask
import psycopg2
import requests

app = Flask(__name__)

def get_reviews(con, isbn):
	cursor=con.cursor()
	select_reviews="select * from book_ratings where isbn='"+str(isbn)+"'"
	cursor.execute(select_reviews)
	result=cursor.fetchall();
	if result:
		return result
	else:
		return ""

def put_reviews(con, user_id, user_name, isbn, rating, comments):
	cursor=con.cursor()
	insert_query="insert into book_ratings(user_id, user_name, isbn, comments, rating) values('" + str(user_id) + "','" + str(user_name)+"','" + str(isbn)+"','"+str(comments)+"','"+str(rating)+"')"
	try:
		cursor.execute(insert_query)
		con.commit()
		return " You successfully commented on this book "
	except (Exception, con.Error) as error :
                return f"{error} "
	
def json_reviews(con, isbn):
	cursor=con.cursor()
	select_reviews="Select books.author, books.year, books.title, (Select AVG(rating) AS Average from book_ratings where isbn='"+ str(isbn) +"'), (Select COUNT(comments) AS Review_Count from book_ratings where isbn='"+ str(isbn) +"') from books, book_ratings where books.isbn='"+ str(isbn) +"' GROUP BY books.isbn"
	cursor.execute(select_reviews)
	result=cursor.fetchall();
	if result:
		return result
	else:
		return ""

def good_reads(isbn):
    key="EgCdgXPsBb1F0E8mlBZig"
    secret="I8uPxMnJMNUItsYCev6u24Zwi6w0AtM8oITqIq1gg"
    res = requests.get("https://www.goodreads.com/book/review_counts.json", params={"key": key, "isbns": isbn})
    return res.json()
