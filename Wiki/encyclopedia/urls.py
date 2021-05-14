from django.urls import path

from . import views

urlpatterns = [
    path("", views.index, name="index"),
    #	path(r'^index/$', views.index, name=""),
    path('find_entry/', views.find_entry, name="md_find"),
    path("wiki/<str:x>/", views.wiki, name="md_wiki"),
    path("new_page", views.new_page, name="md_new"),
    path("new_file", views.new_file, name="md_file"),
    path("update_file/<str:x>", views.update_file, name="md_update"),
    path("write_file", views.update_entry, name="md_write"),
    path("random_entry", views.random_entry, name="md_random"),
]
