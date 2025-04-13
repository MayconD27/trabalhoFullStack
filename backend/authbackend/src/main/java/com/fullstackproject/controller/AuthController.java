package com.fullstackproject.controller;

import com.fullstackproject.model.User;
import com.fullstackproject.repository.UserRepository;
import com.fullstackproject.security.JwtUtil;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.util.Optional;

@RestController
@RequestMapping("/auth")
public class AuthController {

    @Autowired
    private UserRepository userRepository;

    @Autowired
    private JwtUtil jwtUtil;

    @PostMapping("/login")
    public String login(@RequestBody User loginRequest) {
        Optional<User> userOptional = userRepository.findByEmail(loginRequest.getEmail());

        if (userOptional.isPresent()) {
            User user = userOptional.get();

            if (user.getPassword().equals(loginRequest.getPassword())) {
                // Gera o token JWT
                String token = jwtUtil.generateToken(user.getEmail());
                return "Login successful! Token: " + token;
            }
        }
        return "Invalid email or password!";
    }
}
