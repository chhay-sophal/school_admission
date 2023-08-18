from django.contrib import admin
from django.urls import path, include
from index.views import *

urlpatterns = [
    path('', include('index.urls')),
    path('admin/', admin.site.urls),
]
