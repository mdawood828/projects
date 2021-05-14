import re

import os
from django.core.files.base import ContentFile
from django.core.files.storage import default_storage


def list_entries():
    """
    Returns a list of all names of encyclopedia entries.
    """
    _, filenames = default_storage.listdir("entries")
    return list(sorted(re.sub(r"\.md$", "", filename)
                for filename in filenames if filename.endswith(".md")))


def save_entry(title, content):
    """
    Saves an encyclopedia entry, given its title and Markdown
    content. If an existing entry with the same title already exists,
    it is replaced.
    """
    filename = f"entries/{title}.md"
    if default_storage.exists(filename):
        return f" {title} entry already exists"
    else:
        default_storage.save(filename, ContentFile(content))
    return "Done"

"""
        Title is same the simply replace file
"""

def update_entry(title, content):
    filename = f"entries/{title}.md"
    if default_storage.exists(filename):
        default_storage.delete(filename)
    default_storage.save(filename, ContentFile(content))
    return "Done"

"""
        Tilte is different 
"""
def update_new_entry(title, content, p_title):
    filename=f"entries/{p_title}.md"
    default_storage.delete(filename)
    return save_entry(title, content)


def get_entry(title):
    """
    Retrieves an encyclopedia entry by its title. If no such
    entry exists, the function returns None.
    """
    try:
        f = default_storage.open(f"entries/{title}.md")
        return f.read().decode("utf-8")
    except FileNotFoundError:
        return None

"""
        Finding pattern
"""

def find_entry(title):
    my_files = []
    find_files=[]
    files = os.listdir("./entries")
    for f in files:
        if(f.endswith("md")):
            my_files.append(f.replace('.md',''))

    for x in my_files:
        if title in x:
            find_files.append(x)
    if not find_files:
        return None
    return find_files
