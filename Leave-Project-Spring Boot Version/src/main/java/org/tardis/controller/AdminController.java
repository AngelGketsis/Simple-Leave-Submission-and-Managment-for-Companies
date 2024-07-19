package org.tardis.controller;

import org.tardis.model.LeaveRequest;
import org.tardis.model.User;
import org.tardis.service.LeaveRequestService;
import org.tardis.service.UserService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;

import java.time.LocalDate;
import java.util.List;

@Controller
@RequestMapping("/admin")
public class AdminController {

    @Autowired
    private UserService userService;

    @Autowired
    private LeaveRequestService leaveRequestService;

    @GetMapping("/dashboard")
    public String adminDashboard(Model model) {
        List<LeaveRequest> leaveRequests = leaveRequestService.findByStatus("PENDING");
        model.addAttribute("leaveRequests", leaveRequests);
        return "admin-dashboard";
    }

    @PostMapping("/approve")
    public String approveLeaveRequest(@RequestParam Long requestId) {
        LeaveRequest leaveRequest = leaveRequestService.findById(requestId);
        if (leaveRequest != null) {
            leaveRequest.setStatus("APPROVED");
            leaveRequestService.save(leaveRequest);
        }
        return "redirect:/admin/dashboard";
    }

    @PostMapping("/reject")
    public String rejectLeaveRequest(@RequestParam Long requestId) {
        LeaveRequest leaveRequest = leaveRequestService.findById(requestId);
        if (leaveRequest != null) {
            leaveRequest.setStatus("REJECTED");
            leaveRequestService.save(leaveRequest);
        }
        return "redirect:/admin/dashboard";
    }

    @GetMapping("/new-leave-request")
    public String newLeaveRequestForm() {
        return "new-leave-request";
    }

    @PostMapping("/new-leave-request")
    public String createLeaveRequest(@RequestParam String startDate, @RequestParam String endDate) {
        String username = SecurityContextHolder.getContext().getAuthentication().getName();
        User user = userService.findByUsername(username);

        LeaveRequest leaveRequest = new LeaveRequest();
        leaveRequest.setStartDate(LocalDate.parse(startDate));
        leaveRequest.setEndDate(LocalDate.parse(endDate));
        leaveRequest.setStatus("PENDING");
        leaveRequest.setUser(user);

        leaveRequestService.save(leaveRequest);

        return "redirect:/admin/dashboard";
    }
}