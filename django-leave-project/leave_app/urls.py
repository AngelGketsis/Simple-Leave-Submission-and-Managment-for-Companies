from django.urls import path
from . import views
from django.contrib.auth import views as auth_views

urlpatterns = [
    path('register/', views.register, name='register'),
    path('login/', auth_views.LoginView.as_view(template_name='leave_app/login.html'), name='login'),
    path('logout/', auth_views.LogoutView.as_view(template_name='leave_app/logout.html'), name='logout'),
    path('dashboard/', views.dashboard, name='dashboard'),
    path('new-leave-request/', views.new_leave_request, name='new_leave_request'),
    path('admin-dashboard/', views.admin_dashboard, name='admin_dashboard'),
    path('approve-leave/<int:request_id>/', views.approve_leave, name='approve_leave'),
    path('reject-leave/<int:request_id>/', views.reject_leave, name='reject_leave'),
    path('', views.dashboard, name='home'),
] 