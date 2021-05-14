from django.shortcuts import render
from django.http import HttpResponse, Http404
import random
import markdown2

from . import util


def index(request):
    return render(request, "encyclopedia/index.html", {
        "entries": util.list_entries()
		})


def wiki(request, x):
	y = util.get_entry(x)
	if y != None:
		z =	markdown2.markdown(y)
		return render(request, "encyclopedia/file_details.html", {
        "entries": z, 
        "file":x
    	})
	else:
		return render(request, "encyclopedia/entry_status.html", {
        "entry": "Your Requested page not found"
		})

"""
		To create new entry
"""
def new_page(request):
	return render(request, "encyclopedia/wiki_entry.html", {
    })

"""
		To find new entry
"""

def find_entry(request):
	q = request.GET.get('q', '')
	if q:
		y=util.find_entry(q)
		if y!=None:
			return render(request, "encyclopedia/index.html", {
        	"entries": util.find_entry(q)
			})
		else:
			return render(request, "encyclopedia/entry_status.html", {
        	"entry": "Your entry does not exist"
			})
	else:
		return render(request, "encyclopedia/entry_status.html", {
        "entry": "Please Enter Value"
		}) 


def new_file(request):
	if request.method == "POST":
		title = request.POST.get('title', '')
		content = request.POST.get('description', '')
		return render(request, "encyclopedia/entry_status.html", {
        "entry": util.save_entry(title, content)
		})
	else:
		return new_page(request)


def update_file(request, x):
	if x:
		return render(request, "encyclopedia/update_entry.html", {
        "entries": util.get_entry(x), 
        "file":x
    })


def update_entry(request):
	if request.method == "POST":
		title = request.POST.get('title', '')
		content = request.POST.get('description', '')
		p_title= request.POST.get('p_title','')
		if title==p_title:
			return render(request, "encyclopedia/entry_status.html", {
        	"entry": util.update_entry(title, content)
			})
		else:
			return render(request, "encyclopedia/entry_status.html", {
        	"entry": util.update_new_entry(title, content, p_title)
			})
	else:
		return index(request)	


def random_entry(request):
	get_list=util.list_entries()
	r=(random.choice(get_list))
	return render(request, "encyclopedia/random_entry.html", {
        "entries": (random.choice(get_list))
		})


