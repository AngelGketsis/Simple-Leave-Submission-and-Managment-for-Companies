from django import forms
from .models import LeaveRequest
from django.contrib.auth.forms import UserCreationForm
from django.contrib.auth.models import User

class LeaveRequestForm(forms.ModelForm):
    start_date = forms.DateField(widget=forms.DateInput(attrs={'type': 'date'}))
    end_date = forms.DateField(widget=forms.DateInput(attrs={'type': 'date'}))
    
    class Meta:
        model = LeaveRequest
        fields = ['start_date', 'end_date']

class UserRegisterForm(UserCreationForm):
    email = forms.EmailField()
    
    class Meta:
        model = User
        fields = ['username', 'email', 'password1', 'password2'] 