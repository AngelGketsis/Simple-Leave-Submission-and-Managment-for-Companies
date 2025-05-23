from django.contrib import admin
from .models import LeaveRequest

class LeaveRequestAdmin(admin.ModelAdmin):
    list_display = ('user', 'start_date', 'end_date', 'status', 'created_at')
    list_filter = ('status', 'start_date', 'end_date')
    search_fields = ('user__username', 'status')
    date_hierarchy = 'created_at'

admin.site.register(LeaveRequest, LeaveRequestAdmin)
