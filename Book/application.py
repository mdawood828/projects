import os
import psycopg2
from database import *
from flask import Flask, session, render_template, request
from flask_session import Session
from sqlalchemy import create_engine
from sqlalchemy.orm import scoped_session, sessionmaker
from database import *

app = Flask(__name__, template_folder='.')

@app.route("/")
def index():
    con=PSQL()
    cursor=con.cursor()
    cursor.execute('''SELECT * from books limit 10''')
    result = cursor.fetchall();
    print(result)
    return render_template("index.html", result=result)

if __name__ == '__main__':
    app.run()
