import os
import psycopg2
from database import *
from flask import Flask, session, render_template, request, json
from flask_session import Session
from sqlalchemy import create_engine
from sqlalchemy.orm import scoped_session, sessionmaker
from database import *
from book_rating import *

app = Flask(__name__, template_folder='.', static_folder='book/assets')
app.config["SESSION_PERMANENT"] = False
app.config["SESSION_TYPE"] = "filesystem"
app.secret_key = "a4b5c6"  

userdata = []
api_data = []

#   Main page of Web Site....

@app.route("/")
def index():
	return render_template("book/index.html")

#   User registration process

@app.route("/user_data", methods=["POST", "GET"])
def user_data():
    if request.method == "POST":
        userdata.clear()
        u_name=request.form.get("u_name")
        u_email=request.form.get("u_email")
        u_password=request.form.get("u_password")
        u_data={"user_name":u_name, "u_password": u_password, "u_email":u_email}
        userdata.append(u_name)
        userdata.append(u_password)
        userdata.append(u_email)
        return render_template("book/post_data.html", u_data=u_data)
    return index()


@app.route("/registration_process")
def registration_process():
        con=PSQL() 
        cursor=con.cursor()
        insert_query="insert into registered_users(user_name,password,email) values('" + str(userdata[0]) +"','" + str(userdata[1]) +"','" + str(userdata[2])  + "')" 
        try:
            msg = "Your Registration has been completed"
            cursor.execute(insert_query)
            con.commit()
            userdata.clear()
            return render_template("book/login_done.html", msg=msg)
        except (Exception, con.Error) as error :
            msg = "Sorry the user already exist or network problem"
            return render_template("book/login_done.html", msg=msg)


#   Login process 

@app.route("/login", methods=["POST", "GET"])
def login():
    con=PSQL()
    cursor=con.cursor()
    sg_name=request.form.get("sgname")
    sg_psw=request.form.get("psw")
    if request.method == "POST":
        try:
            login_query="Select * from registered_users where user_name='"+ str(sg_name) + "' and password='"+ str(sg_psw)+"'"
            cursor.execute(login_query)
            result=cursor.fetchall();
            if result:
                for row in result:
                    session["user_id"]=row[0]
                    session["user_name"]=row[1]
                return render_template("book/user.html", user=session)
            else:    
                return render_template("book/login_failed.html")
        except Exception as e:
            return render_template("book/login_failed.html")
    else:
        signin()
    return signin()        
    

#       Logout

@app.route("/logout")
def logout():
    session.clear()
    return render_template("book/index.html")

#   if session is not expired


@app.route("/signin")
def signin():
    try:
        if session['user_id']:
            return render_template("book/user.html", user=session)
        else:
            return render_template("book/index.html")
    except Exception as e:
            return render_template("book/index.html")


#   Book Searching 

@app.route("/isbnbook", methods=["POST","GET"])
def isbnbook():
    if request.method=='POST' and session["user_id"]:
        con=PSQL()
        cursor=con.cursor()
        isbn=request.form.get("bktype")
        bkdata=request.form.get("bk")
        if isbn=="title":
            find_book=" Select * from books where title='"+str(bkdata)+"'"
            cursor.execute(find_book)
            result=cursor.fetchall()
        elif isbn=="isbn":
            find_book=" Select * from books where isbn='"+str(bkdata)+"'"
            cursor.execute(find_book)
            result=cursor.fetchall()
        else:
            find_book=" Select * from books where author='"+str(bkdata)+"'"   
            cursor.execute(find_book)
            result=cursor.fetchall()
        return render_template("book/findbook.html", result=result, user=session)
    else:
        return signin()
    

#  Single Book by isbn

@app.route("/single_book/<string:get_isbn>")
def single_book(get_isbn):
    if session["user_id"]:
        con=PSQL()
        data_good=good_reads(get_isbn)
        x=data_good["books"]
        for item in x:
            api_data.append(item['average_rating'])
            api_data.append(item['ratings_count'])
            api_data.append(item['reviews_count'])
        data_get=get_reviews(con, get_isbn)
        return render_template("book/unique_book.html", get_isbn=get_isbn, user=session, y=api_data, data_get=data_get)
    else:
        signin()

@app.route("/put_ratings", methods=["POST", "GET"])
def put_ratings():
    if request.method=='POST' and session["user_id"]:
        con=PSQL()
        cursor=con.cursor()
        user_review=request.form.get("reviews")
        user_rating=request.form.get("rating")
        user_id=session["user_id"] 
        user_isbn=request.form.get("bkisbn")
        u_submission=put_reviews(con, user_id, session["user_name"], user_isbn, user_rating, user_review)   
        return render_template("book/posted_review.html", result=u_submission, user=session)
    else:
        return signin()   
    

# Error Handle incase string in url is none

@app.errorhandler(404)
def not_found(error):
    msg = "You Entered Nothing"
    return render_template("book/error_show.html", msg=msg)


#  Error Handler

@app.errorhandler(500)
def internal_error(error):
    msg = "You've logged out or may be server error"
    return render_template("book/error_show.html", msg=msg)


#  API to GET JSON Fomrat

@app.route("/api/<string:api_isbn>")
def api(api_isbn):
    con=PSQL()
    get_json=json_reviews(con, api_isbn)
    for x in get_json:
        z={"author":x[0], "year":x[1], "title":x[2], "isbn":api_isbn, "average_score":str(x[3]), "review_count":str(int(x[4]))}
    print(json.dumps(z, indent=4))
    return (json.dumps(z, indent=4, separators=(". ", " : "))) 


#    My testing function

@app.route("/test")
def test():
    a=good_reads(1857233808)
    items=a["books"]
    for item in items:
        api_data.append(item['average_rating'])
        api_data.append(item['ratings_count'])
        api_data.append(item['reviews_count'])
    print(api_data)
    b=json.dumps(a)
    c=json.loads(b)
    return c    

#    My testing function 2

@app.route("/abc/<string:x>")
def abc(x):
    if x is None:
        return "Nothing"
    else:
        return x



if __name__ == '__main__':
    app.run()
