from django.shortcuts import render, redirect, get_object_or_404
from django.contrib import messages
from django.contrib.auth.decorators import login_required, user_passes_test
from .models import LeaveRequest
from .forms import LeaveRequestForm, UserRegisterForm
from django.contrib.auth.models import User

def register(request):
    if request.method == 'POST':
        form = UserRegisterForm(request.POST)
        if form.is_valid():
            form.save()
            username = form.cleaned_data.get('username')
            messages.success(request, f'Account created for {username}! You can now log in.')
            return redirect('login')
    else:
        form = UserRegisterForm()
    return render(request, 'leave_app/register.html', {'form': form})

@login_required
def dashboard(request):
    leave_requests = LeaveRequest.objects.filter(user=request.user).order_by('-created_at')
    return render(request, 'leave_app/dashboard.html', {'leave_requests': leave_requests})

@login_required
def new_leave_request(request):
    if request.method == 'POST':
        form = LeaveRequestForm(request.POST)
        if form.is_valid():
            leave_request = form.save(commit=False)
            leave_request.user = request.user
            leave_request.status = 'PENDING'
            leave_request.save()
            messages.success(request, 'Your leave request has been submitted!')
            return redirect('dashboard')
    else:
        form = LeaveRequestForm()
    return render(request, 'leave_app/new_leave_request.html', {'form': form})

def is_admin(user):
    return user.is_superuser

@login_required
@user_passes_test(is_admin)
def admin_dashboard(request):
    pending_requests = LeaveRequest.objects.filter(status='PENDING').order_by('-created_at')
    return render(request, 'leave_app/admin_dashboard.html', {'leave_requests': pending_requests})

@login_required
@user_passes_test(is_admin)
def approve_leave(request, request_id):
    leave_request = get_object_or_404(LeaveRequest, id=request_id)
    leave_request.status = 'APPROVED'
    leave_request.save()
    messages.success(request, f'Leave request for {leave_request.user.username} has been approved!')
    return redirect('admin_dashboard')

@login_required
@user_passes_test(is_admin)
def reject_leave(request, request_id):
    leave_request = get_object_or_404(LeaveRequest, id=request_id)
    leave_request.status = 'REJECTED'
    leave_request.save()
    messages.success(request, f'Leave request for {leave_request.user.username} has been rejected!')
    return redirect('admin_dashboard')
