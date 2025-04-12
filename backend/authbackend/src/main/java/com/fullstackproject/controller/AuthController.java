package com.fullstackproject.controller;

import com.fullstackproject.model.User;
import com.fullstackproject.repository.UserRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.util.Optional;

@RestController
@RequestMapping("/auth")
public class AuthController {

    @Autowired
    private UserRepository userRepository;

    @PostMapping("/login")
    public String login(@RequestBody User user) {
        Optional<User> user = userRepository.findByEmail(user.getEmail());

        if (user.isPresent() && user.get().getPassword().equals(user.getEmail())) {
            return "Login sucessful!";
        } else {
            return "Invalid email or password!";
        }
    }
}
