package org.tardis.service;

import org.tardis.model.LeaveRequest;
import org.tardis.model.User;
import org.tardis.repository.LeaveRequestRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;


import java.util.List;
import java.util.Optional;

@Service
public class LeaveRequestService {
    @Autowired
    private LeaveRequestRepository leaveRequestRepository;

    public List<LeaveRequest> findByUser(User user) {
        return leaveRequestRepository.findByUser(user);
    }

    public List<LeaveRequest> findByStatus(String status) {
        return leaveRequestRepository.findByStatus(status);
    }

    public void save(LeaveRequest leaveRequest) {
        leaveRequestRepository.save(leaveRequest);
    }

    public LeaveRequest findById(Long id) {
        Optional<LeaveRequest> optionalLeaveRequest = leaveRequestRepository.findById(id);
        return optionalLeaveRequest.orElse(null);
    }
}