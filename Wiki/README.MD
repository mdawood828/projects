								Requirements


In the distribution code is a Django project called wiki that contains a single app called encyclopedia .
First, open up encyclopedia/urls.py , where the URL con guration for this app is de ned. Notice that we’ve started you with a single
default route that is associated with the views.index function.

Next, look at encyclopedia/util.py . You won’t need to change anything in this le, but notice that there are three functions that may
prove useful for interacting with encyclopedia entries. list_entries returns a list of the names of all encyclopedia entries currently
saved. save_entry will save a new encyclopedia entry, given its title and some Markdown content. get_entry will retrieve an
encyclopedia entry by its title, returning its Markdown contents if the entry exists or None if the entry does not exist. Any of the views
you write may use these functions to interact with encyclopedia entries.

Each encyclopedia entry will be saved as a Markdown le inside of the entries/ directory. If you check there now, you’ll see we’ve pre-
created a few sample entries. You’re welcome to add more!

Now, let’s look at encyclopedia/views.py . There’s just one view here now, the index view. This view returns a template
encyclopedia/index.html , providing the template with a list of all of the entries in the encyclopedia (obtained by calling
util.list_entries , which we saw de ned in util.py ).

You can nd the template by looking at encyclopedia/templates/encyclopedia/index.html . This template inherits from a base
fille and speci es what the page’s title should be, and what should be in the body of the page: in this case, an unordered
list of all of the entries in the encyclopedia. layout.html , meanwhile, de nes the broader structure of the page: each page has a
sidebar with a search eld (that for now does nothing), a link to go home, and links (that don’t yet work) to create a new page or visit a
random page.
