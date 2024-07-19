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
@RequestMapping("/user")
public class UserController {

    @Autowired
    private UserService userService;

    @Autowired
    private LeaveRequestService leaveRequestService;

    @GetMapping("/dashboard")
    public String userDashboard(Model model) {
        String username = SecurityContextHolder.getContext().getAuthentication().getName();
        User user = userService.findByUsername(username);
        List<LeaveRequest> leaveRequests = leaveRequestService.findByUser(user);
        model.addAttribute("leaveRequests", leaveRequests);
        return "user-dashboard";
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

        return "redirect:/user/dashboard";
    }
}